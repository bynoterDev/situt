<div class="container-fluid animated fadeIn delay-1s">


<?php 
	if ($datAdmin->privileg == "ALL") {
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Administradores</h1>
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
	            			<div class="text-center">
	            				<img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 15rem;" src="<?php echo SERVERURL; ?>assets/img/browstac.svg" alt="info site">
	            			</div>
	            			<div class="card border-left-info shadow py-2 mb-4 ">
					            <div class="card-body">
					              <div class="row no-gutters align-items-center">
					                <div class="col mr-2">
					                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Cuentas activas.</div>
					                  <div class="h5 mb-0 font-weight-bold text-gray-800">
					                  	<span id="admAct"></span>
					                  </div>
					                </div>
					                <div class="col-auto">
					                  <i class="fas fa-check fa-2x text-gray-300"></i>
					                </div>
					              </div>
					            </div>
					        </div>
					        <div class="card border-left-danger shadow py-2 mb-4">
					            <div class="card-body">
					              <div class="row no-gutters align-items-center">
					                <div class="col mr-2">
					                  <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Cuentas inactivas.</div>
					                  <div class="h5 mb-0 font-weight-bold text-gray-800">
					                  	<span id="admInc"></span>
					                  </div>
					                </div>
					                <div class="col-auto">
					                  <i class="fas fa-times fa-2x text-gray-300"></i>
					                </div>
					              </div>
					            </div>
					        </div>
	            		</div>
	            		<div class="col-sm-1"></div>
	            		<div class="col-sm-7">
	            			<form class=" mb-4" method="POST" id="formGAdmin" name="formGAdmin">
	            				<h1 class="h5 mb-4 text-gray-500 text-center"><i class="fas fa-plus mr-2"></i> Registrar administrador</h1>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="nomAdmin">Nombre completo:</label>
											<input type="text" id="nomAdmin" name="nomAdmin" class="form-control text-capitalize">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label for="corAdmin">Correo:</label>
											<input onkeyup="validEmail()" type="text" id="corAdmin" name="corAdmin" class="form-control">
											<div style="font-size: 16px;" id="textcorr" class="text-center"></div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="contAdm">Contraseña:</label>
											<input onkeyup="contIgul()" type="password" id="contAdm" name="contAdm" class="form-control">
											<label id="mensaje" class="ocult"></label>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label for="repContAdm">Repite la contraseña:</label>
											<input onkeyup="contIgul()" type="password" id="repContAdm" name="repContAdm" class="form-control">
											<label id="mensaje2" class="ocult"></label>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="usAdm">Usuario:</label>
											<input type="text" id="usAdm" name="usAdm" class="form-control">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label for="estAdm">Estado administrador:</label>
											<select id="estAdm" name="estAdm" class="form-control">
												<option selected="" disabled="" value="No">Selecciona</option>
												<option value="1">Activo</option>
												<option value="0">Inactivo</option>
											</select>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label for="privAdm">Privilegios administrador:</label>
									<select id="privAdm" name="privAdm" class="form-control">
										<option selected="" disabled="" value="0">Selecciona</option>
										<option value="ALL">Todos</option>
										<option value="LIM">Limitados</option>
									</select>
								</div>
								<div class="form-group text-center mt-4">
									<button id="btnGAdmin" class="btn btn-primary btn-sm" type="submit"> <i class="fas fa-check-circle icoIni mr-2"></i> Aceptar</button>
								</div>
							</form>
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
					                <table class="table table-bordered table-hover" id="tbListadoAdmin" width="100%" cellspacing="0">
					                  <thead>
					                    <tr>
					                      	<th>Nombre:</th>
											<th>Correo:</th>
											<th>Usuario:</th>
											<th>Privilegio:</th>
											<th>Acciones:</th>
					                    </tr>
					                  </thead>
					                  <tfoot>
					                    <tr>
					                     	<th>Nombre:</th>
											<th>Correo:</th>
											<th>Usuario:</th>
											<th>Privilegio:</th>
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
					                <table class="table table-bordered table-hover" id="tbListadoAdminDesc" width="100%" cellspacing="0">
					                  <thead>
					                    <tr>
					                      	<th>Nombre:</th>
											<th>Correo:</th>
											<th>Usuario:</th>
											<th>Privilegio:</th>
											<th>Acciones:</th>
					                    </tr>
					                  </thead>
					                  <tfoot>
					                    <tr>
					                     	<th>Nombre:</th>
											<th>Correo:</th>
											<th>Usuario:</th>
											<th>Privilegio:</th>
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

	<div class="modal fade bgModal" id="editAdm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
	    	<div class="modal-content">
	      		<div class="modal-header">
	        		<h6 class="modal-title h5 mb-0 text-gray-700" id="exampleModalLabel"><i class="fas text-gray-300 fa-edit fa-lg icoIni mr-2"></i> Editar director</h6>
	        		<button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
	          		<span aria-hidden="true">&times;</span>
	        		</button>
	      		</div>
		      	<div class="modal-body">
		       		<form class="row" name="formEditAdm" id="formEditAdm" method="POST">
		       			<div class="col-sm-6">
		       				<input type="hidden" id="id_admin" name="id_admin">
		       				<div class="form-group">
		       					<label for="nomAdmEdit">Nombre:</label>
		       					<input type="text" id="nomAdmEdit" name="nomAdmEdit" class="form-control">
		       				</div>
		       				<div class="form-group">
		       					<label for="corAdmEdit">Correo:</label>
		       					<input onkeyup="validEmailEdit()" type="text" id="corAdmEdit" name="corAdmEdit" class="form-control">
		       					<div style="font-size: 16px;" id="textcorredit" class="text-center"></div>
		       				</div>
		       				<div class="form-group">
		       					<label for="usAdmEdit">Usuario:</label>
		       					<input type="text" id="usAdmEdit" name="usAdmEdit" class="form-control">
		       				</div>
		       			</div>
		       			<div class="col-sm-6">
		       				<div class="form-group">
		       					<label for="fechRegAdm">Fecha registro:</label>
		       					<input readonly="" type="text" id="fechRegAdm" name="fechRegAdm" class="form-control">
		       				</div>
		       				<div class="form-group">
		       					<label for="privAct">Privilegio:</label>
		       					<input readonly="" type="text" id="privAct" name="privAct" class="form-control">
		       				</div>
		       				<div class="form-group">
								<label for="privAdmEdit">Privilegios administrador:</label>
								<select id="privAdmEdit" name="privAdmEdit" class="form-control">
									<option selected="" value="0">Selecciona</option>
									<option value="ALL">Todos</option>
									<option value="LIM">Limitados</option>
								</select>
							</div>
		       			</div>
		       			<div class="col-sm-3"></div>
		       			<div class="col-sm-6 mt-3">
		       				<div class="form-group text-center">
								<label for="contAdmAct" class="text-primary">Introduce tu contraseña para actualizar</label>
								<input type="password" id="contAdmAct" name="contAdmAct" class="form-control">
							</div>
		       			</div>
		      	</div>
		      	<div class="modal-footer">
		        	<button type="button" class="btn btn-sm btn-outline-danger" data-dismiss="modal">
		        		<i class="fas fa-times-circle mr-2"></i>
		        		Cerrar</button>
		        	<button id="btnAdmEdit" type="submit" class="btn btn-sm btn-outline-primary">
		        		<i class="fas fa-check-circle mr-2"></i>
		        		Guardar cambios</button>
		        	</form>
		      	</div>
	    	</div>
	  	</div>
	</div>

	<script src="<?php echo SERVERURLADM; ?>adm/js/admin.js"></script>

<?php
	} else {
?>
	<div class="col-sm-12 mt-5">
      <div class="text-center">
        <div class="error mx-auto" data-text="404">404</div>
        <p class="lead text-gray-800 mb-5">Pagina no encontrada...</p>
        <p class="text-gray-500 mb-0">
          Al parecer hubo un problema al momento de buscar una pagina inexistente...
        </p>
        <a href="<?php echo SERVERURLADM; ?>Home/">&larr; Volver al inicio</a>
      </div>
    </div>
<?php
	}
?>

</div>
	
