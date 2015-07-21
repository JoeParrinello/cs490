<?php
require_once "sendTo.php";
require_once "getQuestion.php";
$Exam_Table_Name_url="";
$Exam_Question_Table="";
if(isJson(file_get_contents('php://input'))){
  $exam=json_decode(file_get_contents('php://input'), true);
}
else{
  $exam=$_POST;
}

echo $exam["1"];
//can have an exam name or something send to the databsae and get the id back
//may have to change some of the keys again...
$Exam_Id = sendTo($Exam_Table_url,$exam);
$Exam_Id = json_decode($Exam_Id,true);
$Exam_Id = $Exam_ID["id"];

unset($exam["name"]);

//sends 2 values to the table the exam id that we get back from the first sendTo and the questionId.
foreach($exam as $examquestionId){

  $examQuestionId["ExamId"]=$Exam_Id;

  sendTo($Exam_Question_Table,$examquestionId);

}


?>
