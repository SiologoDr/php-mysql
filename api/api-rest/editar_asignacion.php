<?php
require_once('../includes/asignacion_clase.php');

if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['codigo_asignacion']) && isset($data['fecha_asignacion']) && isset($data['rol']) && isset($data['asignacion_codigo_empleado']) && isset($data['asignacion_codigo_proyecto'])) {
        if (Asignacion::EditarAsignacion($data['codigo_asignacion'], $data['fecha_asignacion'], $data['rol'], $data['asignacion_codigo_empleado'], $data['asignacion_codigo_proyecto'])) {
            header('HTTP/1.1 200 EXITO: Asignacion actualizada');
            echo json_encode(array("message" => "Asignacion actualizada con exito"));
        } else {
            header('HTTP/1.1 404 ERROR: No se ha encontrado la Asignacion para actualizar');
            echo json_encode(array("message" => "El codigo de la asignacion no existe"));
        }
    } else {
        header('HTTP/1.1 400 ERROR: Faltan parametros');
        echo json_encode(array("message" => "Faltan parametros para actualizar la asignacion"));
    }
} else {
    header('HTTP/1.1 405 ERROR: Metodo no permitido');
    echo json_encode(array("message" => "Metodo no permitido, use PUT"));
}
