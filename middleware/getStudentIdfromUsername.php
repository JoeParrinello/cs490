<?php
require_once 'sendTo.php';
function getStudentIdfromUsername($name)
{

$getUserUrl="https://web.njit.edu/~jap64/backend/user.php";
$getUserUrl=$getUserUrl."?username=".$name;
$SID = curlGet($getUserUrl);
$SID = json_decode($SID,true);
$SID = $SID["id"];

return $SID;
 }

?>
