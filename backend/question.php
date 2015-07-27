<?php

require_once "./dbconnect.php";

function makeQuestion(){
	global $conn;
	global $_POST;
	header('Content-Type: application/json');
	if (isset($_POST["format"])) {
		if (isset($_POST["text"])) {
			if (isset($_POST["answer"])) {
				if(isset($_POST["points"])){
					switch ($_POST["format"]) {
						case "truefalse":
						if ($_POST["answer"]=="true" || $_POST["answer"]=="false") {
							//TODO Check if Quesiton exists in the database before inserting the new question
							if($conn->query("INSERT INTO Question (format, points, text, answer) VALUES ('".$_POST['format']."', ".$_POST['points'].", '".$_POST['text']."', '".$_POST['answer']."')")===TRUE){
								$row = $conn->query("SELECT * FROM Question WHERE format='".$_POST['format']."' AND points=".$_POST['points']." AND text='".$_POST['text']."' AND answer='".$_POST['answer']."';");
								echo json_encode($row->fetch_assoc());
							} else {
								echo '{"err":"Failure Inserting Value!"}';
							}
						} else {
							echo '{"err":"Error! not a valid answer for True/False problem"}';
						}
						break;
						case "multiple":
						if ($_POST["answer"]=="A" || $_POST["answer"]=="B" || $_POST["answer"]=="C" || $_POST["answer"]=="D") {
							if($conn->query("INSERT INTO Question (format, points, text, answer) VALUES ('".$_POST['format']."', ".$_POST['points'].", '".$_POST['text']."', '".$_POST['answer']."')")===TRUE){
								$row = $conn->query("SELECT * FROM Question WHERE format='".$_POST['format']."' AND points=".$_POST['points']." AND text='".$_POST['text']."' AND answer='".$_POST['answer']."';");
								echo json_encode($row->fetch_assoc());
							} else {
								echo '{"err":"Failure Inserting Value!"}';
							}
						} else {
							echo '{"err":"Error! not a valid answer for multiple choice problem"}';
						}
						break;
						case "short":
						if ($_POST["answer"]!="") {
							if($conn->query("INSERT INTO Question (format, points, text, answer) VALUES ('".$_POST['format']."', ".$_POST['points'].", '".$_POST['text']."', '".$_POST['answer']."')")===TRUE){
								$row = $conn->query("SELECT * FROM Question WHERE format='".$_POST['format']."' AND points=".$_POST['points']." AND text='".$_POST['text']."' AND answer='".$_POST['answer']."';");
								echo json_encode($row->fetch_assoc());
							} else {
								echo '{"err":"Failure Inserting Value!"}';
							}
						} else {
							echo '{"err":"Error! not a valid answer for short answer problem"}';
						}
						break;
						default:
						echo '{"err":"Error! not a valid format"}';
						break;
					}
				} else {
					echo '{"err":"Error! points not set"}';
				}
			} else {
				echo '{"err":"Error! answer not set"}';
			}
		} else {
			echo '{"err":"Error! text not set"}';
		}
	}
	else {
		echo '{"err":"Error! format is not set"}';
	}
}

function getQuestion() {
	global $conn;
	global $_GET;
	header('Content-Type: application/json');
	if (isset($_GET["id"])) {
		if ($rows = $conn->query("SELECT * FROM Question WHERE id=".$_GET['id'].";")) {
			if ($row = $rows->fetch_assoc()) {
				echo json_encode($row);
			} else {
				echo "{}";
			}
		}
	} else {
		$comma = 0;
		if (isset($_GET["format"])) {
			if($rows = $conn->query("SELECT * FROM Question WHERE format='".$_GET["format"]."';")) {
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
			if($rows = $conn->query("SELECT * FROM Question;")) {
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
	makeQuestion();
	break;
	case 'GET' :
	getQuestion();
	break;
}

?>
