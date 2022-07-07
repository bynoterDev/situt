<?php 

session_start();

if ($_SESSION['keyDir'] == "" || $_SESSION['keyDir'] == null) {
	header("Location:../Index.php");
} else {
	include '../modelos/director.modelo.php';
	$director = new Director();
	$keyDir = $_SESSION['keyDir'];
	$datDirec = $director->userDirDet($keyDir);
	if ($datDirec) {
		$datCantDir = $director->cantDir();
		$car_Dir = $datDirec->id_carrera;
		$datCantGrp = $director->cantGrp($car_Dir);
		$cantBaj = $director -> cantBajCar($car_Dir);
		$cantInact = $director -> catnInactAlm($car_Dir);
?>

	<?php include 'header.php'; ?>
	<br><br>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h4 class="text-capitalize text-center">
					! Bienvenido Director de <b class="font-weight-normal text-success"><?php echo $datDirec->nombre_car; ?> </b>¡
				</h4>
				<br>
				<hr style="height: 2px;" class="bg-success rounded">
				<br>
			</div>
		</div>
	</div>
	<br><br>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-4 text-center">
				<div class="cardShadow pad30">
					<?php 
						if ($datDirec->foto_perf_dir != "") {
					?>
					<img src="../moddir/perfilFot/<?php echo $datDirec->foto_perf_dir; ?>" width="250" class="img-fluid img-thumbnail rounded" alt="">
					<?php		
						} else {
					?>
					<h4 class="text-centerpad10">
						<i class="fas fa-user fa-2x text-center"></i>
						<br><br>
						Sin foto de perfil
					</h4>
					<div class="text-center">
						<button data-backdrop="false" data-toggle="modal" data-target="#confFotPerf" class="btn btn-outline-success btn-lg">
							<i class="fas fa-upload fa-lg icoIni"></i>
							Subir
						</button>
					</div>
					<?php		
						}
					?>
					<br><br>
					<h2 class="text-center">
						<i class="fas fa-user-tie fa-lg icoIni"></i>
						<?php echo $datDirec -> nombre_c_dir; ?>
					</h2>
					<hr style="height: 2px;" class="bg-success rounded cardShadow">
					<br>
					<div class="cardShadow pad30 text-center">
						<h4>
							Alumnos de la carrera = 
							<span class="badge badge-pill font-weight-normal badge-success" id="cantAlmCar"></span>
						</h4>
						<h4>
							Grupos de la carrera =
							<span class="badge badge-pill font-weight-normal badge-success" id="cantGrpCar"></span>
						</h4>
					</div>
					<br>
				</div>
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
			<div class="col-sm-12 col-md-12 col-lg-8 text-center">
				<div class="row pad30">
					<div class="col-sm-1"></div>
					<div class="col-sm-12 col-md-6 col-lg-5">
						<div class="card cardShadow bg-white text-success mb-3 text-center rounded">
							<div class="card-header bg-success text-white border-light">
							  	<h4>Grupos</h4>
							</div>
							<div class="card-body">
								<div class="row">
									<div class="col-sm-6 border-right border-sucess">
										<a href="RegGrupos.php" class="btn bg-white text-success cardShadow rounded border-success btn-lg"> <i class="fas fa-plus icoIni"></i> Detalles </a>
									</div>
									<div class="col-sm-6">
										<button type="button" class="btn bg-white text-success cardShadow border-success btn-lg">
										  Rgistros <span class="badge badge-success font-weight-normal"><?php echo $datCantGrp->CantidadGrp; ?></span>
										  <span class="sr-only">Registros</span>
										</button>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-12 col-md-6 col-lg-5">
						<div class="card cardShadow text-white mb-3 text-center rounded">
							<div class="card-header bg-success text-white border-light">
							  	<h4>Tutores</h4>
							</div>
							<div class="card-body">
								<div class="row">
									<div class="col-sm-6 border-right border-sucess">
										<a href="RegTutores.php" class="btn bg-white text-success cardShadow rounded border-success btn-lg"> <i class="fas fa-plus icoIni"></i> Detalles </a>	
									</div>
									<div class="col-sm-6">
										<button type="button" class="btn bg-white text-success cardShadow border-success btn-lg">
										  Rgistros <span class="badge badge-success font-weight-normal"><?php echo $datCantDir->CantidadDir; ?></span>
										  <span class="sr-only">Registros</span>
										</button>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-1"></div>
					<div class="col-sm-1"></div>
					<div class="col-sm-12 col-md-6 col-lg-5">
						<div class="card cardShadow bg-white text-success mb-3 text-center rounded">
							<div class="card-header bg-success text-white border-light">
							  	<h4>Bajas carrera</h4>
							</div>
							<div class="card-body">
								<div class="row">
									<div class="col-sm-6 border-right border-sucess">
										<a href="BajCar.php" class="btn bg-white text-success cardShadow rounded border-success btn-lg"> <i class="fas fa-plus icoIni"></i> Detalles </a>	
									</div>
									<div class="col-sm-6">
										<button type="button" class="btn bg-white text-success cardShadow border-success btn-lg">
										  Rgistros <span class="badge badge-success font-weight-normal"><?php echo $cantBaj->CantBaj; ?></span>
										  <span class="sr-only">Registros</span>
										</button>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-12 col-md-6 col-lg-5">
						<div class="card cardShadow bg-white text-success mb-3 text-center rounded">
							<div class="card-header bg-success text-white border-light">
							  	<h4>Alumnos inactivos</h4>
							</div>
							<div class="card-body">
								<div class="row">
									<div class="col-sm-6 border-right border-sucess">
										<a href="AlmInact.php" class="btn bg-white text-success cardShadow rounded border-success btn-lg"> <i class="fas fa-plus icoIni"></i> Detalles </a>	
									</div>
									<div class="col-sm-6">
										<button type="button" class="btn bg-white text-success cardShadow border-success btn-lg">
										  Rgistros <span class="badge badge-success font-weight-normal"><?php echo $cantInact->CantInact; ?></span>
										  <span class="sr-only">Registros</span>
										</button>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-1"></div>
				</div>
			</div>
		</div>
	</div>
	<br><br><br><br>
	<?php include 'modalsconf.php'; ?>
	<?php include 'modalsInfo/modalInfoInd.php'; ?>
	<?php include 'footer.php'; ?>

    <!--- Personalizados -->
    <script src="../vistas/modulos/dir/js/confDatContDir.js"></script>
    <script src="../vistas/modulos/dir/js/notifInd.js"></script>
</body>
</html>

<?php		
	} else {
		header("Location:../vistas/modulos/dir/Logout.php");
	}
}

?>