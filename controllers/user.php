<?php
	session_start();

	header('Access-Control-Allow-Origin: *');
	require_once('../db/db.php');
	require_once('../models/user.php');

	$resp = null;
	$action = $_POST['vAction'];

	if($action == 'S'){
		if(isset($_POST['userId'])){
			$user = $_POST['userId'];
			$resp = User::getAllUserData($user);

			$resp["PROFILE_PICTURE"] = null;
		}else{
			echo "Error en el servicio";
		}
	}
	else if($action == 'U'){
		if(isset($_POST['userId'])){
			$resp = User::updateUserInformation($_POST['userId'], $_POST['username'], $_POST['firstName'], $_POST['secondName'], $_POST['lastName'], $_POST['country'], $_POST['state'], $_POST['city'], $_POST['postalCode'], $_POST['email'], $_POST['password'], $_POST['accountType']);

			$resp["PROFILE_PICTURE"] = null;

			$_SESSION['username'] = $resp["USERNAME"];
			$_SESSION['firstName'] = $resp['FIRST_NAME'];
			if($resp['SECOND_NAME'] != null){
				$_SESSION['secondName'] = $resp['SECOND_NAME'];
			}
			$_SESSION['country'] = $resp["COUNTRY"];
			$_SESSION['state'] = $resp['STATE'];
			$_SESSION['city'] = $resp['CITY'];
			$_SESSION['postalCode'] = $resp['POSTAL_CODE'];
			$_SESSION['email'] = $resp['EMAIL'];
			$_SESSION['userPassword'] = $resp['USER_PASSWORD'];
			$_SESSION['accountType'] = $resp['ACCOUNT_TYPE'];

			//print_r($resp);
		}else{
			echo "Error en el servicio";
		}
	}

	echo json_encode($resp);
?>