<?php // session_start(); ?>

<!DOCTYPE html>

<html lang="es">
    <head>
        <meta charset="UTF-8"/>
        <meta name="author" content=" Daniel Agustín Arroyo ">
        <meta name="generator" content=" Visual Studio Code ">
        <meta name="date" content=" 20/04/2023">
        <meta name="TFG Daniel Agustín Arroyo " content="TFG 2023">
        <title>Asociación Runa Blanca</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link rel="stylesheet" href="TFGcolor.css"/>

    </head>

    <body>
        <header class="cabecera">
            <table>
                <form method="get" action="INDEX.php">
                <td><a href="index.php"><img class="imagenCabecera" src="./img/iconoRuna2.png" /></a></td>
                
                <td><h1><b>Asociación Runa Blanca</b></h1></td>
                <td>

                </form>
            </table>
        </header>

        <aside>
            <ul>
                <li><a href="socios.php">Socios</a></li>
                <li><a href="#">Inventario</a></li>
                <li><a href="#">Reservar</a> </li>
                <li><a href="contabilidad.php">Contabilidad</a> </li>
                <li><a href="#">Agenda</a> </li>


<?php      // if($_SESSION['usuario'] == 'Moncloa' ){ ?>
                <!-- <li><a href="gestionCarta_Clientes.php">Gestion de carta y clientes</a></li> -->
<?php      // } 

            // else{ ?>
                <!-- <li>Gestion de socios</a></li> -->
<?php       //}?>
            </ul>

               
          
        </aside> </br>