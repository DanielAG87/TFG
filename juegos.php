<?php
include "headerV2.php";
include_once "conectarBBDD.php";

$con = conectarBD();
$juegos = mysqli_query(
    $con,
    'SELECT r.id_socio as `socio reserva`, r.id_juego as `juego reservado`, j.*
        FROM  juegos j
        LEFT JOIN reserva r ON r.id_juego = j.id_juego ORDER BY j.nombre');

$devolverJuegos = mysqli_fetch_all($juegos);
mysqli_close($con);

?>
<!-- <div id="reserva"></div> -->

<div class="container-fluid" id="tablaJuegos">

    <div class="row">
        <?php
        foreach ($devolverJuegos as $j) {?>

            <div class=" col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2 col-xxl-2 text-center mb-3">
                <span style="text-align: center;"><strong><?= $j[3] ?></strong></span><br />
                <img style="width: 200px; height: 200px;" src="<?= $j[14] ?>" /><br />
                <span>Jugadores: <?= $j[5] ?>-<?= $j[6] ?></span><br />
                <span><?= $j[9] ?></span><br />
                <span>Edad mínima:<?= $j[10] ?></span><br />
                <?php
                if ($j[12] == 1 && $j[0] == $_SESSION['id']) { ?> <!-- si está reservado -->
                    <button class="btn btn-outline-primary" onclick="reservarJuego('<?= $j[2] ?>', '<?= $j[12] ?>', 'devolver', '<?= $j[13] ?>')" >Devolver</button>
                <?php
                } 
                elseif ($j[12] == 1 && $j[0] != $_SESSION['id']) { ?>
                   
                    <button class="btn btn-outline-danger" onclick="reservarJuego('<?= $j[2] ?>', '<?= $j[12] ?>', 'solicitar', '<?= $j[13] ?>')">Solicitar</button>

                <?php
                }
                elseif ($j[12] == 0){ ?>
                     <button class="btn btn-outline-success" onclick="reservarJuego('<?= $j[2] ?>', '<?= $j[12] ?>', 'reservar', '<?= $j[13] ?>')">Reservar</button>

                     <?php }
                ?>
            </div>
        <?php } ?>

    </div>
</div>



<script>
    function reservarJuego(idJuego, dispopnible, estado, camSocio) {
        $(document).ready(function() {
            // $("#tablaJuegos").hide();
            // $("#tablaPrincipal2").hide();
        });
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById('tablaJuegos').innerHTML = this.responseText;
                 
                $(document).ready(function() {
                    $("#exampleModal").modal("show");
                });
            
            }
        };
        xhttp.open("GET", "funciones/reservarJuego.php?idJuego=" + idJuego + "&dispopnible=" + dispopnible + "&estado=" + estado + "&camSocio=" + camSocio, true);
        xhttp.send();
    }
</script>

<?php include "footer.php"; ?>

