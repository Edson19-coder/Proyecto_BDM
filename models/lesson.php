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

		public static function getAllLessonsFromCourse($idCourse){
			$db = Connection::connect();
			$result = $db->query("CALL proc_lesson('ST', null, null, null, null, '".$idCourse."');");

			if($result){
				$lessons = array();

				while($lesson = $result->fetch_assoc()){
					$lessons[] = $lesson;
				}
				return $lessons;

			}else{
				echo('No hay lecciones de este curso');
			}
			Connection::disconnect($db);
		}

		public static function userHasLesson($idLesson, $idUser){
			$db = Connection::connect();
			$result = $db->query("CALL proc_purchases('UHL', null, ".$idLesson.", ".$idUser.");");
			if($result){
				while($lesson = $result->fetch_assoc()){
					return $lesson;
				}
			}else{
				echo("Error, este curso no existe.");
				return 0;
			}
		}
	}
?>