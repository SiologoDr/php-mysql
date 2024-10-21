<?php
    include "../../includes/cargar_clases.php";

    $crudproyecto = new CRUDProyecto(); 

    if(isset($_POST["valor"])){
        $valor=$_POST["valor"];

        $crudproyecto->FiltrarProyecto($valor);

    }