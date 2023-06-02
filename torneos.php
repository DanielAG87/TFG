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
    FROM torneos t JOIN socios s ON t.organizador1 = s.id_socio ORDER BY t.fecha');

mysqli_close($con);
?>
<h3 class="text-center">Próximo evento: <?=$proximaActividad?></h3>

<!-- Contador regresivo -->
<div id="bodyCrono" class="mb-5">
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
    


<h3 class="text-center">Eventos Runeros</h3><br>



<div class="container-fluid" id="tablaJuegos">

    <div class="row">
        <?php
        foreach ($torneos as $j) {
        ?>
        <div class="col-sm-12 col-md-4 text-center mb-3"> 
            <img style="width: 400px; height: 400px; max-width:max-content; max-height:max-content" src="<?= $j['cartel'] ?>" /><br />
            <span class="fs-5">Num Participantes: <?= $j['num_participantes'] ?></span><br />
            <span class="fs-5">Fecha: <?= $j['fecha'] ?></span><br />
            <span class="fs-5">Entrada: <?= $j['coste_entrada'] ?> Eurazos</span><br />
            <span class="fs-5">Organizador <?= $j['nombre'] . " " . $j['apellido1'] ?></span><br />
            <span class="fs-5">Inscripción: <?= $j['correo'] ?></span><br />
            <span class="fs-5">Telefono: <?= $j['telefono'] ?></span>
        </div>
            <!-- <div class=" col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2 col-xxl-2 text-center mb-3"> -->
        <?php } ?>

    </div>
</div>











    <?php  include("footer.php"); ?>

    <script>
        var fechaContador = "<?php echo $fechaModificada?>";
        // document.write(fechaContador);
    
      document.addEventListener('DOMContentLoaded', () => { 

        //===
        // VARIABLES
        //===
        const DATE_TARGET = new Date(fechaContador + ' ' +'09:00 PM');
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
            // Thanks Pablo Monteserín (https://pablomonteserin.com/cuenta-regresiva/)

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




