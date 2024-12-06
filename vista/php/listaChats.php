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
        <i class="message-envelope">✉️</i>
        <p>NO TIENES NINGÚN MENSAJE</p>
        <p>Cuando alguien te envíe algún mensaje aparecerá aquí</p>
        <br><br>
        <?php
        include "../../common/php/connect.php";
        ?>

        <?php
            include "../../modelo/php/global/selectListaChats.php";
        ?>
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
