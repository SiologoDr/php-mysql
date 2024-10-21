<?php
require_once('../includes/asignacion_clase.php');

// Verifica que la solicitud sea GET
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Llama al método de la clase Asignacion para listar todas las asignaciones
    $resultado = Asignacion::ListarAsignaciones();

    // Si se encuentran asignaciones
    if ($resultado) {
        // Enviar respuesta de éxito con los datos de las asignaciones
        header('HTTP/1.1 200 OK');
        echo json_encode($resultado);
    } else {
        // Enviar respuesta de error si no se encuentran asignaciones
        header('HTTP/1.1 404 ERROR: Asignaciones no encontradas');
        echo json_encode(array("message" => "No se encontraron asignaciones activas"));
    }
} else {
    // Enviar respuesta de error si no es una solicitud GET
    header('HTTP/1.1 405 ERROR: Metodo no permitido');
    echo json_encode(array("message" => "Metodo no permitido, use GET"));
}
?>
