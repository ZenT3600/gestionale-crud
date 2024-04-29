<!doctype html>
<html>
  <head>
    <?php include 'db-config.php';?>
    <script src='global-style.js'></script>
    <title>Gestionale CRUD - Modify</title>
  </head>
  <body>
    <?php
      if (!isset($_GET["tabella"])) {
          die("Catch this later (tabella is not set)");
      }

      if (!isset($_GET["id"])) {
        die("Catch this later (id is not set)");
      }

      $TABELLA = $_GET["tabella"];
      if (!in_array($TABELLA, array("songs", "albums", "artist"))) {
        die("Catch this later (tabella contains an illegal value)");
      }

      $ID = $_GET["id"];
      // https://stackoverflow.com/a/29018655
      if (strval($ID) !== strval(intval($ID))) {
        die("Catch this later (id contains an illegal value)");
      }

      $conn = connectToDB();

      if (sizeof($_GET) > 2) {
        $STRING = "UPDATE " . $TABELLA . " SET ";
        $KEYS = array_keys($_GET);
        for ($i = 2; $i < sizeof($_GET); $i++) {
          $STRING = $STRING . $KEYS[$i] . "='" . $_GET[$KEYS[$i]] . "'";
          if ($i < sizeof($_GET) - 1) {
            $STRING = $STRING . ", ";
          }
        }
        $STRING = $STRING . " WHERE ID = " . $ID . ";";
        $conn->query($STRING);
      }

      echo "<h1>Modifying " . $TABELLA . "</h1>";

      $query_string = "SELECT * FROM " . $TABELLA . " WHERE ID = " . $ID . ";";
      $query_result = $conn->query($query_string);
      if ($query_result->num_rows == 1) {
        $riga = $query_result->fetch_assoc();
        $colonne = array_keys($riga);
        $numero_colonne = sizeof($colonne);

        echo "<form action='modify.php' method='GET'>";
        echo "<input type='hidden' name='tabella' value='" . $TABELLA . "'/>";
        echo "<input type='hidden' name='id' value='" . $ID . "'/>";
        echo "<table><tr>";
        for ($i = 0; $i < $numero_colonne; $i++) {
          echo "<th>" . $colonne[$i] . "</th>";
        }
        echo "<th>Azioni</th></tr>";
        for ($i = 0; $i < $numero_colonne; $i++) {
          $valore_attuale = $riga[$colonne[$i]];
          echo "<td><input name='" . $colonne[$i] . "' value='" . $valore_attuale . "'/></td>";
        }
        echo "<td><input type=submit value=OK></td></table>";
        echo "</form>";
      } else {
        die("Catch this later (no result from query)");
      }
    ?>
  </body>
</html>
