<?php

require_once 'sendTo.php';
$Exam_Table_Name_url="https://web.njit.edu/~jap64/backend/exam.php";
$Exam_Question_Table="https://web.njit.edu/~jap64/backend/examquestion.php";

$get_Question="https://web.njit.edu/~sra27/getQuestion.php";
if(isJson(file_get_contents('php://input'))){
  $variable=json_decode(file_get_contents('php://input'), true);
}
else{
  $variable=$_POST;
}

/*
$nameofexam = $variable["name"];

$UrlofGetExam = $Exam_Table_Name_url."?name=".$nameofexam;
$examId = curlGet($UrlofGetExam);
$examId = json_decode($examId,true);
$examId = $examId["examId"];
*/
//now that we have examId we can go to the exam question table and query it

$examId = $variable["examId"];

$UrlofGetExamQuestions = $Exam_Question_Table."?examId=".$examId;

$exam = curlGet($UrlofGetExamQuestions);
$exam = json_decode($exam,true);


foreach( $exam as $examQuestionId  ){
  $examQuestionId["id"] = $examQuestionId["questionId"];
  $ID=$examQuestionId["id"];
  $examQuestionId = json_encode($examQuestionId);
  $jsonofquestion = sendTo($get_Question,$examQuestionId);

  $FullExam[$ID] = $jsonofquestion;

}

echo json_encode($FullExam);




?>
