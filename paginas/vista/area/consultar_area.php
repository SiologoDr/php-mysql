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
    $titulo = "Aplicación de ventas - Consultar Área";
    include ("../../includes/cabecera.php");
    ?>
    <body>
    <div class="container-fluid d-flex">
        <?php 
        include "../../includes/menu.php";
        ?>
        <div class="flex-grow-1 p-4">
        <div class="container mt-3">
            <header>
                <h1><i class="fas fa-search"></i> Consultar Área</h1>
                <hr/>
            </header>
            <nav>
                <a href="listar_area.php" class="btn btn-outline-secondary btn-sm">
                    <i class="fas fa-arrow-circle-left"></i> Regresar
                </a>
            </nav>
            <section>
                <article>
                    <div class="row justify-content-center mt-3">
                        <div class="card col-md-5">
                            <div class="card-body">
                                <form id="frm_consultar_area" name="frm_consultar_area" method="post">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fas fa-search"></i>
                                        </span>
                                        <input type="text" class="form-control" id="txt_codarea"
                                        name="txt_codarea" maxlength="40" placeholder="Código..."
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

            <div id="dataModal" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Detalles del Área</h5>
                        </div>
                        <div class="modal-body">
                            <p>Código de Área: <span class="modal-codarea"></span></p>
                            <p>Área: <span class="modal-area"></span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
    </body>
</html>
