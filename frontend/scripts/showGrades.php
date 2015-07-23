<?php

session_start();
if($_SESSION['currRole'] == "Student"){
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Testopia | View your Exam </title>

	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
		<header>
			<stong>Testopia | View Exam CS490) </stong>
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
				<p> </p>

<?php
include ('getQuestionDetails.php');
$confdata = $_SESSION['grades'];

$arrays = json_decode($confdata, true);

$questionnumber = 0;
end($arrays);
$metadata = key($arrays);
$metaArray = json_decode($arrays[$metadata], true);
echo "<p><b>Student UCID: <i>".$_SESSION['currUser']."<br/></i>  Exam ID: <i>".$metaArray["examId"]."<br/></i>  Grade: <i>".sprintf("%.2f", $metaArray["grade"])."/100</i> </b><br/>";

foreach ($arrays as $key => $values) {
	$questionnumber = $questionnumber +1;
	$someArray = json_decode($values, true);
	
if (preg_replace('/[^a-z\d ]/i', '', $someArray["format"]) == "multiple"){
	echo "<table><tr><td>Question # " . $questionnumber. "</td>";
		echo "<td>". $someArray["text"]."</td></tr>";
		$questionId = $someArray["questionId"];
		$questiondetails = getQuestionDetails($questionId);
		if($someArray["studentAnswer"] == "A"){
			$stuAns="ansa";
		} elseif ($someArray["studentAnswer"] == "B"){
			$stuAns="ansb";
		} elseif ($someArray["studentAnswer"] == "C"){
			$stuAns="ansc";
		} elseif ($someArray["studentAnswer"] == "D"){
			$stuAns="ansd";
		}

		if($someArray["correctAnswer"] == "A"){
			$correctAns="ansa";
		} elseif ($someArray["correctAnswer"] == "B"){
			$correctAns="ansb";
		} elseif ($someArray["correctAnswer"] == "C"){
			$correctAns="ansc";
		} elseif ($someArray["correctAnswer"] == "D"){
			$correctAns="ansd";
		}
		
		if (strtolower($someArray["studentAnswer"]) == strtolower($someArray["correctAnswer"])){
		echo "<tr><td></td><td>You answered the question <font color='green'><b>correctly.<b/></font><br/></td></tr>";
		echo "<tr><td></td><td>You Answered: ".$someArray["studentAnswer"]." : ".$questiondetails[$stuAns]."</td></tr>";
		echo "<tr><td></td><td>Correct Answer: ".$someArray["correctAnswer"]." : ".$questiondetails[$correctAns]."</td></tr><br/>";
		} else {
		echo "<tr><td></td><td>You answered the question <font color='red'><b>incorrectly.<b/></font><br/></td></tr>";
		echo "<tr><td></td><td>You Answered: ".$someArray["studentAnswer"]." : ".$questiondetails[$stuAns]."</td></tr>";
		echo "<tr><td></td><td>Correct Answer: ".$someArray["correctAnswer"]." : ".$questiondetails[$correctAns]."</td></tr><br/>";
		}

} elseif(preg_replace('/[^a-z\d ]/i', '', $someArray["format"]) == "short"){
	echo "<table><tr><td>Question # " . $questionnumber. "</td>";
		echo "<td>". $someArray["text"]."</td></tr>";
		if (strtolower($someArray["studentAnswer"]) == strtolower($someArray["correctAnswer"])){
		echo "<tr><td></td><td>You answered the question <font color='green'><b>correctly.<b/></font><br/></td></tr>";
		echo "<tr><td></td><td>You Answered: ".$someArray["studentAnswer"];
		echo "<tr><td></td><td>Correct Answer: ".$someArray["correctAnswer"]."</td></tr><br/>";
		} else {
		echo "<tr><td></td><td>You answered the question <font color='red'><b>incorrectly.<b/></font><br/></td></tr>";
		echo "<tr><td></td><td>You Answered: ".$someArray["studentAnswer"];
		echo "<tr><td></td><td>Correct Answer: ".$someArray["correctAnswer"]."</td></tr><br/>";
		}
		
	echo "</tr></table>";
} elseif(preg_replace('/[^a-z\d ]/i', '', $someArray["format"]) == "truefalse"){
	echo "<table><tr><td>Question # " . $questionnumber. "</td>";
		echo "<td>". $someArray["text"]."</td></tr>";
		if (strtolower($someArray["studentAnswer"]) == strtolower($someArray["correctAnswer"])){
		echo "<tr><td></td><td>You answered the question <font color='green'><b>correctly.<b/></font><br/></td></tr>";
		echo "<tr><td></td><td>You Answered: ".$someArray["studentAnswer"];
		echo "<tr><td></td><td>Correct Answer: ".$someArray["correctAnswer"]."</td></tr><br/>";
		} else {
		echo "<tr><td></td><td>You answered the question <font color='red'><b>incorrectly.<b/></font><br/></td></tr>";
		echo "<tr><td></td><td>You Answered: ".$someArray["studentAnswer"];
		echo "<tr><td></td><td>Correct Answer: ".$someArray["correctAnswer"]."</td></tr><br/>";
		}
	echo "</tr></table>";
}
}

?>


			</section>
		
</body>
<?php
} else {
	echo "ERROR: Access Denied <br/> You do not have access to this page. Please try to login, if the error presists, contact the system administration.<br/>";
}
?>
</php>