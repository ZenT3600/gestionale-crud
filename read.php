
<!DOCTYPE html>
<html>
  <head>
      <title>Gestionale CRUD - Read</title>
      <?php include 'main-imports.php';?>
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

      echo "<h1>Reading $TABELLA</h1>";
      echo "<table>";
      // Query per ottenere i nomi delle colonne dalla tabella corrente
      $sql_columns = "SHOW COLUMNS FROM $TABELLA";
      $result_columns = $conn->query($sql_columns);

      if ($result_columns->num_rows > 0) {
        echo "<tr>";
        // Output dei nomi delle colonne come intestazioni della tabella HTML
        while($row_columns = $result_columns->fetch_assoc()) {
          echo "<th>" . $row_columns["Field"] . "</th>";
        }
        echo "<th>Azioni</th>";
        echo "</tr>";

        // Query per selezionare tutti i dati dalla tabella corrente
        $sql_data = "SELECT * FROM $TABELLA";
        $result_data = $conn->query($sql_data);

        if ($result_data->num_rows > 0) {
          // Output dei dati in una tabella HTML
          while($row_data = $result_data->fetch_assoc()) {
            echo "<tr>";
            $idRiga = "";
            foreach ($row_data as $key => $value) {
              if ($key == "ID") $idRiga = $value;
              echo "<td>" . $value . "</td>";
            }
            echo "<td><button onclick=\"window.location.href = 'modify.php?tabella=" . $TABELLA . "&id=" . $idRiga . "'\">Modifica</button>
                  <button onclick=\"window.location.href = 'delete.php?tabella=" . $TABELLA . "&id=" . $idRiga . "'\">Rimuovi</button></td>";
            echo "</tr>";
          }
        } else {
          showError("Errore SQL", "La query non ha riportato risultati");
        }
      } else {
        showError("Errore SQL", "La query non ha riportato risultati");
      }
      echo "</table>";

      $conn->close();
    ?>
  </body>
</html>
