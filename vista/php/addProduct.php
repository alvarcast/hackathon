<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Añadir Artículo</title>
  <link rel="stylesheet" href="../css/addProductStyle.css">
  <link rel="icon" href="../img/logo.png">
</head>

<body>
   
  <!-- Encabezado -->
  <header class="top-bar">
        <div class="logo">
            <img src="../img/logo.png" alt="Logo" id="logo">
        </div>
        <div class="icons">
            <!-- Iconos alineados a la derecha -->
            <a href="usuario.php"><img src= "../img/user.png" alt="logoff"></a>
            <a href="../html/soporte.html"><img src= "../img/support.png" alt="ayuda"></a>
            <a href="listaChats.php"><img src= "../img/mesages.png" alt="mensajes"></a>
            <a href="categorias.php"><img src="../img/caja.png"></a>
            <a href="javascript:history.back()"><img src= "../img/back_arrow.png" alt="Volver"></a>
        </div>
    </header>
  <form method="POST" action="addProduct.php" enctype="multipart/form-data">
    <h1 style="text-align: center;">Añadir Artículo</h1>
    Nombre: <input type="text" name="nombre" required><br>
    Descripción: <input type="text" name="descripcion" required><br>
    Edad: 
    <select name="edad" required>
        <option value="0-3 meses">0-3 meses</option>
        <option value="6-12 meses">6-12 meses</option>
        <option value="1-3 anios">1-3 anios</option>
        <option value="4-6 anios">4-6 anios</option>
        <option value="7-9 anios">7-9 anios</option>
        <option value="10-14 anios">10-14 anios</option>
        <option value="15-18 anios">15-18 anios</option>
        <!-- Resto de opciones -->
    </select><br>
    Fecha: <input type="date" name="fecha"><br>
    Estado físico: 
    <select name="estado_fisico" required>
        <option value="Usado excelente">Usado excelente</option>
        <option value="Usado">Usado</option>
        <option value="Desgastado">Desgastado</option>
        <!-- Resto de opciones -->
    </select><br>
    Zona: 
    <select name="zona" required>
        <option value="Norte">Norte</option>
        <!-- Resto de opciones -->
    </select><br>
    Imagen (JPG): <input type="file" name="imagen" accept=".jpg, .jpeg" required><br>
    
    <select name="id_categoria" required>
        <option value="5">mobiliario</option>
        <option value="6">ropa</option>
        <option value="8">juguetes</option>
        <option value="11">libros</option>
        <option value="9">electrodomesticos</option>
        <option value="10">equipo medico</option>
        <option value="12">juguetes educativos</option>
        <option value="13">electronicos</option>
        <!-- Resto de opciones -->
    </select><br>
    <button type="submit">Guardar</button>
    </form>
    

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

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Datos del formulario
    $descripcion = $_POST['descripcion'] ?? '';
    $edad = $_POST['edad'] ?? '';
    $fecha = $_POST['fecha'] ?? date('Y-m-d');
    $estado_fisico = $_POST['estado_fisico'] ?? '';
    $zona = $_POST['zona'] ?? '';
    $id_categoria = $_POST['id_categoria'] ?? ''; // ID de categoría
    $nombre = $_POST['nombre'] ?? ''; // Nombre del producto

    // Validar campos obligatorios
    if (empty($descripcion) || empty($edad) || empty($estado_fisico) || empty($zona) || empty($id_categoria)) {
        echo "Por favor, completa todos los campos obligatorios.";
        exit;
    }

    // Validar que la imagen sea un archivo JPG
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $imagen_tmp = $_FILES['imagen']['tmp_name'];
        $imagen_name = $_FILES['imagen']['name'];
        $imagen_type = $_FILES['imagen']['type'];
        $imagen_size = $_FILES['imagen']['size'];

        // Validar el tipo de archivo (solo .jpg y .jpeg)
        if ($imagen_type !== 'image/jpeg') {
            echo "Error: El archivo debe ser una imagen JPG (jpeg).";
            exit;
        }

        // Validar el tamaño máximo del archivo (por ejemplo, 2MB)
        if ($imagen_size > 2 * 1024 * 1024) { // 2MB
            echo "Error: El archivo es demasiado grande. El tamaño máximo es 2MB.";
            exit;
        }

        // Definir la ruta local donde se guardará la imagen
        $local_upload_dir = './imagenes/';
        
        // Asegurarse de que el directorio de imágenes existe
        if (!is_dir($local_upload_dir)) {
            mkdir($local_upload_dir, 0777, true);  // Crear el directorio si no existe
        }

        // Guardar la imagen en el directorio local
        $imagen_path = $local_upload_dir . basename($imagen_name);

        if (move_uploaded_file($imagen_tmp, $imagen_path)) {
            // Subida exitosa
            echo "Imagen subida con éxito: " . $imagen_name;
        } else {
            echo "Error al subir la imagen.";
            exit;
        }

        // Guardar la ruta y la fecha de la imagen en la tabla fotos
        try {
            $sql_foto = "INSERT INTO fotos (fecha, url) 
                         VALUES (:fecha, :url)";
            $stmt_foto = $pdo->prepare($sql_foto);
            $stmt_foto->bindParam(':fecha', $fecha);
            $stmt_foto->bindParam(':url', $imagen_path); // Guardar la ruta completa de la imagen

            $stmt_foto->execute();

            // Obtener el ID de la imagen insertada (auto-increment)
            $id_imagen = $pdo->lastInsertId(); // Este es el ID recién generado para la imagen

            echo "La ruta de la imagen ha sido guardada correctamente en la base de datos.";
        } catch (PDOException $e) {
            echo "Error al guardar la ruta de la imagen: " . $e->getMessage();
            exit;
        }
    } else {
        echo "Error: No se ha cargado ninguna imagen o ha ocurrido un problema.";
        exit;
    }

    // Insertar en la tabla items
    try {
        $sql_item = "INSERT INTO items (nombre, id_categoria) 
                     VALUES (:nombre, :id_categoria)";
        
        $stmt_item = $pdo->prepare($sql_item);
        $stmt_item->bindParam(':nombre', $nombre);
        $stmt_item->bindParam(':id_categoria', $id_categoria, PDO::PARAM_INT);
        
        $stmt_item->execute();
        
        // Obtener el ID del item insertado
        $id_item = $pdo->lastInsertId();
        
        echo "El ítem ha sido insertado correctamente en la tabla 'items'.";
    } catch (PDOException $e) {
        echo "Error al insertar el ítem: " . $e->getMessage();
        exit;
    }

    // Insertar en la tabla productos
    try {
        $sql_producto = "INSERT INTO publicaciones (descripcion, edad, fecha, estado_fisico, zona, id_item, id_imagenes, id_usuario) 
                         VALUES (:descripcion, :edad, :fecha, :estado_fisico, :zona, :id_item, :id_imagenes, :id_usuario)";
        
        $stmt_producto = $pdo->prepare($sql_producto);
        
        $stmt_producto->bindParam(':descripcion', $descripcion);
        $stmt_producto->bindParam(':edad', $edad);
        $stmt_producto->bindParam(':fecha', $fecha);
        $stmt_producto->bindParam(':estado_fisico', $estado_fisico);
        $stmt_producto->bindParam(':zona', $zona);
        $stmt_producto->bindParam(':id_item', $id_item, PDO::PARAM_INT); // ID del item insertado
        $stmt_producto->bindParam(':id_imagenes', $id_imagen, PDO::PARAM_INT); // ID de la imagen insertada
        $stmt_producto->bindParam(':id_usuario', $_SESSION['id'], PDO::PARAM_INT); // ID del usuario desde la sesión
        
        $stmt_producto->execute();
        
        header("Location: usuario.php");
    } catch (PDOException $e) {
        echo "Error al insertar el producto: " . $e->getMessage();
        exit;
    }
}
?>
