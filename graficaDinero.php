<?php
include "headerV2.php";
include_once "conectarBBDD.php";

$con = conectarBD();

$ingresos = mysqli_query($con, 'SELECT SUM(cantidad) as  ingresos From movimientos WHERE tipo_gasto = "ingreso"');
$gastos = mysqli_query($con, 'SELECT SUM(cantidad) as gastos From movimientos WHERE tipo_gasto = "gasto"');
$donaciones = mysqli_query($con, 'SELECT COUNT(id_movimiento) as donaciones from movimientos where tipo_gasto = "donacion"');
mysqli_close($con);

// ingresos
$resultadoIngreso = mysqli_fetch_assoc($ingresos);
$ingresoTotal = round($resultadoIngreso['ingresos'], 2);
//gastos
$resultadoGasto = mysqli_fetch_assoc($gastos);
$gastoTotal = round($resultadoGasto['gastos'], 2);
//donaciones
$resultadoDonacion = mysqli_fetch_assoc($donaciones);
$donacionesTotales = $resultadoDonacion['donaciones'];

$saldo = $ingresoTotal - $gastoTotal;

?>

<div class="row">
    <div class="col-md-6 d-flex align-items-center justify-content-center">

        <div style="width: 800px;">
            <canvas id="grafica"></canvas>
        </div>
    </div>
    <div class="col-md-4 d-flex align-items-center justify-content-center">
        <div>

            <h4>Ingresos: <span style="color: green;"><?= $ingresoTotal ?></span> €</h4><br>
            <h4>Gastos: <span style="color: red;"><?= $gastoTotal ?></span> €</h4><br>
            <!-- <h4>Donaciones: <span style="color: blue;"> <?= $donacionesTotales ?></span></h4><br> -->
            <h3>Saldo actual: <strong> <?php
                                        if ($saldo < 0) {
                                            echo '<span style="color: red;">' . $saldo . '</span>';
                                        } else {
                                            echo '<span style="color: green;">' . $saldo . '</span>';
                                        }
                                        ?></strong> €</h3>
        </div>
    </div>
</div>
<div class="d-flex justify-content-center">
    <form method="post" action="contabilidad.php">
        <input type="submit" class="btn btn-outline-primary" value="Volver" />
    </form>
</div>


<!-- GRAFICA REDONDA -->

<script>
    var ingresoTotal = "<?php echo $ingresoTotal; ?>";
    var gastoTotal = "<?php echo $gastoTotal; ?>";
    var donacionesTotales = "<?php echo $donacionesTotales; ?>";

    // Obtener una referencia al elemento canvas del DOM
    const $grafica = document.querySelector("#grafica");
    // Las etiquetas son las porciones de la gráfica
    const etiquetas = ["Ingresos", "Gastos"]
    // Podemos tener varios conjuntos de datos. Comencemos con uno
    const datosIngresos = {
        data: [ingresoTotal, gastoTotal], // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
        // Ahora debería haber tantos background colors como datos, es decir, para este ejemplo, 4

        // Color de fondo
        backgroundColor: [
            'rgba(25, 229, 35, 0.7)', // verde  
            'rgba(240, 128, 128, 1)', // rojo


        ], // Color del borde
        borderColor: [
            'rgba(28, 149, 32, 1)',
            'rgba(255, 0, 0, 1)',

        ],
        borderWidth: 2, // Ancho del borde
    };
    new Chart($grafica, {
        type: 'pie', // Tipo de gráfica. Puede ser dougnhut o pie
        data: {
            labels: etiquetas,
            datasets: [
                datosIngresos,
            ]
        },
    });
</script>