<?php
include "headerV2.php";
include_once "conectarBBDD.php";

$con = conectarBD();

$socios = mysqli_query($con, 'SELECT * FROM socios');
// desconectarBD($con);
if (empty($_REQUEST) || !empty($_REQUEST['vovler1'])) {
?>


    <div class="container-fluid" id="tablaPrincipal">
        <div class="row">
            <div class="col-md-3">
                <input type="text" id="nomBusqueda" class="form-control" placeholder="Nombre" />
            </div>
            <div class="col-md-3 mb-3">
                <input type="text" id="apeBusqueda" class="form-control" placeholder="Apellido" />
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-2">
                <button class="btn btn-outline-primary" id="btnTabla" onclick="consulSocio()">Buscar socio</button>
            </div>
            <div class="col-md-2">
                <form method="post" action="nuevoSocio.php">
                    <button class="btn btn-outline-primary" type="submit" name="nuevoSocio">Añadir socio</button>
                </form>
            </div>
        </div>
    </div>

    <div id="resulBusqueda"></div>
    <div id="resulBorrar"></div>

    <div class="container-fluid">
        <!-- <form method="get" action="socios.php"> -->
        <table class="table table-striped table-hover table-bordered text-center" id="tablaPrincipal">
            <tr>
                <th>ID Socio</th>
                <th>Nombre</th>
                <th>Primer apellido</th>
                <th>Segundo apellido</th>
                <th>Correo</th>
                <th>Teléfono</th>
                <th>Localidad</th>
                <th>Fecha de Nacimiento</th>
                <th>Contraseña</th>
                <th>Permiso</th>
                <th></th>

            </tr>
            <tr>
                <?php $i = 0;
                while ($row = mysqli_fetch_assoc($socios)) { ?>
                    <td><input type="text" readonly id="pruSocio<?= $i ?>" value="<?= $row['id_socio'] ?>" /></td>
                    <td><?= $row["nombre"] ?></td>
                    <td><?= $row["apellido1"] ?></td>
                    <td><?= $row["apellido2"] ?></td>
                    <td><?= $row["correo"] ?></td>
                    <td><?= $row["telefono"] ?></td>
                    <td><?= $row["localidad"] ?></td>
                    <td><?= $row["fecha_nacimiento"] ?></td>
                    <td><?= $row["contrasenia"] ?></td>
                    <td><?= $row["permiso"] ?></td>
                    <td>
                        <input type="submit" class="btn btn-outline-primary" name="selec" value="Seleccionar" onclick="addDel('<?= $row['id_socio'] ?>'); window.scrollTo({ top: 0, behavior: 'smooth' });" />
                    </td>
            </tr>
        <?php $i++;
                } ?>
        </table>
    </div>


<?php } ?>
<!-- funcion para la busqueda de los socios -->
<script>
    function consulSocio() {
        var nombreSel = document.getElementById("nomBusqueda").value;
        var apellidoSel = document.getElementById("apeBusqueda").value;



        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById('resulBusqueda').innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "funciones/consulSocio.php?nombreSel=" + nombreSel + "&apellidoSel=" + apellidoSel, true);
        xhttp.send();
    }
</script>



<!-- funcion para la modificacion o eliminacion de los socios -->
<script>
    function addDel(idSocio) {
        // var idSocio = document.getElementById("pruSocio").value;

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById('resulBusqueda').innerHTML = this.responseText;
            }
        };
        xhttp.open("POST", "funciones/modificarEliminar.php?idSocio=" + idSocio, true);
        xhttp.send();
    }

    function borrar() {
        var idSocio = document.getElementById("id_socio").value;

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById('funBorrar').innerHTML = this.responseText;
            }
        };
        xhttp.open("POST", "funciones/borrar.php?idSocio=" + idSocio, true);
        xhttp.send();
    }



    function actualizar() {
        var idSocio = document.getElementById("idSoci1").value;
        var nomSoci = document.getElementById("nomSoci").value;
        var ape1Soci = document.getElementById("ape1Soci").value;
        var ape2Soci = document.getElementById("ape2Soci").value;
        var correoSoci = document.getElementById("correoSoci").value;
        var telSoci = document.getElementById("telSoci").value;
        var localidadSoci = document.getElementById("localidadSoci").value;
        var fechaSoci = document.getElementById("fechaSoci").value;
        var contraSoci = document.getElementById("contraSoci").value;
        var premisoSoci = document.getElementById("premisoSoci").value;


        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById('funBorrar').innerHTML = this.responseText;
            }
        };
        xhttp.open("POST", "funciones/actualizarSocio.php?idSocio=" + idSocio + "&nomSoci=" + nomSoci + "&ape1Soci=" + ape1Soci +
            "&ape2Soci=" + ape2Soci + "&correoSoci=" + correoSoci + "&telSoci=" + telSoci + "&localidadSoci=" + localidadSoci +
            "&fechaSoci=" + fechaSoci + "&contraSoci=" + contraSoci + "&premisoSoci=" + premisoSoci, true);
        xhttp.send();
    }
</script>






<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
<script src="./js.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $("#btnTabla").click(function() {
            $('#tablaPrincipal').hide();
        });

    });
</script>


<?php  include("footer.php"); ?>

