<?php
session_start(); // Asegúrate de iniciar la sesión

include "../../common/php/connect.php";

// Verificar si se ha realizado una búsqueda
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Variables para la búsqueda por filtros
    $edad = isset($_POST['edad']) && $_POST['edad'] !== '' ? $conn->real_escape_string($_POST['edad']) : null;
    $articulo = isset($_POST['articulo']) && $_POST['articulo'] !== '' ? $conn->real_escape_string($_POST['articulo']) : null;
    $estado = isset($_POST['estado']) && $_POST['estado'] !== '' ? $conn->real_escape_string($_POST['estado']) : null;

    // Variables para la búsqueda por nombre
    $search = isset($_POST['search']) && !empty($_POST['search']) ? $conn->real_escape_string($_POST['search']) : null;

    // Construir consulta SQL según el tipo de búsqueda
    if ($search) {
        // Búsqueda por nombre
        $sql = "SELECT p.id, nombre, id_imagenes
                FROM publicaciones p
                INNER JOIN items i ON p.id_item = i.id
                WHERE i.nombre LIKE '%$search%' 
                AND control = 'aprobado' AND estatus = 'publicado'";
    } else {
        // Búsqueda por filtros (edad, artículo, estado)
        $sql = "SELECT p.id, nombre, id_imagenes
                FROM publicaciones p
                INNER JOIN items i ON p.id_item = i.id
                WHERE control = 'aprobado' AND estatus = 'publicado'";

        if ($edad) {
            $sql .= " AND p.edad = '$edad'";
        }
        if ($articulo) {
            $sql .= " AND i.id = '$articulo'";
        }
        if ($estado) {
            $sql .= " AND p.estado_fisico = '$estado'";
        }
    }

    // Ejecutar la consulta
    $result = $conn->query($sql);

    // Guardar los resultados en la sesión
    if ($result) {
        $_SESSION['search_results'] = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        $_SESSION['search_results'] = [];
        error_log("Error en la consulta: " . $conn->error);
    }
} else {
    // Si no se realiza búsqueda, asegurarse que los resultados estén vacíos
    $_SESSION['search_results'] = [];
}

// Redirigir de vuelta a categorias.php
header("Location: ../../../hackathon/vista/php/categorias.php");
exit;
?>