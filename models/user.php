<?php

	class User {

		private $db;
		private $user;

		public function __construct(){
      
        }


		public static function createUser($userName, $userPassword, $email, $firstName, $secondName, $lastName, $accountType) {
			$db = Connection::connect();
			$db->query("CALL proc_user('I', null, '".$userName."', '".$userPassword."', '".$email."', '".$firstName."', '".$secondName."', '".$lastName."', null, null, null, null, null, '".$accountType."', null)");
			Connection::disconnect($db);
		}

		public static function getUserByEmailAndPassword($email, $userPassword) {
			$db = Connection::connect();
			$result = $db->query("CALL  proc_user('L', null, null, '".$userPassword."', '".$email."', null, null, null, null, null, null, null, null, null, null)");
			if($result){
                while ($user = $result->fetch_assoc()) { 
                    return $user;
                }
			} else {
	             echo json_encode("No existe este usuario en la DB.");
	             return null;
			}

			Connection::disconnect($db);
		}
	}

?>