
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Testopia | The Online Test Taking System </title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
		<header>
			<stong>Testopia | The Online Test Taking System  (CS490) </stong>
		</header>
		<label for="show-menu" class="show-menu">Show Menu</label>
		<input type="checkbox" id="show-menu" role="button">
		<ul id="menu" align="center">
					<li><a href="index.php">Home</a></li>
					<li><a href="tutorial.php">Tutorials</a></li>
					<li><a href="about.php">About Testopia</a></li>	
					<li><a href="contact.php">Contact Us</a> </li>
		</ul>
			<section>
				<strong>Welcome</strong>
			</section>
			<aside>
			<?php
			   if (isset($_POST['submit'])) {
			     loginsubmit();
			   }
			   else {
			?>
				<strong>Login</strong>
				<form action="index.php" method="POST">
					<table>
						<tr>
							<td>Username</td>
						    <td><input type="text" name="user" id="user" /></td>
						</tr>
						<tr>
							<td>Password</td>
						    <td><input type="password" name="pass" id="pass" /></td>
						</tr>
						<tr>
							<td colspan="2"><input type='submit' name='submit' value='Login' /></td>
						</tr>
						<tr>
						<?php 
							}
						 function loginsubmit(){
						 		$user = $_POST['user'];
								$pass = $_POST['pass'];
							include ('scripts/curllogin.php');
							?>
											<strong>Login</strong>
						<form action="index.php" method="POST">
					<table>
						<tr>
							<td>Username</td>
						    <td><input type="text" name="user" id="user" /></td>
						</tr>
						<tr>
							<td>Password</td>
						    <td><input type="password" name="pass" id="pass" /></td>
						</tr>
						<tr>
							<td colspan="2"><input type='submit' name='submit' value='Login' /></td>
						</tr>
						<tr>
						<?php 
							echo loginAuth($user, $pass);
						}
						?>
						</tr>
					</table>
				</form>
			</aside>
			<footer>
				<p> System Developed by <em>Joseph Parrinello, Sadig Amini,</em> and <em>Oliver Hanna</em></p>
			</footer>
		
</body>
</html>

