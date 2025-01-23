<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro</title>
    <link rel="stylesheet" href="../../../vista/css/adminStyle.css">
    <link rel="icon" href="../../../vista/img/logo.png" type="image/x-icon">
</head>

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

<body>
    <header>
        <h1>Formulario de Registro de nuevo usuario</h1>
    </header>

    <nav>
        <a href="../../../vista/php/admin.php">Volver</a>
    </nav>

    <div class="container">
        <form action="../../../controlador/php/procesar_formulario.php" method="post" class="formulario">
            <h2>Datos del Usuario</h2>
            
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="text" id="telefono" name="telefono" required>
            </div>

            <div class="form-group">
                <label for="email">Correo Electrónico:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <h2>Datos de la Dirección</h2>

            <div class="form-group">
                <label for="tipo_via">Tipo de Vía:</label>
                <select id="tipo_via" name="tipo_via" required>
                    <option value="" disabled selected>Selecciona una opción</option>
                    <option value="Calle">Calle</option>
                    <option value="Avenida">Avenida</option>
                    <option value="Carretera">Carretera</option>
                    <option value="Plaza">Plaza</option>
                </select>
            </div>

            <div class="form-group">
                <label for="nombre_via">Nombre de la Vía:</label>
                <input type="text" id="nombre_via" name="nombre_via" required>
            </div>

            <div class="form-group">
                <label for="tipo">Tipo:</label>
                <select id="tipo" name="tipo">
                    <option value="Piso">Piso</option>
                    <option value="Chalet">Chalet</option>
                </select>
            </div>

            <div class="form-group">
                <label for="nro">Número:</label>
                <input type="number" id="nro" name="nro" required>
            </div>

            <div class="form-group">
                <label for="piso">Piso:</label>
                <input type="text" id="piso" name="piso">
            </div>

            <div class="form-group">
                <label for="esc">Escalera:</label>
                <input type="text" id="esc" name="esc">
            </div>

            <div class="form-group">
                <label for="puerta">Puerta:</label>
                <input type="text" id="puerta" name="puerta">
            </div>

            <div class="form-group">
                <label for="cod_postal">Código Postal:</label>
                <input type="text" id="cod_postal" name="cod_postal" required>
            </div>

            <div class="form-group">
                <label for="localidad">Localidad:</label>
                <input type="text" id="localidad" name="localidad" required>
            </div>

            <div class="form-group">
                <label for="provincia">Provincia:</label>
                <input type="text" id="provincia" name="provincia" required>
            </div>

            <h2>Datos Adicionales</h2>

            <div class="form-group">
                <label for="tipo_usuario">Tipo de Usuario:</label>
                <select id="tipo_usuario" name="tipo_usuario" required>
                    <option value="1">Administrador</option>
                    <option value="2">Coordinador</option>
                    <option value="3">Usuario</option>
                </select>
            </div>

            <div class="form-group">
                <label for="entidad">Nombre de la Entidad:</label>
                <select id="entidad" name="entidad" required>
                    <option value="1">COMUNIDAD DE MADRID</option>
                </select>
            </div>

            <button type="submit" class="button allow">Enviar</button>
        </form>
    </div>
</body>
</html>
