<?php
include "../../common/php/connect.php";

if (isset($_SESSION['id'])) {

    // Check if 'oid' and 'pid' are present in the URL parameters
    if (isset($_GET['oid']) && isset($_GET['pid'])) {
        $oid = $_GET['oid'];
        $pid = $_GET['pid'];

        $sqlc = "SELECT id,
        id_usuario_solicita,
        id_usuario_pub
        FROM chats 
        WHERE id_publicacion = " . $pid . "
        AND (id_usuario_solicita = " . $_SESSION['id'] . " OR id_usuario_pub = " . $_SESSION['id'] . ")";

        $stmt = $conn->prepare($sqlc);

        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            $sql = "INSERT INTO chats (id_publicacion, id_usuario_solicita, id_usuario_pub, fecha) 
            VALUES (?, ?, ?, CURDATE())";

            // Prepare and bind to avoid SQL injection
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iii", $pid, $_SESSION['id'], $oid);

            if ($stmt->execute()) {
                // Redirect after successful insertion
                $cid = $conn->insert_id; // Get the inserted chat ID
            } else {
                die("Query failed: " . $conn->error);
            }
        } else {
            $row = $result->fetch_assoc();
            $cid = $row['id'];
        }

        header("Location: ../../vista/php/chat.php?cid=" . $cid);

    } else {
        // Handle the case where oid and pid are not set
        die("Required parameters are missing.");
    }
} else {
    // Redirect to login if the user is not logged in
    header("Location: login.php");
    exit;
}
?>
