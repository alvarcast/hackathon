<?php

include "../../common/php/connect.php";

$usuario = $_POST['usuario'];
$contrasenia = $_POST['contrasenia'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $sql = "SELECT id, estatus FROM usuarios WHERE usuario = '".$usuario."'";
    $result = $conn->query($sql);

    $row = $result->fetch_assoc();
    $_SESSION['id'] = $row['id'];
    $estatus = $row['estatus'];

    if($result->num_rows == 1){

        if ($estatus == "SUSPENDIDO"){
            header("location: ../../vista/php/login.php?control=4");
        } else {

            if ($estatus == "INACTIVO"){
                $sql = "UPDATE usuarios SET estatus = 'ACTIVO' WHERE id = ". $_SESSION['id'];
                $result = $conn->query($sql);
            }

            $sql = "SELECT id FROM usuarios WHERE password = '".$contrasenia."' AND id = ". $_SESSION['id'];
            $result = $conn->query($sql);
    
            if($result->num_rows == 1){
    
                header("Location: ../../vista/php/categorias.php");
    
            }else{
    
                header("location: ../../vista/php/login.php?control=3");
    
            }
        }

    }else{
        header("location: ../../vista/php/login.php?control=2");
    }
}

$conn -> close();