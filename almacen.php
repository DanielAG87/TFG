<?php 
include "headerV2.php";
include_once "conectarBBDD.php";

$con = conectarBD();

$almacen = mysqli_query(
    $con,
    'SELECT i.*, s.nombre, s.apellido1 
     FROM inventario i 
     JOIN socios s on i.comprador = s.id_socio'
);

mysqli_close($con);
?>

<h3 class="text-center h3 text-primary">Almacén</h3>

<div class="container-fluid" id="tablaPrincipal2">
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered border-primary text-center">
                <tr>
                    <th>Objeto</th>
                    <th>Utilidad</th>
                    <th>Stock</th>
                    <th>Coste/€</th>
                    <th>Marca</th>
                    <th>Comprador</th>
                    <th>Observaciones</th>
                    <th>Medidas</th>
                </tr>
                <tr>
                    <?php
                    while ($row = mysqli_fetch_assoc($almacen)) { ?>
                        <td><?= $row["tipo"] ?></td>
                        <td><?= $row["utilidad"] ?></td>
                        <td><?= $row["cantidad"] ?></td>
                        <td><?= $row["coste"] ?></td>
                        <td><?= $row["marca"] ?></td>
                        <td><?= $row["nombre"] . " " . $row["apellido1"] ?></td>
                        <td><?= $row["observaciones"] ?></td>
                        <td><?= $row["medidas"] ?></td>
                </tr>
            <?php 
                    } ?>
            </table>
        </div>
    </div>
    <?php include "footer.php"; ?>