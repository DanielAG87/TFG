<?php
include_once "../conectarBBDD.php";
function selPais(){

    $con = conectarBD();
    $comprobar = false;

    if (!empty($_GET['nombreSel']) && !empty($_GET['apellidoSel'])) {
        $nombre = ucwords($_GET['nombreSel']); 
        $apellido = ucwords($_GET['apellidoSel']);
        $statement = "SELECT * FROM socios WHERE nombre = '{$nombre}' and apellido1 = '{$apellido}' ";
        $comprobar = true;
        
    }
    elseif (!empty($_GET['nombreSel'])) {
        $nombre = ucwords($_GET['nombreSel']);
        $statement = "SELECT * FROM socios WHERE nombre = '{$nombre}'";
        $comprobar = true;
    }
    elseif (!empty($_GET['apellidoSel'])) {
        $apellido = ucwords($_GET['apellidoSel']);
        $statement = "SELECT * FROM socios WHERE apellido1 = '{$apellido}'";
        $comprobar = true;
    }
    else{
        echo "<strong>Introduce algún dato para realizar la busqueda</strong>";?>
        <form method="post" action="socios.php">
            <input type="submit" name="vovler1" value="Volver"/>
        </form>
    <?php 
    }


    

    if ($comprobar == true) {

        $query = mysqli_query($con,$statement);
        $devolver = mysqli_fetch_all($query);
        $afectadas = mysqli_affected_rows($con);

        if ($afectadas == 0) { // si el socio no existe nos salta el error.
            echo "<strong>Socio no encontrado</strong>";
        }
        else{ ?>
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
    
                <?php foreach($devolver as $j){ ?>
                <tr>
                    <td><?php echo $j[0]?></td>
                    <td><?php echo $j[1]?></td>
                    <td><?php echo $j[2]?></td>
                    <td><?php echo $j[3]?></td>
                    <td><?php echo $j[4]?></td>
                    <td><?php echo $j[5]?></td>
                    <td><?php echo $j[6]?></td>
                    <td><?php echo $j[7]?></td>
                    <td><?php echo $j[8]?></td>
                <?php } ?>
                </tr>
            </table> 
        </div>
        <form method="post" action="socios.php">
            <input type="submit" name="vovler1" value="Volver"/>
        </form>
        <?php }
    }

    

    
    }

selPais(); ?>