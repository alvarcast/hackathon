<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php include "../../common/php/connect.php"; ?>

    <h1>Página de selección	de categoría</h1>

    <button id='boton' onclick="location.href='usuario.php'">Perfil</button>
    <button id='boton' onclick="location.href='../../common/php/disconnect.php'">Log off</button>
    <br><br>
    <button id='boton' onclick="location.href='listaChats.php'">Chats</button>
    <br><br>

    <nav>
        <button id="boton" onclick="location.href='#categoria1'">Categoria 1</button>
        <button id="boton" onclick="location.href='#categoria2'">Categoria 2</button>
        <button id="boton" onclick="location.href='#categoria3'">Categoria 3</button>
        <button id="boton" onclick="location.href='#categoria4'">Categoria 4</button>
        <button id="boton" onclick="location.href='#categoria5'">Categoria 5</button>
    </nav>

    <section id="categoria1">
        <h2>Categoria 1</h2>
        <button id="boton" onclick="location.href='#'">Tipo 1</button>
        <button id="boton" onclick="location.href='#'">Tipo 2</button>
        <button id="boton" onclick="location.href='#'">Tipo 3</button>
        <button id="boton" onclick="location.href='#'">Tipo 4</button>
        <button id="boton" onclick="location.href='#'">Tipo 5</button>
    </section>

    <section id="categoria2">
        <h2>Categoria 2</h2>
        <button id="boton" onclick="location.href='#'">Tipo 1</button>
        <button id="boton" onclick="location.href='#'">Tipo 2</button>
        <button id="boton" onclick="location.href='#'">Tipo 3</button>
        <button id="boton" onclick="location.href='#'">Tipo 4</button>
        <button id="boton" onclick="location.href='#'">Tipo 5</button>
    </section>

    <section id="categoria3">
        <h2>Categoria 3</h2>
        <button id="boton" onclick="location.href='#'">Tipo 1</button>
        <button id="boton" onclick="location.href='#'">Tipo 2</button>
        <button id="boton" onclick="location.href='#'">Tipo 3</button>
        <button id="boton" onclick="location.href='#'">Tipo 4</button>
        <button id="boton" onclick="location.href='#'">Tipo 5</button>
    </section>

    <section id="categoria4">
        <h2>Categoria 4</h2>
        <button id="boton" onclick="location.href='#'">Tipo 1</button>
        <button id="boton" onclick="location.href='#'">Tipo 2</button>
        <button id="boton" onclick="location.href='#'">Tipo 3</button>
        <button id="boton" onclick="location.href='#'">Tipo 4</button>
        <button id="boton" onclick="location.href='#'">Tipo 5</button>
    </section>

    <section id="categoria5">
        <h2>Categoria 5</h2>
        <button id="boton" onclick="location.href='#'">Tipo 1</button>
        <button id="boton" onclick="location.href='#'">Tipo 2</button>
        <button id="boton" onclick="location.href='#'">Tipo 3</button>
        <button id="boton" onclick="location.href='#'">Tipo 4</button>
        <button id="boton" onclick="location.href='#'">Tipo 5</button>
    </section>

</body>
</html>