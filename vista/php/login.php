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
</body>
</html>