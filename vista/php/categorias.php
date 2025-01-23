<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cirso - Productos</title>
    <link rel="stylesheet" href="../css/categoriasStyle.css">
    <link rel="icon" href="../img/logo.png" type="image/x-icon">
</head>
<body>

<?php
include "../../common/php/connect.php";

if (isset($_SESSION['id'])) {

    $id = $_SESSION['id'];

    $sqlc = "SELECT id_tipo 
    FROM usuarios
    WHERE id = $id";

    $resultc = $conn->query($sqlc);
    $rowc = $resultc->fetch_assoc();
    
    $countPublicaciones = 1;

    // Si hay resultados de búsqueda en la sesión, usarlos
    if (isset($_SESSION['search_results']) && !empty($_SESSION['search_results'])) {
        $results = $_SESSION['search_results'];
    } else {
        // Si no hay resultados de búsqueda, mostrar todos los productos
        $sql = "SELECT p.id, nombre, id_imagenes
                FROM publicaciones p
                INNER JOIN items i ON p.id_item = i.id
                WHERE control = 'aprobado' AND estatus = 'publicado'";

        $mysqliresult = $conn->query($sql);

        if ($mysqliresult) {
            $results = $mysqliresult->fetch_all(MYSQLI_ASSOC);
        } else {
            error_log("Error en la consulta inicial: " . $conn->error);
            $results = [];
        }
    }
} else {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cirso - Productos</title>
    <link rel="stylesheet" href="../css/categoriasStyle.css">
    <link rel="icon" href="../img/logo.png" type="image/x-icon">
</head>
<body>

    <!-- Barra superior -->
    <header class="top-bar">
        <div class="logo">
            <img src="../img/logo.png" alt="Logo" id="logo">
        </div>
        <div class="search-bar">
            <form method="post" action="../../controlador/php/buscadorItems.php">
                <input type="text" name="search" placeholder="Buscar por producto, categoría..." id="search-input">
                <input type="submit" value="Buscar">
            </form>
        </div>
        <div class="icons">
            <a href="usuario.php"><img src="../img/user.png" alt="perfil"></a>
            <?php if ($rowc['id_tipo'] == 1): ?>
                <a href="admin.php"><img src="../img/admin.png" alt="admin"></a>
            <?php else: ?>
                <a href="../html/soporte.html"><img src= "../img/support.png" alt="ayuda"></a>
            <?php endif; ?>
            <a href="listaChats.php"><img src="../img/mesages.png" alt="mensajes"></a>
        </div>
    </header>

    <div class="container">
        <!-- Filtros -->
        <aside class="filters">
            <h2>Filtros</h2>
            <form method="post" action="../../controlador/php/buscadorItems.php">
                <div class="filter-group">
                    <h3>Edad</h3>
                    <select name="edad" id="edad">
                        <option value="">Todas</option>
                        <option value="0-3 meses">0-3 meses</option>
                        <option value="3-6 meses">3-6 meses</option>
                        <option value="6-12 meses">6-12 meses</option>
                        <option value="1-3 años">1-3 años</option>
                        <option value="4-6 años">4-6 años</option>
                        <option value="7-9 años">7-9 años</option>
                        <option value="10-12 años">10-12 años</option>
                        <option value="13-15 años">13-15 años</option>
                    </select>
                </div>
                <div class="filter-group">
                    <h3>Categorías</h3>
                    <select name="articulo" id="articulos">
                        <option value="">Todos</option>
                        <option value="8">Juguetes</option>
                        <option value="6">Ropa</option>
                        <option value="5">Mobiliario</option>
                        <option value="11">Libros</option>
                        <option value="9">Pequeños electrodomésticos</option>
                    </select>
                </div>
                <div class="filter-group">
                    <h3>Estado</h3>
                    <select name="estado" id="estado">
                        <option value="">Todos</option>
                        <option value="Nuevo">Nuevo</option>
                        <option value="Usado excelente">Usado Excelente</option>
                        <option value="Usado bueno">Usado Bueno</option>
                    </select>
                </div>
                <div class="filter-group">
                    <button type="submit" class="submit-btn">Aplicar Filtros</button>
                </div>
            </form>
        </aside>

        <!-- Productos -->
        <section class="products">
            <?php foreach ($results as $item): ?>
                <div class="product">
                    <a href="producto.php?pid=<?php echo $item['id']; ?>">
                        <img src="../img/kids-playing-with-eco-toys-full-shot.jpg" alt="Producto <?= htmlspecialchars($countPublicaciones, ENT_QUOTES, 'UTF-8') ?>">
                    </a>
                    <p><?= htmlspecialchars($item['nombre'], ENT_QUOTES, 'UTF-8') ?></p>
                </div>
                <?php $countPublicaciones++; ?>
            <?php endforeach; ?>
        </section>
    </div>

    <footer>
        <a href="../html/politicasPrivacidad.html">Políticas privacidad</a>
        <a href="../html/politicasCookies.html">Políticas de cookies</a>
        <a href="../html/avisoLegal.html">Aviso Legal</a>
        <a href="../html/soporte.html">Centro de asistencia</a>
    </footer>
</body>
</html>

</body>
</html>
