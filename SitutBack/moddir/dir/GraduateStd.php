<?php 


?>

<div class="container-fluid animated fadeIn delay-1s">
	
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">
		    <i class="fas fa-user mr-2 text-primary"></i>
			<b><?php echo "Dirección de: ".$datDirec->nombre_car; ?>.
		</h1>
		<a href="<?php echo SERVERURLDIR; ?>Home/" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
		   	<i class="fas fa-home fa-sm text-white-50 mr-2"></i> Inicio 
		</a>
	</div>

	<div class="row">
		<div class="col-sm-12">
			<div class="card shadow mb-4">
	            <div class="card-header py-3">
	              <h6 class="m-0 font-weight-bold text-primary">Alumnos que cursan el ultimo cuatrimestre</h6>
	            </div>
	            <div class="card-body">
	            	<div class="table-responsive">
		                <table class="table table-bordered table-hover" id="tbListadoGraduate" width="100%" cellspacing="0">
		                  <thead>
		                    <tr>
		                      	<th>Nombre:</th>
								<th>Correo:</th>
								<th>Grupo:</th>
								<th>Acciones:</th>
		                    </tr>
		                  </thead>
		                  <tfoot>
		                    <tr>
		                     	<th>Nombre:</th>
								<th>Correo:</th>
								<th>Grupo:</th>
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

<script src="<?php echo SERVERURLDIR; ?>dir/js/graduate.js"></script>