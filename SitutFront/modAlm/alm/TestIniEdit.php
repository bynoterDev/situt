<?php 
 
	$alumno = new Alumno();
	$codigo = explode('/', $_GET['view']);
	$valEnc = $codigo[1];
	$datAlm = $alumno->userAlmDet($_SESSION['keyAlm']);
	if ($datAlm) {
		$valTest = $alumno -> valTestIniAlm($_SESSION['keyAlm']);
		$testVal = $alumno -> validDatEnc($_SESSION['keyAlm'], base64_decode($valEnc));
		if ($testVal) {
?>

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
	<div class="container-fluid animated fadeIn delay-1s mt-4">

		<div class="d-sm-flex align-items-center justify-content-between mb-4">
	        <h1 class="h3 mb-0 text-gray-800">Editar encuesta.</h1>
	    </div>

		<div class="row mt-4">
			<form class="col-md-12 col-lg-12 shadow rounded border-left-primary p-3 bg-white" method="POST" id="formEditEnc" name="formEditEnc" autocomplete="off">
				<input type="hidden" class="form-control" value="<?php echo base64_encode($testVal->id_enctestalm) ?>" name="clvTest">
				<div id="mostDat1">
					<!-- <hr style="height: 5px;" class="rounded bg-primary"><br> -->
					<div class="text-center mt-4">
						<h4 class="text-center text-primary">Datos SocioEconomicos</h4>
					</div>
					<hr style="height: 5px;" class="rounded bg-primary">
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
						<h4 class="text-center text-primary">Datos Personales</h4>
					</div>
					<hr style="height: 5px;" class="rounded bg-primary">
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
						<h4 class="text-center text-primary">Datos Academicos</h4>
					</div>
					<hr style="height: 5px;" class="rounded bg-primary">
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
	        		<img width="300" src="<?php echo SERVERURL; ?>vistas/img/load5.gif" class="img-fluid">
	        		<br>
	        		<span class="lead" id="textdat">Validando datos...</span>
	        	</div>
	      	</div>
	    </div>
	  </div>
	</div>

    <script src="<?php echo SERVERURLALM; ?>alm/js/testEdit.js"></script>
    <script src="<?php echo SERVERURLALM; ?>alm/js/validTest.js"></script>
<?php
		} else {
			header("Location:".SERVERURLALM."alm/Logout.php");
		}
	} else {
		header("Location:".SERVERURLALM."alm/Logout.php");
	}


