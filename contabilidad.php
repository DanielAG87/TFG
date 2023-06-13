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
                <button type="button" class="btn btn-outline-danger" onclick="pdf()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-pdf" viewBox="0 0 16 16">
                        <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"></path>
                        <path d="M4.603 14.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.697 19.697 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.188-.012.396-.047.614-.084.51-.27 1.134-.52 1.794a10.954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.066.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.712 5.712 0 0 1-.911-.95 11.651 11.651 0 0 0-1.997.406 11.307 11.307 0 0 1-1.02 1.51c-.292.35-.609.656-.927.787a.793.793 0 0 1-.58.029zm1.379-1.901c-.166.076-.32.156-.459.238-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361.01.022.02.036.026.044a.266.266 0 0 0 .035-.012c.137-.056.355-.235.635-.572a8.18 8.18 0 0 0 .45-.606zm1.64-1.33a12.71 12.71 0 0 1 1.01-.193 11.744 11.744 0 0 1-.51-.858 20.801 20.801 0 0 1-.5 1.05zm2.446.45c.15.163.296.3.435.41.24.19.407.253.498.256a.107.107 0 0 0 .07-.015.307.307 0 0 0 .094-.125.436.436 0 0 0 .059-.2.095.095 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a3.876 3.876 0 0 0-.612-.053zM8.078 7.8a6.7 6.7 0 0 0 .2-.828c.031-.188.043-.343.038-.465a.613.613 0 0 0-.032-.198.517.517 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822.024.111.054.227.09.346z"></path>
                    </svg>
                PDF
              </button>
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

    function pdf(){
    window.location.href = 'pdf.php';
  }
</script>