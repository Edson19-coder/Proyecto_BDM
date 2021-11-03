<?php
	header('Access-Control-Allow-Origin: *');
	require_once('../db/db.php');
	require_once('../models/lesson.php');

	$resp = null;
	$action = $_POST['vAction'];

	if($action == 'SLVL'){
		if(isset($_POST['lessonId'])){
			$lessonId = $_POST['lessonId'];
			$courseId = $_POST['courseId'];
			$resp = Lesson::getLastLessonViewed($courseId, $lessonId);
		}else{
			echo "Error al traer leccion";
		}
	}
	else if($action == 'ILV'){
		if(isset($_POST['lessonId'])){
			$lessonId = $_POST['lessonId'];
			$courseId = $_POST['courseId'];
			$userId = $_POST['userId'];
			$resp = Lesson::registerViewedLesson($userId, $courseId, $lessonId);
		}else{
			echo "No se pudo registrar el avance del curso.";
		}
	}


	echo json_encode($resp);
?>