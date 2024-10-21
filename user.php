<?php
    require_once('./paginas/modelo/conexion.php');

    class Usuario extends Conexion{
        private $usuario;
        
        public function usuarioExists($usuario, $pass){
            $md5pass = md5($pass);
            $query = $this->Conectar()->prepare('select * from tb_login where usuario = :usuario and pass = :pass');
            $query->execute(['usuario' => $usuario, 'pass' => $md5pass]);

            if ($query->rowCount()){
                return true;
            } else {
                return false;
            }
        }

        public function setUsuario($usuario){
            $query = $this->Conectar()->prepare('select * from tb_login where usuario = :usuario');
            $query->execute(['usuario' => $usuario]);

            foreach ($query as $currentUsuario) {
                $this->usuario = $currentUsuario['usuario'];
            }
        }

        public function getUsuario(){
            return $this->usuario;
        }
    }
        