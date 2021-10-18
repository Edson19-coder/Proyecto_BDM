<?php

	class Lesson {

		private $db;

		public function __construct(){
      
        }


		public static function createLesson($titleLesson, $descriptionLesson, $priceLesson, $idCourse) {
			$db = Connection::connect();
			$result = $db->query("CALL proc_lesson('I', null, '".$titleLesson."', '".$descriptionLesson."', '".$priceLesson."', '".$idCourse."')");

			if($result){
                while ($lastId = $result->fetch_assoc()) { 
                    return $lastId;
                }
			} else {
	             echo("Error.");
	             return null;
			}

			Connection::disconnect($db);
		}
	}
?>