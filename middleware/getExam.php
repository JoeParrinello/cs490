<?php
  //can send me the name of the exam to search the database then send back every question in the exam back.
require_once 'sendTo.php';
$Exam_Table_Name_url="https://web.njit.edu/~jap64/backend/exam.php";
$Exam_Question_Table="https://web.njit.edu/~jap64/backend/examquestion.php";
//whatever my url is
$get_Question="https://web.njit.edu/~sra27/getQuestion.php";
if(isJson(file_get_contents('php://input'))){
  $variable=json_decode(file_get_contents('php://input'), true);
}
else{
  $variable=$_POST;
}

$nameofexam = $variable["name"];

$UrlofGetExam = $Exam_Table_Name_url."?name=".$nameofexam;
$examId = curlGet($UrlofGetExam);
$examId = json_decode($examId,true);
$examId = $examId["examId"];

//now that we have examId we can go to the exam question table and query it

$UrlofGetExamQuestions = $Exam_Question_Table."?examId=".$examId;
//returns a json of a json
$exam = curlGet($UrlofGetExamQuestions);
$exam = json_decode($exam,true);
//echo array_keys($exam);

foreach( $exam as $examQuestionId  ){
  //can curl to my own script and get back a json of that question then add that into an array and send that back as a json
  //  echo $examQuestionId["questionId"];
  $examQuestionId["id"] = $examQuestionId["questionId"];
  //echo $examQuestionId["id"];
  $ID=$examQuestionId["id"];
  $examQuestionId = json_encode($examQuestionId);
  $jsonofquestion = sendTo($get_Question,$examQuestionId);
  //echo $jsonofquestion;


  $FullExam[$ID] = $jsonofquestion;

}

echo json_encode($FullExam);




?>
