<?php
include "headerV2.php";
?>

<div class="container-fluid input-group">
    <input type="text" id="nombre" class="form-control" placeholder="Nombre"/>
    <input type="text" id="ape1" class="form-control" placeholder="Primer Apellido"/>
    <input type="text" id="ape2" class="form-control" placeholder="Segundo Apellido" >
    <input type="mail" id="correo" class="form-control" placeholder="Correo"/>
    <input type="text" id="tel" class="form-control" placeholder="Teléfono"/>
    <input type="text" id="loca" class="form-control" placeholder="Localidad"/>
    <input type="date" id="fechaNac" class="form-control" placeholder="Fecha de nacimiento"/>
    <input type="text" id="contra" class="form-control" placeholder="Contraseña"/>
    <select id="permiso" class="form-control">
        <option>Si</option>
        <option>No</option>
    </select>
    <!-- <input type="text" id="permiso" class="form-control" placeholder="Permiso"/> -->
    <button type="submit" id="formSocio" onclick="addSocio()">Añadir Socio</button>
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
        xhttp.open("GET", "funciones/funNuevoSocio.php?nombre=" + nombre + "&ape1="+ ape1 + "&ape2="+ ape2 + "&correo="+ correo + "&tel="+ tel
        + "&loca="+ loca + "&fechaNac="+ fechaNac + "&contra="+ contra + "&permiso="+ permiso, true); 
        xhttp.send();
    }

</script>

   
    
    


