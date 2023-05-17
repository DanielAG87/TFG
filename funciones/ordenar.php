<?php
include_once "../conectarBBDD.php";

function ordenarTabla()
{
    $con = conectarBD();
    $btn = $_REQUEST['btn'];

    if ($btn == "btnNombreA") {
        $orden = mysqli_query(
            $con,
            'SELECT m.id_movimiento, s.nombre, s.apellido1, m.cantidad, m.concepto, m.fecha_movimiento, m.tipo_gasto 
            FROM movimientos m 
            JOIN socios s WHERE m.id_socio = s.id_socio ORDER BY s.nombre ;'
        );
    }
    if ($btn == "btnNombreZ") {
        $orden = mysqli_query(
            $con,
            'SELECT m.id_movimiento, s.nombre, s.apellido1, m.cantidad, m.concepto, m.fecha_movimiento, m.tipo_gasto 
            FROM movimientos m 
            JOIN socios s WHERE m.id_socio = s.id_socio ORDER BY s.nombre DESC;'
        );
    }
    if ($btn == "btnApeA") {
        $orden = mysqli_query(
            $con,
            'SELECT m.id_movimiento, s.nombre, s.apellido1, m.cantidad, m.concepto, m.fecha_movimiento, m.tipo_gasto 
            FROM movimientos m 
            JOIN socios s WHERE m.id_socio = s.id_socio ORDER BY s.apellido1 ;'
        );
    }
    if ($btn == "btnApeZ") {
        $orden = mysqli_query(
            $con,
            'SELECT m.id_movimiento, s.nombre, s.apellido1, m.cantidad, m.concepto, m.fecha_movimiento, m.tipo_gasto 
            FROM movimientos m 
            JOIN socios s WHERE m.id_socio = s.id_socio ORDER BY s.apellido1 DESC;'
        );
    }
    if ($btn == "btnCantA") {
        $orden = mysqli_query(
            $con,
            'SELECT m.id_movimiento, s.nombre, s.apellido1, m.cantidad, m.concepto, m.fecha_movimiento, m.tipo_gasto 
            FROM movimientos m 
            JOIN socios s WHERE m.id_socio = s.id_socio ORDER BY m.cantidad;'
        );
    }
    if ($btn == "btnCantZ") {
        $orden = mysqli_query(
            $con,
            'SELECT m.id_movimiento, s.nombre, s.apellido1, m.cantidad, m.concepto, m.fecha_movimiento, m.tipo_gasto 
            FROM movimientos m 
            JOIN socios s WHERE m.id_socio = s.id_socio ORDER BY m.cantidad DESC;'
        );
    }
    if ($btn == "btnConceptoA") {
        $orden = mysqli_query(
            $con,
            'SELECT m.id_movimiento, s.nombre, s.apellido1, m.cantidad, m.concepto, m.fecha_movimiento, m.tipo_gasto 
            FROM movimientos m 
            JOIN socios s WHERE m.id_socio = s.id_socio ORDER BY m.concepto;'
        );
    }
    if ($btn == "btnConceptoZ") {
        $orden = mysqli_query(
            $con,
            'SELECT m.id_movimiento, s.nombre, s.apellido1, m.cantidad, m.concepto, m.fecha_movimiento, m.tipo_gasto 
            FROM movimientos m 
            JOIN socios s WHERE m.id_socio = s.id_socio ORDER BY m.concepto DESC;'
        );
    }
    if ($btn == "btnFechaA") {
        $orden = mysqli_query(
            $con,
            'SELECT m.id_movimiento, s.nombre, s.apellido1, m.cantidad, m.concepto, m.fecha_movimiento, m.tipo_gasto 
            FROM movimientos m 
            JOIN socios s WHERE m.id_socio = s.id_socio ORDER BY m.fecha_movimiento;'
        );
    }
    if ($btn == "btnFechaZ") {
        $orden = mysqli_query(
            $con,
            'SELECT m.id_movimiento, s.nombre, s.apellido1, m.cantidad, m.concepto, m.fecha_movimiento, m.tipo_gasto 
            FROM movimientos m 
            JOIN socios s WHERE m.id_socio = s.id_socio ORDER BY m.fecha_movimiento DESC;'
        );
    }
    if ($btn == "btnGastoA") {
        $orden = mysqli_query(
            $con,
            'SELECT m.id_movimiento, s.nombre, s.apellido1, m.cantidad, m.concepto, m.fecha_movimiento, m.tipo_gasto 
            FROM movimientos m 
            JOIN socios s WHERE m.id_socio = s.id_socio ORDER BY m.tipo_gasto;'
        );
    }
    if ($btn == "btnGastoZ") {
        $orden = mysqli_query(
            $con,
            'SELECT m.id_movimiento, s.nombre, s.apellido1, m.cantidad, m.concepto, m.fecha_movimiento, m.tipo_gasto 
            FROM movimientos m 
            JOIN socios s WHERE m.id_socio = s.id_socio ORDER BY m.tipo_gasto DESC;'
        );
    }

?>

    <div class="container-fluid" id="ordenTabla"></div>

    <div class="container-fluid" id="tablaFull">

        <table class="table table-striped table-hover table-bordered text-center" id="tablaPrincipal">
            <tr>
                <th>ID Movimiento</th>
                <th>
                    <span class="sortable-header">
                        Nombre
                        <button style="border: none;" onclick="ordenar('btnNombreA')"><i class="fa-solid fa-arrow-down-a-z"></i></button> <!-- Me quedo aquí buscando los iconos adecuados -->
                        <button style="border: none;" onclick="ordenar('btnNombreZ')"><i class="fa-solid fa-arrow-up-z-a"></i></button>
                    </span>
                </th>
                <th>
                    <span class="sortable-header">
                        Primer Apellido
                        <button style="border: none;" onclick="ordenar('btnApeA')"><i class="fa-solid fa-arrow-down-a-z"></i></button> <!-- Me quedo aquí buscando los iconos adecuados -->
                        <button style="border: none;" onclick="ordenar('btnApeZ')"> <i class="fa-solid fa-arrow-up-z-a"></i></button>
                    </span>
                </th>
                <th>
                    <span class="sortable-header">
                        Cantidad
                        <button style="border: none;" onclick="ordenar('btnCantA')"><i class="fa-solid fa-arrow-down-a-z"></i></button> <!-- Me quedo aquí buscando los iconos adecuados -->
                        <button style="border: none;" onclick="ordenar('btnCantZ')"><i class="fa-solid fa-arrow-down-a-z"></i></button>
                    </span>
                </th>

                <th>
                    <span class="sortable-header">
                        Concepto
                        <button style="border: none;" onclick="ordenar('btnConceptoA')"><i class="fa-solid fa-arrow-down-a-z"></i></button> <!-- Me quedo aquí buscando los iconos adecuados -->
                        <button style="border: none;" onclick="ordenar('btnConceptoZ')"><i class="fa-solid fa-arrow-up-z-a"></i></button>
                    </span>
                </th>
                <th>
                    <span class="sortable-header">
                        Fecha Movimiento
                        <button style="border: none;" onclick="ordenar('btnFechaA')"><i class="fa-solid fa-arrow-down-a-z"></i></button> <!-- Me quedo aquí buscando los iconos adecuados -->
                        <button style="border: none;" onclick="ordenar('btnFechaZ')"><i class="fa-solid fa-arrow-up-z-a"></i></button>
                    </span>
                </th>
                <th>
                    <span class="sortable-header">
                        Tipo Gasto
                        <button style="border: none;" onclick="ordenar('btnGastoA')"><i class="fa-solid fa-arrow-down-a-z"></i></button> <!-- Me quedo aquí buscando los iconos adecuados -->
                        <button style="border: none;" onclick="ordenar('btnGastoZ')"><i class="fa-solid fa-arrow-up-z-a"></i></button>
                    </span>
                </th>
            </tr>
            <tr>
                <?php $i = 0;
                while ($row = mysqli_fetch_assoc($orden)) { ?>
                    <td><?= $row["id_movimiento"] ?></td>
                    <td><?= $row["nombre"] ?></td>
                    <td><?= $row["apellido1"] ?></td>
                    <td><?= $row["cantidad"] ?></td>
                    <td><?= $row["concepto"] ?></td>
                    <td><?= $row["fecha_movimiento"] ?></td>
                    <td><?= $row["tipo_gasto"] ?></td>
            </tr>
        <?php $i++;
                } ?>
        </table>
    </div>
<?php }

ordenarTabla(); ?>