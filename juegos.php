<?php
include "headerV2.php";
include_once "conectarBBDD.php";

$con = conectarBD();

// $juegos = mysqli_query(
//     $con,
//     'SELECT nombre, min_jugadores, max_jugadores, mecanica, edad, reservado, ruta_foto, id_juego, cambio_socio
//     FROM juegos order by nombre'
// );


$juegos = mysqli_query(
    $con,
    'SELECT r.id_socio as `socio reserva`, r.id_juego as `juego reservado`, j.*
        FROM  juegos j
        LEFT JOIN reserva r ON r.id_juego = j.id_juego');



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






 <!-- Modal -->
 <!-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header ">
                        <h5 class="modal-title mx-auto" id="exampleModalLabel">Título del modal</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body mx-auto">

                        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="green" class="bi bi-check-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
                        </svg>
                        <i class="bi bi-check-circle text-success display-3"></i>
                        <input type="text" id="pruebaT" />
                    </div>
                    <div class="modal-footer mx-auto">
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-outline-success" data-bs-dismiss="modal" onclick="prueba()">Guardar cambios</button>
                    </div>
                </div>
            </div>
        </div> -->
