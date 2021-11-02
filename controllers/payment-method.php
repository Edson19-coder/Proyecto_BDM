<?php

  header('Access-Control-Allow-Origin: *');
  require_once('../db/db.php');
  require_once('../models/payment-method.php');

  $resp = null;
	$action = $_POST['vAction'];

  if($action == 'I') {
    $user = $_POST['user_id'];
    $method = $_POST['method'];
    $cardHolder = $_POST['cardHolder'];
    $cardNumber = $_POST['cardNumber'];
    $expMonth = $_POST['expMonth'];
    $expYear = $_POST['expYear'];
    $ccv = $_POST['ccv'];

    $resp = PaymentMethod::createPaymentMethod($user, $method, $cardHolder, $cardNumber, $expMonth, $expYear, $ccv);
  }
  else if($action == 'SAU') {
		$user = $_POST['user_id'];
		$resp = PaymentMethod::selectPaymentMethodByUser($user);
	}
  else if($action == 'S') {
    $paymentMethodId = $_POST['paymentMethodId'];
		$resp = PaymentMethod::selectPaymentMethodById($paymentMethodId);
  }
  else if($action == 'D') {
    $paymentMethodId = $_POST['paymentMethodId'];
		$resp = PaymentMethod::deletePaymentMethodById($paymentMethodId);
  }
  else if($action == 'U') {
    $paymentMethodId = $_POST['paymentMethodId'];
    $method = $_POST['method'];
    $cardHolder = $_POST['cardHolder'];
    $cardNumber = $_POST['cardNumber'];
    $expMonth = $_POST['expMonth'];
    $expYear = $_POST['expYear'];
    $ccv = $_POST['ccv'];

    $resp = PaymentMethod::updatePaymentMethod($paymentMethodId, $method, $cardHolder, $cardNumber, $expMonth, $expYear, $ccv);
  }
  else if($action == 'VPM') {
    $paymentMethodId = $_POST['paymentMethodId'];
    $cardNumber = $_POST['cardNumber'];
    $ccv = $_POST['ccv'];

		$resp = PaymentMethod::selectValidatePaymentMethod($paymentMethodId, $cardNumber, $ccv);
  }


  echo json_encode($resp);

 ?>
