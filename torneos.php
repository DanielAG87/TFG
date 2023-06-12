<?php include "headerV2.php";
include_once "conectarBBDD.php";
$con = conectarBD();
// crono
$fecha = mysqli_query(
    $con,
    'SELECT fecha, actividad FROM torneos WHERE fecha > CURDATE()
    ORDER BY ABS(DATEDIFF(fecha, CURDATE())) LIMIT 1;'
);

$resultadofecha = mysqli_fetch_assoc($fecha);
$fechaProxima = $resultadofecha['fecha'];
$proximaActividad = $resultadofecha['actividad'];

// convertimos la fecha a lo que requiere el contador de js
$objetoFecha = date_create($fechaProxima);
$fechaModificada = date_format($objetoFecha, 'm/d/Y');
// fin crono


$torneos = mysqli_query(
    $con,
    'SELECT s.nombre, s.apellido1, t.actividad, t.num_participantes, t.fecha, t.coste_entrada, t.cartel, s.correo, s.telefono
    FROM torneos t JOIN socios s ON t.organizador1 = s.id_socio ORDER BY t.fecha'
);

mysqli_close($con); ?>
<h3 class="text-center h3 text-primary vikingo">Actividades</h3>

<h4 class="text-center h4">Próximo evento: <?= $proximaActividad ?></h4>

<!-- Contador regresivo -->
<div id="bodyCrono" class="mb-3">
    <section class="container" id="sectionCrono">
        <div class="countdown">
            <div>
                <span class="spanCrono"> Día/s</span>
                <p class="pCrono" id="dias"></p>
            </div>
            <div>
                <span class="spanCrono"> Hora/s</span>
                <p class="pCrono" id="horas"></p>
            </div>
            <div>
                <span class="spanCrono"> Minuto/s</span>
                <p class="pCrono" id="minutos"></p>
            </div>
            <div>
                <span class="spanCrono"> Segundo/s</span>
                <p class="pCrono" id="segundos"></p>
            </div>
        </div>
    </section>
</div>
<!-- Fin contador regresivo -->
<div class="d-flex justify-content-center mb-3">
    <button type="button" class="btn btn-outline-primary" id="nTorneo2" data-bs-toggle="modal" data-bs-target="#nTorneo">Nueva actividad</button>
</div>


<h3 class="text-center">Eventos Runeros</h3><br>



<div class="container-fluid" id="tablaTorneo">

    <div class="row">
        <?php
        $fechaActual = date('d-m-Y');
        foreach ($torneos as $j) {
            $fechaCambiada = date('d-m-Y', strtotime($j['fecha']));
        ?>
            <div class="col-sm-12 col-md-4 text-center mb-3"> 
                <?php
                if (empty($j['cartel'])) { ?>
                    
                    <img style="width: 400px; height: 400px; max-width:max-content; max-height:max-content;" src="./img/torneos/noIMG.png"/><br />
                    
                <?php } 
                else{ ?>
                    <img style="width: 400px; height: 400px; max-width:max-content; max-height:max-content" src="<?= $j['cartel'] ?>" /><br />
                <?php }
                ?>
                <span class="fs-5"><strong><?= $j['actividad'] ?></strong></span><br />
                <span class="fs-5">Nº Participantes: <?= $j['num_participantes'] ?></span><br />

                <?php 
                    if ( strtotime($fechaCambiada) < strtotime($fechaActual)) { ?>
                        <span class="fs-5">Fecha: <strong style="color: red;">Finalizado</strong></span><br /> <?php
                    }
                    else{ ?>
                        <span class="fs-5">Fecha: <?= $fechaCambiada ?></span><br /> <?php
                    }
                    ?>
                <span class="fs-5">Entrada: <?= $j['coste_entrada'] ?> Eurazos</span><br />
                <span class="fs-5">Organización <?= $j['nombre'] . " " . $j['apellido1'] ?></span><br />
                <span class="fs-5">Inscripción: <?= $j['correo'] ?></span><br />
                <span class="fs-5">Telefono: <?= $j['telefono'] ?></span>
            </div>
            <!-- <div class=" col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2 col-xxl-2 text-center mb-3"> -->
        <?php } ?>

    </div>
</div>

<?php include("footer.php"); ?>

<!-- Modal Nuevo Torneo -->
<div class="modal fade" id="nTorneo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title mx-auto" id="exampleModalLabel">Nueva actividad</h5>
            </div>
            <div class="modal-body mx-auto">
                <div class="row">
                    <div class="col-md-5 text-center">
                        <label for="nombre" class="form-label">Nombre organizador</label>
                    </div>
                    <div class="col-md-7">
                        <input type="text" id="nombre" class="form-control" placeholder="Nombre organizador">
                    </div>
                    <div class="col-md-5 text-center">
                        <label for="ape1" class="form-label">Primer apellido organizador</label>
                    </div>
                    <div class="col-md-7">
                        <input type="text" id="ape1" class="form-control" placeholder="Primer apellido organizador">
                    </div>
                    <div class="col-md-5 text-center">
                        <label for="actividad" class="form-label">Actividad</label>
                    </div>
                    <div class="col-md-7">
                        <input type="text" id="actividad" class="form-control" placeholder="Actividad">
                    </div>
                    <div class="col-md-5 text-center">
                        <label for="participantes" class="form-label">Nº participantes</label>
                    </div>
                    <div class="col-md-7">
                        <input type="number" id="participantes" class="form-control" placeholder="Nº participantes">
                    </div>
                    <div class="col-md-5 text-center">
                        <label for="fecha" class="form-label">Fecha</label>
                    </div>
                    <div class="col-md-7">
                        <input type="date" id="fecha" class="form-control" placeholder="Fecha">
                    </div>
                    <div class="col-md-5 text-center">
                        <label for="entrada" class="form-label">Coste entrada</label>
                    </div>
                    <div class="col-md-7">
                        <input type="number" id="entrada" class="form-control" placeholder="Entrada">
                    </div>
                    <div class="col-md-5 text-center">
                        <label for="cartel" class="form-label">Cartel</label>
                    </div>
                    <div class="col-md-7 mb-3">
                        <input type="text" id="cartel" class="form-control" placeholder="Cartel">
                    </div>
                    <div class="modal-footer mx-auto">
                        <button type="button" id="formSocio" onclick="addTorneo()" class="btn btn-outline-primary" data-bs-dismiss="modal">Añadir Torneo</button>
                        <button type="submit" id="limpiar" class="btn btn-outline-success">Limpiar campos</button>
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- fin Modal -->





<script>
    var fechaContador = "<?php echo $fechaModificada ?>";
    // document.write(fechaContador);

    document.addEventListener('DOMContentLoaded', () => {

        //===
        // VARIABLES
        //===
        const DATE_TARGET = new Date(fechaContador + ' ' + '10:00 AM');
        // DOM for render
        const SPAN_dias = document.querySelector('p#dias');
        const SPAN_horas = document.querySelector('p#horas');
        const SPAN_minutos = document.querySelector('p#minutos');
        const SPAN_segundos = document.querySelector('p#segundos');
        // Millisegundos for the calculations
        const MILLIsegundos_OF_A_SECOND = 1000;
        const MILLIsegundos_OF_A_MINUTE = MILLIsegundos_OF_A_SECOND * 60;
        const MILLIsegundos_OF_A_HOUR = MILLIsegundos_OF_A_MINUTE * 60;
        const MILLIsegundos_OF_A_DAY = MILLIsegundos_OF_A_HOUR * 24

        //===
        // FUNCTIONS
        //===

        /**
         * Method that updates the countdown and the sample
         */
        function updateCountdown() {
            // Calcs
            const NOW = new Date()
            const DURATION = DATE_TARGET - NOW;
            const REMAINING_dias = Math.floor(DURATION / MILLIsegundos_OF_A_DAY);
            const REMAINING_horas = Math.floor((DURATION % MILLIsegundos_OF_A_DAY) / MILLIsegundos_OF_A_HOUR);
            const REMAINING_minutos = Math.floor((DURATION % MILLIsegundos_OF_A_HOUR) / MILLIsegundos_OF_A_MINUTE);
            const REMAINING_segundos = Math.floor((DURATION % MILLIsegundos_OF_A_MINUTE) / MILLIsegundos_OF_A_SECOND);

            // Render
            SPAN_dias.textContent = REMAINING_dias;
            SPAN_horas.textContent = REMAINING_horas;
            SPAN_minutos.textContent = REMAINING_minutos;
            SPAN_segundos.textContent = REMAINING_segundos;
        }

        //===
        // INIT
        //===
        updateCountdown();
        // Refresh every second
        setInterval(updateCountdown, MILLIsegundos_OF_A_SECOND);
    });
</script>


<script>
    // limpiar campos
    $(document).ready(function() {
        $("#limpiar, #nuevoSocio2").click(function() {
            $("#nombre, #ape1, #actividad, #participantes, #fecha, #entrada, #cartel").val("");
        });
    });

    function addTorneo() {

        var nombre = document.getElementById("nombre").value;
        var ape1 = document.getElementById("ape1").value;
        var actividad = document.getElementById("actividad").value;
        var participantes = document.getElementById("participantes").value;
        var fecha = document.getElementById("fecha").value;
        var entrada = document.getElementById("entrada").value;
        var cartel = document.getElementById("cartel").value;
        

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById('tablaTorneo').innerHTML = this.responseText;
                $(document).ready(function() {
                    // $("#tablaTorneo").hide();
                    $("#modalNuevoTorneo").modal("show");
                });
            }
        };
        xhttp.open("POST", "funciones/funNuevoTorneo.php?nombre=" + nombre + "&ape1=" + ape1 + "&actividad=" + actividad + 
            "&participantes=" + participantes + "&fecha=" + fecha + "&entrada=" + entrada + "&cartel=" + cartel , true);
        xhttp.send();
    }
</script>