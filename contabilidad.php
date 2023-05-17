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
    <input type="submit" class="btn btn-outline-primary mb-5" value="Nuevo movimiento" />
</form>

<select>
    <option></option>
</select>
<button type="button" class="btn btn-outline-primary" onclick="">Filtrar</button>

<div class="container-fluid" id="ordenTabla"></div>

<div class="container-fluid" id="tablaFull">

    <table class="table table-striped table-hover table-bordered text-center" id="tablaPrincipal">
        <tr>
            <th>
                <span class="sortable-header">
                    ID Movimiento
                    <button style="border: none;" onclick="ordenar('btnMoviA')"><i class="fa-solid fa-arrow-down-1-9"></i></button> <!-- Me quedo aquí buscando los iconos adecuados -->
                    <button style="border: none;" onclick="ordenar('btnMoviZ')"><i class="fa-solid fa-arrow-up-9-1 "></i></button>
                </span>
            </th>
            <th>
                <span class="sortable-header">
                    Nombre
                    <button style="border: none;" onclick="ordenar('btnNombreA')"><i  class="fa-solid fa-arrow-down-a-z"></i></button> <!-- Me quedo aquí buscando los iconos adecuados -->
                    <button style="border: none;" onclick="ordenar('btnNombreZ')"><i class="fa-solid fa-arrow-up-z-a"></i></button>
                </span>
            </th>
            <th>
                <span class="sortable-header">
                    Primer Apellido
                    <button style="border: none;" onclick="ordenar('btnApeA')"><i class="fa-solid fa-arrow-down-a-z"></i></button> <!-- Me quedo aquí buscando los iconos adecuados -->
                    <button style="border: none;" onclick="ordenar('btnApeZ')"> <i class="fa-solid fa-arrow-up-z-a"></i></button>
                </span>
            </th>
            <th>
                <span class="sortable-header">
                    Cantidad
                    <button style="border: none;" onclick="ordenar('btnCantA')"><i class="fa-solid fa-arrow-down-1-9 "></i></i></button> <!-- Me quedo aquí buscando los iconos adecuados -->
                    <button style="border: none;" onclick="ordenar('btnCantZ')"><i class="fa-solid fa-arrow-up-9-1 "></i></button>
                </span>
            </th>

            <th>
                <span class="sortable-header">
                    Concepto
                    <button style="border: none;" onclick="ordenar('btnConceptoA')"><i class="fa-solid fa-arrow-down-a-z"></i></button> <!-- Me quedo aquí buscando los iconos adecuados -->
                    <button style="border: none;" onclick="ordenar('btnConceptoZ')"><i class="fa-solid fa-arrow-up-z-a"></i></button>
                </span>
            </th>
            <th>
                <span class="sortable-header">
                    Fecha Movimiento
                    <button style="border: none;" onclick="ordenar('btnFechaA')"><i class="fa-solid fa-arrow-down-1-9"></i></button> <!-- Me quedo aquí buscando los iconos adecuados -->
                    <button style="border: none;" onclick="ordenar('btnFechaZ')"><i class="fa-solid fa-arrow-up-9-1"></i></button>
                </span>
            </th>
            <th>
                <span class="sortable-header">
                    Tipo Gasto
                    <button style="border: none;" onclick="ordenar('btnGastoA')" ><i class="fa-solid fa-arrow-down-a-z"></i></button> <!-- Me quedo aquí buscando los iconos adecuados -->
                    <button style="border: none;" onclick="ordenar('btnGastoZ')" ><i class="fa-solid fa-arrow-up-z-a"></i></button>
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
</script>