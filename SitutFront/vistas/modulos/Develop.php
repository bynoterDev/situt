<?php 

ob_start(); 
session_start();
if ($_SESSION['keyAlm'] == "" || $_SESSION['keyAlm'] == null) {
	header("Location:../Index.php");
} else {
	include '../modelos/alumno.modelo.php';
	$alumno = new Alumno();
	$datAlm = $alumno->userAlmDet($_SESSION['keyAlm']);
	if ($datAlm) {
		if ($datAlm->id_detgrupo != "") {
		$datGrpAlm = $alumno->datGrpAlm($_SESSION['keyAlm']);
		$cantJustTot = $alumno->cantTotJustif($_SESSION['keyAlm']);
		$cantAcJust = $alumno -> cantJustifAcept($_SESSION['keyAlm'], $datGrpAlm->cuatrimestre_g);
		$cantReJust = $alumno -> cantJustifRecha($_SESSION['keyAlm'], $datGrpAlm->cuatrimestre_g);
		$cantTotCut = $alumno -> cantJustifCuat($_SESSION['keyAlm'], $datGrpAlm->cuatrimestre_g);
		} 
	$valDatPer = $alumno -> cantDatPerVal($_SESSION['keyAlm']);
	$datEPer = $alumno -> datPerEditAlm($_SESSION['keyAlm']);
	$valTest = $alumno -> valTestIniAlm($_SESSION['keyAlm']);

?>
	<?php include 'header2.php'; ?>

	<br><br><br><br>
	<style type="text/css">
        body {
            /*background-image: url(../vistas/img/back9.jpeg);*/
        }
		div .list-group .active {
			background:#fff!important;
			color: black;
			outline: none;
			list-style: none;
			text-decoration: none;
			border-color: #28a745!important;
		}
		.ocult {
			display: none;
		}
		.margen-avatar{
        	margin-top:-50px;
    	}
    	.shDC {
    		-webkit-box-shadow: 0px 0px 2px 0px rgba(0,0,0,0.75);
			-moz-box-shadow: 0px 0px 2px 0px rgba(0,0,0,0.75);
			box-shadow: 0px 0px 2px 0px rgba(0,0,0,0.75);
    	}
	</style>

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="text-center text-info">
                    Equipo de desarrollo
                </h1>
                <hr class="bg-info" style="height: 2px;">
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-lg-4">
                <!-- SobreMi -->
                <div class="container py-4">
                    <div class="card rounded" id="cardSh">
                        <img class="card-img-top" src="../vistas/img/iceland.jpg" alt="Card image cap">
                        <div class="text-center margen-avatar">
                            <img src="../vistas/img/icous.png" alt="" class="rounded-circle" width="100px">
                        </div>
                        <div class="card-body">
                        <h6 class="card-title text-center font-weight-bold">
                            Marco Aguilar
                        </h6>
                        <p class="card-text lead text-center">
                            Carismatico, divertido y comprometido con crear un mundo mejor.
                        </p>
                        <hr style="height: 1px;" class="bg-info">
                        <div class="row mt-4">
                            <div class="col-sm-2">
                                <a href="#">
                                    <i class="fab fa-facebook fa-lg text-info"></i>
                                </a>
                            </div>
                            <div class="col-sm-2">
                                <a href="#">
                                    <i class="fab fa-instagram fa-lg text-info"></i>
                                </a>
                            </div>
                            <div class="col-sm-2">
                                <a href="#">
                                    <i class="fas fa-globe fa-lg text-info"></i>
                                </a>
                            </div>
                            <div class="col-sm-2">
                                <a href="#">
                                    <i class="fab fa-github fa-lg text-info"></i>
                                </a>
                            </div>
                            <div class="col-sm-2">
                                <a href="#">
                                    <i class="fab fa-linkedin fa-lg text-info"></i>
                                </a>
                            </div>
                            <div class="col-sm-2">
                                <a href="#" data-toggle="tooltip" data-placement="top" title="732-119-37-48" id="t1">
                                    <i class="fab fa-whatsapp fa-lg text-info"></i>
                                </a>
                            </div>
                        </div>
                        </div>
                    </div>
                </div><!-- SobreMi -->
            </div>
            <div class="col-md-4 col-lg-4">
                <!-- SobreMi -->
                <div class="container py-4">
                    <div class="card rounded" id="cardSh1">
                        <img class="card-img-top" src="../vistas/img/iceland.jpg" alt="Card image cap">
                        <div class="text-center margen-avatar">
                            <img src="../vistas/img/avatar-dhg.png" alt="" class="rounded-circle border" width="100px">
                        </div>
                        <div class="card-body">
                        <h6 class="card-title text-center font-weight-bold">
                            Mario Jaimes
                        </h6>
                        <p class="card-text lead text-center">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum
                        </p>
                        <hr style="height: 1px;" class="bg-info">
                        <div class="row text-center mt-4">
                            <div class="col-sm-3">
                                <a href="#">
                                    <i class="fab fa-facebook fa-lg text-info"></i>
                                </a>
                            </div>
                            <div class="col-sm-3">
                                <a href="#">
                                    <i class="fab fa-instagram fa-lg text-info"></i>
                                </a>
                            </div>
                            <div class="col-sm-3">
                                <a href="#">
                                    <i class="fab fa-twitter fa-lg text-info"></i>
                                </a>
                            </div>
                            <div class="col-sm-3">
                                <a href="#" data-toggle="tooltip" data-placement="top" title="722-115-52-65" id="t2">
                                    <i class="fab fa-whatsapp fa-lg text-info"></i>
                                </a>
                            </div>
                        </div>
                        </div>
                    </div>
                </div><!-- SobreMi -->
            </div>
            <div class="col-md-4 col-lg-4">
                <!-- SobreMi -->
                <div class="container py-4">
                    <div class="card rounded" id="cardSh2">
                        <img class="card-img-top" src="../vistas/img/iceland.jpg" alt="Card image cap">
                        <div class="text-center margen-avatar">
                            <img src="../vistas/img/avatar-dhg.png" alt="" class="rounded-circle border" width="100px">
                        </div>
                        <div class="card-body">
                        <h6 class="card-title text-center font-weight-bold">
                            Alex Solis
                        </h6>
                        <p class="card-text lead text-center">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum
                        </p>
                        <hr style="height: 1px;" class="bg-info">
                        <div class="row text-center mt-4">
                            <div class="col-sm-3">
                                <a href="#">
                                    <i class="fab fa-facebook fa-lg text-info"></i>
                                </a>
                            </div>
                            <div class="col-sm-3">
                                <a href="#">
                                    <i class="fab fa-instagram fa-lg text-info"></i>
                                </a>
                            </div>
                            <div class="col-sm-3">
                                <a href="#">
                                    <i class="fab fa-twitter fa-lg text-info"></i>
                                </a>
                            </div>
                            <div class="col-sm-3">
                                <a href="#" data-toggle="tooltip" data-placement="top" title="722-428-56-95" id="t3">
                                    <i class="fab fa-whatsapp fa-lg text-info"></i>
                                </a>
                            </div>
                        </div>
                        </div>
                    </div>
                </div><!-- SobreMi -->
            </div>
            <div class="col-md-4 col-lg-2"></div>
            <div class="col-md-4 col-lg-4">
                <!-- SobreMi -->
                <div class="container">
                    <div class="card rounded" id="cardSh3">
                        <img class="card-img-top" src="../vistas/img/iceland.jpg" alt="Card image cap">
                        <div class="text-center margen-avatar">
                            <img src="../vistas/img/avatar-dhg.png" alt="" class="rounded-circle border" width="100px">
                        </div>
                        <div class="card-body">
                        <h6 class="card-title text-center font-weight-bold">
                            Brayan Vidal

                        </h6>
                        <p class="card-text lead text-center">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum
                        </p>
                        <hr style="height: 1px;" class="bg-info">
                        <div class="row text-center mt-4">
                            <div class="col-sm-3">
                                <a href="#">
                                    <i class="fab fa-facebook fa-lg text-info"></i>
                                </a>
                            </div>
                            <div class="col-sm-3">
                                <a href="#">
                                    <i class="fab fa-instagram fa-lg text-info"></i>
                                </a>
                            </div>
                            <div class="col-sm-3">
                                <a href="#">
                                    <i class="fab fa-twitter fa-lg text-info"></i>
                                </a>
                            </div>
                            <div class="col-sm-3">
                                <a href="#" data-toggle="tooltip" data-placement="top" title="722-566-70-14" id="t4">
                                    <i class="fab fa-whatsapp fa-lg text-info"></i>
                                </a>
                            </div>
                        </div>
                        </div>
                    </div>
                </div><!-- SobreMi -->
            </div>
            <div class="col-md-4 col-lg-4">
                <!-- SobreMi -->
                <div class="container">
                    <div class="card rounded" id="cardSh4">
                        <img class="card-img-top" src="../vistas/img/iceland.jpg" alt="Card image cap">
                        <div class="text-center margen-avatar">
                            <img src="../vistas/img/usermal.png" alt="" class="rounded-circle" width="100px">
                        </div>
                        <div class="card-body">
                        <h6 class="card-title text-center font-weight-bold">
                            Guillermo Lopez
                        </h6>
                        <p class="card-text lead text-center">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum
                        </p>
                        <hr style="height: 1px;" class="bg-info">
                        <div class="row text-center mt-4">
                            <div class="col-sm-3">
                                <a href="#">
                                    <i class="fab fa-facebook fa-lg text-info"></i>
                                </a>
                            </div>
                            <div class="col-sm-3">
                                <a href="#">
                                    <i class="fab fa-instagram fa-lg text-info"></i>
                                </a>
                            </div>
                            <div class="col-sm-3">
                                <a href="#">
                                    <i class="fab fa-twitter fa-lg text-info"></i>
                                </a>
                            </div>
                            <div class="col-sm-3">
                                <a href="#" data-toggle="tooltip" data-placement="top" title="726-100-04-84" id="t5">
                                    <i class="fab fa-whatsapp fa-lg text-info"></i>
                                </a>
                            </div>
                        </div>
                        </div>
                    </div>
                </div><!-- SobreMi -->
            </div>
        </div>
    </div>

	<br><br><br>
	<?php include 'modals/modalsconfalm.php'; ?>
	<script src="../vistas/js/jquery-3.1.1.min.js"></script>
	<!-- SweetAlert -->
    <script src="../vistas/node_modules/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vistas/Assets/js/vendor/popper.min.js"></script>
    <script src="../vistas/Js/bootstrap.min.js"></script>
    <script src="../vistas/assets/js/vendor/holder.min.js"></script>
    <!--- Personalizados -->
    <script src="../vistas/modulos/js/confDatAlm.js"></script>
    <script src="../vistas/modulos/js/justif.js"></script>
    <script src="../vistas/modulos/js/datPerAlm.js"></script>
    <script src="../vistas/modulos/js/editDatPerAlm.js"></script>
    <script src="../vistas/modulos/js/grpAlm.js"></script>
    <script src="../vistas/modulos/js/tutAlm.js"></script>
    <script src="../vistas/modulos/js/develop.js"></script>
    <script type="text/javascript">
    	$(function(){
    		$('#t1, #t2, #t3, #t4, #t5').tooltip();
    	});
    </script>
    
	<?php include 'footer2.php'; ?>
<?php
	} else {
		header("Location:../vistas/modulos/Logout.php");
	}
	  
}

