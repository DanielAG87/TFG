<?php 
require('./fpdf/fpdf.php');
include_once "conectarBBDD.php";
$con = conectarBD();

$dineroPDF = mysqli_query($con, 'SELECT m.id_movimiento, s.nombre, s.apellido1, m.cantidad, m.concepto, m.fecha_movimiento, m.tipo_gasto 
FROM movimientos m 
JOIN socios s WHERE m.id_socio = s.id_socio');

mysqli_close($con);

class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        $this->Image('./img/iconoRuna.jpg', 160, 8, 33);
        $this->SetFont('Arial', 'B', 18);
        $this->Cell(170, 18, 'Contabilidad Runa Blanca', 0, 0, 'C');
    }

    // Footer de la página
    function Footer()
    {
        $this->SetY(-10);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}


$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12, 'ISO-8859-1');
$pdf->SetY(50); // Ajusta la posición vertical del contenido debajo del encabezado


while ($row = mysqli_fetch_assoc($dineroPDF)) {
    $fechaFormateada = date("d-m-Y", strtotime($row["fecha_movimiento"])); 
    // $row["id_movimiento"] ;
    // $row["nombre"] ;
    // $row["apellido1"] ;
    // $row["cantidad"] ;
    // $row["concepto"]; 
    // $fechaFormateada ;
    // $row["tipo_gasto"]; 
    $pdf->SetFont('Helvetica', '', 12, 'ISO-8859-1');
    // $pdf->Cell(0, 10, 'Nombre: ' . $row["nombre"]  . " " . "Apellido: " . $row["apellido1"], 0, 1);
    $pdf->Cell(0, 10, utf8_decode('Fecha: ' . $fechaFormateada  . ", " . "concepto: " . $row["concepto"] . ", " . "cantidad: " . $row["cantidad"] . ", " . "Socio: " . $row["nombre"]  . " " . $row["apellido1"]) , 0, 1);

    // $pdf->Cell(0, 10, utf8_decode('Imprimiendo línea ñumero: ') . $row["nombre"]  . ' ' . 'lo tiene paco', 0, 1);

    if ($pdf->GetY() >= 250) {
        $pdf->AddPage(); // Agrega una nueva página si el contenido se desborda
        // $pdf->SetFont('Arial', '', 10, 'ISO-8859-1');
        $pdf->SetFont('Helvetica', '', 12, 'ISO-8859-1');
        $pdf->SetY(40); // Ajusta la posición vertical del contenido debajo del encabezado en la nueva página
    }
}
$pdf->Output('Movimientos.pdf', 'D');
?>