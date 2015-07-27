<?php
require_once "sendTo.php";
require_once "getStudentIdfromUsername.php";
if(isJson(file_get_contents('php://input'))){
  $userData=json_decode(file_get_contents('php://input'), true);
}
else{
  $userData=$_POST;
}



$name = $userData["username"];
/*
$urlforget="https://web.njit.edu/~jap64/backend/user.php";
$urlforget=$urlforget."?username=".$name;
$SID = curlGet($urlforget);
//echo $SID;
$SID = json_decode($SID,true);
$userData["userId"] = $SID["id"];
*/

$userData["userId"] = getStudentIdfromUsername($name);

$AllofTheExams = sendTo("https://web.njit.edu/~sra27/getAllExams.php");
$AllofTheExams = json_decode($AllofTheExams,true);

$count=0;
echo "[";

foreach($AllofTheExams as $exam){
  //  if($exam["released"]=="1"){
  //    $exam["status"]="released";
  //  }
  //  else{
    $userData["examId"]=$exam["examId"];

    $ListofCorresponding = json_decode(sendTo("https://web.njit.edu/~sra27/getStudentExam.php", json_encode($userData)),true);
    if(empty($ListofCorresponding)){
      $exam["status"]="nottaken";
          }
    else{
      $exam["status"]="taken";

    }
    //  }
  if($count > 0){
    echo ",";

  }
  $count++;
  echo json_encode($exam);

}

echo "]";


?>
