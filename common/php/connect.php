<?php
$servername = "x";
$username = "x";
$password = "x";
$database = "x";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

session_start();