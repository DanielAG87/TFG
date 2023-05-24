<?php
include "headerV2.php";
include_once "conectarBBDD.php";

$con = conectarBD();

$juegos = mysqli_query(
    $con,
    'SELECT nombre, min_jugadores, max_jugadores, mecanica, edad, reservado, ruta_foto, id_juego, cambio_socio
    FROM juegos order by nombre'
);

$devolverJuegos = mysqli_fetch_all($juegos);
mysqli_close($con);


?>
<div id="reserva"></div>

<div class="container-fluid" id="tablaJuegos">

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



<script>
    function reservarJuego(idJuego, dispopnible, estado, camSocio) {
        $(document).ready(function() {
            $("#tablaJuegos").hide();
            // $("#tablaPrincipal2").hide();
        });
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById('reserva').innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "funciones/reservarJuego.php?idJuego=" + idJuego + "&dispopnible=" + dispopnible + "&estado=" + estado + "&camSocio=" + camSocio, true);
        xhttp.send();
    }
</script>

<?php include "footer.php";
