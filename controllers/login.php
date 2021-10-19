<?php

	header('Access-Control-Allow-Origin: *');
	require_once('../db/db.php');
	require_once('../models/user.php');

	$userPassword = $_POST["InputPasswordLogin"];
	$email = $_POST["InputEmailLogin"];

	$resp = User::getUserByEmailAndPassword($email, $userPassword);

	if($resp) {
		session_start();
		$_SESSION['id'] = $resp['USER_ID'];
		$_SESSION['username'] = $resp['USERNAME']; 
		$_SESSION['email'] = $resp['EMAIL'];
		$_SESSION['firstName'] = $resp['FIRST_NAME'];
		$_SESSION['secondName'] = $resp['SECOND_NAME'];
		$_SESSION['lastNames'] = $resp['LAST_NAME'];
		$_SESSION['profilePicture'] = $resp['PROFILE_PICTURE'];
		$_SESSION['accountType'] = $resp['ACCOUNT_TYPE'];

		$resp = true;
	} 

	echo json_encode($resp);

?>