<?php

$sql = 'SELECT idmusica,
nombre,
artista,
texto,
valoracion,
imgmusica,
nombreusuario,
generomusica
FROM recomendacion_m m
INNER JOIN usuarios u ON u.idusuario = m.idusuario
INNER JOIN genero_m g ON g.idgeneromusica = m.idgeneromusica
WHERE m.idusuario = '.$_SESSION['id'].'
ORDER BY idmusica DESC';

$mysqliresult = $conn->query($sql);
$results = $mysqliresult->fetch_all(MYSQLI_ASSOC);

?>

<?php foreach ($results as $item):

if($item['valoracion'] == 1){
    $valoracion = "../../common/img/1star.png";
}elseif($item['valoracion'] == 2){
    $valoracion = "../../common/img/2star.png";
}elseif($item['valoracion'] == 3){
    $valoracion = "../../common/img/3star.png";
}elseif($item['valoracion'] == 4){
    $valoracion = "../../common/img/4star.png";
}else{
    $valoracion = "../../common/img/5star.png";
}

$imagen = "../../pRecom/pMusica/img/".$item['imgmusica']."";

?>

<section class='recomBox'>
    <div class='items'>
        <div class='portada'>
            <img src='<?php echo htmlspecialchars($imagen); ?>'></a>
        </div>
        <div class='alineador'>
            <div class='info'>
                <div class='cabezaRecom'>
                    <p id='desc1'>Cancion: <?= htmlspecialchars($item['nombre'], ENT_QUOTES, 'UTF-8') ?></p>
                    <p id='desc1'>Artista: <?= htmlspecialchars($item['artista'], ENT_QUOTES, 'UTF-8') ?></p>
                    <p>Genero: <?= htmlspecialchars($item['generomusica'], ENT_QUOTES, 'UTF-8') ?></p>
                    <p id='desc2'>Usuario: <?= htmlspecialchars($item['nombreusuario'], ENT_QUOTES, 'UTF-8') ?></p>
                </div>
                <div class='estrellas'>
                    <img src='<?php echo htmlspecialchars($valoracion); ?>'>
                </div>
                <form class="etexto" action="rtxtedit.php" method="post">
                    <div class='texto'>
                        <textarea name="newtxt" placeholder='Escribe algo...' maxlength='300'><?= htmlspecialchars($item['texto'], ENT_QUOTES, 'UTF-8') ?></textarea>
                    </div>
                    <div class="edidel">
                        <input name='idm' id='rid' value="<?= htmlspecialchars($item['idmusica'], ENT_QUOTES, 'UTF-8') ?>"></input>
                        <input name="idgenerico" id="idg" value="1"></input>
                        <button id="editar" type="submit">Enviar texto</button>
                    </div>
                </form>
            </div>
            <div class="edidel">
                <form id="dedit" method="POST" action="delete.php">
                    <input name='idm2' id='rid' value="<?= htmlspecialchars($item['idmusica'], ENT_QUOTES, 'UTF-8') ?>"></input>
                    <input name="idgenerico" id="idg" value="1"></input>
                    <button onclick="return confirm('¿Seguro que quieres eliminar la recomendacion?');" id="borrar" type="submit">-</button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php endforeach; ?>