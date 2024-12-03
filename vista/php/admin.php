<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración</title>
    <link rel="stylesheet" href="../css/adminStyle.css">
</head>
<body>
    <header>
        <img src="../img/Logo_en_babyblue__3___1_-removebg-preview (1).png" alt="Admin Logo">
        <h1>Panel de Administrador</h1>
    </header>
    <nav>
        <a href="#paginadeproductos">Inicio</a>
        <a href="#manage-users">Administrar Usiarios</a>
        <a href="#manage-products">Administrar Publicaciones</a>
        <a href="#manage-chats">Administrar Chats</a>
    </nav>

    <div class="container">
        <div id="manage-users" class="section">
            <h2>Administrar Usiarios</h2>
            <table>
                <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>E-mail</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>JohnDoe</td>
                        <td>john.doe@example.com</td>
                        <td>
                            <button class="button chat">Abrir chat</button>
                            <button class="button ban">Banear</button>
                        </td>
                    </tr>
                    <tr>
                        <td>JaneDoe</td>
                        <td>jane.doe@example.com</td>
                        <td>
                            <button class="button chat">Abrir chat</button>
                            <button class="button ban">Banear</button>
                        </td>
                    </tr>
                    <tr>
                        <td>MikeSmith</td>
                        <td>mike.smith@example.com</td>
                        <td>
                            <button class="button chat">Abrir chat</button>
                            <button class="button ban">Banear</button>
                        </td>
                    </tr>
                    <tr>
                        <td>SarahConnor</td>
                        <td>sarah.connor@example.com</td>
                        <td>
                            <button class="button chat">Abrir chat</button>
                            <button class="button ban">Banear</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div id="manage-products" class="section">
            <h2>Administrar Publicaciones</h2>
            <table>
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Donante</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Pijama</td>
                        <td>JaneDoe</td>
                        <td>
                            <button class="button allow">Permitir</button>
                            <button class="button deny">Denegar</button>
                            <button class="button delete">Borrar</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Cuna</td>
                        <td>MikeSmith</td>
                        <td>
                            <button class="button allow">Permitir</button>
                            <button class="button deny">Denegar</button>
                            <button class="button delete">Borrar</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Peluche</td>
                        <td>SarahConnor</td>
                        <td>
                            <button class="button allow">Permitir</button>
                            <button class="button deny">Denegar</button>
                            <button class="button delete">Borrar</button>
                        </td>
                    </tr>
                    <tr>
                        <td>PS3</td>
                        <td>JohnDoe</td>
                        <td>
                            <button class="button allow">Permitir</button>
                            <button class="button deny">Denegar</button>
                            <button class="button delete">Borrar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div id="manage-chats" class="section">
            <h2>Administrar Chats</h2>
            <table>
                <thead>
                    <tr>
                        <th>Usuario 1</th>
                        <th>Usuario 2</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>JohnDoe</td>
                        <td>JaneDoe</td>
                        <td>
                            <button class="button chat">Ver Chat</button>
                            <button class="button delete">Borrar Chat</button>
                        </td>
                    </tr>
                    <tr>
                        <td>MikeSmith</td>
                        <td>SarahConnor</td>
                        <td>
                            <button class="button chat">Ver Chat</button>
                            <button class="button delete">Borrar Chat</button>
                        </td>
                    </tr>
                    <tr>
                        <td>JaneDoe</td>
                        <td>MikeSmith</td>
                        <td>
                            <button class="button chat">Ver Chat</button>
                            <button class="button delete">Borrar Chat</button>
                        </td>
                    </tr>
                    <tr>
                        <td>SarahConnor</td>
                        <td>JohnDoe</td>
                        <td>
                            <button class="button chat">Ver Chat</button>
                            <button class="button delete">Borrar Chat</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>