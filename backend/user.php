<?php
	
	require_once "./dbconnect.php";


	function getUser(){
		global $conn;
		global $_GET;
		if($rows = $conn->query("SELECT * FROM User;")) {
			echo "Hello\n";
			$row = $rows->fetch_array();
			echo "Hello1\n";
			echo $row;
			echo json_encode($row[0]);
		}
		else {
			echo json_encode(array());
		}
	}
	switch ($_SERVER['REQUEST_METHOD']) {

	case 'POST' :
		break;
	case 'GET':
		getUser();
		break;
	}

?>
