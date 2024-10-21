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
        $titulo = "Aplicación de Ventas - Registrar Empleado";
        include "../../includes/cabecera.php";
    ?>
    <body>
    <div class="container-fluid d-flex">
        <?php
            include "../../includes/menu.php";
            include "../../includes/cargar_clases.php";

            $crudarea = new CRUDArea();
            
            $rs_area = $crudarea->ListarArea();
            
        ?>
        <div class="flex-grow-1 p-4">
        <div class="container mt-3">
            <header>
                <h1 class="text-primary">
                    <i class="fas fa-plus-circle"></i> Registrar Empleado
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

                                    <form id="frm_registrar_emp" name="frm_registrar_emp" method="post" action="../../controlador/empleado/ctr_grabar_emp.php" autocomplete="off">
                                        <input type="hidden" id="txt_tipo" name="txt_tipo" value="r" />

                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <label for="txt_codemp" class="form-label">Código</label>
                                                <input type="text" class="form-control" id="txt_codemp" name="txt_codemp" placeholder="Código de empleado" maxlength="5" autofocus required />
                                            </div>

                                            <div class="col-md-8">
                                                <label for="txt_nom" class="form-label">Nombre Completo</label>
                                                <input type="text" class="form-control" id="txt_nombre" name="txt_nombre" placeholder="Nombre completo" maxlength="50" required />
                                            </div>

                                            <div class="col-md-6">
                                                <label for="txt_apepat" class="form-label">Apellido Paterno</label>
                                                <input type="text" class="form-control" id="txt_apellido_pat" name="txt_apellido_pat" placeholder="Apellido paterno" maxlength="50" required />
                                            </div>

                                            <div class="col-md-6">
                                                <label for="txt_apemat" class="form-label">Apellido Materno</label>
                                                <input type="text" class="form-control" id="txt_apellido_mat" name="txt_apellido_mat" placeholder="Apellido materno" maxlength="50" required />
                                            </div>

                                            <div class="col-md-6">
                                                <label for="cbo_tipo_doc" class="form-label">Tipo de Documento</label>
                                                <select class="form-select" id="cbo_tipo_doc" name="cbo_tipo_doc" required>
                                                    <option value="" selected>[Seleccione tipo de documento]</option>
                                                    <option value="DNI">DNI</option>
                                                    <option value="PASAPORTE">Pasaporte</option>
                                                    <option value="CARNET DE EXTRANJERIA">Carnet de extranjería</option>
                                                </select>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="txt_nro_doc" class="form-label">Número de Documento</label>
                                                <input type="text" class="form-control" id="txt_nro_doc" name="txt_nro_doc" placeholder="Número de documento" maxlength="12" required />
                                            </div>

                                            <div class="col-md-6">
                                                <label for="txt_telefono" class="form-label">Teléfono</label>
                                                <input type="text" class="form-control" id="txt_telefono" name="txt_telefono" placeholder="Teléfono" maxlength="9" required />
                                            </div>

                                            <div class="col-md-6">
                                                <label for="txt_email" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="txt_email" name="txt_email" placeholder="Email" maxlength="100" required />
                                            </div>

                                            <div class="col-md-12">
                                                <label for="txt_direccion" class="form-label">Dirección</label>
                                                <input type="text" class="form-control" id="txt_direccion" name="txt_direccion" placeholder="Dirección" maxlength="100" required />
                                            </div>

                                            <div class="col-md-6">
                                                <label for="txt_sueldo" class="form-label">Sueldo</label>
                                                <input type="number" step="0.01" class="form-control" id="txt_sueldo" name="txt_sueldo" placeholder="Sueldo" required />
                                            </div>

                                            <div class="col-md-6">
                                                <label for="cbo_estado_sueldo" class="form-label">Estado de Sueldo</label>
                                                <select class="form-select" id="cbo_estado_sueldo" name="cbo_estado_sueldo" required>
                                                    <option value="" selected>[Seleccione estado]</option>
                                                    <option value="PENDIENTE">Pendiente</option>
                                                    <option value="PAGADO">Pagado</option>
                                                    <option value="CANCELADO">Cancelado</option>
                                                    <option value="RETRASADO">Retrasado</option>
                                                    <option value="PARCIAL">Parcial</option>
                                                    <option value="REVISION">En Revisión</option>
                                                </select>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="txt_fecha_contratacion" class="form-label">Fecha de Contratación</label>
                                                <input type="date" class="form-control" id="txt_fecha_contratacion" name="txt_fecha_contratacion" required />
                                            </div>

                                            <div class="col-md-6">
                                                <label for="txt_puesto" class="form-label">Puesto</label>
                                                <input type="text" class="form-control" id="txt_puesto" name="txt_puesto" placeholder="Puesto" required/>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="cbo_area" class="form-label">Área</label>
                                                <select class="form-select" id="cbo_area" name="cbo_area" required>
                                                    <option value="" selected>[Seleccione área]</option>
                                                    <?php
                                                        foreach ($rs_area as $area) {
                                                    ?>
                                                        <option value="<?= $area->codigo_area ?>"><?= $area->area ?></option>
                                                    <?php
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="text-center mt-3">
                                            <button type="submit" class="btn btn-outline-primary" id="btn_registrar_emp" name="btn_registrar_emp">
                                                <i class="fas fa-save"></i> Grabar Información
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