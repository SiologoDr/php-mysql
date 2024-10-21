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

            if (isset($_GET["codasi"])) {
                $codasi = $_GET["codasi"];

                $crudasignacion = new CRUDAsignacion();

                $rs_asi = $crudasignacion->MostrarAsignacionPorCodigo($codasi);

                if (empty($rs_asi)) {
                    header("location: listar_asignacion.php");
                }
            } else {
                header("location: listar_asignacion.php");
            }
        ?>
        <div class="flex-grow-1 p-4">
        <div class="container mt-3">
            <header>
                <h1 class="text-info">
                <i class="fa-solid fa-info fa-bounce"></i> Información de Asignacion
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
                    <div class="row justify-content-center mt-3">
                        <div class="card col-md-6">
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <h5 class="card-title">Código</h5>
                                        <p class="card-text"><?=$rs_asi->codigo_asignacion?></p>
                                    </div>
                                    <div class="col-md-8"></div>
                                    <div class="col-md-8">
                                        <h5 class="card-title">Fecha</h5>
                                        <p class="card-text"><?=$rs_asi->fecha_asignacion?></p>
                                    </div>
                                    <div class="col-md-8">
                                        <h5 class="card-title">Rol</h5>
                                        <p class="card-text"><?=$rs_asi->rol?></p>
                                    </div>
                                    <div class="col-md-8">
                                        <h5 class="card-title">Proyecto</h5>
                                        <p class="card-text"><?=$rs_asi->proyecto?></p>
                                    </div>
                                    <div class="col-md-8">
                                        <h5 class="card-title">Empleado</h5>
                                        <p class="card-text"><?=$rs_asi->nombre_empleado?></p>
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
