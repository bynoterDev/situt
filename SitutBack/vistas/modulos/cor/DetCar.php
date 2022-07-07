<?php 

session_start();

if ($_SESSION['keyCor'] == "" || $_SESSION['keyCor'] == null) {
	header("Location:../Index.php");
} else {
	include '../modelos/coordinador.modelo.php';
	$cordinador = new Coordinador();
	$keyCor = $_SESSION['keyCor'];
	$datCor = $cordinador->userCorDet($keyCor);
	$valCar = $_GET['v'];
	$_SESSION['clvCar'] = $valCar;
	if ($datCor) {
		$datCD = $cordinador -> datDirCar(base64_decode($valCar));
		$almCar = $cordinador -> cantAlmCar(base64_decode($valCar));
		$almInact = $cordinador -> cantAlmInact(base64_decode($valCar));
		$almSAcept = $cordinador -> cantAlmAcept(base64_decode($valCar));
		$almBajCar = $cordinador -> cantBajCar(base64_decode($valCar));
?>

	<?php include 'header2.php'; ?>
	<br><br><br><br>

	<div class="container-fluid mt-4">
		<div class="row">
			<div class="col-md-4 col-lg-3">
				<!-- SobreMi -->
                <div class="container py-5">
                    <div class="card shDC">
                        <img class="card-img-top" src="../vistas/img/iceland.jpg" alt="Card image cap">
                        <div class="text-center margen-avatar">
                        	<?php 
								if ($datCor -> foto_perf_cor == "") {
							?>
								<img src='perfilFot/<?php echo $datCor->foto_perf_cor; ?>"' class='rounded-circle' width='100px'>
							<?php
								} else {
							?>
								<img src='../vistas/img/usermal.png' class='rounded-circle' width='100px'>
							<?php
								}
							?>
                        </div>
                        <div class="card-body text-center">
                        <h6 class="card-title font-weight-bold">
                        	<?php echo $datCor -> nombre_c_cor; ?>
                        </h6>
						<h6 class=" text-left mt-3">
							<i class="fas fa-envelope fa-lg icoIni"></i>
							<?php echo $datCor -> correo_cor; ?>
						</h6>
						<h6 class=" text-left mt-3">
							<i class="fas fa-phone fa-lg icoIni"></i>
							<?php echo $datCor -> telefono_cor; ?>
						</h6>
						<hr class="bg-info mt-4" style="height: 2px;">
						<h6 class="text-center text-info">
							<b>Coordinador</b>
						</h6>
                        </div>
                    </div>
                </div><!-- SobreMi -->
                <div class="container">
                    <!-- Comentarios -->
                    <div class="card">
                        <div class="card-header text-center">
                            Frase Celebre
                        </div>
                        <div class="card-body">
                            <blockquote class="blockquote mb-0">
                            <p class="font-italic text-info">
                            	<b>"</b> Todo el mundo tiene talento, solo es cuestión de moverse hasta descubrirlo. <b>"</b>
                            </p>
                            <footer class="blockquote-footer"><cite title="Source Title">George Lucas</cite></footer>
                            </blockquote>
                        </div>
                    </div><!-- Comentarios -->
                </div>
			</div>
			<div class="col-md-8 col-lg-9 mt-4">
				<div class="text-center bg-primary p-1" style="border-radius: 8px;">
					<h4 class="text-center text-white mt-3">
						<?php echo $datCD->nombre_car; ?>
					</h4>
				</div>
				<div class="row mt-5">
					<div class="col-sm-12 col-md-12 col-lg-12">
						<div class="row">
							<div class="col-sm-6 col-md-6 col-lg-6">
								<div class="card pad10 cardShadow rounded">
									<div class="card-body">
										<div class="card-text mt-4">
											<h5 class="text-center">
												<i class="fas fa-users fa-lg icoIni text-info"></i>
												Alumnos : 
												<span class="font-weight-normal badge badge-pill badge-info">
													<?php echo $almCar->CantAlm; ?>	
												</span>	
											</h5>
											<hr style="height: 2px !important;" class="bg-info">
											<div class="card-text text-left text-info text-justify">
												Cantidad de Alumnos aceptados en grupos y cuentas activas.
											</div>
										</div>
									</div>
								</div>
								<br>
							</div>
							<div class="col-sm-6 col-md-6 col-lg-6">
								<div class="card pad10 cardShadow rounded">
									<div class=" card-body">
										<div class="card-text mt-4">
											<h5 class="text-center">
												<i class="fas fa-user-times fa-lg icoIni text-info"></i>
												Alumnos Inactivos : 
												<span class="font-weight-normal badge badge-pill badge-info">
													<?php echo $almInact->CantAlm; ?>	
												</span>	
											</h5>
											<hr style="height: 2px !important;" class="bg-info">
											<div class="card-text text-left text-info text-justify">
												Cantidad de Alumnos con cuentas inactivas dentro del sistema.
											</div>
										</div>
									</div>
								</div>
								<br>
							</div>
							<div class="col-sm-6 col-md-6 col-lg-6">
								<div class="card pad10 cardShadow rounded">
									<div class=" card-body">
										<div class="card-text mt-4">
											<h5 class="text-center">
												<i class="fas fa-user-clock fa-lg icoIni text-info"></i>
												 Sin Aceptar : 
												<span class="font-weight-normal badge badge-pill badge-info">
													<?php echo $almSAcept->CantAlm; ?>	
												</span>	
											</h5>
											<hr style="height: 1px !important;" class="bg-info">
											<div class="card-text text-left text-info text-justify">
												Cantidad de Alumnos sin ser aceptados en un grupo
											</div>
										</div>
									</div>
								</div>
								<br>
							</div>
							<div class="col-sm-6 col-md-6 col-lg-6">
								<div class="card pad10 cardShadow rounded">
									<div class=" card-body">
										<div class="card-text mt-4">
											<h5 class="text-center">
												<i class="fas fa-user-slash fa-lg icoIni text-info"></i>
												Bajas : 
												<span class="font-weight-normal badge badge-pill badge-info">
													<?php echo $almBajCar->CantAlm; ?>	
												</span>	
											</h5>
											<hr style="height: 2px !important;" class="bg-info">
											<div class="card-text text-info text-left text-justify">
												Cantidad de Alumnos dados de baja de la carrera
											</div>
										</div>
									</div>
								</div>
								<br>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-12 mt-3">
					<div class="text-center bg-primary p-1" style="border-radius: 8px;">
						<h4 class="text-center text-white mt-3">
							Grupos de la carrera
						</h4>
					</div>
					<div class="row mt-5">
						<div class="col-sm-12">
							<div class="table-responsive">
								<table class="table bg-white rounded table-bordered table-hover" id="tbListadoGrpCar">
									<thead class="text-primary font-weight-normal">
										<th>Grupo:</th>
										<th>Alumnos:</th>
										<th>Acciones:</th>
									</thead>
									<tbody class="text-dark"></tbody>
									<tfoot class="text-primary">
										<th>Grupo:</th>
										<th>Alumnos:</th>
										<th>Acciones:</th>
									</tfoot>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<br><br><br>
	<?php include 'footer2.php'; ?>
    <!--- Personalizados -->
    <script src="../vistas/modulos/cor/js/listGrpCar.js"></script>
</body>
</html>

<?php		
	} else {
		header("Location:../vistas/modulos/cor/Logout.php");
	}
}

?>