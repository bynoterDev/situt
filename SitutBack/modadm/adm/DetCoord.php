<div class="container-fluid animated fadeIn delay-1s">
	
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Coordinadores</h1>
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
				                  	Asegurate de insertar los datos correctos en cada uno de los campos correspondientes.
				                  </p>
				                </div>
				            </div>
	            		</div>
	            		<div class="col-sm-1"></div>
	            		<div class="col-sm-7">
							<form class="mb-4" method="POST" id="formGCord" name="formGCord">
								<h1 class="h5 mb-4 text-gray-500 text-center"><i class="fas fa-plus mr-2"></i> Registrar coordinador</h1>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="nomCor">Nombre completo:</label>
											<input type="text" id="nomCor" name="nomCor" class="form-control text-capitalize">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label for="corCord">Correo:</label>
											<input type="text" id="corCord" name="corCord" class="form-control">
											<div style="font-size: 16px;" id="textcorr" class="text-center"></div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="contCor">Contraseña:</label>
											<input type="password" id="contCor" name="contCor" class="form-control">
											<div id="mensaje"></div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label for="repContCor">Repite la contraseña:</label>
											<input type="password" id="repContCor" name="repContCor" class="form-control">
											<div id="mensaje2"></div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="telCor">Telefono:</label>
											<input type="tel" pattern="[0-9]{10}" id="telCor" name="telCor" class="form-control">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label for="sexCor">Sexo:</label>
											<select id="sexCor" name="sexCor" class="form-control">
												<option selected="" value="0">Selecciona</option>
												<option value="Femenino">Femenino</option>
												<option value="Masculino">Masculino</option>
											</select>
										</div>
									</div>
								</div>
								<div class="form-group text-center mt-4">
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
							<div class="card border-left-info shadow py-2 mt-5 mb-4 ">
					            <div class="card-body">
					              <div class="row no-gutters align-items-center">
					                <div class="col mr-2">
					                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Cuentas activas.</div>
					                  <div class="h5 mb-0 font-weight-bold text-gray-800">
					                  	<span id="corAct"></span>
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
							<div class="card border-left-danger shadow py-2 mt-5 mb-4">
					            <div class="card-body">
					              <div class="row no-gutters align-items-center">
					                <div class="col mr-2">
					                  <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Cuentas inactivas.</div>
					                  <div class="h5 mb-0 font-weight-bold text-gray-800">
					                  	<span id="corInc"></span>
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
							    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Activos</a>
							  </li>
							  <li class="nav-item">
							    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Inactivos</a>
							  </li>
							</ul>
							<div class="tab-content" id="pills-tabContent">
							  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
							  	<div class="table-responsive">
					                <table class="table table-bordered table-hover" id="tbListadoCorAct" width="100%" cellspacing="0">
					                  <thead>
					                    <tr>
					                      	<th>Nombre:</th>
											<th>Correo:</th>
											<th>Telefono:</th>
											<th>Acciones:</th>
					                    </tr>
					                  </thead>
					                  <tfoot>
					                    <tr>
					                     	<th>Nombre:</th>
											<th>Correo:</th>
											<th>Telefono:</th>
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
					                <table class="table table-bordered table-hover" id="tbListadoCorInc" width="100%" cellspacing="0">
					                  <thead>
					                    <tr>
					                      	<th>Nombre:</th>
											<th>Correo:</th>
											<th>Telefono:</th>
											<th>Acciones:</th>
					                    </tr>
					                  </thead>
					                  <tfoot>
					                    <tr>
					                     	<th>Nombre:</th>
											<th>Correo:</th>
											<th>Telefono:</th>
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


	
	<div class="modal fade bgModal" id="editCor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  	<div class="modal-dialog modal-dialog-centered" role="document">
	    	<div class="modal-content">
	      		<div class="modal-header">
	      			<h6 class="modal-title h5 mb-0 text-gray-700" id="exampleModalLabel"><i class="fas text-gray-300 fa-edit fa-lg icoIni mr-2"></i> Editar coordinador</h6>
	        		<button id="closIco" type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
	          		<span aria-hidden="true">&times;</span>
	        		</button>
	      		</div>
		      	<div class="modal-body">
		       		<form class="row" name="formEditCor" id="formEditCor" method="POST">
		       			<div class="col-sm-1"></div>
		       			<div class="col-sm-10">
		       				<input type="hidden" id="id_coordinador" name="id_coordinador">
		       				<div class="form-group">
		       					<label for="nomCorEdit">Nombre:</label>
		       					<input type="text" id="nomCorEdit" name="nomCorEdit" class="form-control">
		       				</div>
		       				<div class="form-group">
		       					<label for="corCorEdit">Correo electronico:</label>
		       					<input type="email" id="corCorEdit" name="corCorEdit" class="form-control">
		       					<div style="font-size: 16px;" id="textcorredit" class="text-center"></div>
		       				</div>
		       				<div class="form-group">
		       					<label for="telCorEdit">Telefono:</label>
		       					<input type="tel" pattern="[0-9]{10}" id="telCorEdit" name="telCorEdit" class="form-control">
		       				</div>
		       				<div class="form-group">
		       					<label for="pasConfAdm">Introduce tu contraseña para actualizar:</label>
		       					<input type="password" id="pasConfAdm" name="pasConfAdm" class="form-control">
		       				</div>
		       			</div>
		       			<div class="col-sm-1"></div>
		      	</div>
		      	<div class="modal-footer">
		        	<button id="btnClosIco" type="button" class="btn btn-sm btn-outline-danger" data-dismiss="modal">
		        		<i class="fas fa-times-circle mr-2"></i>
		        		Cerrar</button>
		        	<button type="submit" id="btnEditCor" class="btn btn-sm btn-outline-primary">
		        		<i class="fas fa-check-circle mr-2"></i>
		        		Guardar cambios</button>
		        	</form>
		      	</div>
	    	</div>
	  	</div>
	</div>

	<div class="modal fade bgModal" id="editNewPasCor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  	<div class="modal-dialog modal-dialog-centered" role="document">
	    	<div class="modal-content">
	      		<div class="modal-header">
	      			<h6 class="modal-title h5 mb-0 text-gray-700" id="exampleModalLabel"><i class="fas text-gray-300 fa-key fa-lg icoIni mr-2"></i> Nueva contraseña</h6>

	        		<button type="button" id="btnCloseIcoPasCor" class="close text-danger" data-dismiss="modal" aria-label="Close">
	          		<span aria-hidden="true">&times;</span>
	        		</button>
	      		</div>
		      	<div class="modal-body">
		       		<form class="row" name="formNewPasCor" id="formNewPasCor" method="POST">
		       			<div class="col-sm-1"></div>
		       			<div class="col-sm-10">
		       				<div class="form-group">
		       					<input class="form-control" type="hidden" id="idCorNewCont" readonly="" name="id_coordinador">
		       				</div>
		       				<div class="form-group">
		       					<label>Nueva contraseña:</label>
		       					<input type="password" class="form-control" id="newContCor" name="newContCor">
		       					<div id="validPasNewCor1"></div>
		       				</div>
		       				<div class="form-group">
		       					<label>Repite la contraseña:</label>
								<input type="password" class="form-control" id="repContNewCor" name="repContNewCor">
								<div id="validPasNewCor2"></div>
		       				</div>
		       				<div class="form-group">
		       					<label>Ingresa tu contraseña:</label>
		       					<input type="password" class="form-control" id="confNewPasCor" name="confNewPasCor">
		       				</div>
		       			</div>
		       			<div class="col-sm-1"></div>
		      	</div>
		      	<div class="modal-footer">
		        	<button id="btnClosePasNewCor" type="button" class="btn btn-sm btn-outline-danger" data-dismiss="modal">
		        		<i class="fas fa-times-circle mr-2"></i>
		        		Cerrar</button>
		        	<button id="btnGNewPasCor" type="submit" class="btn btn-sm btn-outline-primary">
		        		<i class="fas fa-check-circle mr-2"></i>
		        		Guardar cambios</button>
		        	</form>
		      	</div>
	    	</div>
	  	</div>
	</div>

    <script src="<?php echo SERVERURLADM; ?>adm/js/coordinadores.js"></script>
