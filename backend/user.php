<?php
	
	require_once "./dbconnect.php";


	function getUser(){
		global $conn;
		global $_GET;
		$result = array('a' => 1);
		echo json_encode($result);
	}
	switch ($_SERVER['REQUEST_METHOD']) {

	case 'POST' :
		break;
	case 'GET':
		getUser();
		break;
	}

?>
