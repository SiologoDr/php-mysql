<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../../PHPMailer/src/Exception.php';
require __DIR__ . '/../../PHPMailer/src/PHPMailer.php';
require __DIR__ . '/../../PHPMailer/src/SMTP.php';

function configurarMailer() {
    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; 
        $mail->SMTPAuth   = true;
        $mail->Username   = 'estefanyt3101@gmail.com'; // Email del remitente
        $mail->Password   = 'bsunklhzcfuqpwfo';       // Contraseña del email
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        // Configuración del remitente
        $mail->setFrom('estefanyt3101@gmail.com', 'Estefany Torres');

        return $mail;
    } catch (Exception $e) {
        echo "No se pudo configurar el correo: {$mail->ErrorInfo}";
    }
}
