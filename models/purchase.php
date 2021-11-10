<?php
	class Purchase{
		private $db;

		public function __construct(){

		}

		public static function purchaseCourse($courseId, $userId, $cardType){
			$db = Connection::connect();
			$result = $db->query("CALL proc_purchases('I', ".$courseId.", null, ".$userId.", '".$cardType."');");
			return $result;
			Connection::disconnect($db);
		}

		public static function purchaseLesson($lessonId, $userId, $cardType){
			$db = Connection::connect();
			$return = $db->query("CALL proc_purchases('IL', null, ".$lessonId.", ".$userId.", '".$cardType."');");
			return $return;
			Connection::disconnect($db);
		}
	}
?>
