
<?php 
    if ($datAlm -> id_detgrupo != "") {
        if ($datGrpAlm -> acept_grp == 0) {
?>
    <div class="container">
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <div class="alert alert-danger font-weight-bold text-center" role="alert">
                    <i class="fas fa-bell mr-2"></i>
                    Aún no has sido aceptado en el grupo.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <div class="col-sm-1"></div>
        </div>
    </div>
<?php
        }
    }
?>
    
<div class="container-fluid animated fadeIn delay-1s mt-5">
    
    <?php 
        if ($datAlm -> id_detgrupo == "") {
    ?>
        <h3 class="text-center font-weight-bold">
            <i class="fas fa-cog mr-2 text-primary"></i>
            Continuemos con la configuración de tu perfil...
        </h3>
        <div class="row mt-5">
            <div class="col-sm-7">
                <div class="text-center">
                    <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 20rem;" src="<?php echo SERVERURL; ?>assets/img/undraw_profile.svg" alt="info site">
                </div>
            </div>
            <div class="col-sm-4">
                <form class="mt-5 p-3 shadow bg-white border-left-primary rounded" name="formRegGrp" id="formRegGrp" method="POST">
                    <div class="form-group">
                        <select class="form-control" name="clvDetGrp" id="clvDetGrp">
                            <option selected="" value="SN">Selecciona un grupo</option>
                            <?php 
                                try {
                                    $valid = 1;
                                    $clvCar = $datAlm -> id_carrera;
                                   // $dbc = Connect::getDB();
                                    
			                        $dbc = new Connect();
			                        $dbc = $dbc -> getDB();
                                    $stmt = $dbc -> prepare("SELECT det.id_detgrupo, grp.grupo_n, doc.nombre_c_doc FROM det_grupo det
                                        INNER JOIN grupos grp ON grp.id_grupo = det.id_grupo
                                        INNER JOIN docentes doc ON doc.id_docente = det.id_docente
                                        INNER JOIN carreras car ON car.id_carrera = det.id_carrera
                                        WHERE det.estado_detgrp = :valid && det.id_carrera = :clvCar");
                                    $stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
                                    $stmt -> bindParam("clvCar", $clvCar, PDO::PARAM_INT);
                                    $stmt -> execute();
                                    while ($res = $stmt -> fetch(PDO::FETCH_OBJ)) {
                            ?>
                                    <option value="<?php echo $res->id_detgrupo; ?>">
                                        <?php echo $res->grupo_n.", ".$res->nombre_c_doc;?>
                                    </option>
                            <?php
                                    }
                            ?>
                                    
                            <?php
                                } catch (PDOException $e) {
                                    echo '{"error":{"text":'. $e->getMessage() .'}}';   
                                }
                            ?>
                        </select>
                    </div>
                    <div class="text-center mt-2">
                        <button class="btn btn-sm btn-primary">
                            <i class="fas fa-check mr-2"></i>
                            Registrar
                        </button>
                    </div>
                </form>
            </div>
            <div class="col-sm-3"></div>
            <div class="col-sm-6 mt-2">
                <div class="rounded shadow bg-white p-3">
                    <p class="text-center font-weight-bold mb-0">
                        <i class="fas fa-bell mr-2 text-danger"></i>
                        Es importante que te registres en algún grupo para que puedas ver las opciones del sistema.
                    </p>
                </div>
            </div>
        </div>
    <?php
        }
    ?>

    <?php 
        if ($datAlm -> id_detgrupo != "") {
            if ($datGrpAlm -> acept_grp == 0) {
    ?>
            <div class="row">
                <div class="col-sm-6 p-2">
                    <div class="text-center">
                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 22rem;" src="<?php echo SERVERURL; ?>assets/img/questions.svg" alt="info site">
                    </div>
                </div>
                <div class="col-sm-6 p-2 rounded shadow">
                    <h4 class="text-center">
                        <b class="text-primary">Información</b>
                        <hr>
                    </h4>
                    <ul class="list-group text-justify border-0">
                        <li class="list-group-item mb-2">
                            <i class="fas fa-circle mr-2 text-primary"></i>
                            Algunas funciones que aparecen en el menu lateral izquierdo, se activaran cuando seas aceptado en el grupo.
                        </li>
                        <li class="list-group-item mb-2">
                            <i class="fas fa-image mr-2 text-primary"></i>
                            Manten tu foto de perfil actualizada para que sea más sencillo al profesor identificarte entre todos los alumnos.
                        </li>
                        <li class="list-group-item mb-2">
                            <i class="fas fa-address-book mr-2 text-primary"></i>
                            Tanto como tus datos personales y de tu cuenta mantenlos actualizados para una mejor experiencia en el sistema.
                        </li>
                    </ul>
                </div>
            </div>
    <?php
            }
        } 
    ?>

    <?php 
        if ($datAlm -> id_detgrupo != "") {
    ?>
        <br>
        <div class="row mt-4">
            <div class="col-sm-4">
                <div class="text-center">
                    <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 22rem;" src="<?php echo SERVERURL; ?>assets/img/pairprogramming.svg" alt="info site">
                    <h6 class="font-weight-bold text-center text-primary bg-white rounded shadow p-2">
                        <i class="far fa-thumbs-up mr-1"></i>
                        Manten actualizado tu perfil.
                    </h6>
                </div>
            </div>
            <div class="col-sm-4 mt-5">
                <h6 class="font-weight-bold text-center text-primary bg-white rounded shadow p-2">
                    <i class="fab fa-tencent-weibo mr-1"></i>
                    Funciones.
                </h6>
                <ul class="list-group text-center shadow rounded">
                    <li class="list-group-item font-weight-bold border-0 border-left-primary">
                        <i class="fas fa-file-medical mr-2"></i> Solicitar justificantes.
                    </li>
                    <li class="list-group-item font-weight-bold border-0 border-left-primary">
                        <i class="fas fa-chalkboard-teacher mr-2"></i> Solicitar tutoria personal.
                    </li>
                    <li class="list-group-item font-weight-bold border-0 border-left-primary">
                        <i class="fas fa-book mr-2"></i> Contestar encuesta inicial.
                    </li>
                    <li class="list-group-item font-weight-bold border-0 border-left-primary">
                        <i class="fas fa-image mr-2"></i> Agregar foto de perfil.
                    </li>
                </ul>
            </div>
            <div class="col-sm-4">
                <div class="text-center">
                    <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 21rem;" src="<?php echo SERVERURL; ?>assets/img/gitversion.svg" alt="info site">
                    <h6 class="font-weight-bold text-center text-primary bg-white rounded shadow p-2 mt-1">
                        <!--<a href="<?php echo SERVERURLALM; ?>Develop/" style="text-decoration: underline;">
                            <i class="fas fa-code mr-1"></i>-->
                            Universidad Tecnológica del Sur del Estado de México
                            <i class="fas fa-external-link-alt ml-1"></i>
                        </a>
                    </h6>
                </div>
            </div>
        </div>
    <?php
        }
    ?>

</div>

