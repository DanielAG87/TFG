<?php
include "headerV2.php";
include_once "conectarBBDD.php";


$con = conectarBD();

$ingresos = mysqli_query($con, 'SELECT SUM(cantidad) as  ingresos From movimientos WHERE tipo_gasto = "ingreso";');
$gastos = mysqli_query($con, 'SELECT SUM(cantidad) as gastos From movimientos WHERE tipo_gasto = "gasto";');
$donaciones = mysqli_query($con, 'SELECT COUNT(id_movimiento) as donaciones from movimientos where tipo_gasto = "donacion";');


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


<div class="container-fluid" id="saldo">
    <div class="row"> <!-- ocultar este row y añadir el nuevo con los datos actualizados -->
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
</div>

<div id="actualizacion"></div>

<div class="container">
    <fieldset>
        <legend>Nuevo movimiento</legend>

        <input type="text" id="nombre" class="form-control" placeholder="Nombre" />
        <input type="text" id="ape1" class="form-control" placeholder="Apellido" />
        <select class="form-select " id="tipoMovimiento">
            <option disabled selected>Selecciona una opción</option>
            <option>Ingreso</option>
            <option>Gasto</option>
            <option>Donación</option>
        </select>
        <input type="number" id="cantidad" class="form-control" placeholder="Cantidad" />
        <input type="text" id="concepto" class="form-control" placeholder="Concepto" />
        <input type="date" id="fecha" class="form-control" placeholder="Fecha" />
        <br />
        <button type="button" id="" class="btn btn-outline-primary" onclick="movimiento()">Hacer movimiento</button>
        <button type="submit" id="limpiar" class="btn btn-outline-primary">Limpiar campos</button>

    </fieldset>
</div>



<div id="azul">
    <div class="container-fluid" id="footer">
        <footer class="py-3 my-4">
            <ul class="nav justify-content-center border-bottom pb-3 mb-3">
                <li class="nav-item"><a href="index.php" class="nav-link px-2  text-white">Inicio</a></li>
                <li class="nav-item"><a href="socios.php" class="nav-link px-2 text-white">Socios</a></li>
                <li class="nav-item"><a href="pag2.html" class="nav-link px-2 text-white">Inventario</a></li>
                <li class="nav-item"><a href="pag3.html" class="nav-link px-2 text-white">Contabilidad</a></li>
                <li class="nav-item"><a href="pag3.html" class="nav-link px-2 text-white">Agenda</a></li>
            </ul>
            <p class="text-center text-white">© 2023-2025 Daniel Agustín Arroyo</p>
        </footer>
    </div>
</div>
</body>

</html>


<script>
    function movimiento() {

        var nombre = document.getElementById("nombre").value;
        var ape1 = document.getElementById("ape1").value;
        var tipoMovimiento = document.getElementById("tipoMovimiento").value;
        var cantidad = document.getElementById("cantidad").value;
        var concepto = document.getElementById("concepto").value;
        var fecha = document.getElementById("fecha").value;

        document.getElementById("saldo").style.display = "none";



        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById('actualizacion').innerHTML = this.responseText;
            }
        };
        xhttp.open("POST", "funciones/nuevoMovimiento.php?nombre=" + nombre + "&ape1=" + ape1 + "&tipoMovimiento=" + tipoMovimiento +
            "&cantidad=" + cantidad + "&concepto=" + concepto + "&fecha=" + fecha, true);
        xhttp.send();
    }
</script>

<script>
    $(document).ready(function() {

        // codigo para limpiar los campos de los imput
        $(document).ready(function() {
            $("#limpiar").click(function() {
                $("#nombre, #ape1, #cantidad, #concepto, #fecha").val("");
                $("#tipoMovimiento").prop("selectedIndex", 0);

            });
        });
    });
</script>