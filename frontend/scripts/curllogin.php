<?php
function loginAuth($user, $pass){
session_start();
	$user = $_POST['user'];
	$pass = $_POST['pass'];

	$url = "https://web.njit.edu/~sra27/njitlogin.php";
	session_start();
	$curlme = curl_init();

    $logincred = array('user' => $user,'pass' => $pass );

	$passdata = json_encode($logincred);

	curl_setopt($curlme, CURLOPT_URL, $url);
	curl_setopt($curlme, CURLOPT_CUSTOMERREQUEST, "POST");
	curl_setopt($curlme, CURLOPT_POSTFIELDS, $passdata);
	curl_setopt($curlme, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curlme, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($passdata)));

	$auth = curl_exec($curlme);
	curl_close($curlme);

	$auth_decoded = json_decode($auth, true);
		$njitlog= $auth_decoded["njit_login"];
		$dblog= $auth_decoded["database_login"];
		$role= $auth_decoded["role"];

	if ( $njitlog == "njit_true" AND $dblog =="database_false") {
		echo "NJIT Login     : ".$user." is Vaild<br/>";
		echo "Testopia Login : ".$user." is Invaild";
		$loginstate = "bad";
	} elseif ( $njitlog == "njit_false" AND $dblog =="database_true") {
		echo "Welcome ".$role." !<br/>";
		echo "NJIT Login     : ".$user." is Invaild<br/>";
		echo "Testopia Login : ".$user." is Valid";
		$loginstate = "good";
	} else {
		echo "NJIT Login     : ".$user." is Invalid<br/>";
		echo "Testopia Login : ".$user." is Invalid";
		$loginstate = "bad";
	}

	if ($loginstate == "good"){
		loginRedirect($user, $role);
		$_SESSION['currUser'] = $user;
		$_SESSION['currRole'] = $role;
	} else {
		echo "<br/>Error. Please Try Again.";
	}

}

function loginRedirect($user, $role){
	if ($role == "Instructor"){
		header('Location: https://web.njit.edu/~oh7/cs490/frontend/instructor/inshome.php');
	} elseif ($role == "Student") {
		header('Location: https://web.njit.edu/~oh7/cs490/frontend/student/stuhome.php');
	}
}

function addthis($type, $text, $ansa, $ansb, $ansc, $ansd, $correctans, $points){
	$type = $_POST['type'];
	$text = $_POST['text'];
	$ansa = $_POST['ansa'];
	$ansb = $_POST['ansb'];
	$ansc = $_POST['ansc'];
	$ansd = $_POST['ansd'];
	$correctans = $_POST['correctans'];
	$points = $_POST['points'];

	$url = "https://web.njit.edu/~sra27/addQuestion.php";
	$curlme = curl_init();

   	 $addquestion = array(
				   "type"=>$type,
				   "text"=>$text,
				   "ansa"=>$ansa,
				   "ansb"=>$ansb,
				   "ansc"=>$ansc,
				   "ansd"=>$ansd,
				   "correctans"=>$correctans,
				   "points"=> $points
				   );
	$addedquestion = json_encode($addquestion);

	curl_setopt($curlme, CURLOPT_URL, $url);
	curl_setopt($curlme, CURLOPT_CUSTOMERREQUEST, "POST");
	curl_setopt($curlme, CURLOPT_POSTFIELDS, $addedquestion);
	curl_setopt($curlme, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curlme, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($addedquestion)));

	$confdata = curl_exec($curlme);
	curl_close($curlme);

	echo "Question Added to Database.";
}

?>
