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
$titulo = "Aplicación de Ventas - Lista de Áreas";
include("../../includes/cabecera.php");
include "../../includes/cargar_clases.php";

$crudarea = new CRUDArea();
$rs_area = $crudarea->ListarArea();
?>
<body>
    <div class="container-fluid d-flex">
        <?php 
        include "../../includes/menu.php";
        ?>
        <div class="flex-grow-1 p-4">
            <div class="container mt-3">
                <header>
                    <h1>
                    <i class="fa-solid fa-rectangle-list fa-shake"></i> Lista de Áreas
                    </h1>
                    <hr/>
                </header>
            </div>
            <nav class="d-flex justify-content-center">
                <div class="btn-group col-md-5" role="group">
                    <a href="registrar_area.php" class="btn btn-primary">
                        <i class="fas fa-plus-circle"></i> Registrar
                    </a>
                    <a href="consultar_area.php" class="btn btn-primary">
                        <i class="fas fa-search"></i> Consultar
                    </a>
                    <a href="filtrar_area.php" class="btn btn-primary">
                        <i class="fas fa-filter"></i> Filtrar
                    </a>
                </div>   
            </nav>
            <section>
                <article>
                    <div class="row justify-content-center mt-3">
                        <div class="col-md-10">
                            <div class="table-responsive">
                                <table id="tablaAreas" class="table table-striped table-hover text-center">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>N°</th>
                                            <th>Código</th>
                                            <th>Nombre del Área</th>
                                            <th colspan="3">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tablaBody">
                                        <?php
                                        $i = 0;
                                        foreach ($rs_area as $area) {
                                            $i++;
                                        ?>
                                        <tr class="reg_area">
                                            <td><?= $i ?></td>
                                            <td class="codarea"><?= $area->codigo_area ?></td>
                                            <td class="area"><?= $area->area ?></td>
                                            <td><a href="#" class="btn_mostrar btn btn-outline-info"><i class="fas fa-exclamation"></i></a></td>
                                            <td><a href="#" class="btn_editar btn btn-outline-warning"><i class="fas fa-edit"></i></a></td>
                                            <td><a href="#" class="btn_borrar btn btn-outline-danger"><i class="fas fa-trash-alt"></i></a></td>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </article>
            </section>
            <!-- Modal para borrar área -->
            <div class="modal fade" id="md_borrar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title text-danger" id="staticBackdropLabel"><i class="fa-solid fa-trash-can fa-bounce"></i> Borrar Área</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row justify-content-center">
                                <h5 class="card-title">¿Seguro de borrar el registro?</h5>
                                <p class="card-text">
                                    <span class="lbl_area"></span> (<span class="lbl_codarea"></span>)
                                </p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <a href="#" class="btn_borrar btn btn-danger">Borrar</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Botones de paginación -->
            <nav id="paginacion" class="d-flex justify-content-center mt-3"></nav>
        </div>
    </div>
    <script>
        // Configuración de la paginación
        const filasPorPagina = 10;
        let tabla = document.getElementById('tablaBody');
        let filas = tabla.getElementsByTagName('tr');
        let totalFilas = filas.length;
        let totalPaginas = Math.ceil(totalFilas / filasPorPagina);
        let paginaActual = 1;

        // Función para mostrar solo las filas de la página actual
        function mostrarPagina(pagina) {
            let inicio = (pagina - 1) * filasPorPagina;
            let fin = inicio + filasPorPagina;

            for (let i = 0; i < totalFilas; i++) {
                filas[i].style.display = (i >= inicio && i < fin) ? '' : 'none';
            }
        }

        // Función para crear los botones de paginación
        function crearBotonesPaginacion() {
            let paginacion = document.getElementById('paginacion');
            paginacion.innerHTML = '';

            for (let i = 1; i <= totalPaginas; i++) {
                let boton = document.createElement('button');
                boton.innerText = i;
                boton.className = 'btn btn-primary m-1';
                boton.onclick = function() {
                    paginaActual = i;
                    mostrarPagina(paginaActual);
                };
                paginacion.appendChild(boton);
            }
        }

        // Inicializar la tabla mostrando la primera página y los botones de paginación
        document.addEventListener('DOMContentLoaded', function() {
            mostrarPagina(paginaActual);
            crearBotonesPaginacion();
        });
    </script>
</body>
</html>
