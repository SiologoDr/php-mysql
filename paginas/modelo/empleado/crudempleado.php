<?php
class CRUDEmpleado extends Conexion {
    public function ListarEmpleado() {
        $arr_empleado = null;

        $cn = $this->Conectar();

        $sql = "CALL sp_listar_empleado()";

        $snt = $cn->prepare($sql);
        $snt->execute();

        $arr_empleado = $snt->fetchAll(PDO::FETCH_OBJ);

        $cn = null;

        return $arr_empleado;
    }

    public function BuscarEmpleadoPorCodigo($cod_emp) {
        $arr_empleado = null;

        $cn = $this->Conectar();

        $sql = "CALL sp_buscar_empleado_por_codigo(:cod_emp);";

        $snt = $cn->prepare($sql);
        $snt->bindParam(':cod_emp', $cod_emp, PDO::PARAM_STR, 5);
        $snt->execute();

        $nr = $snt->rowCount();

        if ($nr > 0) {
            $arr_empleado = $snt->fetch(PDO::FETCH_OBJ);
        }

        $cn = null;

        return $arr_empleado;
    }

    public function MostrarEmpleadoPorCodigo($cod_emp) {
        $arr_emp = null;

        $cn = $this->Conectar();

        $sql = "CALL sp_mostrar_empleado_por_codigo(:cod_emp);";

        $snt = $cn->prepare($sql);
        $snt->bindParam(':cod_emp', $cod_emp, PDO::PARAM_STR, 5);
        $snt->execute();

        $nr = $snt->rowCount();

        if ($nr > 0) {
            $arr_emp = $snt->fetch(PDO::FETCH_OBJ);
        }

        $cn = null;

        return $arr_emp;
    }

    public function ConsultarEmpleadoPorCodigo($cod_emp) {
        $arr_emp = null;

        $cn = $this->Conectar();

        $sql = "CALL sp_mostrar_empleado_por_codigo(:cod_emp);";

        $snt = $cn->prepare($sql);
        $snt->bindParam(':cod_emp', $cod_emp, PDO::PARAM_STR, 5);
        $snt->execute();

        $nr = $snt->rowCount();

        if ($nr > 0) {
            $arr_emp = $snt->fetch(PDO::FETCH_OBJ);
        }

        $cn = null;

        echo json_encode($arr_emp);
    }

    public function FiltrarEmpleado($valor) {
        $arr_emp = null;

        $cn = $this->Conectar();

        $sql = "CALL sp_filtrar_por_empleado(:valor);";

        $snt = $cn->prepare($sql);
        $snt->bindParam(':valor', $valor, PDO::PARAM_STR, 40);
        $snt->execute();

        $arr_emp = $snt->fetchAll(PDO::FETCH_OBJ);

        $nr = $snt->rowCount();

        if ($nr > 0) {
            echo "<table class='table table-hover table-sm table-success table-striped'>";
            echo "<tr class='table-primary'>";
            echo "<th>N°</th>";
            echo "<th>Código</th>";
            echo "<th>Nombre</th>";
            echo "<th>Apellido Paterno</th>";
            echo "<th>Apellido Materno</th>";
            echo "<th>Tipo de Documento</th>";
            echo "<th>Nro Documento</th>";
            echo "<th>Teléfono</th>";
            echo "<th>Email</th>";
            echo "<th>Dirección</th>";
            echo "<th>Sueldo</th>";
            echo "<th>Estado Sueldo</th>";
            echo "<th>Fecha Contratación</th>";
            echo "<th>Puesto</th>";
            echo "<th>Área</th>";
            echo "</tr>";

            $i = 0;
            foreach ($arr_emp as $emp) {
                $i++;
                echo "<tr>";
                echo "<td>" . $i . "</td>";
                echo "<td>" . $emp->codigo_empleado . "</td>";
                echo "<td>" . $emp->nombre_empleado . "</td>";
                echo "<td>" . $emp->apellido_paterno . "</td>";
                echo "<td>" . $emp->apellido_materno . "</td>";
                echo "<td>" . $emp->tipo_documento . "</td>";
                echo "<td>" . $emp->nro_documento . "</td>";
                echo "<td>" . $emp->telefono . "</td>";
                echo "<td>" . $emp->email . "</td>";
                echo "<td>" . $emp->direccion . "</td>";
                echo "<td>S/." . $emp->sueldo . "</td>";
                echo "<td>" . $emp->estado_sueldo . "</td>";
                echo "<td>" . $emp->fecha_contratacion . "</td>";
                echo "<td>" . $emp->puesto . "</td>";
                echo "<td>" . $emp->area . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>";
            echo "No hay registros.";
            echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
            echo "</div>";
        }

        $cn = null;
    }

    public function RegistrarEmpleado(Empleado $empleado) {
        try {
            $cn = $this->Conectar();

            $sql = "CALL sp_registrar_empleado(:cod_emp, :nombre_emp, :apellido_pat, :apellido_mat, :tipo_doc, :nro_doc, :tel, :email, :dir, :sueldo, :estado_sueldo, :f_contr, :puesto, :cod_area);";

            $snt = $cn->prepare($sql);
            $snt->bindParam(':cod_emp', $empleado->codigo_empleado);
            $snt->bindParam(':nombre_emp', $empleado->nombre_empleado);
            $snt->bindParam(':apellido_pat', $empleado->apellido_paterno);
            $snt->bindParam(':apellido_mat', $empleado->apellido_materno);
            $snt->bindParam(':tipo_doc', $empleado->tipo_documento);
            $snt->bindParam(':nro_doc', $empleado->nro_documento);
            $snt->bindParam(':tel', $empleado->telefono);
            $snt->bindParam(':email', $empleado->email);
            $snt->bindParam(':dir', $empleado->direccion);
            $snt->bindParam(':sueldo', $empleado->sueldo);
            $snt->bindParam(':estado_sueldo', $empleado->estado_sueldo);
            $snt->bindParam(':f_contr', $empleado->fecha_contratacion);
            $snt->bindParam(':puesto', $empleado->puesto);
            $snt->bindParam(':cod_area', $empleado->empleado_codigo_area);

            $snt->execute();

            $cn = null;
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }

    public function EditarEmpleado(Empleado $empleado) {
        try {
            $cn = $this->Conectar();

            $sql = "CALL sp_editar_empleado(:cod_emp, :nombre_emp, :apellido_pat, :apellido_mat, :tipo_doc, :nro_doc, :tel, :email, :dir, :sueldo, :estado_sueldo, :f_contr, :puesto, :cod_area);";

            $snt = $cn->prepare($sql);
            $snt->bindParam(':cod_emp', $empleado->codigo_empleado);
            $snt->bindParam(':nombre_emp', $empleado->nombre_empleado);
            $snt->bindParam(':apellido_pat', $empleado->apellido_paterno);
            $snt->bindParam(':apellido_mat', $empleado->apellido_materno);
            $snt->bindParam(':tipo_doc', $empleado->tipo_documento);
            $snt->bindParam(':nro_doc', $empleado->nro_documento);
            $snt->bindParam(':tel', $empleado->telefono);
            $snt->bindParam(':email', $empleado->email);
            $snt->bindParam(':dir', $empleado->direccion);
            $snt->bindParam(':sueldo', $empleado->sueldo);
            $snt->bindParam(':estado_sueldo', $empleado->estado_sueldo);
            $snt->bindParam(':f_contr', $empleado->fecha_contratacion);
            $snt->bindParam(':puesto', $empleado->puesto);
            $snt->bindParam(':cod_area', $empleado->empleado_codigo_area);

            $snt->execute();

            $cn = null;
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }

    public function BorrarEmpleado($cod_emp) {
        try {
            $cn = $this->Conectar();

            $sql = "CALL sp_borrar_empleado(:cod_emp);";

            $snt = $cn->prepare($sql);
            $snt->bindParam(':cod_emp', $cod_emp, PDO::PARAM_STR, 5);
            $snt->execute();

            $cn = null;
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }
}
