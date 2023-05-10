<?php
include "headerV2.php";
?>

<div class="container-fluid p-5">
    <div class="row">
        <div class="col-md-4 mb-3">
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" class="form-control" placeholder="Nombre">
        </div>
        <div class="col-md-4 mb-3">
        <label for="nombre">Primer Apellido</label>
            <input type="text" id="ape1" class="form-control" placeholder="Primer Apellido">
        </div>
        <div class="col-md-4 mb-3">
        <label for="nombre">Segundo Apellido</label>
            <input type="text" id="ape2" class="form-control" placeholder="Segundo Apellido">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
        <label for="nombre">Correo</label>
            <input type="mail" id="correo" class="form-control" placeholder="asociacionRunaBlanca@gmail.com">
        </div>
        <div class="col-md-6 mb-3">
        <label for="nombre">Teléfono</label>
            <input type="text" id="tel" class="form-control" placeholder="Teléfono">
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 mb-3">
        <label for="nombre">Localidad</label>
            <input type="text" id="loca" class="form-control" placeholder="Localidad">
        </div>
        <div class="col-md-4 mb-3">
        <label for="nombre">Fecha de nacimiento</label>
            <input type="date" id="fechaNac" class="form-control" placeholder="Fecha de nacimiento">
        </div>
        <div class="col-md-4 mb-3">
        <label for="nombre">Contraseña</label>
            <input type="text" id="contra" class="form-control" placeholder="Contraseña">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-3">
        <label for="nombre">Permiso</label>
            <select id="permiso" class="form-control">
                <option disabled selected>Selecciona una opción</option>
                <option>Si</option>
                <option>No</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-3">
            <button type="submit" id="formSocio" onclick="addSocio()" class="btn btn-outline-primary">Añadir Socio</button>
        </div>
    </div>
</div>

<div id="result"></div>

<?php include("footer.php") ?>

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
        xhttp.open("POST", "funciones/funNuevoSocio.php?nombre=" + nombre + "&ape1="+ ape1 + "&ape2="+ ape2 + "&correo="+ correo + "&tel="+ tel
        + "&loca="+ loca + "&fechaNac="+ fechaNac + "&contra="+ contra + "&permiso="+ permiso, true); 
        xhttp.send();
    }

</script>

<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>

<script>
$(document).ready(function() {
  
  // codigo para limpiar los campos de los imput
    $(document).ready(function() {
        $("#formSocio").click(function() {
            $("#nombre, #ape1, #ape2, #correo, #tel, #loca, #fechaNac, #contra").val("");
            $("#permiso").prop("selectedIndex", 0);
  
        });
    });
});
</script> 
    
    


