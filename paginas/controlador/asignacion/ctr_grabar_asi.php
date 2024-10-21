<?php
    include "../../includes/cargar_clases.php";
    include "../../utils/sendEmail.php";

    $crudasignacion = new CRUDAsignacion();
    $crudEmpleado = new CRUDEmpleado();

    if(isset($_POST["btn_registrar_asi"])){
        $asignacion= new Asignacion();

        $asignacion->codigo_asignacion = $_POST["txt_codasi"];
        $asignacion->fecha_asignacion = $_POST["txt_f_asi"];
        $asignacion->rol=$_POST["txt_rol"];
        $asignacion->asignacion_codigo_empleado=$_POST["cbo_emp"];
        $asignacion->asignacion_codigo_proyecto=$_POST["cbo_pro"];

        $tipo = $_POST["txt_tipo"];

        if($tipo == "r"){
            $crudasignacion->RegistrarAsignacion($asignacion);
        }else if($tipo == "e"){
            $crudasignacion->EditarAsignacion($asignacion);
        }

        $empleado = $crudEmpleado->BuscarEmpleadoPorCodigo($asignacion->asignacion_codigo_empleado);
        $asig= $crudasignacion->MostrarAsignacionPorCodigo($asignacion->codigo_asignacion);
        
        $nombreCliente = $asig->nombre_cliente; 
        $rol = $asignacion->rol;

        enviarCorreoAsignacion($empleado->email, $empleado->nombre_empleado,$empleado->apellido_paterno ,$asignacion->asignacion_codigo_proyecto, $nombreCliente, $rol);
        header("location: ../../vista/asignacion/listar_asignacion.php");   

    }