<?php
include "headerV2.php";
include_once "conectarBBDD.php";


$con = conectarBD();

$ingresos = mysqli_query($con, 'SELECT SUM(cantidad) as  ingresos From movimientos WHERE tipo_gasto = "ingreso";');
$gastos = mysqli_query($con, 'SELECT SUM(cantidad) as gastos From movimientos WHERE tipo_gasto = "ingreso";');

mysqli_close($con);

$resultadoIngreso = mysqli_fetch_assoc($ingresos);
echo $resultadoIngreso['ingresos'];

// foreach($resultadoIngreso as $j){
//     echo $j['ingresos'];
// }

// echo mysqli_fetch_assoc($ingresos);
// echo $gastos;



?>