<?php

  class UpdateCourse{

    private $db;

		public function __construct(){}

      public static function getCourseInformationUpdate($idCourse){
  			$db = Connection::connect();
  			$result = $db->query("CALL proc_course('SUC', ".$idCourse.", null, null, null, null, null, null)");
  			if($result){
  				while($course = $result->fetch_assoc()){
  					return $course;
  				}
  			}else{
  				echo("Error, este curso no existe.");
  				return 0;
  			}
        Connection::disconnect($db);
  		}

      public static function getLessonInformationUpdate($idCourse){
  			$db = Connection::connect();
  			$result = $db->query("CALL proc_lesson('SALC', null, null, null, null, ".$idCourse.");");
  			if($result){
          $lessons = array();
  				while ($lesson = $result->fetch_assoc()) {
              $lessons[] = $lesson;
          }
          return $lessons;
  			}else{
  				echo("Error, este curso no existe.");
  				return 0;
  			}
        Connection::disconnect($db);
  		}

      public static function updateLessonData($lessonId, $lessonTitle, $lessonDescription, $lessonPrice) {
        $db = Connection::connect();
        $result = $db->query("CALL proc_lesson('U', ".$lessonId.", '".$lessonTitle."', '".$lessonDescription."', '".$lessonPrice."', null);");
        return $result;
        Connection::disconnect($db);
      }

  }

 ?>
