<?php
	class Purchase{
		private $db;

		public function __construct(){

		}

		public static function purchaseCourse($courseId, $userId){
			$db = Connection::connect();
			$result = $db->query("CALL proc_purchases('I', ".$courseId.", null, ".$userId.");");
			return $result;
			Connection::disconnect($db);
		}

		public static function purchaseLesson($lessonId, $userId){
			$db = Connection::connect();
			$return = $db->query("CALL proc_purchases('IL', null, ".$lessonId.", ".$userId.");");
			return $return;
			Connection::disconnect($db);
		}
	}
?>