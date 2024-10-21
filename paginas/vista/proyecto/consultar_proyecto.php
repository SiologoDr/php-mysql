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
$titulo = "Aplicacion de ventas - Consultar proyecto";
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
            <h1><i class="fas fa-search"></i>Consultar proyecto</h1>
            <hr />
        </header>

        <nav>
            <a href="listar_proyecto.php" class="btn btn-outline-secondary btn-sm">
                <i class="fas fa-arrow-circle-left"></i> Regresar
            </a>
        </nav>

        <section>
                <article>
                    <div class="row justify-content-center mt-3">
                        <div class="card col-md-5">
                            <div class="card-body">
                                <form id="frm_consultar_proy" name="frm_consultar_proy" method="post">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fas fa-search"></i>
                                        </span>
                                        <input type="text" class="form-control" id="txt_codproy"
                                        name="txt_codproy" maxlength="40" placeholder="Código..."
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
                            <h5 class="modal-title">Detalles del Proyecto</h5>
                        </div>
                        <div class="modal-body">
                            <p>Código de Proyecto: <span class="modal-codproy"></span></p>
                            <p>Proyecto: <span class="modal-proyecto"></span></p>
                            <p>Descripcion: <span class="modal-descripcion"></span></p>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </div>
</div>
</body>
</html>