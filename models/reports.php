<?php

	class Reports {

		private $db;

		public function __construct(){
    }

    public static function viewCourseReport1($vUserId) {
			$db = Connection::connect();
			$result = $db->query("CALL  proc_reports('R1', null, ".$vUserId.");");

      if($result) {
        $reports = array();
        while($report = $result->fetch_assoc()) {
          $reports[] = $report;
        }
        return $reports;
      } else {
        echo("Error, no trae nada de la db.");
        return null;
      }
      Connection::disconnect($db);
		}

    public static function viewCourseReport1_C($vUserId) {
			$db = Connection::connect();
			$result = $db->query("CALL  proc_reports('RC', null, ".$vUserId.");");

      if($result) {
        while($report = $result->fetch_assoc()) {
          return $report;
        }
      } else {
        echo("Error, no trae nada de la db.");
        return null;
      }
      Connection::disconnect($db);
		}

    public static function viewCourseReport2($vCourseId) {
			$db = Connection::connect();
			$result = $db->query("CALL  proc_reports('R2', ".$vCourseId.", null);");

      if($result) {
        $reports = array();
        while($report = $result->fetch_assoc()) {
          $reports[] = $report;
        }
        return $reports;
      } else {
        echo("Error, no trae nada de la db.");
        return null;
      }
      Connection::disconnect($db);
		}

    public static function viewCoursesByOwner($vUserId) {
			$db = Connection::connect();
			$result = $db->query("CALL  proc_reports('R2C', null, ".$vUserId.");");

      if($result) {
        $courses = array();
        while($course = $result->fetch_assoc()) {
          $courses[] = $course;
        }
        return $courses;
      } else {
        echo("Error, no trae nada de la db.");
        return null;
      }
      Connection::disconnect($db);
		}

    public static function getDatesCoursesHistoryByUser($courseId, $userId){
      $db = Connection::connect();
      $result = $db->query("CALL proc_dates_courses(".$userId.", ".$courseId.")");

      if($result){
        while ($dates = $result->fetch_assoc()){
          return $dates;
        }
      }else{
        echo("Error.");
        return null;
      }
      Connection::disconnect($db);
    }

		public static function getCertData($courseId){
      $db = Connection::connect();
      $result = $db->query("CALL  proc_reports('CERT', ".$courseId.", null);");

      if($result){
        while ($dates = $result->fetch_assoc()){
          return $dates;
        }
      }else{
        echo("Error.");
        return null;
      }
      Connection::disconnect($db);
    }

	}

 ?>
