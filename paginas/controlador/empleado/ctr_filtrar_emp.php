<?php
    include "../../includes/cargar_clases.php";

    $crudempleado = new CRUDEmpleado(); 

    if(isset($_POST["valor"])){
        $valor=$_POST["valor"];

        $crudempleado->FiltrarEmpleado($valor);

    }