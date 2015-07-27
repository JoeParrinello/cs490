<?php

	$examId = $_POST["examId"];
	$user = $_POST['username'];
	$inputexams = array();
	$inputexams["examId"] = $examId;

	$url = "https://web.njit.edu/~sra27/getExam.php";
	$curlme = curl_init(); 

	$sendthis = json_encode($inputexams);

	curl_setopt($curlme, CURLOPT_URL, $url);
	curl_setopt($curlme, CURLOPT_CUSTOMERREQUEST, "POST");
	curl_setopt($curlme, CURLOPT_POSTFIELDS, $sendthis);
	curl_setopt($curlme, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curlme, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($sendthis)));

	$confdata = curl_exec($curlme);
	curl_close($curlme);

$arrays = json_decode($confdata, true);

$questionnumber = 0;
$totalquests = count($arrays);
$inputqty = array();

$inputqty["examId"] = $examId;
$inputqty["username"] = $user;

foreach ($arrays as $key => $values) {
	$inputqty[$key] = $_POST[$key];
}

$encodeanswers = array_filter($inputqty);

	$url = "https://web.njit.edu/~sra27/addStudentAnswer.php";
	$curlme = curl_init(); 

	$sendanswers = json_encode($encodeanswers);

	curl_setopt($curlme, CURLOPT_URL, $url);
	curl_setopt($curlme, CURLOPT_CUSTOMERREQUEST, "POST");
	curl_setopt($curlme, CURLOPT_POSTFIELDS, $sendanswers);
	curl_setopt($curlme, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curlme, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($sendanswers)));

	$confdata = curl_exec($curlme);
	curl_close($curlme);

header('Location: https://web.njit.edu/~oh7/cs490/frontend/student/stutaketest.php');
?>
