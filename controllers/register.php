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

	$resp = User::createUser($userName, $userPassword, $email, $firstName, $secondName, $lastName, $accountType);

	echo json_encode($resp);

?>