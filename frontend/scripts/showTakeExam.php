
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
					<li><a href="../student/stuhome.php">Student Home</a></li>
					<li><a href="../student/sturegclasses.php">View Classes</a></li>
					<li><a href="../student/stutaketest.php"> Take Test</a></li>
					<li><a href="../student/stugrades.php">View Grades</a></li>
					<li><a href="../student/stututorial.php">Tutorials</a></li>
					<li><a href="../student/stuabout.php">About Testopia</a></li>
					<li><a href="../student/stucontact.php">Contact Us</a></li>
					<li><a href="../index.php">Logout</a></li>
			</ul>
			</nav>
			<section>
				<strong>Welcome Student, you may start your test below.</strong>

<?php
$confdata=$_SESSION['examquestions'];
$arrays = json_decode($confdata, true);

echo "<form action='../scripts/viewAnswered.php' method='POST'>";
echo "<table>";
echo "<input type='hidden' name='username' value='";
echo $_SESSION['currUser']."'>";
echo "<input type='hidden' name='examId' value='";
echo $examId."'>";


$questionnumber = 0;

foreach ($arrays as $key => $values) {
	$questionnumber = $questionnumber +1;
	$someArray = json_decode($values, true);
if (preg_replace('/[^a-z\d ]/i', '', $someArray["format"]) == "multiple"){
	echo "<table><tr><td>Question # " . $questionnumber. " at ".$someArray["points"]." points</td>";
		echo "<td>". $someArray["text"]."</td>";
		echo "<td>". "<select id='question' name='";
		echo $someArray["id"];
		echo "' style='width: 220px;' required>";
		echo "<option value =''>Select Answer</option>";
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
		echo "</option></select></td>";
		echo "</tr></table>";
} elseif(preg_replace('/[^a-z\d ]/i', '', $someArray["format"]) == "short"){
	echo "<table><tr><td>Question # " . $questionnumber." at ".$someArray["points"]." points</td>";
		echo "<td>". $someArray["text"]."</td>";
		echo "<td><input type='text' name='";
		echo $someArray["id"]; 
		echo "' id='short' placeholder='Fill Answer Here' required/></td>";	
	echo "</tr></table>";
} elseif(preg_replace('/[^a-z\d ]/i', '', $someArray["format"]) == "truefalse"){
	echo "<table><tr><td>Question # " . $questionnumber." at ".$someArray["points"]." points</td>";
		echo "<td>". $someArray["text"]."</td>";
		echo "<td><select id='question' name='";
		echo $someArray["id"];
		echo "' style='width: 220px;' required>";
		echo "<option value =''>Select Answer</option>";
		echo "<option value='True'>True</option>";
		echo "<option value='False'>False</option></select></td>";
	echo "</tr></table>";
}
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
