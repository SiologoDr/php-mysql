<?php
    class CRUDCliente extends Conexion{
        public function ListarCliente(){
            $arr_cliente= null;
            
            $cn= $this->Conectar();

            $sql = "call sp_listar_cliente()";

            $snt = $cn->prepare($sql);
            
            $snt->execute();

            $arr_cliente=$snt->fetchAll(PDO::FETCH_OBJ);

            $cn=null;

            return $arr_cliente;
        }
        public function BuscarClientePorCodigo($cod_cli) {
            $arr_cli= null;

            $cn= $this-> Conectar();

            $sql = "call sp_buscar_cliente_por_codigo(:cod_cli);";

            $snt = $cn->prepare($sql);
            
            $snt->bindParam(':cod_cli', $cod_cli, PDO::PARAM_STR,5);
            
            $snt->execute();

            $nr = $snt->rowCount();

            if($nr>0){
                $arr_cli=$snt->fetch(PDO::FETCH_OBJ);
            }
            
            $cn=null;
            
            return $arr_cli;
        }


        public function MostrarClientePorCodigo($cod_cli){
            $arr_cli= null;
            
            $cn= $this-> Conectar();
            
            $sql = "call sp_mostrar_cliente_por_codigo(:cod_cli);";

            $snt = $cn->prepare($sql);
            
            $snt->bindParam(':cod_cli', $cod_cli, PDO::PARAM_STR,5);
            
            $snt->execute();

            $nr=$snt->rowCount();

            if($nr>0){
                $arr_cli=$snt->fetch(PDO::FETCH_OBJ);
            }
            
            $cn=null;
            
            return $arr_cli;
        }


        public function ConsultarClientePorCodigo($cod_cli){
            $arr_cli= null;
            
            $cn= $this-> Conectar();
            
            $sql = "call sp_mostrar_cliente_por_codigo(:cod_cli);";

            $snt = $cn->prepare($sql);
            
            $snt->bindParam(':cod_cli', $cod_cli, PDO::PARAM_STR,5);
            
            $snt->execute();

            $nr=$snt->rowCount();
            
            if($nr>0){
                $arr_cli=$snt->fetch(PDO::FETCH_OBJ);
            }
            
            $cn=null;

            echo json_encode($arr_cli);
        }


        public function FiltrarCliente($valor){
            $arr_cli= null;
            
            $cn= $this-> Conectar();
            
            $sql = "call sp_filtrar_por_cliente(:valor);";

            $snt = $cn->prepare($sql);
            
            $snt->bindParam(':valor', $valor, PDO::PARAM_STR,40);
            
            $snt->execute();

            $arr_cli=$snt->fetchAll(PDO::FETCH_OBJ);
            
            $nr = $snt->rowCount();

            if($nr>0){
                echo "<table class='table table-hover table-sm table-success table-striped'>";
                echo "<tr class='table-primary'>";
                echo "<th>N°</th>";
                echo "<th>Código</th>";
                echo "<th>Tipo</th>";
                echo "<th>Nombre</th>";
                echo "<th>Tipo de documento</th>";
                echo "<th>Nº de documento</th>";
                echo "<th>Teléfono</th>";
                echo "<th>E-mail</th>";
                echo "<th>Dirección</th>";
                echo "</tr>";

                $i=0;
                foreach($arr_cli as $cli){
                    $i++;
                    echo "<tr>";
                    echo "<td>".$i."</td>";
                    echo "<td>".$cli->codigo_cliente."</td>";
                    echo "<td>".$cli->tipo_cliente."</td>";
                    echo "<td>".$cli->nombre_cliente."</td>";
                    echo "<td>".$cli->tipo_documento."</td>";
                    echo "<td >".$cli->nro_documento."</td>";
                    echo "<td>".$cli->telefono."</td>";
                    echo "<td>".$cli->email."</td>";
                    echo "<td>".$cli->direccion."</td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
            else{
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>";
                echo "No hay registros.";
                echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
                echo "</div>";
            }
            $cn=null;
        }


        public function RegistrarCliente( Cliente $cliente){
            try{
                $cn= $this-> Conectar();

                $sql = "call sp_registrar_cliente(:cod_cli, :tipo_cli, :nombre, :tipo_doc, :nro_doc, :tlf, :email, :dir);";

                $snt = $cn->prepare($sql);
                
                $snt->bindParam(':cod_cli', $cliente->codigo_cliente);
                $snt->bindParam(':tipo_cli', $cliente->tipo_cliente);
                $snt->bindParam(':nombre', $cliente->nombre_cliente);
                $snt->bindParam(':tipo_doc', $cliente->tipo_documento);
                $snt->bindParam(':nro_doc', $cliente->nro_documento);
                $snt->bindParam(':tlf', $cliente->telefono);
                $snt->bindParam(':email', $cliente->email);
                $snt->bindParam(':dir', $cliente->direccion);
                
                $snt->execute();

                $cn=null;

            }
            catch(PDOException $ex){
                die($ex->getMessage());
            }
        }
        public function EditarCliente(Cliente $cliente){
            try{
                $cn= $this-> Conectar();

                $sql = "call sp_editar_cliente(:cod_cli, :tipo_cli, :nombre, :tipo_doc, :nro_doc, :tlf, :email, :dir);";

                $snt = $cn->prepare($sql);
                
                $snt->bindParam(':cod_cli', $cliente->codigo_cliente);
                $snt->bindParam(':tipo_cli', $cliente->tipo_cliente);
                $snt->bindParam(':nombre', $cliente->nombre_cliente);
                $snt->bindParam(':tipo_doc', $cliente->tipo_documento);
                $snt->bindParam(':nro_doc', $cliente->nro_documento);
                $snt->bindParam(':tlf', $cliente->telefono);
                $snt->bindParam(':email', $cliente->email);
                $snt->bindParam(':dir', $cliente->direccion);
                
                $snt->execute();

                $cn=null;

            }
            catch(PDOException $ex){
                die($ex->getMessage());
            }
        }
        public function BorrarCliente($cod_cli){
            try{
                $cn= $this-> Conectar();
                
                $sql = "call sp_borrar_cliente(:cod_cli);";

                $snt = $cn->prepare($sql);
                
                $snt->bindParam(':cod_cli', $cod_cli);
                
                $snt->execute();

                $cn=null;
            }
            catch(PDOException $ex){
                die($ex->getMessage());
            }

        }
    }