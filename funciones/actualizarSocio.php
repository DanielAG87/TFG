<?php

include_once "../conectarBBDD.php";


function actualizar()
{
    $con = conectarBD();

    $id = $_REQUEST['idSocio'];
    $nombre = ucwords($_REQUEST['nomSoci']);
    $ape1 = ucwords($_REQUEST['ape1Soci']);
    $ape2 = ucwords($_REQUEST['ape2Soci']);
    $correo = $_REQUEST['correoSoci'];
    $tel = $_REQUEST['telSoci'];
    $loca = ucwords($_REQUEST['localidadSoci']);
    $fechaNac = $_REQUEST['fechaSoci'];
    // $contra = $_REQUEST['contraSoci'];
    $permiso = ucwords($_REQUEST['premisoSoci']);

    $contador = 0;
    $datosFaltantes = "";


    $modal = '<div class="modal fade" id="modalActualizarSocio" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header ">
                            <h5 class="modal-title mx-auto" id="exampleModalLabel">Actualizar socio/a</h5>
                        </div>
                        <div class="modal-body mx-auto">
                            <span>';


    // control nombre
    if (!empty($nombre) && preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s-]{1,20}$/u', $nombre)) {
        $contador++;
    } else {
        $datosFaltantes .= 'Introduzca nombre <br />';
    }
    // control del primer apellido
    if (!empty($ape1) && preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s-]{1,20}$/u', $ape1)) {
        $contador++;
    } else {
        $datosFaltantes .= 'Introduzca primer apellido <br />';
    }
    //control apellido2
    if (!empty($ape2) && preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s-]{1,20}$/u', $ape2)) {
        $contador++;
    } else {
        $datosFaltantes .= 'Introduzca segundo apellido <br />';
    }
    //control correo
    if (!empty($correo) && filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $contador++;
    } else {
        $datosFaltantes .= 'Introduzca correo <br />';
    }
    //control telefono
    if (!empty($tel) && preg_match('/^(?:\+34|0034)?[6789]\d{8}$/', $tel)) {
        $contador++;
    } else {
        $datosFaltantes .= 'Introduzca teléfono <br />';
    }
    // control localidad
    if (!empty($loca) && preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s-]{1,20}$/u', $loca)) {
        $contador++;
    } else {
        $datosFaltantes .= 'Introduzca localidad <br />';
    }
    // control de fecha
    $fecha_actual = date("Y-m-d");
    if (!empty($fechaNac) && strtotime($fechaNac) < strtotime($fecha_actual)) {
        $contador++;
    } else {
        $datosFaltantes .= 'Introduzca fecha de nacimiento <br />';
    }
 
    //control permiso
    if (!empty($permiso)) {
        if ($permiso == "Selecciona una opción" || $permiso != "Si") {
            $permiso = "No";
        }
        $contador++;
    } 




    // si todo está correcto hacemos el insert.
    if ($contador == 8) {

       

        // $hash = sha1($contra);
        $actualizarSocio = "UPDATE socios SET 
                    nombre = ?, apellido1 = ?, apellido2 = ?, correo = ?, telefono = ?, localidad = ?, fecha_nacimiento = ?, permiso = ? 
                    WHERE id_socio = ?";

        $stmt = mysqli_stmt_init($con);

        if (mysqli_stmt_prepare($stmt, $actualizarSocio)) {

            if (mysqli_stmt_bind_param($stmt, "ssssssssi", $nombre, $ape1, $ape2, $correo, $tel, $loca, $fechaNac, $permiso, $id)) {

                if (mysqli_stmt_execute($stmt)) { ?>
                <?php
                    $modal .= '<svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="green"
                    class="bi bi-check-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                    <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
                    </svg> ';
                    $modal .= 'Socio actualizado';
                } else {
                    $modal .= '<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="red" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
                                </svg> ';
                    $modal .= 'Error de introducción';
                }
                mysqli_stmt_close($stmt);
            }
        } else {
            $modal .= '<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="red" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
                    </svg> ';
            $modal .= 'No se ha podido completar la accion, Prueba más tarde';
        }
    } else {
        $modal .= '<strong style="color:red;">Faltan datos: </strong><br /> ' . $datosFaltantes;
    }



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
                            <input type="submit" class="btn btn-outline-primary" name="selec" value="Seleccionar" onclick="selSocio('<?= $row['id_socio'] ?>'); " /> <!-- window.scrollTo({ top: 0, behavior: 'smooth' }); -->
                        </td>
                </tr>
            <?php } ?>
            </table>
        </div>
    <?php
    mysqli_close($con);


    $modal .= '                 </span>
                            </div>
                            <div class="modal-footer mx-auto">
                                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>';

    echo $modal;
}

actualizar();
