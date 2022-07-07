<?php 

ob_start();
session_start();

if ($_SESSION['keyAdm'] == "" || $_SESSION['keyAdm'] == null) {
	header("Location:Index.php");
} else {
	include '../modelos/admin.modelo.php';
	$admin = new Administrador();
	$datAdmin = $admin->userAdminDet($_SESSION['keyAdm']);
?>
<?php 
	if ($datAdmin->privileg == "ALL") {
?>

	<?php include 'header2.php'; ?>

	<br><br><br><br>
	<style type="text/css">
		.ocult {
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
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-4 pad30">
				<h4 class="text-center text-info">
					<i class="fas fa-user-shield icoIni fa-lg"></i>
					Administradores
				</h4>
				<br><br>
				<div class="cardShadow pad30 text-center cardBg">
					<h6>Cuentas Activas = <span class="badge badge-pill font-weight-normal bg-primary text-white" id="admAct"></span></h6>
					<h6>Cuentas Inactivas = <span class="badge badge-pill font-weight-normal bg-danger text-white" id="admInc"></span></h6>
				</div>
				<br>
				<hr style="height: 2px;" class="rounded bgNav">
				<br>
				<div class="text-center">
					<p class="card-text text-muted">
						<i class="fas fa-lg text-dark icoIni fa-terminal"></i>
						Sistema Integral de Tutorías Versión Beta 1.0.2 
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
				<h4 class="text-center text-info"> <i class="fas fa-plus icoIni"></i> Registrar Administrador</h4>
				<div class="row">
					<div class="col-sm-1 col-md-12 col-lg-2"></div>
					<form class="col-sm-10 col-md-12 col-lg-8" method="POST" id="formGAdmin" name="formGAdmin">
						<hr class="bgNav rounded" style="height: 2px;">
						<br>
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
						<hr style="height: 2px;" class="bgNav rounded">
						<div class="form-group text-center">
							<button id="btnGAdmin" class="btn btn-outline-primary btn-md" type="submit"> <i class="fas fa-check-circle icoIni"></i> Aceptar</button>
						</div>
					</form>
					<div class="col-sm-1 col-md-12 col-lg-2"></div>
				</div>
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
					Listado Administradores
				</h4>
				<br>
				<hr style="height: 2px;" class="bgNav rounded">
				<br>
			</div>
		</div>
		<div class="container">
			<div class="row text-center">
				<div class="col-sm-6">
					<button onclick="mostListAdmAct(true), mostListAdmDes(false)" id="listAdmAct" class="btn btn-outline-primary btn-md">
						<i class="fas fa-check fa-lg icoIni"></i>
						Activos
					</button>
				</div>
				<div class="col-sm-6">
					<button onclick="mostListAdmDes(true), mostListAdmAct(false)" id="listAdmDes" class="btn btn-outline-danger btn-md">
						<i class="fas fa-times fa-lg icoIni"></i>
						Inactivos
					</button>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12 text-center ocult" id="tbListadoAdmAct">
				<div class="table-responsive pad30">
					<table width="1200" class="table bg-white table-bordered table-hover" id="tbListadoAdmin">
						<thead class="text-primary">
							<th>Nombre:</th>
							<th>Correo:</th>
							<th>Usuario:</th>
							<th>Privilegio:</th>
							<th>Acciones:</th>
						</thead>
						<tbody class="text-dark"></tbody>
						<tfoot class="text-primary">
							<th>Nombre:</th>
							<th>Correo:</th>
							<th>Usuario:</th>
							<th>Privilegio:</th>
							<th>Acciones:</th>
						</tfoot>
					</table>
				</div>
			</div>
			<div class="col-sm-12 text-center ocult" id="tbListadoAdmDes">
				<div class="table-responsive pad30">
					<table width="1200" class="table bg-white table-bordered table-hover" id="tbListadoAdminDesc">
						<thead class="text-primary">
							<th>Nombre:</th>
							<th>Correo:</th>
							<th>Usuario:</th>
							<th>Privilegio:</th>
							<th>Acciones:</th>
						</thead>
						<tbody class="text-dark"></tbody>
						<tfoot class="text-primary">
							<th>Nombre:</th>
							<th>Correo:</th>
							<th>Usuario:</th>
							<th>Privilegio:</th>
							<th>Acciones:</th>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
		<!-- <hr style="height: 2px;" class="bgNav rounded"> -->
	</div>
	
	<div class="modal fade bgModal" id="editAdm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  	<div class="modal-dialog modal-dialog-centered" role="document">
	    	<div class="modal-content">
	      		<div class="modal-header">
	        		<h5 class="modal-title text-info" id="exampleModalLabel"> <i class="fas fa-edit icoNav"></i> Editar director</h5>
	        		<button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
	          		<span aria-hidden="true">&times;</span>
	        		</button>
	      		</div>
		      	<div class="modal-body">
		       		<form class="row" name="formEditAdm" id="formEditAdm" method="POST">
		       			<div class="col-sm-1"></div>
		       			<div class="col-sm-10">
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
							<div class="form-group">
								<label for="contAdmAct">Introduce tu contraseña para actualizar</label>
								<input type="password" id="contAdmAct" name="contAdmAct" class="form-control">
							</div>
		       			</div>
		       			<div class="col-sm-1"></div>
		      	</div>
		      	<div class="modal-footer">
		        	<button type="button" class="btn btn-outline-danger" data-dismiss="modal">
		        		<i class="fas fa-times-circle mr-2"></i>
		        		Cerrar</button>
		        	<button id="btnAdmEdit" type="submit" class="btn btn-outline-primary">
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
	<script src="../vistas/modulos/adm/js/admin.js"></script>
</body>
</html>


<?php		
	} else {
		header("Location:../Index.php");
	}
?>
<?php
	ob_end_flush();
}

?>