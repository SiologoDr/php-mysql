<?php
session_start(); 

if (!isset($_SESSION['usuario'])) {
    header('Location: http://localhost/Panel_Jardhystex/login.php');
    exit(); 
}
?>
<!DOCTYPE html>
<html lang="es">
    <?php
    $ruta = "../../..";
    $titulo = "Editar Empleado";
    include "../../includes/cabecera.php";
    ?>
    <body>
    <div class="container-fluid d-flex">
        <?php
        include "../../includes/menu.php";
        include "../../includes/cargar_clases.php";
        if(isset($_GET["codemp"])){
        $codemp = $_GET["codemp"];
        $crudempleado = new CRUDEmpleado();
        $rs_emp = $crudempleado->BuscarEmpleadoPorCodigo($codemp);
        if(!empty($rs_emp)){
            $crudarea = new CRUDArea();
            $rs_area = $crudarea->ListarArea();
        }
        else{
            header ("location: listar_empleado.php");
        }
        } else {
            header ("location: listar_empleado.php");
        }
        ?>
        <div class="flex-grow-1 p-4">
        <div class="container mt-3">
            <header>
                <h1 class="text-primary">
                    <i class="fas fa-plus-circle"></i> Editar Empleado
                </h1>
                <hr/>
            </header>

            <nav>
                <a href="listar_empleado.php" class="btn btn-outline-secondary btn-sm">
                    <i class="fas fa-arrow-circle-left"></i> Regresar
                </a>
            </nav>

            <section>
    <article>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form id="frm_editar_emp" name="frm_editar_emp" method="post" action="../../controlador/empleado/ctr_grabar_emp.php" autocomplete="off">
                        <input type="hidden" id="txt_tipo" name="txt_tipo" value="e" />

                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label for="txt_codemp" class="form-label">Código</label>
                                    <input type="text" class="form-control" id="txt_codemp" name="txt_codemp" placeholder="Código" maxlength="5" readonly value="<?=$rs_emp->codigo_empleado?>" />
                                </div>

                                <div class="col-md-8">
                                    <label for="txt_nombre_emp" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="txt_nombre" name="txt_nombre" placeholder="Nombre del empleado" maxlength="50" value="<?=$rs_emp->nombre_empleado?>" />
                                </div>

                                <div class="col-md-6">
                                    <label for="txt_ap_pat" class="form-label">Apellido Paterno</label>
                                    <input type="text" class="form-control" id="txt_apellido_pat" name="txt_apellido_pat" placeholder="Apellido Paterno" maxlength="50" value="<?=$rs_emp->apellido_paterno?>" />
                                </div>

                                <div class="col-md-6">
                                    <label for="txt_ap_mat" class="form-label">Apellido Materno</label>
                                    <input type="text" class="form-control" id="txt_apellido_mat" name="txt_apellido_mat" placeholder="Apellido Materno" maxlength="50" value="<?=$rs_emp->apellido_materno?>" />
                                </div>

                                <div class="col-md-6">
                                    <label for="cbo_tipo_doc" class="form-label">Tipo de Documento</label>
                                    <select class="form-select" id="cbo_tipo_doc" name="cbo_tipo_doc">
                                        <?php
                                        $documentTypes = ['RUC','CARNET DE EXTRANJERIA', 'DNI'];
                                        foreach($documentTypes as $docType){
                                            $selected = ($docType == $rs_emp->tipo_documento) ? 'selected' : '';
                                            echo "<option value='{$docType}' $selected>{$docType}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="txt_nro_doc" class="form-label">Número de Documento</label>
                                    <input type="text" class="form-control" id="txt_nro_doc" name="txt_nro_doc" placeholder="Nro Documento" maxlength="12" value="<?=$rs_emp->nro_documento?>" />
                                </div>

                                <div class="col-md-6">
                                    <label for="txt_telefono" class="form-label">Teléfono</label>
                                    <input type="text" class="form-control" id="txt_telefono" name="txt_telefono" placeholder="Teléfono" maxlength="9" value="<?=$rs_emp->telefono?>" />
                                </div>

                                <div class="col-md-6">
                                    <label for="txt_email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="txt_email" name="txt_email" placeholder="Email" maxlength="100" value="<?=$rs_emp->email?>" />
                                </div>

                                <div class="col-md-6">
                                    <label for="txt_direccion" class="form-label">Dirección</label>
                                    <input type="text" class="form-control" id="txt_direccion" name="txt_direccion" placeholder="Dirección" maxlength="100" value="<?=$rs_emp->direccion?>" />
                                </div>

                                <div class="col-md-6">
                                    <label for="txt_sueldo" class="form-label">Sueldo</label>
                                    <input type="text" class="form-control" id="txt_sueldo" name="txt_sueldo" placeholder="Sueldo" maxlength="8" value="<?=$rs_emp->sueldo?>" />
                                </div>

                                <div class="col-md-6">
                                    <label for="cbo_estado_sueldo" class="form-label">Estado de Sueldo</label>
                                    <select class="form-select" id="cbo_estado_sueldo" name="cbo_estado_sueldo">
                                        <option value="" selected>[Seleccione Estado del Sueldo]</option>
                                        <?php
                                        $empleadoTypes = ['PENDIENTE','PAGADO','CANCELADO','RETRASADO','PARCIAL','REVISION'];
                                        foreach($empleadoTypes as $type){
                                            $selected = ($type == $rs_emp->estado_sueldo) ? 'selected':'';
                                            echo "<option value='{$type}' $selected>{$type}</option>";

                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="txt_fecha_contratacion" class="form-label">Fecha de Contratación</label>
                                    <input type="date" class="form-control" id="txt_fecha_contratacion" name="txt_fecha_contratacion" value="<?=$rs_emp->fecha_contratacion?>" />
                                </div>

                                <div class="col-md-6">
                                    <label for="txt_puesto" class="form-label">Puesto</label>
                                    <input type="text" class="form-control" id="txt_puesto" name="txt_puesto" placeholder="Puesto" maxlength="200" value="<?=$rs_emp->puesto?>" />
                                </div>

                                <div class="col-md-6">
                                    <label for="cbo_area" class="form-label">Área</label>
                                    <select class="form-select" id="cbo_area" name="cbo_area">
                                        <option value="" selected>[Seleccione área]</option>
                                        <?php
                                            foreach ($rs_area as $area) {
                                                $selected = ($area->codigo_area == $rs_emp->empleado_codigo_area) ? 'selected' : '';
                                                echo "<option value='{$area->codigo_area}' $selected>{$area->area}</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="text-center mt-3">
                                <button type="submit" class="btn btn-outline-primary" id="btn_registrar_emp" name="btn_registrar_emp">
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