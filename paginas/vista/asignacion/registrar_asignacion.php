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
        $titulo = "Aplicación de Ventas - Registrar Asignación";
        include "../../includes/cabecera.php"
    ?>
    <body>
    <div class="container-fluid d-flex">
        <?php
            include "../../includes/menu.php";
            include "../../includes/cargar_clases.php";

            $crudempleado = new CRUDEmpleado();
            $rs_emp = $crudempleado->ListarEmpleado(); 

            $crudproyecto = new CRUDProyecto();
            $rs_pro = $crudproyecto->ListarProyecto(); 
        ?>
        <div class="flex-grow-1 p-4">
        <div class="container mt-3">
            <header>
                <h1 class="text-primary">
                    <i class="fas fa-plus-circle"></i> Registrar Asignación
                </h1>
                <hr/>
            </header>

            <nav>
                <a href="listar_asignacion.php" class="btn btn-outline-secondary btn-sm">
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
                                    <form id="frm_registrar_asi" name="frm_registrar_asi" method="post" action="../../controlador/asignacion/ctr_grabar_asi.php" autocomplete="off">
                                        <input type="hidden" id="txt_tipo" name="txt_tipo" value="r" />

                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <label for="txt_codasi" class="form-label">Código</label>
                                                <input type="text" class="form-control" id="txt_codasi" name="txt_codasi" placeholder="Código" maxlength="5" autofocus />
                                            </div>

                                            <div class="col-md-4">
                                                <label for="txt_f_asi" class="form-label">Fecha</label>
                                                <input type="date" class="form-control" id="txt_f_asi" name="txt_f_asi" placeholder="Fecha de asignación" maxlength="10" />
                                            </div>

                                            <div class="col-md-8">
                                                <label for="txt_rol" class="form-label">Asignar rol</label>
                                                <input type="text" class="form-control" id="txt_rol" name="txt_rol" placeholder="Asignar rol" />
                                            </div>

                                            <div class="col-md-6">
                                                <label for="cbo_emp" class="form-label">Empleado</label>
                                                <select class="form-select form-select-lg mb-3" id="cbo_emp" name="cbo_emp">
                                                    <option value="" selected>[Seleccione Empleado]</option>
                                                <?php
                                                    foreach ($rs_emp as $emp) {
                                                ?>
                                                    <option value="<?= $emp->codigo_empleado ?>"><?= $emp->nombre_empleado . ' ' . $emp->apellido_paterno ?></option>
                                                <?php
                                                    }
                                                ?>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="cbo_pro" class="form-label">Proyecto</label>
                                                <select class="form-select form-select-lg mb-3" id="cbo_pro" name="cbo_pro">
                                                    <option value="" selected>[Seleccione Proyecto]</option>
                                                <?php
                                                    foreach ($rs_pro as $pro) {
                                                ?>
                                                    <option value="<?= $pro->codigo_proyecto ?>"><?= $pro->proyecto ?></option>
                                                <?php
                                                    }
                                                ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-outline-primary" id="btn_registrar_asi" name="btn_registrar_asi">
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