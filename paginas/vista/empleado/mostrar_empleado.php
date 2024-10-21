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
        $titulo = "Aplicación de Ventas - Información del Empleado";
        include "../../includes/cabecera.php";
    ?>
    <body>
    <div class="container-fluid d-flex">
        <?php
            include "../../includes/menu.php";
            include "../../includes/cargar_clases.php";

            if (isset($_GET["codemp"])) {
                $codemp = $_GET["codemp"];

                $crudempleado = new CRUDEmpleado();

                $rs_emp = $crudempleado->MostrarEmpleadoPorCodigo($codemp);

                if (empty($rs_emp)) {
                    header("location: listar_empleado.php");
                }
            } else {
                header("location: listar_empleado.php");
            }
        ?>
        <div class="flex-grow-1 p-4">
        <div class="container mt-3">
            <header>
                <h1 class="text-info">
                <i class="fa-solid fa-info fa-bounce"></i> Información del Empleado
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
                    <div class="row justify-content-center mt-3">
                        <div class="card col-md-6">
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <h5 class="card-title">Código</h5>
                                        <p class="card-text"><?=$rs_emp->codigo_empleado?></p>
                                    </div>
                                    <div class="col-md-8"></div>
                                    <div class="col-md-8">
                                        <h5 class="card-title">Nombre Completo</h5>
                                        <p class="card-text"><?=$rs_emp->nombre_empleado?> <?=$rs_emp->apellido_paterno?> <?=$rs_emp->apellido_materno?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="card-title">Teléfono</h5>
                                        <p class="card-text"><?=$rs_emp->telefono?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="card-title">Email</h5>
                                        <p class="card-text"><?=$rs_emp->email?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="card-title">Puesto</h5>
                                        <p class="card-text"><?=$rs_emp->puesto?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="card-title">Área</h5>
                                        <p class="card-text"><?=$rs_emp->area?></p>
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
