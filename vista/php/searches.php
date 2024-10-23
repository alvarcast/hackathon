<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" id="barraform">
        <div class="barra">
            <input type="text" placeholder="Busqueda..." name="search">
            <button type="submit">Buscar</button>
        </div>
    </form>
    
</body>
</html>