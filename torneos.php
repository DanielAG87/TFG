
<?php 
include "headerV2.php";
include_once "conectarBBDD.php";
 $con = conectarBD();

$fecha = mysqli_query(
    $con,
    'SELECT fecha FROM torneos WHERE fecha > CURDATE()
    ORDER BY ABS(DATEDIFF(fecha, CURDATE())) LIMIT 1;'
);

$resultadofecha = mysqli_fetch_assoc($fecha);
$fechaProxima = $resultadofecha['fecha'];
mysqli_close($con);




// convertimos la fecha a lo que requiere el contador de js
$objetoFecha = date_create($fechaProxima);
$fechaModificada = date_format($objetoFecha, 'm/d/Y');

?>
    <!-- Contador regresivo -->
    <section>
        <p>
            <span id="days"></span> días / <span id="hours"></span> horas / <span id="minutes"></span> minutos / <span id="seconds"></span> segundos
        </p>
    </section> 
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
        const SPAN_DAYS = document.querySelector('span#days');
        const SPAN_HOURS = document.querySelector('span#hours');
        const SPAN_MINUTES = document.querySelector('span#minutes');
        const SPAN_SECONDS = document.querySelector('span#seconds');
        // Milliseconds for the calculations
        const MILLISECONDS_OF_A_SECOND = 1000;
        const MILLISECONDS_OF_A_MINUTE = MILLISECONDS_OF_A_SECOND * 60;
        const MILLISECONDS_OF_A_HOUR = MILLISECONDS_OF_A_MINUTE * 60;
        const MILLISECONDS_OF_A_DAY = MILLISECONDS_OF_A_HOUR * 24

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
            const REMAINING_DAYS = Math.floor(DURATION / MILLISECONDS_OF_A_DAY);
            const REMAINING_HOURS = Math.floor((DURATION % MILLISECONDS_OF_A_DAY) / MILLISECONDS_OF_A_HOUR);
            const REMAINING_MINUTES = Math.floor((DURATION % MILLISECONDS_OF_A_HOUR) / MILLISECONDS_OF_A_MINUTE);
            const REMAINING_SECONDS = Math.floor((DURATION % MILLISECONDS_OF_A_MINUTE) / MILLISECONDS_OF_A_SECOND);
            // Thanks Pablo Monteserín (https://pablomonteserin.com/cuenta-regresiva/)

            // Render
            SPAN_DAYS.textContent = REMAINING_DAYS;
            SPAN_HOURS.textContent = REMAINING_HOURS;
            SPAN_MINUTES.textContent = REMAINING_MINUTES;
            SPAN_SECONDS.textContent = REMAINING_SECONDS;
        }

        //===
        // INIT
        //===
        updateCountdown();
        // Refresh every second
        setInterval(updateCountdown, MILLISECONDS_OF_A_SECOND);
    });
    </script>




