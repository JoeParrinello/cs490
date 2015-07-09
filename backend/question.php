<?php
	
	require_once "./dbconnect.php";

	function makeQuestion(){
		global $conn;
		global $_POST;
		$result = array('b' => 2);
		echo json_encode($result);
	}

	function getQuestion(){
		global $conn;
		global $_GET;
		$result = array('a' => 1);
		echo json_encode($result);
	}
	switch ($_SERVER['REQUEST_METHOD']) {

	case 'POST' :
		makeQuestion();
		break;
	case 'GET':
		getQuestion();
		break;
	}

?>
