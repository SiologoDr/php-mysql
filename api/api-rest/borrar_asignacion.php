<?php
require_once('../includes/asignacion_clase.php');

// Verifica que la solicitud sea DELETE
if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    // Obtén los datos del cuerpo de la solicitud DELETE (en este caso, puede ser json o url params)
    $data = json_decode(file_get_contents("php://input"), true);

    // Verifica que el código de asignación esté presente
    if (isset($data['codigo_asignacion'])) {
        // Llama al método de la clase Asignacion para borrar/desactivar la asignación
        if (Asignacion::BorrarAsignacion($data['codigo_asignacion'])) {
            // Enviar respuesta de éxito
            header('HTTP/1.1 200 EXITO: Asignacion borrada/desactivada');
            echo json_encode(array("message" => "Asignacion desactivada con exito"));
        } else {
            // Enviar respuesta de error si no se pudo desactivar la asignación (por ejemplo, si no existe o ya está desactivada)
            header('HTTP/1.1 404 ERROR: No se ha encontrado la Asignacion para borrar');
            echo json_encode(array("message" => "El codigo de la asignacion no existe o ya esta desactivada"));
        }
    } else {
        // Enviar respuesta de error si falta el parámetro
        header('HTTP/1.1 400 ERROR: Falta parametro');
        echo json_encode(array("message" => "Falta el codigo de la asignacion para borrar"));
    }
} else {
    // Enviar respuesta de error si no es una solicitud DELETE
    header('HTTP/1.1 405 ERROR: Metodo no permitido');
    echo json_encode(array("message" => "Metodo no permitido, use DELETE"));
}
