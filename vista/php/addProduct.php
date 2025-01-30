<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Añadir Artículo</title>
  <link rel="stylesheet" href="../css/addProductStyle.css">
  <link rel="icon" href="../img/logo.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>

  <!-- Encabezado -->
  <header class="top-bar">
        <div class="logo">
            <img src="../img/logo.png" alt="Logo" id="logo">
        </div>
        <div class="icons">
            <!-- Iconos alineados a la derecha -->
            <a href="usuario.php"><img src= "../img/back_arrow.png" alt="Volver" title="Volver"></a>
            <a href="usuario.php"><img src= "../img/user.png" alt="logoff" title="Cerrar sesión"></a>
            <a href="../html/soporte.html"><img src= "../img/support.png" alt="ayuda" title="Ayuda"></a>
            <a href="listaChats.php"><img src= "../img/mesages.png" alt="mensajes" title="Mensajes"></a>
            <a href="categorias.php"><img src="../img/caja.png" title="Productos"></a>
        </div>
    </header>

  <form method="POST" action="addProduct.php" enctype="multipart/form-data" onsubmit="return validateImages()">
    <h1 style="text-align: center;">Añadir Artículo</h1>
    Nombre: <input type="text" name="nombre" required><br>
    Descripción: <input type="text" name="descripcion" required><br>
    Edad: 
    <select name="edad" required>
        <option value="0-3 meses">0-3 meses</option>
        <option value="6-12 meses">6-12 meses</option>
        <option value="1-3 años">1-3 años</option>
        <option value="4-6 años">4-6 años</option>
        <option value="7-9 años">7-9 años</option>
        <option value="10-14 años">10-14 años</option>
        <option value="15-18 años">15-18 años</option>
    </select><br>
    Fecha: <input type="date" name="fecha"><br>
    Estado físico: 
    <select name="estado_fisico" required>
        <option value="Usado excelente">Usado excelente</option>
        <option value="Usado">Usado</option>
        <option value="Desgastado">Desgastado</option>
    </select><br>
    Zona: 
    <select name="zona" required>
        <option value="Norte">Norte</option>
    </select><br>
    Imágenes (JPG): <input type="file" name="imagenes[]" accept=".jpg, .jpeg" multiple required id="imagenes"><br>
    <select name="id_categoria" required>
        <option value="5">mobiliario</option>
        <option value="6">ropa</option>
        <option value="8">juguetes</option>
        <option value="11">libros</option>
        <option value="9">electrodomesticos</option>
        <option value="10">equipo medico</option>
        <option value="12">juguetes educativos</option>
        <option value="13">electronicos</option>
    </select><br>
    <button type="submit">Guardar</button>
  </form>

  <script>
    function validateImages() {
        const input = document.getElementById('imagenes');
        if (input.files.length > 5) {
            alert('Solo puedes subir un máximo de 5 imágenes.');
            return false;
        }
        return true;
    }
  </script>

  <footer>
      <a href="../html/politicasPrivacidad.html">Políticas privacidad</a>
      <a href="../html/politicasCookies.html">Políticas de cookies</a>
      <a href="../html/avisoLegal.html">Aviso Legal</a>
      <a href="../html/soporte.html">Centro de asistencia</a>
  </footer>
</body>
</html>

<?php
include "../../common/php/connect.php";

try {
    $pdo = new PDO('mysql:host=localhost;dbname=hackathon', 'administrador', 'contraseñaAdministrador');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Error de conexión: ' . $e->getMessage());
}

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $descripcion = $_POST['descripcion'] ?? '';
    $edad = $_POST['edad'] ?? '';
    $fecha = $_POST['fecha'] ?? date('Y-m-d');
    $estado_fisico = $_POST['estado_fisico'] ?? '';
    $zona = $_POST['zona'] ?? '';
    $id_categoria = $_POST['id_categoria'] ?? '';
    $nombre = $_POST['nombre'] ?? '';

    if (empty($descripcion) || empty($edad) || empty($estado_fisico) || empty($zona) || empty($id_categoria)) {
        echo "Por favor, completa todos los campos obligatorios.";
        exit;
    }

    try {
        $sql_item = "INSERT INTO items (nombre, id_categoria) VALUES (:nombre, :id_categoria)";
        $stmt_item = $pdo->prepare($sql_item);
        $stmt_item->bindParam(':nombre', $nombre);
        $stmt_item->bindParam(':id_categoria', $id_categoria, PDO::PARAM_INT);
        $stmt_item->execute();

        $id_item = $pdo->lastInsertId();
        echo "El ítem ha sido insertado correctamente en la tabla 'items'.";
    } catch (PDOException $e) {
        echo "Error al insertar el ítem: " . $e->getMessage();
        exit;
    }

    try {
        $sql_producto = "INSERT INTO publicaciones (descripcion, edad, fecha, estado_fisico, zona, id_item, id_usuario) 
                         VALUES (:descripcion, :edad, :fecha, :estado_fisico, :zona, :id_item, :id_usuario)";
        $stmt_producto = $pdo->prepare($sql_producto);

        $stmt_producto->bindParam(':descripcion', $descripcion);
        $stmt_producto->bindParam(':edad', $edad);
        $stmt_producto->bindParam(':fecha', $fecha);
        $stmt_producto->bindParam(':estado_fisico', $estado_fisico);
        $stmt_producto->bindParam(':zona', $zona);
        $stmt_producto->bindParam(':id_item', $id_item, PDO::PARAM_INT);
        $stmt_producto->bindParam(':id_usuario', $_SESSION['id'], PDO::PARAM_INT);
        $stmt_producto->execute();

        $id_publicacion = $pdo->lastInsertId();
    } catch (PDOException $e) {
        echo "Error al insertar el producto: " . $e->getMessage();
        exit;
    }

    $uploads_dir = __DIR__ . '/uploads';

    if (!is_dir($uploads_dir)) {
        mkdir($uploads_dir, 0755, true);
    }

    if (isset($_FILES['imagenes'])) {
        $total_imagenes = count($_FILES['imagenes']['name']);

        if ($total_imagenes > 5) {
            echo "No puedes subir más de 5 imágenes.";
            exit;
        }

        foreach ($_FILES['imagenes']['name'] as $key => $image_name) {
            $image_tmp_name = $_FILES['imagenes']['tmp_name'][$key];
            $image_ext = pathinfo($image_name, PATHINFO_EXTENSION);
            $image_new_name = uniqid() . '.' . $image_ext;
            $image_path = $uploads_dir . '/' . $image_new_name;

            if (move_uploaded_file($image_tmp_name, $image_path)) {
                try {
                    $sql_foto = "INSERT INTO fotos (fecha, url, id_publicacion) VALUES (:fecha, :url, :id_publicacion)";
                    $stmt_foto = $pdo->prepare($sql_foto);
                    $stmt_foto->bindParam(':fecha', $fecha);
                    $stmt_foto->bindParam(':url', $image_path);
                    $stmt_foto->bindParam(':id_publicacion', $id_publicacion, PDO::PARAM_INT);
                    $stmt_foto->execute();
                } catch (PDOException $e) {
                    echo "Error al insertar la foto: " . $e->getMessage();
                    exit;
                }
            } else {
                echo "Error al mover el archivo: $image_name. Verifica que la carpeta $uploads_dir exista y tenga permisos.";
                exit;
            }
        }
    }

    header("Location: usuario.php");
    exit();
}
?>
