<?php
    require_once('../includes/asignacion_clase.php');

    // Verifica que la solicitud sea POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Obtén los datos del cuerpo de la solicitud POST en lugar de usar $_GET
        $data = json_decode(file_get_contents("php://input"), true);

        // Verifica que todos los parámetros requeridos estén presentes
        if (isset($data['codigo_asignacion']) && isset($data['fecha_asignacion']) && isset($data['rol']) && isset($data['asignacion_codigo_empleado']) && isset($data['asignacion_codigo_proyecto'])) {
            // Llama al método de la clase Asignacion para registrar la asignación
            if (Asignacion::RegistrarAsignacion($data['codigo_asignacion'], $data['fecha_asignacion'], $data['rol'], $data['asignacion_codigo_empleado'], $data['asignacion_codigo_proyecto'])) {
                // Enviar respuesta de éxito
                header('HTTP/1.1 201 EXITO: Asignacion registrada');
                echo json_encode(array("message" => "Asignacion registrada con exito"));
            } else {
                // Enviar respuesta de error en la ejecución
                header('HTTP/1.1 500 ERROR: No se ha registrado la Asignacion');
                echo json_encode(array("message" => "El codigo de la asignacion ya existe"));
            }
        } else {
            // Enviar respuesta de error si faltan parámetros
            header('HTTP/1.1 400 ERROR: Faltan parametros');
            echo json_encode(array("message" => "Faltan parametros para registrar la asignacion"));
        }
    } else {
        // Enviar respuesta de error si no es una solicitud POST
        header('HTTP/1.1 405 ERROR: Metodo no permitido');
        echo json_encode(array("message" => "Metodo no permitido, use POST"));
    }

