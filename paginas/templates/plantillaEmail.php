<?php
function generarPlantillaCorreo($nombreEmpleado, $apellido, $proyecto, $nombreCliente, $rol) {
    if (!$proyecto) {
        return "<p>No se encontraron detalles del proyecto.</p>";
    }

    return "
        <html>
        <head>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f4f4f4;
                    margin: 0;
                    padding: 20px;
                }
                .container {
                    background-color: #ffffff;
                    border-radius: 5px;
                    padding: 20px;
                    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                }
                h2 {
                    color: #333;
                }
                p {
                    color: #555;
                }
                .footer {
                    margin-top: 20px;
                    font-size: 12px;
                    color: #777;
                }
                .highlight {
                    background-color: #e7f1ff;
                    padding: 10px;
                    border-radius: 3px;
                }
                .footer a {
                    color: #e5e8e8;
                    text-decoration: none;
                }
            </style>
        </head>
        <body>
            <div class='container'>
                <h2>¡Hola, $nombreEmpleado $apellido!</h2>
                <p>Te informamos que has sido asignado al siguiente proyecto:</p>
                <div class='highlight'>
                    <p><strong>Rol:</strong> {$rol}</p>
                    <p><strong>Cliente:</strong> {$nombreCliente}</p>
                    <p><strong>Nombre del Proyecto:</strong> {$proyecto->proyecto}</p>
                    <p><strong>Descripción:</strong> {$proyecto->descripcion}</p>
                    <p><strong>Fecha de Inicio:</strong> " . date("d-m-Y", strtotime($proyecto->fecha_inicio)) . "</p>
                    <p><strong>Fecha de Fin:</strong> " . date("d-m-Y", strtotime($proyecto->fecha_fin)) . "</p>
                    <p>¡Éxito en tu nuevo rol!</p>
                    <p>Saludos,</p>
                    <p>El equipo de <strong>JHARDSYSTEX</strong></p>                
                </div>
            </div>
            <div class='footer'>
                <p>&copy; " . date("Y") . " JHARDSYSTEX. Todos los derechos reservados.</p>
            </div>
        </body>
        </html>
    ";
}
?>
