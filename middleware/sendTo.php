<?php

function sendTo($url,$postdata){
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch, CURLOPT_HEADER, false);
$output = curl_exec($ch);
curl_close($ch);
return $output;
}

//Send to with no return data will return 1 if successful
function sendTo_NDT($url,$postdata){
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,false);
curl_setopt($ch, CURLOPT_HEADER, false);
$output = curl_exec($ch);
curl_close($ch);
return $output;
}
function isJson($string) {
 json_decode($string);
 return (json_last_error() == JSON_ERROR_NONE);
}

?>
