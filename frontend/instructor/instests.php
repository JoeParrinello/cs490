<?php
	session_start();
	if($_SESSION['currRole'] == "Instructor"){
		
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Testopia | View and Assign Tests </title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
		<header>
			<stong>Testopia | Tests (CS490) </stong>
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
				<strong>Welcome Instructor, you can release your exams here.</strong>
				<?php

$url ="https://web.njit.edu/~oh7/cs490/frontend/scripts/transferExams.php";
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


$totalexams = count($arrays);
$examnumber = 0;
echo "<table>";
echo "<tr><td>Release Status</td><td>Test ID</td><td>Test Name</td><td>Release</td></tr>";

while ($examnumber < $totalexams) {
echo "<form action='../scripts/viewExams.php' method='POST'>";
$someArray = $arrays[$examnumber];

echo "<tr><td>"; 
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
if ($someArray["released"] == 0){
	echo "<input type='submit' name='submit' value='Release' />";
} elseif ($someArray["released"] == 1){
	echo "Already Released";
} else {
	echo "Error";
}

 // print_r($someArray);        // Dump all data of the Array
  //echo $someArray["id"];
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