<?php

function sendTo($url,$postdata){
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
//curl_setopt($ch, CURLOPT_HEADER, false);
$output = curl_exec($ch);
curl_close($ch);
echo $output;
}



?>
