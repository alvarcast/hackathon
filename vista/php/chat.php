<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tus chats</title>
    <link rel="stylesheet" href="../css/chatStyle.css">
    <link rel="icon" href="../img/logo.png" type="image/x-icon">
</head>
<body>

<?php

    include '../../common/php/connect.php';

    if (isset($_SESSION['id'])){
        // Verifica si se proporcionó el parámetro 'cid'
        if (!isset($_GET["cid"])) {
            exit;
        }
    
        $cid = intval($_GET['cid']); // Convierte a entero para evitar inyecciones

        $sql = "SELECT 
        id_usuario_solicita,
        id_usuario_pub
        FROM chats
        WHERE id = " . $cid;

        $result = $conn->query($sql);
        $result && $row = $result->fetch_assoc();

        $iuSolicita = $row['id_usuario_solicita']; // Assign id_usuario_solicita to $ius
        $iuPublica = $row['id_usuario_pub'];      // Assign id_usuario_pub to $iup

        echo "Solicita: " . $iuSolicita . " ";
        echo "Publica: " . $iuPublica. " ";

        $sqlc = "SELECT
        id_tipo
        FROM usuarios
        WHERE id = " . $_SESSION['id'];

        $resultc = $conn->query($sqlc);
        $rowc = $resultc->fetch_assoc();

        if ($_SESSION['id'] == $iuSolicita || $_SESSION['id'] == $iuPublica || $_SESSION['id'] == $rowc['id_tipo']) {

            if ($_SESSION['id'] == $iuSolicita) {
                $idRecibeMsg = $iuPublica;
            } else if ($_SESSION['id'] == $iuPublica) {
                $idRecibeMsg = $iuSolicita;
            }

            $sql = "SELECT texto,
            fecha,
            id_usuario,
            usuario
            FROM mensajes m
            INNER JOIN usuarios u ON u.id = m.id_usuario
            WHERE id_chat = " . $cid . "
            ORDER BY fecha ASC";
        
            $mysqliresult = $conn->query($sql);
            $messages = $mysqliresult->fetch_all(MYSQLI_ASSOC);

            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['mensaje'])) {
                $mensaje = trim($_POST['mensaje']); // Obtén el mensaje del formulario
            
                if (!empty($mensaje)) {
                    $id_usuario = $_SESSION['id'];
                    $fecha = date('Y-m-d H:i:s'); // Fecha y hora actuales
            
                    // Inserción del mensaje en la BD
                    $stmt = $conn->prepare("INSERT INTO mensajes (id_chat, id_usuario, id_usu_rec, fecha, texto) VALUES (?, ?, ?, ?, ?)");
                    $stmt->bind_param("iiiss", $cid, $id_usuario, $idRecibeMsg, $fecha, $mensaje);
            
                    if ($stmt->execute()) {
                        $stmt->close();
                        // Redirige para evitar reenvío del formulario
                        header("Location: " . $_SERVER['PHP_SELF'] . "?cid=" . $cid);
                        exit; // Asegura que no se siga ejecutando el script
                    }
                }
            }
            
        } else {
            header("Location: categorias.php");
        }

    } else {
        header("Location: login.php");
    }

    $conn->close();

?>

<a href="categorias.php">Inicio</a>
<a href="listaChats.php">Chats</a>

<div class="chat-container">
    <?php foreach ($messages as $message): ?>
        <?php if ($message['id_usuario'] == $_SESSION['id']): ?>
            <div class="message-right">
                <h3><?= htmlspecialchars($message['usuario'], ENT_QUOTES, 'UTF-8') ?></h3>
                <h2><?= htmlspecialchars($message['texto'], ENT_QUOTES, 'UTF-8') ?></h2>
                <p><?= htmlspecialchars($message['fecha'], ENT_QUOTES, 'UTF-8') ?></p>
            </div>
        <?php else: ?>
            <div class="message-left">
                <h3><?= htmlspecialchars($message['usuario'], ENT_QUOTES, 'UTF-8') ?></h3>
                <h2><?= htmlspecialchars($message['texto'], ENT_QUOTES, 'UTF-8') ?></h2>
                <p><?= htmlspecialchars($message['fecha'], ENT_QUOTES, 'UTF-8') ?></p>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>

    <!-- Formulario de envío de mensaje -->
    <form class="chat-form" method="POST" action="">
        <textarea name="mensaje" placeholder="Escribe tu mensaje aquí..." rows="2" required></textarea>
        <button type="submit">Enviar</button>
    </form>
</div>
    
</body>
</html>