<?php
session_start(); 

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $conn = new mysqli("localhost", "root", "", "quiz");
    if ($conn->connect_error) {
        die("Connessione fallita: " . $conn->connect_error);
    }

    $flag = true;
    $i = 0;
    $somma = 0;

    while ($flag) {
        if (isset($_GET["punteggio$i"])) {
            $somma += floatval($_GET["punteggio$i"]);
            $i++;
        } else {
            $flag = false;
        }
    }
    $id_test = $_SESSION['idTest']; 
    $studente = $_SESSION['studente']; 
    $data_esecuzione = date('Y-m-d H:i:s'); 
    $select_query = "SELECT MAX(max_punteggio) AS max_valutazione FROM test";
    $result = $conn->query($select_query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $max_valutazione = $row['max_valutazione'];
        echo "<p>Il punteggio massimo del test è: $max_valutazione</p>";
    }
    $valutazione = $somma / $max_valutazione;
    $valutazione = $valutazione*10;
    $update_query = "UPDATE risposta_test SET valutazione = ? WHERE id_test = ? AND studente = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("dis", $valutazione, $id_test, $studente);

    if ($stmt->execute()) {
        echo "<p>Punteggio aggiornato correttamente.</p>";
    } else {
        echo "<p>Errore nell'aggiornamento del punteggio.</p>";
    }
    $stmt->close();
    $conn->close();
} else {
    echo "Nessun dato inviato.";
}
header("location: correggi_test.php");
?>
