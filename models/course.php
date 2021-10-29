<?php

	require_once('../db/db.php');

	class Course {

		private $db;

		public function __construct(){
      
        }


		public static function createCourse($titleCourse, $shortDescriptionCourse, $longDescriptionCourse, $priceCourse, $imageCourse, $instructorCourse) {
			$db = Connection::connect();
			$result = $db->query("CALL proc_course('I', null, '".$titleCourse."', '".$shortDescriptionCourse."', '".$longDescriptionCourse."', '".$priceCourse."', 
									'".$imageCourse."', ".$instructorCourse.")");

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

		public static function createCourseCategories($idCategory, $idCourse) {
			$db = Connection::connect();
			$result = $db->query("CALL proc_course_categories('I', null, ".$idCategory.", ".$idCourse.")");

			return $result;
			
			Connection::disconnect($db);
		}

		public static function selectAllFromCourses(){
			$db = Connection::connect();
			$result = $db->query("CALL proc_course('SA', null, null, null, null, null, null, null);");

			if($result){
				while ($lastId = $result->fetch_assoc()){
					return $lastId;
				}
			}else{
				echo("Error.");
				return null;
			}
			Connection::disconnect($db);
		}

		public static function selectNewestCourses(){
			$db = Connection::connect();
			$result = $db->query("CALL proc_course('SANI', null, null, null, null, null, null, null);");
			//print_r($result);
			if($result){
				$courses = array();
				while ($course = $result->fetch_assoc()) {
                    $courses[] = $course;
                }
                return $courses;
			}else{
				echo("Error, no trae nada de la db.");
				return null;
			}
			Connection::disconnect($db);
		}

		public static function selectPopularCourses(){
			$db = Connection::connect();
			$result = $db->query("CALL proc_course('SAPI', null, null, null, null, null, null, null);");
			if($result){
				$courses = array();
				while ($course = $result->fetch_assoc()) {
                    $courses[] = $course;
                }
                return $courses;
			}else{
				echo("Error, no trae nada de la db.");
				return null;
			}
		}

		public static function selectCourseById($idCourse){
			$db = Connection::connect();
			$result = $db->query("CALL proc_course('SCID', '".$idCourse."', null, null, null, null, null, null);");
			if($result){
				while($course = $result->fetch_assoc()){
					return $course;
				}
			}else{
				echo("Error, este curso no existe.");
				return null;
			}
		}

		public static function userHasCourse($idCourse, $idUser){
			$db = Connection::connect();
			$result = $db->query("CALL proc_purchases('UHC', ".$idCourse.", null, ".$idUser.");");
			if($result){
				while($course = $result->fetch_assoc()){
					return $course;
				}
			}else{
				echo("Error, este curso no existe.");
				return 0;
			}
		}
	}
?>