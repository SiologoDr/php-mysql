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
    $titulo = "Aplicacion de ventas - Filtrar Cliente";
    include("../../includes/cabecera.php");
    ?>
    <body>
    <div class="container-fluid d-flex">
        <?php
        include("../../includes/menu.php");
        ?>
        <div class="flex-grow-1 p-4">
        <div class="container mt-3">
            <header>
                <h1><i class="fas fa-filter"></i>Filtrar Cliente</h1>
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
                        <div class="card col-md-5">
                                <form id="frm_filtrar_client" name="frm_filtrar_client" method="post">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fas fa-search"></i>
                                        </span>
                                        <input type="text" class="form-control" id="txt_valor"
                                        name="txt_valor" maxlength="40" placeholder="Valor a buscar.."
                                        autofocus />
                                        <button class="btn btn-outline-success" type="button"
                                        id="btn_filtrar" name="btn_filtrar">Filtrar</button>
                                        <a class="btn btn-outline-primary" href="filtrar_cliente.php">Nuevo</a>
                                    </div>
                                </form>
                                </div>
                            </div>
                </article>
            </section>
            <section class="mt-3">
                <div id="tabla"></div>
            </section>
        </div>
        </div>
    </div>
    </body>

</html>