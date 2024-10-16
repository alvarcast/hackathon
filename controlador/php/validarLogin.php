<?php

include "../../common/php/connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $usuario = $_POST['usuario'];
    $contrasenia = $_POST['contrasenia'];

    $sql = "SELECT IdUsuario FROM usuarios WHERE NombreUsuario = '".$usuario."'";

    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $_SESSION['id'] = $row['IdUsuario'];

    if($result->num_rows == 1){

        $sql = "SELECT IdUsuario FROM usuarios WHERE Contrasenia = '".$contrasenia."' AND IdUsuario = ". $_SESSION['id'];
        $result = $conn->query($sql);

        if($result->num_rows == 1){

            header("Location: ../../../FrontPage/index.php");

        }else{

           header("location: login.php?control=3");

        }

    }else{
        header("location: login.php?control=2");
    }
}

$conn -> close();