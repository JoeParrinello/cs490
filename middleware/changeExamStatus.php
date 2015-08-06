<?php

require_once "sendTo.php";

if(isJson(file_get_contents('php://input'))){
    $examId=json_decode(file_get_contents('php://input'), true);
}
else{
  $examId=$_POST;
}

echo curlPut("https://web.njit.edu/~jap64/backend/exam.php",$examId);



?>
