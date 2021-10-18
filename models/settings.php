<?php

	class Settings{
		private $db;

		public function __construct(){

		}

		public static function updateProfilePicture($user, $image){
			$db = Connection::connect();
			$result = $db->query("UPDATE USERS SET PROFILE_PICTURE = '".$image."' WHERE USER_ID = ".$user.";");

			if($result){
				while($profilePic = $result->fetch_assoc()){
					return $profilePic;
				}
			}else{
				echo("Hay pedo en la db.");
				return null;
			}
			Connection::disconnect($db);
		}
	}
?>