<?php 

?>

<div class="container-fluid animated fadeIn delay-1s">
	
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
	    <h1 class="h3 mb-0 text-gray-800">
	    	<i class="fas fa-key mr-2"></i>
	    	Contraseña
	    </h1>
	    <a href="<?php echo SERVERURLDEV; ?>Home/" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
	      <i class="fas fa-arrow-left fa-sm text-white-50 mr-2"></i> Regresar 
	    </a>
	</div>

	<div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">
          	Actualizar
          </h6>
        </div>
        <div class="card-body">
          <div class="row mt-4">
          	<div class="col-sm-6">
          		<div class="text-center">
            		<img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 15rem;" src="<?php echo SERVERURL; ?>assets/img/maintenance.svg" alt="info site">
          		</div>
          	</div>
          	<div class="col-sm-5">
          		<form id="formCo">
          			<div class="form-group mb-4">
          				<label for="newPas">Nueva contraseña</label>
          				<input type="password" class="form-control" name="newPas" id="newPas">
          				<div id="message" class="mt-3 mb-3 ml-3"></div>
          			</div>
          			<div class="form-group mb-4">
          				<label for="repPas">Repita la contraseña</label>
          				<input type="password" class="form-control" name="repPas" id="repPas">
          				<div id="message2" class="mt-3 mb-3 ml-3"></div>
          			</div>
          			<div class="form-group mb-4">
          				<label for="actPas">Contraseña actual</label>
          				<input type="password" class="form-control" name="actPas" id="actPas">
          			</div>
          			<div class="text-center border-left-danger mb-4 animated d-none" id="divPro">
          				Ocurrio un problema...
          			</div>
          			<div class="text-center border-left-danger mb-4 animated d-none" id="divFal">
          				Contraseña actual incorrecta
          			</div>
          			<div class="text-center border-left-danger mb-4 animated d-none" id="divErr">
          				Completa todos los campos!
          			</div>
          			<div class="text-center border-left-success mb-4 animated d-none" id="divGod">
          				Contraseña actualizada!
          			</div>
          			<div class="text-center mb-4">
          				<button class="btn btn-primary btn-sm" id="btnAct">
          					<i class="fas fa-check mr-2"></i>
          					Actualizar
          				</button>
          			</div>
          		</form>
          	</div>
          </div>
        </div>
    </div>
</div>

<script src="<?php echo SERVERURLDEV; ?>dev/js/conf/data.js"></script>