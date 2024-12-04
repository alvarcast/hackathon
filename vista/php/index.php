<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/indexStyle.css">
    <link rel="icon" href="../img/logo sin nombre.png" type="image/x-icon">
    <title>Front Page</title>
</head>
<body>

    <?php include "../../common/php/connect.php"; 

        if(isset($_SESSION['id'])){
            header("Location: ../../vista/php/categorias.php");
        }
    ?>

    <header>
        <div class="logo">
            <img src="../img/logo sin nombre.png" alt="Logo de CIRSO">
        </div>
        <div class="titulo"><h1>CIRSO</h1></div>
            <!-- <div class="search-bar">
            <input type="text" placeholder="Buscar por producto, categoría...">
            </div>-->
        <div class="icons">
            <span class="icon user-icon"><a href="login.php">👤</a></span>
            <span class="icon help-icon">❓</span>
            <!--<img src="user-icon.png" alt="Usuario">
            <img src="question-icon.png" alt="Ayuda">-->
        </div>
    </header>

        <!--Carrusel-->
        
    
        <!-- Carrusel de imágenes -->
        <div class="carousel-container">
            <div class="carousel">
                <div class="slide">
                    <div class="question">Comparte</div>
                    <div class="image-background"></div>
                </div>
                <div class="slide">
                    <div class="question">Vive</div>
                    <div class="image-background"></div>
                </div>
                <div class="slide">
                    <div class="question">Acoge</div>
                    <div class="image-background"></div>
                </div>
                <div class="slide">
                    <div class="question">Ama</div>
                    <div class="image-background"></div>
                </div>
            </div>
            <!-- Botones de navegación -->
            <div class="nav-buttons">
                <button class="nav-button" onclick="prevSlide()">❮</button>
                <button class="nav-button" onclick="nextSlide()">❯</button>
            </div>
        </div>
        <nav>
            <ul>
                <li><a href="#123">¿Quiénes somos?</a></li>
                <li><a href="#345">¿Cómo funciona?</a></li>
                <li><a href="#567">Recursos</a></li>
                <li><a href="#789">Envíos</a></li>
            </ul>
        </nav>
    <!-- Sección de preguntas -->
    <div class="questions-box">
        <div class="quienessomos" id="123">
            <h3>¿Quiénes somos?</h3>
            <div class="content">
                <img src="../img/img1.png" alt="Imagen sobre quienes somos" />
                <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut 
                    labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris 
                    nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse 
                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident,
                    sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div>
        </div><br>
        
        <div class="comofunciona" id="345">
            <h3>¿Cómo funciona?</h3>
            <div class="content">
                <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut 
                    labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris 
                    nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse 
                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident,
                    sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                <img src="../img/img1.png" alt="Imagen sobre cómo funciona" />
            </div>
        </div><br>
    
        <div class="quienessomos" id="567">
            <h3>Recursos</h3>
            <div class="content">
                <img src="../img/img1.png" alt="Imagen de recursos" />
                <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut 
                    labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris 
                    nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse 
                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident,
                    sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div>
        </div><br>
    
        <div class="quienessomos" id="789">
            <h3>Envíos</h3>
            <div class="content">
                <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut 
                    labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris 
                    nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse 
                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident,
                    sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                <img src="../img/img1.png" alt="Imagen de envíos" />
            </div>
        </div><br>
    </div>
    
    
    
    
    <div class="additional-images">
        <img src="../img/img1.png" alt="Imagen 1">
        <img src="../img/img1.png" alt="Imagen 2">
        <img src="../img/img1.png" alt="Imagen 3">
        <img src="../img/img1.png" alt="Imagen 4">
    </div>

    <!-- Pie de página -->
    <footer>
        <a href="#politicas-privacidad">Políticas privacidad</a>
        <a href="#politicas-cookies">Políticas de cookies</a>
        <a href="#configuracion-cookies">Configuración de cookies</a>
        <a href="#terminos">Términos y condiciones</a>
        <a href="#centro-asistencia">Centro de asistencia</a>
    </footer>

    <script src="../../common/js/carrousel.js"></script>

    <br><br>
    <button id='boton' onclick="location.href='../html/asistencia.html'">Asistencia</button>
    
</body>
</html>