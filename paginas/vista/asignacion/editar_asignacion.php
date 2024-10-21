<!DOCTYPE html>
<html lang="es">
    <?php
    $ruta = "../../..";
    $titulo = "Editar Asignación";
    include "../../includes/cabecera.php";
    ?>
    <body>
    <div class="container-fluid d-flex">
        <?php
        include "../../includes/menu.php";
        include "../../includes/cargar_clases.php";
        if(isset($_GET["codasi"])){
        $codasi=$_GET["codasi"];
        $crudasignacion= new CRUDAsignacion();
        $rs_asi=$crudasignacion->BuscarAsignacionPorCodigo($codasi);
        if(!empty($rs_asi)){
            $crudempleado = new CRUDEmpleado();
            $crudproyecto = new CRUDProyecto();

            $rs_emp = $crudempleado-> ListarEmpleado();
            $rs_pro = $crudproyecto-> ListarProyecto(); 
        }
        else{
            header ("location: listar_asignacion.php");
        }
        }else {
            header ("location: listar_asignacion.php");
        }

        ?>
        <div class="flex-grow-1 p-4">
        <div class="container mt-3">
            <header>
                <h1 class="text-primary">
                    <i class="fas fa-plus-circle"></i> Editar Asignacion
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
                                    <form id="frm_editar_asi" name="frm_editar_asi" method="post" action="../../controlador/asignacion/ctr_grabar_asi.php"
                                    autocomplete="off">
                                    <input type="hidden" id="txt_tipo" name="txt_tipo" value="e" />

                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <label for="txt_codasi" class="form-label">Código</label>
                                                <input type="text" class="form-control" id="txt_codasi" name="txt_codasi" placeholder="Código" readonly value="<?=$rs_asi->codigo_asignacion?>" />
                                            </div>

                                            <div class="col-md-8">
                                                <label for="txt_f_asi" class="form-label">Fecha</label>
                                                <input type="date" class="form-control" id="txt_f_asi" name="txt_f_asi" placeholder="Fecha de asignación" maxlength="10" value="<?=$rs_asi->fecha_asignacion?>"/>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="txt_rol" class="form-label">Asignar rol</label>
                                                <input type="text" class="form-control" id="txt_rol" name="txt_rol" placeholder="Asignar rol" value="<?=$rs_asi->rol?>"/>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="cbo_cli" class="form-label">Empleado</label>
                                                <select class="form-select form-select-lg mb-3" id="cbo_emp" name="cbo_emp">
                                                <option value="" selected>[Seleccione Empleado]</option>
                                                <?php
                                                    foreach ($rs_emp as $emp) {
                                                        $selected = ($emp->codigo_empleado == $rs_asi->asignacion_codigo_empleado) ? 'selected' : '';
                                                        echo "<option value='{$emp->codigo_empleado}' $selected>{$emp->nombre_empleado} {$emp->apellido_paterno}</option>";
                                                    }
                                                ?>
                                                </select>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="cbo_cli" class="form-label">Proyecto</label>
                                                <select class="form-select form-select-lg mb-3" id="cbo_pro" name="cbo_pro">
                                                <option value="" selected>[Seleccione Proyecto]</option>
                                                <?php
                                                    foreach ($rs_pro as $pro) {
                                                        $selected = ($pro->codigo_proyecto == $rs_asi->asignacion_codigo_proyecto) ? 'selected' : '';
                                                        echo "<option value='{$pro->codigo_proyecto}' $selected>{$pro->proyecto}</option>";
                                                    }
                                                ?>
                                                </select>
                                            </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-outline-primary" id="btn_registrar_asi" name="btn_registrar_asi">
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