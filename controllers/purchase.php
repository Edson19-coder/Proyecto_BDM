<?php
	session_start();

	header('Access-Control-Allow-Origin: *');
	require_once('../db/db.php');
	require_once('../models/purchase.php');

	$resp = null;
	$action = $_POST['vAction'];

	if($action == 'I'){
		if(isset($_POST['userId'])){
			$user = $_POST['userId'];
			$course = $_POST['courseId'];
			$resp = Purchase::purchaseCourse($course, $user);
		}else{
			echo "Error en el servicio";
		}
	}
	else if($action == 'IL'){
		if(isset($_POST['userId'])){
			$user = $_POST['userId'];
			$lesson = $_POST['lessonId'];

			$resp = Purchase::purchaseLesson($lesson, $user);
		}else{
			echo "Error en el servicio";
		}
	}
	
	echo json_encode($resp);
?>
