<?php
session_start(); 

if (isset($_REQUEST)) {
    require_once("./db_connection.php");

    $punti = 0;
    foreach($_REQUEST['punteggi'] as $punteggi){
        $punti += floatval($punteggi);
    }

    $id_test = intval($_REQUEST["id"]); 
    $studente = $_SESSION['studente'];
    $data_esecuzione = date('Y-m-d H:i:s'); 
    $select_query = "SELECT MAX(max_punteggio) AS max_valutazione FROM test WHERE test.id = ".htmlspecialchars($id_test);
    $max_valutazione = $conn->query($select_query)->fetch_assoc()['max_valutazione'] ?? NULL;
    if ($max_valutazione!==NULL && is_numeric($max_valutazione)) {
        echo "<p>Il punteggio massimo del test è: $max_valutazione</p>";
        if($punti>$max_valutazione){
            header("location: visualizza_test_completato.php?id=".$_REQUEST['id']."&studente=".$_REQUEST['studente']."&error=1");
            echo "die";
            die();
        }else{
            $update_query = "UPDATE risposta_test SET valutazione = ? WHERE id_test = ? AND studente = ?";
            $stmt = $conn->prepare($update_query);
            $stmt->bind_param("dis", $punti, $id_test, $studente);
            if ($stmt->execute()) {
                echo "<p>Punteggio aggiornato correttamente.</p>";
            } else {
                header("location: visualizza_test_completato.php?id=".$_REQUEST['id']."&studente=".$_REQUEST['studente']."&error=1");
            }
        }
    }else{
        $update_query = "UPDATE risposta_test SET valutazione = ? WHERE id_test = ? AND studente = ?";
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param("dis", $punti, $id_test, $studente);
        if ($stmt->execute()) {
            echo "<p>Punteggio aggiornato correttamente.</p>";
        } else {
            header("location: visualizza_test_completato.php?id=".$_REQUEST['id']."&studente=".$_REQUEST['studente']."&error=1");
        }
    }

} else {
    echo "Nessun dato inviato.";
}
header("location: visualizza_test_completato.php?id=".$_REQUEST['id']."&studente=".$_REQUEST['studente']);