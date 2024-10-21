<?php
    include "../../includes/cargar_clases.php";

    $crudproyecto = new CRUDProyecto(); 

    if(isset($_POST["cod_proy"])){
        $cod_proy=$_POST["cod_proy"];

        $crudproyecto->ConsultarProyectoPorCodigo($cod_proy);

    }