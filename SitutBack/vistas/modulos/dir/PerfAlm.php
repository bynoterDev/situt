<?php 

session_start();

if ($_SESSION['keyDir'] == "" || $_SESSION['keyDir'] == null) {
	header("Location:../Index.php");
} else {
	include '../modelos/director.modelo.php';
	$director = new Director();
	$keyDir = $_SESSION['keyDir'];
	include '../modelos/rutas.php';
	$urlFront = new Ruta();
	$urlFront = $urlFront -> ctrRutaFront();
	$datDirec = $director->userDirDet($keyDir);
	$valPerfAlm = $_GET['v'];
	$valGrp = $_GET['g'];
	$perfAlm = base64_decode($valPerfAlm);
	if ($datDirec) {
		$datCantDir = $director->cantDir();
		$car_Dir = $datDirec->id_carrera;
		$datCantGrp = $director->cantGrp($car_Dir);
		$datAlm = $director -> mostDatAlmPerf($perfAlm, $car_Dir);
		$valDatPerAlm = $director -> validDatPerAlm($perfAlm, $car_Dir);
		$datPer = $director -> datPerAlm($perfAlm, $car_Dir);
		$almGrp = $director -> cantAlmGrp($datAlm->id_detgrupo);
		if ($datAlm) {
?>
		<?php include 'header2.php'; ?>
		<style type="text/css">
			.ocult {
				display: none;
			}
		</style>
	<br><br><br><br>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<a class="btn bg-white text-primary cardShadow mr-3 btn-md" href="DetGrp.php?v=<?php echo $valGrp; ?>">
					<i class="fas fa-arrow-left icoIni"></i>
					Regresar
				</a>
			</div>
		</div>
	</div>

	<div class="container-fluid mt-4">
		<div class="row">
			<div class="col-md-4 col-lg-3">
				<!-- SobreMi -->
                <div class="container py-5">
                    <div class="card shDC">
                        <img class="card-img-top" src="../vistas/img/iceland.jpg" alt="Card image cap">

                        <div class="text-center margen-avatar">
                        	<?php
								if ($datDirec -> foto_perf_dir != "") {
							?>
								<img src="../moddir/perfilFot/<?php echo $datDirec->foto_perf_dir; ?>" class='rounded-circle' width='100px'>
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
                        	<?php echo $datDirec -> nombre_c_dir; ?>
                        </h6>
						<h6 class=" text-left mt-3">
							<i class="fas fa-envelope fa-lg icoIni"></i>
							<?php echo $datDirec -> correo_dir; ?>
						</h6>
						<h6 class=" text-left mt-3">
							<i class="fas fa-phone fa-lg icoIni"></i>
							<?php echo $datDirec -> telefono_dir; ?>
						</h6>
						<hr class="bg-info mt-4" style="height: 2px;">
						<h6 class="text-center text-info">
							<b>Director</b>
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
			<div class="col-md-8 col-lg-9">
				<div class="text-center bg-primary p-1" style="border-radius: 8px;">
					<h4 class="text-center text-white mt-3"> 
						<?php echo "Dirección de: ".$datDirec->nombre_car; ?>
					</h4>
				</div>
				<div class="row mt-4">
					<div class="col-sm-6 text-center">
						<h5 class="text-left text-capitalize text-info">
							<br>
							<i class="fas fa-user-graduate mr-2"></i>
							Alumno: <b><?php echo $datAlm -> nombre_c_al; ?></b>
						</h5>
						<h5 class="text-left text-info mt-3">
							<i class="fas fa-id-badge mr-2"></i>
							Cuenta :
							<?php
								if ($datAlm -> estado_al != 1) {
							?>
								<span class="badge badge-danger">
									Inactiva
								</span>
							<?php	
								} else {
							?>
								<span class="badge badge-primary">
									Activa
								</span>
							<?php
								}
							?>
						</h5>
						<h5 class="text-left text-info mt-3">
							<i class="fas fa-user-friends mr-2"></i>
							En el grupo:
							<?php 
								if ($datAlm -> acept_grp == 1) {
							?>
								<span class="badge badge-primary">
									Aceptado
								</span>	
							<?php
								} else {
							?>
								<span class="badge badge-warning">
									Sin aceptar
								</span>
							<?php
								}
							?>
						</h5>
						<h5 class="text-center text-info">
							<?php 
								if ($datAlm -> estado_al != 1) {
							?>
								<button onclick="activarAlm(<?php echo $datAlm->id_alumno; ?>)" class="btn btn-outline-primary mt-3 btn-sm" type="button">
									<i class="fas fa-check icoIni"></i>
									Activar Cuenta
								</button>
							<?php
								} else {
							?>
								<button onclick="desactivarAlm(<?php echo $datAlm->id_alumno; ?>)" class="btn btn-outline-danger mt-3 btn-sm" type="button">
									<i class="fas fa-times icoIni"></i>
									Desactivar Cuenta
								</button>
							<?php
								}
							?>
						</h5>
						<hr style="height: 2px;" class="bg-info rounded">
					</div>
					<div class="col-sm-6 text-center">
						<?php
							if ($datAlm -> foto_perf_alm == "" && $datAlm -> sexo_al == "Masculino") {
								echo "<img src='../vistas/img/usermal.png' class='img-fluid' width='200'>";
							} else if ($datAlm -> foto_perf_alm != "" && $datAlm -> sexo_al == "Masculino") {
						?>
							<img src="<?php echo $urlFront;?>modAlm/Arch/perfil/<?php echo $datAlm->foto_perf_alm ?>" class="img-fluid img-thumbnail rounded" width="200">
						<?php
							} else if ($datAlm -> foto_perf_alm == "" && $datAlm -> sexo_al == "Femenino") {
								echo "<img src='../vistas/img/userfem.png' class='img-fluid' width='200'>";
							} else if ($datAlm -> foto_perf_alm != "" && $datAlm -> sexo_al == "Femenino") {
						?>
							<img src="<?php echo $urlFront;?>modAlm/Arch/perfil/<?php echo $datAlm->foto_perf_alm ?>" class="img-fluid img-thumbnail rounded" width="200">
						<?php
							} else {
								echo "<img src='../vistas/img/icous.png' class='img-fluid' width='200'>";
							}
						?>
					</div>
				</div>
				<div class="row mt-5">
					<div class="col-sm-3 text-center">
						<button id="btnDatGrp" class="btn bg-white text-primary cardShadow btn-md" onclick="mostDatGrp(true),mostJustif(false), mostDatPer(false), mostDatHist(false)">
							<i class="fas fa-users fa-lg icoIni"></i>
							Grupo <?php echo $datAlm->grupo_n; ?>
						</button>
					</div>
					<div class="col-sm-3 text-center">
						<button id="btnJustif" class="btn bg-white text-primary cardShadow btn-md" onclick="mostJustif(true), mostDatPer(false), mostDatGrp(false), mostDatHist(false)">
							<i class="fas fa-file-alt fa-lg icoIni"></i>
							Justificantes
						</button>
					</div>
					<div class="col-sm-3 text-center">
						<button id="btnDatPer" class="btn bg-white text-primary cardShadow btn-md" onclick="mostDatPer(true), mostJustif(false), mostDatGrp(false), mostDatHist(false)">
							<i class="fas fa-book fa-lg icoIni"></i>
							Datos personales
						</button>
					</div>
					<div class="col-sm-3 text-center">
						<button id="btnDatHist" class="btn bg-white text-primary cardShadow btn-md" onclick="mostDatPer(false), mostJustif(false), mostDatGrp(false), mostDatHist(true)">
							<i class="fas fa-book-open fa-lg icoIni"></i>
							Historial
						</button>
					</div>
				</div>
				<div class="row mt-5 ocult" id="mostDatGrp">
					<div class="col-sm-2"></div>
					<div class="col-sm-8">
							<div class="card pad10 cardShadow rounded">
								<div class=" card-body">
									<div class="card-title mb-4 text-center">
										<?php
											if ($datAlm->foto_perf_doc != "") {
										?>
											<img src="../moddoc/perfilFot/<?php echo $datAlm->foto_perf_doc; ?>" width="150" class="img-fluid img-thumbnail rounded" alt="">
										<?php		
											} else {
										?>
											<h5 class="text-center">
												<i class="fas text-info fa-user fa-2x text-center"></i>
											</h5>
										<?php
											}
										?>
										<br>
										<h4 class="text-center">
											<i class="fas fa-chalkboard-teacher fa-lg icoIni text-info"></i>
											Tutor : <?php echo $datAlm -> nombre_c_doc; ?>
										</h4>
									</div>
									<div class="dropdown-divider"></div>
									<div class="card-text mt-4">
										<h5 class="text-center">
											<i class="fas fa-users fa-lg icoIni text-info"></i>
											Alumnos del grupo : 
											<span class="font-weight-normal badge badge-pill badge-primary">
												<?php echo $almGrp->CantAlm; ?>
											</span>	
										</h5>
									</div>
								</div>
							</div>
						</div>
					<div class="col-sm-2"></div>
				</div>
				<div class="row mt-5 ocult" id="mostJustif">
					<div class="col-sm-12 text-right">
						<button class="btn btn-sm btn-outline-danger" onclick="mostJustif(false), mostDatGrp(true)">
							<i class="fas fa-times fa-lg"></i>
						</button>
						<br><br>
					</div>
						<?php 
							$dbc = new Connect();
							$dbc = $dbc -> getDB();
							$stmt = $dbc -> prepare("SELECT COUNT(jus.id_justificante) AS 'Solicitados', jus.cuatrimestre_justif AS 'Cuatrimestre' FROM justificantes jus
								INNER JOIN alumnos alm ON alm.id_alumno = jus.id_alumno
								WHERE alm.id_alumno = :perfAlm GROUP BY jus.cuatrimestre_justif");
							$stmt -> bindParam("perfAlm", $perfAlm, PDO::PARAM_INT);
							$stmt -> execute();
							$filStmt = $stmt -> rowCount();
							if ($filStmt >= 1) {
								while ($res = $stmt -> fetch(PDO::FETCH_OBJ)) {
						?>
						<div class="col-sm-4">
							<div class="card pad10 cardShadow rounded">
								<div class=" card-body">
									<div class="card-title mb-4">
										<h5 class="text-center">
											Cuatrimestre : 
											<?php echo $res->Cuatrimestre; ?>
										</h5>
									</div>
									<hr style="height: 2px;" class="bg-info rounded">
									<div class="card-text mt-4">
										<h5 class="text-center">
											<i class="fas fa-file-alt fa-lg icoIni text-info"></i>
											Justificantes : 
											<span class="font-weight-normal badge badge-pill badge-primary">
												<?php echo $res->Solicitados; ?>	
											</span>	
										</h5>
									</div>
								</div>
							</div>
						</div>
						<?php		
								}
							} else {
						?>
							<div class="col-sm-12">
								<h4 class="text-center">
									<i class="fas text-danger fa-file-excel fa-2x"></i>
									<br><br>
									Aún no se han generado registros...
								</h4>
							</div>
						<?php 
							}
						?>
				</div>
				<div class="row mt-5 ocult" id="mostDatPer">
					<div class="col-sm-12 text-right">
						<button class="btn btn-sm btn-outline-danger" onclick="mostDatPer(false), mostDatGrp(true)">
							<i class="fas fa-times fa-lg"></i>
						</button>
						<br><br>
					</div>
					<?php 
						if ($valDatPerAlm -> CantidadVal == 1) {
							include 'archExt/datPerAlm.php';
						} else {
					?>
					<div class="col-sm-12">
						<h4 class="text-center">
							<i class="fas text-danger fa-file-excel fa-2x"></i>
							<br><br>
							Aún no se han generado registros...
						</h4>
					</div>
					<?php		
						}
					?>
				</div>
				<div class="row mt-5 ocult" id="mostDatHist">
					<div class="col-sm-12">
						<h1 class="text-center mt-2 mb-3">
							Historial
						</h1>
					</div>
					<?php  
						$dbc = new Connect();
						$dbc = $dbc -> getDB();
						$valid = 1;
						$stmt = $dbc -> prepare("SELECT * FROM historial_academ hist WHERE hist.id_alumno = :perfAlm && hist.estado_almhist = :valid");
						$stmt -> bindParam("perfAlm", $perfAlm, PDO::PARAM_INT);
						$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
						$stmt -> execute();
						$resStmt = $stmt -> rowCount();
						if ($resStmt > 0) {
						 	while ($res = $stmt -> fetch(PDO::FETCH_OBJ)) {
					?>
							<div class="col-sm-4">
								<div class="cardShadow p-4">
									<div class="card-title mt-3">
										<h5 class="text-center">Cuatrimestre: <?php echo $res->cuatri_almhist; ?></h5>
									</div>
									<h6 class="mt-3 text-center">Tutor: <?php echo $res->tutor_almhist; ?></h6>
									<div class="text-right mt-3 border-top border-info row">
										<div class="col-sm-6">
											<h6 class="mt-3"><?php echo $res->grupo_almhist; ?></h6>
										</div>
										<div class="col-sm-6">
											<h6 class="mt-3"><?php echo $res->periodcuat_almhist; ?></h6>
										</div>
									</div>
								</div>
							</div>
					<?php
						 	}
						} else {
					?>	
						<h5 class="text-center">
							Sin registro
						</h5>
					<?php
						}
					?>
				</div>
			</div>
		</div>
	</div>

	<br><br><br>
	<?php include 'modalsconf.php'; ?>
	<?php include 'footer2.php'; ?>
    <!--- Personalizados -->
    <script src="../vistas/modulos/dir/js/confDatContDir.js"></script>
    <script src="../vistas/modulos/dir/js/almInact.js"></script>
</body>
</html>
<?php
		} else {
			header("Location:../vistas/modulos/dir/Logout.php");
		}	
	} else {
		header("Location:../vistas/modulos/dir/Logout.php");
	}
}

?>