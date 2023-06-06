<?php 
include "headerV2.php";
include_once "./conectarBBDD.php";
 
$pase = false; ?>

  <!-- Carousel -->
  <div class="container-fluid">
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3" aria-label="Slide 4"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="4" aria-label="Slide 5"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="5" aria-label="Slide 6"></button>

      </div>
      <div class="carousel-inner mb-2">
        <div class="carousel-item active " data-bs-interval="2000">
          <img src="./img/aso4Runa.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item" data-bs-interval="2000">
          <img src="./img/aso7.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item" data-bs-interval="2000">
          <img src="./img/asoSolidaria.jpg" class="d-block w-100" alt="...">
        </div>

        <div class="carousel-item" data-bs-interval="2000">
          <img src="./img/aso6.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item" data-bs-interval="2000">
          <img src="./img/aso9.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item" data-bs-interval="2000">
          <img src="./img/terra.jpg" class="d-block w-100" alt="...">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Anterior</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Siguiente</span>
      </button>
    </div>
  </div>
  <!-- Fin Carousel -->


  <div class="container-fluid" id="mapaDatos">
    <div class="row align-items-center">
      <div class="col-md-6">
        <div class="d-flex justify-content-center">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3026.0942591174557!2d-3.205867924184407!3d40.671892040070325!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd43ae9dfc20b7c9%3A0x6fb360757addb6bc!2sEspacio%20para%20la%20Creaci%C3%B3n%20Joven!5e0!3m2!1ses!2ses!4v1685301414359!5m2!1ses!2ses" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>  
        </div>
      </div>

      <div class="col-md-6 p-md-3">
        <div class="row align-items-center">
          <div class="col-md-6" id="datoAso">
            <h3 class="text-center"><u>Junta Directiva</u></h3><br />
            <p><strong>Presidente / Caudillo: <em>Julio Cesar de Roma</em></strong></p>
            <p><strong>Vicepresidente:  <em>Rubén Gómez Martínez</em></strong></p>
            <p><strong>Secretario:  <em>Sofía López González</em></strong></p>
            <p><strong>Tesorero:  <em>Daniel Agustín Arroyo</em></strong></p>
            <p><strong>Vocal:  <em>Joaquín del Betis Andalú</em></strong></p>
            <p><strong>Vocal:  <em>María Socorro Juarez Perez</em></strong></p>
            <p><strong>Vocal:  <em>Natalia Ruíz García</em></strong></p>
          </div>
          <div class="col-md-6" id="datoAso">
            <h3 class="text-center"><u>Datos Asociación</u></h3><br />
            <p><strong>Domicilio:  <em>Calle de los músicos, 2 19180 Marchamalo, Guadalajara </em></strong></p>
            <p><strong>Correo:  <em>asociacionrunablanca@gmail.com</em></strong></p>
            <p><strong>CIF:  <em>82080366J </em></strong></p>
            <p><strong>Número de cuenta: <em>ES22 3333 4444 5555 6666 9999</em></strong></p>
          </div>
        </div>
      </div>
    </div>
  </div>



<?php include "footer.php"; ?>


  <!-- Modal -->
  <!-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header ">
                        <h5 class="modal-title mx-auto" id="exampleModalLabel">Título del modal</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body mx-auto">

                        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="green" class="bi bi-check-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
                        </svg>
                        <i class="bi bi-check-circle text-success display-3"></i>
                        <input type="text" id="pruebaT" />
                    </div>
                    <div class="modal-footer mx-auto">
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-outline-success" data-bs-dismiss="modal" onclick="vovler()">Guardar cambios</button>
                    </div>
                </div>
            </div>
        </div>-->


 
<script>
          // function vovler(){ <?php
          //   header("Location: index.php");
          //   exit; ?>
          // }
        </script> 

   





