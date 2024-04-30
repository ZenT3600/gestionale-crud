<!doctype html>
<html>
  <head>
    <?php include 'main-imports.php';?>
    <title>Gestionale CRUD - Modify</title>
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

      if (sizeof($_GET) > 2) {
        $STRING = "UPDATE " . $TABELLA . " SET ";
        $KEYS = array_keys($_GET);
        for ($i = 0; $i < sizeof($_GET); $i++) {
          if (!in_array($KEYS[$i], array("tabella", "id"))) {
            continue;
          }
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
        showError("Errore SQL", "La query non ha riportato risultati");
      }
    ?>
  </body>
</html>
