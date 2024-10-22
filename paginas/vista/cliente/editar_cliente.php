<?php
session_start(); 

if (!isset($_SESSION['usuario'])) {
    header('Location: http://ds502-jhardsystex.azurewebsites.net/login.php');
    exit(); 
}
?>
<!DOCTYPE html>
<html lang="es">
<?php
$ruta = "../../..";
$titulo = "Editar Cliente";
include "../../includes/cabecera.php";
?>
    <body>
    <div class="container-fluid d-flex">
        <?php
        include "../../includes/menu.php";
        include "../../includes/cargar_clases.php";
        if(isset($_GET["codclient"])){
            $codclient = $_GET["codclient"];
            $crudcliente = new CRUDCliente();
            $rs_client = $crudcliente->BuscarClientePorCodigo($codclient);
            if(empty($rs_client)){
                header("location: listar_cliente.php");
                exit();
            }
        } else {
            header("location: listar_cliente.php");
            exit();
        }
        ?>
        <div class="flex-grow-1 p-4">
        <div class="container mt-3">
            <header>
                <h1 class="text-primary">
                    <i class="fas fa-plus-circle"></i> Editar Cliente
                </h1>
                <hr/>
            </header>

            <nav>
                <a href="listar_cliente.php" class="btn btn-outline-secondary btn-sm">
                    <i class="fas fa-arrow-circle-left"></i> Regresar
                </a>
            </nav>

        <section>
            <article>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <form id="frm_editar_client" name="frm_editar_client" method="post"
                                action="../../controlador/cliente/ctr_grabar_cli.php" autocomplete="off">
                                <input type="hidden" id="txt_tipo" name="txt_tipo" value="e" />
                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <label for="txt_codcli" class="form-label">Código</label>
                                                <input type="text" class="form-control" id="txt_codcli" name="txt_codcli" placeholder="Código" maxlength="5" readonly value="<?=$rs_client->codigo_cliente?>" />
                                            </div>
                                            <div class="col-md-6">
                                                <label for="cbo_tipo_cli" class="form-label">Tipo de Cliente</label>
                                                <select class="form-select" id="cbo_tipo_cli" name="cbo_tipo_cli">
                                                    <option value="" selected>[Seleccione Tipo Cliente]</option>
                                                    <?php
                                                    $clientTypes = ['EMPRESA', 'ORGANIZACION', 'PERSONA'];
                                                    foreach ($clientTypes as $type) {
                                                        $selected = ($type == $rs_client->tipo_cliente) ? 'selected' : '';
                                                        echo "<option value='{$type}' $selected>{$type}</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="col-md-8">
                                                <label for="txt_nombre" class="form-label">Nombre</label>
                                                <input type="text" class="form-control" id="txt_nombre" name="txt_nombre" placeholder="Nombre del cliente" maxlength="50" value="<?=$rs_client->nombre_cliente?>"/>
                                            </div>


                                            <div class="col-md-6">
                                                <label for="cbo_tipo_doc" class="form-label">Tipo de Documento</label>
                                                <select class="form-select" id="cbo_tipo_doc" name="cbo_tipo_doc">
                                                    <option value="" selected>[Seleccione Tipo Documento]</option>
                                                    <?php
                                                    $documentTypes = ['RUC', 'CARNET DE EXTRANJERIA', 'DNI'];
                                                    foreach ($documentTypes as $docType) {
                                                        $selected = ($docType == $rs_client->tipo_documento) ? 'selected' : '';
                                                        echo "<option value='{$docType}' $selected>{$docType}</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="txt_nro_doc" class="form-label">Número Documento</label>
                                                <input type="text" class="form-control" id="txt_nro_doc" name="txt_nro_doc" placeholder="Número Documento" maxlength="50" value="<?=$rs_client->nro_documento?>"/>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="txt_tlf" class="form-label">Teléfono</label>
                                                <input type="text" class="form-control" id="txt_tlf" name="txt_tlf" placeholder="Teléfono" maxlength="50" value="<?=$rs_client->telefono?>"/>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="txt_email" class="form-label">E-mail</label>
                                                <input type="email" class="form-control" id="txt_email" name="txt_email" placeholder="E-mail" maxlength="50" value="<?=$rs_client->email?>"/>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="txt_dir" class="form-label">Dirección</label>
                                                <input type="text" class="form-control" id="txt_dir" name="txt_dir" placeholder="Dirección" maxlength="50"value="<?=$rs_client->direccion?>"/>
                                            </div>
                                        </div>

                                        <div class="text-center mt-3">
                                            <button type="submit" class="btn btn-outline-primary" id="btn_registrar_cli" name="btn_registrar_cli">
                                            <i class="fa-solid fa-floppy-disk fa-bounce"></i> Actualizar Información
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            </section>
        </div>
        </div>
    </div>
        </body>
</html>
