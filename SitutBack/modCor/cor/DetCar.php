<?php 

$datCor = $cordinador->userCorDet($keyCor);
//$valCar = $_GET['v'];
$codigo = explode("/", $_GET['view']);
$valCar = $codigo[1];
$_SESSION['clvCar'] = $valCar;

$datCD = $cordinador -> datDirCar(base64_decode($valCar));
$almCar = $cordinador -> cantAlmCar(base64_decode($valCar));
$almInact = $cordinador -> cantAlmInact(base64_decode($valCar));
$almSAcept = $cordinador -> cantAlmAcept(base64_decode($valCar));
$almBajCar = $cordinador -> cantBajCar(base64_decode($valCar));
?>


	<div class="container-fluid animated fadeIn delay-1s">
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 text-center"><?php echo $datCD->nombre_car; ?>.</h1>
            <a href="<?php echo SERVERURLCOR; ?>Home/" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
              <i class="fas fa-arrow-left fa-sm text-white-50 mr-2"></i> Regresar 
            </a>
          </div>
		<div class="row mt-5">
			<div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Alumnos</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $almCar->CantAlm; ?> registros</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Alumnos inactivos</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $almInact->CantAlm; ?> registros</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-user-times fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Alumnos sin aceptar</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $almSAcept->CantAlm; ?> registros</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-user-clock fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Alumnos dados de baja</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $almBajCar->CantAlm; ?> registros</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-user-slash fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
			<div class="col-sm-12 mt-4">
				<div class="card shadow mb-4">
			            <div class="card-header py-3">
			              <h6 class="m-0 font-weight-bold text-primary">Grupos de la carrera</h6>
			            </div>
			            <div class="card-body">
			              <div class="table-responsive">
			                <table class="table table-bordered table-hover" id="tbListadoGrpCar" width="100%" cellspacing="0">
			                  <thead>
			                    <tr>
			                      	<th>Grupo:</th>
            									<th>Alumnos:</th>
            									<th>Acciones:</th>
			                    </tr>
			                  </thead>
			                  <tfoot>
			                    <tr>
			                     	<th>Grupo:</th>
          									<th>Alumnos:</th>
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

    <script src="<?php echo SERVERURLCOR; ?>cor/js/listGrpCar.js"></script>
