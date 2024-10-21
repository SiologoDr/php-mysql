<?php
    include "../../includes/cargar_clases.php";

    $crudasignacion = new CRUDAsignacion(); 

    if(isset($_GET["cod_asi"])){
        $cod_asi=$_GET["cod_asi"];

        $crudasignacion->BorrarAsignacion($cod_asi);

        header("location: ../../vista/asignacion/listar_asignacion.php");

    }