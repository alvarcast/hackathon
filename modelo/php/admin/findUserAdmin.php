<?php

include "../../../common/php/connect.php";

$usuario = $_POST['find'];

$sql = "SELECT usuario,
email,
estatus
FROM usuarios
WHERE usuario LIKE '%".$usuario."%'";

$mysqliresult = $conn->query($sql);
$results = $mysqliresult->fetch_all(MYSQLI_ASSOC);

?>

<link rel="stylesheet" href="../../../vista/css/adminStyle.css">

<header>
    <img src="../../../vista/img/Logo_en_babyblue__3___1_-removebg-preview (1).png" alt="Admin Logo">
    <h1>Panel de Administrador</h1>
</header>

<nav>
    <a href="../../../vista/php/admin.php">Volver</a>
</nav>

<?php

if(empty($results)){
    echo"<h2 style='text-align: center'>No se encontraron resultados</h2>";
} else {
    echo"<h2 style='text-align: center'>Se encontraron ".count($results)." resultado/s</h2>";
}

?>
<?php foreach ($results as $item):?>

    <div class="container" style="padding: 10px;">
        <div id="manage-users" class="section">
            <table>
                <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>E-mail</th>
                        <th>Estatus</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?= htmlspecialchars($item['usuario'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($item['email'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($item['estatus'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td>
                            <form style="margin: 0;" action="../../modelo/php/admin/userActions.php?controlUsr=1&usuario=<?php echo $item['usuario']; ?>" method="post">
                                <button class="button chat" type="submit">Abrir chat</button>
                            </form>
                            <?php
                                if($item['estatus'] == "SUSPENDIDO"){
                                    echo
                                    "
                                        <form style='margin: 0;' action='../../modelo/php/admin/userActions.php?controlUsr=3&usuario=" . $item['usuario'] . "' method='post' onsubmit=\"return confirm('Seguro que quieres desbanear a este usuario?');\">
                                            <button class='button allow' type='submit'>Desbanear</button>
                                        </form>
                                    ";
                                } else {
                                    echo
                                    "
                                        <form style='margin: 0;' action='../../modelo/php/admin/userActions.php?controlUsr=2&usuario=" . $item['usuario'] . "' method='post' onsubmit=\"return confirm('Seguro que quieres banear a este usuario?');\">
                                            <button class='button ban' type='submit'>Banear</button>
                                        </form>
                                    ";
                                }
                            ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

<?php endforeach; ?>

<?php include "../../../common/php/disconnect.php"; ?>