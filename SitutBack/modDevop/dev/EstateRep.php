<?php 

$cod = explode("/", $_GET['view']);
$parRecib = $cod[1];
$param1 = base64_encode(0);
$param2 = base64_encode(1);


?>

<div class="container-fluid animated fadeIn delay-1s">
	
	<?php 
		if ($parRecib === 'res') {
			$dataRepOpc = $devop -> dataRepOpc($param1);
	?>
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
		    <h1 class="h3 mb-0 text-gray-800">
		    	<i class="fas fa-check-circle mr-2 text-success"></i>
		    	Reportes resueltos
		    </h1>
		    <a href="<?php echo SERVERURLDEV; ?>Home/" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
		      <i class="fas fa-arrow-left fa-sm text-white-50 mr-2"></i> Regresar 
		    </a>
		</div>

		<div class="row">
			
			<?php 

				if ($dataRepOpc -> rowCount() > 0) {
					while ($dr = $dataRepOpc -> fetch(PDO::FETCH_OBJ)) {
			?>

					<div class="col-xl-3 col-md-6 mb-4 hovTar tra5">
			          <a href="<?php echo SERVERURLDEV; ?>DetRep/res/<?php echo base64_encode($dr->id_report); ?>/">
			          	<div class="card border-left-success shadow h-100 py-2">
				            <div class="card-body">
				              <div class="row no-gutters align-items-center">
				                <div class="col mr-2">
				                  <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
				                  	<?php echo formatFech($dr->fecha_reg_rep); ?>
				                  </div>
				                  <div class="h5 mb-0 font-weight-bold text-gray-800">
				                  	<?php echo $dr->num_serie_rep; ?>
				                  </div>
				                </div>
				                <div class="col-auto">
				                  <i class="fas fa-check-circle fa-2x text-gray-300 tra5 icoRes"></i>
				                </div>
				              </div>
				            </div>
				          </div>
			          </a>
			        </div>

			<?php
					}
				} else {
			?>
				<div class="col-sm-12">
					<div class="card shadow mb-4">
		                <div class="card-header py-3">
		                  <h6 class="m-0 font-weight-bold text-primary">
		                  	Información
		                  </h6>
		                </div>
		                <div class="card-body">
		                  <div class="text-center">
		                    <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 15rem;" src="<?php echo SERVERURL; ?>assets/img/notdata.svg" alt="info site">
		                  </div>
		                  <h3 class="text-center">
		                  	Aún no hay ningun reporte resuelto...
		                  </h3>
		                </div>
		            </div>
				</div>
			
			<?php
				}

			?>

		</div>
	<?php
 		} else if ($parRecib === 'not') {
 			$dataRepOpc = $devop -> dataRepOpc($param2);
 	?>

 		<div class="d-sm-flex align-items-center justify-content-between mb-4">
		    <h1 class="h3 mb-0 text-gray-800">
		    	<i class="fas fa-spinner mr-2 text-warning"></i>
		    	Reportes pendientes
		    </h1>
		    <a href="<?php echo SERVERURLDEV; ?>Home/" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
		      <i class="fas fa-arrow-left fa-sm text-white-50 mr-2"></i> Regresar 
		    </a>
		</div>

		<div class="row">
			
			<?php 

				if ($dataRepOpc -> rowCount() > 0) {
					while ($dr = $dataRepOpc -> fetch(PDO::FETCH_OBJ)) {
			?>

					<div class="col-xl-3 col-md-6 mb-4 hovTar tra5">
			          <a href="<?php echo SERVERURLDEV; ?>DetRep/not/<?php echo base64_encode($dr->id_report); ?>/">
			          	<div class="card border-left-warning shadow h-100 py-2">
				            <div class="card-body">
				              <div class="row no-gutters align-items-center">
				                <div class="col mr-2">
				                  <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
				                  	<?php echo formatFech($dr->fecha_reg_rep); ?>
				                  </div>
				                  <div class="h5 mb-0 font-weight-bold text-gray-800">
				                  	<?php echo $dr->num_serie_rep; ?>
				                  </div>
				                </div>
				                <div class="col-auto">
				                  <i class="fas fa-spinner fa-2x text-gray-300 tra5 icoRes"></i>
				                </div>
				              </div>
				            </div>
				          </div>
			          </a>
			        </div>

			<?php
					}
				} else {
			?>
				<div class="col-sm-12">
					<div class="card shadow mb-4">
		                <div class="card-header py-3">
		                  <h6 class="m-0 font-weight-bold text-primary">
		                  	Información
		                  </h6>
		                </div>
		                <div class="card-body">
		                  <div class="text-center">
		                    <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 15rem;" src="<?php echo SERVERURL; ?>assets/img/notdata.svg" alt="info site">
		                  </div>
		                  <h3 class="text-center">
		                  	No hay ningun reporte pendiente...
		                  </h3>
		                </div>
		            </div>
				</div>
			
			<?php
				}

			?>

		</div>

 	<?php
 		} else {
 	?>
		<div class="col-sm-12 mt-5">
	      <div class="text-center">
	        <div class="error mx-auto" data-text="404">404</div>
	        <p class="lead text-gray-800 mb-5">Página no encontrada...</p>
	        <p class="text-gray-500 mb-0">
	          Al parecer hubo un problema al momento de buscar un dato erroneo...
	        </p>
	        <a href="<?php echo SERVERURLDEV; ?>Home/">&larr; Volver al inicio</a>
	      </div>
	    </div>
 	<?php
 		}
	?>


</div>