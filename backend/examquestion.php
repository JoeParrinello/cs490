<?php

require_once "./dbconnect.php";


function getExamQuestion(){
	global $conn;
	global $_GET;
	header('Content-Type: application/json');
	if (isset($_GET["examId"])) {
        $comma = 0;
		if($rows = $conn->query("SELECT * FROM ExamQuestions WHERE examId=".$_GET["examId"].";")) {
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
		if($rows = $conn->query("SELECT * FROM ExamQuestions;")) {
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

function makeExamQuestion(){
	global $conn;
	global $_POST;
	header('Content-Type: application/json');
	if (isset($_POST["examId"]) && isset($_POST["questionId"])) {
        if($conn->query("INSERT INTO ExamQuestions (examId, questionId, points) VALUES (".$_POST['examId'].", ".$_POST['questionId'].", ".$_POST['points'].")")===TRUE){
            $row = $conn->query("SELECT * FROM ExamQuestions WHERE examId=".$_POST['examId']." AND questionId=".$_POST["questionId"]." AND points=".$_POST["points"].";");
            echo json_encode($row->fetch_assoc());
		} else {
			echo '{"err":"Failure Inserting Value!"}';
		}
	} else {
		echo '{"err":"Error! examId or questionId not set!"}';
	}


}

switch ($_SERVER['REQUEST_METHOD']) {

	case 'POST' :
	makeExamQuestion();
	break;
	case 'GET':
	getExamQuestion();
	break;
}

?>
