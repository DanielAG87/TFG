<?php session_start();
include_once "../conectarBBDD.php";

function filtrarDatos(){
    $selOpcion = $_REQUEST['selOpcion'];
    $selValor =  $_REQUEST['selValor'];
    $selorden =  $_REQUEST['selorden'];
    $con = conectarBD();
    $permiso = false;
    $error = "";

    if (!empty($selOpcion) && !empty($selValor) && !empty($selorden)) {

        if ($selOpcion == "Cantidad" && $selValor != "") {
            $cantidad = floatval($selValor);
            try{
                if ($selorden == 'Descendente') {
                    $filtrar = $con->prepare("SELECT m.id_movimiento, s.nombre, s.apellido1, m.cantidad, m.concepto, m.fecha_movimiento, m.tipo_gasto 
                        FROM movimientos m JOIN socios s ON m.id_socio = s.id_socio WHERE m.cantidad = ? ORDER BY s.id_socio DESC");
                }
                else{
                    $filtrar = $con->prepare("SELECT m.id_movimiento, s.nombre, s.apellido1, m.cantidad, m.concepto, m.fecha_movimiento, m.tipo_gasto 
                    FROM movimientos m JOIN socios s on m.id_socio = s.id_socio WHERE m.cantidad = ? ORDER BY s.id_socio");
                }
            $filtrar->bind_param("i", $cantidad);
            $filtrar->execute();
            $resultFiltrar = $filtrar->get_result(); // Obtener el resultado de la consulta
            $permiso = true;
            } catch (Exception $e) {
                echo "Error al filtrar: " . $e->getMessage();
            }
        }


        if ($selOpcion == "Fecha" && $selValor != "" && is_string($selValor)) {
            $fechaFormateada = date("Y-m-d", strtotime($selValor));
            try{
                if ($selorden == 'Descendente') {
                    $filtrar = $con->prepare("SELECT m.id_movimiento, s.nombre, s.apellido1, m.cantidad, m.concepto, m.fecha_movimiento, m.tipo_gasto 
                    FROM movimientos m JOIN socios s on m.id_socio = s.id_socio  WHERE m.fecha_movimiento = ? ORDER BY s.id_socio DESC");
                }
                else{
                    $filtrar = $con->prepare("SELECT m.id_movimiento, s.nombre, s.apellido1, m.cantidad, m.concepto, m.fecha_movimiento, m.tipo_gasto 
                    FROM movimientos m JOIN socios s on m.id_socio = s.id_socio  WHERE m.fecha_movimiento = ?");
                }
                $filtrar->bind_param("s", $fechaFormateada);
                $filtrar->execute();
                $resultFiltrar = $filtrar->get_result();
                if ($resultFiltrar->num_rows >= 1) {
                    $permiso = true;
                }
                else{
                    $error .= 'No hay nada';
                }
                
            } catch (Exception $e) {
                echo "Error al filtrar: " . $e->getMessage();
            }
        }
        if ($selOpcion == "Nombre" && $selValor != "" && is_string($selValor)) {
            $contener = '%' . $selValor . '%';
    
            try{
                if ($selorden == 'Descendente') {
                    $filtrar = $con->prepare("SELECT m.id_movimiento, s.nombre, s.apellido1, m.cantidad, m.concepto, m.fecha_movimiento, m.tipo_gasto 
                    FROM movimientos m 
                    JOIN socios s ON m.id_socio = s.id_socio WHERE s.nombre LIKE ? ORDER BY s.nombre DESC");
                }
                else {
                    $filtrar = $con->prepare("SELECT m.id_movimiento, s.nombre, s.apellido1, m.cantidad, m.concepto, m.fecha_movimiento, m.tipo_gasto 
                    FROM movimientos m 
                    JOIN socios s ON m.id_socio = s.id_socio WHERE s.nombre LIKE ? ORDER BY s.nombre");
                }
            
            $filtrar->bind_param("s", $contener);
            $filtrar->execute();
            $resultFiltrar = $filtrar->get_result(); // Obtener el resultado de la consulta
            $permiso = true;
            } catch (Exception $e) {
                echo "Error al filtrar: " . $e->getMessage();
            }
        }


    }
    mysqli_close($con);

    if ($permiso) { ?>
        <div class="container-fluid" id="tablaFull">

            <table class="table table-striped table-hover table-bordered text-center" id="tablaPrincipal">
                <tr>
                    <th>
                        <span class="sortable-header">ID Movimiento</span>
                    </th>
                    <th>
                        <span class="sortable-header">Nombre</span>
                    </th>
                    <th>
                        <span class="sortable-header">Primer Apellido</span>
                    </th>
                    <th>
                        <span class="sortable-header">Cantidad</span>
                    </th>
                    <th>
                        <span class="sortable-header">Concepto</span>
                    </th>
                    <th>
                        <span class="sortable-header">Fecha Movimiento</span>
                    </th>
                    <th>
                        <span class="sortable-header">Tipo Gasto</span>
                    </th>
                </tr>
                <tr>
                    <?php
                    while ($row = $resultFiltrar->fetch_assoc()) { 
                        $fechaFormateada = date("d-m-Y", strtotime($row["fecha_movimiento"]));?>
                        <td><?= $row["id_movimiento"] ?></td>
                        <td><?= $row["nombre"] ?></td>
                        <td><?= $row["apellido1"] ?></td>
                        <td><?= $row["cantidad"] ?></td>
                        <td><?= $row["concepto"] ?></td>
                        <td><?= $fechaFormateada ?></td>
                        <td><?= $row["tipo_gasto"] ?></td>
                    </tr>
                <?php } ?>
                </table>
            </div>
            <?php
    } 
    else{
        $error .="Error al insertar los datos";
        echo $error;
    }
}


filtrarDatos(); ?>