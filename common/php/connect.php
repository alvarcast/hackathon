<?php
$servername = "localhost";
$username = "user";
$password = "1234";
$database = "hackathon";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
  die("Conexión fallida: " . $conn->connect_error);
}

session_start();
?>