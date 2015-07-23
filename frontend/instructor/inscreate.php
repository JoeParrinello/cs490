
	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Testopia | Add a Question (CS490) </title>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
		<script>
			$(document).ready(function (){
				$("#question").change(function() {
                  // foo is the id of the other select box 
                  if ($(this).val() == "short") {
                  	$("#short").show();
                  	$("#truefalse").hide();
                  	$("#multiple").hide();
                  	$("#longanswer").hide();
                  	$("#main").hide();
                  } else if ($(this).val() == "truefalse") {
                  	$("#short").hide();
                  	$("#truefalse").show();
                  	$("#multiple").hide();
                  	$("#longanswer").hide();
                  	$("#main").hide();
                  } else if ($(this).val() == "multiple") {
                  	$("#short").hide();
                  	$("#truefalse").hide();
                  	$("#multiple").show();
                  	$("#longanswer").hide();
                  	$("#main").hide();
                  } else if ($(this).val() == "longanswer") {
                  	$("#short").hide();
                  	$("#truefalse").hide();
                  	$("#multiple").hide();
                  	$("#longanswer").show();
                  	$("#main").hide();
                  } else if ($(this).val() == "main") {
                  	$("#short").hide();
                  	$("#truefalse").hide();
                  	$("#multiple").hide();
                  	$("#longanswer").hide();
                  	$("#main").show();
                  }else{
                  	$("#short").hide();
                  	$("#truefalse").hide();
                  	$("#multiple").hide();
                  	$("#longanswer").hide();
                  	$("#main").hide();
                  } 
              });
});
</script>

</head>
<header>
	<stong>Testopia | Add a Question (CS490) </stong>
</header>
<body>
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
	</nav>
	<div class="container">
		<?php
		if (isset($_POST['submit'])) {
			addthisquestion();
		}
		else {
			?>

			<strong>Add Question</strong>
			<p>
				<select id="question" name="question" style="width: 220px;">
					<option value="main"selected>Select Question Type</option>
					<option value="short">Fill in the blank</option>
					<option value="truefalse">True or False</option>
					<option value="multiple">Multiple Choice</option>
					<option value="longanswer">Long Answer</option>
				</select>
			</p>
			<table id="main" style="display:none;">
				Please use the dropdown above to select a question type to add.
			</table>

			<form id="short" style="display:none;" action="inscreate.php" method="POST">
				<table>
					<input type="hidden" name="type" id="type" value="short">

					<tr>
						<td>Enter a Fill in the Blank Question</td>
						<td>
							<input type="text" name="text" id="text" style="width: 350px"/>
						</td>
					</tr>
					<tr>
						<td>Enter the Correct Answer</td>
						<td>
							<input type="text" name="correctans" id="correctans" /></td>
						</tr>
						<td>How many points is this question worth?</td>
						<td>
							<input type="number" name="points" id="points" maxlength="2" />
						</td>
						<tr>
							<td colspan="2">
								<input type='submit' name='submit' value='Add Question' />
							</td>
						</tr>
					</table>

				</form>

				<form id="truefalse" style="display:none;" action="inscreate.php" method="POST">
					<table>
						<input type="hidden" name="type" id="type" value="truefalse">

						<tr>
							<td>Enter True or False Question</td>
							<td>
								<input type="text" name="text" id="text" style="width: 350px"/>
							</td>
						</tr>
						<tr>
							<td>Select Correct Answer</td>
							<td>
								<select id="correctans" name="correctans"  style="width: 232px;">
									<option value="true">True</option>
									<option value="false">False</option>
								</select></td>
							</tr>
							<td>How many points is this question worth?</td>
							<td>
								<input type="number" name="points" id="points" maxlength="2" />
							</td>
							<tr>
								<td colspan="2">
									<input type='submit' name='submit' value='Add Question' />
								</td>
							</tr>
						</table>

					</form>

					<form id="multiple" style="display:none;" action="inscreate.php" method="POST">
						<table>
							<input type="hidden" name="type" id="type" value="multiple">

							<tr>
								<td>Enter a Multiple Choice Question</td>
								<td>
									<input type="text" name="text" id="text" style="width: 350px"/>
								</td>
							</tr>
							<td>Enter the multiple choices.</td>
							<td>
								A: <input type="text" name="ansa" id="ansa" />
								<br>
								B: <input type="text" name="ansb" id="ansb" />
								<br>
								C: <input type="text" name="ansc" id="ansc" />
								<br>
								D: <input type="text" name="ansd" id="ansd" /></td>
							</tr>
							<tr>
								<td>Please select correct answer:</td>
								<td>
									<select id="correctans" name="correctans" style="width: 232px;">
										<option value="A">A</option>
										<option value="B">B</option>
										<option value="C">C</option>
										<option value="D">D</option>
									</select>
								</td>
							</tr>
							<td>How many points is this question worth?</td>
							<td>
								<input type="number" name="points" id="points" maxlength="2" />
							</td>
							<tr>
								<td colspan="2">
									<input type='submit' name='submit' value='Add Question' />
								</td>
							</tr>
						</table>

					</form>

					<p id="longanswer" style="display:none;">
						This feature is coming soon.
					</p>
				</div>
				<?php 
			}
			function addthisquestion(){
				$type = $_POST['type'];
				$question = $_POST['question'];
				$ansa = $_POST['ansa'];
				$ansb = $_POST['ansb'];
				$ansc = $_POST['ansc'];
				$ansd = $_POST['ansd'];
				$correctans = $_POST['correctans'];
				$points = $_POST['points'];
				include ('../scripts/curllogin.php');
				?>

				<strong>Add another Question</strong>
				<p>
					<select id="question" name="question" style="width: 220px;">
						<option value="main"selected>Select Question Type</option>
						<option value="short">Fill in the blank</option>
						<option value="truefalse">True or False</option>
						<option value="multiple">Multiple Choice</option>
						<option value="longanswer">Long Answer</option>
					</select>
				</p>
				<table id="main" style="display:none;">
					Please use the dropdown above to select a question type to add.
				</table>

				<form id="short" style="display:none;" action="inscreate.php" method="POST">
					<table>
						<input type="hidden" name="type" id="type" value="short">

						<tr>
							<td>Enter a Fill in the Blank Question</td>
							<td>
								<input type="text" name="text" id="text" style="width: 350px"/>
							</td>
						</tr>
						<tr>
							<td>Enter the Correct Answer</td>
							<td>
								<input type="text" name="correctans" id="correctans" /></td>
							</tr>
							<td>How many points is this question worth?</td>
							<td>
								<input type="number" name="points" id="points" maxlength="2" />
							</td>
							<tr>
								<td colspan="2">
									<input type='submit' name='submit' value='Add Question' />
								</td>
							</tr>
						</table>

					</form>

					<form id="truefalse" style="display:none;" action="inscreate.php" method="POST">
						<table>
							<input type="hidden" name="type" id="type" value="truefalse">

							<tr>
								<td>Enter True or False Question</td>
								<td>
									<input type="text" name="text" id="text" style="width: 350px"/>
								</td>
							</tr>
							<tr>
								<td>Select Correct Answer</td>
								<td>
									<select id="correctans" name="correctans"  style="width: 232px;">
										<option value="true">True</option>
										<option value="false">False</option>
									</select></td>
								</tr>
								<td>How many points is this question worth?</td>
								<td>
									<input type="number" name="points" id="points" maxlength="2" />
								</td>
								<tr>
									<td colspan="2">
										<input type='submit' name='submit' value='Add Question' />
									</td>
								</tr>
							</table>

						</form>

						<form id="multiple" style="display:none;" action="inscreate.php" method="POST">
							<table>
								<input type="hidden" name="type" id="type" value="multiple">

								<tr>
									<td>Enter a Multiple Choice Question</td>
									<td>
										<input type="text" name="text" id="text" style="width: 350px"/>
									</td>
								</tr>
								<td>Enter the multiple choices.</td>
								<td>
									A: <input type="text" name="ansa" id="ansa" />
									<br>
									B: <input type="text" name="ansb" id="ansb" />
									<br>
									C: <input type="text" name="ansc" id="ansc" />
									<br>
									D: <input type="text" name="ansd" id="ansd" /></td>
								</tr>
								<tr>
									<td>Please select correct answer:</td>
									<td>
										<select id="correctans" name="correctans" style="width: 232px;">
											<option value="A">A</option>
											<option value="B">B</option>
											<option value="C">C</option>
											<option value="D">D</option>
										</select>
									</td>
								</tr>
								<td>How many points is this question worth?</td>
								<td>
									<input type="number" name="points" id="points" maxlength="2" />
								</td>
								<tr>
									<td colspan="2">
										<input type='submit' name='submit' value='Add Question' />
									</td>
								</tr>
							</table>

						</form>

						<p id="longanswer" style="display:none;">
							This feature is coming soon.
						</p>
						<p style="color:blue;">
							<?php 
							echo addthis($type, $question, $ansa, $ansb, $ansc, $ansd, $correctans, $points);
						}

					?>
				</p>
			</div>
		</body>
		<footer>
			<p> System Developed by <em>Joseph Parrinello, Sadig Amini,</em> and <em>Oliver Hanna</em></p>
		</footer>

	</body>
	</html>



