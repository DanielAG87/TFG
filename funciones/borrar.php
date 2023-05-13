<?php 
include_once "../conectarBBDD.php";

function borrar(){
    $con = conectarBD();
    $borrarSocio = $_REQUEST['idSocio'];
    $socio = "DELETE FROM socios WHERE id_socio ='{$borrarSocio}' "; 
    
    if(mysqli_query($con, $socio)) {
        $afectadas = mysqli_affected_rows($con);
        if ($afectadas != 0) {
            echo "<strong>Socio Borrado</strong>";
        } else {
            echo "<strong>Error al borrar socio</strong>";
        }
    } else {
        echo "<strong>Error en la consulta</strong>";
    }
}

borrar(); ?>