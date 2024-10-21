<?php
    class CRUDAsignacion extends Conexion{
        public function ListarAsignacion(){
            $arr_asignacion= null;

            $cn= $this->Conectar();

            $sql = "call sp_listar_asignacion()";

            $snt = $cn->prepare($sql);
            
            $snt->execute();

            $arr_asignacion=$snt->fetchAll(PDO::FETCH_OBJ);

            $cn=null;

            return $arr_asignacion;
        }

        public function BuscarAsignacionPorCodigo($cod_asi) {
            $arr_asi= null;

            $cn= $this-> Conectar();

            $sql = "call sp_buscar_asignacion_por_codigo(:cod_asi);";

            $snt = $cn->prepare($sql);
            
            $snt->bindParam(':cod_asi', $cod_asi, PDO::PARAM_STR,5);
            
            $snt->execute();

            $nr = $snt->rowCount();

            if($nr>0){
                $arr_asi=$snt->fetch(PDO::FETCH_OBJ);
            }

            $cn=null;

            return $arr_asi;
        }

        public function MostrarAsignacionPorCodigo($cod_asi){
            $arr_asi= null;

            $cn= $this-> Conectar();
            
            $sql = "call sp_mostrar_asignacion_por_codigo(:cod_asi);";

            $snt = $cn->prepare($sql);

            $snt->bindParam(':cod_asi', $cod_asi, PDO::PARAM_STR,5);

            $snt->execute();

            $nr=$snt->rowCount();

            if($nr>0){
                $arr_asi=$snt->fetch(PDO::FETCH_OBJ);
            }

            $cn=null;

            return $arr_asi;
        }


        public function ConsultarAsignacionPorCodigo($cod_asi){
            $arr_asi= null;
            
            $cn= $this-> Conectar();
            
            $sql = "call sp_mostrar_asignacion_por_codigo(:cod_asi);";

            $snt = $cn->prepare($sql);
            
            $snt->bindParam(':cod_asi', $cod_asi, PDO::PARAM_STR,5);
            
            $snt->execute();

            $nr=$snt->rowCount();
            
            if($nr>0){
                $arr_asi=$snt->fetch(PDO::FETCH_OBJ);
            }
            
            $cn=null;

            echo json_encode($arr_asi);
        }

        public function FiltrarAsignacion($valor){
            $arr_asi= null;
            
            $cn= $this-> Conectar();
            
            $sql = "call sp_filtrar_por_asignacion(:valor);";

            $snt = $cn->prepare($sql);
            
            $snt->bindParam(':valor', $valor, PDO::PARAM_STR,40);
            
            $snt->execute();

            $arr_asi=$snt->fetchAll(PDO::FETCH_OBJ);
            
            $nr = $snt->rowCount();

            if($nr>0){
                echo "<table class='table table-hover table-sm table-success table-striped'>";
                echo "<tr class='table-primary'>";
                echo "<th>N°</th>";
                echo "<th>Código</th>";
                echo "<th>Fecha Asignacion</th>";
                echo "<th>Rol</th>";
                echo "<th>Proyecto</th>";
                echo "<th>Estado Proyecto</th>";
                echo "<th>Tipo Cliente</th>";
                echo "<th>Nombre Cliente</th>";
                echo "<th>Nombre Empleado</th>";
                echo "<th>Puesto</th>";
                echo "<th>Area</th>";
                echo "</tr>";

                $i=0;
                foreach($arr_asi as $asi){
                    $i++;
                    echo "<tr>";
                    echo "<td>".$i."</td>";
                    echo "<td>".$asi->codigo_asignacion."</td>";
                    echo "<td>".$asi->fecha_asignacion."</td>";
                    echo "<td>".$asi->rol."</td>";
                    echo "<td>".$asi->proyecto."</td>";
                    echo "<td>".$asi->estado_proyecto."</td>";
                    echo "<td>".$asi->tipo_cliente."</td>";
                    echo "<td>".$asi->nombre_cliente."</td>";
                    echo "<td>".$asi->nombre_empleado."</td>";
                    echo "<td>".$asi->puesto."</td>";
                    echo "<td>".$asi->area."</td>";
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

        public function RegistrarAsignacion(Asignacion $asignacion){
            try{
                $cn= $this-> Conectar();

                $sql = "call sp_registrar_asignacion(:cod_asi, :f_asi, :rol, :cod_emp, :cod_pro);";

                $snt = $cn->prepare($sql);
                
                $snt->bindParam(':cod_asi', $asignacion->codigo_asignacion);
                $snt->bindParam(':f_asi', $asignacion->fecha_asignacion);
                $snt->bindParam(':rol', $asignacion->rol);
                $snt->bindParam(':cod_emp', $asignacion->asignacion_codigo_empleado);
                $snt->bindParam(':cod_pro', $asignacion->asignacion_codigo_proyecto);
                
                $snt->execute();

                $cn=null;

            }
            catch(PDOException $ex){
                die($ex->getMessage());
            }
        }

        public function EditarAsignacion(Asignacion $asignacion){
            try{
                $cn= $this-> Conectar();

                $sql = "call sp_editar_asignacion(:cod_asi, :f_asi, :rol, :cod_emp, :cod_pro);";

                $snt = $cn->prepare($sql);
                
                $snt->bindParam(':cod_asi', $asignacion->codigo_asignacion);
                $snt->bindParam(':f_asi', $asignacion->fecha_asignacion);
                $snt->bindParam(':rol', $asignacion->rol);
                $snt->bindParam(':cod_emp', $asignacion->asignacion_codigo_empleado);
                $snt->bindParam(':cod_pro', $asignacion->asignacion_codigo_proyecto);
                
                $snt->execute();

                $cn=null;

            }
            catch(PDOException $ex){
                die($ex->getMessage());
            }
        }

        public function BorrarAsignacion($cod_asi){
            try{
                $cn= $this-> Conectar();
                
                $sql = "call sp_borrar_asignacion(:cod_asi);";

                $snt = $cn->prepare($sql);
                
                $snt->bindParam(':cod_asi', $cod_asi);
                
                $snt->execute();

                $cn=null;
            }
            catch(PDOException $ex){
                die($ex->getMessage());
            }

        }
    }