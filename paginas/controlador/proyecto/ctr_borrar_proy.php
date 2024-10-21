<?php
    include "../../includes/cargar_clases.php";

    $crudproyecto = new CRUDProyecto(); 

    if(isset($_GET["cod_proy"])){
        $cod_proy=$_GET["cod_proy"];

        $crudproyecto->BorrarProyecto($cod_proy);

        header("location: ../../vista/proyecto/listar_proyecto.php");

    }