<?php 

ob_start();
session_start();

if ($_SESSION['keyAlm'] == "" || $_SESSION['keyAlm'] == null) {
		header("Location:../Index.php");
} else {
	include '../modelos/alumno.modelo.php';
	$alumno = new Alumno();
	$keyAlm = $_SESSION['keyAlm'];
	$datAlm = $alumno->userAlmDet($keyAlm);
	$testVal = $alumno->valTestIniAlm($keyAlm);
	if ($datAlm) {
		if ($testVal -> CantidadVal == 0) {
?>

	<?php include 'header2.php'; ?>
	<style type="text/css">/*
				.colM {
			color: #28a745;
		}
		.colM:hover {
			color: #fff;
			background: #28a745;
			transition: 1s;
		}*/
		.margen-avatar{
        	margin-top:-50px;
    	}
    	.shDC {
    		-webkit-box-shadow: 0px 0px 2px 0px rgba(0,0,0,0.75);
			-moz-box-shadow: 0px 0px 2px 0px rgba(0,0,0,0.75);
			box-shadow: 0px 0px 2px 0px rgba(0,0,0,0.75);
    	}
	</style>
	<br><br><br><br>
	<div class="container-fluid mt-4">
		<div class="row">
			<div class="col-md-4 col-lg-3">
				<!-- SobreMi -->
                <div class="container py-5">
                    <div class="card shDC">
                        <img class="card-img-top" src="../vistas/img/iceland.jpg" alt="Card image cap">
                        <div class="text-center margen-avatar">
                        	<?php 
								if ($datAlm -> foto_perf_alm == "" && $datAlm -> sexo_al == "Masculino") {
									echo "<img src='../vistas/img/usermal.png' class='rounded-circle' width='100px'>";
								} else if ($datAlm -> foto_perf_alm != "" && $datAlm -> sexo_al == "Masculino") {
							?>
								<img src="Arch/perfil/<?php echo $datAlm->foto_perf_alm ?>" class="rounded-circle" width="100px">
							<?php
								} else if ($datAlm -> foto_perf_alm == "" && $datAlm -> sexo_al == "Femenino") {
									echo "<img src='../vistas/img/userfem.png' class='rounded-circle' width='100px'>";
								} else if ($datAlm -> foto_perf_alm != "" && $datAlm -> sexo_al == "Femenino") {
							?>
								<img src="Arch/perfil/<?php echo $datAlm->foto_perf_alm ?>" class="rounded-circle" width="100px"">
							<?php
								} else {
									echo "<img src='../vistas/img/icous.png' class='rounded-circle' width='100px'>";
								}
							?>
                        </div>
                        <div class="card-body text-center">
                        <h6 class="card-title font-weight-bold">
                        	<?php echo $datAlm -> nombre_c_al; ?>
                        </h6>
                        <h6 class=" text-left mt-4">
							<i class="fas fa-id-card-alt fa-lg icoIni"></i>
							<?php echo $datAlm -> matricula_al; ?>
						</h6>
						<h6 class=" text-left mt-3">
							<i class="fas fa-envelope fa-lg icoIni"></i>
							<?php echo $datAlm -> correo_al; ?>
						</h6>
						<h6 class=" text-left mt-3">
							<i class="fas fa-phone fa-lg icoIni"></i>
							<?php echo $datAlm -> telefono_al; ?>
						</h6>
                        </div>
                    </div>
                </div><!-- SobreMi -->
                <div class="container">
                    <!-- Comentarios -->
                    <div class="card">
                        <div class="card-header text-center">
                            Frase Celebre
                        </div>
                        <div class="card-body">
                            <blockquote class="blockquote mb-0">
                            <p class="font-italic text-info">
                            	<b>"</b> Todo el mundo tiene talento, solo es cuestión de moverse hasta descubrirlo. <b>"</b>
                            </p>
                            <footer class="blockquote-footer"><cite title="Source Title">George Lucas</cite></footer>
                            </blockquote>
                        </div>
                    </div><!-- Comentarios -->
                </div>
			</div>
			<form class="col-md-8 col-lg-9" method="POST" id="formRegTest" name="formRegTest" autocomplete="off">
				<ul class="nav nav-pills mb-3 cardShadow pad30" id="pills-tab" role="tablist">
					<li class="nav-item pad10">
					   	<a class="nav-link active btn colM" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"><h4>Datos SocioEconomicos</h4></a>
					</li>
					<li class="nav-item pad10">
					  	<a class="nav-link  colM btn" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false"><h4>Datos Personales</h4></a>
					</li>
					<li class="nav-item pad10">
					    <a class="nav-link  colM btn" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false"><h4>Datos Acedemicos</h4></a>
					</li>
				</ul>
				<br>
				<div class="tab-content cardShadow pad30 rounded" id="pills-tabContent">
					<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
						<?php include "modTest/DatSocioEconomicos.php"; ?>
						<div class="row">
							<div class="col-sm-2"></div>
							<div class="col-sm-8 text-center">
								<button class="btn btn-outline-primary btn-md" type="button" id="btnV1">
									Continuar <i class="fas fa-arrow-right icoPri fa-lg"></i>
								</button>
							</div>
							<div class="col-sm-2"></div>
						</div>
					</div>
					<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
						<?php include "modTest/DatPersonales.php"; ?>
						<div class="row">
							<div class="col-sm-2"></div>
							<div class="col-sm-8 text-center">
								<button class="btn btn-outline-primary btn-md" type="button" id="btnV2">
									Continuar <i class="fas fa-arrow-right icoPri fa-lg"></i>
								</button>
							</div>
							<div class="col-sm-2"></div>
						</div>
					</div>
					<div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
						<?php include "modTest/DatAcademicos.php"; ?>
						<div class="row">
							<div class="col-sm-2"></div>
							<div class="col-sm-8 text-center">
								<button class="btn btn-outline-primary btn-md" type="submit" id="btnV3">
									Guardar datos <i class="fas fa-check-circle icoPri fa-lg"></i>
								</button>
							</div>
							<div class="col-sm-2"></div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>

	<div class="modal fade bgModal" data-backdrop="false" id="valdat" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	    	<!-- <div class="modal-header">
		        <h2 class="modal-title text-center">Un momento porfavor...</h2>
		    </div> -->
		    <br>
		    <h2 class="text-center pad10">Un momento porfavor...</h2>
	      	<div class="modal-body">
	        	<div class="text-center">
	        		<img width="300" src="../vistas/img/load5.gif" class="img-fluid">
	        		<br>
	        		<span class="lead" id="textdat">Validando datos...</span>
	        	</div>
	      	</div>
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
    <script src="../vistas/modulos/js/validTest.js"></script>
    <script src="../vistas/modulos/js/test.js"></script>
    <script src="../vistas/modulos/js/valTestC.js"></script>
    <?php include 'footer2.php'; ?>

<?php		
		} else {
			header("Location:../vistas/modulos/Logout.php");
		}
	} else {
		header("Location:../vistas/modulos/Logout.php");
	}
}