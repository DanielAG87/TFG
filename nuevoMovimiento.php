<?php
include "headerV2.php";
include_once "conectarBBDD.php";


// $con = conectarBD();

// $ingresos = mysqli_query($con, 'SELECT SUM(cantidad) as  ingresos From movimientos WHERE tipo_gasto = "ingreso";');
// $gastos = mysqli_query($con, 'SELECT SUM(cantidad) as gastos From movimientos WHERE tipo_gasto = "gasto";');
// $donaciones = mysqli_query($con, 'SELECT COUNT(id_movimiento) as donaciones from movimientos where tipo_gasto = "donacion";');


// mysqli_close($con);
// // ingresos
// $resultadoIngreso = mysqli_fetch_assoc($ingresos);
// $ingresoTotal = round($resultadoIngreso['ingresos'], 2);
// //gastos
// $resultadoGasto = mysqli_fetch_assoc($gastos);
// $gastoTotal = round($resultadoGasto['gastos'], 2);
// //donaciones
// $resultadoDonacion = mysqli_fetch_assoc($donaciones);
// $donacionesTotales = $resultadoDonacion['donaciones'];

// $saldo = $ingresoTotal - $gastoTotal;

?>

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
        <div class="d-flex justify-content-center">
            <button type="button" id="" class="btn btn-outline-primary m-2 " onclick="movimiento()">Hacer movimiento</button>
            <form method="post" action="contabilidad.php">
                <button type="submit" id="vol" class="btn btn-outline-primary m-2">Volver</button>
            </form>
            <button type="submit" id="limpiar" class="btn btn-outline-primary m-2">Limpiar campos</button>
        </div>
    </fieldset>
</div>

<?php include("footer.php"); ?>

<script>
    function movimiento() {

        var nombre = document.getElementById("nombre").value;
        var ape1 = document.getElementById("ape1").value;
        var tipoMovimiento = document.getElementById("tipoMovimiento").value;
        var cantidad = document.getElementById("cantidad").value;
        var concepto = document.getElementById("concepto").value;
        var fecha = document.getElementById("fecha").value;

        // document.getElementById("saldo").style.display = "none";

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById('actualizacion').innerHTML = this.responseText;
                $(document).ready(function() {
                    $("#modalNuevoMovimiento").modal("show");
                });
            }
        };
        xhttp.open("POST", "funciones/funNuevoMovimiento.php?nombre=" + nombre + "&ape1=" + ape1 + "&tipoMovimiento=" + tipoMovimiento +
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