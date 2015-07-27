<?php

require_once "sendTo.php";
$getExam_url="https://web.njit.edu/~jap64/backend/exam.php";

$exam = curlGet($getExam_url);
echo $exam;


?>
