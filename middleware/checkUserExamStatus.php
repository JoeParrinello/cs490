<?php
require_once "sendTo.php";

if(isJson(file_get_contents('php://input'))){
  $userData=json_decode(file_get_contents('php://input'), true);
}
else{
  $userData=$_POST;
}
//$userId = $userId["userId"];

//exam that is released
//exam that has a certian student answer
//exam that has no answer from student
//get all of the exams


$AllofTheExams = sendTo("https://web.njit.edu/~sra27/getAllExams.php");
$AllofTheExams = json_decode($AllofTheExams,true);
//echo $AllofTheExams;

//https://web.njit.edu/~jap64/backend/examanswer.php?userId=7
$count=0;
echo "[";

foreach($AllofTheExams as $exam){
  if($exam["released"]=="1"){
    $exam["status"]="released";
  }
  else{
    $userData["examId"]=$exam["examId"];
    //    echo json_encode($userData);
    $ListofCorresponding = json_decode(sendTo("https://web.njit.edu/~sra27/getStudentExam.php", json_encode($userData)),true);
    //echo sendTo("https://web.njit.edu/~sra27/getStudentExam.php", json_encode($userData));
    if(empty($ListofCorresponding)){
      $exam["status"]="nottaken";
    }

    else{
      $exam["status"]="taken";

    }
  }
  if($count > 0){
    echo ",";


  }
  $count++;
  echo json_encode($exam);

}

echo "]";





?>
