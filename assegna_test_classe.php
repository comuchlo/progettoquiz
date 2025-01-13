<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once("./db_connection.php"); 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_REQUEST["id"]) || !isset($_REQUEST["classe"])){
    echo "qualcosa è andato storto (>﹏<。)";
    die();
}

$sql= $conn->prepare("INSERT INTO `visibilita_test_classi`(`id_test`, `id_classe`) VALUES (?,?)");
$sql->bind_param("ii", $_REQUEST["id"], $_REQUEST["classe"]);
if(!$sql->execute()){
    echo "qualcosa è andato storto (>﹏<。)";
    die();
}

header('location: doc_test_menu.php?id= '.$_REQUEST['id'].' ');
die();
