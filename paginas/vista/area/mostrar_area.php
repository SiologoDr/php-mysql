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
        $titulo = "Aplicación de Ventas - Información del Área";
        include "../../includes/cabecera.php";
    ?>
    <body>
    <div class="container-fluid d-flex">
        <?php
            include "../../includes/menu.php";
            include "../../includes/cargar_clases.php";

            if (isset($_GET["codarea"])) {
                $codarea = $_GET["codarea"];

                $crudarea = new CRUDArea();

                $rs_area = $crudarea->MostrarAreaPorCodigo($codarea);

                if (empty($rs_area)) {
                    header("location: listar_area.php");
                }
            } else {
                header("location: listar_area.php");
            }
        ?>
        <div class="flex-grow-1 p-4">
        <div class="container mt-3">
            <header>
                <h1 class="text-info">
                <i class="fa-solid fa-info fa-bounce"></i> Información del Área
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
                    <div class="row justify-content-center mt-3">
                        <div class="card col-md-6">
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <h5 class="card-title">Código</h5>
                                        <p class="card-text"><?=$rs_area->codigo_area?></p>
                                    </div>
                                    <div class="col-md-8"></div>
                                    <div class="col-md-8">
                                        <h5 class="card-title">Nombre del Área</h5>
                                        <p class="card-text"><?=$rs_area->area?></p>
                                    </div>
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
