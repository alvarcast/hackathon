<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración</title>
    <link rel="stylesheet" href="../css/adminStyle.css">
    <link rel="icon" href="../img/logo.png" type="image/x-icon">
</head>

<?php 

    include "../../common/php/connect.php"; 

    if (isset($_SESSION['id'])){
        $id = $_SESSION['id'];

        $sql = "SELECT id_tipo FROM usuarios
        WHERE id = $id";

        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

        if($row['id_tipo'] != 1){
            header("Location: ../../common/php/disconnect.php");
        }

        $sqlU = "SELECT usuario, email, estatus FROM usuarios
        ORDER BY id ASC";
    
        $mysqliresult = $conn->query($sqlU);
        $resultsU = $mysqliresult->fetch_all(MYSQLI_ASSOC);
    
        $sqlP = "SELECT p.id AS pid, p.descripcion, p.control, u.usuario 
        FROM publicaciones p
        INNER JOIN usuarios u ON u.id = p.id_usuario
        ORDER BY 
        CASE p.control
            WHEN 'pendiente' THEN 1
            WHEN 'rechazado' THEN 2
            WHEN 'aprobado' THEN 3
        END ASC";
    
        $mysqliresult = $conn->query($sqlP);
        $resultsP = $mysqliresult->fetch_all(MYSQLI_ASSOC);
    
        $sqlC = "SELECT c.id as cid, u1.usuario AS publisher, u2.usuario AS requester, descripcion
        FROM chats c
        INNER JOIN usuarios u1 ON u1.id = c.id_usuario_pub
        INNER JOIN usuarios u2 ON u2.id = c.id_usuario_solicita
        INNER JOIN publicaciones p ON p.id = c.id_publicacion
        ORDER BY c.id ASC";
    
        $mysqliresult = $conn->query($sqlC);
        $resultsC = $mysqliresult->fetch_all(MYSQLI_ASSOC);
    
    } else {
        header("Location: login.php");
    }

?>

<body>
    <header>
        <h1>Panel de Administrador</h1>
    </header>
    <nav>
        <a href="categorias.php">Inicio</a>
        <a href="#manage-users">Administrar Usiarios</a>
        <a href="#manage-publications">Administrar Publicaciones</a>
        <a href="#manage-chats">Administrar Chats</a>
    </nav>

    <div class=barra>
        <form action="../../modelo/php/admin/findUserAdmin.php" method="post">
            <input type="text" placeholder="Buscar usuario..." id="find" name="find">
            <button type="submit">Buscar</button>
        </form>
    </div>

    <div class="container">
        <div id="manage-users" class="section">
            <h2>Administrar Usiarios</h2>
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
                    <?php foreach ($resultsU as $item):?>
                        <tr>
                            <td><?= htmlspecialchars($item['usuario'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($item['email'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($item['estatus'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td>
                                <form action="../../modelo/php/admin/userActions.php?controlUsr=1&usuario=<?php echo $item['usuario']; ?>" method="post">
                                    <button class="button chat" type="submit">Abrir chat</button>
                                </form>
                                <?php
                                    if($item['estatus'] == "SUSPENDIDO"){
                                        echo
                                        "
                                            <form action='../../modelo/php/admin/userActions.php?controlUsr=3&usuario=" . $item['usuario'] . "' method='post' onsubmit=\"return confirm('Seguro que quieres desbanear a este usuario?');\">
                                                <button class='button allow' type='submit'>Desbanear</button>
                                            </form>
                                        ";
                                    } else {
                                        echo
                                        "
                                            <form action='../../modelo/php/admin/userActions.php?controlUsr=2&usuario=" . $item['usuario'] . "' method='post' onsubmit=\"return confirm('Seguro que quieres banear a este usuario?');\">
                                                <button class='button ban' type='submit'>Banear</button>
                                            </form>
                                        ";
                                    }
                                ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div id="manage-publications" class="section">
            <h2>Administrar Publicaciones</h2>
            <table>
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Donante</th>
                        <th>Estatus</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($resultsP as $item):?>
                        <tr>
                            <td><?= htmlspecialchars($item['descripcion'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($item['usuario'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($item['control'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td>
                                <?php
                                    if($item['control'] == "pendiente"){
                                        echo
                                        "
                                            <form action='../../modelo/php/admin/publicationActions.php?controlPub=1&pid=" . $item['pid'] . "' method='post' onsubmit=\"return confirm('Seguro que quieres permitir esta donación?');\">
                                                <button class='button allow' type='submit'>Permitir</button>
                                            </form>
                                        ";
                                        echo
                                        "
                                            <form action='../../modelo/php/admin/publicationActions.php?controlPub=2&pid=" . $item['pid'] . "' method='post' onsubmit=\"return confirm('Seguro que quieres denegar esta donación?');\">
                                                <button class='button deny' type='submit'>Denegar</button>
                                            </form>
                                        ";
                                    } else if ($item['control'] == "rechazado") {
                                        echo
                                        "
                                            <form action='../../modelo/php/admin/publicationActions.php?controlPub=1&pid=" . $item['pid'] . "' method='post' onsubmit=\"return confirm('Seguro que quieres permitir esta donación?');\">
                                                <button class='button allow' type='submit'>Permitir</button>
                                            </form>
                                        ";
                                    } else if ($item['control'] == "aprobado") {
                                        echo
                                        "
                                            <form action='../../modelo/php/admin/publicationActions.php?controlPub=2&pid=" . $item['pid'] . "' method='post' onsubmit=\"return confirm('Seguro que quieres retirar esta donación?');\">
                                                <button class='button deny' type='submit'>Retirar</button>
                                            </form>
                                        ";
                                    }
                                ?>
                                <form action="../../modelo/php/admin/publicationActions.php?controlPub=3&pid=<?php echo $item['pid']; ?>" method="post" onsubmit="return confirm('Seguro que quieres borrar esta publicación?')">
                                    <button class="button delete" type="submit">Borrar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div id="manage-chats" class="section">
            <h2>Administrar Chats</h2>
            <table>
                <thead>
                    <tr>
                        <th>Publicador</th>
                        <th>Solicitante</th>
                        <th>Publicación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($resultsC as $item):?>
                        <tr>
                            <td><?= htmlspecialchars($item['publisher'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($item['requester'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($item['descripcion'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td>
                                <form action="../../modelo/php/admin/chatActions.php?controlChat=1&cid=<?php echo $item['cid']; ?>" method="post">
                                    <button class="button chat" type="submit">Ver Chat</button>
                                </form>
                                <form action="../../modelo/php/admin/chatActions.php?controlChat=2&cid=<?php echo $item['cid']; ?>" method="post" onsubmit="return confirm('Seguro que quieres borrar este chat?')">
                                    <button class="button delete" type="submit">Borrar chat</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>