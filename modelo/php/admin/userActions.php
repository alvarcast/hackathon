<?php

include "../../../common/php/connect.php";

if (isset($_SESSION['id'])) {
    $sqlc = "SELECT
    id_tipo
    FROM usuarios
    WHERE id = " . $_SESSION['id'];

    $resultc = $conn->query($sqlc);
    $rowc = $resultc->fetch_assoc();

    if ($rowc['id_tipo'] == 1) {
        if(isset($_GET["controlUsr"])) { 
            $userControl = $_GET['controlUsr'];
            $usuario = $_GET['usuario'];
            if($userControl != null){
                if($userControl == 1){
                    $sql = "SELECT email
                    FROM usuarios
                    WHERE usuario = '".$usuario."';";
        
                    $mysqliresult = $conn->query($sql);
                    $row = $mysqliresult->fetch_assoc();
        
                    echo "Correo de este usuario: " . $row['email'] . "<br>";
                    echo "<a href='../../../vista/php/admin.php#manage-users'>Volver</a>";
                }else if($userControl == 2){
                    $sql = "UPDATE usuarios
                    SET password = NULL, estatus= 'SUSPENDIDO'
                    WHERE usuario = '".$usuario."';";
        
                    $mysqliresult = $conn->query($sql);
                    header("Location: ../../../vista/php/admin.php#manage-users");
                }else if($userControl == 3){
                    $sql = "UPDATE usuarios
                    SET password = 'p123456789', estatus= 'ACTIVO'
                    WHERE usuario = '".$usuario."';";
        
                    $mysqliresult = $conn->query($sql);
                    header("Location: ../../../vista/php/admin.php#manage-users");
                }
            }
        }
    } else {
        header("Location: ../../../common/php/disconnect.php");
    }

} else {
    header("Location: ../../../vista/php/login.php");
}

$conn->close();

?>