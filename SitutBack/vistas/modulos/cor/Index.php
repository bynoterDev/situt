<?php 

session_start();

if ($_SESSION['keyCor'] == "" || $_SESSION['keyCor'] == null) {
	header("Location:../Index.php");
} else {
	include '../modelos/coordinador.modelo.php';
	$cordinador = new Coordinador();
	$keyCor = $_SESSION['keyCor'];
	if (!empty($_SESSION['clvCar'])) {
		unset($_SESSION['clvCar']);
	}
	$datCor = $cordinador->userCorDet($keyCor);
	if ($datCor) {
		
?>

	<?php include 'header.php'; ?>
	<br><br>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<button class="btn btn-lg bg-white text-success cardShadow">
					Generar Reporte
				</button>
			</div>
		</div>
	</div>
	<br><br>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-4 border-right pad30 cardShadow">
				<?php 
					if ($datCor->foto_perf_cor != "") {
				?>
					<div class="text-center">
						<img width="300" src="perfilFot/<?php echo $datCor->foto_perf_cor; ?>" class="img-fluid img-thumbnail rounded">
					</div>
				<?php
					} else {
				?>
					<h5 class="text-center">
						<i class="fas fa-user fa-5x mb-3"></i>
						<br>
						Sin Foto De Perfil
						<hr style="height: 2px;" class="bg-success rounded">
					</h5>
				<?php
					}
				?>
				<br>
				<h4 class="text-center">
					<?php echo $datCor->nombre_c_cor; ?>
				</h4>
				<hr style="height: 2px;" class="bg-success rounded cardShadow">
				<h4 class="mt-4">
					<i class="fas fa-envelope fa-lg icoIni"></i>
					<?php echo $datCor->correo_cor; ?>
				</h4>
				<h4 class="mt-4">
					<i class="fas fa-phone fa-lg icoIni"></i>
					<?php echo $datCor->telefono_cor; ?>
				</h4>
			</div>
			<div class="col-sm-12 col-md-12 col-lg-8">
				<h1 class="text-center">
					<span class="badge badge-pill font-weight-normal bg-success text-white" style="padding: 10px;">
						Carreras
					</span>
				</h1>
				<hr style="height: 2px;" class="bg-success rounded cardShadow">
				<br>
				<div class="row pad10">
					<?php 
						$dbc = new Connect();
						$dbc = $dbc -> getDB();
						$valid = 1;
						$stmt = $dbc -> prepare("SELECT COUNT(alm.id_alumno) AS 'CantAlm', car.nombre_car, car.id_carrera FROM alumnos alm 
							INNER JOIN det_grupo det ON det.id_detgrupo = alm.id_detgrupo
							INNER JOIN carreras car ON car.id_carrera = det.id_carrera
							WHERE alm.estado_al = :valid && alm.acept_grp = :valid GROUP BY car.nombre_car");
						$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
						$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
						$stmt -> execute();
						while ($res = $stmt -> fetch(PDO::FETCH_OBJ)) {
					?>
					<div class="col-sm-12 col-md-6 col-lg-4">
						<div class="card pad10 cardShadow rounded">
							<div class=" card-body">
								<div class="card-title mb-4">
									<h4 class="text-center">
										<i class="fas fa-university fa-lg icoIni text-success"></i>
										<?php echo $res->nombre_car; ?>
									</h4>
								</div>
								<hr style="height: 2px !important;" class="bg-success rounded cardShadow">
								<div class="card-text mt-4">
									<h5 class="text-center">
										<i class="fas fa-users fa-lg icoIni text-success"></i>
										Alumnos : 
										<span style="font-size: 20px;" class="font-weight-normal badge badge-pill badge-success">
											<?php echo $res->CantAlm; ?>	
										</span>	
									</h5>
								</div>
							</div>
							<div class="card-link text-right bg-white mt-0">
								<a href="DetCar.php?v=<?php echo base64_encode($res->id_carrera); ?>" style="color: #eeeeee;" class="bg-success badge-pill btn mt-2 mb-2 btn-lg"> 
									<i class="fas fa-plus fa-lg"></i>
								</a>
							</div>
						</div>
						<br>
					</div>
					<?php		
						}
					?>
					
				</div>
			</div>
		</div>
	</div>
	<br><br><br>
	<?php include 'modalsconfdat.php'; ?>
	<?php include 'footer.php'; ?>

    <!--- Personalizados -->
    <script src="../vistas/modulos/cor/js/confContDatCor.js"></script>
    <script src="../vistas/modulos/dir/js/notifInd.js"></script>
</body>
</html>

<?php		
	} else {
		header("Location:../vistas/modulos/cor/Logout.php");
	}
}

?>