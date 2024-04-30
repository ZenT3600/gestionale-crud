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

      

      $TABELLA = $_GET["tabella"];
      if (!in_array($TABELLA, array("songs", "albums", "artist"))) {
        showError("Valore Illegale", "Il paramentro \"tabella\" contiene un valore illegale");
      }

     

      $conn = connectToDB();

if (sizeof($_GET) > 1) {
	
        $STRING = "INSERT INTO " . $TABELLA . "(";
        $KEYS = array_keys($_GET);
        for ($i = 0; $i < sizeof($_GET); $i++) {
          if (in_array($KEYS[$i], array("tabella"))) {
            continue;
          }
          $STRING = $STRING . $KEYS[$i];
          if ($i < sizeof($_GET) - 1) {
            $STRING = $STRING . ", ";
          }
        }
        $STRING = $STRING . ") VALUES (";
		for ($i = 0; $i < sizeof($_GET); $i++) {
          if (in_array($KEYS[$i], array("tabella"))) {
            continue;
          }
          $STRING = $STRING . "'" . $_GET[$KEYS[$i]] . "'";
          if ($i < sizeof($_GET) - 1) {
            $STRING = $STRING . ", ";
          }
        }
		$STRING=$STRING . ");";
        $conn->query($STRING);
	   
      }


$query_string = "SELECT * FROM " . $TABELLA . ";";
      $query_result = $conn->query($query_string);
      if ($query_result->num_rows >= 1) {
        $riga = $query_result->fetch_assoc();
        $colonne = array_keys($riga);
        $numero_colonne = sizeof($colonne);

        echo "<form action='insert.php' method='GET'>";
        echo "<input type='hidden' name='tabella' value='" . $TABELLA . "'/>";
        echo "<table><tr>";
        for ($i = 0; $i < $numero_colonne; $i++) {
          echo "<th>" . $colonne[$i] . "</th>";
        }
        echo "<th>Azioni</th></tr>";
        for ($i = 0; $i < $numero_colonne; $i++) {
          
          echo "<td><input name='" . $colonne[$i] . "'/></td>";
        }
        echo "<td><input type=submit value=OK></td></table>";
        echo "</form>";
      } else {
        showError("Errore SQL", "La query non ha riportato risultati");
      }


     
    ?>
  </body>
</html>


