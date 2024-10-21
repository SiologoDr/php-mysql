<?php
    include "../../includes/cargar_clases.php";

    $crudasignacion = new CRUDAsignacion(); 

    if(isset($_POST["valor"])){
        $valor=$_POST["valor"];

        $crudasignacion->FiltrarAsignacion($valor);

    }