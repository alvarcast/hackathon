<?php
include "../../common/php/connect.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];

    $sql = "UPDATE usuarios SET nombre = ?, email = ? WHERE id = ".$_SESSION['id'];//cambiar is cuando le pregunte a lavaro como pasamos los datos
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $nombre, $email);

    if ($stmt->execute()) {
        echo "<p>Usuario actualizado exitosamente.</p>";
    } else {
        echo "<p>Error al actualizar el usuario: " . $conn->error . "</p>";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Usuario</title>
    <link rel="stylesheet" href="../css/editUserStyle.css">
</head>
<body>

    <div class="container">
        <h1>Modificar Usuario</h1>
        <form id="modificarUsuarioForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="form-group">
                <label for="nombre">Nombre Completo</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>

            <div class="form-group">
                <label for="email">Correo Electrónico</label>
                <input type="email" id="email" name="email" required>
            </div>

            <button type="submit">Subir</button>

            <div id="error-message" class="error"></div>
        </form>
    </div>

</body>
</html>