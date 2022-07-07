<?php 


$dbc = new Connect();
$dbc = $dbc -> getDB();
$codigo = explode("/", $_GET['view']);
$valCar = $codigo[1];
$valCarDec = base64_decode($valCar);
$datCarSel = $cordinador -> datCarSel($valCarDec);
$keyCor = $_SESSION['keyCor'];
$datCor = $cordinador->userCorDet($keyCor);
$male = 'Masculino';
$fema = 'Femenino';
		
?>
	<div class="container-fluid animated fadeIn delay-1s">
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 text-center">
            	Reportes de la carrera: <?php echo $datCarSel->nombre_car; ?>.
            </h1>
            <a href="<?php echo SERVERURLCOR; ?>Report/" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
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
	                  	Las opciones de reportes mostrados en la siguiente tarjeta son los que se encuentran disponibles para esta carrera.
	                  </p>
	                  <a target="_blank" rel="nofollow" href="https://cjtony.github.io/marc.github.io/">
	                    Para mas información consulte al programador...
	                    &rarr;
	                  </a>
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
				                      	<a target="_blank" href="<?php echo SERVERURLCOR; ?>cor/ImpReport.php?v=<?php echo $valCar;?>&&vr=<?php echo base64_encode($male); ?>/">
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
				                      	<a target="_blank" href="<?php echo SERVERURLCOR; ?>cor/ImpReport.php?v=<?php echo $valCar;?>&&vr=<?php echo base64_encode($fema); ?>/">
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
		</div>
	</div>