<?php
    include "../../includes/cargar_clases.php";

    $crudproyecto = new CRUDProyecto(); 

    if(isset($_POST["btn_registrar_proy"])){
        $proyecto= new Proyecto();

        $proyecto->codigo_proyecto = $_POST["txt_codproy"];
        $proyecto->proyecto = $_POST["txt_proy"];
        $proyecto->descripcion=$_POST["txt_descr"];
        $proyecto->fecha_inicio=$_POST["txt_f_ini"];
        $proyecto->fecha_fin=$_POST["txt_f_fin"];
        $proyecto->estado_proyecto=$_POST["cbo_es_proy"];
        $proyecto->precio=$_POST["txt_precio"];
        $proyecto->proyecto_codigo_cliente=$_POST["cbo_cli"];

        $tipo = $_POST["txt_tipo"];

        if($tipo == "r"){
            $crudproyecto->RegistrarProyecto($proyecto);
        }else if($tipo == "e"){
            $crudproyecto->EditarProyecto($proyecto);
        }
        header("location: ../../vista/proyecto/listar_proyecto.php");

    }