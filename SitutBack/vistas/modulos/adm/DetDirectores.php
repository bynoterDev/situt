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
		.ocult{
			display: none;
		}
	</style>
	<br><br>
	<br><br>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-4 pad30">
				<h4 class="text-center text-info">
					<i class="fas fa-user-tie fa-lg icoIni"></i>
					Directores
				</h4>
				<br><br>
				<div class="cardShadow pad30 text-center cardBg">
					<h6>Cuentas Activas = <span class="badge badge-pill font-weight-normal text-white bg-primary" id="dirAct"></span></h6>
					<h6>Cuentas Inactivas = <span class="badge badge-pill font-weight-normal text-white bg-danger" id="dirInc"></span></h6>
				</div>
				<br>
				<hr style="height: 2px;" class="rounded bg-primary">
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
				<h4 class="text-center mt-4 text-info"> <i class="fas fa-plus icoIni"></i> Registrar Director</h4>
				<div class="row">
					<div class="col-sm-1 col-md-12 col-lg-2"></div>
					<form class="col-sm-10 col-md-12 col-lg-8" method="POST" id="formGDirector" name="formGDirector">
						<hr class="bg-primary rounded" style="height: 2px;">
						<br>
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
						<hr style="height: 2px;" class="bg-primary rounded">
						<div class="form-group text-center">
							<button id="btnGDirector" class="btn btn-outline-primary btn-md" type="submit"> <i class="fas fa-check-circle icoIni"></i> Aceptar</button>
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
					Listado Directores
				</h4>
				<br>
				<hr style="height: 2px;" class="rounded bg-info">
				<br>
			</div>
		</div>
		<div class="container">
			<div class="row text-center">
				<div class="col-sm-6">
					<button onclick="mostListDirAct(true), mostListDirDes(false)" id="listDirAct" class="btn btn-outline-primary btn-md">
						<i class="fas fa-check fa-lg icoIni"></i>
						Activos
					</button>
				</div>
				<div class="col-sm-6">
					<button onclick="mostListDirDes(true), mostListDirAct(false)" id="listDirDes" class="btn btn-outline-danger btn-md">
						<i class="fas fa-times fa-lg icoIni"></i>
						Inactivos
					</button>
				</div>
			</div>
		</div>	
		<div class="row">
			<div class="col-sm-12 text-center ocult" id="tbListadoDirAct">
				<div class="table-responsive pad30">
					<table width="1200" class="table bg-white table-bordered table-hover" id="tbListadoDirector">
						<thead class="text-primary">
							<th>Nombre:</th>
							<th>Correo:</th>
							<th>Carrera:</th>
							<th>Acciones:</th>
						</thead>
						<tbody class="text-dark"></tbody>
						<tfoot class="text-primary">
							<th>Nombre:</th>
							<th>Correo:</th>
							<th>Carrera:</th>
							<th>Acciones:</th>
						</tfoot>
					</table>
				</div>
			</div>
			<div class="col-sm-12 text-center ocult" id="tbListadoDirDes">
				<div class="table-responsive pad30">
					<table width="1200" class="table bg-white table-bordered table-hover" id="tbListadoDirectorDesc">
						<thead class="text-primary">
							<th>Nombre:</th>
							<th>Correo:</th>
							<th>Carrera:</th>
							<th>Acciones:</th>
						</thead>
						<tbody class="text-dark"></tbody>
						<tfoot class="text-primary">
							<th>Nombre:</th>
							<th>Correo:</th>
							<th>Carrera:</th>
							<th>Acciones:</th>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>
	
	<div class="modal fade bgModal" id="editDirec" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  	<div class="modal-dialog modal-dialog-centered" role="document">
	    	<div class="modal-content">
	      		<div class="modal-header">
	        		<h5 class="modal-title text-info" id="exampleModalLabel"> <i class="fas fa-edit icoNav"></i> Editar director</h5>
	        		<button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
	          		<span aria-hidden="true">&times;</span>
	        		</button>
	      		</div>
		      	<div class="modal-body">
		       		<form class="row" name="formEditDirec" id="formEditDirec" method="POST">
		       			<div class="col-sm-1"></div>
		       			<div class="col-sm-10">
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
		       				<div class="form-group">
		       					<label for="contAdmAct">Introduce tu contraseña para actualizar:</label>
		       					<input type="password" id="contAdmAct" name="contAdmAct" class="form-control">
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

	<div class="modal fade bgModal" id="editNewPassDir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  	<div class="modal-dialog modal-dialog-centered" role="document">
	    	<div class="modal-content">
	      		<div class="modal-header">
	        		<h5 class="modal-title text-info" id="exampleModalLabel"> <i class="fas fa-key icoNav"></i> Nueva contraseña </h5>
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
		        	<button id="btnClosePasNewDir" type="button" class="btn btn-outline-danger" data-dismiss="modal">
		        		<i class="fas fa-times-circle mr-2"></i>
		        		Cerrar</button>
		        	<button id="btnGNewPasDir" type="submit" class="btn btn-outline-primary">
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
    <script src="../vistas/modulos/adm/js/directores.js"></script>

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