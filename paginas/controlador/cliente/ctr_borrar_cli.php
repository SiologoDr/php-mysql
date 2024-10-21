<?php
    include "../../includes/cargar_clases.php";

    $crudcliente = new CRUDCliente();

    if(isset($_GET["cod_cli"])){
        $cod_cli=$_GET["cod_cli"];

        $crudcliente->BorrarCliente($cod_cli);

        header("location: ../../vista/cliente/listar_cliente.php");

    }
