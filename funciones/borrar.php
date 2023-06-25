<?php 
include_once "../conectarBBDD.php";

function borrar(){
    $con = conectarBD();
    $borrarSocio = $_REQUEST['idSocio'];
    $borrarSocio = "DELETE FROM socios WHERE id_socio ='{$borrarSocio}' "; 

    $modal = '<div class="modal fade" id="modalBorrarSocio" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header ">
                                <h5 class="modal-title mx-auto" id="exampleModalLabel">Borrar socio/a</h5>
                            </div>
                            <div class="modal-body mx-auto">
                                <span>';
    
    
    if(mysqli_query($con, $borrarSocio)) {
        $afectadas = mysqli_affected_rows($con);
        if ($afectadas != 0) {
            $modal .= '<svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="green"
            class="bi bi-check-circle" viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
            <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
            </svg> ';
            $modal .= 'Socio Borrado';


            $socios = mysqli_query($con, 'SELECT * FROM socios'); ?>
            
            <div class="container-fluid" id="tablaPrincipal3">
            <!-- mostrar la tabla -->
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
                        <?php
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
                                <input type="submit" class="btn btn-outline-primary" name="selec" value="Seleccionar" onclick="selSocio('<?= $row['id_socio'] ?>');" />
                            </td>
                    </tr>
                <?php 
                        } ?>
                </table>
            </div>
        </div> <?php

        } 
        else {
            $modal .= '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
                    </svg> ';
            $modal .= 'Error al borrar socio';
        }
    } 
    else {
        $modal .= '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
                    </svg> ';
            $modal .= 'Error en la consulta';
    }
    $modal .= '     </span>
                </div>
                <div class="modal-footer mx-auto">
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>';

    echo $modal;
}

borrar(); ?>