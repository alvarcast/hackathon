<?php
include "../../common/php/connect.php";

$id = $_SESSION['id'];

$sqlc = "SELECT id_tipo 
FROM usuarios
WHERE id = $id";

$resultc = $conn->query($sqlc);
$rowc = $resultc->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];

    $sql = "UPDATE usuarios SET telefono = ?, email = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $nombre, $email, $_SESSION['id']);


    if ($stmt->execute()) {
        echo"<h1 style='text-align: center'>Usuario actualizado correctamente</h1>";
    } else {
        echo "<p>Error al actualizar el usuario: " . $conn->error . "</p>";
    }

    $stmt->close();
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Usuario</title>
    <link rel="stylesheet" href="../css/editUserStyle.css">
    <link rel="icon" href="../img/logo.png" type="image/x-icon">
</head>
<body>
    <header class="top-bar">
        <div class="logo">
            <img src="../img/logo.png" alt="Logo" id="logo">
        </div>
        <div class="icons">
            <!-- Iconos alineados a la derecha -->
            <a href="../../common/php/disconnect.php"><img src= "../img/logoff.png" alt="logoff"></a>
            <?php if ($rowc['id_tipo'] == 1): ?>
                <a href="admin.php"><img src="../img/admin.png" alt="admin"></a>
            <?php else: ?>
                <a href="../html/soporte.html"><img src= "../img/support.png" alt="ayuda"></a>
            <?php endif; ?>
            <a href="listaChats.php"><img src= "../img/mesages.png" alt="mensajes"></a>
            <a href="categorias.php"><img src="../img/caja.png"></a>
        </div>
    </header>

    <div class="container">
        <h1>Modificar Usuario</h1>
        <form id="modificarUsuarioForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="form-group">
                <label for="nombre">Telefono</label>
                <input type="text" id="nombre" name="nombre" pattern="[0-9]{9}" required>
            </div>

            <div class="form-group">
                <label for="email">Correo Electrónico</label>
                <input type="email" id="email" name="email" required>
            </div>

            <button type="submit">Subir</button>

            <div id="error-message" class="error"></div>
        </form>
    </div>
    <footer>
        <a href="../html/politicasPrivacidad.html">Políticas privacidad</a>
        <a href="../html/politicasCookies.html">Políticas de cookies</a>
        <a href="../html/avisoLegal.html">Aviso Legal</a>
        <a href="../html/soporte.html">Centro de asistencia</a>
    </footer>

</body>
</html>