<?php
require_once "sendTo.php";
require_once "getQuestion.php";
$Exam_Table_Name_url="https://web.njit.edu/~jap64/backend/exam.php";
$Exam_Question_Table="https://web.njit.edu/~jap64/backend/examquestion.php";
if(isJson(file_get_contents('php://input'))){
  $exam=json_decode(file_get_contents('php://input'), true);
}
else{
  $exam=$_POST;
}

$Exam_Id = sendTo($Exam_Table_Name_url,$exam);
$Exam_Id = json_decode($Exam_Id,true);
$Exam_Id = $Exam_Id["examId"];


unset($exam["name"]);

//sends 2 values to the table the exam id that we get back from the first sendTo and the questionId.
echo json_encode($exam);
foreach($exam as $examQuestionId){
  $ExamInfo["examId"]=$Exam_Id;
  $ExamInfo["questionId"]=$examQuestionId;

  sendTo($Exam_Question_Table,$ExamInfo);

}


?>
