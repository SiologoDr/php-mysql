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
        $titulo = "Aplicación de Ventas - Información del Cliente";
        include "../../includes/cabecera.php";
    ?>
    <body>
    <div class="container-fluid d-flex">
        <?php
            include "../../includes/menu.php";
            include "../../includes/cargar_clases.php";

            if (isset($_GET["codclient"])) {
                $codclient = $_GET["codclient"];

                $crudcliente = new CRUDCliente();

                $rs_client = $crudcliente->MostrarClientePorCodigo($codclient);

                if (empty($rs_client)) {
                    header("location: listar_cliente.php");
                }
            } else {
                header("location: listar_cliente.php");
            }
        ?>
        <div class="flex-grow-1 p-4">
        <div class="container mt-3">
            <header>
                <h1 class="text-info">
                <i class="fa-solid fa-info fa-bounce"></i> Información del Cliente
                </h1>
                <hr/>
            </header>

            <nav>
                <a href="listar_cliente.php" class="btn btn-outline-secondary btn-sm">
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
                                        <p class="card-text"><?=$rs_client->codigo_cliente?></p>
                                    </div>
                                    <div class="col-md-8"></div>
                                    <div class="col-md-8">
                                        <h5 class="card-title">Cliente</h5>
                                        <p class="card-text"><?=$rs_client->nombre_cliente?></p>
                                    </div>
                                    <div class="col-md-8"></div>
                                    <div class="col-md-8">
                                        <h5 class="card-title">Tipo Cliente</h5>
                                        <p class="card-text"><?=$rs_client->tipo_cliente?></p>
                                    </div>
                                    <div class="col-md-8"></div>
                                    <div class="col-md-8">
                                        <h5 class="card-title">Tipo Documento</h5>
                                        <p class="card-text"><?=$rs_client->tipo_documento?></p>
                                    </div>
                                    <div class="col-md-8"></div>
                                    <div class="col-md-8">
                                        <h5 class="card-title">Nro Documento</h5>
                                        <p class="card-text"><?=$rs_client->nro_documento?></p>
                                    </div>
                                    <div class="col-md-8"></div>
                                    <div class="col-md-8">
                                        <h5 class="card-title">Telefono</h5>
                                        <p class="card-text"><?=$rs_client->telefono?></p>
                                    </div>
                                    <div class="col-md-8"></div>
                                    <div class="col-md-8">
                                        <h5 class="card-title">E-mail</h5>
                                        <p class="card-text"><?=$rs_client->email?></p>
                                    </div>
                                    <div class="col-md-8"></div>
                                    <div class="col-md-8">
                                        <h5 class="card-title">Direccion</h5>
                                        <p class="card-text"><?=$rs_client->direccion?></p>
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
