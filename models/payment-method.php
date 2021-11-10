<?php

  class PaymentMethod {

    private $db;

    public function __construct(){

        }

    public static function createPaymentMethod($user, $method, $cardHolder, $cardNumber, $expMonth, $expYear, $ccv) {
      $db = Connection::connect();
			$result = $db->query("CALL proc_payment_method('I', null, ".$user.", '".$method."', '".$cardHolder."', '".$cardNumber."', '".$expMonth."', '".$expYear."', '".$ccv."')");
      return $result;
      Connection::disconnect($db);
    }

    public static function updatePaymentMethod($paymentMethodId, $method, $cardHolder, $cardNumber, $expMonth, $expYear, $ccv) {
      $db = Connection::connect();
			$result = $db->query("CALL proc_payment_method('U', ".$paymentMethodId.", null, '".$method."', '".$cardHolder."', '".$cardNumber."', '".$expMonth."', '".$expYear."', '".$ccv."')");
      return $result;
      Connection::disconnect($db);
    }

    public static function selectPaymentMethodByUser($IdUser) {
      $db = Connection::connect();
			$result = $db->query("CALL proc_payment_method('SAU', null, ".$IdUser.", null, null, null, null, null, null)");

			if($result){
				$cards = array();

				while($card = $result->fetch_assoc()){
					$cards[] = $card;
				}
				return $cards;

			}else{
				echo('No hay tarjetas para este usuario');
			}
			Connection::disconnect($db);
    }

    public static function selectValidatePaymentMethod($paymentMethodId, $cardNumber, $ccv) {
      $db = Connection::connect();
			$result = $db->query("CALL proc_payment_method('VPM', ".$paymentMethodId.", null, null, null, '".$cardNumber."', null, null, '".$ccv."')");

			if($result){

				while($card = $result->fetch_assoc()){
					return $card;
				}

			}else{
				echo('No existe esta tarjeta');
			}
			Connection::disconnect($db);
    }

    public static function selectPaymentMethodById($paymentMethodId) {
      $db = Connection::connect();
			$result = $db->query("CALL proc_payment_method('S', ".$paymentMethodId.", null, null, null, null, null, null, null)");

			if($result){

				while($card = $result->fetch_assoc()){
					return $card;
				}

			}else{
				echo('No existe esta tarjeta');
			}
			Connection::disconnect($db);
    }

    public static function deletePaymentMethodById($paymentMethodId) {
      $db = Connection::connect();
			$result = $db->query("CALL proc_payment_method('D', ".$paymentMethodId.", null, null, null, null, null, null, null)");
      return $result;
      Connection::disconnect($db);
    }


  }

 ?>
