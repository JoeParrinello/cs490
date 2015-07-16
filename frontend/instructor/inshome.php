
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Testopia | Instructor Home </title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
		<header>
			<stong>Testopia | Instructor Home (CS490) </stong>
		</header>
			<nav>
		<label for="show-menu" class="show-menu">Show Menu</label>
		<input type="checkbox" id="show-menu" role="button">
		<ul id="menu" align="center">
					<li><a href="inshome.html">Instructor Home</a> </li>
					<li><a href="insregstudents.html">Class Roster</a> </li>
					<li><a href="instests.html">Tests</a> </li>
					<li><a href="inscreate.html">Create Test</a> </li>
					<li><a href="insgrades.html">Grades</a> </li>
					<li><a href="instutorial.html">Tutorials</a> </li>
					<li><a href="insabout.html">About Testopia</a> </li>
					<li><a href="inscontact.html">Contact Us</a> </li>
					<li><a href="/index.html">Logout</a> </li>
				</ul>
			<section>
				<strong>
						<?php 
							include ('scripts/curllogin.php');
						?> 
				</strong>
			</section>
			<footer>
				<p> System Developed by <em>Joseph Parrinello, Sadig Amini,</em> and <em>Oliver Hanna</em></p>
			</footer>
		
</body>

