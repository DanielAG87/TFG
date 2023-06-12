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
    $datosFaltantes = "";

    $modal = '<div class="modal fade" id="modalNuevoMovimiento" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title mx-auto" id="exampleModalLabel">Nuevo movimiento/a</h5>
            </div>
            <div class="modal-body mx-auto">
                <span>';





    // control nombre
    if (!empty($nombre) && preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s-]{1,20}$/u', $nombre)) {
        $contador++;
    } else {
        // echo '<div class="container-fluid">';
        // echo    "<p class='text-danger font-weight-bold'>Introduzca nombre</p>";
        // echo '</div>';
        $datosFaltantes .= 'Introduzca nombre <br />';
    }

    // control apellido
    if (!empty($ape1) && preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s-]{1,20}$/u', $ape1)) {
        $contador++;
    } else {
        // echo '<div class="container-fluid">';
        // echo    "<p class='text-danger font-weight-bold'>Introduzca primer apellido</p>";
        // echo '</div>';
        $datosFaltantes .= 'Introduzca primer apellido <br />';
    }

    // control tipo de movimiento
    if (!empty($tipoMovimiento && $tipoMovimiento != "selecciona una opción")) {
        $contador++;
    } else {
        // echo '<div class="container-fluid">';
        // echo    "<p class='text-danger font-weight-bold'>Introduzca tipo movimiento</p>";
        // echo '</div>';
        $datosFaltantes .= 'Introduzca tipo movimiento <br />';
    }
    // control de la cantidad
    if (!empty($cantidad) && is_numeric($cantidad) && $cantidad > 0) {
        $contador++;
    } else {
        // echo '<div class="container-fluid">';
        // echo    "<p class='text-danger font-weight-bold'>ntroduzca una cantidad</p>";
        // echo '</div>';
        $datosFaltantes .= 'Introduzca una cantidad apropiada <br />';
    }

    // control concepto
    if (!empty($concepto)) {
        $contador++;
    } else {
        // echo '<div class="container-fluid">';
        // echo    "<p class='text-danger font-weight-bold'>Introduzca un concepto</p>";
        // echo '</div>';
        $datosFaltantes .= 'Introduzca un concepto <br />';
    }

    // control de la fecha introducida
    $fecha_actual = date("Y-m-d");
    if (!empty($fecha) && strtotime($fecha) < strtotime($fecha_actual)) {
        $contador++;
    } else {
        // echo '<div class="container-fluid">';
        // echo    "<p class='text-danger font-weight-bold'>Introduzca la fecha válida</p>";
        // echo '</div>';
        $datosFaltantes .= 'Introduzca una fecha válida <br />';
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

                        // echo '<div class="container-fluid">
                        //             <p class="text-success font-weight-bold">Movimiento realizado</p>
                        //         </div>';
                        $modal .= '<svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="green"
                            class="bi bi-check-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
                        </svg> ';
                        $modal .= 'Movimiento realizado';

                    } else {
                        // echo "No se ha podido hacer el movimiento";
                        $modal .= '<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="red" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                        <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
                                   </svg> ';
                        $modal .= 'No se ha podido hacer el movimiento';
                    }
                    mysqli_stmt_close($stmt);
                }
            } else {
                // echo "No se ha podido completar la accion, Prueba más tarde";
                $modal .= '<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="red" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
                            </svg> ';
                $modal .= 'No se ha podido completar la accion, Prueba más tarde';
            }
        } else {
            // echo "El usuario no existe";
            $modal .= '<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="red" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
                        </svg> ';
            $modal .= 'El usuario no existe';
        }
    }
    else{
        $modal .= '<strong style="color:red;">Faltan datos: </strong><br /> ' . $datosFaltantes;
    }
    $modal .= '             </span>
                                </div>
                                <div class="modal-footer mx-auto">
                                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cerrar</button>
                                    
                                </div>
                            </div>
                        </div>
                    </div>';
    echo $modal;
}


nuevoMovimiento();
?>