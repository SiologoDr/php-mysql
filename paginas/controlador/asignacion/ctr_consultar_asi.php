<?php
    include "../../includes/cargar_clases.php";

    $crudasignacion = new CRUDAsignacion(); 

    if(isset($_POST["cod_asi"])){
        $cod_asi=$_POST["cod_asi"];

        $crudasignacion->ConsultarAsignacionPorCodigo($cod_asi);

    }