<?php

ob_start();
session_start();

if ($_SESSION['keyAdm'] == "" || $_SESSION['keyAdm'] == null) {
	header("Location:../Index.php");
} else {
	include '../modelos/admin.modelo.php';
	$admin = new Administrador();
	$datAdmin = $admin->userAdminDet($_SESSION['keyAdm']);
?>
<?php 
	if ($datAdmin) {
?>
	<?php include 'header2.php'; ?>
	<style type="text/css">
		.ocult{
			display: none;
		}
		tr {
			font-size: 18px;
		}
		tr:hover {
			color: white !important;
			font-weight: bolder;
			transition: 0.5s;
		}
	</style>
	<br><br>
	<br><br>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-4 pad30">
				<h4 class="text-center text-info">
					<i class="fas fa-university fa-lg icoIni"></i>
					Carreras
				</h4>
				<br><br>
				<div class="cardShadow pad30 text-center cardBg">
					<h6>Carreras Activas = <span class="badge badge-pill font-weight-normal text-white bg-primary" id="carAct"></span></h6>
					<h6>Carreras Inactivas = <span class="badge badge-pill font-weight-normal text-white bg-danger" id="carInc"></span></h6>
				</div>
				<br>
				<hr style="height: 2px;" class="bgNav rounded">
				<br>
				<div class="text-center">
					<p class="card-text text-muted">
						<i class="fas fa-lg text-dark icoIni fa-terminal"></i>
						SITUT Versión Beta 1.0.2 
						<i class="fas fa-lg text-dark fa-copyright" style="margin-left: 5px;"></i>
					</p>
				</div><br>
				<div class="text-center">
					<button class="btn btn-secondary">
						<i class="fas fa-clipboard-list icoIni"></i>
						Reportar un problema
					</button>
				</div>
			</div>
			<div class="col-sm-12 col-md-12 col-lg-8">
				<h4 class="text-center mt-4 text-info"> <i class="fas fa-plus icoIni"></i> Registrar Carrera</h4>
				<div class="row">
					<div class="col-sm-1 col-md-12 col-lg-2"></div>
					<form class="col-sm-10 col-md-12 col-lg-8" method="POST" id="formGCarr" name="formGCarr">
						<hr class="bgNav rounded" style="height: 2px;">
						<br>
						<div class="form-group">
							<label for="nomCar">Nombre carrera:</label>
							<input type="text" id="nomCar" name="nomCar" class="form-control">
						</div>
						<div class="form-group">
							<label for="estCar">Estado carrera:</label>
							<select id="estCar" name="estCar" class="form-control">
								<option selected="" disabled="" value="No">Selecciona</option>
								<option value="1">Activa</option>
								<option value="0">Inactiva</option>
							</select>
						</div>
						<hr style="height: 2px;" class="bgNav rounded">
						<div class="form-group text-center">
							<button class="btn btn-outline-primary btn-md" type="submit"> <i class="fas fa-check-circle icoIni"></i> Aceptar</button>
						</div>
					</form>
					<div class="col-sm-1 col-md-12 col-lg-2"></div>
				</div>
			</div>
		</div>
	</div>
	<br><br><br>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<h4 class="text-center">
					<i class="fas fa-list icoIni fa-lg"></i>
					Listado Carreras
				</h4>
				<br>
				<hr style="height: 2px;" class="bgNav rounded">
				<br>
			</div>
		</div>
		<div class="container">
			<div class="row text-center">
				<div class="col-sm-6">
					<button onclick="mostListCarAct(true), mostListCarDes(false)" id="listCarAct" class="btn btn-outline-primary btn-md">
						<i class="fas fa-check fa-lg icoIni"></i>
					 	Activas
					</button>
				</div>
				<div class="col-sm-6">
					<button onclick="mostListCarDes(true), mostListCarAct(false)" id="listCarDes" class="btn btn-outline-danger btn-md">
						<i class="fas fa-times fa-lg icoIni"></i>
						Inactivas
					</button>
				</div>
			</div>
		</div>	
		<div class="row">
			<div class="col-sm-12 text-center ocult" id="tbListadoCarAct">
				<div class="table-responsive pad30">
					<table width="1200" class="table bg-white rounded table-bordered table-hover" id="tbListadoCarrera">
						<thead class="text-primary">
							<th>Carrera:</th>
							<th>Fecha:</th>
							<th>Acciones:</th>
						</thead>
						<tbody class="text-dark"></tbody>
						<tfoot class="text-primary">
							<th>Carrera:</th>
							<th>Fecha:</th>
							<th>Acciones:</th>
						</tfoot>
					</table>
				</div>
			</div>
			<div class="col-sm-12 text-center ocult" id="tbListadoCarDes">
				<div class="table-responsive pad30">
					<table width="1200" class="table bg-white rounded table-bordered table-hover" id="tbListadoCarreraDesc">
						<thead class="text-primary">
							<th>Carrera:</th>
							<th>Fecha:</th>
							<th>Acciones:</th>
						</thead>
						<tbody class="text-dark"></tbody>
						<tfoot class="text-primary">
							<th>Carrera:</th>
							<th>Fecha:</th>
							<th>Acciones:</th>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>
	</div>
	
	<div class="modal fade bgModal" id="editCar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  	<div class="modal-dialog modal-dialog-centered" role="document">
	    	<div class="modal-content">
	      		<div class="modal-header">
	        		<h5 class="modal-title text-info" id="exampleModalLabel"> <i class="fas fa-edit icoNav"></i> Editar carrera</h5>
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
		        	<button type="button" class="btn btn-outline-danger" data-dismiss="modal">
		        		<i class="fas fa-times-circle mr-2"></i>
		        		Cerrar</button>
		        	<button type="submit" class="btn btn-outline-primary">
		        		<i class="fas fa-check-circle mr-2"></i>
		        		Guardar cambios</button>
		        	</form>
		      	</div>
	    	</div>
	  	</div>
	</div>
	<br><br><br>

	<?php include 'modalsIniAdm.php'; ?>
	<?php include 'footer2.php'; ?>
    <!--- Personalizados -->
    <script src="../vistas/modulos/adm/js/confDatCont.js"></script>
    <script src="../vistas/modulos/adm/js/carreras.js"></script>

</body>
</html>

<?php		
	} else {
		header("Location:Logout.php");
	}
?>	
<?php	
	ob_end_flush();
}

?>