<?php
include_once "../conectarBBDD.php";
function selPais(){

    $con = conectarBD();
    $nombre = ucwords($_GET['nombreSel']); 
    $apellido = ucwords($_GET['apellidoSel']);
        
    
    $statement = "SELECT * FROM socios WHERE nombre = '{$nombre}' and apellido1 = '{$apellido}' ";
    // $statement = "SELECT * FROM socios WHERE nombre = '{$nombre}'";

    $query = mysqli_query($con,$statement);
    $devolver = mysqli_fetch_all($query);

    $afectadas = mysqli_affected_rows($con);
    echo $afectadas;

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
    <?php }
    
    }

selPais(); ?>