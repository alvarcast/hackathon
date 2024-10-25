<?php

$countPublicaciones = 1;

$sql = "SELECT id,
descripción,
edad
FROM publicaciones
WHERE id_usuario = ". $_SESSION['id'];

$mysqliresult = $conn->query($sql);
$results = $mysqliresult->fetch_all(MYSQLI_ASSOC);

?>

<?php foreach ($results as $item):?>

<h3>Publicación <?= htmlspecialchars($countPublicaciones, ENT_QUOTES, 'UTF-8') ?></h3>

<p>Publicación: <?= htmlspecialchars($item['id'], ENT_QUOTES, 'UTF-8') ?></p>
<p>Descripción: <?= htmlspecialchars($item['descripción'], ENT_QUOTES, 'UTF-8') ?></p>
<p>Edad: <?= htmlspecialchars($item['edad'], ENT_QUOTES, 'UTF-8') ?></p>

<?php $countPublicaciones = $countPublicaciones + 1 ?>

<?php endforeach; ?>