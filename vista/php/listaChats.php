<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cirso - Mensajes</title>
  <link rel="stylesheet" href="../css/listaChatsStyle.css">
  <link rel="icon" href="../img/logo sin nombre.png" type="image/x-icon">
</head>
<body>

  <?php
    include "../../common/php/connect.php";

    $whereClause = "id_usuario_solicita = " . $_SESSION['id'] . " OR id_usuario_pub = " . $_SESSION['id'];
    $chatCount = 1;

    $sql = "SELECT id,
    id_publicacion
    FROM chats
    WHERE " . $whereClause;

    $mysqliresult = $conn->query($sql);
    $results = $mysqliresult->fetch_all(MYSQLI_ASSOC);
  ?>

  <header>
    <div class="top-bar">
      <img src="../img/logo.png" alt="Cirso Logo" class="logo">
      <input type="text" class="search-bar" placeholder="Buscar chat...">
      <div class="icons">
        <a href="usuario.php"><img src="../img/user.png"></a>
        <a href="../html/soporte.html"><img src="../img/support.png"></a>
        <a href="categorias.php"><img src="../img/caja.png"></a>
      </div>
    </div>
  </header>

  <div class="container">
    <div class="mensajes">
      <h4>Mensajes</h4>
      <div class="mensaje">
        <!-- No puedo establecer el nombre del usuario sin estar asignado un mensaje a este -->
        <h4>NOMBRE_CONTACTO</h4>
        <p>mensaje mas reciente </p>
      </div>
    </div>
    
<!-- Por hacer estilo de los chats -->
    <main class="messages-section">
      <div class="message-box">
        <h2><a href="#">Tus mensajes</a></h2>
      </div>

      <div class="no-messages">
        <?php
          if($mysqliresult->num_rows == 0){
            echo "<i class='message-envelope'>✉️</i>";
            echo "<p>NO TIENES NINGÚN MENSAJE</p>";
            echo "<p>Cuando alguien te envíe algún mensaje aparecerá aquí</p>";
          }
        ?>

        <?php foreach ($results as $item):?>

          <h3>Chat <?= htmlspecialchars($chatCount, ENT_QUOTES, 'UTF-8') ?></h3>
          <p>ID Chat: <?= htmlspecialchars($item['id'], ENT_QUOTES, 'UTF-8') ?></p>
          <p>ID Publicación del chat: <?= htmlspecialchars($item['id_publicacion'], ENT_QUOTES, 'UTF-8') ?></p>

          <a href="chat.php?cid=<?php echo $item['id']; ?>">Abrir</a>

          <?php $chatCount = $chatCount + 1 ?>

        <?php endforeach; ?>
      </div>
    </main>
  </div>
  
  
  <footer>
    <a href="#politicas-privacidad">Políticas privacidad</a>
    <a href="#politicas-cookies">Políticas de cookies</a>
    <a href="#configuracion-cookies">Configuración de cookies</a>
    <a href="#terminos">Términos y condiciones</a>
</footer>
</body>
</html>
