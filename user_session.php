<?php

    class UsuarioSession{
        public function __construct(){
            session_start();
        }

        public function setCurrentUsuario($usuario){
            $_SESSION['usuario'] = $usuario;
        }

        public function getCurrentUsuario(){
            return $_SESSION['usuario'];
        }

        public function closeSession(){
            session_unset();
            session_destroy();
        }
    }