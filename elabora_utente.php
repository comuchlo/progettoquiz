<?php
require_once("./db_connection.php");

if(isset($_POST["ag_ut"])){
    $nome = $conn->real_escape_string($_POST['nome']);
    $cognome = $conn->real_escape_string($_POST['cognome']);
    $login = $conn->real_escape_string($_POST['login']);
    $password = $conn->real_escape_string($_POST['password']);
    $cf = $conn->real_escape_string($_POST['cf']);
    $ruolo = intval($_POST['ruolo']);
    $sql = "INSERT INTO utente (nome, cognome, login, password, codice_fiscale, ruolo) 
            VALUES ('$nome', '$cognome', '$login', '$password', '$cf', $ruolo)";

    try {
        if ($conn->query($sql)) {
            if($ruolo==3){
                $classe = $conn->real_escape_string($_POST['classe']);
                $sql="INSERT INTO `associazioni_classi`(`classe_id`, `utente_login`) VALUES ('$classe', '$login');";
                $conn->query($sql);        
            }
            header("location: aggiunta_utente.php?success=1");
            die();
        } else {
            header("location: aggiunta_utente.php?error=$conn->error");
            die();
        }
    } catch (exception $e) {
        header("location: aggiunta_utente.php?error=$conn->error");
        die();
    }
}