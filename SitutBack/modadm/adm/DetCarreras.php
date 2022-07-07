<div class="container-fluid animated fadeIn delay-1s">
	
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Carreras</h1>
        <a href="<?php echo SERVERURLADM; ?>Home/" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
          <i class="fas fa-arrow-left fa-sm text-white-50 mr-2"></i> Regresar 
        </a>
    </div>

	<div class="row">
		
		<div class="col-sm-12">
			<div class="card shadow mb-4">
	            <div class="card-header py-3">
	              <h6 class="m-0 font-weight-bold text-primary">Detalles y opciones</h6>
	            </div>
	            <div class="card-body">
	            	<div class="row">
	            		<div class="col-sm-4">
	            			<div class="card shadow mb-4 hovAnim">
				                <div class="card-header py-3">
				                  <h6 class="m-0 font-weight-bold text-primary">
				                  	<i class="fas fa-info-circle mr-2"></i> Información
				                  </h6>
				                </div>
				                <div class="card-body">
				                	<div class="text-center">
			            				<img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 15rem;" src="<?php echo SERVERURL; ?>assets/img/questions.svg" alt="info site">
			            			</div>
				                  <p>
				                  	Una carrera inactiva no es visible para los alumnos al momento de registrarse.
				                  </p>
				                </div>
				            </div>
	            		</div>
	            		<div class="col-sm-2"></div>
	            		<div class="col-sm-6">
	            			<form class="mb-4" method="POST" id="formGCarr" name="formGCarr">
	            				<h1 class="h5 mb-4 text-gray-500 text-center"><i class="fas fa-plus mr-2"></i> Registrar carrera</h1>
								<div class="form-group">
									<label for="nomCar">Nombre carrera:</label>
									<input type="text" id="nomCar" name="nomCar" class="form-control">
								</div>
								<div class="form-group">
									<label for="estCar">Estado carrera:</label>
									<select id="estCar" name="estCar" class="form-control">
										<option disabled="" value="No">Selecciona</option>
										<option selected="" value="1">Activa</option>
										<option value="0">Inactiva</option>
									</select>
								</div>
								<div class="form-group text-center mt-4 mb-4">
									<button id="btnGAdmin" class="btn btn-primary btn-sm" type="submit"> <i class="fas fa-check-circle icoIni mr-2"></i> Aceptar</button>
								</div>
							</form>
	            		</div>
	            		<div class="col-sm-4">
	            			<div class="text-center">
	            				<img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 15rem;" src="<?php echo SERVERURL; ?>assets/img/browstac.svg" alt="info site">
	            			</div>
	            		</div>

	            		<div class="col-sm-4">
	            			<div class="card border-left-info shadow py-2 mb-4 mt-5">
					            <div class="card-body">
					              <div class="row no-gutters align-items-center">
					                <div class="col mr-2">
					                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Carreras activas.</div>
					                  <div class="h5 mb-0 font-weight-bold text-gray-800">
					                  	<span id="carAct"></span>
					                  </div>
					                </div>
					                <div class="col-auto">
					                  <i class="fas fa-check fa-2x text-gray-300"></i>
					                </div>
					              </div>
					            </div>
					        </div>
	            		</div>

						<div class="col-sm-4">
							<div class="card border-left-danger shadow py-2 mb-4 mt-5">
					            <div class="card-body">
					              <div class="row no-gutters align-items-center">
					                <div class="col mr-2">
					                  <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Carreras inactivas.</div>
					                  <div class="h5 mb-0 font-weight-bold text-gray-800">
					                  	<span id="carInc"></span>
					                  </div>
					                </div>
					                <div class="col-auto">
					                  <i class="fas fa-times fa-2x text-gray-300"></i>
					                </div>
					              </div>
					            </div>
					        </div>
						</div>

	            		<div class="col-sm-12 mt-4">
	            			<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
							  <li class="nav-item">
							    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Activas</a>
							  </li>
							  <li class="nav-item">
							    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Inactivas</a>
							  </li>
							</ul>
							<div class="tab-content" id="pills-tabContent">
							  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
							  	<div class="table-responsive">
					                <table class="table table-bordered table-hover" id="tbListadoCarrera" width="100%" cellspacing="0">
					                  <thead>
					                    <tr>
					                      	<th>Carrera:</th>
											<th>Fecha:</th>
											<th>Acciones:</th>
					                    </tr>
					                  </thead>
					                  <tfoot>
					                    <tr>
					                     	<th>Carrera:</th>
											<th>Fecha:</th>
											<th>Acciones:</th>
					                    </tr>
					                  </tfoot>
					                  <tbody>
					                  </tbody>
					                </table>
					            </div>
							  </div>
							  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
							  	<div class="table-responsive">
					                <table class="table table-bordered table-hover" id="tbListadoCarreraDesc" width="100%" cellspacing="0">
					                  <thead>
					                    <tr>
					                      	<th>Carrera:</th>
											<th>Fecha:</th>
											<th>Acciones:</th>
					                    </tr>
					                  </thead>
					                  <tfoot>
					                    <tr>
					                     	<th>Carrera:</th>
											<th>Fecha:</th>
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
	        </div>
		</div>

	</div>

</div>



	
	
	<div class="modal fade bgModal" id="editCar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  	<div class="modal-dialog modal-dialog-centered" role="document">
	    	<div class="modal-content">
	      		<div class="modal-header">
	      			<h6 class="modal-title h5 mb-0 text-gray-700" id="exampleModalLabel"><i class="fas text-gray-300 fa-edit fa-lg icoIni mr-2"></i> Editar carrera</h6>
	        		<button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
	          		<span aria-hidden="true">&times;</span>
	        		</button>
	      		</div>
		      	<div class="modal-body">
		       		<form class="row" name="formEditCar" id="formEditCar" method="POST">
		       			<div class="col-sm-1"></div>
		       			<div class="col-sm-10">
		       				<input type="hidden" id="id_carrera" name="id_carrera">
		       				<div class="form-group">
		       					<label for="nomCarEdit">Nombre carrera:</label>
		       					<input type="text" id="nomCarEdit" name="nomCarEdit" class="form-control">
		       				</div>
		       			</div>
		       			<div class="col-sm-1"></div>
		      	</div>
		      	<div class="modal-footer">
		        	<button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal">
		        		<i class="fas fa-times-circle mr-2"></i>
		        		Cerrar</button>
		        	<button type="submit" class="btn btn-sm btn-outline-primary">
		        		<i class="fas fa-check-circle mr-2"></i>
		        		Guardar cambios</button>
		        	</form>
		      	</div>
	    	</div>
	  	</div>
	</div>

    <script src="<?php echo SERVERURLADM; ?>adm/js/carreras.js"></script>
