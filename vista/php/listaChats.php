<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cirso - Mensajes</title>
  <link rel="stylesheet" href="../css/listaChatsStyle.css">
  <link rel="icon" href="../img/logo.png" type="image/x-icon">
</head>
<body>

<?php
  include "../../common/php/connect.php";

  if (isset($_SESSION['id'])){

    $id = $_SESSION['id'];

    $sqlc = "SELECT id_tipo 
    FROM usuarios
    WHERE id = $id";

    $resultc = $conn->query($sqlc);
    $rowc = $resultc->fetch_assoc();

    $whereClause = "id_usuario_solicita = " . $_SESSION['id'] . " OR id_usuario_pub = " . $_SESSION['id'];
    $chatCount = 1;

    $sql = "SELECT c.id, i.nombre
    FROM chats c
    INNER JOIN publicaciones p ON c.id_publicacion = p.id
    INNER JOIN items i ON p.id_item = i.id
    WHERE " . $whereClause ."
    ORDER BY c.fecha ASC";

    $mysqliresult = $conn->query($sql);
    
    if (!$mysqliresult) {
      die("Query failed: " . $conn->error);
    }

    $results = $mysqliresult->fetch_all(MYSQLI_ASSOC);

    $sql2 = "SELECT usuario,
    c.id,
    m.fecha,
    texto,
    nombre
    FROM mensajes m
    INNER JOIN chats c ON c.id = m.id_chat
    INNER JOIN publicaciones p ON p.id = c.id_publicacion
    INNER JOIN items i ON i.id = p.id_item
    INNER JOIN usuarios u ON u.id = m.id_usuario
    WHERE id_usu_rec = " . ($_SESSION['id']) . "
    ORDER BY fecha DESC
    LIMIT 3";

    $mysqliresult2 = $conn->query($sql2);

    if (!$mysqliresult2) {
      die("Query failed: " . $conn->error);
    }

    $results2 = $mysqliresult2->fetch_all(MYSQLI_ASSOC);

  } else {
    header("Location: login.php");
  }

  $conn->close();

?>

<header>
  <div class="top-bar">
    <img src="../img/logo.png" alt="Cirso Logo" class="logo">
    <input type="text" class="search-bar" placeholder="Buscar chat...">
    <div class="icons">
      <a href="usuario.php"><img src="../img/user.png"></a>
      <?php if ($rowc['id_tipo'] == 1): ?>
        <a href="admin.php"><img src="../img/admin.png" alt="admin"></a>
      <?php else: ?>
        <a href="../html/soporte.html"><img src= "../img/support.png" alt="ayuda"></a>
      <?php endif; ?>
      <a href="categorias.php"><img src="../img/caja.png"></a>
    </div>
  </div>
</header>

<div class="container">
  <!-- Sección de mensajes recientes -->
  <div class="mensajes">
    <h4>Mensajes recientes</h4>
    <?php foreach ($results2 as $item2): ?>
      <div class="mensaje">
        <h4><?= htmlspecialchars($item2['usuario'], ENT_QUOTES, 'UTF-8') ?>, <?= htmlspecialchars($item2['nombre'], ENT_QUOTES, 'UTF-8') ?></h4>
        <p><?= htmlspecialchars($item2['texto'], ENT_QUOTES, 'UTF-8') ?></p>
        <p><?= htmlspecialchars($item2['fecha'], ENT_QUOTES, 'UTF-8') ?></p>
        <p><a href="chat.php?cid=<?= $item2['id'] ?>">Abrir</a></p>
      </div>
    <?php endforeach; ?>
  </div>

  <!-- Sección principal de los chats -->
  <main class="messages-section">
    <div class="message-box">
      <h2><a href="#">Tus chats</a></h2>
    </div>

    <div class="no-messages">
      <?php if ($mysqliresult->num_rows == 0): ?>
        <i class="message-envelope">✉️</i>
        <p>NO TIENES NINGÚN MENSAJE</p>
        <p>Cuando alguien te envíe algún mensaje aparecerá aquí</p>
      <?php else: ?>
        <?php foreach ($results as $item): ?>
          <div class="msg">
            <h3>Chat <?= htmlspecialchars($chatCount, ENT_QUOTES, 'UTF-8') ?></h3>
            <p>ID Chat: <?= htmlspecialchars($item['id'], ENT_QUOTES, 'UTF-8') ?></p>
            <p>Publicación: <?= htmlspecialchars($item['nombre'], ENT_QUOTES, 'UTF-8') ?></p>
            <a href="chat.php?cid=<?= $item['id'] ?>">Abrir</a>
          </div>
          <?php $chatCount++; ?>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </main>
</div>


    <footer>
      <a href="../html/politicasPrivacidad.html">Políticas privacidad</a>
      <a href="../html/politicasCookies.html">Políticas de cookies</a>
      <a href="../html/avisoLegal.html">Aviso Legal</a>
      <a href="../html/soporte.html">Centro de asistencia</a>
    </footer>

</body>
</html>
