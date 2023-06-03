<?php

include_once "../conectarBBDD.php";


function nuevoTorneillo()
{
    $con = conectarBD();

    $nombre = ucwords($_REQUEST['nombre']);
    $ape1 = ucwords($_REQUEST['ape1']);
    $actividad = ucfirst($_REQUEST['actividad']);
    $participantes = $_REQUEST['participantes'];
    $fecha = $_REQUEST['fecha'];
    $entrada = ucwords($_REQUEST['entrada']);
    $cartel = $_REQUEST['cartel'];
    

    $modal = '<div class="modal fade" id="modalNuevoTorneo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header ">
                                <h5 class="modal-title mx-auto" id="exampleModalLabel">Nueva actividad</h5>
                            </div>
                            <div class="modal-body mx-auto">
                                <span>';

    $contador = 0;
    $datosFaltantes = "";
    // coontrolamos el nombre
    if (!empty($nombre) && preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s-]{1,20}$/u', $nombre)) {
        $contador++;
    } else {
        $datosFaltantes .= 'Introduzca nombre <br />';
    }

    // controlamos el apellido1
    if (!empty($ape1) && preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s-]{1,20}$/u', $ape1)) {
        $contador++;
    } else {
        $datosFaltantes .= 'Introduzca primer apellido <br />';
    }

    //controlamos la actividad
    if (!empty($actividad)) {
        $contador++;
    } else {
        $datosFaltantes .= 'Introduzca actividad <br />';
    }

    // control paritcipantes
    if (!empty($participantes) && is_numeric($participantes) && $participantes > 0) {
        $contador++;
    } else {
        $datosFaltantes .= 'Introduzca participantes <br />';
    }

    $fecha_actual = date("Y-m-d");
    if (!empty($fecha) && strtotime($fecha) > strtotime($fecha_actual)) {
        $contador++;
    } else {
        $datosFaltantes .= 'Introduzca fecha  <br />';
    }

    // control entrada
    if (!empty($entrada) &&  is_numeric($entrada)) {
        $contador++;
    } else {
        $datosFaltantes .= 'Introduzca entrada <br />';
    }

    // control cartel
    if (empty($cartel) || preg_match('/^\.[\/\w-]+\/[\w-]+\.(jpg|jpeg|png|gif)$/i', $cartel)) {
        $contador++;
    } else {
        $datosFaltantes .= 'Introduzca dirección cartel <br />';
    }

    // si todo está correcto hacemos el insert.
    if ($contador == 7) {
        $id= mysqli_query($con, "SELECT id_socio FROM socios where nombre = '{$nombre}' AND apellido1 = '{$ape1}'");
        $row = mysqli_fetch_assoc($id);
        $idFulano = $row['id_socio'];

        $nuevoTorneo = "INSERT INTO torneos (organizador1, actividad, num_participantes, fecha, coste_entrada, cartel) 
                        VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_stmt_init($con);

        if (mysqli_stmt_prepare($stmt, $nuevoTorneo)) {

            if (mysqli_stmt_bind_param($stmt, "isisis", $idFulano, $actividad, $participantes, $fecha, $entrada, $cartel)) {

                if (mysqli_stmt_execute($stmt)) {
                    $modal .= '<svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="green"
                                    class="bi bi-check-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                    <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
                                </svg> ';
                    $modal .= 'Actividad añadida';

                } else {
                    $modal .= '<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="red" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
                    </svg> ';
                    $modal .= 'Fallo al añadir actividad';
                }
            }
        } else {
            $modal .= '<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="red" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
                    </svg> ';
                    $modal .= 'No se ha podido completar la accion, Prueba más tarde';
        }
        mysqli_stmt_close($stmt);
    }
    else{
        $modal .= '<strong style="color:red;">Faltan datos: </strong><br /> ' . $datosFaltantes;
        $modal .= '             </span>
                                </div>
                                <div class="modal-footer mx-auto">
                                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cerrar</button>
                                    
                                </div>
                            </div>
                        </div>
                    </div>';
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



    $torneos = mysqli_query(
        $con,
        'SELECT s.nombre, s.apellido1, t.actividad, t.num_participantes, t.fecha, t.coste_entrada, t.cartel, s.correo, s.telefono
        FROM torneos t JOIN socios s ON t.organizador1 = s.id_socio ORDER BY t.fecha'
    );
    mysqli_close($con); ?>


    <div class="container-fluid" id="tablaTorneo">

        <div class="row">
            <?php
            $fechaActual = date('d-m-Y');
            foreach ($torneos as $j) {
                $fechaCambiada =date('d/m/Y', strtotime($j['fecha']));
            ?>
                <div class="col-sm-12 col-md-4 text-center mb-3">
                    <?php
                if (empty($j['cartel'])) { ?>
                    <img style="width: 400px; height: 400px; max-width:max-content; max-height:max-content" src="./img/torneos/noIMG.png"/><br />
                <?php } 
                else{ ?>
                    <img style="width: 400px; height: 400px; max-width:max-content; max-height:max-content" src="<?= $j['cartel'] ?>" /><br />
                <?php }
                ?>
                    <span class="fs-5"><strong><?= $j['actividad'] ?></strong></span><br />
                    <span class="fs-5">Num Participantes: <?= $j['num_participantes'] ?></span><br /> 
                    <?php 
                    if ($fechaCambiada <  $fechaActual) { ?>
                        <span class="fs-5">Fecha: <strong style="color: red;">Finalizado</strong></span><br /> <?php
                    }
                    else{ ?>
                        <span class="fs-5">Fecha: <?= $fechaCambiada ?></span><br /> <?php
                    }
                    ?>

                    <span class="fs-5">Fecha: <?= $fechaCambiada ?></span><br />
                    <span class="fs-5">Entrada: <?= $j['coste_entrada'] ?> Eurazos</span><br />
                    <span class="fs-5">Organizador <?= $j['nombre'] . " " . $j['apellido1'] ?></span><br />
                    <span class="fs-5">Inscripción: <?= $j['correo'] ?></span><br />
                    <span class="fs-5">Telefono: <?= $j['telefono'] ?></span>
                </div>
                <!-- <div class=" col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2 col-xxl-2 text-center mb-3"> -->
            <?php } ?>

        </div>
    </div>

<?php      
    
}


nuevoTorneillo(); ?>