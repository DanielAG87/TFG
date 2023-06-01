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

<form method="post" action="contabilidad.php">
    <input type="submit" class="btn btn-outline-primary" value="Volver"/>
</form>




<!-- <div class="container-fluid" id="saldo">
    <div class="row"> 
        <p>Los ingresos totales de la asociación en 2023 son de : <span style="color: green;"><?= $ingresoTotal ?></span> €</p>
        <p>El gasto total de la asociación en 2023 es: <span style="color: red;"><?= $gastoTotal ?></span> €</p>
        <p>Las donaciones que se han realizado a la asociación en 2023 han sido de: <?= $donacionesTotales ?></p>
        <p>EL saldo actual de la asociacion es de: <strong> <?php
                                                            if ($saldo < 0) {
                                                                echo '<span style="color: red;">' . $saldo . '</span>';
                                                            } else {
                                                                echo '<span style="color: green;">' . $saldo . '</span>';
                                                            }
                                                            ?></strong> €</p>
    </div>
</div> -->




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
        backgroundColor: [
            'rgba(0, 255, 0, 1)',
            'rgba(240, 128, 128, 1)',


        ], // Color de fondo
        borderColor: [
            'rgba(50, 205, 50, 1)',
            'rgba(255, 0, 0, 1)',

        ], // Color del borde
        borderWidth: 2, // Ancho del borde
    };
    new Chart($grafica, {
        type: 'pie', // Tipo de gráfica. Puede ser dougnhut o pie
        data: {
            labels: etiquetas,
            datasets: [
                datosIngresos,
                // Aquí más datos...
            ]
        },
    });
</script>