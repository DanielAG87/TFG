<?php
include "headerV2.php";
include_once "conectarBBDD.php";

$con = conectarBD();

$juegos = mysqli_query(
    $con,
    'SELECT nombre, min_jugadores, max_jugadores, mecanica, edad, reservado, ruta_foto
    FROM juegos order by nombre'
);

$devolverJuegos = mysqli_fetch_all($juegos);
mysqli_close($con);


?>

<div class="container-fluid">

    <div class="row">
        <?php 
        foreach($devolverJuegos as $j){
        ?>

        <div class=" col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2 col-xxl-2 text-center mb-3">
            <span style="text-align: center;"><strong><?=$j[0]?></strong></span><br />
            <img style="width: 200px; height: 250px;" src="<?=$j[6]?>"/><br />
            <span>Jugadores: <?=$j[1]?>-<?=$j[2]?></span><br />
            <span><?=$j[3]?></span><br />
            <span>Edad mínima:<?=$j[4]?></span><br />
            <?php
            if ($j[5] == 1) { 
                echo'<span style="color:red;"><strong>Reservado</strong></span> ';
                echo '<button class="btn btn-outline-danger">Solicitar</button>';
            } 
            else{ 
                echo'<span style="color:green;"><strong>Disponible</strong></span> ';
                echo '<button class="btn btn-outline-success">Reservar</button>';
            }
            ?>
          
        </div>
        <?php } ?>

    </div>
</div>

<?php include "footer.php";