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
                $userControl = null;
            }
        }
 
        if(isset($_SESSION['id'])){
            include "../html/sesionIniciada.html";
        }else{
            include "../html/sesionCerrada.html";      
        }

    ?>

    <br><br>
    <button id='boton' onclick="location.href='../html/asistencia.html'">Asistencia</button>
    
</body>
</html>