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
$SID=$exam["SID"];
unset($exam["SID"]);

$ExamID = $exam["ExamId"];
unset($exam["ExamId"]);

$exam_total = 0;
$student_score = 0;
foreach ($exam as $questionId => $student_answer){
  $answer=getQuestionfromID($questionId);
  $exam_total+= $answer["points"];
  if($student_answer == $answer["answer"]){
    $student_score += $answer["points"];
  }

}
$fin["SID"]=$SID;
$fin["ExamId"]=$ExamID;
$fin["studentscore"]=$student_score;
$fin["examtotal"]=$exam_total;
$fin["studentshow"]="false";
sendTo_NDT($urlof,$fin );



?>
