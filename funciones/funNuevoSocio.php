<?php

include_once "../conectarBBDD.php";


function addNuevoSocio()
{

    $nombre = ucwords($_REQUEST['nombre']);
    $ape1 = ucwords($_REQUEST['ape1']);
    $ape2 = ucwords($_REQUEST['ape2']);
    $correo = $_REQUEST['correo'];
    $tel = $_REQUEST['tel'];
    $loca = ucwords($_REQUEST['loca']);
    $fechaNac = $_REQUEST['fechaNac'];
    $contra = $_REQUEST['contra'];
    $permiso = $_REQUEST['permiso'];

    $contador = 0;
    // coontrolamos el nombre
    if (!empty($nombre) && preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s-]{1,20}$/u', $nombre)) {
        $contador++;
    } else {
        echo "<p class='text-danger font-weight-bold'>Introduzca nombre</p>";
        // echo '<script>
        //         Swal.fire({
        //           icon: "success",
        //           title: "¡Error!",
        //           text: "El campo nombre no se ha rellenado.",
        //           confirmButtonText: "Aceptar"
        //         });
        //     </script>';
        // echo "<script>alert('script');</script>";



        // echo "<script> Swal.fire({
        //     title: 'Error!',
        //     text: 'Do you want to continue',
        //     icon: 'error',
        //     confirmButtonText: 'Cool'
        //   }); </script>"; 

        // echo"<script>alerta()</script>";
    }
    // controlamos el apellido1
    if (!empty($ape1) && preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s-]{1,20}$/u', $ape1)) {
        $contador++;
    } else {
        echo "<p class='text-danger font-weight-bold'>Introduzca Primer apellido</p>";
    }
    //controlamos el apellido2
    if (!empty($ape2) && preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s-]{1,20}$/u', $ape2)) {
        $contador++;
    } else {
        echo "<p class='text-danger font-weight-bold'>Introduzca Segundo apellido</p>";
    }
    // control correo
    if (!empty($correo) && filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $contador++;
    } else {
        echo "<p class='text-danger font-weight-bold'>ntroduzca correo</p>";
    }
    // control telefono
    if (!empty($tel) && preg_match('/^(?:\+34|0034)?[6789]\d{8}$/', $tel)) {
        $contador++;
    } else {
        echo "<p class='text-danger font-weight-bold'>Introduzca teléfono</p>";
    }
    // control localidad
    if (!empty($loca) && preg_match('/^[a-zA-Z\s-]+$/', $loca)) {
        $contador++;
    } else {
        echo "<p class='text-danger font-weight-bold'>Introduzca localidad</p>";
    }

    $fecha_actual = date("Y-m-d");
    if (!empty($fechaNac) && strtotime($fechaNac) < strtotime($fecha_actual)) {
        $contador++;
    } else {
        echo "<p class='text-danger font-weight-bold'>Introduzca fecha de nacimiento</p>";
    }
    if (empty($contra)) {
        echo "<p class='text-danger font-weight-bold'>Introduzca contraseña</p>";
    } else {
        $contador++;
    }
    if (!empty($permiso) && $permiso != "Selecciona una opción") {
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
        $nuevoFulano = "INSERT INTO socios (nombre, apellido1, apellido2, correo, telefono, localidad, fecha_nacimiento, contrasenia, permiso) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_stmt_init($con);

        if (mysqli_stmt_prepare($stmt, $nuevoFulano)) {

            if (mysqli_stmt_bind_param($stmt, "ssssssssi", $nombre, $ape1, $ape2, $correo, $tel, $loca, $fechaNac, $hash, $permiso)) {

                if (mysqli_stmt_execute($stmt)) {
                    // echo mysqli_affected_rows($con). " " . "Socio añadido"; 
                    // echo '<script>alert("Socio Añadido");</script>';

                    echo '<div class="container-fluid">
                                <p class="text-success font-weight-bold">Socio añadido</p>
                            </div>';
                } else {
                    echo "Error de introducción";
                }
            }
        } else {
            echo "No se ha podido completar la accion, Prueba más tarde";
        }
        mysqli_stmt_close($stmt);
    }
}

addNuevoSocio(); ?>

<script>
    function alerta() {


        Swal.fire({
            title: 'Error!',
            text: 'El campo no puede estar vacío',
            icon: 'error',
            confirmButtonText: 'Po vale'
        })

        // else{
        //     Swal.fire({
        //     title: 'Bien!',
        //     text: 'Campo Relleno',
        //     icon: 'success',
        //     confirmButtonText: 'Aceptar'
        //     })
        // }
    }
</script>