<?php


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
          	Registrar Tutor
          </h6>
        </div>
        <div class="card-body">
          <div class="row">
          	<div class="col-sm-6 mb-4">
          		<div class="text-center">
            		<img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 18rem;" src="<?php echo SERVERURL; ?>assets/img/workreg.svg" alt="info site">
          		</div>
          		<div class="card shadow mb-4">
	                <div class="card-header py-3">
	                  <h6 class="m-0 font-weight-bold text-primary">Información</h6>
	                </div>
	                <div class="card-body">
	                  <p>
	                  	Al asignar un tutor a un grupo verifica que el grupo al cual asignaras un tutor no tenga uno asignado ya.
	                	</p>
	                  <a target="_blank" rel="nofollow" href="https://cjtony.github.io/marc.github.io/">
	                    Para mas información consulte al programador
	                    &rarr;
	                  </a>
	                </div>
              	</div>
          	</div>
          	<div class="col-sm-6 mb-4">
          		<form method="POST" id="formRegTutor" name="formRegTutor">
          			<h1 class="h5 mb-4 text-gray-500 text-center"><i class="fas fa-plus mr-2"></i> Añadir tutor</h1>
          			
          			<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<input readonly hidden value="<?= $datDirec->id_carrera;?>" type="text" id="clv_carr" name="clv_carr" class="form-control text-capitalize">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label for="nomTut">Nombre completo:</label>
								<input type="text" id="nomTut" name="nomTut" class="form-control text-capitalize">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="corTut">Correo:</label>
								<input type="email" id="corTut" name="corTut" class="form-control">
								<div style="font-size: 16px;" id="textcorr" class="text-center"></div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="dirTut">Dirección:</label>
						<input type="text" id="dirTut" name="dirTut" class="form-control">
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-6 col-lg-6 form-group">
							<label for="passTut">Contraseña:</label>
							<input type="password" class="form-control" id="passTut" name="passTut">
							<label id="mensaje" class="ocult"></label>
						</div>
						<div class="col-sm-12 col-md-6 col-lg-6 form-group">
							<label for="repPassTut">Repetir contraseña:</label>
							<input type="password" class="form-control" id="repPassTut" name="repPassTut">
							<label id="mensaje2" class="ocult"></label>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-6 col-lg-6 form-group">
							<label for="edaTut">Edad:</label>
							<input type="number" class="form-control" id="edaTut" name="edaTut">
						</div>
						<div class="col-sm-12 col-md-6 col-lg-6 form-group">
							<label for="espTut">Especialidad:</label>
							<input type="text" class="form-control" id="espTut" name="espTut">
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-6 col-lg-6 form-group">
							<label for="telTut">Telefono:</label>
							<input type="tel" class="form-control" id="telTut" name="telTut" pattern="[0-9]{10}">
						</div>
						<div class="col-sm-12 col-md-6 col-lg-6 form-group">
							<label for="estTut">Estado docente</label>
							<select class="form-control" name="estTut" id="estTut">
								<option value="No" selected="">Selecciona</option>
								<option value="1">Activo</option>
								<option value="0">Inactivo</option>
							</select>
						</div>
					</div>
					<div class="form-group text-center mt-4">
						<button id="btnRegTut" class="btn btn-outline-primary btn-dm" type="submit">
							<i class="fas fa-check-circle mr-2"></i>
							Aceptar
						</button>
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
		                <table class="table table-bordered table-hover" id="tbListadoTutores" width="100%" cellspacing="0">
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
		                <table class="table table-bordered table-hover" id="tbListadoTutoresInac" width="100%" cellspacing="0">
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

	
<script src="<?php echo SERVERURLDIR; ?>dir/js/regTutores.js"></script>