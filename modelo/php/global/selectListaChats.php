<?php

$sql = "SELECT id,
id_publicacion
FROM chats
WHERE id_usuario_solicita = ". $_SESSION['id'] ". OR id_usuario_recibe = ". $_SESSION['id'];

$mysqliresult = $conn->query($sql);
$results = $mysqliresult->fetch_all(MYSQLI_ASSOC);

?>

<?php foreach ($results as $item):?>

<p>ID Chat: <?= htmlspecialchars($item['id'], ENT_QUOTES, 'UTF-8') ?></p>
<p>ID Publicación del chat: <?= htmlspecialchars($item['id_publicacion'], ENT_QUOTES, 'UTF-8') ?></p>

<?php endforeach; ?>