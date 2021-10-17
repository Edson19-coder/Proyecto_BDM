<?php

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
	}
?>