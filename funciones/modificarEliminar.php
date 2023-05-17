<?php
function caca(){
    include_once "../conectarBBDD.php";

    $con = conectarBD();
    $selSocio = $_REQUEST['idSocio'];

    $socio = "SELECT * FROM socios WHERE id_socio = '{$selSocio}' "; 
    
    $query = mysqli_query($con, $socio);
    $devolver = mysqli_fetch_all($query);
    ?>

    <div class="container-fluid ml-5">
        <table class="table table-bordered table-striped border-primary">
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

            <?php foreach ($devolver as $j) { ?>
                <tr>
                    <td><input type="text" readonly id="idSoci1" value="<?= $j[0] ?>"/></td>
                    <td><input type="text" id="nomSoci" value="<?=$j[1] ?>"/></td>
                    <td><input type="text" id="ape1Soci" value="<?=$j[2] ?>"/></td>
                    <td><input type="text" id="ape2Soci" value="<?=$j[3] ?>"/></td>
                    <td><input type="text" id="correoSoci" value="<?=$j[4] ?>"/></td>
                    <td><input type="text" id="telSoci" value="<?=$j[5] ?>"/></td>
                    <td><input type="text" id="localidadSoci" value="<?=$j[6] ?>"/></td>
                    <td><input type="date" id="fechaSoci" value="<?=$j[7] ?>"/></td>
                    <td><input type="text" id="contraSoci" value="<?=$j[8] ?>"/></td>
                    <td><input type="text" id="premisoSoci" value="<?=$j[9] ?>"/></td>

                <?php } ?>
                </tr>
        </table>
        <div class="btn-group" role="group" aria-label="Basic example">
            <input type="submit" class="btn btn-outline-success" onclick="actualizar()" value="Actualizar"/>
            <input type="submit" class="btn btn-outline-danger" onclick="borrar()" value="Borrar">
            <form method="post" action="socios.php" class="btn-group">
                <input type="submit" class="btn btn-outline-primary" name="vovler1"  value="Volver">
            </form>
        </div>
        <div id="funBorrar"></div>
    </div>
<?php }

caca(); ?>



