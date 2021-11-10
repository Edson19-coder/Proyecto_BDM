<?php
	header('Access-Control-Allow-Origin: *');
	require_once('../db/db.php');
	require_once('../models/comments.php');

	$resp = null;
	$action = $_POST['vAction'];

	if($action == 'I'){
		if(isset($_POST['courseId']) && isset($_POST['userId']) && isset($_POST['qualification']) && isset($_POST['content'])){
			$courseId = $_POST['courseId'];
			$userId = $_POST['userId'];
			$qualification = $_POST['qualification'];
			$content = $_POST['content'];
			
			$resp = Comment::insertComment($courseId, $userId, $qualification, $content);
		}else{
			echo "Error al insertar comentario";
		}
	}

	echo json_encode($resp);
?>