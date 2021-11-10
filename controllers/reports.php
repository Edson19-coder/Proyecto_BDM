<?php

  header('Access-Control-Allow-Origin: *');
  require_once('../db/db.php');
  require_once('../models/reports.php');
  require_once('../models/lesson.php');

  $resp = null;
  $action = $_POST['vAction'];

  if($action == 'R1'){
    if(isset($_POST['userId'])){
      $user = $_POST['userId'];
      $resp = Reports::viewCourseReport1($user);
    }else{
      echo "Error en el servicio";
    }
  }
  else if($action == 'RC'){
    if(isset($_POST['userId'])){
      $user = $_POST['userId'];
      $resp = Reports::viewCourseReport1_C($user);
    }else{
      echo "Error en el servicio";
    }
  }
  else if($action == 'R2'){
    if(isset($_POST['courseId'])){
      $course = $_POST['courseId'];
      $resp = Reports::viewCourseReport2($course);
    }else{
      echo "Error en el servicio";
    }
  }
  else if($action == 'R2C'){
    if(isset($_POST['userId'])){
      $user = $_POST['userId'];
      $resp = Reports::viewCoursesByOwner($user);
    }else{
      echo "Error en el servicio";
    }
  }
  else if($action == 'R2CC') {
    if(isset($_POST['userId'])){
      $user = $_POST['userId'];
      $course = $_POST['courseId'];
      $resp = Reports::getDatesCoursesHistoryByUser($course, $user);
    }else{
      echo "Error en el servicio";
    }
  }
  else if($action == 'SL') {
    if(isset($_POST['idLesson'])){
      $idLesson = $_POST['idLesson'];
      $resp = Lesson::getLessonById($idLesson);
    }else{
      echo "Error en el servicio";
    }
  }
  else if($action == 'CERT') {
    if(isset($_POST['courseId'])){
      $course = $_POST['courseId'];
      $resp = Reports::getCertData($course);
    }else{
      echo "Error en el servicio";
    }
  }

  echo json_encode($resp);

 ?>
