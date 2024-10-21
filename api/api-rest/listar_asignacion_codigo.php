<?php
require_once('../includes/asignacion_clase.php');

// Verifica que la solicitud sea GET
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Verifica que el parámetro codigo_asignacion esté presente
    if (isset($_GET['codigo_asignacion'])) {
        // Llama al método de la clase Asignacion para obtener la información por código
        $resultado = Asignacion::MostrarAsignacionPorCodigo($_GET['codigo_asignacion']);

        // Si se encuentra la asignación
        if ($resultado) {
            // Enviar respuesta de éxito con los datos de la asignación
            header('HTTP/1.1 200 OK');
            echo json_encode($resultado);
        } else {
            // Enviar respuesta de error si no se encontró la asignación
            header('HTTP/1.1 404 ERROR: Asignacion no encontrada');
            echo json_encode(array("message" => "Asignacion no encontrada"));
        }
    } else {
        // Enviar respuesta de error si falta el parámetro
        header('HTTP/1.1 400 ERROR: Falta parametro');
        echo json_encode(array("message" => "Falta el parametro codigo_asignacion"));
    }
} else {
    // Enviar respuesta de error si no es una solicitud GET
    header('HTTP/1.1 405 ERROR: Metodo no permitido');
    echo json_encode(array("message" => "Metodo no permitido, use GET"));
}
?>
