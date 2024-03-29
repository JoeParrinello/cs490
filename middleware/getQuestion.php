<?php
require_once 'sendTo.php';

if(isJson(file_get_contents('php://input'))){
  $variable=json_decode(file_get_contents('php://input'), true);

}
else{
  $variable=$_POST;
}
if(isset($variable["id"])){
  $question=getQuestionfromID($variable["id"]);
  $question=json_decode($question,true);

}

$ID=$question["id"];
$ID="$ID";
switch($question["format"]){

case "short":
case "truefalse":
  //sends back json
  echo json_encode($question);

break;

case "multiple":

  $answerChoices=getAnswerChoicefromDB($ID);

  $fullMultipleChoiceJson=prepareMultipleChoice($question,$answerChoices);

  echo $fullMultipleChoiceJson;

  break;

}


function prepareMultipleChoice($question,$answerChoices){
  $answerChoices=json_decode($answerChoices,true);

  foreach( $answerChoices as $choice=>$answer){

    $multiplechoice="ans".strtolower($answer["choice"]);
    $question[$multiplechoice]=$answer["text"];

  }

  $fullanswer = json_encode($question);
  return $fullanswer;

}

function getQuestionfromID($ID){

  $question_database_url="https://web.njit.edu/~jap64/backend/question.php";
  $question_database_url=$question_database_url."?id=".$ID;
  $question=curlGet($question_database_url);
  //a json
  return $question;
}

function getAnswerChoicefromDB($ID){
  $question_database_url="https://web.njit.edu/~jap64/backend/choiceAnswer.php";
  $question_database_url=$question_database_url."?questionId=".$ID;
  $question=curlGet($question_database_url);
  //a json
  return $question;

}
function getAllQuestionsfromDB($difficulty){
  if($difficulty == "Easy"){
    $question_database_url="https://web.njit.edu/~jap64/backend/question.php?difficulty=Easy";
  }
  elseif($difficulty == "Medium"){
    $question_database_url="https://web.njit.edu/~jap64/backend/question.php?difficulty=Medium";
  }
  elseif($difficulty == "Hard"){
    $question_database_url="https://web.njit.edu/~jap64/backend/question.php?difficulty=Hard";
  }
  else {
    $question_database_url="https://web.njit.edu/~jap64/backend/question.php";
  }

  $allQuestions=curlGet($question_database_url);
  $allQuestions=json_decode($allQuestions,true);
  $count=0;

  echo "[";
  foreach($allQuestions as $question){
    if($count > 0){
      echo ",";

    }
    if($question["format"]=="multiple"){
      $answerChoices=getAnswerChoicefromDB($question["id"]);

      $fullanswer=prepareMultipleChoice($question,$answerChoices);

      echo $fullanswer;
    }
    else{
      echo json_encode($question);

    }

    $count++;
  }

  echo "]";


}


?>
