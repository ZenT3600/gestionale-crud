<!doctype html>
<html>
  <head>
    <?php include 'main-imports.php';?>
    <title>Gestionale CRUD - Delete</title>
  </head>
  <body>
    <?php
      if (!isset($_GET["tabella"])) {
        showError("Parametro Mancante", "Il paramentro \"tabella\" è mancante");
      }

      if (!isset($_GET["id"])) {
        showError("Parametro Mancante", "Il paramentro \"id\" è mancante");
      }

      $TABELLA = $_GET["tabella"];
      if (!in_array($TABELLA, array("songs", "albums", "artist"))) {
        showError("Valore Illegale", "Il paramentro \"tabella\" contiene un valore illegale");
      }

      $ID = $_GET["id"];
      // https://stackoverflow.com/a/29018655
      if (strval($ID) !== strval(intval($ID))) {
        showError("Valore Illegale", "Il paramentro \"id\" contiene un valore illegale");
      }

      $conn = connectToDB();

      if (isset($_GET["OK"])) {
        $STRING = "DELETE FROM " . $TABELLA . " WHERE ID=" . $ID . ";";
        $conn->query($STRING);
        header("Location: read.php?tabella=" . $TABELLA);
        die();
      }

      echo "<h1>Deleting from " . $TABELLA . "</h1>";
    ?>
    <b>Are you sure?</b><br />
    <form action="delete.php" method="GET">
      <input type="hidden" name="OK" value="1" />
      <input type="hidden" name="tabella" value="<?php echo $TABELLA ?>" />
      <input type="hidden" name="id" value="<?php echo $ID ?>" />
      <input type="submit" value="Yes">
    </form>
  </body>
</html>
