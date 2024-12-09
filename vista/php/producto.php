<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CIRSO - Tus Productos </title>
    <link rel="stylesheet" href="../css/productoStyle.css">
    <link rel="icon" href="../img/logo.png" type="image/x-icon">
</head>
<body>

    <?php
        include "../../common/php/connect.php";

        if (isset($_SESSION['id'])){

            if(isset($_GET["pid"])) { 
                $pid = $_GET['pid'];
            }
        
            $sql = "SELECT id_usuario,
            i.nombre AS nombre_item,
            id_imagenes,
            descripcion,
            edad,
            estado_fisico,
            c.nombre AS nombre_categoria
            FROM publicaciones p
            INNER JOIN items i ON p.id_item = i.id
            inner join categorias c ON c.id = i.id_categoria
            WHERE p.id = ".$pid;
    
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();

        } else {
            header("Location: login.php");
        }

    ?>

    <header class="header">
        
        <div class="logo">
            <img src="../img/logo.png" alt="Logo de CIRSO">
        </div>
        <div class="search-bar">
            <input type="text" placeholder="Buscar por producto, categoría...">
        </div>
        <nav class="icons">
            <a href="usuario.php"><img src="../img/user.png" alt="perfil"></a>
            <a href="../html/soporte.html"><img src= "../img/support.png" alt="ayuda"></a>
            <a href="listaChats.php"><img src= "../img/mesages.png" alt="mensajes"></a>
        </nav>
    </header>

    <nav class="category-nav">
        <a href="#">Camisetas</a>
        <a href="#">Jerséis/sudaderas</a>
        <a href="#">Pantalones</a>
        <a href="#">Calzado</a>
        <a href="#">Abrigos/Chaquetas</a>
        <a href="#">Accesorios</a>
        <a href="#">Juguetes</a>
        <a href="#">Mobiliario</a>
        <a href="#">Otros</a>
    </nav>

    <main class="main-container">
        <section class="product-list">
            <div class="product">
                <div class="product-image">
                    <img src="../img/jersey.png" alt="item">
                </div>
                <div class="product-details">
                    <h3><?= htmlspecialchars($row['nombre_item'], ENT_QUOTES, 'UTF-8') ?></h3>
                    <p><strong>Descripción:</strong> <?= htmlspecialchars($row['descripcion'], ENT_QUOTES, 'UTF-8') ?></p>
                    <p><strong>Edad:</strong> <?= htmlspecialchars($row['edad'], ENT_QUOTES, 'UTF-8') ?></p>
                    <p><strong>Estado:</strong> <?= htmlspecialchars($row['estado_fisico'], ENT_QUOTES, 'UTF-8') ?></p>
                    <p><strong>Categoría:</strong> <?= htmlspecialchars($row['nombre_categoria'], ENT_QUOTES, 'UTF-8') ?></p>
                    <p></p>
                </div>
            </div>
        </section>

        <aside class="product-summary">
            <h3>Resumen del producto</h3>
            <button class="btn">Solicitar</button>
        </aside>   
    </main>
    <footer>
        <a href="#politicas-privacidad">Políticas privacidad</a>
        <a href="#politicas-cookies">Políticas de cookies</a>
        <a href="#configuracion-cookies">Configuración de cookies</a>
        <a href="#terminos">Términos y condiciones</a>
        <a href="#centro-asistencia">Centro de asistencia</a>
    </footer>
</body>
</html>
