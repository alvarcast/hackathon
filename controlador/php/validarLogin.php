<?php

include "../../common/php/connect.php";

$usuario = $_POST['usuario'];
$contrasenia = $_POST['contrasenia'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $sql = "SELECT id FROM usuarios WHERE usuario = '".$usuario."'";

    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $_SESSION['id'] = $row['id'];

    if($result->num_rows == 1){

        $sql = "SELECT id FROM usuarios WHERE password = '".$contrasenia."' AND id = ". $_SESSION['id'];
        $result = $conn->query($sql);

        if($result->num_rows == 1){

            header("Location: ../../vista/php/index.php?control=1");

        }else{

           header("location: ../../vista/php/login.php?control=3");

        }

    }else{
        header("location: ../../vista/php/login.php?control=2");
    }
}

$conn -> close();