<?php

include_once 'user.php';
include_once 'user_session.php';

$usuarioSession = new UsuarioSession();
$usuario = new Usuario();

if (isset($_SESSION['usuario'])){
    $usuario->setUsuario($usuarioSession->getCurrentUsuario());
} else if (isset($_POST['usuario']) && isset($_POST['pass'])) {
    $usuarioInput = $_POST['usuario'];
    $passInput = $_POST['pass'];
    
    if ($usuario->usuarioExists($usuarioInput, $passInput)) {
        $usuario->setUsuario($usuarioInput);
        $usuarioSession->setCurrentUsuario($usuarioInput);
        header("location: ./index.php");
        exit();
    } else {
        $errorLogin = "Usuario o Contraseña incorrectos";
        header("location: ./login.php");
    }
} else {
    echo "login";
    header("location: ./login.php");
}
?>

<!DOCTYPE html>
<html lang="es">
    <?php
    $ruta = ".";
    $titulo = "Jhardsystex";
    include "paginas/includes/cabecera.php";
    ?>
    <head>
        <link rel="stylesheet" href="css/bootstrap/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container-fluid d-flex">
        <?php 
        include "paginas/includes/menu.php";
        ?>
        <div class="flex-grow-1 p-4">
    <header>
        <h1><?=$titulo?></h1>
        <hr/>
    </header>
            <section>
                <article class="d-flex align-items-center justify-content-center" style="height: 80vh;">
                    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel" style="max-width: 75%; margin: 0 auto;">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="2" aria-label="Slide 3"></button>
                            <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="3" aria-label="Slide 4"></button>
                            <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="4" aria-label="Slide 5"></button>
                        </div>

                        <div class="carousel-inner">
                            <div class="carousel-item active"> 
                                <img src="https://i.ibb.co/3vr7nrD/asignacion.jpg" class="d-block w-100" style="height: 450px; object-fit: cover;" alt="Imagen 1">
                                <div class="carousel-caption py-1 px-2 my-4 d-inline-block" style="background-color: rgba(0, 0, 0, 0.75); border-radius: 1rem; max-width: fit-content; left: 50%; transform: translateX(-50%);">
                                    <h5 style="color: white; margin: 0;">Gestión de Asignaciones</h5>
                                </div>
                            </div>


                            <div class="carousel-item">
                                <img src="https://i.ibb.co/k3pKx4Z/empleados.jpg" class="d-block w-100" style="height: 450px; object-fit: cover; align-content: center;" alt="Imagen 2">
                                <div class="carousel-caption py-1 px-2 my-4 d-inline-block" style="background-color: rgba(0, 0, 0, 0.75); border-radius: 1rem; max-width: fit-content; left: 50%; transform: translateX(-50%);">
                                    <h5 style="color: white; margin: 0;">Gestión de Empleados</h5>
                                </div>
                            </div>

                            <div class="carousel-item">
                                <img src="https://i.ibb.co/Gt7kySv/areas.jpg" class="d-block w-100" style="height: 450px; object-fit: cover;" alt="Imagen 3">
                                <div class="carousel-caption py-1 px-2 my-4 d-inline-block" style="background-color: rgba(0, 0, 0, 0.75); border-radius: 1rem; max-width: fit-content; left: 50%; transform: translateX(-50%);">
                                    <h5 style="color: white; margin: 0;">Gestión de Áreas</h5>
                                </div>
                            </div>

                            <div class="carousel-item">
                                <img src="https://i.ibb.co/BCgF747/proyectos.png" class="d-block w-100" style="height: 450px; object-fit: cover;" alt="Imagen 4">
                                <div class="carousel-caption py-1 px-2 my-4 d-inline-block" style="background-color: rgba(0, 0, 0, 0.75); border-radius: 1rem; max-width: fit-content; left: 50%; transform: translateX(-50%);">
                                    <h5 style="color: white; margin: 0;">Gestión de Proyectos</h5>
                                </div>
                            </div>

                            <div class="carousel-item">
                                <img src="https://i.ibb.co/tZ4VT3p/clientes.jpg" class="d-block w-100" style="height: 450px; object-fit: cover;" alt="Imagen 5">
                                <div class="carousel-caption py-1 px-2 my-4 d-inline-block" style="background-color: rgba(0, 0, 0, 0.75); border-radius: 1rem; max-width: fit-content; left: 50%; transform: translateX(-50%);">
                                    <h5 style="color: white; margin: 0;">Gestión de Clientes</h5>
                                </div>
                            </div>

                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Anterior</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Siguiente</span>
                        </button>
                    </div>
                </article>
            </section>
            </div>
        </div>
        <script src="css/bootstrap/js/bootstrap.bundle.min.js"></script>
    </body>
</html>