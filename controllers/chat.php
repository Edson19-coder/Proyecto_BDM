<?php
  header('Access-Control-Allow-Origin: *');
  require_once('../db/db.php');
  require_once('../models/messages.php');

  $resp = null;
  $action = $_POST["vAction"];

  if($action == 'I') {
    $content = $_POST["InputContentMessage"];
    $idEmmiter = $_POST["InputIdEmmiter"];
    $idReceiver = $_POST["InputIdReceiver"];

    $resp = Messages::createMessage($content, $idEmmiter, $idReceiver);
  }
  else if($action == 'SP') {
    $userId = $_POST["InputUserId"];

    $resp = Messages::getPreviewsMessages($userId);
  }
  else if($action == 'SA') {
    $idEmmiter = $_POST["InputIdEmmiter"];
    $idReceiver = $_POST["InputIdReceiver"];

    $resp = Messages::getChatMessages($idEmmiter, $idReceiver);
  }
  else if($action == 'SU') {
    $userId = $_POST["InputUserId"];
    $searchText = $_POST["InputSearchText"];

    $resp = Messages::getSearchUsers($userId, $searchText);
  }

  echo json_encode($resp);

?>
