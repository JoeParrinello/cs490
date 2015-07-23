<?php
	session_start();
	if($_SESSION['currRole'] == "Student"){
		
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Testopia | View/Register for Classes </title>

	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
		<header>
			<stong>Testopia | My Classes  (CS490) </stong>
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
				<strong>Welcome Student,</strong>
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