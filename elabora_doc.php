<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "quiz";

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $conn->real_escape_string($_POST['nome']);
    $cognome = $conn->real_escape_string($_POST['cognome']);
    $login = $conn->real_escape_string($_POST['login']);
    $password = $conn->real_escape_string($_POST['password']);
    $cf = $conn->real_escape_string($_POST['cf']);
    $ruolo = intval($_POST['ruolo']);

    $sql = "INSERT INTO utente (nome, cognome, login, password, codice_fiscale, ruolo) 
            VALUES ('$nome', '$cognome', '$login', '$password', '$cf', $ruolo)";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Docente aggiunto con successo!');
                window.location.href = 'insert_doc.php'; // Reindirizza alla pagina del form
              </script>";
    } else {
        echo "Errore durante l'inserimento: " . $conn->error;
    }
}

$conn->close();
?>
