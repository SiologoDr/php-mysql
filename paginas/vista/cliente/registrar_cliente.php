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
        $titulo = "Aplicación de Ventas - Registrar Cliente";
        include "../../includes/cabecera.php";
    ?>
    <body>
    <div class="container-fluid d-flex">
        <?php
            include "../../includes/menu.php";
            include "../../includes/cargar_clases.php";

            // Crear una instancia de CRUDCliente
            $crudcliente = new CRUDCliente();
            
            // Obtener la lista de clientes
            $rs_client = $crudcliente->ListarCliente(); 
        ?>
        <div class="flex-grow-1 p-4">
        <div class="container mt-3">
            <header>
                <h1 class="text-primary">
                    <i class="fas fa-plus-circle"></i> Registrar Cliente
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
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <!-- Inicio del Formulario -->
                                    <form id="frm_registrar_client" name="frm_registrar_client" method="post" action="../../controlador/cliente/ctr_grabar_cli.php" autocomplete="off">
                                        <input type="hidden" id="txt_tipo" name="txt_tipo" value="r" />

                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <label for="txt_codcli" class="form-label">Código</label>
                                                <input type="text" class="form-control" id="txt_codcli" name="txt_codcli" placeholder="Código" maxlength="5" autofocus />
                                            </div>

                                            <div class="col-md-6">
                                                <label for="cbo_tipo_cli" class="form-label">Tipo Cliente</label>
                                                <select class="form-select form-select-lg mb-3" id="cbo_tipo_cli" name="cbo_tipo_cli" required>
                                                    <option value="" selected>[Seleccione Tipo Cliente]</option>
                                                    <option value="EMPRESA">EMPRESA</option>
                                                    <option value="ORGANIZACION">ORGANIZACION</option>
                                                    <option value="PERSONA">PERSONA</option>
                                                </select>
                                            </div>
                                            
                                            <div class="col-md-8">
                                                <label for="txt_nombre" class="form-label">Nombre</label>
                                                <input type="text" class="form-control" id="txt_nombre" name="txt_nombre" placeholder="Nombre del cliente" maxlength="40" />
                                            </div>

                                            <div class="col-md-6">
                                                <label for="cbo_tipo_doc" class="form-label">Tipo Documento</label>
                                                <select class="form-select form-select-lg mb-3" id="cbo_tipo_doc" name="cbo_tipo_doc" required>
                                                    <option value="" selected>[Seleccione Tipo Documento]</option>
                                                    <option value="RUC">RUC</option>
                                                    <option value="CARNET DE EXTRANJERIA">CARNET DE EXTRANJERIA</option>
                                                    <option value="DNI">DNI</option>
                                                </select>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="txt_nro_doc" class="form-label">Número Documento</label>
                                                <input type="text" class="form-control" id="txt_nro_doc" name="txt_nro_doc" placeholder="Número Documento" maxlength="20" required />
                                            </div>

                                            <div class="col-md-4">
                                                <label for="txt_tlf" class="form-label">Teléfono</label>
                                                <input type="text" class="form-control" id="txt_tlf" name="txt_tlf" placeholder="Teléfono" maxlength="9" required />
                                            </div>

                                            <div class="col-md-4">
                                                <label for="txt_email" class="form-label">E-mail</label>
                                                <input type="email" class="form-control" id="txt_email" name="txt_email" placeholder="E-mail" maxlength="100" required />
                                            </div>
                                        
                                            <div class="col-md-4">
                                                <label for="txt_dir" class="form-label">Dirección</label>
                                                <input type="text" class="form-control" id="txt_dir" name="txt_dir" placeholder="Dirección" maxlength="100" required />
                                            </div>
                                            
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-outline-primary" id="btn_registrar_cli" name="btn_registrar_cli">
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
