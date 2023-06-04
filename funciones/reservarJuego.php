<?php session_start();
include "../conectarBBDD.php";
function reservaJuegos()
{
    $id_juego = $_REQUEST['idJuego'];
    // $disponible = $_REQUEST['dispopnible'];
    $estado = $_REQUEST['estado'];
    $cambioSocio = $_REQUEST['camSocio'];
    $id_socio = $_SESSION['id'];

    $acceso = false;
    $con = conectarBD();


    if ($estado == "devolver") {
        $con->begin_transaction();
        $modal = ' <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header ">
                                <h5 class="modal-title mx-auto" id="exampleModalLabel">Devolución</h5>
                            </div>
                            <div class="modal-body mx-auto">
                                <span>';

        try {
            // Consulta 1: Actualizar juego a disponible
            $stmt1 = $con->prepare("UPDATE juegos SET reservado = 0 WHERE id_juego = ?");
            $stmt1->bind_param("i", $id_juego);
            $stmt1->execute();
            $stmt1->close();

            // Consulta 2: Borrar de la reserva
            $stmt2 = $con->prepare("DELETE FROM reserva WHERE id_juego = ?");
            $stmt2->bind_param("i", $id_juego);
            $stmt2->execute();
            $stmt2->close();

            // Si todas las consultas se ejecutaron correctamente, confirmar la transacción
            $con->commit();
            // echo "Devolucion exitosa";
            $modal .= '<svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="green"
                            class="bi bi-check-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
                        </svg> ';
            $modal .= 'Devolución realizada';
            $acceso = true;
        } catch (Exception $e) {
            // En caso de error, deshacer la transacción
            $con->rollback();
            // echo "Error en la transacción: " . $e->getMessage();
            $modal .= '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
            <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
            </svg> ';
        }
        
        // Cerrar la conexión
        //$con->close();
    }


    //Reservar juego
    if ($estado == "reservar") {
        $modal = ' <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header ">
                                <h5 class="modal-title mx-auto" id="exampleModalLabel">Reserva</h5>
                            </div>
                            <div class="modal-body mx-auto">
                                <span>';
        $socioUP = intval($cambioSocio + 1);

        $con->begin_transaction();

        try {
            // Consulta 1: Actualizar juego a reservado
            $stmt1 = $con->prepare("UPDATE juegos SET reservado = 1, cambio_socio = ?  WHERE id_juego = ?");
            $stmt1->bind_param("ii", $socioUP, $id_juego);
            $stmt1->execute();
            $stmt1->close();

            // Consulta 2: Insertar reserva
            $stmt2 = $con->prepare("INSERT INTO reserva (id_socio, id_juego, fecha_reserva) VALUES (?, ?, CURRENT_DATE)");
            $stmt2->bind_param("ii", $id_socio, $id_juego);
            $stmt2->execute();
            $stmt2->close();

            // Si todas las consultas se ejecutaron correctamente, confirmar la transacción
            $con->commit();
            $modal .= '<svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="green"
                            class="bi bi-check-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
                        </svg> ';
            $modal .= 'Reserva realizada';
            $acceso = true;
        } catch (Exception $e) {
            // En caso de error, deshacer la transacción
            $con->rollback();
            $modal .= '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
            <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
            </svg> ';
            $modal .= 'Error en la solicitud:' .  $e->getMessage();
        }
    }

    // mostrar informacion del poseedor del juego
    if ($estado == "solicitar") {
        $modal = ' <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header ">
                                <h5 class="modal-title mx-auto" id="exampleModalLabel">Datos poseedor</h5>
                            </div>
                            <div class="modal-body mx-auto">
                                <span>';
        $con->begin_transaction();

        try {
            // Consulta 1: 
            $stmt1 = $con->prepare("SELECT s.nombre, s.apellido1, s.correo, s.telefono FROM socios s 
            JOIN reserva r on s.id_socio = r.id_socio WHERE r.id_juego = ? ");
            $stmt1->bind_param("i", $id_juego);
            $stmt1->execute();
            $result = $stmt1->get_result();

            while ($row = $result->fetch_assoc()) {
                $nombre = $row['nombre'];
                $apellido1 = $row['apellido1'];
                $correo = $row['correo'];
                $telefono = $row['telefono'];
            }

            $modal .= 'Nombre:' . ' ' .  $nombre . '<br>' . 'Apellido:' . ' ' . $apellido1 . '<br>' . 
                      'Correo:' . ' ' . $correo . '<br>' . 'Teléfono:' . ' ' . $telefono . '<br>';

            $acceso = true;
            

        } catch (Exception $e) {
            // En caso de error, deshacer la transacción
            $con->rollback();
            $modal .= '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
            <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
            </svg> ';
            $modal .= 'Error en la solicitud:' .  $e->getMessage();
            // echo "Error en la transacción: " . $e->getMessage();
        }
        // Cerrar la conexión
        // $con->close();
    }

    // volvemos a pintar la tabla actualizada
    if ($acceso) {
        $juegos = mysqli_query(
            $con,
            'SELECT r.id_socio as `socio reserva`, r.id_juego as `juego reservado`, j.*
                FROM  juegos j
                LEFT JOIN reserva r ON r.id_juego = j.id_juego ORDER BY j.nombre');
        
        
        
        $devolverJuegos = mysqli_fetch_all($juegos);
        mysqli_close($con);


?>
        <div id="reserva"></div>

        <div class="container-fluid">

            <div class="row">
                <?php
                foreach ($devolverJuegos as $j) {
                ?>
                <div class=" col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2 col-xxl-2 text-center mb-3">
                <span style="text-align: center;"><strong><?= $j[3] ?></strong></span><br />
                <img style="width: 200px; height: 200px;" src="<?= $j[14] ?>" /><br />
                <span>Jugadores: <?= $j[5] ?>-<?= $j[6] ?></span><br />
                <span><?= $j[9] ?></span><br />
                <span>Edad mínima:<?= $j[10] ?></span><br />
                <?php
                if ($j[12] == 1 && $j[0] == $_SESSION['id']) { ?> <!-- si está reservado -->
                    <button class="btn btn-outline-primary" onclick="reservarJuego('<?= $j[2] ?>', '<?= $j[11] ?>', 'devolver', '<?= $j[12] ?>')" >Devolver</button>
                <?php
                } 
                elseif ($j[12] == 1 && $j[0] != $_SESSION['id']) { ?>
                   
                    <button class="btn btn-outline-danger" onclick="reservarJuego('<?= $j[2] ?>', '<?= $j[11] ?>', 'solicitar', '<?= $j[12] ?>')">Solicitar</button>

                <?php
                }
                elseif ($j[12] == 0){ ?>
                     <button class="btn btn-outline-success" onclick="reservarJuego('<?= $j[2] ?>', '<?= $j[11] ?>', 'reservar', '<?= $j[12] ?>')">Reservar</button>

                     <?php }
                ?>
            </div>

                <?php } ?>

            </div>
        </div>
<?php
    }




    // <!-- Modal -->
    $modal .= '</span>
        </div>
        <div class="modal-footer mx-auto">
            <button type="button" class="btn btn-outline-success" data-bs-dismiss="modal">Cerrar</button>
            
        </div>
    </div>
</div>
</div>';
    echo $modal;
}


reservaJuegos(); ?>


<!-- fpdf para generer pdf. -->