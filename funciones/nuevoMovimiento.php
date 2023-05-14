<?php
include_once "../conectarBBDD.php";

function nuevoMovimiento()
{

    $con = conectarBD();

    $nombre = ucwords($_REQUEST['nombre']);
    $ape1 = ucwords($_REQUEST['ape1']);
    $tipoMovimiento = strtolower($_REQUEST['tipoMovimiento']);
    $cantidad = $_REQUEST['cantidad'];
    $concepto = $_REQUEST['concepto'];
    $fecha = $_REQUEST['fecha'];


    $contador = 0;
    // conombre
    if (!empty($nombre) && preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s-]{1,20}$/u', $nombre)) {
        $contador++;
    } else {
        echo '<div class="container-fluid">';
        echo    "<p class='text-danger font-weight-bold'>Introduzca nombre</p>";
        echo '</div>';
    }

    // control apellido
    if (!empty($ape1) && preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s-]{1,20}$/u', $ape1)) {
        $contador++;
    } else {
        echo '<div class="container-fluid">';
        echo    "<p class='text-danger font-weight-bold'>Introduzca primer apellido</p>";
        echo '</div>';
    }

    // control tipo de movimiento
    if (!empty($tipoMovimiento && $tipoMovimiento != "selecciona una opción")) {
        $contador++;
    } else {
        echo '<div class="container-fluid">';
        echo    "<p class='text-danger font-weight-bold'>Introduzca tipo movimiento</p>";
        echo '</div>';
    }
    // control de la cantidad
    if (!empty($cantidad) && is_numeric($cantidad)) {
        $contador++;
    } else {
        echo '<div class="container-fluid">';
        echo    "<p class='text-danger font-weight-bold'>ntroduzca una cantidad</p>";
        echo '</div>';
    }

    // control concepto
    if (!empty($concepto)) {
        $contador++;
    } else {
        echo '<div class="container-fluid">';
        echo    "<p class='text-danger font-weight-bold'>Introduzca un concepto</p>";
        echo '</div>';
    }

    // control de la fecha introducida
    $fecha_actual = date("Y-m-d");
    if (!empty($fecha) && strtotime($fecha) < strtotime($fecha_actual)) {
        $contador++;
    } else {
        echo '<div class="container-fluid">';
        echo    "<p class='text-danger font-weight-bold'>Introduzca la fecha válida</p>";
        echo '</div>';
    }


    // si todas las comprobaciones son correctas pasamos al insert
    if ($contador == 6) {

        $con = conectarBD();
        $selID = mysqli_query($con, "SELECT id_socio as id FROM socios WHERE nombre = '{$nombre}' AND apellido1 = '{$ape1}'");

        if (mysqli_affected_rows($con) == 1) {

            $resultadoid = mysqli_fetch_assoc($selID);
            $idFinal = $resultadoid['id'];

            $nuevoFulano = "INSERT INTO movimientos (id_socio, cantidad, concepto, fecha_movimiento, tipo_gasto) VALUES (?, ?, ?, ?, ?)";
            $stmt = mysqli_stmt_init($con);

            if (mysqli_stmt_prepare($stmt, $nuevoFulano)) {

                if (mysqli_stmt_bind_param($stmt, "idsss", $idFinal, $cantidad, $concepto, $fecha, $tipoMovimiento)) {

                    if (mysqli_stmt_execute($stmt)) {

                        echo '<div class="container-fluid">
                                    <p class="text-success font-weight-bold">Movimiento realizado</p>
                                </div>';

                        $ingresos = mysqli_query($con, 'SELECT SUM(cantidad) as  ingresos From movimientos WHERE tipo_gasto = "ingreso"');
                        $gastos = mysqli_query($con, 'SELECT SUM(cantidad) as gastos From movimientos WHERE tipo_gasto = "gasto"');
                        $donaciones = mysqli_query($con, 'SELECT COUNT(id_movimiento) as donaciones from movimientos where tipo_gasto = "donacion"');


                        // ingresos
                        $resultadoIngreso = mysqli_fetch_assoc($ingresos);
                        $ingresoTotal = round($resultadoIngreso['ingresos'], 2);
                        //gastos
                        $resultadoGasto = mysqli_fetch_assoc($gastos);
                        $gastoTotal = round($resultadoGasto['gastos'], 2);
                        //donaciones
                        $resultadoDonacion = mysqli_fetch_assoc($donaciones);
                        $donacionesTotales = $resultadoDonacion['donaciones'];

                        $saldo = $ingresoTotal - $gastoTotal; ?>
                        <p>EL saldo actual de la asociacion es de: <strong>
                                <?php if ($saldo < 0) { ?>
                                    <span style='color: red;'><?= $saldo ?></span>
                                <?php } else { ?>
                                    <span style='color: green;'><?= $saldo ?></span>
                                <?php } ?>
                            </strong> €</p>;
<?php

                    } else {
                        echo "No se ha podido hacer el movimiento";
                    }
                    mysqli_stmt_close($stmt);
                }
            } else {
                echo "No se ha podido completar la accion, Prueba más tarde";
            }
        } else {
            echo "El usuario no existe";
        }
    }
}


nuevoMovimiento();
?>