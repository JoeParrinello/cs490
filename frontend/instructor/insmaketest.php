<?php
session_start();
if($_SESSION['currRole'] == "Instructor"){
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Testopia | Make Test </title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
		<header>
			<stong>Testopia | Make Test (CS490) </stong>
															<?php 
				echo "UCID: ".$_SESSION['currUser']." | Permissions: ".$_SESSION['currRole'];  
			 ?>
		</header>
			<nav>
		<label for="show-menu" class="show-menu">Show Menu</label>
		<input type="checkbox" id="show-menu" role="button" style="opacity:0;">
		<ul id="menu" align="center">
					<li><a href="inshome.php">Instructor Home</a> </li>
					<li><a href="insmaketest.php">Make Test</a> </li>
					<li><a href="instests.php">Tests</a> </li>
					<li><a href="inscreate.php">Add a Question</a> </li>
					<li><a href="insgrades.php">Grades</a> </li>
					<li><a href="instutorial.php">Tutorials</a> </li>
					<li><a href="insabout.php">About Testopia</a> </li>
					<li><a href="inscontact.php">Contact Us</a> </li>
					<li><a href="../scripts/logout.php">Logout</a> </li>
				</ul>
			<section>
				<strong>Make a Test by selecting and submitting the deseried questions.</strong>

				<?php

$url ="https://web.njit.edu/~oh7/cs490/frontend/scripts/transferQuestions.php";
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

echo "<form action='../scripts/viewQuestions.php' method='POST'>";
echo "<table>";
echo "<td><input type='text' name='testname' id='testname' placeholder='Name of Test'/></td>";
echo "<tr><td>Add to Test</td><td>Question ID</td><td>Type</td><td>Question</td><td>Correct Answer</td><td>Pts</td><td>MC Choice A</td><td>MC Choice B</td><td>MC Choice C</td><td>MC Choice D</td></tr>";


$totalquests = count($arrays);
$questionnumber = 0;

while ($questionnumber < $totalquests) {
$someArray = $arrays[$questionnumber];
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

echo "<tr><td><input type='submit' name='submit' value='Make Test' /></tr></td>";
echo "</td></tr>";
echo "</table>";
echo "</form>";

?>
		</section>
		
</body>
<?php
} else {
	echo "ERROR: Access Denied <br/> You do not have access to this page. Please try to login, if the error presists, contact the system administration.<br/>";
}
?>
