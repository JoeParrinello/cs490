<?php
require_once 'sendTo.php';
//getting from html
//text
//ansa  if truefalse or short this has answer
//ansb
//ansc
//ansd
//correctans
//type
//points

//change to actual database
$question_url="https://web.njit.edu/~sra27/questiontest.php";
$addChoice_url="https://web.njit.edu/~sra27/addChoicetest.php";
//$question_url="https://web.njit.edu/~jap64/backend/question.php";
//$addChoice_url="https://web.njit.edu/~jap64/backend/choiceAnswer.php";

$variable=json_decode(file_get_contents('php://input'), true);

switch($variable["type"]){
case "short":
case "truefalse":
  //send format question point value and correctans get back nothing
  $question=prepareForDatabase($variable);
  sendTo_NDT($question_url,$question);
  break;

case "multiple":
  //send type ans
  //send type correctans pointvalue format
  //getback id

  $question=prepareForDatabase($variable);

  $ID = sendTo($question_url,$question);
  $ID = json_decode($ID,true);

  //send option value text of the option and question ID get back nothing

  sendToChoiceDatabase($variable,"A");
  sendToChoiceDatabase($variable,"B");
  sendToChoiceDatabase($variable,"C");
  sendToChoiceDatabase($variable,"D");



  break;
}

function prepareForDatabase($variable){
  $question=$variable;
  $question["format"] = $variable["type"];
  // maybe makes sense the other way tho
  //$question["answer"]=$variable["ansa"];
  $question["answer"]=$variable["correctans"];

  return $question;

}
//Possible option letter A B C D
function sendToChoiceDatabase($variable,$optionLetter){
  global $addChoice_url;
  global $ID;
  $choice["option"]=$optionLetter;
  $answerLetter="ans".strtolower($optionLetter);
  $choice["text"] = $variable["$answerLetter"];
  $choice["questionId"] = $ID["questionId"];

    sendTo_NDT($addChoice_url,$choice);

  return 1;
}


?>
