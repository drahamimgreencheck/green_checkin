<?php
  //Connect to the database
  DEFINE('DB_USERNAME', 'root');
  DEFINE('DB_PASSWORD', 'root');
  DEFINE('DB_HOST', 'localhost');
  DEFINE('DB_DATABASE', 'green_check_users');

  $mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

  if (mysqli_connect_error()) {
    die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
  }


  if($_SERVER["REQUEST_METHOD"] == "GET") {

    /*
    CHECK IN
    */
    $id = $_GET["id"];
    if($_GET["action"] === 'checkin' && !empty($id)) {

      $sql = "SELECT * FROM `user_table` WHERE id='{$id}'";

      $userlist = $mysqli->query($sql);
      if (!empty($userlist)) {
        while($user = $userlist->fetch_assoc()) {
          $checkins = $user["checkins"];
          
          $sql = "UPDATE `user_table` SET `checkins` = '" . ($checkins + 1) . "' WHERE `user_table`.`id` = '{$id}'";
          $success = $mysqli->query($sql);

          if (mysqli_connect_error()) {
            die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
          }

          echo json_encode($user);
        }
      }
      else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
      }
    }
  }

  $mysqli->close();
?>