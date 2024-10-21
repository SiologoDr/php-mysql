<?php
    include "../../includes/cargar_clases.php";

    $crudcliente = new CRUDCliente();

    if(isset($_POST["cod_cli"])){
        $cod_cli=$_POST["cod_cli"];

        $crudcliente->ConsultarClientePorCodigo($cod_cli);

    }
