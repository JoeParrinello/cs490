<?php
require_once "sendTo.php";

if(isJson(file_get_contents('php://input'))){
  $Id=json_decode(file_get_contents('php://input'), true);
}
else{
  $Id=$_POST;
}

$getUrl="https://web.njit.edu/~jap64/backend/examanswer.php";


$getUrl=$getUrl."?userId=".$Id["userId"];

if(!isset($Id["examId"])){
echo curlGet($getUrl);
}

else{

  $getUrl=$getUrl."&examId=".$Id["examId"];
  echo curlGet($getUrl);
}

?>
