<?php

$sql = "SELECT id,
descripción,
edad
FROM publicaciones
WHERE id_usuario = ". $_SESSION['id'];

$mysqliresult = $conn->query($sql);
$results = $mysqliresult->fetch_all(MYSQLI_ASSOC);

?>

<?php foreach ($results as $item):?>

<p>Publicación: <?= htmlspecialchars($item['id'], ENT_QUOTES, 'UTF-8') ?></p>
<p>Descripción: <?= htmlspecialchars($item['descripción'], ENT_QUOTES, 'UTF-8') ?></p>
<p>Edad: <?= htmlspecialchars($item['edad'], ENT_QUOTES, 'UTF-8') ?></p>

<?php endforeach; ?>