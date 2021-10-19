<?php

	class Settings{
		private $db;
		private $profilePic = null;

		public function __construct(){

		}

		public static function updateProfilePicture($user, $image){
			$db = Connection::connect();
			$result = $db->query("CALL proc_user('UPP', '".$user."', null, null, null, null, null, null, null, null, null, null, '".$image."', null, null);");

			if($result){
				while($profilePic = $result->fetch_assoc()){
					return $profilePic;
				}
			}else{
				echo("Error en la db.");
				return null;
			}
			Connection::disconnect($db);
		}
	}
?>