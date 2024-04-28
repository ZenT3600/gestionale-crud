<?php
  function connectToDB() {
    $DBHOST = "localhost:3306";
    $DBUSER = "dbmaster";
    $DBPASS = "123456";
    $DBDATABASE = "gestionale";

    $conn = new mysqli($DBHOST, $DBUSER, $DBPASS, $DBDATABASE);
    if ($conn->connect_errno) {
      die("DB Error");
    }
    return $conn;
  }
?>
