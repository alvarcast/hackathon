<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CIRSO - Tus Productos </title>
    <link rel="stylesheet" href="../css/productoStyle.css">
    <link rel="icon" href="../img/logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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

            if(isset($_GET["pid"])) { 
                $pid = $_GET['pid'];
            } else {
                echo "No se ha especificado el pid.";
                exit;
            }

            $sql = "SELECT id_usuario,
                    i.nombre AS nombre_item,
                    descripcion,
                    edad,
                    zona,
                    estado_fisico,
                    c.nombre AS nombre_categoria
                    FROM publicaciones p
                    INNER JOIN items i ON p.id_item = i.id
                    INNER JOIN categorias c ON c.id = i.id_categoria
                    WHERE p.id = " . $pid;

            $result = $conn->query($sql);

            if (!$result) {
                echo "Error en la consulta: " . $conn->error;
                exit;
            }

            $row = $result->fetch_assoc();

            // Comprobamos si la consulta devolvió resultados
            if (!$row) {
                echo "No se encontraron resultados para este producto.";
                exit;
            }

            $oid = $row['id_usuario'];

            $self = ($_SESSION['id'] == $oid);

        } else {
            header("Location: login.php");
            exit;
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
            <a href="categorias.php"><img src= "../img/back_arrow.png" alt="Volver" title="Volver"></a>
            <a href="usuario.php"><img src="../img/user.png" alt="perfil" title="Perfil"></a>
            <?php if ($rowc['id_tipo'] == 1): ?>
                <a href="admin.php"><img src="../img/admin.png" alt="admin" title="Administración"></a>
            <?php else: ?>
                <a href="../html/soporte.html"><img src= "../img/support.png" alt="ayuda" title="Ayuda"></a>
            <?php endif; ?>
            <a href="listaChats.php"><img src= "../img/mesages.png" alt="mensajes" title="Mensajes"></a>
        </nav>
    </header>

    <main class="main-container">
        <section class="product-list">
            <div class="product">
                <div class="product-image">

                    <?php
                    // Consulta para obtener las imágenes
                    $sqlimg = "SELECT url
                            FROM fotos
                            WHERE id_publicacion = " . $pid . "
                            LIMIT 5";
                    $mysqliresultimg = $conn->query($sqlimg);

                    // Comprobar si la consulta devolvió resultados
                    if ($mysqliresultimg && $mysqliresultimg->num_rows > 0) {
                        
                        $imglist = $mysqliresultimg->fetch_all(MYSQLI_ASSOC); // Usamos fetch_all para obtener todas las filas en un array asociativo

                    } else {
                        $imglist = []; // Si no hay imágenes, asignamos un array vacío
                    }
                    ?>

                    <!-- Carrusel de imágenes -->
                    <div class="product-image">
                        <div class="card mx-auto" style="width: 500px; height: 500px; border: 1px solid #ddd; overflow: hidden;">
                            <div id="fotoCarrusel" class="carousel slide h-100" data-bs-ride="carousel">
                                <div class="carousel-inner h-100">
                                    <?php
                                    // Verificamos si hay imágenes en $imglist antes de intentar recorrerlas
                                    if (!empty($imglist)) {
                                        $isActive = true; // Marca la primera imagen como activa
                                        foreach ($imglist as $rowimg) { // Usamos un foreach para recorrer todas las imágenes
                                            echo '<div class="carousel-item ' . ($isActive ? 'active' : '') . ' h-100">';
                                            echo '<img src="' . htmlspecialchars($rowimg['url'], ENT_QUOTES, 'UTF-8') . '" class="d-block w-100 h-100" style="object-fit: cover;" alt="Foto">';
                                            echo '</div>';
                                            $isActive = false; // Solo la primera imagen será activa
                                        }
                                    } else {
                                        echo '<p>No hay fotos disponibles para este producto.</p>';
                                    }
                                    ?>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#fotoCarrusel" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Anterior</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#fotoCarrusel" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Siguiente</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <?php
                    // Cerrar la conexión
                    $conn->close();
                    ?>

                </div>

                

                <div class="product-details">
                    <h3><?= isset($row['nombre_item']) ? htmlspecialchars($row['nombre_item'], ENT_QUOTES, 'UTF-8') : 'Nombre no disponible' ?></h3><br>
                    <p><strong>Descripción:</strong> <?= isset($row['descripcion']) ? htmlspecialchars($row['descripcion'], ENT_QUOTES, 'UTF-8') : 'Descripción no disponible' ?></p>
                    <p><strong>Edad:</strong> <?= isset($row['edad']) ? htmlspecialchars($row['edad'], ENT_QUOTES, 'UTF-8') : 'Edad no disponible' ?></p>
                    <p><strong>Estado:</strong> <?= isset($row['estado_fisico']) ? htmlspecialchars($row['estado_fisico'], ENT_QUOTES, 'UTF-8') : 'Estado no disponible' ?></p>
                    <p><strong>Zona:</strong> <?= isset($row['zona']) ? htmlspecialchars($row['zona'], ENT_QUOTES, 'UTF-8') : 'Zona no disponible' ?></p>
                    <p><strong>Categoría:</strong> <?= isset($row['nombre_categoria']) ? htmlspecialchars($row['nombre_categoria'], ENT_QUOTES, 'UTF-8') : 'Categoría no disponible' ?></p>
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