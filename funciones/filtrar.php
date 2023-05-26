<?php 
include_once "../conectarBBDD.php";

function filtrarDatos(){
    $selBuscador = $_REQUEST['selBuscador'];
    $selInput =  $_REQUEST['selInput'];
    $con = conectarBD();

    if ($selBuscador == "Nombre" && $selInput != "") {
        $contener = '%' . $selInput . '%';

        try{
        $filtrar = $con->prepare("SELECT m.id_movimiento, s.nombre, s.apellido1, m.cantidad, m.concepto, m.fecha_movimiento, m.tipo_gasto 
        FROM movimientos m 
        JOIN socios s  on m.id_socio = s.id_socio WHERE s.nombre LIKE ?");
        $filtrar->bind_param("s", $contener);
        $filtrar->execute();
        $resultFiltrar = $filtrar->get_result(); // Obtener el resultado de la consulta
        } catch (Exception $e) {
            echo "Error al filtrar: " . $e->getMessage();
        }
    }

    if ($selBuscador == "Cantidad" && $selInput != "") {
        try{
        $filtrar = $con->prepare("SELECT m.id_movimiento, s.nombre, s.apellido1, m.cantidad, m.concepto, m.fecha_movimiento, m.tipo_gasto 
        FROM movimientos m JOIN socios s on m.id_socio = s.id_socio WHERE m.cantidad = ?");
        $filtrar->bind_param("i", $selInput);
        $filtrar->execute();
        $resultFiltrar = $filtrar->get_result(); // Obtener el resultado de la consulta
        } catch (Exception $e) {
            echo "Error al filtrar: " . $e->getMessage();
        }
    }
    if ($selBuscador == "Fecha" && $selInput != "") {
        try{
            $filtrar = $con->prepare("SELECT m.id_movimiento, s.nombre, s.apellido1, m.cantidad, m.concepto, m.fecha_movimiento, m.tipo_gasto 
            FROM movimientos m JOIN socios s on m.id_socio = s.id_socio  WHERE m.fecha_movimiento = ?");
            $filtrar->bind_param("s", $selInput);
            $filtrar->execute();
            $resultFiltrar = $filtrar->get_result(); // Obtener el resultado de la consulta
        } catch (Exception $e) {
            echo "Error al filtrar: " . $e->getMessage();
        }
    }
?>



    <div class="container-fluid" id="tablaFull">

    <table class="table table-striped table-hover table-bordered text-center" id="tablaPrincipal">
        <tr>
            <th>
                <span class="sortable-header">
                    ID Movimiento
                    <button style="border: none;" onclick="ordenar('btnMoviA')"><i class="bi bi-sort-numeric-down"></i></button> 
                    <button style="border: none;" onclick="ordenar('btnMoviZ')"><i class="bi bi-sort-numeric-up-alt"></i></button>
                </span>
            </th>
            <th>
                <span class="sortable-header">
                    Nombre
                    <button style="border: none;" onclick="ordenar('btnNombreA')"><i class="bi bi-sort-alpha-down"></i></button> 
                    <button style="border: none;" onclick="ordenar('btnNombreZ')"><i class="bi bi-sort-alpha-up-alt"></i></button>
                </span>
            </th>
            <th>
                <span class="sortable-header">
                    Primer Apellido
                    <button style="border: none;" onclick="ordenar('btnApeA')"><i class="bi bi-sort-alpha-down"></i></button> 
                    <button style="border: none;" onclick="ordenar('btnApeZ')"><i class="bi bi-sort-alpha-up-alt"></i></button>
                </span>
            </th>
            <th>
                <span class="sortable-header">
                    Cantidad
                    <button style="border: none;" onclick="ordenar('btnCantA')"><i class="bi bi-sort-numeric-down"></i></button> 
                    <button style="border: none;" onclick="ordenar('btnCantZ')"><i class="bi bi-sort-numeric-up-alt"></i></button>
                </span>
            </th>

            <th>
                <span class="sortable-header">
                    Concepto
                    <button style="border: none;" onclick="ordenar('btnConceptoA')"><i class="bi bi-sort-alpha-down"></i></button> 
                    <button style="border: none;" onclick="ordenar('btnConceptoZ')"><i class="bi bi-sort-alpha-up-alt"></i></button>
                </span>
            </th>
            <th>
                <span class="sortable-header">
                    Fecha Movimiento
                    <button style="border: none;" onclick="ordenar('btnFechaA')"><i class="bi bi-sort-numeric-down"></i></button> 
                    <button style="border: none;" onclick="ordenar('btnFechaZ')"><i class="bi bi-sort-numeric-up-alt"></i></button>
                </span>
            </th>
            <th>
                <span class="sortable-header">
                    Tipo Gasto
                    <button style="border: none;" onclick="ordenar('btnGastoA')" ><i class="bi bi-sort-alpha-down"></i></button> 
                    <button style="border: none;" onclick="ordenar('btnGastoZ')" ><i class="bi bi-sort-alpha-up-alt"></i></button>
                </span>
            </th>
        </tr>
        <tr>
            <?php $i = 0;
            mysqli_close($con);

            while ($row = $resultFiltrar->fetch_assoc()) { ?>
                <td><?= $row["id_movimiento"] ?></td>
                <td><?= $row["nombre"] ?></td>
                <td><?= $row["apellido1"] ?></td>
                <td><?= $row["cantidad"] ?></td>
                <td><?= $row["concepto"] ?></td>
                <td><?= $row["fecha_movimiento"] ?></td>
                <td><?= $row["tipo_gasto"] ?></td>
            </tr>
           <?php } ?>
       
    <?php $i++;
            } ?>
    </table>
</div>
<?php

filtrarDatos(); ?>
