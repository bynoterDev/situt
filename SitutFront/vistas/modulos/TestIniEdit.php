<?php 
 
session_start();
if ($_SESSION['keyAlm'] == "" || $_SESSION['keyAlm'] == null) {
	header("Location:../Index.php");
} else {
	include '../modelos/alumno.modelo.php';
	$alumno = new Alumno();
	$valEnc = $_GET['v'];
	$datAlm = $alumno->userAlmDet($_SESSION['keyAlm']);
	if ($datAlm) {
		$valTest = $alumno -> valTestIniAlm($_SESSION['keyAlm']);
		$testVal = $alumno -> validDatEnc($_SESSION['keyAlm'], base64_decode($valEnc));
		if ($testVal) {
?>

	<?php include 'header2.php'; ?>
	<style type="text/css">
		.ocult {
			display: none;
		}
		.colM {
			color: #28a745;
		}
		.colM:hover {
			color: #fff;
			background: #28a745;
			transition: 1s;
		}
		.shDC {
    		-webkit-box-shadow: 0px 0px 2px 0px rgba(0,0,0,0.75);
			-moz-box-shadow: 0px 0px 2px 0px rgba(0,0,0,0.75);
			box-shadow: 0px 0px 2px 0px rgba(0,0,0,0.75);
    	}
    	.margen-avatar{
        	margin-top:-50px;
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
			<form class="col-md-8 col-lg-9 cardShadow pad10" method="POST" id="formEditEnc" name="formEditEnc" autocomplete="off">
				<div class="bg-primary text-center p-3 rounded" style="border-radius: 8px;">
					<h4 class="text-white">
						<i class="fas fa-edit fa-lg icoIni"></i>
						Editar registro de entrevista inicial para tutorías.</h4>
				</div>
				<input type="hidden" class="form-control" value="<?php echo base64_encode($testVal->id_enctestalm) ?>" name="clvTest">
				<div id="mostDat1">
					<!-- <hr style="height: 5px;" class="rounded bg-primary"><br> -->
					<div class="text-center mt-4">
						<h4 class="text-center text-info">Datos SocioEconomicos</h4>
					</div>
					<hr style="height: 5px;" class="rounded bg-info">
					<br>
					<?php include "modTest/DatSocioEconomicosEdit.php"; ?>
					<div class="row" id="contBtn1Val">
						<div class="col-sm-2"></div>
							<div class="col-sm-8 text-center">
								<button class="btn btn-primary btn-md" type="button" id="btnV1">
									Validar datos <i class="fas fa-check-circle icoPri fa-lg"></i>
								</button>
							</div>
						<div class="col-sm-2"></div>
					</div>
				</div>
				<div id="mostDat2" class="ocult">
					<div class="text-center" id="prb1">
						<h4 class="text-center text-info">Datos Personales</h4>
					</div>
					<hr style="height: 5px;" class="rounded bg-info">
					<br>
					<?php include "modTest/DatPersonalesEdit.php"; ?>
					<div class="row" id="contBtn2Val">
						<div class="col-sm-2"></div>
							<div class="col-sm-8 text-center">
								<button class="btn btn-primary btn-md" type="button" id="btnV2">
									Validar datos <i class="fas fa-check-circle icoPri fa-lg"></i>
								</button>
							</div>
						<div class="col-sm-2"></div>
					</div>
				</div>
				<div id="mostDat3" class="ocult">
					<div class="text-center">
						<h4 class="text-center text-info">Datos Academicos</h4>
					</div>
					<hr style="height: 5px;" class="rounded bg-info">
					<br>
					<?php include "modTest/DatAcademicosEdit.php"; ?>
					<div class="row">
						<div class="col-sm-2"></div>
							<div class="col-sm-8 text-center mb-4">
								<button class="btn btn-primary btn-md" type="submit" id="btnV3">
									Guardar datos <i class="fas fa-check-circle icoPri fa-lg"></i>
								</button>
							</div>
						<div class="col-sm-2"></div>
					</div>
				</div>
			</form>
			<div class="col-sm-2"></div>
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

	<?php include 'modals/modalDatPerAlm.php'; ?>
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
    <script src="../vistas/modulos/js/testEdit.js"></script>
    <script src="../vistas/modulos/js/validTest.js"></script>
    <script type="text/javascript">
            $(window).scroll(function() {
              if ($("#menu1").offset().top > 56) {
                  $("#menu1").addClass("bg-info");
              } else {
                  $("#menu1").removeClass("bg-info");
              }
            });
            $(window).scroll(function(){
            	if ($("#menu2").offset().top > 56) {
                  $("#menu2").addClass("bg-info");
              } else {
                  $("#menu2").removeClass("bg-info");
              }
            });
    </script>
    
	<?php include 'footer2.php'; ?>

<?php
		} else {
			header("Location:../vistas/modulos/Logout.php");
		}
	} else {
		header("Location:../vistas/modulos/Logout.php");
	}
}

