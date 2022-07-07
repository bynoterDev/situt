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
		body {
			background-color: white !important;
			/*background-color: #FAFAFA;*/
			/*background-color: #ECEFF1;*/
		}
		.bgNav {
			/*1B5E20*/
			background-color: #28a745;
		}
		.ocult {
			display: none;
		}
		.bgSld {
			background: rgba(255, 255, 255, 0.6);
			color:#263238;
			border-radius: 10px;
		}
	</style>
	<style type="text/css">
		/*body {
			background-color: #fafafa;
		}*/
		.ocult{
			display: none;
		}
	</style>
	<br><br><br><br>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-4 pad30">
				<h4 class="text-center text-info">
					<i class="fas fa-user-tie fa-lg icoIni"></i>
					Coordinadores Academicos
				</h4>
				<br><br>
				<div class="cardShadow pad30 text-center cardBg">
					<h6>Cuentas Activas = <span class="badge badge-pill font-weight-normal bg-primary text-white" id="corAct"></span></h6>
					<h6>Cuentas Inactivas = <span class="badge badge-pill font-weight-normal bg-danger text-white" id="corInc"></span></h6>
				</div>
				<br>
				<hr style="height: 2px;" class="bg-primary rounded">
				<br>
				<div class="text-center">
					<p class="card-text text-muted">
						<i class="fas fa-lg text-dark icoIni fa-terminal"></i>
						SITTUT Versión Beta 1.0.2 
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
				<h4 class="text-center mt-4 text-info"> <i class="fas fa-plus icoIni"></i> Registrar Coordinador</h4>
				<div class="row">
					<div class="col-sm-1 col-md-12 col-lg-1"></div>
					<form class="col-sm-10 col-md-12 col-lg-10" method="POST" id="formGCord" name="formGCord">
						<hr class="my-2 bgNav bg-primary" style="height: 2px;">
						<br>
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
						<hr style="height: 2px;" class="rounded bg-primary">
						<div class="form-group text-center">
							<button id="btnGCor" class="btn btn-outline-primary btn-md" type="submit"> <i class="fas fa-check-circle icoIni"></i> Aceptar</button>
						</div>
					</form>
					<div class="col-sm-1 col-md-12 col-lg-1"></div>
				</div>
			</div>
		</div>
	</div>
	<br><br>
	<!-- <hr style="height: 2px;" class="rounded bgNav"> -->
	<br>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<h4 class="text-center text-info">
					<i class="fas fa-list icoIni fa-lg"></i>
					Listado Coordinadores
				</h4>
				<hr style="height: 2px;" class="rounded bg-primary">
				<br>
			</div>
		</div>
		<div class="container">
			<div class="row text-center">
				<div class="col-sm-6">
					<button onclick="mostListCorActiv(true), mostListCorInact(false)" id="listCorAct" class="btn btn-outline-primary btn-md">
						<i class="fas fa-check fa-lg icoIni"></i>
						Activos
					</button>
				</div>
				<div class="col-sm-6">
					<button onclick="mostListCorInact(true), mostListCorActiv(false)" id="listCorInc" class="btn btn-outline-danger btn-md">
						<i class="fas fa-times fa-lg icoIni"></i>
						Inactivos
					</button>
				</div>
			</div>
		</div>	
		<div class="row">
			<div class="col-sm-12 text-center ocult" id="tablaCorAct">
				<div class="table-responsive pad30">
					<table width="1200" class="table bg-white rounded table-bordered table-hover" id="tbListadoCorAct">
						<thead class="text-primary">
							<th>Nombre:</th>
							<th>Correo:</th>
							<th>Telefono:</th>
							<th>Acciones:</th>
						</thead>
						<tbody class="text-dark"></tbody>
						<tfoot class="text-primary">
							<th>Nombre:</th>
							<th>Correo:</th>
							<th>Telefono:</th>
							<th>Acciones:</th>
						</tfoot>
					</table>
				</div>
			</div>
			<div class="col-sm-12 text-center ocult" id="tablaCorInc">
				<div class="table-responsive pad30">
					<table width="1200" class="table bg-white rounded table-bordered table-hover" id="tbListadoCorInc">
						<thead class="text-primary">
							<th>Nombre:</th>
							<th>Correo:</th>
							<th>Telefono:</th>
							<th>Acciones:</th>
						</thead>
						<tbody class="text-dark"></tbody>
						<tfoot class="text-primary">
							<th>Nombre:</th>
							<th>Correo:</th>
							<th>Telefono:</th>
							<th>Acciones:</th>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>
	</div>
	
	<div class="modal fade bgModal" id="editCor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  	<div class="modal-dialog modal-dialog-centered" role="document">
	    	<div class="modal-content">
	      		<div class="modal-header">
	        		<h5 class="modal-title text-info" id="exampleModalLabel"> <i class="fas fa-edit icoNav"></i> Editar coordinador</h5>
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
		        	<button id="btnClosIco" type="button" class="btn btn-outline-danger" data-dismiss="modal">
		        		<i class="fas fa-times-circle mr-2"></i>
		        		Cerrar</button>
		        	<button type="submit" id="btnEditCor" class="btn btn-outline-primary">
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
	        		<h5 class="modal-title text-info" id="exampleModalLabel"> <i class="fas fa-key icoNav"></i> Nueva contraseña </h5>
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
		        	<button id="btnClosePasNewCor" type="button" class="btn btn-outline-danger" data-dismiss="modal">
		        		<i class="fas fa-times-circle mr-2"></i>
		        		Cerrar</button>
		        	<button id="btnGNewPasCor" type="submit" class="btn btn-outline-primary">
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
    <script src="../vistas/modulos/adm/js/coordinadores.js"></script>

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