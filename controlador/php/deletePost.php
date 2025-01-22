<?php

include "../../common/php/connect.php";

// Procesar eliminación del producto (solo de la tabla publicaciones)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = (int)$_POST['pid']; // Asegúrate de que el ID del producto sea un número entero

    // Eliminar solo de la tabla publicaciones
    try {
        // Usamos MySQLi para la eliminación
        $sql = "DELETE FROM publicaciones WHERE id = ? AND id_usuario = ?";
        $stmt = $conn->prepare($sql);
        
        // Verificamos si la preparación fue exitosa
        if ($stmt === false) {
            throw new Exception("Error en la preparación de la consulta: " . $conn->error);
        }

        // Enlazamos los parámetros
        $stmt->bind_param("ii", $product_id, $_SESSION['id']);
        
        // Ejecutamos la consulta
        $stmt->execute();

        // Verificamos si la ejecución fue exitosa
        if ($stmt->affected_rows > 0) {
            // Redirigir al perfil de usuario después de la eliminación
            header('Location: ../../vista/php/categorias.php');
            exit();
        } else {
            throw new Exception("No se pudo eliminar el producto o el producto no existe.");
        }

    } catch (Exception $e) {
        echo "Error al eliminar el producto: " . $e->getMessage();
    }
}

?>