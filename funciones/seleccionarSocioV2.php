<?php
function caca()
{
    include_once "../conectarBBDD.php";

    $con = conectarBD();
    $selSocio = $_REQUEST['idSocio'];

    $socio = "SELECT * FROM socios WHERE id_socio = '{$selSocio}' ";

    $query = mysqli_query($con, $socio);
    $devolver = mysqli_fetch_all($query);
?>

    <div class="modal fade" id="actualizarSocio" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header ">
                    <h5 class="modal-title mx-auto" id="exampleModalLabel">Datos Socio/a</h5>
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                </div>
                <div class="modal-body mx-auto">


                    <?php foreach ($devolver as $j) { ?>
                        <div class="row">
                            <div class="col-md-5 text-center">
                                <label for="idSoci1" class="form-label">ID</label>
                            </div>
                            <div class="col-md-7">
                                <input class="form-control" type="text" readonly id="idSoci1" value="<?= $j[0] ?>" />
                            </div>
                            <div class="col-md-5 text-center">
                                <label for="nomSoci" class="form-label">Nombre</label>
                            </div>
                            <div class="col-md-7">
                                <input class="form-control" type="text" id="nomSoci" value="<?= $j[1] ?>" />
                            </div>
                            <div class="col-md-5 text-center">
                                <label for="ape1Soci" class="form-label">1º Apellido</label>
                            </div>
                            <div class="col-md-7">
                                <input class="form-control" type="text" id="ape1Soci" value="<?= $j[2] ?>" />
                            </div>
                            <div class="col-md-5 text-center">
                                <label for="ape2Soci" class="form-label">2º Apellido</label>
                            </div>
                            <div class="col-md-7">
                                <input class="form-control" type="text" id="ape2Soci" value="<?= $j[3] ?>" />
                            </div>
                            <div class="col-md-5 text-center">
                                <label for="correoSoci" class="form-label">Correo</label>
                            </div>
                            <div class="col-md-7">
                                <input class="form-control" type="text" id="correoSoci" value="<?= $j[4] ?>" />
                            </div>
                            <div class="col-md-5 text-center">
                                <label for="telSoci" class="form-label">Teléfono</label>
                            </div>
                            <div class="col-md-7">
                                <input class="form-control" type="text" id="telSoci" value="<?= $j[5] ?>" />
                            </div>
                            <div class="col-md-5 text-center">
                                <label for="localidadSoci" class="form-label">Localidad</label>
                            </div>
                            <div class="col-md-7">
                                <input class="form-control" type="text" id="localidadSoci" value="<?= $j[6] ?>" />
                            </div>
                            <div class="col-md-5 text-center">
                                <label for="fechaSoci" class="form-label">Fecha Nacimiento</label>
                            </div>
                            <div class="col-md-7">
                                <input class="form-control" type="date" id="fechaSoci" value="<?= $j[7] ?>" />
                            </div>
                            <div class="col-md-5 text-center">
                                <label for="contraSoci" class="form-label">Contraseña</label>
                            </div>
                            <div class="col-md-7">
                                <input class="form-control" type="text" id="contraSoci" value="<?= $j[8] ?>" />
                            </div>
                            <div class="col-md-5 text-center">
                                <label for="premisoSoci" class="form-label">Permiso</label>
                            </div>
                            <div class="col-md-7">
                                <input class="form-control" type="text" id="premisoSoci" value="<?= $j[9] ?>" /><br />
                            </div>


                        </div>
                    <?php } ?>

                    <div class="modal-footer mx-auto">
                        <button type="button" class="btn btn-outline-success" data-bs-dismiss="modal" onclick="actualizar()">Actualizar</button>
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal" onclick="borrar()">Borrar</button>
                        <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancelar</button>
                        <!-- <form method="post" action="socios.php" class="btn-group">
                            <input type="submit" class="btn btn-outline-primary" name="vovler1" value="Volver" data-bs-dismiss="modal">
                        </form> -->

                    </div>
                </div>
            </div>
        </div>

    <?php }

caca(); ?>