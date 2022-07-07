<?php 

$datCor = $cordinador->userCorDet($keyCor); 
//$valGrp = $_GET['v'];
$codigo = explode("/", $_GET['view']);
$valGrp = $codigo[1];
$_SESSION['clvGrp'] = $valGrp;
$_SESSION['clvCar'] = $codigo[2];
$clvCar = $codigo[2];
$datValGC = $cordinador -> datGrpCarSel(base64_decode($valGrp),base64_decode($clvCar));

?>
	
	<div class="container-fluid animated fadeIn delay-1s">
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 text-center">
            	<?php echo $datValGC->nombre_car; ?>, Grupo : <b><?php echo $datValGC->grupo_n; ?></b>.
            </h1>
            <a href="<?php echo SERVERURLCOR; ?>DetCar/<?php echo $clvCar; ?>/" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
              <i class="fas fa-arrow-left fa-sm text-white-50 mr-2"></i> Regresar 
            </a>
          </div>
		<div class="row">
			<div class="col-sm-12 mt-4">
				<div class="card shadow mb-4">
		            <div class="card-header py-3">
		              <h6 class="m-0 font-weight-bold text-primary">Alumnos del grupo</h6>
		            </div>
		            <div class="card-body">
		              <div class="table-responsive">
		                <table class="table table-bordered table-hover" id="tbListadoAlmGrpCar" width="100%" cellspacing="0">
		                  <thead>
		                    <tr>
		                      	<th>Nombre:</th>
								<th>Matricula:</th>
								<th>Correo:</th>
								<th>Acciones:</th>
		                    </tr>
		                  </thead>
		                  <tfoot>
		                    <tr>
		                     	<th>Nombre:</th>
								<th>Matricula:</th>
								<th>Correo:</th>
								<th>Acciones:</th>
		                    </tr>
		                  </tfoot>
		                  <tbody>
		                  </tbody>
		                </table>
		              </div>
		            </div>
		        </div>
			</div>
		</div>
	</div>

    <!--- Personalizados -->
    <script src="<?php echo SERVERURLCOR; ?>cor/js/listGrpCar.js"></script>
