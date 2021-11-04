<?php

  header('Access-Control-Allow-Origin: *');
  require_once('../db/db.php');
  require_once('../models/category.php');
  require_once('../models/course.php');
  require_once('../models/lesson.php');
  require_once('../models/media_lesson.php');
  require_once('../models/update-course.php');

  $resp = null;

  $action = $_POST["vAction"];

  if($action == 'SAC') {
		$resp = Category::getAllCategories();
	}
  else if($action == 'SCC') {
    $courseId = $_POST["courseId"];
    $resp = Category::getAllCategoriesByCourse($courseId);
  }
  else if($action == 'SUC') {
    $courseId = $_POST["courseId"];
    $resp = UpdateCourse::getCourseInformationUpdate($courseId);
  }
  else if($action == 'SALC') {
    $courseId = $_POST["courseId"];
    $resp = UpdateCourse::getLessonInformationUpdate($courseId);
  }
  else if($action == 'UCI') {
    $courseId = $_POST["courseId"];
    $titleCourse = $_POST["InputTitle"];
		$shortDescriptionCourse = $_POST["InputShortDescription"];
		$longDescriptionCourse = $_POST["InputLongDescription"];
		$priceCourse = $_POST["InputPrice"];

    if(isset($_FILES["InputImage"])) {
      if (($_FILES["InputImage"]["type"] == "image/pjpeg") || ($_FILES["InputImage"]["type"] == "image/jpeg") ||
  			($_FILES["InputImage"]["type"] == "image/png") || ($_FILES["InputImage"]["type"] == "image/gif")) {

          $imageCourse = addslashes(file_get_contents($_FILES["InputImage"]["tmp_name"]));
          $resp = Course::updateCourse($courseId, $titleCourse, $shortDescriptionCourse, $longDescriptionCourse, $priceCourse, $imageCourse);
        }
    } else {
      $resp = Course::updateCourse($courseId, $titleCourse, $shortDescriptionCourse, $longDescriptionCourse, $priceCourse, null);
    }
  }
  else if($action == 'DCC') {
    $courseId = $_POST["courseId"];
    $categoryId = $_POST["categoryId"];

    $resp = Category::deleteCategoryCourse($courseId, $categoryId);
  }
  else if($action == 'ULD') {
    $lessonId = $_POST["lessonId"];
    $lessonTitle = $_POST["InputLessonTitle"];
		$lessonDescription = $_POST["InputLessonDescription"];
		$lessonPrice = $_POST["InputLessonPrice"];

    $resp = UpdateCourse::updateLessonData($lessonId, $lessonTitle, $lessonDescription, $lessonPrice);
  }
  else if($action == 'UML') {
    $destinoVideo = null;
    $destinoDocument = null;

    $lessonId = $_POST["lessonId"];

    if($lessonId) {
      $videoLesson = isset($_FILES["InputVideoLessonEdit"]) ? $_FILES["InputVideoLessonEdit"]["name"] : null;
      $imageLesson = isset($_FILES["InputImageLessonEdit"]) ? addslashes(file_get_contents($_FILES["InputImageLessonEdit"]["tmp_name"])) : null;
      $documentLesson = isset($_FILES["InputFileLessonEdit"]) ? $_FILES["InputFileLessonEdit"]["name"] : null;

      if($videoLesson) {
        $ruta = $_FILES["InputVideoLessonEdit"]["tmp_name"];
        $destinoVideo = "../views/src/videos/".$lessonId."/".$videoLesson;

        $micarpeta = "../views/src/videos/".$lessonId;

        if (!file_exists($micarpeta)) {
					mkdir($micarpeta, 0777, true);
				} else {
          deleteDirectory($micarpeta);
          mkdir($micarpeta, 0777, true);
        }

        move_uploaded_file($ruta, $destinoVideo);
      }

      if($documentLesson) {
        $ruta = $_FILES["InputFileLessonEdit"]["tmp_name"];
        $destinoDocument = "../views/src/documents/".$lessonId."/".$documentLesson;

        $micarpeta = "../views/src/documents/".$lessonId;

        if (!file_exists($micarpeta)) {
					mkdir($micarpeta, 0777, true);
				} else {
          deleteDirectory($micarpeta);
          mkdir($micarpeta, 0777, true);
        }

        move_uploaded_file($ruta, $destinoDocument);
      }

      $resp = MediaLesson::updateMediaLesson($destinoVideo, $imageLesson, $destinoDocument, $lessonId);
    }

  }

  echo json_encode($resp);


  function deleteDirectory($dir) {
    if(!$dh = @opendir($dir)) return;
    while (false !== ($current = readdir($dh))) {
        if($current != '.' && $current != '..') {
            if (!@unlink($dir.'/'.$current))
                deleteDirectory($dir.'/'.$current);
        }
    }
    closedir($dh);
    @rmdir($dir);
}

 ?>
