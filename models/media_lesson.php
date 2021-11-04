<?php

	class MediaLesson {

		private $db;

		public function __construct(){

        }


		public static function createMediaLesson($videoLesson, $imageLesson, $documentLesson, $idLesson) {
			$imageLesson = !empty($imageLesson) ? "'".$imageLesson."'" : 'null';
			$documentLesson = !empty($documentLesson) ? "'".$documentLesson."'" : 'null';

			$db = Connection::connect();
			$result = $db->query("CALL proc_media_lesson('I', null, '".$videoLesson."', ".$imageLesson.", ".$documentLesson.", '".$idLesson."')");
			return $result;
			Connection::disconnect($db);
		}

		public static function updateMediaLesson($videoLesson, $imageLesson, $documentLesson, $idLesson) {
			$imageLesson = !empty($imageLesson) ? "'".$imageLesson."'" : 'null';
			$documentLesson = !empty($documentLesson) ? "'".$documentLesson."'" : 'null';

			$db = Connection::connect();
			$result = $db->query("CALL proc_media_lesson('U', null, '".$videoLesson."', ".$imageLesson.", ".$documentLesson.", ".$idLesson.")");
			return $result;
			Connection::disconnect($db);
		}
	}
?>
