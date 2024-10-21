<?php
    include "../../includes/cargar_clases.php";

    $crudempleado = new CRUDEmpleado(); 

    if(isset($_POST["cod_emp"])){
        $cod_emp=$_POST["cod_emp"];

        $crudempleado->ConsultarEmpleadoPorCodigo($cod_emp);


    }