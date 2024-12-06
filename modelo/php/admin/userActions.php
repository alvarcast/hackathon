<?php

include "../../../common/php/connect.php";

if(isset($_GET["controlUsr"])) { 
    $userControl = $_GET['controlUsr'];
    $usuario = $_GET['usuario'];
    if($userControl != null){
        if($userControl == 1){
            // Abrir chat
        }else if($userControl == 2){
            $sql = "UPDATE usuarios
            SET password = NULL, estatus= 'SUSPENDIDO'
            WHERE usuario = '".$usuario."';";

            $mysqliresult = $conn->query($sql);
        }else if($userControl == 3){
            $sql = "UPDATE usuarios
            SET password = 'p123456789', estatus= 'ACTIVO'
            WHERE usuario = '".$usuario."';";

            $mysqliresult = $conn->query($sql);
        }
        header("Location: ../../../vista/php/admin.php#manage-users");
    }
}

?>