<?php
include "headerV2.php";
include_once "conectarBBDD.php";

$con = conectarBD();

$cuentas = mysqli_query(
    $con,
    'SELECT m.id_movimiento, s.nombre, s.apellido1, m.cantidad, m.concepto, m.fecha_movimiento, m.tipo_gasto 
    FROM movimientos m 
    JOIN socios s WHERE m.id_socio = s.id_socio;'
); ?>

<h3 class="text-center h3 text-primary vikingo">Contabilidad</h3>

<div class="container-fluid mb-3">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-center">
                <button type="button" class="btn btn-outline-primary " id="btnContabilidad" data-bs-toggle="modal" data-bs-target="#modalFiltrar">Filtrar</button>
                <button type="button" class="btn btn-outline-danger mr-5" id="btnContabilidad" onclick="quitarFiltros()">Quitar Filtro</button>
                <div class="spacer"></div>
                <form method="post" action="nuevoMovimiento.php">
                    <input type="submit" class="btn btn-outline-success" id="btnContabilidad" value="Nuevo movimiento" />
                </form>
                <form method="post" action="graficaDinero.php">
                    <button type="submit" class="btn btn-outline-primary" id="btnContabilidad" id="btnGrafica">Ver gráfica</button>
                </form>
            </div>
        </div>
    </div>
</div>



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
                    <button style="border: none;" onclick="ordenar('btnGastoA')"><i class="bi bi-sort-alpha-down"></i></button>
                    <button style="border: none;" onclick="ordenar('btnGastoZ')"><i class="bi bi-sort-alpha-up-alt"></i></button>
                </span>
            </th>
        </tr>
        <tr>
            <?php $i = 0;
            while ($row = mysqli_fetch_assoc($cuentas)) {
                $fechaFormateada = date("d-m-Y", strtotime($row["fecha_movimiento"])); ?>
                <td><?= $row["id_movimiento"] ?></td>
                <td><?= $row["nombre"] ?></td>
                <td><?= $row["apellido1"] ?></td>
                <td><?= $row["cantidad"] ?></td>
                <td><?= $row["concepto"] ?></td>
                <td><?= $fechaFormateada ?></td>
                <td><?= $row["tipo_gasto"] ?></td>
        </tr>
    <?php $i++;
            } ?>
    </table>
</div>

<?php include("footer.php"); ?>


<!-- Modal Filtrar -->
<div class="modal fade" id="modalFiltrar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title mx-auto" id="exampleModalLabel">Filtrar</h5>
            </div>
            <div class="modal-body mx-auto">
                <div class="row">
                    <div class="col-md-5 text-center">
                        <label for="nombre" class="form-label">Filtro</label>
                    </div>
                    <div class="col-md-7">
                        <select id="selectOpcion" class="form-select" aria-label="Default select example">
                            <option disabled selected>Filtrar por...</option>
                            <option>Nombre</option>
                            <option>Cantidad</option>
                            <option>Fecha</option>
                        </select>
                    </div>

                    <div class="col-md-5 text-center">
                        <label for="nombre" class="form-label">Valor</label>
                    </div>
                    <div class="col-md-7">
                        <input type="text" id="valor" class="form-control" placeholder="Nombre">
                    </div>

                    <div class="col-md-5 text-center">
                        <label for="nombre" class="form-label">Orden</label>
                    </div>
                    <div class="col-md-7">
                        <select id="orden" class="form-select" aria-label="Default select example">
                            <option disabled selected>Ordenar por...</option>
                            <option>Ascendente</option>
                            <option>Descendente</option>  
                        </select>
                    </div>
                    <div class="modal-footer mx-auto">
                        <button type="button" id="formSocio" onclick="filtrar()" class="btn btn-outline-primary" data-bs-dismiss="modal">Aplicar filtro</button>
                        <!-- <button type="submit" id="limpiar" class="btn btn-outline-success">Limpiar campos</button> -->
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- fin Modal -->


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
        
        var selOpcion = document.getElementById("selectOpcion").value;
        var selValor = document.getElementById("valor").value;
        var selorden = document.getElementById("orden").value;
        $(document).ready(function() {
            $("#tablaFull").hide();
            $("#modalFiltrar").click(function() {
                    $("#valor").val("");
                    $("#selectOpcion, #orden").prop("selectedIndex", 0);
                });
        });

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById('ordenTabla').innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "funciones/filtrar.php?selOpcion=" + selOpcion + "&selValor=" + selValor + "&selorden=" + selorden, true);
        xhttp.send();
    }
    
    function quitarFiltros(){
        location.reload();
    }
</script>