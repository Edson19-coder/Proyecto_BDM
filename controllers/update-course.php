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

  echo json_encode($resp);

 ?>
