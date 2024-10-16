<?php

$sql = "SELECT idusuario,
nombreusuario,
descripcion,
karma,
img
FROM usuarios
WHERE IdUsuario = ". $_SESSION['id'];

$mysqliresult = $conn->query($sql);
$results = $mysqliresult->fetch_all(MYSQLI_ASSOC);

?>

<?php foreach ($results as $item):

$imagen = $item['img'];

if($imagen == 'x'){
    $imagen = "../../common/img/default.png";
}else{
    $imagen = "img/".$item['img']."";
}

?>

    <div class="cajausuario">
        <div class="cabeza">
            <div class="imagencabeza">
            <img src='<?php echo htmlspecialchars($imagen); ?>'></a>
            </div>
            <div class="pcabeza">
                <div class="pflex">
                    <div class="sec1">
                        <h2>Nombre de usuario:</h2>
                        <p><?= htmlspecialchars($item['nombreusuario'], ENT_QUOTES, 'UTF-8') ?></p>
                    </div>
                    <div class="sec2">
                        <h2>Participacion:</h2>
                        <p><?= htmlspecialchars($item['karma'], ENT_QUOTES, 'UTF-8') ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="descripcion">
            <h3>Descripcion:</h3>
            <form action="actualizar.php" method="post" enctype="multipart/form-data">

                <textarea name='desc' placeholder='Escribe algo sobre ti...' maxlength='300'><?= htmlspecialchars($item['descripcion'], ENT_QUOTES, 'UTF-8') ?></textarea>
                
                <div class="alibot">
                    <p>Cambiar imagen:</p>
                    <input type="file" accept=".jpg, .jpeg, .png" name="file"></input>
                    <button type="submit">Enviar</button>

                    <p id="uid">UID: <?= htmlspecialchars($item['idusuario'], ENT_QUOTES, 'UTF-8') ?></p>

                </div>
            </form>
        </div>
    </div>

    <form method="post" class="deluser" action="borrarcuenta.php">
        <button type="submit" onclick="return confirm('¿Seguro que quiere eliminar su cuenta?');">Borrar cuenta</button>
    </form>

<?php endforeach; ?>