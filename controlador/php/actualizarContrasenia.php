<?php

include "../../common/php/connect.php";

$contrasenia = $_POST['contrasenia'];
$sql = "UPDATE usuarios SET password = '$contrasenia' WHERE IdUsuario = ". $_SESSION['id'];

if ($conn->query($sql) === TRUE) {
    echo "Contraseña actualizada correctamente";
} else {
    echo "Error al insertar datos: " . $conn->error . "<br>";
}

?>