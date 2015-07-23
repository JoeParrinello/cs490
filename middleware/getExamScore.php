<?php
require_once "sendTo.php";
require_once 'getQuestion.php';

if(isJson(file_get_contents('php://input'))){
  $user_examData=json_decode(file_get_contents('php://input'), true);
}
else{
  $user_examData=$_POST;
}

$ListofAllStudentAnswers = sendTo("https://web.njit.edu/~sra27/getStudentExam.php",json_encode($user_examData));
$ListofAllStudentAnswers = json_decode($ListofAllStudentAnswers,true);



/*
$userId=$exam["userId"];
$metaData["userId"]=$userId;
unset($exam["userId"]);

$examId = $exam["examId"];
$metaData["examId"]=$examId;
unset($exam["examId"]);
*/




$exam_total = 0;
$student_score = 0;

//echo "[";
$count=0;

foreach ($ListofAllStudentAnswers as $student_question_id){
    if($count > 0){
      //  echo ",";
  }

  $questionId=$student_question_id["questionId"];

  $answer=getQuestionfromID($student_question_id["questionId"]);

  $answer=json_decode($answer,true);
  //  $student_answer=$ListofAllStudentAnswers[$questionId];
  //$student_answer=$student_question_id[$questionId];
  $student_answer=$student_question_id;
  //  echo $student_answer["answer"];

  //    echo $student_answer["questionId"];

  //make sure this is a valid
    $exam_total+= $answer["points"];

    //     echo $answer["points"];

  if($student_answer["answer"] == $answer["answer"]){

    $student_score += $answer["points"];
  }

  $Data["questionId"] = $questionId;
  $Data["studentAnswer"] = $student_answer["answer"];
  $Data["correctAnswer"] = $answer["answer"];
  $testjson[$questionId]=json_encode($Data);
  //  echo json_encode($Data);


  $count++;
}

//echo $student_score;
$metaData["userId"]=$user_examData["userId"];
$metaData["examId"]=$user_examData["examId"];
$metaData["grade"] = $student_score/$exam_total;
$metaData=json_encode($metaData);
$testjson["metaData"]=$metaData;
$testjson= json_encode($testjson);
echo $testjson;

//$testjson= json_decode($testjson,true);
//$testjson= json_decode($testjson["metaData"],true);
//echo $testjson["userId"];



//echo "]";


?>
