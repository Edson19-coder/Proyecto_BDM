<?php

  require_once('../db/db.php');

  class Messages {

    private $db;
    private $message = null;

    public function __construct(){

    }

    public static function createMessage($content, $idEmmiter, $idReceiver) {
        $db = Connection::connect();
        $result = $db->query("CALL proc_message('I', null, '".$content."', null, null, ".$idEmmiter.", ".$idReceiver.", null);");
        return $result;
        Connection::disconnect($db);
    }

    public static function getPreviewsMessages($userId) {
        $db = Connection::connect();
        $result = $db->query("CALL proc_message('SP', null, null, null, null, ".$userId.", null, null);");

        if($result) {
          $messages = array();
          while($message = $result->fetch_assoc()) {
            $messages[] = $message;
          }
          return $messages;
        } else {
          echo("Error, no trae nada de la db.");
  				return null;
        }
        Connection::disconnect($db);
    }

    public static function getChatMessages($idEmmiter, $idReceiver) {
      $db = Connection::connect();
      $result = $db->query("CALL proc_message('SA', null, null, null, null, ".$idEmmiter.", ".$idReceiver.", null);");

      if($result) {
        $messages = array();
        while($message = $result->fetch_assoc()) {
          $messages[] = $message;
        }
        return $messages;
      } else {
        echo("Error, no trae nada de la db.");
        return null;
      }
      Connection::disconnect($db);
    }

    public static function getSearchUsers($userId, $searchText) {
      $db = Connection::connect();
      $result = $db->query("CALL proc_message('SU', null, null, null, null, ".$userId.", null, '".$searchText."');");

      if($result) {
        $users = array();
        while($user = $result->fetch_assoc()) {
          $users[] = $user;
        }
        return $users;
      } else {
        echo("Error, no trae nada de la db.");
        return null;
      }
      Connection::disconnect($db);
    }
  }

 ?>
