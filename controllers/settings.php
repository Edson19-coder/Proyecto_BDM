<?php
	session_start();

	header('Access-Control-Allow-Origin: *');
	require_once('../db/db.php');
	require_once('../models/settings.php');

	$resp = null;
	$action = $_POST['vAction'];

	if($action == 'UPP'){ //Update Profile Picture

		$user = $_POST['user_id'];
		if(($_FILES["InputImageSettings"]["type"] == "image/pjpeg") || ($_FILES["InputImageSettings"]["type"] == "image/jpeg") || ($_FILES["InputImageSettings"]["type"] == "image/png") || ($_FILES["InputImageSettings"]["type"] == "image/gif")){
			$profilePicture = addslashes(file_get_contents($_FILES['InputImageSettings']['tmp_name']));

			$resp = Settings::updateProfilePicture($user, $profilePicture);

			$_SESSION['profilePicture'] = $resp['PROFILE_PICTURE'];

			//Esto es para limpiar todo lo que ya hay en $_SESSION; que administre mejor la memoria
			unset($_SESSION['user_id']);
			unset($_SESSION['InputImageSettings']);

		}else{
			echo "PAPUS";
		}
	}
	else if($action == "UUI"){ //Update User Information

	}

	echo json_encode($resp);

?>