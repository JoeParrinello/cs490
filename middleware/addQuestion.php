<?php
require_once 'sendTo.php';

$question_url="https://web.njit.edu/~jap64/backend/question.php";
$addChoice_url="https://web.njit.edu/~jap64/backend/choiceAnswer.php";

$variable=json_decode(file_get_contents('php://input'), true);

switch($variable["type"]){
case "short":
case "truefalse":

  $question=prepareForDatabase($variable);

  sendTo_NDT($question_url,$question);

    break;


case "multiple":

  $question=prepareForDatabase($variable);

  $ID = sendTo($question_url,$question);
  $ID = json_decode($ID,true);
  $ID = $ID["id"];

  sendToChoiceDatabase($variable,"A",$ID);
  sendToChoiceDatabase($variable,"B",$ID);
  sendToChoiceDatabase($variable,"C",$ID);
  sendToChoiceDatabase($variable,"D",$ID);



  break;
}

function prepareForDatabase($variable){
  $question=$variable;
  $question["format"] = $variable["type"];
  $question["answer"]=$variable["correctans"];


  return $question;

}
//Possible option letter A B C D
function sendToChoiceDatabase($variable,$optionLetter,$ID){
  global $addChoice_url;
  $choice["choice"]=$optionLetter;
  $answerLetter="ans".strtolower($optionLetter);
  $choice["text"] = $variable["$answerLetter"];
  $choice["questionId"] = $ID;
  sendTo_NDT($addChoice_url,$choice);

  return 1;
}


?>
