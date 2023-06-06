<?php session_start();
include_once "../conectarBBDD.php";

function ordenarTabla()
{
    $con = conectarBD();
    $btn = $_REQUEST['btn'];

    if ($btn == "btnMoviA") {
        //$_SESSION['btnMoviA'] = $btn;
        $orden = mysqli_query(
            $con,
            'SELECT m.id_movimiento, s.nombre, s.apellido1, m.cantidad, m.concepto, m.fecha_movimiento, m.tipo_gasto 
                FROM movimientos m 
                JOIN socios s ON m.id_socio = s.id_socio ORDER BY m.id_movimiento;'
        );
    }
    if ($btn == "btnMoviZ") {
        //$_SESSION['btnMoviZ'] = $btn;
        $orden = mysqli_query(
            $con,
            'SELECT m.id_movimiento, s.nombre, s.apellido1, m.cantidad, m.concepto, m.fecha_movimiento, m.tipo_gasto 
                FROM movimientos m 
                JOIN socios s ON m.id_socio = s.id_socio ORDER BY m.id_movimiento DESC'
        );
    }
    if ($btn == "btnNombreA") {
        $_SESSION['btnNombreA'] = $btn;
        $orden = mysqli_query(
            $con,
            'SELECT m.id_movimiento, s.nombre, s.apellido1, m.cantidad, m.concepto, m.fecha_movimiento, m.tipo_gasto 
                FROM movimientos m 
                JOIN socios s ON m.id_socio = s.id_socio ORDER BY s.nombre'
        );
    }
    if ($btn == "btnNombreZ") {
        $_SESSION['btnNombreZ'] = $btn;
        $orden = mysqli_query(
            $con,
            'SELECT m.id_movimiento, s.nombre, s.apellido1, m.cantidad, m.concepto, m.fecha_movimiento, m.tipo_gasto 
                FROM movimientos m 
                JOIN socios s ON m.id_socio = s.id_socio ORDER BY s.nombre DESC;'
        );
    }
    if ($btn == "btnApeA") {
        //$_SESSION['btnApeA'] = $btn;
        $orden = mysqli_query(
            $con,
            'SELECT m.id_movimiento, s.nombre, s.apellido1, m.cantidad, m.concepto, m.fecha_movimiento, m.tipo_gasto 
                FROM movimientos m 
                JOIN socios s ON m.id_socio = s.id_socio ORDER BY s.apellido1 ;'
        );
    }
    if ($btn == "btnApeZ") {
        //$_SESSION['btnApeZ'] = $btn;
        $orden = mysqli_query(
            $con,
            'SELECT m.id_movimiento, s.nombre, s.apellido1, m.cantidad, m.concepto, m.fecha_movimiento, m.tipo_gasto 
                FROM movimientos m 
                JOIN socios s ON m.id_socio = s.id_socio ORDER BY s.apellido1 DESC;'
        );
    }
    if ($btn == "btnCantA") {
        $_SESSION['btnCantA'] = $btn;
        $orden = mysqli_query(
            $con,
            'SELECT m.id_movimiento, s.nombre, s.apellido1, m.cantidad, m.concepto, m.fecha_movimiento, m.tipo_gasto 
                FROM movimientos m 
                JOIN socios s ON m.id_socio = s.id_socio ORDER BY m.cantidad;'
        );
    }
    if ($btn == "btnCantZ") {
        $_SESSION['btnCantZ'] = $btn;
        $orden = mysqli_query(
            $con,
            'SELECT m.id_movimiento, s.nombre, s.apellido1, m.cantidad, m.concepto, m.fecha_movimiento, m.tipo_gasto 
                FROM movimientos m 
                JOIN socios s ON m.id_socio = s.id_socio ORDER BY m.cantidad DESC;'
        );
    }
    if ($btn == "btnConceptoA") {
        //$_SESSION['btnConceptoA'] = $btn;
        $orden = mysqli_query(
            $con,
            'SELECT m.id_movimiento, s.nombre, s.apellido1, m.cantidad, m.concepto, m.fecha_movimiento, m.tipo_gasto 
                FROM movimientos m 
                JOIN socios s ON m.id_socio = s.id_socio ORDER BY m.concepto;'
        );
    }
    if ($btn == "btnConceptoZ") {
        //$_SESSION['btnConceptoZ'] = $btn;
        $orden = mysqli_query(
            $con,
            'SELECT m.id_movimiento, s.nombre, s.apellido1, m.cantidad, m.concepto, m.fecha_movimiento, m.tipo_gasto 
                FROM movimientos m 
                JOIN socios s ON m.id_socio = s.id_socio ORDER BY m.concepto DESC;'
        );
    }
    if ($btn == "btnFechaA") {
        $_SESSION['btnFechaA'] = $btn;
        $orden = mysqli_query(
            $con,
            'SELECT m.id_movimiento, s.nombre, s.apellido1, m.cantidad, m.concepto, m.fecha_movimiento, m.tipo_gasto 
                FROM movimientos m 
                JOIN socios s WHERE m.id_socio = s.id_socio ORDER BY m.fecha_movimiento;'
        );
    }
    if ($btn == "btnFechaZ") {
        $_SESSION['btnFechaZ'] = $btn;
        $orden = mysqli_query(
            $con,
            'SELECT m.id_movimiento, s.nombre, s.apellido1, m.cantidad, m.concepto, m.fecha_movimiento, m.tipo_gasto 
                FROM movimientos m 
                JOIN socios s WHERE m.id_socio = s.id_socio ORDER BY m.fecha_movimiento DESC;'
        );
    }
    if ($btn == "btnGastoA") {
        //$_SESSION['btnGastoA'] = $btn;
        $orden = mysqli_query(
            $con,
            'SELECT m.id_movimiento, s.nombre, s.apellido1, m.cantidad, m.concepto, m.fecha_movimiento, m.tipo_gasto 
                FROM movimientos m 
                JOIN socios s WHERE m.id_socio = s.id_socio ORDER BY m.tipo_gasto;'
        );
    }
    if ($btn == "btnGastoZ") {
        //$_SESSION['btnGastoZ'] = $btn;
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
                <th>
                    <span class="sortable-header">
                        ID Movimiento
                        <button style="border: none;" onclick="ordenar('btnMoviA')"><i class="bi bi-sort-numeric-down"></i></button> <!-- Me quedo aquí buscando los iconos adecuados -->
                        <button style="border: none;" onclick="ordenar('btnMoviZ')"><i class="bi bi-sort-numeric-up-alt"></i></button>
                    </span>
                </th>
                <th>
                    <span class="sortable-header">
                        Nombre
                        <button style="border: none;" onclick="ordenar('btnNombreA')"><i class="bi bi-sort-alpha-down"></i></button> <!-- Me quedo aquí buscando los iconos adecuados -->
                        <button style="border: none;" onclick="ordenar('btnNombreZ')"><i class="bi bi-sort-alpha-up-alt"></i></button>
                    </span>
                </th>
                <th>
                    <span class="sortable-header">
                        Primer Apellido
                        <button style="border: none;" onclick="ordenar('btnApeA')"><i class="bi bi-sort-alpha-down"></i></button> <!-- Me quedo aquí buscando los iconos adecuados -->
                        <button style="border: none;" onclick="ordenar('btnApeZ')"> <i class="bi bi-sort-alpha-up-alt"></i></button>
                    </span>
                </th>
                <th>
                    <span class="sortable-header">
                        Cantidad
                        <button style="border: none;" onclick="ordenar('btnCantA')"><i class="bi bi-sort-numeric-down"></i></button> <!-- Me quedo aquí buscando los iconos adecuados -->
                        <button style="border: none;" onclick="ordenar('btnCantZ')"><i class="bi bi-sort-numeric-up-alt"></i></button>
                    </span>
                </th>

                <th>
                    <span class="sortable-header">
                        Concepto
                        <button style="border: none;" onclick="ordenar('btnConceptoA')"><i class="bi bi-sort-alpha-down"></i></button> <!-- Me quedo aquí buscando los iconos adecuados -->
                        <button style="border: none;" onclick="ordenar('btnConceptoZ')"><i class="bi bi-sort-alpha-up-alt"></i></button>
                    </span>
                </th>
                <th>
                    <span class="sortable-header">
                        Fecha Movimiento
                        <button style="border: none;" onclick="ordenar('btnFechaA')"><i class="bi bi-sort-numeric-down"></i></button> <!-- Me quedo aquí buscando los iconos adecuados -->
                        <button style="border: none;" onclick="ordenar('btnFechaZ')"><i class="bi bi-sort-numeric-up-alt"></i></button>
                    </span>
                </th>
                <th>
                    <span class="sortable-header">
                        Tipo Gasto
                        <button style="border: none;" onclick="ordenar('btnGastoA')"><i class="bi bi-sort-alpha-down"></i></button> <!-- Me quedo aquí buscando los iconos adecuados -->
                        <button style="border: none;" onclick="ordenar('btnGastoZ')"><i class="bi bi-sort-alpha-up-alt"></i></button>
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