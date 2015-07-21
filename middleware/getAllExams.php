<?php
  //sends back all of the name
require_once "sendTo.php";
$getExam_url="";

$exam = curlGet($url);
$exam = json_decode($exam,true);

foreach($exam as $examidname){
  $examidname=json_decode($examidname,true);
  $AllName[$examidname["Exam_Id"]] = $examidname["name"];


}
echo $AllName;

//echo $exam["name"];

?>
