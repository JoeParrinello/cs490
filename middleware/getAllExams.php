<?php
  //sends back all of the name
require_once "sendTo.php";
$getExam_url="https://web.njit.edu/~jap64/backend/exam.php";

$exam = curlGet($getExam_url);
echo $exam;
/*
$exam = json_decode($exam,true);

foreach($exam as $examidname){
  $examidname=json_decode($examidname,true);
  $AllName[$examidname["Exam_Id"]] = $examidname["name"];


}
echo $AllName;*/

//echo $exam["name"];

?>
