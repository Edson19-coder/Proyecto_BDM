<?php


class Connection{

public static function connect() {
		$databasehost = "localhost";
		$databasename = "bdm_pia";
		$databaseuser = "root";
		$databasepass = "";

		$attemp = true;
		$tries = 0;

		do{
			$mysqli = new mysqli($databasehost, $databaseuser, $databasepass, $databasename);
			if ($mysqli->connect_errno) {
				$databasehost = "localhost:3307";
				$mysqli = new mysqli($databasehost, $databaseuser, $databasepass, $databasename);
				if($mysqli->connect_errno && $tries > 0){
					echo "Error con la conexion a la base de datos";
				}else{
					$attemp = false;
				}
			}else{
				$attemp = false;
			}

			$tries++;
		}while($attemp);

		return $mysqli;
	}

public static function disconnect($mysqli) {
		mysqli_close($mysqli);
	}




}

?>
