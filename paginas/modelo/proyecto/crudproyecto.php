<?php
    class CRUDProyecto extends Conexion{
        public function ListarProyecto(){
            $arr_proy= null;
            
            $cn= $this-> Conectar();

            $sql = "call sp_listar_proyecto()";

            $snt = $cn->prepare($sql);
            
            $snt->execute();

            $arr_proy=$snt->fetchAll(PDO::FETCH_OBJ);

            $cn=null;

            return $arr_proy;
        }

        public function BuscarProyectoPorCodigo($cod_proy) {
            $arr_proy= null;

            $cn= $this-> Conectar();

            $sql = "call sp_buscar_proyecto_por_codigo(:cod_proy);";

            $snt = $cn->prepare($sql);
            
            $snt->bindParam(':cod_proy', $cod_proy, PDO::PARAM_STR,5);
            
            $snt->execute();

            $nr = $snt->rowCount();

            if($nr>0){
                $arr_proy=$snt->fetch(PDO::FETCH_OBJ);
            }
            
            $cn=null;
            
            return $arr_proy;
        }


        public function MostrarProyectoPorCodigo($cod_proy){
            $arr_proy= null;
            
            $cn= $this-> Conectar();
            
            $sql = "call sp_mostrar_proyecto_por_codigo(:cod_proy);";

            $snt = $cn->prepare($sql);
            
            $snt->bindParam(':cod_proy', $cod_proy, PDO::PARAM_STR,5);
            
            $snt->execute();

            $nr=$snt->rowCount();

            if($nr>0){
                $arr_proy=$snt->fetch(PDO::FETCH_OBJ);
            }
            
            $cn=null;
            
            return $arr_proy;
        }


        public function ConsultarProyectoPorCodigo($cod_proy){
            $arr_proy= null;
            
            $cn= $this->Conectar();
            
            $sql = "call sp_mostrar_proyecto_por_codigo(:cod_proy);";

            $snt = $cn->prepare($sql);
            
            $snt->bindParam(':cod_proy', $cod_proy, PDO::PARAM_STR,5);
            
            $snt->execute();

            $nr=$snt->rowCount();
            
            if($nr>0){
                $arr_proy=$snt->fetch(PDO::FETCH_OBJ);
            }
            
            $cn=null;

            echo json_encode($arr_proy);
        }


        public function FiltrarProyecto($valor){
            $arr_proy= null;
            
            $cn= $this-> Conectar();
            
            $sql = "call sp_filtrar_por_proyecto(:valor);";

            $snt = $cn->prepare($sql);
            
            $snt->bindParam(':valor', $valor, PDO::PARAM_STR,40);
            
            $snt->execute();

            $arr_proy=$snt->fetchAll(PDO::FETCH_OBJ);
            
            $nr = $snt->rowCount();

            if($nr>0){
                echo "<table class='table table-hover table-sm table-success table-striped'>";
                echo "<tr class='table-primary'>";
                echo "<th>N°</th>";
                echo "<th>Código</th>";
                echo "<th>Proyecto</th>";
                echo "<th>Descripción</th>";
                echo "<th>Fecha de inicio</th>";
                echo "<th>Fecha final</th>";
                echo "<th>Estado de proyecto</th>";
                echo "<th>Precio</th>";
                echo "<th>Cliente</th>";
                echo "</tr>";

                $i=0;
                foreach($arr_proy as $proy){
                    $i++;
                    echo "<tr>";
                    echo "<td>".$i."</td>";
                    echo "<td>".$proy->codigo_proyecto."</td>";
                    echo "<td>".$proy->proyecto."</td>";
                    echo "<td>".$proy->descripcion."</td>";
                    echo "<td>".$proy->fecha_inicio."</td>";
                    echo "<td>".$proy->fecha_fin."</td>";
                    echo "<td>".$proy->estado_proyecto."</td>";
                    echo "<td>S/.".$proy->precio."</td>";
                    echo "<td>".$proy->nombre_cliente."</td>";
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


        public function RegistrarProyecto(Proyecto $proyecto){
            try{
                $cn= $this-> Conectar();

                $sql = "call sp_registrar_proyecto(:cod_proy, :proy, :descr, :f_ini, :f_fin, :es_proy, :precio, :cod_cli);";

                $snt = $cn->prepare($sql);
                
                $snt->bindParam(':cod_proy', $proyecto->codigo_proyecto);
                $snt->bindParam(':proy', $proyecto->proyecto);
                $snt->bindParam(':descr', $proyecto->descripcion);
                $snt->bindParam(':f_ini', $proyecto->fecha_inicio);
                $snt->bindParam(':f_fin', $proyecto->fecha_fin);
                $snt->bindParam(':es_proy', $proyecto->estado_proyecto);
                $snt->bindParam(':precio', $proyecto->precio);
                $snt->bindParam(':cod_cli', $proyecto->proyecto_codigo_cliente);
                
                $snt->execute();

                $cn=null;

            }
            catch(PDOException $ex){
                die($ex->getMessage());
            }
        }
        public function EditarProyecto(Proyecto $proyecto){
            try{
                $cn= $this-> Conectar();

                $sql = "call sp_editar_proyecto(:cod_proy, :proy, :descr, :f_ini, :f_fin, :es_proy, :precio, :cod_cli);";

                $snt = $cn->prepare($sql);
                
                $snt->bindParam(':cod_proy', $proyecto->codigo_proyecto);
                $snt->bindParam(':proy', $proyecto->proyecto);
                $snt->bindParam(':descr', $proyecto->descripcion);
                $snt->bindParam(':f_ini', $proyecto->fecha_inicio);
                $snt->bindParam(':f_fin', $proyecto->fecha_fin);
                $snt->bindParam(':es_proy', $proyecto->estado_proyecto);
                $snt->bindParam(':precio', $proyecto->precio);
                $snt->bindParam(':cod_cli', $proyecto->proyecto_codigo_cliente);
                
                $snt->execute();

                $cn=null;

            }
            catch(PDOException $ex){
                die($ex->getMessage());
            }
        }
        public function BorrarProyecto($cod_proy){
            try{
                $cn= $this-> Conectar();
                
                $sql = "call sp_borrar_proyecto(:cod_proy);";

                $snt = $cn->prepare($sql);
                
                $snt->bindParam(':cod_proy', $cod_proy);
                
                $snt->execute();

                $cn=null;
            }
            catch(PDOException $ex){
                die($ex->getMessage());
            }

        }
    }