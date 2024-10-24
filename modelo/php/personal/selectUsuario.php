<?php

$sql = "SELECT id,
usuario,
teléfono,
email,
estatus
FROM usuarios
WHERE id = ".$_SESSION['id'];

$mysqliresult = $conn->query($sql);
$results = $mysqliresult->fetch_all(MYSQLI_ASSOC);

?>

<?php foreach ($results as $item):?>

<p>Usuario: <?= htmlspecialchars($item['usuario'], ENT_QUOTES, 'UTF-8') ?></p>
<p>Teléfono: <?= htmlspecialchars($item['teléfono'], ENT_QUOTES, 'UTF-8') ?></p>
<p>E-Mail: <?= htmlspecialchars($item['email'], ENT_QUOTES, 'UTF-8') ?></p>
<p>Estatus: <?= htmlspecialchars($item['estatus'], ENT_QUOTES, 'UTF-8') ?></p>

<?php endforeach; ?>