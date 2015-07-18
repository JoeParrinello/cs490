<?php
  //need to find a common ground for how to send all of the questions so oliver can display for the instructor to display them. was thinking of sending a json json and making the get all request a seperate php.
require_once 'sendTo.php';
//In case of shenanigans
if($_SERVER["CONTENT_TYPE"]=="application/json"){
  $variable=json_decode(file_get_contents('php://input'), true);
}
else{
  $variable=$_POST;
}

if(isset($variable["id"])){
  $question=getQuestionfromID($question["id"]);
}
else{
  echo "No id received";
}

switch($question["format"]){
case "short":
case "truefalse":
  //sends back json
  echo $question;

break;

case "multiple":
  // choiceAnswer.php questionId option text
  //$all_choices=getAnswerChoiceformDB($variable["questionId"]); prepare the data in the way oliver wants may have to extract from both variables and make new one
  $answerChoices=getAnswerChoicefromDB($ID);

  $fullMultipleChoiceJson=prepareMultipleChoice($question,$answerChoices);

  echo $fullMultipleChoiceJson;

  break;

}
//Do not know how I am receiving the data. I assume he is only sending one row to me because no while loop which may be wrong so the best thing to do is to have the choice as the key and the text as the key entry then json echio that to me for extraction and sending to front.
function prepareMultipleChoice($question,$answerChoices){
  while(isJson($answerChoices)){
    $answerChoices=json_decode($answerChoices,true);
  }
  foreach ($answerChoices as $choice=>$answer){
    if($choice=="A"||$choice=="B"||$choice=="C"||$choice=="D"){
      $question["$choice"]=$answer;
    }
  }

  return json_encode($question);
}

function getQuestionfromID($ID){
  //make sure actual database
  $question_database_url="https://web.njit.edu/~jap64/backend/question.php";
  $question_database_url=$question_database_url."?id=".$ID;
  $question=curlGet($question_database_url);
  //a json
  return $question;
}
//wait until certain how getting data back maybe a json of a set of jsons
function getAnswerChoicefromDB($ID){
  $question_database_url="https://web.njit.edu/~jap64/backend/choiceAnswer.php";
  $question_database_url=$question_database_url."?questionId=".$ID;
  $question=curlGet($question_database_url);
  //a json
  return $question;


}

function getAllQuestionsfromDB(){
  $question_database_url="https://web.njit.edu/~jap64/backend/question.php";
  $question=curlGet($question_database_url);
  //a json json
  return $question;



}






?>
