<?php

include "../../common/php/connect.php";

$usuario = $_POST['usuario'];
$contrasenia = $_POST['contrasenia'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $sql = "SELECT id, estatus, id_tipo, lopdgdd FROM usuarios WHERE usuario = '".$usuario."'";
    $result = $conn->query($sql);

    $row = $result->fetch_assoc();
    $_SESSION['id'] = $row['id'];

    $estatus = $row['estatus'];
    $id_tipo = $row['id_tipo'];
    $lopdgdd = $row['lopdgdd'];

    if($result->num_rows == 1){

        if ($estatus == "SUSPENDIDO"){
            header("location: ../../vista/php/login.php?control=4");
        } else {

            if ($estatus == "INACTIVO"){
                $sql = "UPDATE usuarios SET estatus = 'ACTIVO' WHERE id = ". $_SESSION['id'];
                $conn->query($sql);
            }

            if ($lopdgdd == 0){
                $sql = "UPDATE usuarios SET lopdgdd = 1 WHERE id = ". $_SESSION['id'];
                $conn->query($sql);
            }

            $sql = "SELECT id FROM usuarios WHERE password = '".$contrasenia."' AND id = ". $_SESSION['id'];
            $result = $conn->query($sql);
    
            if($result->num_rows == 1){

                if ($id_tipo == 1){
                    header("location: ../../vista/php/admin.php");
                } else {
                    header("Location: ../../vista/php/categorias.php");
                }
    
            }else{
    
                header("location: ../../vista/php/login.php?control=3");
    
            }
        }

    }else{
        header("location: ../../vista/php/login.php?control=2");
    }
}

$conn -> close();