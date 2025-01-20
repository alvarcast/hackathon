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

        if (isset($_SESSION['id'])){
      
            $countPublicaciones = 1;
    
            $sql = "SELECT p.id,
            nombre,
            id_imagenes
            FROM publicaciones p
            INNER JOIN items i ON p.id_item = i.id
            WHERE control = 'aprobado' AND estatus = 'publicado'";
    
            $mysqliresult = $conn->query($sql);
            $results = $mysqliresult->fetch_all(MYSQLI_ASSOC);
      
        } else {
            header("Location: login.php");
        }
        
    ?>

    <!-- Barra superior -->
    <header class="top-bar">
        <div class="logo">
            <!-- Espacio para el logo -->
            <img src="../img/logo.png" alt="Logo" id="logo">
        </div>
        <div class="search-bar">
            <!-- Buscador -->
            <input type="text" placeholder="Buscar por producto, categoría..." id="search-input">
        </div>
        <div class="icons">
            <!-- Iconos alineados a la derecha -->
            <a href="usuario.php"><img src="../img/user.png" alt="perfil"></a>
            <a href="../html/soporte.html"><img src= "../img/support.png" alt="ayuda"></a>
            <a href="listaChats.php"><img src= "../img/mesages.png" alt="mensajes"></a>
        </div>
    </header>

    <div class="container">
        <!-- Filtros -->
        <aside class="filters">
            <h2>Filtros</h2>
            <div class="filter-group">
                <h3>Edad</h3>
                <ul>
                    <li>
                        <label for="edad">Selecciona:</label>
                        <select id="edad">
                            <option value="0-3 meses">0-3 meses</option>
                            <option value="3-6 meses">3-6 meses</option>
                            <option value="6-12 meses">6-12 meses</option>
                            <option value="1-3 años">1-3 años</option>
                            <option value="4-6 años">4-6 años</option>
                            <option value="7-9 años">7-9 años</option>
                            <option value="10-12 años">10-12 años</option>
                            <option value="13-15 años">13-15 años</option>

                            
                        </select>
                    </li>
                </ul>
            </div>
            <div class="filter-group">
                <h3>Categorías</h3>
                <ul>
                    <li>
                        <label for="">Artículo:</label>
                        <select id="colores">
                            <option value="juguetes">Juguetes</option>
                            <option value="ropa">Ropa</option>
                            <option value="mobiliario">Mobiliario</option>
                            <option value="libros">Libros</option>
                            <option value="pequeños electrodomesticos">Pequeños electrodomésticos</option>
                        </select>
                    </li>

                    <!--Categoria de zona geografica-->
                    <li>
                        <label for="colores">Colores:</label>
                        <select id="colores">
                            <option value="rojo">Rojo</option>
                            <option value="azul">Azul</option>
                            <option value="verde">Verde</option>
                            <option value="amarillo">Amarillo</option>
                        </select>
                    </li>
                    
                    <li>
                        <label for="estado">Estado:</label>
                        <select id="estado">
                            <option value="nuevo">Nuevo</option>
                            <option value="usado">Usado</option>
                            <option value="reacondicionado">Reacondicionado</option>
                        </select>
                    </li>
                </ul>
            </div>
        </aside>

        <!-- Productos -->
        <section class="products">
            <?php foreach ($results as $item):?>

                <div class="product">
                    <a href="producto.php?pid=<?php echo $item['id']; ?>"><img src="../img/kids-playing-with-eco-toys-full-shot.jpg" alt="Producto <?= htmlspecialchars($countPublicaciones, ENT_QUOTES, 'UTF-8') ?>"></a>
                    <p><?= htmlspecialchars($item['nombre'], ENT_QUOTES, 'UTF-8') ?><a href="../mensajes/mensajes.html">📤</a></p>
                </div>

                <?php $countPublicaciones = $countPublicaciones + 1 ?>

            <?php endforeach; ?>
        </section>
    </div>
    <br><br>
    <footer>
        <a href="#politicas-privacidad">Políticas privacidad</a>
        <a href="#politicas-cookies">Políticas de cookies</a>
        <a href="#configuracion-cookies">Configuración de cookies</a>
        <a href="#terminos">Términos y condiciones</a>
        <a href="#centro-asistencia">Centro de asistencia</a>
    </footer>
</body>
</html>
