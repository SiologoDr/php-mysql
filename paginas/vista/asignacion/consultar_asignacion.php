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
    $titulo = "Aplicación de ventas - Consultar Asignación";
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
                <h1><i class="fas fa-search"></i> Consultar Asignación</h1>
                <hr/>
            </header>
            <nav>
                <a href="listar_asignacion.php" class="btn btn-outline-secondary btn-sm">
                    <i class="fas fa-arrow-circle-left"></i> Regresar
                </a>
            </nav>
            <section>
                <article>
                    <div class="row justify-content-center mt-3">
                        <div class="card col-md-5">
                            <div class="card-body">
                                <form id="frm_consultar_asi" name="frm_consultar_asi" method="post">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fas fa-search"></i>
                                        </span>
                                        <input type="text" class="form-control" id="txt_codasi"
                                        name="txt_codasi" maxlength="40" placeholder="Código..."
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
                            <h5 class="modal-title">Detalles del Asignación</h5>
                        </div>
                        <div class="modal-body">
                            <p>Código de asignación: <span class="modal-codasi"></span></p>
                            <p>Fecha de asignación: <span class="modal-f_asi"></span></p>
                            <p>Proyecto: <span class="modal-proy"></span></p>
                            <p>Empleado: <span class="modal-nombre_emp"></span></p>
                            <p>Rol: <span class="modal-rol"></span></p>
                            <p>Cliente: <span class="modal-cliente"></span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
    </body>
</html>
