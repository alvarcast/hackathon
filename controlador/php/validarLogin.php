<?php

include "../../common/php/connect.php";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
  die("Conexión fallida: " . $conn->connect_error);
}

session_start();

$usuario = $_POST['usuario'];
$contrasenia = $_POST['contrasenia'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $sql = "SELECT id FROM usuarios WHERE nombres = '".$usuario."'";

    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $_SESSION['id'] = $row['id'];

    if($result->num_rows == 1){

        $sql = "SELECT id FROM usuarios WHERE teléfono = '".$contrasenia."' AND id = ". $_SESSION['id'];
        $result = $conn->query($sql);

        if($result->num_rows == 1){

            //header("Location: ../../../FrontPage/index.php");
            echo "Sesión iniciada correctamente";

        }else{

           header("location: ../../vista/php/login.php?control=3");

        }

    }else{
        header("location: ../../vista/php/login.php?control=2");
    }
}

$conn -> close();