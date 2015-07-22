<?php
require_once 'sendTo.php';
require_once 'getQuestion.php';

//Will probably need student identifier ,student answers from a new table, exam id so i can get the answers then i can grade and insert received , total ,percentage2
if(isJson(file_get_contents('php://input'))){
  $exam=json_decode(file_get_contents('php://input'), true);
}
else{
  $exam=$_POST;
}
//replace with whatever the sid key is
$SID=$exam["userId"];
unset($exam["userId"]);

$ExamID = $exam["examId"];
unset($exam["examId"]);

$exam_total = 0;
$student_score = 0;
//foreach ($exam as $questionId => $student_answer){
foreach ($exam as $questionId => $student_answer){
  //echo $questionId;
  //echo $student_answer;
  $answer=getQuestionfromID($questionId);
  $exam_total += $answer["points"];
  if($student_answer == $answer["answer"]){
    $student_score += $answer["points"];
  }
  //send to student answer to database for reference

  sendTostudentExamAnswerTable($SID,$ExamID,$questionId,$student_answer);

}
$fin["userId"]=$SID;
$fin["examId"]=$ExamID;
//$fin["studentscore"]=$student_score;
//$fin["examtotal"]=$exam_total;
//$fin["studentshow"]="false";



function sendTostudentExamAnswerTable($SID,$ExamId,$QuestionId,$Answer){
  $studentExamAnswerTable="https://web.njit.edu/~jap64/backend/examanswer.php";
  $SendingData["userId"]=$SID;

  $SendingData["examId"]=$ExamId;

  $SendingData["questionId"]="$QuestionId";
  //echo $QuestionId;
  $SendingData["answer"]=$Answer;
  //echo $Answer;
  //   $SendingData=json_encode($SendingData);

  sendto($studentExamAnswerTable,$SendingData);



}

?>
