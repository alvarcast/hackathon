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

    <h1>Landing Page</h1>

    <?php
        if(isset($_GET["control"])) { 
            $userControl = $_GET['control'];
            if($userControl != null){
                if($userControl == 1){
                    echo"<h4>Sesión iniciada correctamente.</h4>";
                } elseif ($userControl == 2){
                    echo"<h4>Sesión cerrada correctamente.</h4>";
                }
            }
        }
 
        if(isset($_SESSION['id'])){
            echo "<button id='boton'><a href='usuario.php'>Perfil</a></button>";
            echo "<button id='boton'><a href='../../common/php/disconnect.php'>Log off</a></button>";
            echo "<br><br>";
            echo "<button id='boton'><a href='categorias.php'>Ver categorías</a></button>";
        }else{
            echo "<button id='boton'><a href='login.php'>Login</a></button>";          
        }
    ?>
    
</body>
</html>