<?php 

$dbc = new Connect();
$dbc = $dbc -> getDB();
$datCor = $cordinador->userCorDet($keyCor);
$maleAll = "MasculinoALL";
$femaAll = "FemeninoALL";
$NA = "NA";
		
?>

	<div class="container-fluid animated fadeIn delay-1s">
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 text-center">Reportes.</h1>
            <a href="<?php echo SERVERURLCOR; ?>Home/" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
              <i class="fas fa-arrow-left fa-sm text-white-50 mr-2"></i> Regresar 
            </a>
          </div>
		<div class="row mt-4">
			<div class="col-sm-6">
				<div class="card shadow mb-4">
	                <div class="card-header py-3">
	                  <h6 class="m-0 font-weight-bold text-primary">Información</h6>
	                </div>
	                <div class="card-body">
	                  <div class="text-center">
	                    <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 15rem;" src="<?php echo SERVERURL; ?>assets/img/report.svg" alt="">
	                  </div>
	                  <p>
	                  	Genera reportes generales de la universidad y por carrera, selecciona la carrera para ver los distintos tipos de reporte para cada una.
	                  </p>
	                </div>
	              </div>
			</div>
			<div class="col-sm-6">
				<div class="card shadow mb-4">
	                <!-- Card Header - Accordion -->
	                <a href="#reportSexUni" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="reportSexUni">
	                  <h6 class="m-0 font-weight-bold text-primary">
	                  	Reportes generales por sexo:
	                  </h6>
	                </a>
	                <div class="collapse show" id="reportSexUni">
	                  <div class="card-body">
				        <div class="row">
				        	<div class="col-xl-6 col-md-6 mb-4">
				              <div class="card border-left-info shadow h-100 py-2">
				                <div class="card-body">
				                  <div class="row no-gutters align-items-center">
				                    <div class="col mr-2">
				                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Masculino</div>
				                      <div class="h5 mb-0 font-weight-bold text-gray-800 mt-3">
				                      	<a target="_blank" href="<?php echo SERVERURLCOR; ?>cor/ImpReport.php?v=<?php echo base64_encode($NA);?>&&vr=<?php echo base64_encode($maleAll);?>/">
				                      		Imp. <i class="fas fa-print ml-2"></i>
				                      	</a>
				                      </div>
				                    </div>
				                    <div class="col-auto">
				                      <i class="fas fa-male fa-2x text-gray-300"></i>
				                    </div>
				                  </div>
				                </div>
				              </div>
				            </div>
				            <div class="col-xl-6 col-md-6 mb-4">
				              <div class="card border-left-info shadow h-100 py-2">
				                <div class="card-body">
				                  <div class="row no-gutters align-items-center">
				                    <div class="col mr-2">
				                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Femenino</div>
				                      <div class="h5 mb-0 font-weight-bold text-gray-800 mt-3">
				                      	<a target="_blank" href="<?php echo SERVERURLCOR; ?>cor/ImpReport.php?v=<?php echo base64_encode($NA);?>&&vr=<?php echo base64_encode($femaAll);?>/">
				                      		Imp. <i class="fas fa-print ml-2"></i>
				                      	</a>
				                      </div>
				                    </div>
				                    <div class="col-auto">
				                      <i class="fas fa-female fa-2x text-gray-300"></i>
				                    </div>
				                  </div>
				                </div>
				              </div>
				            </div>
				        </div>
	                  </div>
	                </div>
	            </div>
			</div>
			<div class="col-sm-12">
				<div class="card shadow mb-4">
	                <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
	                  <h6 class="m-0 font-weight-bold text-primary">
	                  	Selecciona la carrera para ver las opciones de generar reportes.
	                  </h6>
	                </a>
	                <div class="collapse show" id="collapseCardExample">
	                  <div class="card-body">

						<div class="row">
							<?php 
							$valid = 1;
							$stmt = $dbc -> prepare("SELECT * FROM carreras WHERE estado_car = :valid ORDER BY nombre_car");
							$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
							$stmt -> execute();
							while ($res = $stmt -> fetch(PDO::FETCH_OBJ)) {
						?>
							<div class="col-xl-4 col-md-6 mb-4">
				              <div class="card border-left-info shadow h-100 py-2" title="<?php echo $res->nombre_car; ?>">
				                <div class="card-body">
				                  <div class="row no-gutters align-items-center">
				                    <div class="col mr-2">
				                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
				                      	<?php echo $res->nombre_car; ?>.
				                      </div>
				                      <div class="h5 mb-0 font-weight-bold text-gray-800">
				                      	<a href="<?php echo SERVERURLCOR; ?>ReportCar/<?php echo base64_encode($res->id_carrera); ?>/">
				                      		Ir. <i class="fas fa-link ml-2"></i>
				                      	</a>
				                      </div>
				                    </div>
				                    <div class="col-auto">
				                      <i class="fas fa-university fa-2x text-gray-300"></i>
				                    </div>
				                  </div>
				                </div>
				              </div>
				            </div>
						<?php
							}
						?>
						</div>
	                  </div>
	                </div>
	            </div>
			</div>
		</div>
	</div>

    <script type="text/javascript">
    	$(function(){
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
			      $("#textLog").text("U T S E M");
			  } else {
			      $("#menu2").removeClass("bg-info");
			      $("#textLog").text("S I T U T");
			  }
			});
    	});
    </script>