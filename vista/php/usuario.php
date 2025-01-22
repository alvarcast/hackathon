<?php
include "../../common/php/connect.php"; // Conexión a la base de datos

// Verificar que el usuario esté logueado
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

// Procesar eliminación del producto (solo de la tabla publicaciones)
if (isset($_POST['product_id'])) {
    $product_id = (int)$_POST['product_id']; // Asegúrate de que el ID del producto sea un número entero

    // Eliminar solo de la tabla publicaciones
    try {
        // Usamos MySQLi para la eliminación
        $sql = "DELETE FROM publicaciones WHERE id = ? AND id_usuario = ?";
        $stmt = $conn->prepare($sql);
        
        // Verificamos si la preparación fue exitosa
        if ($stmt === false) {
            throw new Exception("Error en la preparación de la consulta: " . $conn->error);
        }

        // Enlazamos los parámetros
        $stmt->bind_param("ii", $product_id, $_SESSION['id']);
        
        // Ejecutamos la consulta
        $stmt->execute();

        // Verificamos si la ejecución fue exitosa
        if ($stmt->affected_rows > 0) {
            // Redirigir al perfil de usuario después de la eliminación
            header("Location: usuario.php");
            exit();
        } else {
            throw new Exception("No se pudo eliminar el producto o el producto no existe.");
        }

    } catch (Exception $e) {
        echo "Error al eliminar el producto: " . $e->getMessage();
    }
}

// Obtener la información del usuario
$sql = "SELECT u.id,
            u.usuario,
            u.telefono,
            u.email,
            d.Tipo_via,
            d.Nombre_via,
            d.Nro,
            d.piso,
            d.esc,
            d.puerta,
            d.cod_postal,
            d.localidad,
            d.provincia
        FROM usuarios u
        INNER JOIN direcciones d ON u.id_dir = d.id
        WHERE u.id = ".$_SESSION['id'];

$result = $conn->query($sql);
$row = $result->fetch_assoc();

// Obtener los productos del usuario
$sql = "SELECT p.descripcion,
            i.nombre,
            p.id AS product_id
        FROM publicaciones p
        INNER JOIN items i ON p.id_item = i.id
        WHERE p.id_usuario = ". $_SESSION['id'];

$mysqliresult = $conn->query($sql);
$results = $mysqliresult->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cirso - Perfil de Usuario</title>
    <link rel="stylesheet" href="../css/usuarioStyle.css">
    <link rel="icon" href="../img/logo.png">
</head>
<body>

    <header class="top-bar">
        <div class="logo">
            <img src="../img/logo.png" alt="Logo" id="logo">
        </div>
        <h1 class="nombreUsuario"><?= htmlspecialchars($row['usuario'], ENT_QUOTES, 'UTF-8') ?></h1>
        <div class="icons">
            <!-- Iconos alineados a la derecha -->
            <a href="../../common/php/disconnect.php"><img src= "../img/logoff.png" alt="logoff"></a>
            <a href="../html/soporte.html"><img src= "../img/support.png" alt="ayuda"></a>
            <a href="listaChats.php"><img src= "../img/mesages.png" alt="mensajes"></a>
            <a href="categorias.php"><img src="../img/caja.png"></a>
        </div>
    </header>

    <div class="container">
        <!-- Información de perfil -->
        <div class="profile-info" style="margin-bottom: 2em;">
            <div>
                <h2>Información personal</h2>
                <p>Teléfono: <?= htmlspecialchars($row['telefono'], ENT_QUOTES, 'UTF-8') ?></p>
                <p>E-Mail: <?= htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8') ?></p>
            </div>
            <div>
                <a href="editUser.php"><button class="btn-add-product">✎</button></a>
            </div>
        </div>

        <div class="profile-info">
            <div>
                <h2>Añada un producto</h2>
                <a href="../html/soporte.html" class="linkNormas"><p>Normas de uso</p></a>
            </div>
            <div>
                <a href="addProduct.php"><button class="btn-add-product">+</button></a>
            </div>
        </div>

        <!-- Lista de productos -->
        <div class="product-list">
            <h3>Mis productos</h3>

            <?php foreach ($results as $item):?>

                <div class="product-item">
                    <div class="product-info">
                        <img src="../img/jersey.png" class="img" alt="Producto A">
                        <div class="product-details">
                            <h3><?= htmlspecialchars($item['nombre'], ENT_QUOTES, 'UTF-8') ?></h3>
                            <p><?= htmlspecialchars($item['descripcion'], ENT_QUOTES, 'UTF-8') ?></p>
                        </div>
                    </div>
                    <div class="product-actions">
                        <!-- Formulario de eliminación -->
                        <form method="POST" action="" onsubmit="return confirm('¿Seguro que quieres borrar esta publicación?')">
                            <input type="hidden" name="product_id" value="<?= $item['product_id'] ?>">
                            <button type="submit" class="eliminarBtn">Eliminar</button>
                        </form>
                    </div>
                </div>

            <?php endforeach; ?>

        </div>
    </div><br><br>

    <footer>
        <a href="../html/politicasPrivacidad.html">Políticas privacidad</a>
        <a href="../html/politicasCookies.html">Políticas de cookies</a>
        <a href="../html/avisoLegal.html">Aviso Legal</a>
        <a href="../html/soporte.html">Centro de asistencia</a>
    </footer>

</body>
</html>