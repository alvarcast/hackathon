<?php
$servername = "191.234.212.17";
$username = "uax_dam";
$password = "%Uax2024h*";
$database = "Hackathonv1";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    echo "error";
} else {
    echo "Connected successfully";
}
?>