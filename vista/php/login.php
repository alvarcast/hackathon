<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/logInStyle.css">
    <link rel="icon" href="../img/logo.png" type="image/x-icon">
    <title>Log In</title>
</head>
<body>

    <header>
        <a href="index.php"><img src="../img/logo.png" alt="Logo Cirso" class="logo"></a>
    </header>

    <?php
        if(isset($_GET["control"])) { 
            $userControl = $_GET['control'];
            if($userControl != null){
                echo"<br><br>";
                if($userControl == 2){
                    echo"<h1 style='text-align: center'>El usuario indicado no existe</h1>";
                }else if($userControl == 3){
                    echo"<h1 style='text-align: center'>La contraseña para ese usuario es incorrecta</h1>";
                }else if($userControl == 4){
                    echo"<h1 style='text-align: center'>Su usuario ha sido deshabilitado, póngase en contacto con el soporte</h1>";
                }
            }
        } else {
            echo"<br><br>";
        }

        
    ?>

    <main>
        <section class="login-section">
            <h2>Iniciar Sesión</h2>
            <form action="../../controlador/php/validarLogin.php" method="post">
              
                <input type="text"  placeholder="Usuario"   id="usuario" name="usuario" required>
                
                <input type="password" placeholder="Contraseña"  id="contrasenia" name="contrasenia" required>
                
                <button type="submit">Iniciar sesión</button>
                
                <a href="../html/soporte.html" class="forgot-password">Olvidé mi contraseña</a>
            </form>
        </section>
    </main>

    <footer>
        <a href="#politicas-privacidad">Políticas privacidad</a>
        <a href="#politicas-cookies">Políticas de cookies</a>
        <a href="#terminos">Términos y condiciones</a>
    </footer>

</body>
</html>