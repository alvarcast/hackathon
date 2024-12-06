<?php

include "../../../common/php/connect.php";

if(isset($_GET["controlChat"])) { 
    $chatcontrol = $_GET['controlChat'];
    $cid = $_GET['cid'];
    if($chatcontrol != null){
        if($chatcontrol == 1){
            // Abrir chat
        }else if($chatcontrol == 2){
            $sql = "DELETE FROM chats
            WHERE id = '".$cid."';";

            $mysqliresult = $conn->query($sql);
        }
        header("Location: ../../../vista/php/admin.php#manage-chats");
    }
}

?>