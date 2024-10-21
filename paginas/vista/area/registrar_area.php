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
        $titulo = "Aplicación de Ventas - Registrar Área";
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
                    <i class="fas fa-plus-circle"></i> Registrar Área
                </h1>
                <hr/>
            </header>
            <nav>
                <a href="listar_area.php" class="btn btn-outline-secondary btn-sm">
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
                                    <form id="frm_registrar_area" name="frm_registrar_area" method="post" action="../../controlador/area/ctr_grabar_area.php" autocomplete="off">
                                        <input type="hidden" id="txt_tipo" name="txt_tipo" value="r" />
                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <label for="txt_codarea" class="form-label">Código</label>
                                                <input type="text" class="form-control" id="txt_codarea" name="txt_codarea" placeholder="Código de área" maxlength="5" autofocus />
                                            </div>
                                            <div class="col-md-8">
                                                <label for="txt_area" class="form-label">Nombre del Área</label>
                                                <input type="text" class="form-control" id="txt_area" name="txt_area" placeholder="Nombre del área" maxlength="50" />
                                            </div>
                                        </div>
                                        <div class="text-center mt-4">
                                            <button type="submit" class="btn btn-outline-primary" id="btn_registrar_area" name="btn_registrar_area">
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
