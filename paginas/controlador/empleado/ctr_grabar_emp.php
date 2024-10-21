<?php
    include "../../includes/cargar_clases.php";

    $crudempleado = new CRUDEmpleado(); 

    if(isset($_POST["btn_registrar_emp"])){
        $empleado = new Empleado();

        $empleado->codigo_empleado = $_POST["txt_codemp"];
        $empleado->nombre_empleado = $_POST["txt_nombre"];
        $empleado->apellido_materno = $_POST["txt_apellido_mat"];
        $empleado->apellido_paterno = $_POST["txt_apellido_pat"];
        $empleado->tipo_documento = $_POST["cbo_tipo_doc"];
        $empleado->nro_documento = $_POST["txt_nro_doc"];
        $empleado->telefono = $_POST["txt_telefono"];
        $empleado->email = $_POST["txt_email"];
        $empleado->direccion = $_POST["txt_direccion"];
        $empleado->sueldo = $_POST["txt_sueldo"];
        $empleado->estado_sueldo = $_POST["cbo_estado_sueldo"];
        $empleado->fecha_contratacion = $_POST["txt_fecha_contratacion"];
        $empleado->puesto = $_POST["txt_puesto"];
        $empleado->empleado_codigo_area = $_POST["cbo_area"];

        $tipo = $_POST["txt_tipo"];

        if($tipo == "r"){
            $crudempleado->RegistrarEmpleado($empleado);
        } else if($tipo == "e"){
            $crudempleado->EditarEmpleado($empleado);
        }
        header("location: ../../vista/empleado/listar_empleado.php");   
    }
?>