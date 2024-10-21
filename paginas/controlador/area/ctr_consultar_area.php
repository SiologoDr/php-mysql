<?php
    include "../../includes/cargar_clases.php";

    $crudarea = new CRUDArea(); 

    if(isset($_POST["cod_area"])){
        $cod_area=$_POST["cod_area"];

        $crudarea->ConsultarAreaPorCodigo($cod_area);

    }