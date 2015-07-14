<?php

require_once "./dbconnect.php";


function getUser(){
	global $conn;
	global $_GET;
	if (isset($_GET["username"])) {
		if ($rows = $conn->query("SELECT * FROM User WHERE username='".$_GET["username"]."';")) {
			if ($row = $rows->fetch_assoc()){
				echo json_encode($row);
			} else {
				echo "{}";
			}
		}
	} else {
		$comma = 0;
		if($rows = $conn->query("SELECT * FROM User;")) {
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

function makeUser(){
	global $conn;
	global $_POST;
	if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["role"])) {
		$salt = "salt";
		$hashpass = hash_pbkdf2("sha256",$_POST["password"],$salt,1000,20);
		if($conn->query("INSERT INTO User (username, password, role) VALUES ('".$_POST['username']."', '".$hashpass."', '".$_POST['role']."')")===TRUE){
			echo "Success!";
		} else {
			echo "Failure Inserting Value!";
		}
	} else {
		echo "Error!";
	}


}

switch ($_SERVER['REQUEST_METHOD']) {

	case 'POST' :
	makeUser();
	break;
	case 'GET':
	getUser();
	break;
}

?>
