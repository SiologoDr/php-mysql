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
    $titulo = "Aplicacion de ventas - Consultar empleado";
    include ("../../includes/cabecera.php");
    ?>
    <body>
    <div class="container-fluid d-flex">
        <?php
        include("../../includes/menu.php");
        ?>
        <div class="flex-grow-1 p-4">
        <div class="container mt-3">
            <header>
                <h1><i class="fas fa-search"></i>Consultar empleado</h1>
                <hr/>
            </header>
            <nav>
                <a href="listar_empleado.php" class="btn btn-outline-secondary btn-sm">
                    <i class="fas fa-arrow-circle-left"></i> Regresar
                </a>
            </nav>
            <section>
                <article>
                    <div class="row justify-content-center mt-3">
                        <div class="card col-md-6">
                            <div class="card-body">
                                <form id="frm_consultar_emp" name="frm_consultar_emp" method="post">
                                <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fas fa-search"></i>
                                        </span>
                                        <input type="text" class="form-control" id="txt_codemp"
                                        name="txt_codemp" maxlength="40" placeholder="Código..."
                                        autofocus />
                                        <button class="btn btn-outline-primary" type="button" id="btn_buscar" name="btn_buscar">
                                            Buscar
                                        </button>
                                    </div>
                                </form>  
                            </div>
                        </div>
                    </div>
                </article>
            </section>
           
            <!-- Modal -->
            <div id="dataModal" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Detalles del Empleado</h5>
                        </div>
                        <div class="modal-body">
                            <p>Nombre: <span class="modal-nombre"></span></p>
                            <p>Apellido Materno: <span class="modal-apellido_mat"></span></p>
                            <p>Apellido Paterno:<span class="modal-apellido_pat"></span></p>
                            <p>Tipo de Documento: <span class="modal-tipo_doc"></span></p>
                            <p>Número de Documento: <span class="modal-nro_doc"></span></p>
                            <p>Teléfono: <span class="modal-telefono"></span></p>
                            <p>Email: <span class="modal-email"></span></p>
                            <p>Dirección: <span class="modal-direccion"></span></p>
                            <p>Sueldo: <span class="modal-sueldo"></span></p>
                            <p>Estado Sueldo: <span class="modal-estado_sueldo"></span></p>
                            <p>Fecha de Contratación: <span class="modal-fecha_contratacion"></span></p>
                            <p>Puesto: <span class="modal-fecha_contratacion"></span></p>
                            <p>Area: <span class="modal-area"></span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
    </body>  
</html>
