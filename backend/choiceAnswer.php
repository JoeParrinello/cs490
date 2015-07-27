<?php

require_once "./dbconnect.php";

function makeQuestionAnswer(){
	global $conn;
	global $_POST;
	header('Content-Type: application/json');
	if (isset($_POST["questionId"])) {
		if (isset($_POST["choice"])) {
			if(isset($_POST["text"])){
				if ($_POST["choice"]=="A" || $_POST["choice"]=="B" || $_POST["choice"]=="C" || $_POST["choice"]=="D") {
					if($conn->query("INSERT INTO ChoiceAnswer (questionId, choice, text) VALUES (".$_POST['questionId'].", '".$_POST['choice']."', '".$_POST['text']."');")===TRUE){
						$row = $conn->query("SELECT * FROM ChoiceAnswer WHERE questionId=".$_POST['questionId']." AND choice='".$_POST['choice']."' AND text='".$_POST['text']."';");
						echo json_encode($row->fetch_assoc());
					} else {
						echo '{"err":"Failure Inserting Value!"}';
					}
				} else {
					echo '{"err":"Error! not a valid choice for multiple choice problem"}';
				}
			} else {
				echo '{"err":"Error! text not set"}';
			}
		} else {
			echo '{"err":"Error! choice not set"}';
		}
	} else {
		echo '{"err":"Error! questionId not set"}';
	}
}

function getQuestionAnswer() {
	global $conn;
	global $_GET;
	header('Content-Type: application/json');
	if (isset($_GET["id"])) {
		if ($rows = $conn->query("SELECT * FROM ChoiceAnswer WHERE id=".$_GET['id'].";")) {
			if ($row = $rows->fetch_assoc()) {
				echo json_encode($row);
			} else {
				echo "{}";
			}
		}
	} else {
		$comma = 0;
		if (isset($_GET["questionId"])) {
			if($rows = $conn->query("SELECT * FROM ChoiceAnswer WHERE questionId=".$_GET["questionId"].";")) {
				echo "[";
				while ($row = $rows->fetch_assoc()) {
					if ($comma > 0) {
						echo ",";
					}
					$comma++;
					echo json_encode($row);
				}
				echo "]";
			}
		} else {
			if($rows = $conn->query("SELECT * FROM ChoiceAnswer;")) {
				echo "[";
				while ($row = $rows->fetch_assoc()) {
					if ($comma > 0) {
						echo ",";
					}
					$comma++;
					echo json_encode($row);
				}
				echo "]";
			}
		}
	}
}

switch ($_SERVER['REQUEST_METHOD']) {

	case 'POST' :
	makeQuestionAnswer();
	break;
	case 'GET' :
	getQuestionAnswer();
	break;
}

?>
