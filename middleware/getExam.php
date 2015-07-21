<?php
  //can send me the name of the exam to search the database then send back every question in the exam back.
require_once 'sendTo.php';
$Exam_Table_Name_url="";
$Exam_Question_Table="";
//whatever my url is
$get_Question="";
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

$exam = curlGet($examId);
$exam = json_decode($exam);

foreach( $exam as $examQuestionId  ){
  //can curl to my own script and get back a json of that question then add that into an array and send that back as a json
  $jsonofquestion = sendTo($get_Question,$examQuestionId);
  $FullExam[$examQuestionId] = $jsonofquestion;

}
echo $FullExam;




?>
