<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php
        if(isset($_GET["control"])) { 
            $userControl = $_GET['control'];
            if($userControl != null){
                if($userControl == 2){
                    echo"<h4>El usuario indicado no esiste</h4>";
                }elseif($userControl == 3){
                    echo"<h4>La contraseña es incorrecta</h4>";
                }
            }
        }
    ?>

    <form action="../../controlador/php/validarLogin.php" method="post">
        <h1>Iniciar sesión</h1>
        <div class="usuario">
            <label for="usuario">Usuario:</label><br>
            <input type="text" name="usuario" id="usuario"><br>
        </div>
        <div class="contrasenia">
            <label for="contrasenia">Contraseña:</label><br>
            <input type="password" name="contrasenia" id="contrasenia"><br>
        </div>
        <div class="boton">
            <button type="submit">Enviar</button>
        </div>
    </form>

</body>
</html>