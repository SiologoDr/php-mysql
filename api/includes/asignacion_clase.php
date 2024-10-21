<?php
    require_once('../../paginas/modelo/conexion.php');

    class Asignacion {
        public static function RegistrarAsignacion($codigo_asignacion, $fecha_asignacion, $rol, $asignacion_codigo_empleado, $asignacion_codigo_proyecto) {
            // Obtener la conexión a la base de datos
            $db = new Conexion();
            $pdo = $db->Conectar();
    
            // Verificar si el codigo_asignacion ya existe
            $check_sql = "SELECT COUNT(*) FROM tb_asignacion WHERE codigo_asignacion = :codigo_asignacion";
            $check_stmt = $pdo->prepare($check_sql);
            $check_stmt->bindParam(':codigo_asignacion', $codigo_asignacion);
            $check_stmt->execute();
    
            // Si el código ya existe, no permitir la inserción
            if ($check_stmt->fetchColumn() > 0) {
                return false;
            }
    
            // Si no existe, proceder a la inserción
            $sql = "CALL sp_registrar_asignacion(:codigo_asignacion, :fecha_asignacion, :rol, :asignacion_codigo_empleado, :asignacion_codigo_proyecto)";
            $stmt = $pdo->prepare($sql);
    
            // Enlazar parámetros
            $stmt->bindParam(':codigo_asignacion', $codigo_asignacion);
            $stmt->bindParam(':fecha_asignacion', $fecha_asignacion);
            $stmt->bindParam(':rol', $rol);
            $stmt->bindParam(':asignacion_codigo_empleado', $asignacion_codigo_empleado);
            $stmt->bindParam(':asignacion_codigo_proyecto', $asignacion_codigo_proyecto);
    
            // Ejecutar la sentencia
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public static function EditarAsignacion($codigo_asignacion, $fecha_asignacion, $rol, $asignacion_codigo_empleado, $asignacion_codigo_proyecto) {
            // Obtener la conexión a la base de datos
            $db = new Conexion();
            $pdo = $db->Conectar();
    
            // Verificar si el codigo_asignacion existe antes de intentar actualizar
            $check_sql = "SELECT COUNT(*) FROM tb_asignacion WHERE codigo_asignacion = :codigo_asignacion";
            $check_stmt = $pdo->prepare($check_sql);
            $check_stmt->bindParam(':codigo_asignacion', $codigo_asignacion);
            $check_stmt->execute();
    
            // Si no existe, no permitir la actualización
            if ($check_stmt->fetchColumn() == 0) {
                return false; // El código no existe
            }
    
            // Si existe, proceder con la actualización
            $sql = "CALL sp_editar_asignacion(:codigo_asignacion, :fecha_asignacion, :rol, :asignacion_codigo_empleado, :asignacion_codigo_proyecto)";
            $stmt = $pdo->prepare($sql);
    
            // Enlazar parámetros
            $stmt->bindParam(':codigo_asignacion', $codigo_asignacion);
            $stmt->bindParam(':fecha_asignacion', $fecha_asignacion);
            $stmt->bindParam(':rol', $rol);
            $stmt->bindParam(':asignacion_codigo_empleado', $asignacion_codigo_empleado);
            $stmt->bindParam(':asignacion_codigo_proyecto', $asignacion_codigo_proyecto);
    
            // Ejecutar la sentencia
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public static function BorrarAsignacion($codigo_asignacion) {
            // Obtener la conexión a la base de datos
            $db = new Conexion();
            $pdo = $db->Conectar();
    
            // Llamar al procedimiento almacenado para borrar/desactivar la asignación
            $sql = "CALL sp_borrar_asignacion(:codigo_asignacion)";
            $stmt = $pdo->prepare($sql);
    
            // Enlazar el parámetro
            $stmt->bindParam(':codigo_asignacion', $codigo_asignacion);
    
            // Ejecutar la sentencia
            try {
                if ($stmt->execute()) {
                    return true;
                } else {
                    return false;
                }
            } catch (PDOException $e) {
                // Capturar la excepción y devolver false
                return false;
            }
        }

        public static function MostrarAsignacionPorCodigo($codigo_asignacion) {
            // Obtener la conexión a la base de datos
            $db = new Conexion();
            $pdo = $db->Conectar();
    
            // Llamar al procedimiento almacenado para listar la asignación por código
            $sql = "CALL sp_mostrar_asignacion_por_codigo(:codigo_asignacion)";
            $stmt = $pdo->prepare($sql);
    
            // Enlazar el parámetro
            $stmt->bindParam(':codigo_asignacion', $codigo_asignacion);
    
            // Ejecutar la sentencia
            $stmt->execute();
    
            // Obtener los resultados
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            return $resultado;
        }

        public static function FiltrarPorRol($rol) {
            // Obtener la conexión a la base de datos
            $db = new Conexion();
            $pdo = $db->Conectar();
    
            // Llamar al procedimiento almacenado para filtrar asignaciones por rol
            $sql = "CALL sp_filtrar_por_asignacion(:rol)";
            $stmt = $pdo->prepare($sql);
    
            // Enlazar el parámetro
            $stmt->bindParam(':rol', $rol);
    
            // Ejecutar la sentencia
            $stmt->execute();
    
            // Obtener los resultados
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            return $resultado;
        }

        public static function ListarAsignaciones() {
            // Obtener la conexión a la base de datos
            $db = new Conexion();
            $pdo = $db->Conectar();
    
            // Llamar al procedimiento almacenado para listar asignaciones activas
            $sql = "CALL sp_listar_asignacion()";
            $stmt = $pdo->prepare($sql);
    
            // Ejecutar la sentencia
            $stmt->execute();
    
            // Obtener los resultados
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            return $resultado;
        }
    }