
<?php 
include "headerV2.php";
include_once "conectarBBDD.php";
 $con = conectarBD();

$fecha = mysqli_query(
    $con,
    'SELECT fecha, actividad FROM torneos WHERE fecha > CURDATE()
    ORDER BY ABS(DATEDIFF(fecha, CURDATE())) LIMIT 1;'
);

$resultadofecha = mysqli_fetch_assoc($fecha);
$fechaProxima = $resultadofecha['fecha'];
$proximaActividad = $resultadofecha['actividad'];
mysqli_close($con);


// convertimos la fecha a lo que requiere el contador de js
$objetoFecha = date_create($fechaProxima);
$fechaModificada = date_format($objetoFecha, 'm/d/Y');

?>
<h2 class="text-center">Proximo evento: <?=$proximaActividad?></h2>

    <!-- Contador regresivo -->
    <div id="bodyCrono">
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




