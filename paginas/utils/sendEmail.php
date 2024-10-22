<?php
include 'configmailer.php';
include __DIR__ . '/../templates/plantillaEmail.php';

function enviarCorreoAsignacion($emailEmpleado, $nombreEmpleado,$apellido, $codigoProyecto, $nombreCliente, $rol) {
    $mail = configurarMailer();

    // Crear instancia de CRUDProyecto
    $crudProyecto = new CRUDProyecto();
    $crudCliente= new CRUDCliente();
    
    // Obtener detalles del proyecto
    $proyecto = $crudProyecto->BuscarProyectoPorCodigo($codigoProyecto);
    
    try {
        // Destinatario
        $mail->addAddress($emailEmpleado, $nombreEmpleado);

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = mb_encode_mimeheader('Asignación de Proyecto', 'UTF-8', 'B');
        
        // Generar la plantilla del correo con los detalles del proyecto
        $mail->Body = generarPlantillaCorreo($nombreEmpleado, $apellido, $proyecto, $nombreCliente, $rol);

        // Enviar el correo
        $mail->send();
    } catch (Exception $e) {
        echo "No se pudo enviar el correo. Error: {$mail->ErrorInfo}";
    }
}
