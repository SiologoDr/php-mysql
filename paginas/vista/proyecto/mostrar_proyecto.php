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
        $titulo = "Aplicación de Ventas - Información del Producto";
        include "../../includes/cabecera.php";
    ?>
    <body>
    <div class="container-fluid d-flex">
        <?php
            include "../../includes/menu.php";
            include "../../includes/cargar_clases.php";

            if (isset($_GET["codproy"])) {
                $codproy = $_GET["codproy"];

                $crudproyecto = new CRUDProyecto();

                $rs_proy = $crudproyecto->MostrarProyectoPorCodigo($codproy);

                if (empty($rs_proy)) {
                    header("location: listar_proyecto.php");
                }
            } else {
                header("location: listar_proyecto.php");
            }
        ?>
        <div class="flex-grow-1 p-4">
        <div class="container mt-3">
            <header>
                <h1 class="text-info">
                <i class="fa-solid fa-info fa-bounce"></i> Información del Proyecto
                </h1>
                <hr/>
            </header>

            <nav>
                <a href="listar_proyecto.php" class="btn btn-outline-secondary btn-sm">
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
                                        <p class="card-text"><?=$rs_proy->codigo_proyecto?></p>
                                    </div>
                                    <div class="col-md-8"></div>
                                    <div class="col-md-8">
                                        <h5 class="card-title">Proyecto</h5>
                                        <p class="card-text"><?=$rs_proy->proyecto?></p>
                                    </div>
                                    <div class="col-md-8"></div>
                                    <div class="col-md-8">
                                        <h5 class="card-title">Descripcion</h5>
                                        <p class="card-text"><?=$rs_proy->descripcion?></p>
                                    </div>
                                    <div class="col-md-8"></div>
                                    <div class="col-md-8">
                                        <h5 class="card-title">Fecha Inicio</h5>
                                        <p class="card-text"><?=$rs_proy->fecha_inicio?></p>
                                    </div>
                                    <div class="col-md-8"></div>
                                    <div class="col-md-8">
                                        <h5 class="card-title">Fecha Final</h5>
                                        <p class="card-text"><?=$rs_proy->fecha_fin?></p>
                                    </div>
                                    <div class="col-md-8"></div>
                                    <div class="col-md-8">
                                        <h5 class="card-title">Estado Proyecto</h5>
                                        <p class="card-text"><?=$rs_proy->estado_proyecto?></p>
                                    </div>
                                    <div class="col-md-8"></div>
                                    <div class="col-md-8">
                                        <h5 class="card-title">Precio</h5>
                                        <p class="card-text"><?=$rs_proy->precio?></p>
                                    </div>
                                    <div class="col-md-8"></div>
                                    <div class="col-md-8">
                                        <h5 class="card-title">Tipo Cliente</h5>
                                        <p class="card-text"><?=$rs_proy->tipo_cliente?></p>
                                    </div>
                                    <div class="col-md-8"></div>
                                    <div class="col-md-8">
                                        <h5 class="card-title">Cliente</h5>
                                        <p class="card-text"><?=$rs_proy->nombre_cliente?></p>
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
