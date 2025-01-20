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
        if(isset($_GET["controlChat"])) { 
            $chatcontrol = $_GET['controlChat'];
            $cid = $_GET['cid'];
            if($chatcontrol != null){
                if($chatcontrol == 1){
                    header("Location: ../../../vista/php/chat.php?cid=$cid");
                }else if($chatcontrol == 2){
                    $sql = "DELETE FROM chats
                    WHERE id = '".$cid."';";
        
                    $mysqliresult = $conn->query($sql);
                    header("Location: ../../../vista/php/admin.php#manage-chats");
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