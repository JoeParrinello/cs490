<?php
	session_start();
	if($_SESSION['currRole'] == "Student"){
		
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Testopia | View Grades </title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
		<header>
			<stong>Testopia | My Grades  (CS490) </stong>
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
				<strong>Welcome Student, View your grades below.</strong>
					<?php
include ('../scripts/transferCheckExams.php');
$arrays = checkexams($_SESSION['currUser']);


$totalexams = count($arrays);
$examnumber = 0;
echo "<table>";
echo "<tr><td>Status</td><td>Release Status</td><td>Test ID</td><td>Test Name</td><td>View Test</td></tr>";

while ($examnumber < $totalexams) {
echo "<form action='../scripts/viewGrades.php' method='POST'>";
$someArray = $arrays[$examnumber];

echo "<tr><td>"; 
if ($someArray["status"] == "taken"){
	echo "Taken";
} elseif ($someArray["status"] == "nottaken"){
	echo "Not Taken";
} elseif ($someArray["status"] == "released"){
	echo "Overdue";
} else {
	echo "Not Released";
}
echo "</td><td>";
if ($someArray["released"] == 0){
	echo "Not Released";
} elseif ($someArray["released"] == 1){
	echo "Released";
} else {
	echo "Error";
}
echo "</td><td>"; 
echo $someArray["examId"];
echo "</td><td>"; 
echo $someArray["name"];
echo "</td><td>";
echo "<input type='hidden' name='examId' value='";
echo $someArray["examId"];
echo "'>";
echo "<input type='hidden' name='username' value='";
echo $_SESSION['currUser'];
echo "'>";
if ($someArray["status"] == "taken" AND $someArray["released"] == "1" ){
	echo "<input type='submit' name='submit' value='View Exam' />";
} elseif ($someArray["status"] == "nottaken"){
	echo "You have to take the exam.";
} elseif ($someArray["status"] == "released"){
	echo "This exam was not taken and is overdue.";
} else {
	echo "Not Released";
}

echo "</td></tr>";

echo "</form>";
   $examnumber = $examnumber + 1;
}
echo "</table>";

?>

			</section>
			<footer>
				<p> System Developed by <em>Joseph Parrinello, Sadig Amini,</em> and <em>Oliver Hanna</em></p>
			</footer>
		
</body>
<?php
} else {
	echo "ERROR: Access Denied <br/> You do not have access to this page. Please try to login, if the error presists, contact the system administration.<br/>";
}
?>
</php>