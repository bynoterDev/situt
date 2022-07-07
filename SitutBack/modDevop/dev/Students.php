<?php 



?>

<div class="container-fluid animated fadeIn delay-1s">
	
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
	    <h1 class="h3 mb-0 text-gray-800">
	    	<i class="fas fa-users mr-2"></i>
	    	Estudiantes
	    </h1>
	    <a href="<?php echo SERVERURLDEV; ?>Home/" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
	      <i class="fas fa-arrow-left fa-sm text-white-50 mr-2"></i> Regresar 
	    </a>
	</div>

	<div class="row">	
		<div class="col-sm-12">
			<div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">
                  	Listado
                  </h6>
                </div>
                <div class="card-body">
                  	<div class="row">
                  		<div class="col-sm-6">
                  			<div class="text-center mb-4">
		                    	<img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="<?php echo SERVERURL; ?>assets/img/programming.svg" alt="info site">
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
									En este apartado puedes ver los alumnos que estan registrados en el sistema de igual manera acceder a información que sea de utilidad para seguir mejorando la funcionalidad del sistema.
				                  </p>
				                </div>
				            </div>
                  		</div>
                  	</div>
                  	<div class="table-responsive">
		            	<table class="table table-bordered table-hover" id="tbListStd" width="100%" cellspacing="0">
		                	<thead>
		                    	<tr>
		                      		<th>Nombre:</th>
		                      		<th>Carrera:</th>
									<th>Matricula:</th>
									<th>Sexo:</th>
		                    	</tr>
		                	</thead>
		                	<tfoot>
		                    	<tr>
		                     		<th>Nombre:</th>
		                     		<th>Carrera:</th>
									<th>Cuenta:</th>
									<th>Sexo:</th>
		                    	</tr>
		                	</tfoot>
		                	<tbody></tbody>
		            	</table>
		           </div>
                </div>
            </div>
		</div>
	</div>
</div>

<script src="<?php echo SERVERURLDEV; ?>dev/js/stdlist.js"></script>