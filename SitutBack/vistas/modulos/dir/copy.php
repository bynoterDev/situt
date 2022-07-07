<?php

ob_start();
session_start();

if ($_SESSION['keyDir'] == "" || $_SESSION['keyDir'] == null) {
	header("Location:../Index.php");
} else {
	include '../modelos/director.modelo.php';
	$director = new Director();
	$datDirec = $director->userDirDet($_SESSION['keyDir']);
	if ($datDirec) {
?>

	<?php include 'header.php'; ?>
	<br><br>
	<style type="text/css">
		tr {
			font-size: 18px;
		}
		tr:hover {
			color:white !important;
			font-weight: bolder;
			transition: 0.5s;
		}
	</style>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<a class="btn btn-outline-success btn-lg" href="Index.php">
					<i class="fas fa-home icoIni"></i>
					Inicio
				</a>
			</div>
		</div>
	</div>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-2"></div>
			<div class="col-sm-8">
				<h4 class="text-center">
					<i class="fas fa-plus icoIni fa-lg"></i>
					Registrar Grupo
				</h4>
				<hr>
				<br>
				<form class="row" method="POST" id="formRegGrup" name="formRegGrup">
					<div class="col-sm-12 col-md-12 col-lg-4"></div>
					<div class="col-sm-12 col-md-12 col-lg-4">
						<div class="form-group">
							<label>Carrera:</label>
							<input class="form-control" readonly="" type="text" readonly="" value="<?php echo $datDirec->nombre_car ?>">
						</div>
						<div class="form-group">
							<input type="hidden" readonly="" class="form-control" value="<?php echo $datDirec->id_carrera ?>" name="id_carrera">
							<label for="nomGrup">Grupo:</label>
							<input type="number" id="nomGrup" name="nomGrup" class="form-control text-capitalize">
						</div>
						<div class="form-group">
							<label for="cicloEsc">Ciclo escolar:</label>
							<select class="form-control" id="cicloEsc" name="cicloEsc">
								<option selected="" value="No">Selecciona</option>
								<?php 
									$sql = "SELECT * FROM ciclo_escolar WHERE estado_cic_esc = 1";
									$result = $conexion->query($sql);
									while ($res = $result->fetch_object()) {
										echo '<option value='.$res->id_ciclo_escolar.'>'.$res->n_ciclo_escolar.'</option>';
									}
								?>
							</select>
						</div>
						<br>
						<div class="form-group text-center">
							<hr>
							<button id="btnRegTut" class="btn btn-outline-success btn-lg" type="submit">
								<i class="fas fa-check-circle icoIni"></i>
								Aceptar
							</button>
						</div>
					</div>
					<div class="col-sm-12 col-md-12 col-lg-4"></div>
				</form>
			</div>
			<div class="col-sm-2"></div>
		</div>
	</div>
	<br><br><br>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<h4 class="text-center">
					<i class="fas fa-list icoIni fa-lg"></i>
					Listado Grupos
				</h4>
				<hr>
				<br>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12 text-center">
				<div class="table-responsive pad30">
					<table class="table bg-dark table-hover table-bordered rounded" id="tbListadoTutores">
						<thead class="text-white">
							<th>Nombre:</th>
							<th>Correo:</th>
							<th>Direccion:</th>
							<th>Telefono:</th>
							<th>Especialidad:</th>
							<th>Registro:</th>
						</thead>
						<tbody class="text-dark"></tbody>
						<tfoot class="text-white">
							<th>Nombre:</th>
							<th>Correo:</th>
							<th>Direccion:</th>
							<th>Telefono:</th>
							<th>Especialidad:</th>
							<th>Registro:</th>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>

	<?php include 'modalsconf.php'; ?>
	<br><br><br>
	<?php include 'footer.php'; ?>

	<script src="../vistas/js/jquery-3.1.1.min.js"></script>
	<!-- SweetAlert -->
    <script src="../vistas/node_modules/sweetalert/dist/sweetalert.min.js"></script>
    <script src="../vistas/datatables/jquery.dataTables.min.js"></script>    
    <script src="../vistas/datatables/dataTables.buttons.min.js"></script>
    <script src="../vistas/datatables/buttons.html5.min.js"></script>
    <script src="../vistas/datatables/buttons.colVis.min.js"></script>
    <script src="../vistas/datatables/jszip.min.js"></script>
    <script src="../vistas/datatables/pdfmake.min.js"></script>
    <script src="../vistas/datatables/vfs_fonts.js"></script> 
    <!-- Bootstrap -->
    <script src="../vistas/Assets/js/vendor/popper.min.js"></script>
    <script src="../vistas/Js/bootstrap.min.js"></script>
    <script src="../vistas/assets/js/vendor/holder.min.js"></script>
    <!--- Personalizados -->
    <script src="../vistas/modulos/dir/js/confDatContDir.js"></script>
</body>
</html>
<?php		
	} else {
		header("Location:Logout.php");
	}
}

ob_end_flush();

?>