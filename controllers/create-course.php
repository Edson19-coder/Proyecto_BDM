<?php 

	header('Access-Control-Allow-Origin: *');
	require_once('../db/db.php');
	require_once('../models/category.php');
	require_once('../models/course.php');
	require_once('../models/lesson.php');
	require_once('../models/media_lesson.php');

	$resp = null;

	$action = $_POST["vAction"];

	/* CATEGORIAS */
	
	if($action == 'CC') {
		$categoryName = $_POST["InputNameCategoryAdd"];
		$resp = Category::getCategoryByName($categoryName);
	} 
	else if($action == 'IC') {
		$categoryName = $_POST["InputNameCategoryAdd"];
		$resp = Category::createCategory($categoryName);
	}
	else if($action == 'SAC') {
		$resp = Category::getAllCategories();
	}
	else if($action == 'I') {

		$titleCourse = $_POST["InputTitle"];
		$shortDescriptionCourse = $_POST["InputShortDescription"];
		$longDescriptionCourse = $_POST["InputLongDescription"];
		$priceCourse = $_POST["InputPrice"];
		$instructorCourse = $_POST["InstructorCourse"];

		if (($_FILES["InputImage"]["type"] == "image/pjpeg") || ($_FILES["InputImage"]["type"] == "image/jpeg") || 
			($_FILES["InputImage"]["type"] == "image/png") || ($_FILES["InputImage"]["type"] == "image/gif")) {

			$imageCourse = addslashes(file_get_contents($_FILES["InputImage"]["tmp_name"]));

			$resp = Course::createCourse($titleCourse, $shortDescriptionCourse, $longDescriptionCourse, $priceCourse, $imageCourse, $instructorCourse);
    	}
	}
	else if($action == 'ICC') {

		$idCategory = $_POST["InputCategoryId"];
		$idCourse = $_POST["InputCourseId"];
		
		$resp = Course::createCourseCategories($idCategory, $idCourse);
	}
	else if($action == 'IL') {

		$titleLesson = $_POST["InputLessonTitle"];
		$descriptionLesson = $_POST["InputLessonDescription"];
		$priceLesson = $_POST["InputLessonPrice"];
		$idCourse = $_POST["InputCourseId"];

		$resp = lesson::createLesson($titleLesson, $descriptionLesson, $priceLesson, $idCourse);
	}
	else if($action == 'IML') {
		$destinoVideo = null;
		$destinoDocument = null;

		$idLesson = $_POST["InputLessonId"];

		if($idLesson) {
			$videoLesson = $_FILES["InputVideoLesson"]["name"];
			$imageLesson = $_FILES["InputImageLesson"]["tmp_name"] ? addslashes(file_get_contents($_FILES["InputImageLesson"]["tmp_name"])) : null;
			$documentLesson = $_FILES["InputFileLesson"]["name"];

			if($videoLesson) {
				$ruta = $_FILES["InputVideoLesson"]["tmp_name"];
				$destinoVideo = "../views/src/videos/".$idLesson."/".$videoLesson;

				$micarpeta = "../views/src/videos/".$idLesson;
				if (!file_exists($micarpeta)) {
					mkdir($micarpeta, 0777, true);
				}

				move_uploaded_file($ruta, $destinoVideo);
			}

			if($documentLesson) {
				$ruta = $_FILES["InputFileLesson"]["tmp_name"];
				$destinoDocument ="../views/src/documents/".$idLesson."/".$documentLesson;

				$micarpeta = "../views/src/documents/".$idLesson;
				if (!file_exists($micarpeta)) {
					mkdir($micarpeta, 0777, true);
				}

				move_uploaded_file($ruta, $destinoDocument);
			}

			$resp = MediaLesson::createMediaLesson($destinoVideo, $imageLesson, $destinoDocument, $idLesson);
		}
	}

	echo json_encode($resp);
 ?>