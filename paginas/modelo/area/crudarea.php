<?php
class CRUDArea extends Conexion {

    // Listar todas las áreas
    public function ListarArea() {
        $arr_area = null;

        $cn = $this->Conectar();

        $sql = "CALL sp_listar_area()";

        $snt = $cn->prepare($sql);
        $snt->execute();

        $arr_area = $snt->fetchAll(PDO::FETCH_OBJ);

        $cn = null;

        return $arr_area;
    }

    // Buscar un área por su código
    public function BuscarAreaPorCodigo($cod_area) {
        $arr_area = null;

        $cn = $this->Conectar();

        $sql = "CALL sp_buscar_area_por_codigo(:cod_area);";

        $snt = $cn->prepare($sql);
        $snt->bindParam(':cod_area', $cod_area, PDO::PARAM_STR, 5);
        $snt->execute();

        $nr = $snt->rowCount();

        if ($nr > 0) {
            $arr_area = $snt->fetch(PDO::FETCH_OBJ);
        }

        $cn = null;

        return $arr_area;
    }

    // Consultar un área por su código (envía como JSON)
    public function ConsultarAreaPorCodigo($cod_area) {
        $arr_area = null;

        $cn = $this->Conectar();

        $sql = "CALL sp_mostrar_area_por_codigo(:cod_area);";

        $snt = $cn->prepare($sql);
        $snt->bindParam(':cod_area', $cod_area, PDO::PARAM_STR, 5);
        $snt->execute();

        $nr = $snt->rowCount();

        if ($nr > 0) {
            $arr_area = $snt->fetch(PDO::FETCH_OBJ);
        }

        $cn = null;

        echo json_encode($arr_area);
    }

    public function MostrarAreaPorCodigo($cod_area) {
        $arr_area = null;

        $cn = $this->Conectar();

        $sql = "CALL sp_mostrar_area_por_codigo(:cod_area);";

        $snt = $cn->prepare($sql);
        $snt->bindParam(':cod_area', $cod_area, PDO::PARAM_STR, 5);
        $snt->execute();

        $nr = $snt->rowCount();

        if ($nr > 0) {
            $arr_area = $snt->fetch(PDO::FETCH_OBJ);
        }

        $cn = null;

        return $arr_area;
    }

    // Filtrar áreas por un valor (similar a como se hace en empleado)
    public function FiltrarArea($valor) {
        $arr_area = null;

        $cn = $this->Conectar();

        $sql = "CALL sp_filtrar_por_area(:valor);";

        $snt = $cn->prepare($sql);
        $snt->bindParam(':valor', $valor, PDO::PARAM_STR, 40);
        $snt->execute();

        $arr_area = $snt->fetchAll(PDO::FETCH_OBJ);

        $nr = $snt->rowCount();

        if ($nr > 0) {
            echo "<table class='table table-hover table-sm table-success table-striped'>";
            echo "<tr class='table-primary'>";
            echo "<th>N°</th>";
            echo "<th>Código Área</th>";
            echo "<th>Nombre Área</th>";
            echo "</tr>";

            $i = 0;
            foreach ($arr_area as $area) {
                $i++;
                echo "<tr>";
                echo "<td>" . $i . "</td>";
                echo "<td>" . $area->codigo_area . "</td>";
                echo "<td>" . $area->area . "</td>";
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

    // Registrar un nuevo área
    public function RegistrarArea(Area $area) {
        try {
            $cn = $this->Conectar();

            $sql = "CALL sp_registrar_area(:cod_area, :nombre_area);";

            $snt = $cn->prepare($sql);
            $snt->bindParam(':cod_area', $area->codigo_area);
            $snt->bindParam(':nombre_area', $area->area);

            $snt->execute();

            $cn = null;
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }

    // Editar un área existente
    public function EditarArea(Area $area) {
        try {
            $cn = $this->Conectar();

            $sql = "CALL sp_editar_area(:cod_area, :nombre_area);";

            $snt = $cn->prepare($sql);
            $snt->bindParam(':cod_area', $area->codigo_area);
            $snt->bindParam(':nombre_area', $area->area);

            $snt->execute();

            $cn = null;
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }

    // Eliminar un área
    public function BorrarArea($cod_area) {
        try {
            $cn = $this->Conectar();

            $sql = "CALL sp_borrar_area(:cod_area);";

            $snt = $cn->prepare($sql);
            $snt->bindParam(':cod_area', $cod_area, PDO::PARAM_STR, 5);
            $snt->execute();

            $cn = null;
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }
}
?>
