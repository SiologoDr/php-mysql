<?php
    include_once 'user_session.php';

    $usuarioSession = new UsuarioSession();
    $usuarioSession->closeSession();

    header("location: ./index.php");