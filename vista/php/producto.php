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
            zona,
            estado_fisico,
            c.nombre AS nombre_categoria
            FROM publicaciones p
            INNER JOIN items i ON p.id_item = i.id
            inner join categorias c ON c.id = i.id_categoria
            WHERE p.id = ".$pid;
    
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();

            $oid = $row['id_usuario'];

            $self = ($_SESSION['id'] == $oid);

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
                    <p><strong>Zona:</strong> <?= htmlspecialchars($row['zona'], ENT_QUOTES, 'UTF-8') ?></p>
                    <p><strong>Categoría:</strong> <?= htmlspecialchars($row['nombre_categoria'], ENT_QUOTES, 'UTF-8') ?></p>
                    <p></p>
                </div>
            </div>
        </section>

        <aside class="product-summary">
            <h3>Resumen del producto</h3>
            <?php if (!$self): ?>
                <form method="GET" action="../../controlador/php/openChat.php">
                    <input type="hidden" name="oid" value="<?= htmlspecialchars($oid, ENT_QUOTES, 'UTF-8') ?>">
                    <input type="hidden" name="pid" value="<?= htmlspecialchars($pid, ENT_QUOTES, 'UTF-8') ?>">
                    <button class="btn">Solicitar</button>
                </form>
            <?php else: ?>
                <form method="post" action="../../controlador/php/deletePost.php" onsubmit="return confirm('¿Seguro que quieres borrar esta publicación?')">
                    <input type="hidden" name="pid" value="<?= htmlspecialchars($pid, ENT_QUOTES, 'UTF-8') ?>">
                    <button class="btn" style="background-color: red; color: white;">Borrar publicación</button>
                </form>
            <?php endif; ?>
        </aside>   
    </main>
    <footer>
        <a href="../html/politicasPrivacidad.html">Políticas privacidad</a>
        <a href="../html/politicasCookies.html">Políticas de cookies</a>
        <a href="../html/avisoLegal.html">Aviso Legal</a>
        <a href="../html/soporte.html">Centro de asistencia</a>
    </footer>
</body>
</html>
