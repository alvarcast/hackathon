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
        if(isset($_GET["controlPub"])) { 
            $pubControl = $_GET['controlPub'];
            $pid = $_GET['pid'];
            if($pubControl != null){
                if($pubControl == 1){
                    $sql = "UPDATE publicaciones
                    SET control= 'aprobado', estatus= 'publicado'
                    WHERE id = '".$pid."';";
        
                    $mysqliresult = $conn->query($sql);
                }else if($pubControl == 2){
                    $sql = "UPDATE publicaciones
                    SET control= 'rechazado'
                    WHERE id = '".$pid."';";
        
                    $mysqliresult = $conn->query($sql);
                }else if($pubControl == 3){
                    $sql = "DELETE FROM publicaciones 
                    WHERE id = '".$pid."';";
        
                    $mysqliresult = $conn->query($sql);
                }
                header("Location: ../../../vista/php/admin.php#manage-publications");
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