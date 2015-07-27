<?php
	session_start();
	if($_SESSION['currRole'] == "Student"){
		
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Testopia | Taking A Test </title>

	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
		<header>
			<stong>Testopia | You are Taking a Test Now. (CS490) </stong>
								<?php 
				echo "UCID: ".$_SESSION['currUser']." | Permissions: ".$_SESSION['currRole'];  
			 ?>
		</header>
						<nav>
			<label for="show-menu" class="show-menu">Show Menu</label>
		<input type="checkbox" id="show-menu" role="button" style="opacity:0;">
		<ul id="menu" align="center">
					<li><a href="stuhome.php">Student Home</a></li>
					<li><a href="sturegclasses.php">View Classes</a></li>
					<li><a href="stutaketest.php"> Take Test</a></li>
					<li><a href="stugrades.php">View Grades</a></li>
					<li><a href="stututorial.php">Tutorials</a></li>
					<li><a href="stuabout.php">About Testopia</a></li>
					<li><a href="stucontact.php">Contact Us</a></li>
					<li><a href="../index.php">Logout</a></li>
			</ul>
			</nav>
			<section>
				<strong>Welcome Student, you may start your test below.</strong>

<?php

$url ="https://web.njit.edu/~oh7/cs490/frontend/scripts/transferExamQuestions.php";
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
$testid = "201";
echo "<form action='../scripts/viewAnswered.php' method='POST'>";
echo "<table>";
echo "<input type='hidden' name='username' value='";
echo $_SESSION['currUser']."'>";
echo "<input type='hidden' name='testid' value='";
echo $testid."'>";

while ($questionnumber < $totalquests) {

$someArray = json_decode($arrays[$questionnumber], true);
if (preg_replace('/[^a-z\d ]/i', '', $someArray["format"]) == "multiple"){
	echo "<table><tr><td>Question # " . $questionnumber. " at ".$someArray["points"]." points</td>";
		echo "<td>". $someArray["text"]."</td>";
		echo "<select id='question' name='";
		echo $someArray["id"];
		echo "' style='width: 220px;'>";
		echo "<option value='A'>";
		echo $someArray["ansa"];
		echo "</option>";
		echo "<option value='B'>";
		echo $someArray["ansb"];
		echo "</option>";
		echo "<option value='C'>";
		echo $someArray["ansc"];
		echo "</option>";
		echo "<option value='D'>";
		echo $someArray["ansd"];
		echo "</option></select>";
		echo "</tr></table>";
} elseif(preg_replace('/[^a-z\d ]/i', '', $someArray["format"]) == "short"){
	echo "<table><tr><td>Question # " . $questionnumber." at ".$someArray["points"]." points</td>";
		echo "<td>". $someArray["text"]."</td>";
			
	echo "</tr></table>";
} elseif(preg_replace('/[^a-z\d ]/i', '', $someArray["format"]) == "truefalse"){
	echo "<table><tr><td>Question # " . $questionnumber." at ".$someArray["points"]." points</td>";
		echo "<td>". $someArray["text"]."</td>";
		echo "<select id='question' name='";
		echo $someArray["id"];
		echo "' style='width: 220px;'>";
		echo "<option value='True'>True</option>";
		echo "<option value='False'>False</option></select>";
	echo "</tr></table>";
}

   $questionnumber = $questionnumber + 1;
}
echo "<input type='submit' name='submit' value='Submit Test' />";
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
</php>