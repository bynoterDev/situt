<?php 

$cod = explode("/", $_GET['view']);
$param1 = $cod[1];

?>

<div class="container-fluid animated fadeIn">

	<div class="d-sm-flex align-items-center justify-content-between mb-4">
	    <h1 class="h3 mb-0 text-gray-800">
	    	<i class="fas fa-table mr-2"></i>
	    	Configuraciones
	    </h1>
	    <a href="<?php echo SERVERURLDEV; ?>Home/" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
	      <i class="fas fa-arrow-left fa-sm text-white-50 mr-2"></i> Regresar 
	    </a>
	</div>

	<?php 
		if ($param1 == 'adm') {
	?>

		<div class="row">
			
			<div class="col-sm-12">
				<div class="card shadow mb-4">
	                <div class="card-header py-3">
	                  <h6 class="m-0 font-weight-bold text-primary">
	                  	Funciones administrador
	                  </h6>
	                </div>
	                <div class="card-body">
	                  	<div class="row">
	                  		<div class="col-sm-6">
	                  			<div class="text-center mb-4">
			                    	<img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 15rem;" src="<?php echo SERVERURL; ?>assets/img/maintenance.svg" alt="info site">
			                  	</div>
	                  		</div>
	                  		<div class="col-sm-6 mb-4">
	                  			<div class="card shadow mb-4 hovAnim">
					                <div class="card-header py-3">
					                  <h6 class="m-0 font-weight-bold text-primary">
					                  	Información
					                  </h6>
					                </div>
					                <div class="card-body">
					                  <p>
					                  	<i class="fas fa-circle mr-2 mb-2 text-primary"></i>
										En este apartado puedes desactivar la cuenta del usuario, desactivar la opción para que haga reportes en caso de que haga un uso inadecuado del modulo, se le notificara en caso de que se le deshabilite la opción para enviar reportes del modulo antes mencionado.
					                  </p>
					                </div>
					            </div>
	                  		</div>
	                  	</div>
	                  	<div class="table-responsive">
			            	<table class="table table-bordered table-hover" id="tbListAdm" width="100%" cellspacing="0">
			                	<thead>
			                    	<tr>
			                      		<th>Nombre:</th>
			                      		<th>Privilegio:</th>
										<th>Cuenta:</th>
										<th>Reportes:</th>
			                    	</tr>
			                	</thead>
			                	<tfoot>
			                    	<tr>
			                     		<th>Nombre:</th>
			                     		<th>Privilegio:</th>
										<th>Cuenta:</th>
										<th>Reportes:</th>
			                    	</tr>
			                	</tfoot>
			                	<tbody></tbody>
			            	</table>
			           </div>
	                </div>
	            </div>
			</div>
		</div>
		<script src="<?php echo SERVERURLDEV; ?>dev/js/dataadm.js"></script>

	<?php
		} else if ($param1 == 'cor') {
	?>
		<div class="row">
			
			<div class="col-sm-12">
				<div class="card shadow mb-4">
	                <div class="card-header py-3">
	                  <h6 class="m-0 font-weight-bold text-primary">
	                  	Funciones coordinador
	                  </h6>
	                </div>
	                <div class="card-body">
	                  	<div class="row">
	                  		<div class="col-sm-6">
	                  			<div class="text-center mb-4">
			                    	<img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 15rem;" src="<?php echo SERVERURL; ?>assets/img/maintenance.svg" alt="info site">
			                  	</div>
	                  		</div>
	                  		<div class="col-sm-6 mb-4">
	                  			<div class="card shadow mb-4 hovAnim">
					                <div class="card-header py-3">
					                  <h6 class="m-0 font-weight-bold text-primary">
					                  	Información
					                  </h6>
					                </div>
					                <div class="card-body">
					                  <p>
					                  	<i class="fas fa-circle mr-2 mb-2 text-primary"></i>
										En este apartado puedes desactivar la cuenta del usuario, desactivar la opción para que haga reportes en caso de que haga un uso inadecuado del modulo, se le notificara en caso de que se le deshabilite la opción para enviar reportes del modulo antes mencionado.
					                  </p>
					                </div>
					            </div>
	                  		</div>
	                  	</div>
	                  	<div class="table-responsive">
			            	<table class="table table-bordered table-hover" id="tbListCor" width="100%" cellspacing="0">
			                	<thead>
			                    	<tr>
			                      		<th>Nombre:</th>
										<th>Cuenta:</th>
										<th>Reportes:</th>
			                    	</tr>
			                	</thead>
			                	<tfoot>
			                    	<tr>
			                     		<th>Nombre:</th>
										<th>Cuenta:</th>
										<th>Reportes:</th>
			                    	</tr>
			                	</tfoot>
			                	<tbody></tbody>
			            	</table>
			           </div>
	                </div>
	            </div>
			</div>
		</div>
		<script src="<?php echo SERVERURLDEV; ?>dev/js/datacor.js"></script>
	<?php
		} else if ($param1 == 'dir') {
	?>

		<div class="row">
			
			<div class="col-sm-12">
				<div class="card shadow mb-4">
	                <div class="card-header py-3">
	                  <h6 class="m-0 font-weight-bold text-primary">
	                  	Funciones director
	                  </h6>
	                </div>
	                <div class="card-body">
	                  	<div class="row">
	                  		<div class="col-sm-6">
	                  			<div class="text-center mb-4">
			                    	<img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 15rem;" src="<?php echo SERVERURL; ?>assets/img/maintenance.svg" alt="info site">
			                  	</div>
	                  		</div>
	                  		<div class="col-sm-6 mb-4">
	                  			<div class="card shadow mb-4 hovAnim">
					                <div class="card-header py-3">
					                  <h6 class="m-0 font-weight-bold text-primary">
					                  	Información
					                  </h6>
					                </div>
					                <div class="card-body">
					                  <p>
					                  	<i class="fas fa-circle mr-2 mb-2 text-primary"></i>
										En este apartado puedes desactivar la cuenta del usuario, desactivar la opción para que haga reportes en caso de que haga un uso inadecuado del modulo, se le notificara en caso de que se le deshabilite la opción para enviar reportes del modulo antes mencionado.
					                  </p>
					                </div>
					            </div>
	                  		</div>
	                  	</div>
	                  	<div class="table-responsive">
			            	<table class="table table-bordered table-hover" id="tbListDir" width="100%" cellspacing="0">
			                	<thead>
			                    	<tr>
			                      		<th>Nombre:</th>
			                      		<th>Carrera:</th>
										<th>Cuenta:</th>
										<th>Reportes:</th>
			                    	</tr>
			                	</thead>
			                	<tfoot>
			                    	<tr>
			                     		<th>Nombre:</th>
			                     		<th>Carrera:</th>
										<th>Cuenta:</th>
										<th>Reportes:</th>
			                    	</tr>
			                	</tfoot>
			                	<tbody></tbody>
			            	</table>
			           </div>
	                </div>
	            </div>
			</div>
		</div>
		<script src="<?php echo SERVERURLDEV; ?>dev/js/datadir.js"></script>

	<?php
		} else if ($param1 == 'doc') {
	?>
		
		<div class="row">
			
			<div class="col-sm-12">
				<div class="card shadow mb-4">
	                <div class="card-header py-3">
	                  <h6 class="m-0 font-weight-bold text-primary">
	                  	Funciones director
	                  </h6>
	                </div>
	                <div class="card-body">
	                  	<div class="row">
	                  		<div class="col-sm-6">
	                  			<div class="text-center mb-4">
			                    	<img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 15rem;" src="<?php echo SERVERURL; ?>assets/img/maintenance.svg" alt="info site">
			                  	</div>
	                  		</div>
	                  		<div class="col-sm-6 mb-4">
	                  			<div class="card shadow mb-4 hovAnim">
					                <div class="card-header py-3">
					                  <h6 class="m-0 font-weight-bold text-primary">
					                  	Información
					                  </h6>
					                </div>
					                <div class="card-body">
					                  <p>
					                  	<i class="fas fa-circle mr-2 mb-2 text-primary"></i>
										En este apartado puedes desactivar la cuenta del usuario, desactivar la opción para que haga reportes en caso de que haga un uso inadecuado del modulo, se le notificara en caso de que se le deshabilite la opción para enviar reportes del modulo antes mencionado.
					                  </p>
					                </div>
					            </div>
	                  		</div>
	                  	</div>
	                  	<div class="table-responsive">
			            	<table class="table table-bordered table-hover" id="tbListDoc" width="100%" cellspacing="0">
			                	<thead>
			                    	<tr>
			                      		<th>Nombre:</th>
			                      		<th>Carrera:</th>
										<th>Cuenta:</th>
										<th>Reportes:</th>
			                    	</tr>
			                	</thead>
			                	<tfoot>
			                    	<tr>
			                     		<th>Nombre:</th>
			                     		<th>Carrera:</th>
										<th>Cuenta:</th>
										<th>Reportes:</th>
			                    	</tr>
			                	</tfoot>
			                	<tbody></tbody>
			            	</table>
			           </div>
	                </div>
	            </div>
			</div>
		</div>
		<script src="<?php echo SERVERURLDEV; ?>dev/js/datadoc.js"></script>

	<?php
		} else {
	?>
		<div class="row">
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

		</div>
	<?php
		}
	?>
	
</div>