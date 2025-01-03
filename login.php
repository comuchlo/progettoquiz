<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['submit'])) {

    $usernameInput = $_POST['username'];
    $passwordInput = $_POST['password'];

    $servername = "localhost";
    $dbUsername = "root"; 
    $dbPassword = ""; 
    $database = "quiz";

    $conn = new mysqli($servername, $dbUsername, $dbPassword, $database);

    if ($conn->connect_error) {
        die("Connessione fallita: " . $conn->connect_error);
    }

    $sql = $conn->prepare("SELECT * FROM utente WHERE login = ? AND password = ?"); //MD5()
    $sql->bind_param("ss", $usernameInput, $passwordInput);
    $sql->execute();
    $result = $sql->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['username'] = $row['login'];
        $_SESSION['privilegi'] = $row['ruolo'];        
        header("location: menu.php");
    } else {
        header("location: index.php?login_error=1");
    }
    $sql->close();
    $conn->close();
}else{
    header("location: index.php");
}
?>
