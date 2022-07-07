<div class="container-fluid animated fadeIn delay-1s">
	
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Directores</h1>
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
				                  	Antes de registrar a un nuevo director verifique que la cuenta del director a reemplazar halla sido desactivada, de esta manera puede continuar con el proceso de registro.
				                  </p>
				                </div>
				            </div>
	            		</div>
	            		<div class="col-sm-1"></div>
	            		<div class="col-sm-7">
	            			<form class="mb-4" method="POST" id="formGDirector" name="formGDirector">
	            				<h1 class="h5 mb-4 text-gray-500 text-center"><i class="fas fa-plus mr-2"></i> Registrar director</h1>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="nomDir">Nombre completo:</label>
											<input type="text" id="nomDir" name="nomDir" class="form-control text-capitalize">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label for="corDir">Correo:</label>
											<input onkeyup="validEmail()" type="text" id="corDir" name="corDir" class="form-control">
											<div style="font-size: 16px;" id="textcorr" class="text-center"></div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="contDir">Contraseña:</label>
											<input onkeyup="contIgul()" type="password"  id="contDir" name="contDir" class="form-control">
											<label id="mensaje" class="ocult"></label>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label for="repContDir">Repite la contraseña:</label>
											<input onkeyup="contIgul()" type="password" id="repContDir" name="repContDir" class="form-control">
											<label id="mensaje2" class="ocult"></label>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="telDir">Telefono:</label>
											<input type="tel" pattern="[0-9]{10}" id="telDir" name="telDir" class="form-control">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label for="carDir">Carrera:</label>
											<select id="carDir" name="carDir" class="form-control">
												<option selected="" disabled="" value="0">Selecciona</option>
												<?php 
													$sql = "SELECT * FROM carreras WHERE estado_car = 1";
													$result = $conexion->query($sql);
													while ($sel = $result->fetch_object()) {
														echo "<option value='$sel->id_carrera'>
														".$sel->nombre_car."</option>";
													}
												?>
											</select>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label for="estDir">Estado director:</label>
									<select id="estDir" name="estDir" class="form-control">
										<option selected="" disabled="" value="No">Selecciona</option>
										<option value="1">Activo</option>
										<option value="0">Inactivo</option>
									</select>
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
					                  	<span id="dirAct"></span>
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
					                  	<span id="dirInc"></span>
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
					                <table class="table table-bordered table-hover" id="tbListadoDirector" width="100%" cellspacing="0">
					                  <thead>
					                    <tr>
					                      	<th>Nombre:</th>
											<th>Correo:</th>
											<th>Carrera:</th>
											<th>Acciones:</th>
					                    </tr>
					                  </thead>
					                  <tfoot>
					                    <tr>
					                     	<th>Nombre:</th>
											<th>Correo:</th>
											<th>Carrera:</th>
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
					                <table class="table table-bordered table-hover" id="tbListadoDirectorDesc" width="100%" cellspacing="0">
					                  <thead>
					                    <tr>
					                      	<th>Nombre:</th>
											<th>Correo:</th>
											<th>Carrera:</th>
											<th>Acciones:</th>
					                    </tr>
					                  </thead>
					                  <tfoot>
					                    <tr>
					                     	<th>Nombre:</th>
											<th>Correo:</th>
											<th>Carrera:</th>
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

	
	<div class="modal fade bgModal" id="editDirec" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
	    	<div class="modal-content">
	      		<div class="modal-header">
	      			<h6 class="modal-title h5 mb-0 text-gray-700" id="exampleModalLabel"><i class="fas text-gray-300 fa-edit fa-lg icoIni mr-2"></i> Editar director</h6>
	        		<button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
	          		<span aria-hidden="true">&times;</span>
	        		</button>
	      		</div>
		      	<div class="modal-body">
		       		<form class="row" name="formEditDirec" id="formEditDirec" method="POST">
		       			<div class="col-sm-6">
		       				<input type="hidden" id="id_director" name="id_director">
		       				<div class="form-group">
		       					<label for="nomDirEdit">Director:</label>
		       					<input type="text" id="nomDirEdit" name="nomDirEdit" class="form-control">
		       				</div>
		       				<div class="form-group">
		       					<label for="corDirEdit">Correo:</label>
		       					<input type="text" id="corDirEdit" name="corDirEdit" class="form-control">
		       				</div>
		       				<div class="form-group">
		       					<label for="telDirEdit">Telefono:</label>
		       					<input type="text" id="telDirEdit" name="telDirEdit" class="form-control">
		       				</div>
		       			</div>
		       				<div class="col-sm-6">
		       					<div class="form-group">
		       					<label for="fechReg">Fecha registro:</label>
		       					<input readonly="" type="text" id="fechReg" name="fechReg" class="form-control">
		       				</div>
		       				<div class="form-group">
		       					<label for="carrAct">Carrera:</label>
		       					<input type="hidden" id="idcarrera" name="idcarrera" class="form-control">
		       					<input readonly="" type="text" id="carrAct" name="carrAct" class="form-control">
		       				</div>
		       				<div class="form-group">
		       					<label for="carDirEdit">Nueva carrera:</label>
		       					<select name="carDirEdit" id="carDirEdit" class="form-control">
		       						<option selected="" value="0">Selecciona</option>
									<?php 
										$dbc = new Connect();
										$dbc = $dbc -> getDB();
										$valid = 1;
										$stmt = $dbc -> prepare("SELECT * FROM carreras WHERE estado_car = :valid");
										$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
										$stmt -> execute();
										while ($sel = $stmt -> fetch(PDO::FETCH_OBJ)) {
											echo "<option value='$sel->id_carrera'>
											".$sel->nombre_car."</option>";	
										}
									?>
		       					</select>
		       				</div>
		       				</div>
		       				<div class="col-sm-3"></div>
		       				<div class="col-sm-6 mt-3">
		       					<div class="form-group text-center">
			       					<label for="contAdmAct" class="text-primary">Introduce tu contraseña para actualizar:</label>
			       					<input type="password" id="contAdmAct" name="contAdmAct" class="form-control">
		       					</div>
		       				</div>
		      	</div>
		      	<div class="modal-footer">
		        	<button type="button" class="btn btn-sm btn-outline-danger" data-dismiss="modal">
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

	<div class="modal fade bgModal" id="editNewPassDir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  	<div class="modal-dialog modal-dialog-centered" role="document">
	    	<div class="modal-content">
	      		<div class="modal-header">
	        		<h6 class="modal-title h5 mb-0 text-gray-700" id="exampleModalLabel"><i class="fas text-gray-300 fa-key fa-lg icoIni mr-2"></i> Nueva contraseña</h6>
	        		<button type="button" id="btnCloseIcoPasDir" class="close text-danger" data-dismiss="modal" aria-label="Close">
	          		<span aria-hidden="true">&times;</span>
	        		</button>
	      		</div>
		      	<div class="modal-body">
		       		<form class="row" name="formNewPasDir" id="formNewPasDir" method="POST">
		       			<div class="col-sm-1"></div>
		       			<div class="col-sm-10">
		       				<div class="form-group">
		       					<input class="form-control" type="hidden" id="idDirNewCont" readonly="" name="id_director">
		       				</div>
		       				<div class="form-group">
		       					<label>Nueva contraseña:</label>
		       					<input type="password" class="form-control" id="newContDir" name="newContDir">
		       					<div id="validPasNewDir1"></div>
		       				</div>
		       				<div class="form-group">
		       					<label>Repite la contraseña:</label>
								<input type="password" class="form-control" id="repContNewDir" name="repContNewDir">
								<div id="validPasNewDir2"></div>
		       				</div>
		       				<div class="form-group">
		       					<label>Ingresa tu contraseña:</label>
		       					<input type="password" class="form-control" id="confNewPasDir" name="confNewPasDir">
		       				</div>
		       			</div>
		       			<div class="col-sm-1"></div>
		      	</div>
		      	<div class="modal-footer">
		        	<button id="btnClosePasNewDir" type="button" class="btn btn-sm btn-outline-danger" data-dismiss="modal">
		        		<i class="fas fa-times-circle mr-2"></i>
		        		Cerrar</button>
		        	<button id="btnGNewPasDir" type="submit" class="btn btn-sm btn-outline-primary">
		        		<i class="fas fa-check-circle mr-2"></i>
		        		Guardar cambios</button>
		        	</form>
		      	</div>
	    	</div>
	  	</div>
	</div>

    <script src="<?php echo SERVERURLADM; ?>adm/js/directores.js"></script>

