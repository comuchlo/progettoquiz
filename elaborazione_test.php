<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once("./db_connection.php"); 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_POST["domande"])){
    echo "qualcosa è andato storto (>﹏<。)";
    die();
}
$json=json_encode($_POST);

$sql= $conn->prepare("INSERT INTO `risposta_test`(`id_test`, `risposte`, `studente`, `valutazione`) VALUES (?,?,?,NULL)");
$sql->bind_param("iss", $_GET["id"],$json, $_SESSION['username']);
if(!$sql->execute()){
    echo "qualcosa è andato storto (>﹏<。)";
    die();
}

header('location: test.php?id= '.$_GET['id'].' ');
die();
