<?php

session_start();
if($_SESSION['currRole'] == "Student"){
	$inputexams = array();
	$inputexams["examId"] = $_POST["examId"];
	$inputexams["username"] = $_POST["username"];

	$sendthis = array_filter($inputexams);

	$url = "https://web.njit.edu/~sra27/getExamScore.php";
	$curlme = curl_init(); 

	$sendthisone = json_encode($sendthis);

	curl_setopt($curlme, CURLOPT_URL, $url);
	curl_setopt($curlme, CURLOPT_CUSTOMERREQUEST, "POST");
	curl_setopt($curlme, CURLOPT_POSTFIELDS, $sendthisone);
	curl_setopt($curlme, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curlme, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($sendthisone)));

	$confdata = curl_exec($curlme);
	curl_close($curlme);

	$_SESSION['grades']=$confdata;
	header('Location: https://web.njit.edu/~oh7/cs490/frontend/scripts/showGrades.php');

	}
?>

