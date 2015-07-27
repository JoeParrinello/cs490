<?php
$url ="https://web.njit.edu/~sra27/getAllQuestions.php";
//  Initiate curl
$ch = curl_init();
// Disable SSL verification
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// Will return the response, if false it print the response
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Set the url
curl_setopt($ch, CURLOPT_URL,$url);
// Execute
$result=curl_exec($ch);
// Closing
curl_close($ch);

$arrays = json_decode($result, true);

$questionnumber = 0;
$totalquests = count($arrays);
$inputqty = array();
$testname = $_POST['testname'];
$inputqty["name"] = $testname;
while ($questionnumber < $totalquests) {
	$inputqty[$questionnumber] = $_POST[$questionnumber];
   $questionnumber = $questionnumber + 1;
}
$sendthis = array_filter($inputqty);

	$url = "https://web.njit.edu/~sra27/addExam.php";
	$curlme = curl_init(); 

	$sendthisone = json_encode($sendthis);

	curl_setopt($curlme, CURLOPT_URL, $url);
	curl_setopt($curlme, CURLOPT_CUSTOMERREQUEST, "POST");
	curl_setopt($curlme, CURLOPT_POSTFIELDS, $sendthisone);
	curl_setopt($curlme, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curlme, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($sendthisone)));

	$confdata = curl_exec($curlme);
	curl_close($curlme);
		header('Location: https://web.njit.edu/~oh7/cs490/frontend/instructor/insmaketest.php');

?>
