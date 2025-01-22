<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro</title>
</head>

<link rel="stylesheet" href="../../../vista/css/adminStyle.css">

<?php

include "../../../common/php/connect.php";

if (!isset($_SESSION['id'])){
    header("Location: ../../../vista/php/login.php");
}

$id = $_SESSION['id'];

$sqlc = "SELECT id_tipo 
FROM usuarios
WHERE id = $id";

$resultc = $conn->query($sqlc);
$rowc = $resultc->fetch_assoc();

if ($rowc['id_tipo'] != 1){
    header("Location: ../../../common/php/disconnect");
}

?>

<header>
    <h1>Formulario de Registro de nuevo usuario</h1>
</header>

<nav>
    <a href="../../../vista/php/admin.php">Volver</a>
</nav>

<body style="text-align: center">
    <h1>Formulario de Registro de nuevo usuario</h1>
    <form action="../../../controlador/php/procesar_formulario.php" method="post" style="margin-bottom: 2em">
        <h2>Datos del Usuario</h2>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required><br>

        <label for="telefono">Teléfono:</label>
        <input type="text" id="telefono" name="telefono" required><br>

        <label for="email">Correo Electrónico:</label>
        <input type="email" id="email" name="email" required><br>

        <h2>Datos de la Dirección</h2>
        <label for="tipo_via">Tipo de Vía:</label>
        <select id="tipo_via" name="tipo_via" required>
            <option value="" disabled selected>Selecciona una opción</option>
            <option value="Calle">Calle</option>
            <option value="Avenida">Avenida</option>
            <option value="Carretera">Carretera</option>
            <option value="Plaza">Plaza</option>
        </select>
        <br>

        <label for="nombre_via">Nombre de la Vía:</label>
        <input type="text" id="nombre_via" name="nombre_via" required><br>

        <label for="tipo">Tipo:</label>
        <select id="tipo" name="tipo">
            <option value="Piso">Piso</option>
            <option value="Chalet">Chalet</option>
        </select><br>

        <label for="nro">Número:</label>
        <input type="number" id="nro" name="nro" required><br>

        <label for="piso">Piso:</label>
        <input type="text" id="piso" name="piso"><br>

        <label for="esc">Escalera:</label>
        <input type="text" id="esc" name="esc"><br>

        <label for="puerta">Puerta:</label>
        <input type="text" id="puerta" name="puerta"><br>

        <label for="cod_postal">Código Postal:</label>
        <input type="text" id="cod_postal" name="cod_postal" required><br>

        <label for="localidad">Localidad:</label>
        <input type="text" id="localidad" name="localidad" required><br>

        <label for="provincia">Provincia:</label>
        <input type="text" id="provincia" name="provincia" required><br>

        <h2>Datos Adicionales</h2>
        <label for="tipo_usuario">Tipo de Usuario:</label>
        <select id="tipo_usuario" name="tipo_usuario" required>
            <option value="1">Administrador</option>
            <option value="2">Coordinador</option>
            <option value="3">Usuario</option>
        </select><br>

        <label for="entidad">Nombre de la Entidad:</label>
        <select id="entidad" name="entidad" required>
            <option value="1">COMUNIDAD DE MADRID</option>
        </select><br>

        <br>

        <button type="submit">Enviar</button>

        <br>
    </form>
</body>
</html>
