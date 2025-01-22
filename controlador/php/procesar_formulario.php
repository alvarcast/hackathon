<?php

include "../../common/php/connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Datos del Usuario
    $password = $_POST['password'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];

    // Datos de la Dirección
    $tipo_via = $_POST['tipo_via'];
    $nombre_via = $_POST['nombre_via'];
    $tipo = $_POST['tipo'];
    $nro = $_POST['nro'];
    $piso = isset($_POST['piso']) ? $_POST['piso'] : '';
    $esc = isset($_POST['esc']) ? $_POST['esc'] : '';
    $puerta = isset($_POST['puerta']) ? $_POST['puerta'] : '';
    $cod_postal = $_POST['cod_postal'];
    $localidad = $_POST['localidad'];
    $provincia = $_POST['provincia'];

    // Consulta de último ID de usuario
    $sqlc = "SELECT id FROM usuarios ORDER BY id DESC LIMIT 1";
    $resultc = $conn->query($sqlc);
    if ($resultc) {
        $rowc = $resultc->fetch_assoc();
        $id = isset($rowc['id']) ? $rowc['id'] + 1 : 1;
    } else {
        die("Error al consultar el último ID de usuario: " . $conn->error);
    }

    $username = "usr" . str_pad($id, 4, "0", STR_PAD_LEFT);

    // Datos Adicionales
    $tipo_usuario = $_POST['tipo_usuario'];
    $entidad = $_POST['entidad'];
    $estatus = "Inactivo";
    $lopdgdd = 0; // Asegúrate de que este campo tenga un valor válido

    // Inserción en la tabla direcciones
    $sql = "INSERT INTO direcciones (tipo_via, nombre_via, tipo, nro, piso, esc, puerta, cod_postal, localidad, provincia) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Error en la preparación de la consulta de direcciones: " . $conn->error);
    }

    $stmt->bind_param("sssisssiss", $tipo_via, $nombre_via, $tipo, $nro, $piso, $esc, $puerta, $cod_postal, $localidad, $provincia);

    if (!$stmt->execute()) {
        die("Error al insertar en direcciones: " . $stmt->error);
    }

    $id_direccion = $conn->insert_id; // Obtén el ID autoincremental de direcciones
    $stmt->close();

    // Inserción en la tabla usuarios
    $sql2 = "INSERT INTO usuarios (usuario, password, id_dir, telefono, email, fecha_registro, estatus, id_entidad, id_tipo, lopdgdd)
            VALUES (?, ?, ?, ?, ?, CURDATE(), ?, ?, ?, ?)";
    $stmt2 = $conn->prepare($sql2);

    if (!$stmt2) {
        die("Error en la preparación de la consulta de usuarios: " . $conn->error);
    }

    $stmt2->bind_param("ssisssiii", $username, $password, $id_direccion, $telefono, $email, $estatus, $entidad, $tipo_usuario, $lopdgdd);

    if (!$stmt2->execute()) {
        die("Error al insertar en usuarios: " . $stmt2->error);
    }

    header("Location: ../../vista/php/admin.php#manage-users");
}

?>
