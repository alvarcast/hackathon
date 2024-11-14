<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$target = $_POST['correo'];
$mail = new PHPMailer(true);

try {
    // Configuración del servidor SMTP
    $mail->isSMTP();
    $mail->Host       = 'smtp.tu-smtp.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'tu-usuario-smtp';
    $mail->Password   = 'tu-contraseña-smtp';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    // Destinatario
    $mail->setFrom('cisco@tu-sitio.com', 'Cisco');
    $mail->addAddress($target);

    // Contenido del correo
    $mail->isHTML(true);
    $mail->Subject = 'Recuperación de contraseña';
    
    // URL de recuperación
    $reset_link = "../../vista/html/reestablecerContrasenia.html";
    
    // Cuerpo del correo
    $mail->Body = "
        <html>
        <head>
          <title>Recupera tu contraseña</title>
        </head>
        <body>
          <h2>Hola,</h2>
          <p>Haz clic en el siguiente enlace para restablecer tu contraseña:</p>
          <p><a href='$reset_link'>Recuperar Contraseña</a></p>
          <p>Si no has solicitado este cambio, ignora este mensaje.</p>
        </body>
        </html>
    ";

    // Envío del correo
    $mail->send();
    echo 'Correo de recuperación enviado';
} catch (Exception $e) {
    echo "Error al enviar el correo: {$mail->ErrorInfo}";
}
?>
