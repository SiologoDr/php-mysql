<?php
    include "../../includes/cargar_clases.php";

    $crudcliente = new CRUDCliente();

    if(isset($_POST["btn_registrar_cli"])){
        $cliente= new Cliente();

        $cliente->codigo_cliente = $_POST["txt_codcli"];
        $cliente->tipo_cliente = $_POST["cbo_tipo_cli"];
        $cliente->nombre_cliente=$_POST["txt_nombre"];
        $cliente->tipo_documento=$_POST["cbo_tipo_doc"];
        $cliente->nro_documento=$_POST["txt_nro_doc"];
        $cliente->telefono=$_POST["txt_tlf"];
        $cliente->email=$_POST["txt_email"];
        $cliente->direccion=$_POST["txt_dir"];

        $tipo = $_POST["txt_tipo"];

        if($tipo == "r"){
            $crudcliente->RegistrarCliente($cliente);
        }else if($tipo == "e"){
            $crudcliente->EditarCliente($cliente);
        }
        header("location: ../../vista/cliente/listar_cliente.php");   

    }
