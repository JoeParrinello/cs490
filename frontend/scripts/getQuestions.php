
<?php

$url ="https://web.njit.edu/~sra27/getAllQuestions.php";
//  Initiate curl
$ch = curl_init();
// Disable SSL verification
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// Will return the response, if false it print the response
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Set the url
curl_setopt($ch, CURLOPT_URL,$url);
// Execute
$result=curl_exec($ch);
// Closing
curl_close($ch);

$arrays = json_decode($result, true);

$totalquests = count($arrays);

echo "<form action='viewQuestions.php' method='POST'>";
echo "<table>";
echo "<tr><td>Add to Test</td><td>Question ID</td><td>Type</td><td>Question</td><td>Correct Answer</td><td>Pts</td><td>MC Choice A</td><td>MC Choice B</td><td>MC Choice C</td><td>MC Choice D</td></tr>";
while ($questionnumber < $totalquests) {

$someArray = json_decode($arrays[$questionnumber], true);
echo "<tr><td>"; 
echo "<input type='checkbox' name='";
echo $questionnumber;
echo "' value='";
echo $someArray["id"];
echo "'>";
echo "</td><td>"; 
echo $someArray["id"];
echo "</td><td>"; 
echo $someArray["format"];
echo "</td><td>"; 
echo $someArray["text"];
echo "</td><td>"; 
echo $someArray["answer"];
echo "</td><td>"; 
echo $someArray["points"];
echo "</td><td>";
if(preg_replace('/[^a-z\d ]/i', '', $someArray["format"]) == "multiple"){ 
echo $someArray["ansa"];
echo "</td><td>"; 
echo $someArray["ansb"];
echo "</td><td>"; 
echo $someArray["ansc"];
echo "</td><td>"; 
echo $someArray["ansd"];
echo "</td></tr>";
} else{
echo "";
echo "</td><td>"; 
echo "";
echo "</td><td>"; 
echo "";
echo "</td><td>"; 
echo "";
echo "</td><td>";
}
 // print_r($someArray);        // Dump all data of the Array
  //echo $someArray["id"];

   $questionnumber = $questionnumber + 1;
}
echo "<input type='submit' name='submit' value='Make Test' />";
echo "</td></tr>";
echo "</table>";
echo "</form>";

?>




