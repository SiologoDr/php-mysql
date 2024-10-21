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
    $titulo = "Editar Área";
    include "../../includes/cabecera.php";
    ?>
    <body>
    <div class="container-fluid d-flex">
        <?php
        include "../../includes/menu.php";
        include "../../includes/cargar_clases.php";
        if(isset($_GET["codarea"])){
            $codarea = $_GET["codarea"];
            $crudarea = new CRUDArea();
            $rs_area = $crudarea->BuscarAreaPorCodigo($codarea);
            if(empty($rs_area)){
                header("location: listar_area.php");
            }
        } else {
            header("location: listar_area.php");
        }
        ?>
        <div class="flex-grow-1 p-4">
        <div class="container mt-3">
            <header>
                <h1 class="text-primary">
                    <i class="fas fa-edit"></i> Editar Área
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
                                    <form id="frm_editar_area" name="frm_editar_area" method="post" action="../../controlador/area/ctr_grabar_area.php" autocomplete="off">
                                        <input type="hidden" id="txt_tipo" name="txt_tipo" value="e" />

                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <label for="txt_codarea" class="form-label">Código</label>
                                                <input type="text" class="form-control" id="txt_codarea" name="txt_codarea" placeholder="Código" maxlength="5" readonly value="<?=$rs_area->codigo_area?>" />
                                            </div>

                                            <div class="col-md-8">
                                                <label for="txt_area" class="form-label">Nombre del Área</label>
                                                <input type="text" class="form-control" id="txt_area" name="txt_area" placeholder="Nombre del área" maxlength="50" value="<?=$rs_area->area?>" />
                                            </div>
                                        </div>

                                        <div class="text-center mt-3">
                                            <button type="submit" class="btn btn-outline-primary" id="btn_registrar_area" name="btn_registrar_area">
                                            <i class="fa-solid fa-floppy-disk fa-bounce"></i> Actualizar Área
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
