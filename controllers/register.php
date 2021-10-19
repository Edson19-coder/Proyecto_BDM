<?php

	header('Access-Control-Allow-Origin: *');
	require_once('../db/db.php');
	require_once('../models/user.php');

	$userName = $_POST["InputUserRegister"];
	$userPassword = $_POST["InputPasswordRegister"];
	$email = $_POST["InputEmailRegister"];
	$firstName = $_POST["InputNameRegister"];
	$secondName = $_POST["InputSecondNameRegister"];
	$lastName = $_POST["InputLastNameRegister"];
	$accountType = $_POST["InputAccountType"];
	$imageDefault = addslashes(file_get_contents("../views/src/default/default-profile.png"));

	$resp = User::createUser($userName, $userPassword, $email, $firstName, $secondName, $lastName, $accountType, $imageDefault);

	echo json_encode($resp);

?>