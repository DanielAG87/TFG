<?php
include "headerV2.php";
include_once "conectarBBDD.php";

$con = conectarBD();

$socios = mysqli_query($con, 'SELECT * FROM socios');
// desconectarBD($con);
if (empty($_REQUEST) || !empty($_REQUEST['vovler1'])) {
?>


    <div class="container-fluid" id="tablaPrincipal1">
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
                <button class="btn btn-outline-primary" id="btnTabla" onclick="buscarSocio()">Buscar socio</button>
            </div>
            <div class="col-md-2">
                <!-- <form method="post" action="nuevoSocio.php">
                    <button class="btn btn-outline-primary" type="submit" name="nuevoSocio">Añadir socio</button>
                </form> -->
                <button class="btn btn-outline-primary" type="submit" name="nuevoSocio" id="nuevoSocio2" data-bs-toggle="modal" data-bs-target="#nuevoSocio">Nuevo socio</button>
                
            </div>
        </div>
    </div>

    <div id="resulBusqueda"></div>
    <div id="resulBorrar"></div>
    <div id="result"></div>

    <div class="container-fluid" id="tablaPrincipal2">
        <!-- <form method="get" action="socios.php"> -->
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered text-center">
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
                    <?php //$i = 0;
                    while ($row = mysqli_fetch_assoc($socios)) { ?>
                        <td><?= $row['id_socio'] ?></td>
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
                            <input type="submit" class="btn btn-outline-primary" name="selec" value="Seleccionar" onclick="selSocio('<?= $row['id_socio'] ?>'); window.scrollTo({ top: 0, behavior: 'smooth' });" />
                        </td>
                </tr>
            <?php //$i++;
                    } ?>
            </table>
        </div>
    </div>
<?php } ?>





<div class="modal fade" id="nuevoSocio" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title mx-auto" id="exampleModalLabel">Nuevo Socio/a</h5>
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
            </div>
            <div class="modal-body mx-auto">
                <div class="row">
                    <div class="col-md-5 text-center">
                        <label for="nombre" class="form-label">Nombre</label>
                    </div>
                    <div class="col-md-7">
                        <input type="text" id="nombre" class="form-control" placeholder="Nombre">
                    </div>
                    <div class="col-md-5 text-center">
                        <label for="nombre" class="form-label">Primer Apellido</label>
                    </div>
                    <div class="col-md-7">
                        <input type="text" id="ape1" class="form-control" placeholder="Primer Apellido">
                    </div>
                    <div class="col-md-5 text-center">
                        <label for="nombre" class="form-label">Segundo Apellido</label>
                    </div>
                    <div class="col-md-7">
                        <input type="text" id="ape2" class="form-control" placeholder="Segundo Apellido">
                    </div>
                    <div class="col-md-5 text-center">
                        <label for="nombre" class="form-label">Correo</label>
                    </div>
                    <div class="col-md-7">
                        <input type="mail" id="correo" class="form-control" placeholder="asociacionRunaBlanca@gmail.com">
                    </div>
                    <div class="col-md-5 text-center">
                        <label for="nombre" class="form-label">Teléfono</label>
                    </div>
                    <div class="col-md-7">
                        <input type="text" id="tel" class="form-control" placeholder="Teléfono">
                    </div>
                    <div class="col-md-5 text-center">
                        <label for="nombre" class="form-label">Localidad</label>
                    </div>
                    <div class="col-md-7">
                        <input type="text" id="loca" class="form-control" placeholder="Localidad">
                    </div>
                    <div class="col-md-5 text-center">
                        <label for="nombre" class="form-label">Fecha de nacimiento</label>
                    </div>
                    <div class="col-md-7">
                        <input type="date" id="fechaNac" class="form-control" placeholder="Fecha de nacimiento">
                    </div>
                    <div class="col-md-5 text-center">
                        <label for="nombre" class="form-label">Contraseña</label>
                    </div>
                    <div class="col-md-7">
                        <input type="password" id="contra" class="form-control" placeholder="Contraseña">
                    </div>
                    <div class="col-md-5 text-center">
                        <label for="nombre" class="form-label">Permiso</label>
                    </div>
                    <div class="col-md-7">
                        <select id="permiso" class="form-select ">
                            <option disabled selected>Selecciona una opción</option>
                            <option>Si</option>
                            <option>No</option>
                        </select>
                    </div>
                    <div class="modal-footer mx-auto">
                    <button type="button" id="formSocio" onclick="addSocio()" class="btn btn-outline-primary" data-bs-dismiss="modal">Añadir Socio</button> 
                    <button type="submit" id="limpiar" class="btn btn-outline-primary">Limpiar campos</button>
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function addSocio() {

        var nombre = document.getElementById("nombre").value;
        var ape1 = document.getElementById("ape1").value;
        var ape2 = document.getElementById("ape2").value;
        var correo = document.getElementById("correo").value;
        var tel = document.getElementById("tel").value;
        var loca = document.getElementById("loca").value;
        var fechaNac = document.getElementById("fechaNac").value;
        var contra = document.getElementById("contra").value;
        var permiso = document.getElementById("permiso").value;



        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById('result').innerHTML = this.responseText;
                $(document).ready(function() {
                    $("#modalNuevoSocio").modal("show");
                });
            }
        };
        xhttp.open("POST", "funciones/funNuevoSocio.php?nombre=" + nombre + "&ape1=" + ape1 + "&ape2=" + ape2 + "&correo=" + correo + "&tel=" + tel +
            "&loca=" + loca + "&fechaNac=" + fechaNac + "&contra=" + contra + "&permiso=" + permiso, true);
        xhttp.send();
    }

    // codigo para limpiar los campos de los imput 
    $(document).ready(function() {
        $(document).ready(function() {
            $("#limpiar, #nuevoSocio2").click(function() {
                $("#nombre, #ape1, #ape2, #correo, #tel, #loca, #fechaNac, #contra").val("");
                $("#permiso").prop("selectedIndex", 0);

            });
        });
    });
</script>





















<!-- funcion para la busqueda de los socios -->
<script>
    function buscarSocio() {
        var nombreSel = document.getElementById("nomBusqueda").value;
        var apellidoSel = document.getElementById("apeBusqueda").value;



        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById('resulBusqueda').innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "funciones/buscarSocio.php?nombreSel=" + nombreSel + "&apellidoSel=" + apellidoSel, true);
        xhttp.send();
    }




    // funcion para la modificacion o eliminacion de los socios 

    function selSocio(idSocio) {
        // var idSocio = document.getElementById("pruSocio").value;
        $(document).ready(function() {
            // $("#tablaPrincipal1").hide();
            // $("#tablaPrincipal2").hide();
        });

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById('resulBusqueda').innerHTML = this.responseText;
                $(document).ready(function() {
                    $("#actualizarSocio").modal("show");
                });
            }
        };
        xhttp.open("POST", "funciones/seleccionarSocioV2.php?idSocio=" + idSocio, true);
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

    function borrar() {
        var idSocio = document.getElementById("idSoci1").value;

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById('funBorrar').innerHTML = this.responseText;
            }
        };
        xhttp.open("POST", "funciones/borrar.php?idSocio=" + idSocio, true);
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


<?php include("footer.php"); ?>