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
    $titulo = "Editar Proyecto";
    include "../../includes/cabecera.php";
    ?>
    <body>
    <div class="container-fluid d-flex">
        <?php
        include "../../includes/menu.php";
        include "../../includes/cargar_clases.php";
        if(isset($_GET["codproy"])){
        $codproy=$_GET["codproy"];
        $crudproyecto= new CRUDProyecto();
        $rs_proy=$crudproyecto->BuscarProyectoPorCodigo($codproy);
        if(!empty($rs_proy)){
            $crudcliente = new CRUDCliente();
            

            $rs_client = $crudcliente-> ListarCliente();
            
        }
        else{
            header ("location: listar_proyecto.php");
        }
        }else {
            header ("location: listar_proyecto.php");
        }
        ?>
        <div class="flex-grow-1 p-4">
        <div class="container mt-3">
            <header>
                <h1 class="text-primary">
                    <i class="fas fa-plus-circle"></i> Editar Proyecto
                </h1>
                <hr/>
            </header>

            <nav>
                <a href="listar_proyecto.php" class="btn btn-outline-secondary btn-sm">
                    <i class="fas fa-arrow-circle-left"></i> Regresar
                </a>
            </nav>

            <section>
    <article>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form id="frm_editar_proy" name="frm_editar_proy" method="post" action="../../controlador/proyecto/ctr_grabar_proy.php"
                        autocomplete="off">
                        <input type="hidden" id="txt_tipo" name="txt_tipo" value="e" />

                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label for="txt_codproy" class="form-label">Código</label>
                                    <input type="text" class="form-control" id="txt_codproy" name="txt_codproy" placeholder="Código" maxlength="5" readonly value="<?=$rs_proy->codigo_proyecto?>" />
                                </div>

                                <div class="col-md-8">
                                    <label for="txt_proy" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="txt_proy" name="txt_proy" placeholder="Nombre del proyecto" maxlength="40" value="<?=$rs_proy->proyecto?>"/>
                                </div>

                                <div class="col-md-4">
                                    <label for="txt_descr" class="form-label">Descripcion</label>
                                    <input type="text" class="form-control" id="txt_descr" name="txt_descr" placeholder="Stock" maxlength="4" min="1" max="9999" value="<?=$rs_proy->descripcion?>"/>
                                </div>

                                <div class="col-md-4">
                                    <label for="txt_f_ini" class="form-label">Fecha Inicio</label>
                                    <input type="date" class="form-control" id="txt_f_ini" name="txt_f_ini" placeholder="Fecha inicio"  step="0.01" value="<?=$rs_proy->fecha_inicio?>"/>
                                </div>

                                <div class="col-md-4">
                                    <label for="txt_f_fin" class="form-label">Fecha Final</label>
                                    <input type="date" class="form-control" id="txt_f_fin" name="txt_f_fin" placeholder="Fecha inicio"  step="0.01" value="<?=$rs_proy->fecha_fin?>"/>
                                </div>

                                <div class="col-md-4">
                                    <label for="cbo_es_proy" class="form-label">Estado</label>
                                    <input type="text" class="form-control" id="cbo_es_proy" name="cbo_es_proy" placeholder="Fecha inicio"  step="0.01" value="<?=$rs_proy->estado_proyecto?>"/>
                                </div>

                                <div class="col-md-4">
                                    <label for="txt_precio" class="form-label">Precio</label>
                                    <input type="number" class="form-control" id="txt_precio" name="txt_precio" placeholder="Fecha inicio" step="0.01" value="<?=$rs_proy->precio?>"/>
                                </div>

                                <div class="col-md-6">
                                    <label for="cbo_es_proy" class="form-label">Estado Cliente</label>
                                    <select class="form-select form-select-lg mb-3" id="cbo_es_proy" name="cbo_es_proy">
                                    <option value="" selected>[Seleccione Estado]</option>
                                    <?php
                                    $proyTypes = ['EN CURSO','PAUSADO','CANCELADO','PENDIENTE','FINALIZADO'];
                                    foreach ($proyTypes as $type) {
                                        $selected = ($type == $rs_proy->estado_proyecto) ? 'selected' : '';
                                        echo "<option value = '{$type}' $selected>{$type}</option>";

                                    }
                                    ?>
                                </select>

                                <div class="col-md-6">
                                    <label for="cbo_cli" class="form-label">Cliente</label>
                                    <select class="form-select form-select-lg mb-3" id="cbo_cli" name="cbo_cli">
                                    <option value="" selected>[Seleccione cliente]</option>
                                    <?php
                                        foreach ($rs_client as $client) {
                                            // Make sure the selected value is set correctly
                                            $selected = ($client->codigo_cliente == $rs_proy->proyecto_codigo_cliente) ? 'selected' : '';
                                            echo "<option value='{$client->codigo_cliente}' $selected>{$client->nombre_cliente}</option>";
                                        }
                                    ?>
                                </select>

                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-outline-primary" id="btn_registrar_proy" name="btn_registrar_proy">
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