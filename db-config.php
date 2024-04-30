<?php
  function connectToDB() {
    $DBHOST = "localhost:3306";
    $DBUSER = "dbmaster";
    $DBPASS = "123456";
    $DBDATABASE = "gestionale";

    $conn = new mysqli($DBHOST, $DBUSER, $DBPASS, $DBDATABASE);
    if ($conn->connect_errno) {
      showError("Errore SQL", "Connesione al DB fallita");
    }
    return $conn;
  }
?>
