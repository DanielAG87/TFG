<?php
include "../conectarBBDD.php";
function reservaJuegos()
{
    $id_juego = $_REQUEST['idJuego'];
    $disponible = $_REQUEST['dispopnible'];
    $estado = $_REQUEST['estado'];
    $cambioSocio = $_REQUEST['camSocio'];
    $id_socio = 2; // cambiar cuando se pueda entrar registrado

    $acceso = false;

    $con = conectarBD();

    if ($estado == "devolver") {
        $con->begin_transaction();

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
            echo "Devolucion exitosa";
            $acceso = true;
        } catch (Exception $e) {
            // En caso de error, deshacer la transacción
            $con->rollback();
            echo "Error en la transacción: " . $e->getMessage();
        }

        // Cerrar la conexión
        //$con->close();
    }


    //Reservar juego
    if ($estado == "reservar") {
        $socioUP = $cambioSocio + 1;

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
            echo "Reserva exitosa";
            $acceso = true;
        } catch (Exception $e) {
            // En caso de error, deshacer la transacción
            $con->rollback();
            echo "Error en la transacción: " . $e->getMessage();
        }

        // Cerrar la conexión
        //$con->close();
    }

    // mostrar informacion del poseedor del juego
    if ($estado == "solicitar") {
        $con->begin_transaction();

        try {
            // Consulta 1: Actualizar juego a reservado
            $stmt1 = $con->prepare("SELECT s.nombre, s.apellido1, s.correo, s.telefono FROM socios s 
            JOIN reserva r on s.id_socio = r.id_socio WHERE r.id_socio = ?;");
            $stmt1->bind_param("i", $id_socio); // Enlazar el valor del parámetro de forma segura
            $stmt1->execute();
            $result = $stmt1->get_result(); // Obtener el resultado de la consulta

            while ($row = $result->fetch_assoc()) {
                $nombre = $row['nombre'];
                $apellido1 = $row['apellido1'];
                $correo = $row['correo'];
                $telefono = $row['telefono'];

                // Hacer algo con los datos, como imprimirlos
                echo "Nombre: $nombre<br>";
                echo "Apellido: $apellido1<br>";
                echo "Correo: $correo<br>";
                echo "Teléfono: $telefono<br>";
                $acceso = true;
            }
        } catch (Exception $e) {
            // En caso de error, deshacer la transacción
            $con->rollback();
            echo "Error en la transacción: " . $e->getMessage();
        }
        // Cerrar la conexión
        // $con->close();
    }

    // volvemos a pintar la tabla actualizada
    if ($acceso) {
        $juegos = mysqli_query(
            $con,
            'SELECT nombre, min_jugadores, max_jugadores, mecanica, edad, reservado, ruta_foto, id_juego, cambio_socio
            FROM juegos order by nombre'
        );

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
                        <span style="text-align: center;"><strong><?= $j[0] ?></strong></span><br />
                        <img style="width: 200px; height: 200px;" src="<?= $j[6] ?>" /><br />
                        <span>Jugadores: <?= $j[1] ?>-<?= $j[2] ?></span><br />
                        <span><?= $j[3] ?></span><br />
                        <span>Edad mínima:<?= $j[4] ?></span><br />
                        <?php
                        if ($j[5] == 1) { ?>
                            <!-- <span style="color:red;"><strong>Reservado</strong></span> -->
                            <button class="btn btn-outline-danger" onclick="reservarJuego('<?= $j[7] ?>', '<?= $j[5] ?>', 'solicitar', '<?= $j[8] ?>')">Solicitar</button>

                        <?php
                        } else { ?>
                            <!-- <span style="color:green;"><strong>Disponible</strong></span> -->
                            <button class="btn btn-outline-success" onclick="reservarJuego('<?= $j[7] ?>', '<?= $j[5] ?>', 'reservar', '<?= $j[8] ?>')">Reservar</button>
                        <?php
                        }
                        ?>
                        <button class="btn btn-outline-primary" onclick="reservarJuego('<?= $j[7] ?>', '<?= $j[5] ?>', 'devolver', '<?= $j[8] ?>')">Devolver</button>
                    </div>
                <?php } ?>

            </div>
        </div>
<?php
    }
}

reservaJuegos(); ?>