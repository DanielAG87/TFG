<?php
include "headerV2.php";
?>

<div class="container-fluid p-5">
    <div class="row">
        <div class="col-md-4 mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" id="nombre" class="form-control" placeholder="Nombre">
        </div>
        <div class="col-md-4 mb-3">
            <label for="nombre" class="form-label">Primer Apellido</label>
            <input type="text" id="ape1" class="form-control" placeholder="Primer Apellido">
        </div>
        <div class="col-md-4 mb-3">
            <label for="nombre" class="form-label">Segundo Apellido</label>
            <input type="text" id="ape2" class="form-control" placeholder="Segundo Apellido">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="nombre" class="form-label">Correo</label>
            <input type="mail" id="correo" class="form-control" placeholder="asociacionRunaBlanca@gmail.com">
        </div>
        <div class="col-md-6 mb-3">
            <label for="nombre" class="form-label">Teléfono</label>
            <input type="text" id="tel" class="form-control" placeholder="Teléfono">
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 mb-3">
            <label for="nombre" class="form-label">Localidad</label>
            <input type="text" id="loca" class="form-control" placeholder="Localidad">
        </div>
        <div class="col-md-4 mb-3">
            <label for="nombre" class="form-label">Fecha de nacimiento</label>
            <input type="date" id="fechaNac" class="form-control" placeholder="Fecha de nacimiento">
        </div>
        <div class="col-md-4 mb-3">
            <label for="nombre" class="form-label">Contraseña</label>
            <input type="password" id="contra" class="form-control" placeholder="Contraseña">
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 mb-3">
            <label for="nombre" class="form-label">Permiso</label>
            <select id="permiso" class="form-select ">
                <option disabled selected>Selecciona una opción</option>
                <option>Si</option>
                <option>No</option>
            </select>
        </div>


    </div>
    <div class="row">
        <div class="col-md-2 ">
            <button type="submit" id="formSocio" onclick="addSocio()" class="btn btn-outline-primary">Añadir Socio</button>
            <button type="submit" id="limpiar" class="btn btn-outline-primary">Limpiar campos</button>

        </div>
        <div class="col-md-1">
            <form method="post" action="socios.php">
                <input type="submit" name="vovler1" class="btn btn-outline-primary" value="Volver" />
            </form>
        </div>
    </div>
</div>

<div id="result"></div>



<script>
    function addSocio() {

        var nombre = document.getElementById("nombre").value;
        var ape1 = document.getElementById("ape1").value;
        var ape2 = document.getElementById("ape2").value;
        var correo = document.getElementById("correo").value;
        var tel = document.getElementById("tel").value;
        var loca = document.getElementById("loca").value;
        var fechaNac = document.getElementById("fechaNac").value;
        var contra = document.getElementById("contra").value;
        var permiso = document.getElementById("permiso").value;



        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById('result').innerHTML = this.responseText;
            }
        };
        xhttp.open("POST", "funciones/funNuevoSocio.php?nombre=" + nombre + "&ape1=" + ape1 + "&ape2=" + ape2 + "&correo=" + correo + "&tel=" + tel +
            "&loca=" + loca + "&fechaNac=" + fechaNac + "&contra=" + contra + "&permiso=" + permiso, true);
        xhttp.send();
    }
</script>

<!-- codigo para limpiar los campos de los imput -->
<script>
    $(document).ready(function() {
        $(document).ready(function() {
            $("#limpiar").click(function() {
                $("#nombre, #ape1, #ape2, #correo, #tel, #loca, #fechaNac, #contra").val("");
                $("#permiso").prop("selectedIndex", 0);

            });
        });
    });
</script>



<?php include("footer.php") ?>