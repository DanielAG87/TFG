<?php 
function conectarBD(){
    $servidor = "localhost";
    $usuario = 'root';
    $pass = "";
    $baseDatos = "runa_blanca";

    $conexion = mysqli_connect($servidor, $usuario, $pass, $baseDatos);
    if (!$conexion) {
        echo 'No se puede establecer conexión';
    }
    else{
        return $conexion;
    }
}


// function desconectarBD(){}
//     $cerraBD = mysqli_close($con);
//     if (!$cerraBD) {
//         echo 'No se puede cerrar la conexión';
//     }
//     else{
//         return $cerraBD;
//     }
