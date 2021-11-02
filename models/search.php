<?php

    require_once('../db/db.php');

    class Search {
        
        private $db;

		public function __construct(){
      
        }

        public static function getCourseByTitle($searchText) {
            $db = Connection::connect();
			$result = $db->query("CALL proc_search('SS', '".$searchText."', null, null, null, null);");
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

        public static function getCourseByFilter($title, $ownerName, $fromDate, $toDate, $categoryId) {

            $vtitle = !empty($title) ? "'".$title."'" : 'null';
            $vownerName = !empty($ownerName) ? "'".$ownerName."'" : 'null';
            $vfromDate = !empty($fromDate) ? "'".$fromDate."'" : 'null';
            $vtoDate = !empty($toDate) ? "'".$toDate."'" : 'null';
            $vcategoryId = !empty($categoryId) ? "'".$categoryId."'" : 'null';

            $db = Connection::connect();
            if(!empty($categoryId)){
                $result = $db->query("CALL proc_search('SF', ".$vtitle.", ".$vownerName.", ".$vfromDate.", ".$vtoDate.", ".$vcategoryId.");");
            } else {
                $result = $db->query("CALL proc_search('SF', ".$vtitle.", ".$vownerName.", ".$vfromDate.", ".$vtoDate.", null);");
            }
			if($result){
				$courses = array();
				while ($course = $result->fetch_assoc()) {
                    $courses[] = $course;
                }
                return $courses;
			}else{
				echo("CALL proc_search('SF', ".$vtitle.", ".$vownerName.", ".$vfromDate.", ".$vtoDate.", ".$vcategoryId.");");
				return null;
			}
			Connection::disconnect($db);
        }

        public static function getAllCourses() {
            $db = Connection::connect();
			$result = $db->query("CALL proc_search('SA', null, null, null, null, null);");
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
    }

?>