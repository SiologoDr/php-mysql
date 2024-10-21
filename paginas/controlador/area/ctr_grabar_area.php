<?php
    include "../../includes/cargar_clases.php";

    $crudarea = new CRUDArea(); 

    if(isset($_POST["btn_registrar_area"])){
        $area = new Area();

        $area->codigo_area = $_POST["txt_codarea"];
        $area->area = $_POST["txt_area"]; 

        $tipo = $_POST["txt_tipo"];

        if($tipo == "r"){
            $crudarea->RegistrarArea($area);
        }else if($tipo == "e"){
            $crudarea->EditarArea($area);
        }
        
        header("location: ../../vista/area/listar_area.php");   
    }
?>
