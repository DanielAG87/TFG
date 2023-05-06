<?php
include "headerV2.php";
include_once "conectarBBDD.php";

$con = conectarBD();

$socios = mysqli_query($con, 'SELECT * FROM socios');
// desconectarBD($conexion);
if (empty($_REQUEST)) {
?>





<div class="container-fluid" id="tablaPrincipal">

<input type="text" id="nomBusqueda" class="form-control w-25" placeholder="Nombre"/>
<input type="text" id="apeBusqueda" class="form-control w-25" placeholder="Apellido"/>
<button id="btnTabla" onclick="consulSocio()">Buscar</button>
    <!-- <form method="get" action="socios.php"> -->
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

            </tr>
            <tr>
        <?php $i = 0;
        while ($row = mysqli_fetch_assoc($socios)) { ?> 
                <td><?= $row["id_socio"] ?></td>
                <td><?= $row["nombre"] ?></td>
                <td><?= $row["apellido1"] ?></td>
                <td><?= $row["apellido2"] ?></td>
                <td><?= $row["correo"] ?></td>
                <td><?= $row["telefono"] ?></td>
                <td><?= $row["localidad"] ?></td>
                <td><?= $row["fecha_nacimiento"] ?></td>
                <td><?= $row["contrasenia"] ?></td>
                <td><?= $row["permiso"] ?></td>

                <!-- <td>
                    <input type="submit" name="selec" value="Seleccionar"/>
                </td> -->
            </tr>
        <?php $i++; 
        } ?>
        </table>
    <!-- </form> -->
    
</div>
<div id="resulBusqueda"></div>
 
<?php } ?>

<script>
    function consulSocio() {
        var nombreSel = document.getElementById("nomBusqueda").value;
        // var apellidoSel = document.getElementById(" apeBusqueda").value;

       

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById('resulBusqueda').innerHTML = this.responseText;
            }
        };
        // xhttp.open("GET", "consulSocio.php?nombreSel=" + nombreSel + "&apellidoSel=" + apellidoSel, true); // falla con dos parametros
        xhttp.open("GET", "funciones/consulSocio.php?nombreSel=" + nombreSel, true);
        xhttp.send();
    }

</script>

<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
<script src="./jquery.js"></script>


<!-- // if (isset($_POST["selec"])) {
//     $filaSeleccionada = $_POST["selec"];
//     $idSeleccionado = $_POST["socioID"];
//     // buscar el registro correspondiente en la base de datos
//    // $socioModi = mysqli_query($con, "SELECT * FROM socios WHERE id_socio = $idSeleccionado");
//     // hacer algo con la fila seleccionada

//     echo $filaSeleccionada;
//     echo $idSeleccionado;

//   } -->
  





<!-- // include("footer.php") ?> -->