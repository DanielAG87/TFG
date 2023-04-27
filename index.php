<?php // session_start();

if (empty($_REQUEST)) { ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Runa Blanca</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style>
        #loginIMG {
            width: 200px;
            padding-bottom: 40px;
        }
        body{
            background-color:#04448c ;
        }
        #h1Login{
            color: whitesmoke;
            padding-bottom: 5px;
            font-family: "Viking";
        }
       
        #centrador{
            display: flex;
            justify-content: center;
        }
       
    </style>
</head>

<body class="text-center" id="bodyLogin">
    
    <div class="container-fluid pt-5">
        <h1 class="h1 pb-3 " id="h1Login">Asociación Runa Blanca</h1>
        <img id="loginIMG" src="./img/iconoRuna5.png" />
        <h4 class="h4" id="h1Login">Login</h4>
        <form >

            <div class="row" id="centrador">
                <div class="col-md-6 col-sm-6 col-lg-4 col-xs-6">                       
                    <input class="form-control text-center" type="text" id="correo" name="correo" placeholder="Correo" required/>
                </div>
            </div><br>

            <div class="row " id="centrador">
                <div class="col-md-6 col-sm-6 col-lg-4 col-xs-6">                       
                    <input class="form-control text-center" type="password" id="contra" name="contra" placeholder="Contraseña" required/>
                </div>
            </div><br>
            
            <!-- <button class="btn btn-outline-dark" type="submit" id="bLogin">Entrar</button> -->
            <input type="submit" value="Entrar" class="btn btn-outline-dark" id="bLogin" name="bLogin"/>
        </form><br>
        <p id="h1Login">Si no tiene acceso, póngase en contacto con el administrador</p>
    </div>
    
   <!-- <?php include("footer.php") ?> -->


</body>
</html>
<?php } 

if (!empty($_REQUEST['bLogin'])) {
    include "header.php";


    // $to = "danielagustin87@gmail.com";
    // $subject = "Prueba PHP";
    // $message = "Hola majete, esto es una prueba";

    // mail($to,$subject,$message);



    include "footer.php";
}








?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>