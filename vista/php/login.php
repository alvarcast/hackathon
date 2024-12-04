<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/logInStyle.css">
    <link rel="icon" href="../img/logo sin nombre.png" type="image/x-icon">
    <title>Log In</title>
</head>
<body>

    <header>
        <div class="header-container">
            <img src="../img/Logo_en_babyblue__3___1_-removebg-preview (1).png" alt="Logo Cirso" class="logo">
            <div class="icons_header">
            </div>
            
        </div>
    </header>

    <?php
        if(isset($_GET["control"])) { 
            $userControl = $_GET['control'];
            if($userControl != null){
                echo"<br><br>";
                if($userControl == 2){
                    echo"<h2 style='text-align: center' style='color: red'>El usuario indicado no existe</h2>";
                }else if($userControl == 3){
                    echo"<h2 style='text-align: center' style='color: red'>La contraseña es incorrecta</h2>";
                }
                echo"<br><br>";
            }
        } else {
            echo"<br><br>";
        }
    ?>

    <section class="login-section">
        <h1>Iniciar Sesión</h1>

        <form action="../../controlador/php/validarLogin.php" method="post">
            <label for="usuario">Usuario:</label><br>
            <input type="text" placeholder="..." id="usuario" name="usuario" required>
                
            <label for="contrasenia">Contraseña:</label><br>
            <input type="password" placeholder="..." id="contrasenia" name="contrasenia" required>
                
            <button type="submit">Iniciar sesión</button>
                
            <a href="#" class="forgot-password">Olvidé mi contraseña</a>
        </form>
    </section>

</body>
</html>