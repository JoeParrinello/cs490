<?php
require_once 'sendTo.php';
require_once 'getQuestion.php';
require_once 'getStudentIdfromUsername.php';
if(isJson(file_get_contents('php://input'))){
  $exam=json_decode(file_get_contents('php://input'), true);
}
else{
  $exam=$_POST;
}

$name = $exam["username"];
unset($exam["username"]);


/*
$urlforget="https://web.njit.edu/~jap64/backend/user.php";

$urlforget=$urlforget."?username=".$name;
$SID = curlGet($urlforget);
$SID = json_decode($SID,true);

$SID = $SID["id"];*/
$SID = getStudentIdfromUsername($name);

$ExamID = $exam["examId"];
unset($exam["examId"]);

foreach ($exam as $questionId => $student_answer){

  sendTostudentExamAnswerTable($SID,$ExamID,$questionId,$student_answer);

}


function sendTostudentExamAnswerTable($SID,$ExamId,$QuestionId,$Answer){
  $studentExamAnswerTable="https://web.njit.edu/~jap64/backend/examanswer.php";
  $SendingData["userId"]=$SID;
  $SendingData["examId"]=$ExamId;
  $SendingData["questionId"]="$QuestionId";
  $SendingData["answer"]=$Answer;

  sendto($studentExamAnswerTable,$SendingData);



}

?>
