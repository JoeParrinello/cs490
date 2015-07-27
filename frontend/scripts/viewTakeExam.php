<?php

session_start();
if($_SESSION['currRole'] == "Student"){
	$examId = $_POST["examId"];

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

	$_SESSION['examquestions']=$confdata;
	header('Location: https://web.njit.edu/~oh7/cs490/frontend/scripts/showTakeExam.php');
}
?>