
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Testopia | The Online Test Taking System </title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Login Form</title>
	<LINK REL=StyleSheet HREF="style.css" TYPE="text/css" MEDIA=screen>
		<meta name="robots" content="noindex,follow" />
	</head>
	<body>
		<header>
			<stong>Testopia | The Online Test Taking System  (CS490) </stong>
		</header>
		<div class="container">
			<div class="login">
				<?php
				if (isset($_POST['submit'])) {
					loginsubmit();
				}
				else {
					?>

					<h1>Login to Testopia</h1>
					<form action="index.php" method="POST">
						<table>
										<tr>
										<td><input type="text" name="user" id="user" placeholder="UCID"/></td>
										</tr>
										
										<tr>
											<td><input type="password" name="pass" id="pass" placeholder="Password"/></td>
										</tr>
										<tr>
										<tr>
											<td colspan="2"><input type='submit' name='submit' value='Login' /></td>
										</tr>
								<?php 
							}
							function loginsubmit(){
								$user = $_POST['user'];
								$pass = $_POST['pass'];
								include ('scripts/curllogin.php');
								?>
								<h1>Login to Testopia</h1>
					<form action="index.php" method="POST">
						<table>
										<tr>
										<td><input type="text" name="user" id="user" placeholder="UCID"/></td>
										</tr>
										
										<tr>
											<td><input type="password" name="pass" id="pass" placeholder="Password"/></td>
										</tr>
										<tr>
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
						</div>
					</div>
					<footer>
						<p> System Developed by <em>Joseph Parrinello, Sadig Amini,</em> and <em>Oliver Hanna</em></p>
					</footer>
					
				</body>
				</html>

