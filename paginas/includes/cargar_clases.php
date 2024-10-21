<?php
spl_autoload_register("CargarClases");

function CargarClases($clase){
    $ruta = __DIR__ . '/../modelo/'; // Ruta base
    $extension = ".php";

    $directorios = [
        $ruta . 'proyecto/',
        $ruta . 'cliente/',
        $ruta . 'asignacion/',
        $ruta . 'empleado/',
        $ruta . 'area/',
        $ruta
    ];

    foreach ($directorios as $directorio) {
        $ruta_completa = $directorio . $clase . $extension;
        if (file_exists($ruta_completa)) {
            include_once $ruta_completa;
            return;
        }
    }
}
?>
