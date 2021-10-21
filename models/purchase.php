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

		public static function purchaseLesson($courseId, $lessonId, $userId){
			$db = Connection::connect();
			$db->query("CALL proc_purchases('IL', ".$courseId.", ".$lessonId.", ".$userId.");");
			Connection::disconnect($db);
		}
	}
?>