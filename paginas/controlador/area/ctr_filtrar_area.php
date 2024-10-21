<?php
    include "../../includes/cargar_clases.php";

    $crudarea = new CRUDArea(); 

    if(isset($_POST["valor"])){
        $valor=$_POST["valor"];

        $crudarea->FiltrarArea($valor);

    }