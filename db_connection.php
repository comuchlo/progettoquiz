<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "quiz";

// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

  // require_once("./db_connection.php"); //gives mysqli global $conn