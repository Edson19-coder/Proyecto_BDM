<?php
	require_once('../db/db.php');
	class Comment{
		private $db;

		public function __construct(){

        }

        public static function insertComment($courseId, $userId, $qualification, $content){
        	$db = Connection::connect();
        	$result = $db->query("CALL proc_comments('I', ".$courseId.", ".$userId.", '".$content."', ".$qualification.");");
        	return true;
        	Connection::disconnect($db);
        }

        public static function selectCourseComments($courseId){
        	$db = Connection::connect();
        	$result = $db->query("CALL proc_comments('SCC', ".$courseId.", null, null, null);");
        	if($result){
				$comments = array();
				while ($comment = $result->fetch_assoc()) {
                    $comments[] = $comment;
                }
                return $comments;
			}else{
				echo("Error, no trae nada de la db.");
				return null;
			}
        }
	}
?>