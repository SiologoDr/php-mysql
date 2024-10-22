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
$titulo = "Aplicación de Ventas - Registrar Proyecto";
include "../../includes/cabecera.php"
    ?>

<body>
    <div class="container-fluid d-flex">
        <?php
        include "../../includes/menu.php";
        include "../../includes/cargar_clases.php";

        $crudcliente = new CRUDCliente();

        $rs_client = $crudcliente->ListarCliente();
        ?>
        <div class="flex-grow-1 p-4">
            <div class="container mt-3">
                <header>
                    <h1 class="text-primary">
                        <i class="fas fa-plus-circle"></i> Registrar Proyecto
                    </h1>
                    <hr />
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
                                        <!-- Inicio del Formulario -->
                                        <form id="frm_registrar_proy" name="frm_registrar_proy" method="post"
                                            action="../../controlador/proyecto/ctr_grabar_proy.php" autocomplete="off">
                                            <input type="hidden" id="txt_tipo" name="txt_tipo" value="r" />

                                            <div class="row g-3">
                                                <div class="col-md-4">
                                                    <label for="txt_codproy" class="form-label">Código</label>
                                                    <input type="text" class="form-control" id="txt_codproy"
                                                        name="txt_codproy" placeholder="Código" maxlength="5"
                                                        autofocus />
                                                </div>

                                                <div class="col-md-8">
                                                    <label for="txt_proy" class="form-label">Nombre</label>
                                                    <input type="text" class="form-control" id="txt_proy"
                                                        name="txt_proy" placeholder="Nombre del proyecto"
                                                        maxlength="40" />
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="txt_descr" class="form-label">Descripcion</label>
                                                    <input type="text" class="form-control" id="txt_descr"
                                                        name="txt_descr" placeholder="Descripcion" min="1"
                                                        max="9999" />
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="txt_f_ini" class="form-label">Fecha Inicio</label>
                                                    <input type="date" class="form-control" id="txt_f_ini"
                                                        name="txt_f_ini" placeholder="Fecha inicio" maxlength="15" />
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="txt_f_fin" class="form-label">Fecha Final</label>
                                                    <input type="date" class="form-control" id="txt_f_fin"
                                                        name="txt_f_fin" placeholder="Fecha Final" min="1" max="100"
                                                        step="0.01" />
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="txt_precio" class="form-label">Precio</label>
                                                    <input type="number" class="form-control" id="txt_precio"
                                                        name="txt_precio" placeholder="Precio" step="0.01" />
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="cbo_cli" class="form-label">Cliente</label>
                                                    <select class="form-select form-select-lg mb-3" id="cbo_cli"
                                                        name="cbo_cli">
                                                        <option value="" selected>[Seleccione Cliente]</option>
                                                        <?php
                                                        foreach ($rs_client as $cli) {
                                                            ?>
                                                            <option value="<?= $cli->codigo_cliente ?>">
                                                                <?= $cli->nombre_cliente ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="cbo_es_proy" class="form-label">Estado Proyecto</label>
                                                    <select class="form-select form-select-lg mb-3" id="cbo_es_proy"
                                                        name="cbo_es_proy">
                                                        <option value="" selected>[Seleccione Estado]</option>
                                                        <option value="En curso">EN CURSO</option>
                                                        <option value="Pausado">PAUSADO</option>
                                                        <option value="Cancelado">CANCELADO</option>
                                                        <option value="Pendiente">PENDIENTE</option>
                                                        <option value="Finalizado">FINALIZADO</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="text-center">
                                                <button type="submit" class="btn btn-outline-primary"
                                                    id="btn_registrar_proy" name="btn_registrar_proy">
                                                    <i class="fas fa-save"></i> Grabar Información
                                                </button>
                                            </div>

                                        </form>
                                        <!-- Fin del Formulario -->
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
