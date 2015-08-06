<?php
require_once "sendTo.php";
require_once 'getQuestion.php';
require_once "getStudentIdfromUsername.php";
if(isJson(file_get_contents('php://input'))){
  $user_examData=json_decode(file_get_contents('php://input'), true);
}
else{
  $user_examData=$_POST;
  }


$name = $user_examData["username"];
$user_examData["userId"] = getStudentIdfromUsername($name);

$ListofAllStudentAnswers = sendTo("https://web.njit.edu/~sra27/getStudentExam.php",json_encode($user_examData));
$ListofAllStudentAnswers = json_decode($ListofAllStudentAnswers,true);

$examId=$user_examData["examId"];

$exam_total = 0;
$student_score = 0;

$count=0;

foreach ($ListofAllStudentAnswers as $student_question_id){

  $questionId=$student_question_id["questionId"];

  $answer=getQuestionfromID($student_question_id["questionId"]);

  $answer=json_decode($answer,true);

  $student_answer=$student_question_id;

  $examQuestionUrl = "https://web.njit.edu/~jap64/backend/examquestion.php?examId=".$examId."&questionId=".$questionId;
  $examQuestion = curlGet($examQuestionUrl);

  $examQuestion = json_decode($examQuestion,true);

  $points = $examQuestion["0"];

  $points = $points["points"];
  $exam_total += $points;

    if(strtolower($student_answer["answer"]) == strtolower($answer["answer"])){

      $student_score += $points;

  }

  $Data["questionId"] = $questionId;
  $Data["studentAnswer"] = $student_answer["answer"];
  $Data["correctAnswer"] = $answer["answer"];
  $Data["text"] = $answer["text"];
  $Data["format"] = $answer["format"];
  $testjson[$questionId]=json_encode($Data);

  $count++;
}


$metaData["userId"]=$user_examData["userId"];
$metaData["examId"]=$user_examData["examId"];
$metaData["grade"] = ($student_score/$exam_total) * 100;
$metaData=json_encode($metaData);
$testjson["metaData"]=$metaData;
$testjson= json_encode($testjson);

echo $testjson;


?>
