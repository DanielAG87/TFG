<?php
include_once "../conectarBBDD.php";

function addNuevoSocio(){

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
    // comprobamos que los campos no estén vacíos.
    if (empty($nombre)) {
        echo "<p class='text-danger font-weight-bold'>Introduzca nombre</p>";
    }
    else {
        $contador ++;
    }
    if (empty($ape1)) {
     echo "<p class='text-danger font-weight-bold'>Introduzca Primer apellido</p>";
    }
    else {
        $contador ++;
    }
    if (empty($ape2)) {
        echo "<p class='text-danger font-weight-bold'>Introduzca Segundo apellido</p>";
    }
    else {
        $contador ++;
    }
    if (empty($correo)) {
        echo "<p class='text-danger font-weight-bold'>ntroduzca correo</p>";
    }
    else {
        $contador ++;
    }
    if (empty($tel)) {
     echo "<p class='text-danger font-weight-bold'>Introduzca teléfono</p>";
    }
    else {
        $contador ++;
    }
    if (empty($loca)) {
        echo "<p class='text-danger font-weight-bold'>Introduzca localidad</p>";
    }
    else {
        $contador ++;
    }
    if (empty($fechaNac)) {
        echo "<p class='text-danger font-weight-bold'>Introduzca fecha de nacimiento</p>";
    }
    else {
        $contador ++;
    }
    if (empty($contra)) {
        echo "<p class='text-danger font-weight-bold'>Introduzca contraseña</p>";
    }
    else {
        $contador ++;
    }
    if (empty($permiso)) {
        echo "<p class='text-danger font-weight-bold'>Introduzca permiso</p>";
    }
    else {
        $contador ++;
    }


    if ($contador == 9) {
      
        $contador2 = 0;
        
        // control del nombre y apellidos
        if (preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s-]{1,20}$/u', $nombre) && preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s-]{1,20}$/u', $ape1) && preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s-]{1,20}$/u', $ape2)) {
            $contador2++;
        }
        else {
            echo "Falla nombre, o apellido1 o apellido2";
        }
       
        // controla el correo
        if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            $contador2++;
        }
        else {
            echo "Falla correo";
        }

        // controla el telefono
        if (preg_match('/^(?:\+34|0034)?[6789]\d{8}$/', $tel) ) {
            $contador2++;
        }
        else {
            echo "Falla telefono";
        }
        // controla la localidad
        if (preg_match('/^[a-zA-Z\s-]+$/', $loca) ) {
            $contador2++;
        }
        else {
            echo "Falla localidad";
        }
      

        // si todo está correcto hacemos el insert.
        if ($contador2 == 4) {

            $con = conectarBD();

            if ($permiso == "Si") {
                $permiso = 1;
            }
            else {
                $permiso = 0;
            }
           
            $hash = sha1($contra);
            $nuevoFulano = "INSERT INTO socios (nombre, apellido1, apellido2, correo, telefono, localidad, fecha_nacimiento, contrasenia, permiso) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_stmt_init($con);

            if (mysqli_stmt_prepare($stmt, $nuevoFulano)){

                if(mysqli_stmt_bind_param($stmt, "ssssssssi", $nombre, $ape1, $ape2, $correo, $tel, $loca, $fechaNac, $hash, $permiso)){

                    if(mysqli_stmt_execute($stmt)){
                        echo mysqli_affected_rows($con). " " . "Socio añadido"; 

                        echo '<form method="post" action="socios.php">
                             <input type="submit" name="vovler1" value="Volver a Socios"/>
                         </form>' ;
                      
                    }
                    else{
                        echo "Error de introducción";
                    }
                mysqli_stmt_close($stmt);
                }
            }
            else{
            echo "No se ha podido completar la accion, Prueba más tarde";
            }
        }
       
    }
}

addNuevoSocio(); 

?>
