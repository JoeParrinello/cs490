
<?php
require_once 'sendTo.php';
  //change to actual database
//$database_url="https://web.njit.edu/~sra27/test.php";
$database_url="https://web.njit.edu/~jap64/backend/user.php";

if($_SERVER["CONTENT_TYPE"]=="application/json"){
  $variable=json_decode(file_get_contents('php://input'), true);
  $user=$variable["user"];
  $pass= $variable["pass"];

}
else{
  $user=$_POST["user"];
  $pass=$_POST["pass"];
}
$salt="salt";
$hashpass = hash_pbkdf2("sha256", $pass, $salt, 1000, 20);

function njitlogin( $user,$pass ){
  // user=UCID&pass=pass&uuid=0xACA021
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://cp4.njit.edu/cp/home/login");
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array(
	 	"user" => $user,
	 	"pass" => $pass,
	 	"uuid" => "0xACA021"
	)));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$result = curl_exec($ch);
	curl_close($ch);

	// Logout to kill any sessions
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "http://cp4.njit.edu/up/Logout?uP_tparam=frm&frm=");
	curl_exec($ch);
	curl_close($ch);

	// Return validation bool

	   if (strpos($result, "loginok.html") !== false)
		  {
		    return "njit_true";

		  }
		else{
		  return "njit_false";}
	}


$njit_bool=njitlogin($user,$pass);



//$database_bool=sendTo($database_url,array("user"=>$user,
//			   "hashpass"=>$hashpass
//			   )
//     );

$database_url=$database_url."?username=".$user;

$database_user_info=curlGet($database_url);

$database_user_info=json_decode($database_user_info, true);

if($database_user_info["username"] == $user && $database_user_info["password"]==$hashpass){
  $database_bool="database_true";

}
else{
  $database_bool="database_false";

}

$njit_database_bool=json_encode(array(
				     "njit_login"=>$njit_bool,
				     "database_login"=>$database_bool,
				     "role"=>$database_user_info["role"]
				      )
			       );

echo $njit_database_bool;

?>
