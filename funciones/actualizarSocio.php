<?php

include_once "../conectarBBDD.php";


function addNuevoSocio()
{
    $id = $_REQUEST['idSocio'];
    $nombre = ucwords($_REQUEST['nomSoci']);
    $ape1 = ucwords($_REQUEST['ape1Soci']);
    $ape2 = ucwords($_REQUEST['ape2Soci']);
    $correo = $_REQUEST['correoSoci'];
    $tel = $_REQUEST['telSoci'];
    $loca = ucwords($_REQUEST['localidadSoci']);
    $fechaNac = $_REQUEST['fechaSoci'];
    $contra = $_REQUEST['contraSoci'];
    $permiso = ucwords($_REQUEST['premisoSoci']);

    $contador = 0;
    // control nombre
    if (!empty($nombre) && preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s-]{1,20}$/u', $nombre)) {
        $contador++;
    } else {
        echo "<p class='text-danger font-weight-bold'>Introduzca nombre</p>";
    }
    // control del primer apellido
    if (!empty($ape1) && preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s-]{1,20}$/u', $ape1)) {
        $contador++;
    } else {
        echo "<p class='text-danger font-weight-bold'>Introduzca Primer apellido</p>";
    }
    //control apellido2
    if (!empty($ape2) && preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s-]{1,20}$/u', $ape2)) {
        $contador++;
    } else {
        echo "<p class='text-danger font-weight-bold'>Introduzca Segundo apellido</p>";
    }
    //control correo
    if (!empty($correo) && filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $contador++;
    } else {
        echo "<p class='text-danger font-weight-bold'>ntroduzca correo</p>";
    }
    //control telefono
    if (!empty($tel) && preg_match('/^(?:\+34|0034)?[6789]\d{8}$/', $tel)) {
        $contador++;
    } else {
        echo "<p class='text-danger font-weight-bold'>Introduzca teléfono</p>";
    }
    // control localidad
    if (!empty($loca) && preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s-]{1,20}$/u', $loca)) {
        $contador++;
    } else {
        echo "<p class='text-danger font-weight-bold'>Introduzca localidad</p>";
    }
    // control de fecha
    $fecha_actual = date("Y-m-d");
    if (!empty($fechaNac) && strtotime($fechaNac) < strtotime($fecha_actual)) {
        $contador++;
    } else {
        echo "<p class='text-danger font-weight-bold'>Introduzca fecha de nacimiento</p>";
    }
    // control contraseña
    if (!empty($contra)) {
        $contador++;
    } else {
        echo "<p class='text-danger font-weight-bold'>Introduzca contraseña</p>";
    }
    //control permiso
    if (!empty($permiso) && ($permiso == "Si" || $permiso == "No")) {
        $contador++;
    } else {
        echo "<p class='text-danger font-weight-bold'>Introduzca permiso</p>";
    }


    // si todo está correcto hacemos el insert.
    if ($contador == 9) {

        $con = conectarBD();

        if ($permiso == "Si") {
            $permiso = 1;
        } else {
            $permiso = 0;
        }

        $hash = sha1($contra);
        $actualizarSocio = "UPDATE socios SET 
                    nombre = ?, apellido1 = ?, apellido2 = ?, correo = ?, telefono = ?, localidad = ?, fecha_nacimiento = ?, contrasenia = ?, permiso = ? 
                    WHERE id_socio = ?";

        $stmt = mysqli_stmt_init($con);

        if (mysqli_stmt_prepare($stmt, $actualizarSocio)) {

            if (mysqli_stmt_bind_param($stmt, "ssssssssii", $nombre, $ape1, $ape2, $correo, $tel, $loca, $fechaNac, $hash, $permiso, $id)) {

                if (mysqli_stmt_execute($stmt)) {
                    // echo mysqli_affected_rows($con). " " . "Socio añadido"; ?>
                    <script>alert("Socio Añadido");</script>
<?php
                    echo '<div class="container-fluid">
                                <p class="text-success font-weight-bold">Socio Actualizado</p>
                            </div>';
                } else {
                    echo "Error de introducción";
                }
                mysqli_stmt_close($stmt);
            }
        } else {
            echo "No se ha podido completar la accion, Prueba más tarde";
        }
    }
}

addNuevoSocio();
