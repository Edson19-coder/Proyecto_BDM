<?php 

	class Category {

		private $db;

		public function __construct(){
      
        }

        public static function createCategory($categoryName) {
        	$db = Connection::connect();
        	return $result = $db->query("CALL proc_categories('I', null, '".$categoryName."')"); 
        	Connection::disconnect($db);
        }

        public static function getCategoryByName($categoryName) {
        	$db = Connection::connect();
			$result = $db->query("CALL proc_categories('C', null, '".$categoryName."')");
			if($result){
                while ($category = $result->fetch_assoc()) { 
                    return $category;
                }
			} else {
	             echo("No existe esta categoria en la DB.");
			}

			Connection::disconnect($db);
        }

        public static function getAllCategories() {
        	$db = Connection::connect();
			$result = $db->query("CALL proc_categories('SA', null, null)");
			if($result){
				$categories = array();

                while ($category = $result->fetch_assoc()) { 
                    $categories[] = $category;
                }

                return $categories;
			} else {
				echo('No existe esta categoria en la DB.');
			}

			Connection::disconnect($db);
        }
	}
	
 ?>