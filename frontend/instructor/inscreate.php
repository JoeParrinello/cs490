
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Testopia | Add a Question (CS490) </title>
	<script type="javascript">
			$("select").on("change", function() {    
    $("#" + $(this).val()).show().siblings().hide();
});
	</script>

</head>
<header>
	<stong>Testopia | Add a Question (CS490) </stong>
</header>
<body>
	<label for="show-menu" class="show-menu">Show Menu</label>
	<input type="checkbox" id="show-menu" role="button">
	<ul id="menu" align="center">
		<li><a href="inshome.php">Home</a></li>
		<li><a href="instests.php">Tests</a></li>
		<li><a href="inscreate.php">Add Question</a></li>
		<li><a href="insregstudents.php">Students</a></li>
		<li><a href="instutorial.php">Tutorials</a></li>
		<li><a href="insabout.php">About Testopia</a></li>	
		<li><a href="inscontact.php">Contact Us</a> </li>
	</ul>

			<strong>Add Question</strong>
				<select>
					<option value="" selected="selected"></option>
					<option value="form_tf">True/False</option>
					<option value="form_mc">Multiple Choice</option>
					<option value="form_fb">Fill in the Blank</option>
					<option value="form_sa">Short Answer</option>
				</select>
				<form name="form_tf" id="form_tf" style="display:none" action="inshome.php" method="POST" id="login_form">
					<input type="hidden" name="type" id="type" value="tf">
					<tr>
						<td>Enter True and False Question</td>
						<td>
							<input type="text" name="question" id="question" />
						</td>
					</tr>
					<tr>
						<td>Select Correct Answer</td>
						<td>
							<input type="radio" name="correctans" id="correctans" value="True">True
							<br>
							<input type="radio" name="correctans" id="correctans" value="False">False</td>
						</tr>
						<tr>
							<td colspan="2">
								<input type='submit' name='submit' value='Add Question' />
							</td>
						</tr>
					</form>
					<form name="form_mc" id="form_mc" style="display:none" action="inshome.php" method="POST" id="login_form">
						<tr>
							<td colspan="2">
								<input type='submit' name='submit' value='Add Question' />
							</td>
						</tr>
					</form>
					<form name="form_fb" id="form_fb" style="display:none" action="inshome.php" method="POST" id="login_form">
						<tr>
							<td colspan="2">
								<input type='submit' name='submit' value='Add Question' />
							</td>
						</tr>
					</form>
					<form name="form_sa" id="form_sa" style="display:none" action="inshome.php" method="POST" id="login_form">
						<tr>
							<td colspan="2">
								<input type='submit' name='submit' value='Add Question' />
							</td>
						</tr>
					</form>
	</body>
	<footer>
		<p> System Developed by <em>Joseph Parrinello, Sadig Amini,</em> and <em>Oliver Hanna</em></p>
	</footer>

</body>
</html>

