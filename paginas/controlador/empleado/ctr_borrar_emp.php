<?php
    include "../../includes/cargar_clases.php";

    $crudempleado = new CRUDEmpleado(); 

    if(isset($_GET["cod_emp"])){
        $cod_emp=$_GET["cod_emp"];

        $crudempleado->BorrarEmpleado($cod_emp);

        header("location: ../../vista/empleado/listar_empleado.php");

    }