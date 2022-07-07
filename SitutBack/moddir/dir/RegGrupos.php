<?php

	$datDirec = $director->userDirDet($keyDir);
	$car_Dir = $datDirec->id_carrera;
	

?>

<div class="container-fluid mt-4 animated fadeIn delay-1s">
		
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">
		    <i class="fas fa-user mr-2 text-primary"></i>
			<b><?php echo "Dirección de: ".$datDirec->nombre_car; ?>.
		</h1>
		<a href="<?php echo SERVERURLDIR; ?>Home/" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
		   	<i class="fas fa-arrow-left fa-sm text-white-50 mr-2"></i> Regresar 
		</a>
	</div>

	<div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">
              	Registrar Grupo
              </h6>
            </div>
            <div class="card-body">
              <div class="row">
              	<div class="col-sm-6 mb-4">
              		<div class="text-center">
                		<img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 18rem;" src="<?php echo SERVERURL; ?>assets/img/workreg.svg" alt="info site">
              		</div>
              	</div>
              	<div class="col-sm-6 mb-4">
              		<form method="POST" id="formRegGrp" name="formRegGrp">
              			<h1 class="h5 mb-4 text-gray-500 text-center"><i class="fas fa-plus mr-2"></i> Añadir grupo</h1>
						<div class="">
							<div class="form-group">
								<input readonly="" type="hidden" class="form-control" value="<?php echo $datDirec->id_carrera; ?>" name="id_carrera">
							</div>
							<div class="form-group">
								<label for="grpDet">Grupo:</label>
								<select name="grpDet" id="grpDet" class="form-control">
									<option selected="" value="No">Selecciona</option>
									<?php 
										$sql = "SELECT * FROM grupos";
										$result = $conexion->query($sql);
										while ($res = $result->fetch_object()) {
											echo "<option value=".$res->id_grupo.">".$res->grupo_n."</option>";
										}
									?>
								</select>
							</div>
							<div class="form-group">
								<label for="docGrp">Tutor:</label>
								<select class="form-control" id="docGrp" name="docGrp">
									<option selected="" value="No">Selecciona</option>
									<?php 
										$sql = "SELECT * FROM docentes where id_carrera = " . $datDirec->id_carrera;
										$result = $conexion->query($sql);
										while ($res = $result->fetch_object()) {
											echo "<option value=".$res->id_docente.">"
													.$res->nombre_c_doc.
												"</option>";
										}
									?>
								</select>
							</div>
							<div class="form-group">
								<label for="estGrp">Estado:</label>
								<select class="form-control" name="estGrp" id="estGrp">
									<option value="No">Selecciona</option>
									<option value="1" selected="">Activo</option>
									<option value="0">Inactivo</option>
								</select>
							</div>
							<div class="form-group text-center">
								<button type="submit" class="btn btn-primary btn-sm">
									<i class="fas fa-check-circle mr-2"></i>
									Aceptar
								</button>
							</div>
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
					                <table class="table table-bordered table-hover" id="tbListadoGrpAct" width="100%" cellspacing="0">
					                  <thead>
					                    <tr>
					                      	<th>Grupo:</th>
											<th>Docente:</th>
											<th>Acciones:</th>
					                    </tr>
					                  </thead>
					                  <tfoot>
					                    <tr>
					                     	<th>Grupo:</th>
											<th>Docente:</th>
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
					                <table class="table table-bordered table-hover" id="tbListadoGrpDes" width="100%" cellspacing="0">
					                  <thead>
					                    <tr>
					                      	<th>Grupo:</th>
											<th>Docente:</th>
											<th>Acciones:</th>
					                    </tr>
					                  </thead>
					                  <tfoot>
					                    <tr>
					                     	<th>Grupo:</th>
											<th>Docente:</th>
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




	<div class="modal fade bgModal" id="editGrp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  	<div class="modal-dialog modal-dialog-centered" role="document">
	    	<div class="modal-content">
	      		<div class="modal-header">
	        		<h5 class="modal-title" id="exampleModalLabel"> <i class="fas fa-edit icoNav"></i> Editar grupo
	        			<span id="grpnam" class="badge badge-pill bg-primary text-white" style="font-size: 20px; padding: 10px;">
	        				
	        			</span>
	        		</h5>
	        		<button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
	          		<span aria-hidden="true">&times;</span>
	        		</button>
	      		</div>
		      	<div class="modal-body">
		       		<form class="row" name="formEditGrp" id="formEditGrp" method="POST">
		       			<div class="col-sm-1"></div>
		       			<div class="col-sm-10">
		       				<input type="hidden" class="form-control" id="id_detgrupo" name="id_detgrupo">
		       				<input type="hidden" class="form-control" id="id_grupo" name="id_grupo">
		       				<input type="hidden" class="form-control" id="id_docente" name="id_docente">
		       				<div class="form-group">
		       					<label>Tutor actual:</label>
		       					<input type="text" class="form-control text-uppercase" readonly="" name="tutAct" id="tutAct">
		       				</div>
		       				<div class="form-group">
		       					<label for="tutGrpEdit">Nuevo grupo:</label>
								<select name="tutGrpEdit" id="tutGrpEdit" class="form-control">
									<option selected="" value="No">Selecciona</option>
									<?php 
										$sql = "SELECT * FROM grupos";
										$result = $conexion->query($sql);
										while ($res = $result->fetch_object()) {
											echo "<option value=".$res->id_grupo.">".$res->grupo_n."</option>";
										}
									?>
								</select>
								<label for="nuevoTutor">Nuevo Tutor:</label>
								<select name="nuevoTutor" id="nuevoTutor" class="form-control">
									<option selected="" value="No">Selecciona</option>
									<?php 
										$sqlDoc = "SELECT * FROM docentes";
										$result = $conexion->query($sqlDoc);
										while ($res = $result->fetch_object()) {
											echo "<option value=".$res->id_docente.">".$res->nombre_c_doc."</option>";
										}
									?>
								</select>
		       				</div>
		       				<!--
		       				<div class="form-group">
		       					<label for="passConf">Introduce tu contraseña para actualizar:</label>
		       					<input type="password" id="passConf" name="passConf" class="form-control">
		       				</div>
		       			-->
		       			</div>
		       			<div class="col-sm-1"></div>
		      	</div>
		      	<div class="modal-footer">
		        	<button type="button" class="btn btn-sm btn-outline-danger" data-dismiss="modal">
		        		<i class="fas fa-times-circle mr-2 ml-2"></i>
		        		Cerrar</button>
		        	<button type="submit" class="btn btn-sm btn-outline-primary">
		        		<i class="fas fa-check-circle mr-2 ml-2"></i>
		        		Guardar cambios</button>
		        	</form>
		      	</div>
	    	</div>
	  	</div>
</div>


<script src="<?php echo SERVERURLDIR; ?>dir/js/regGrupos1.js"></script>
