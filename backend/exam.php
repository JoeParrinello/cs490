<?php

require_once "./dbconnect.php";


function getExam(){
	global $conn;
	global $_GET;
	header('Content-Type: application/json');
	if (isset($_GET["name"])) {
		if ($rows = $conn->query("SELECT * FROM Exams WHERE name='".$_GET["name"]."';")) {
			if ($row = $rows->fetch_assoc()){
				echo json_encode($row);
			} else {
				echo "{}";
			}
		}
	} elseif (isset($_GET["examId"])){
        if ($rows = $conn->query("SELECT * FROM Exams WHERE examId='".$_GET["id"]."';")) {
            if ($row = $rows->fetch_assoc()){
                echo json_encode($row);
            } else {
                echo "{}";
            }
        }
    } else {
		$comma = 0;
		if($rows = $conn->query("SELECT * FROM Exams;")) {
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

function makeExam(){
	global $conn;
	global $_POST;
	header('Content-Type: application/json');
	if (isset($_POST["name"])) {
        if($conn->query("INSERT INTO Exams (name) VALUES ('".$_POST['name']."')")===TRUE){
            $row = $conn->query("SELECT * FROM Exams WHERE name='".$_POST['name']."';");
            echo json_encode($row->fetch_assoc());
		} else {
			echo '{"err":"Failure Inserting Value!"}';
		}
	} else {
		echo '{"err":"Error!"}';
	}


}

function updateExam(){
	global $conn;
	global $_PUT;
	header('Content-Type: application/json');
	if (isset($_PUT["examId"]) && isset($_PUT["released"])) {
        if($conn->query("UPDATE Exams SET released=".$_PUT['released']." WHERE examId=".$_PUT['examId'].";")===TRUE){
            $row = $conn->query("SELECT * FROM Exams WHERE examId=".$_PUT['examId'].";");
            echo json_encode($row->fetch_assoc());
		} else {
			echo '{"err":"Failure Inserting Value!"}';
		}
	} else {
		echo '{"err":"Error!"}';
	}


}

switch ($_SERVER['REQUEST_METHOD']) {

	case 'POST' :
	makeExam();
	break;
	case 'GET':
	getExam();
	break;
    case 'PUT':
    parse_str(file_get_contents("php://input"),$_PUT);
    updateExam();
    break;
}

?>
