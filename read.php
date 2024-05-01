
<!DOCTYPE html>
<html>
<head>
  
   
    <title>Visualizzazione Dati</title>
<?php include 'main-imports.php';?>
</head>

<body>
    <h2>Elenco delle Canzoni, Artisti e Album</h2>
    <?php
  $conn = connectToDB();

   
    // Array delle tabelle
    $tables = array("songs", "artist", "albums");

    // Iterazione attraverso le tabelle
    foreach ($tables as $table) {
        echo "<h3>$table</h3>";
        echo "<table>";
        // Query per ottenere i nomi delle colonne dalla tabella corrente
        $sql_columns = "SHOW COLUMNS FROM $table";
        $result_columns = $conn->query($sql_columns);

        if ($result_columns->num_rows > 0) {
            echo "<tr>";
            // Output dei nomi delle colonne come intestazioni della tabella HTML
            while($row_columns = $result_columns->fetch_assoc()) {
                echo "<th>" . $row_columns["Field"] . "</th>";
            }
            echo "</tr>";

            // Query per selezionare tutti i dati dalla tabella corrente
            $sql_data = "SELECT * FROM $table";
            $result_data = $conn->query($sql_data);

            if ($result_data->num_rows > 0) {
                // Output dei dati in una tabella HTML
                while($row_data = $result_data->fetch_assoc()) {
                    echo "<tr>";
                    foreach ($row_data as $key => $value) {
                        echo "<td>" . $value . "</td>";
                    }
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='" . $result_columns->num_rows . "'>Nessun dato trovato.</td></tr>";
            }
        } else {
            echo "<tr><td colspan='2'>Nessuna colonna trovata nella tabella $table.</td></tr>";
        }
        echo "</table>";
    }

    $conn->close();
    ?>
</body>
</html>