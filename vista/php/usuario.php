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

    <?php
        include "../../common/php/connect.php";

        if (isset($_SESSION['id'])){
            
            $sql = "SELECT u.id,
            usuario,
            telefono,
            email,
            Tipo_via,
            Nombre_via,
            Nro,
            piso,
            esc,
            puerta,
            cod_postal,
            localidad,
            provincia
            FROM usuarios u
            INNER JOIN direcciones d ON u.id_dir = d.id
            WHERE u.id = ".$_SESSION['id'];
    
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
    
            $sql = "SELECT descripcion,
            nombre
            FROM publicaciones p
            INNER JOIN items i ON p.id_item = i.id
            WHERE id_usuario = ". $_SESSION['id'];
    
            $mysqliresult = $conn->query($sql);
            $results = $mysqliresult->fetch_all(MYSQLI_ASSOC);

        } else {
            header("Location: login.php");
        }
    
    ?>

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
                <p>
                    Dirección: 
                    <?= htmlspecialchars($row['Tipo_via'], ENT_QUOTES, 'UTF-8') ?>
                    <?= htmlspecialchars($row['Nombre_via'], ENT_QUOTES, 'UTF-8') ?>
                    <?= htmlspecialchars($row['Nro'], ENT_QUOTES, 'UTF-8') ?>,
                    escalera <?= htmlspecialchars($row['esc'], ENT_QUOTES, 'UTF-8') ?>
                    <?= htmlspecialchars($row['piso'], ENT_QUOTES, 'UTF-8') ?>º<?= htmlspecialchars($row['puerta'], ENT_QUOTES, 'UTF-8') ?>, 
                    <?= htmlspecialchars($row['provincia'], ENT_QUOTES, 'UTF-8') ?>,
                    <?= htmlspecialchars($row['localidad'], ENT_QUOTES, 'UTF-8') ?>,
                    <?= htmlspecialchars($row['cod_postal'], ENT_QUOTES, 'UTF-8') ?>
                </p>
            </div>
            <div>
                <a href="#"><button class="btn-add-product">✎</button></a>
            </div>
        </div>

        <div class="profile-info">
            <div>
                <h2>Añada un producto</h2>
                <a href="../html/soporte.html" class="linkNormas"><p>Normas de uso</p></a>
                <!--Link de las normas-->
            </div>
            <div>
                <a href="../addArticulo/addArticulo.html"><button class="btn-add-product">+</button></a>
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
                        <button class="editarBtn">Editar</button>
                        <button class="eliminarBtn">Eliminar</button>
                    </div>
                </div>

            <?php endforeach; ?>

        </div>
    </div><br><br>

    <footer>
        <a href="#politicas-privacidad">Políticas privacidad</a>
        <a href="#politicas-cookies">Políticas de cookies</a>
        <a href="#configuracion-cookies">Configuración de cookies</a>
        <a href="#terminos">Términos y condiciones</a>
    </footer>

</body>
</html>

