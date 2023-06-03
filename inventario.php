<?php 
include "headerV2.php";
include_once "conectarBBDD.php";

$con = conectarBD();
$juegos = mysqli_query(
    $con,'SELECT nombre, cambio_socio FROM juegos ORDER BY cambio_socio DESC LIMIT 10'
);

$devolverJuegos = mysqli_fetch_all($juegos);
mysqli_close($con);

?>
<div class="container-fluid">
    <h1 class="text-center">Juegos más reservados</h1>
    <div class="d-flex justify-content-center">
        <div style="width: 700px;">
            <canvas id="grafica"></canvas>
        </div>
    </div>
</div>

<form method="post" action="juegos.php">
    <button type="submit" class="btn btn-outline-primary">Ver juegos</button>
</form>
<form >
    <button type="submit" class="btn btn-outline-primary">Ver Inventario</button>
</form>


<?php include "footer.php"; ?>






    <!-- GRAFICA DE BARRAS -->
<script>
    var juegos = [];
    let valor = [];

    var estadistica = <?php echo json_encode($devolverJuegos)?>;

    for (let x = 0; x < estadistica.length; x++) {
       juegos.push(estadistica[x][0]);
       valor.push(estadistica[x][1]);   
    }

 
const $grafica = document.querySelector("#grafica");
const datosVentas2020 = {
    label: "Reservas por juego",
    data: valor,
    backgroundColor: 'rgba(54, 162, 235, 0.2)', // Color de fondo
    borderColor: 'rgba(54, 162, 235, 1)', // Color del borde
    borderWidth: 2,// Ancho del borde
};

new Chart($grafica, {
    type: 'bar',// Tipo de gráfica
    data: {
        labels: juegos,
        datasets: [
            datosVentas2020,
            // Aquí más datos...
        ]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }],
        },
    }
});
</script>