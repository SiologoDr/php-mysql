<?php
    include "../../includes/cargar_clases.php";

    $crudarea = new CRUDArea(); 

    if(isset($_GET["cod_area"])){
        $cod_area=$_GET["cod_area"];

        $crudarea->BorrarArea($cod_area);

        header("location: ../../vista/area/listar_area.php");

    }