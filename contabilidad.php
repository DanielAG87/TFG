<?php
include "headerV2.php";
include_once "conectarBBDD.php";

$con = conectarBD();

$cuentas = mysqli_query(
    $con,
    'SELECT m.id_movimiento, s.nombre, s.apellido1, m.cantidad, m.concepto, m.fecha_movimiento, m.tipo_gasto 
    FROM movimientos m 
    JOIN socios s WHERE m.id_socio = s.id_socio;'
); 


?>

<form method="post" action="nuevoMovimiento.php">
    <input type="submit" class="btn btn-outline-primary mb-5" value="Nuevo movimiento"/>
</form>

<form method="post" action="graficaDinero.php">
    <button type="submit" class="btn btn-outline-primary" id="btnGrafica" >Ver gráfica</button> 
</form>




<select id="selBuscador">
    <option disabled selected>Selecciona una opción</option>
    <option>Nombre</option>
    <option>Cantidad</option>
    <option>Fecha</option>
</select>
<input type="text" id="buscador" name="buscador" placeholder="Introduce dato"/>
<button type="button" class="btn btn-outline-primary" onclick="filtrar()">Filtrar</button>

<div class="container-fluid" id="ordenTabla"></div>

<div class="container-fluid" id="tablaFull">

    <table class="table table-striped table-hover table-bordered text-center" id="tablaPrincipal">
        <tr>
            <th>
                <span class="sortable-header">
                    ID Movimiento
                    <button style="border: none;" onclick="ordenar('btnMoviA')"><i class="bi bi-sort-numeric-down"></i></button> 
                    <button style="border: none;" onclick="ordenar('btnMoviZ')"><i class="bi bi-sort-numeric-up-alt"></i></button>
                </span>
            </th>
            <th>
                <span class="sortable-header">
                    Nombre
                    <button style="border: none;" onclick="ordenar('btnNombreA')"><i class="bi bi-sort-alpha-down"></i></button> 
                    <button style="border: none;" onclick="ordenar('btnNombreZ')"><i class="bi bi-sort-alpha-up-alt"></i></button>
                </span>
            </th>
            <th>
                <span class="sortable-header">
                    Primer Apellido
                    <button style="border: none;" onclick="ordenar('btnApeA')"><i class="bi bi-sort-alpha-down"></i></button> 
                    <button style="border: none;" onclick="ordenar('btnApeZ')"><i class="bi bi-sort-alpha-up-alt"></i></button>
                </span>
            </th>
            <th>
                <span class="sortable-header">
                    Cantidad
                    <button style="border: none;" onclick="ordenar('btnCantA')"><i class="bi bi-sort-numeric-down"></i></button> 
                    <button style="border: none;" onclick="ordenar('btnCantZ')"><i class="bi bi-sort-numeric-up-alt"></i></button>
                </span>
            </th>

            <th>
                <span class="sortable-header">
                    Concepto
                    <button style="border: none;" onclick="ordenar('btnConceptoA')"><i class="bi bi-sort-alpha-down"></i></button> 
                    <button style="border: none;" onclick="ordenar('btnConceptoZ')"><i class="bi bi-sort-alpha-up-alt"></i></button>
                </span>
            </th>
            <th>
                <span class="sortable-header">
                    Fecha Movimiento
                    <button style="border: none;" onclick="ordenar('btnFechaA')"><i class="bi bi-sort-numeric-down"></i></button> 
                    <button style="border: none;" onclick="ordenar('btnFechaZ')"><i class="bi bi-sort-numeric-up-alt"></i></button>
                </span>
            </th>
            <th>
                <span class="sortable-header">
                    Tipo Gasto
                    <button style="border: none;" onclick="ordenar('btnGastoA')" ><i class="bi bi-sort-alpha-down"></i></button> 
                    <button style="border: none;" onclick="ordenar('btnGastoZ')" ><i class="bi bi-sort-alpha-up-alt"></i></button>
                </span>
            </th>
        </tr>
        <tr>
            <?php $i = 0;
            while ($row = mysqli_fetch_assoc($cuentas)) { ?>
                <td><?= $row["id_movimiento"] ?></td>
                <td><?= $row["nombre"] ?></td>
                <td><?= $row["apellido1"] ?></td>
                <td><?= $row["cantidad"] ?></td>
                <td><?= $row["concepto"] ?></td>
                <td><?= $row["fecha_movimiento"] ?></td>
                <td><?= $row["tipo_gasto"] ?></td>
        </tr>
    <?php $i++;
            } ?>
    </table>
</div>

<?php  include("footer.php"); ?>



<script>
    function ordenar(btn) {
        $(document).ready(function() {
            $("#tablaFull").hide();
        });

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById('ordenTabla').innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "funciones/ordenar.php?btn=" + btn, true);
        xhttp.send();
    }


    function filtrar() {
        $(document).ready(function() {
            $("#tablaFull").hide();
        });
        var selBuscador = document.getElementById("selBuscador").value;
        var selInput = document.getElementById("buscador").value;
        

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById('ordenTabla').innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "funciones/filtrar.php?selBuscador=" + selBuscador + "&selInput=" + selInput, true);
        xhttp.send();
    }
</script>