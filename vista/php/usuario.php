<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <?php
        include "../../common/php/connect.php";
    ?>

    <h1>Usuario</h1>
    <button id="boton" onclick="location.href='index.php'">Volver al menú</button>

    <?php
        include "../../modelo/php/personal/selectUsuario.php";
    ?>

    <h3>Publicaciones:</h3>

    <?php
        include "../../modelo/php/personal/selectPublicacionesUsuario.php";
    ?>
</body>
</html>