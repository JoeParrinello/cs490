
<?php
function checkexams($username){
	//$user = $_POST['username'];
	$user = "student";
	$checkexams = array();
	$checkexams["username"] = $user;

	$url ="https://web.njit.edu/~sra27/checkUserExamStatus.php";
	$curlme = curl_init(); 

	$sendthis = json_encode($checkexams);

	curl_setopt($curlme, CURLOPT_URL, $url);
	curl_setopt($curlme, CURLOPT_CUSTOMERREQUEST, "POST");
	curl_setopt($curlme, CURLOPT_POSTFIELDS, $sendthis);
	curl_setopt($curlme, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curlme, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($sendthis)));

	$confdata = curl_exec($curlme);
	curl_close($curlme);

$arrays = json_decode($confdata, true);
	return $arrays;
}
?>




