<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tus chats</title>
    <link rel="icon" href="../img/logo.png" type="image/x-icon">
</head>
<body>

<?php

    include '../../common/php/connect.php';

    if (isset($_SESSION['id'])){
      

  
    } else {
        header("Location: login.php");
    }

?>
    
</body>
</html>