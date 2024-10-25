<?php

$whereClause = "id_usuario_solicita = " . $_SESSION['id'] . " OR id_usuario_pub = " . $_SESSION['id'];
$chatCount = 1;

$sql = "SELECT id,
id_publicacion
FROM chats
WHERE " . $whereClause;

$mysqliresult = $conn->query($sql);
$results = $mysqliresult->fetch_all(MYSQLI_ASSOC);

?>

<?php foreach ($results as $item):?>

<h3>Chat <?= htmlspecialchars($chatCount, ENT_QUOTES, 'UTF-8') ?></h3>
<p>ID Chat: <?= htmlspecialchars($item['id'], ENT_QUOTES, 'UTF-8') ?></p>
<p>ID Publicación del chat: <?= htmlspecialchars($item['id_publicacion'], ENT_QUOTES, 'UTF-8') ?></p>

<?php $chatCount = $chatCount + 1 ?>

<?php endforeach; ?>