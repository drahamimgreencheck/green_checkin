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
    if($_GET["action"] === 'checkin' && !empty($_GET["id"])) {

      $sql = "SELECT * FROM `user_table` WHERE id='{$_GET["id"]}'";

      $userlist = $mysqli->query($sql);
      if (!empty($userlist)) {
        while($row = $userlist->fetch_assoc()) {
          echo $row["name"];
        }
      }
      else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
      }
    }
  }

  $mysqli->close();
?>