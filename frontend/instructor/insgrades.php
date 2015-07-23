<?php
	session_start();
	if($_SESSION['currRole'] == "Instructor"){
		
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Testopia | Grades </title>
<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
		<header>
			<stong>Testopia | Grades (CS490) </stong>
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
				<strong>Welcome Instructor,</strong>
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