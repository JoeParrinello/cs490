<?php

require_once "./dbconnect.php";


function getExamAnswer(){
	global $conn;
	global $_GET;
	header('Content-Type: application/json');
	if (isset($_GET["examId"]) && isset($_GET["userId"]) && isset($_GET["questionId"])) {
        $comma = 0;
		if($rows = $conn->query("SELECT * FROM ExamAnswer WHERE examId=".$_GET["examId"]." AND userId=".$_GET["userId"]." AND questionId=".$_GET["questionId"].";")) {
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
    } elseif (isset($_GET["examId"]) && isset($_GET["userId"])) {
        $comma = 0;
		if($rows = $conn->query("SELECT * FROM ExamAnswer WHERE examId=".$_GET["examId"]." AND userId=".$_GET["userId"].";")) {
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
		$comma = 0;
		if($rows = $conn->query("SELECT * FROM ExamAnswer;")) {
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

function makeExamAnswer(){
	global $conn;
	global $_POST;
	header('Content-Type: application/json');
	if (isset($_POST["examId"]) && isset($_POST["questionId"]) && isset($_POST["userId"]) && isset($_POST["answer"])) {
        if($conn->query("INSERT INTO ExamAnswer (examId, questionId, userId, answer) VALUES (".$_POST['examId'].", ".$_POST['questionId'].", ".$_POST['userId'].", '".$_POST['answer']."')")===TRUE){
            $row = $conn->query("SELECT * FROM ExamAnswer WHERE examId=".$_POST['examId']." AND questionId=".$_POST["questionId"]." AND userId=".$_POST["userId"].";");
            echo json_encode($row->fetch_assoc());
		} else {
			echo '{"err":"Failure Inserting Value!"}';
		}
	} else {
		echo '{"err":"Error! examId or questionId or userId or answer not provided!"}';
	}


}

switch ($_SERVER['REQUEST_METHOD']) {

	case 'POST' :
	makeExamAnswer();
	break;
	case 'GET':
	getExamAnswer();
	break;
}

?>
