<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tus chats</title>
    <link rel="stylesheet" href="../css/chatStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" href="../img/logo.png" type="image/x-icon">
</head>
<body>

<?php
    include '../../common/php/connect.php';

    if (isset($_SESSION['id'])) {
        if (!isset($_GET["cid"])) {
            exit;
        }
    
        $cid = intval($_GET['cid']);
        $sql = "SELECT 
        id_usuario_solicita,
        id_usuario_pub
        FROM chats
        WHERE id = " . $cid;

        $result = $conn->query($sql);
        $result && $row = $result->fetch_assoc();

        $iuSolicita = $row['id_usuario_solicita'];
        $iuPublica = $row['id_usuario_pub'];

        $sqlc = "SELECT id_tipo FROM usuarios WHERE id = " . $_SESSION['id'];
        $resultc = $conn->query($sqlc);
        $rowc = $resultc->fetch_assoc();

        if ($_SESSION['id'] == $iuSolicita || $_SESSION['id'] == $iuPublica || $_SESSION['id'] == $rowc['id_tipo']) {
            $idRecibeMsg = ($_SESSION['id'] == $iuSolicita) ? $iuPublica : $iuSolicita;

            $sql = "SELECT texto, fecha, id_usuario, usuario FROM mensajes m INNER JOIN usuarios u ON u.id = m.id_usuario WHERE id_chat = " . $cid . " ORDER BY fecha ASC";
            $mysqliresult = $conn->query($sql);
            $messages = $mysqliresult->fetch_all(MYSQLI_ASSOC);

            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['mensaje'])) {
                $mensaje = trim($_POST['mensaje']);
                if (!empty($mensaje)) {
                    $id_usuario = $_SESSION['id'];
                    $fecha = date('Y-m-d H:i:s');

                    $stmt = $conn->prepare("INSERT INTO mensajes (id_chat, id_usuario, id_usu_rec, fecha, texto) VALUES (?, ?, ?, ?, ?)");
                    $stmt->bind_param("iiiss", $cid, $id_usuario, $idRecibeMsg, $fecha, $mensaje);

                    if ($stmt->execute()) {
                        $stmt->close();
                        header("Location: " . $_SERVER['PHP_SELF'] . "?cid=" . $cid);
                        exit;
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

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<header class="top-bar">
        <div class="logo">
            <!-- Espacio para el logo -->
            <img src="../img/logo.png" alt="Logo" id="logo">
        </div>
        <div class="search-bar">
            <!-- Buscador -->
            <h1 class="nombreUsuario">Chat</h1>
        </div>
        <div class="icons">
            <!-- Iconos alineados a la derecha -->
            <a href="listaChats.php"><img src= "../img/back_arrow.png" alt="Volver" title="Volver"></a>
            <a href="usuario.php"><img src="../img/user.png" alt="perfil" title="Perfil"></a>
            <a href="../html/soporte.html"><img src= "../img/support.png" alt="ayuda" title="Ayuda"></a>
            <a href="listaChats.php"><img src= "../img/mesages.png" alt="mensajes" title="Mensajes"></a>
        </div>
    </header>

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

        <form class="chat-form" method="POST" action="">
            <textarea name="mensaje" placeholder="Escribe tu mensaje aquí..." rows="2" required></textarea>
            <button type="submit"> <i class="fa-solid fa-paper-plane"></i>Subir</button>
        </form>
    </div>
</body>
</html>

</html>
