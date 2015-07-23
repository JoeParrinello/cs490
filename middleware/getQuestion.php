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
  //  echo $question;
  //  echo $answerChoices;
  $answerChoices=json_decode($answerChoices,true);
    //$question=json_decode($question,true);
  //  echo $question;

    foreach( $answerChoices as $choice=>$answer){

    $multiplechoice="ans".strtolower($answer["choice"]);
    //    echo $multiplechoice;
    $question[$multiplechoice]=$answer["text"];

  }

  $fullanswer = json_encode($question);
  //echo $fullanswer;
      return $fullanswer;

}

function getQuestionfromID($ID){
  //make sure actual database
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
function getAllQuestionsfromDB(){
  $question_database_url="https://web.njit.edu/~jap64/backend/question.php";
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
      //  echo $answerChoices;
      //      echo $question;
      $fullanswer=prepareMultipleChoice($question,$answerChoices);

	//echo $fullanswer;

      echo $fullanswer;
      //      $allQuestionsformated[$count] = $fullanswer;

      foreach($allQuestionsformated as $value){
	//	echo $value;

	  }

      //      echo json_decode($allQuestionformated,true);

    }
        else{
	  echo json_encode($question);
	  //      $allQuestionsformated[$count] = $question;
    }

          $count++;
  }

  echo "]";


    //    echo json_decode($allQuestionsformated);
  //a json json
  //  return json_encode($allQuestionsformated);
  //  return ($allQuestionsformated);

}


?>
