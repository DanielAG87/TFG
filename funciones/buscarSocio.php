<?php
include_once "../conectarBBDD.php";
function consulSocio()
{

    $con = conectarBD();
    $comprobar = false;
    $comprobarModal = false;
    $modal = '<div class="modal fade" id="modalBuscarSocio" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header ">
                                <h5 class="modal-title mx-auto" id="exampleModalLabel">Buscar socio/a</h5>
                            </div>
                            <div class="modal-body mx-auto">
                                <span>';

    if (!empty($_REQUEST['nombreSel']) && !empty($_REQUEST['apellidoSel'])) {
        $nombre = ucwords($_REQUEST['nombreSel']);
        $apellido = ucwords($_REQUEST['apellidoSel']);
        $statement = "SELECT * FROM socios WHERE nombre LIKE '%{$nombre}%' and apellido1 LIKE '%{$apellido}%' ";
        $comprobar = true;
    } elseif (!empty($_REQUEST['nombreSel'])) {
        $nombre = ucwords($_REQUEST['nombreSel']);
        $statement = "SELECT * FROM socios WHERE nombre LIKE '%{$nombre}%'";
        $comprobar = true;
    } elseif (!empty($_REQUEST['apellidoSel'])) {
        $apellido = ucwords($_REQUEST['apellidoSel']);
        $statement = "SELECT * FROM socios WHERE apellido1 LIKE '%{$apellido}%'";
        $comprobar = true;
    } else {
        // echo "<strong style='color: red;'>Introduce algún dato para realizar la busqueda</strong>";
        $modal .= '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
                    </svg> ';
        $modal .= 'Introduce algún dato para realizar la busqueda';
        $comprobarModal = true;
    }

    

    

    if ($comprobar == true) {

        $query = mysqli_query($con, $statement);
        $devolver = mysqli_fetch_all($query);
        $afectadas = mysqli_affected_rows($con);
        // desconectarBD($con);

        if ($afectadas == 0) { // si el socio no existe nos salta el error.
            //echo "<strong style='color: red;'>Socio no encontrado</strong>";
            $modal .= '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
                    </svg> ';
            $modal .= 'Socio no encontrado';
            $comprobarModal = true;
        } 
        else { ?>
            <div class="container-fluid ml-5">
                <table class="table table-bordered table-striped border-primary">
                    <tr>
                        <th >ID Socio</th>
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

                    <?php foreach ($devolver as $j) { ?>
                        <tr>
                            <td><?php echo $j[0] ?></td>
                            <td><?php echo $j[1] ?></td>
                            <td><?php echo $j[2] ?></td>
                            <td><?php echo $j[3] ?></td>
                            <td><?php echo $j[4] ?></td>
                            <td><?php echo $j[5] ?></td>
                            <td><?php echo $j[6] ?></td>
                            <td><?php echo $j[7] ?></td>
                            <td><?php echo $j[8] ?></td>
                            <td><?php echo $j[9] ?></td>

                            <td>
                                <input type="submit" class="btn btn-outline-primary" name="selec" value="Seleccionar" onclick="selSocio('<?= $j[0]?>'); window.scrollTo({ top: 0, behavior: 'smooth' });"/>
                            </td>
                        <?php } ?>
                        </tr>
                </table>
            </div>
            <form method="post" action="socios.php">
                <input class="btn btn-outline-primary" type="submit" name="vovler1" value="Volver" />
            </form>
<?php }
    }

    $modal .= '                 </span>
                            </div>
                            <div class="modal-footer mx-auto">
                                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cerrar</button>
        
                            </div>
                        </div>
                    </div>
                </div>';
    if ($comprobarModal) {
        echo $modal;
    }

}

consulSocio(); ?>