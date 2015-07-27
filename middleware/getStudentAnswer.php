<?php
//need student Id and exam name or exam id
require_once "sendTo.php";
if(isJson(file_get_contents('php://input'))){
  $Id=json_decode(file_get_contents('php://input'), true);
}
else{
  $Id=$_POST;
}

$userId=$Id["userId"];

if(isset($Id["name"])){
$nameofexam = $Id["name"];
$Exam_Table_Name_url="https://web.njit.edu/~jap64/backend/exam.php";

$UrlofGetExam = $Exam_Table_Name_url."?name=".$nameofexam;

$examId = curlGet($UrlofGetExam);
$examId = json_decode($examId,true);
$examId = $examId["examId"];
}
else{
  $examId=$Id["examId"];

}

$getUrl="https://web.njit.edu/~jap64/backend/examanswer.php";
$getUrl = $getUrl."?examId=".$examId."&userId=".$userId;
echo curlGet($getUrl);

?>
