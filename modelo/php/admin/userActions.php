<?php

include "../../../common/php/connect.php";

if (isset($_SESSION['id'])) {
    $sqlc = "SELECT
    id_tipo
    FROM usuarios
    WHERE id = " . $_SESSION['id'];

    $resultc = $conn->query($sqlc);
    $rowc = $resultc->fetch_assoc();

    if ($rowc['id_tipo'] == 1) {
        if(isset($_GET["controlUsr"])) { 
            $userControl = $_GET['controlUsr'];
            $usuario = $_GET['usuario'];
            if($userControl != null){
                if($userControl == 1){
                    $sql = "SELECT u.id,
                    usuario,
                    telefono,
                    email,
                    localidad,
                    provincia,
                    fecha_registro,
                    estatus,
                    e.nombre AS entidad,
                    t.tipo AS tipo_usuario,
                    lopdgdd
                    FROM usuarios u
                    INNER JOIN direcciones d ON u.id_dir = d.id
                    INNER JOIN entidades e ON u.id_entidad = e.id
                    INNER JOIN tipo_usuario t ON u.id_tipo = t.id
                    WHERE usuario = '".$usuario."';";

                    $mysqliresult = $conn->query($sql);
                    $row = $mysqliresult->fetch_assoc();

                    if ($row) {
                        echo "<div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px;'>";
                        echo "<h2>Detalles del Usuario</h2>";
                        echo "<table style='width: 100%; border-collapse: collapse;'>";
                        echo "<tr><td><strong>ID del usuario:</strong></td><td>" . $row['id'] . "</td></tr>";
                        echo "<tr><td><strong>Usuario:</strong></td><td>" . $row['usuario'] . "</td></tr>";
                        echo "<tr><td><strong>Teléfono:</strong></td><td>" . $row['telefono'] . "</td></tr>";
                        echo "<tr><td><strong>Email:</strong></td><td>" . $row['email'] . "</td></tr>";
                        echo "<tr><td><strong>Localidad:</strong></td><td>" . $row['localidad'] . "</td></tr>";
                        echo "<tr><td><strong>Provincia:</strong></td><td>" . $row['provincia'] . "</td></tr>";
                        echo "<tr><td><strong>Fecha de registro:</strong></td><td>" . $row['fecha_registro'] . "</td></tr>";
                        echo "<tr><td><strong>Estatus:</strong></td><td>" . $row['estatus'] . "</td></tr>";
                        echo "<tr><td><strong>Entidad:</strong></td><td>" . $row['entidad'] . "</td></tr>";
                        echo "<tr><td><strong>Tipo de usuario:</strong></td><td>" . $row['tipo_usuario'] . "</td></tr>";
                        echo "<tr><td><strong>LOPDGDD:</strong></td><td>" . $row['lopdgdd'] . "</td></tr>";
                        echo "</table>";
                        echo "<br>";
                        echo "<a href='../../../vista/php/admin.php#manage-users' style='text-decoration: none; background-color: #4CAF50; color: white; padding: 10px 20px; border-radius: 5px;'>Volver</a>";
                        echo "</div>";
                    } else {
                        echo "<p>No se encontraron resultados para el usuario especificado.</p>";
                        echo "<a href='../../../vista/php/admin.php#manage-users'>Volver</a>";
                    }

                }else if($userControl == 2){
                    $sql = "UPDATE usuarios
                    SET password = NULL, estatus= 'SUSPENDIDO'
                    WHERE usuario = '".$usuario."';";
        
                    $mysqliresult = $conn->query($sql);
                    header("Location: ../../../vista/php/admin.php#manage-users");
                }else if($userControl == 3){
                    $sql = "UPDATE usuarios
                    SET password = 'p123456789', estatus= 'ACTIVO'
                    WHERE usuario = '".$usuario."';";
        
                    $mysqliresult = $conn->query($sql);
                    header("Location: ../../../vista/php/admin.php#manage-users");
                }
            }
        }
    } else {
        header("Location: ../../../common/php/disconnect.php");
    }

} else {
    header("Location: ../../../vista/php/login.php");
}

$conn->close();

?>