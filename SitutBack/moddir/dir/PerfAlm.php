<?php 


	include '../modelos/rutas.php';
	$urlFront = new Ruta();
	$urlFront = $urlFront -> ctrRutaFront();
	$datDirec = $director->userDirDet($keyDir);
	$codigo = explode("/", $_GET['view']);
	$valPerfAlm = $codigo[1];
	$perfAlm = base64_decode($valPerfAlm);
	$datCantDir = $director->cantDir($keyDir);
	$car_Dir = $datDirec->id_carrera;
	$datCantGrp = $director->cantGrp($car_Dir);
	$datAlm = $director -> mostDatAlmPerf($perfAlm, $car_Dir);
	$valDatPerAlm = $director -> validDatPerAlm($perfAlm, $car_Dir);
	$datPer = $director -> datPerAlm($perfAlm, $car_Dir);
	$almGrp = $director -> cantAlmGrp($datAlm->id_detgrupo);
?>
	<style type="text/css">
		.ocult {
			display: none;
		}
	</style>

<div class="container-fluid mt-4 animated fadeIn delay-1s">
	
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">
		    <i class="fas fa-user mr-2 text-primary"></i>
			<b><?php echo "Dirección de: ".$datDirec->nombre_car; ?>.
		</h1>
		<a href="<?php echo SERVERURLDIR; ?>DetGrp/<?php echo base64_encode($datAlm->id_detgrupo); ?>/" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
		   	<i class="fas fa-arrow-left fa-sm text-white-50 mr-2"></i> Grupo
		</a>
		<a href="<?php echo SERVERURLDIR; ?>AlmInact/" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
		   	<i class="fas fa-arrow-left fa-sm text-white-50 mr-2"></i> Inactivos
		</a>
		<a href="<?php echo SERVERURLDIR; ?>BajCar/" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
		   	<i class="fas fa-arrow-left fa-sm text-white-50 mr-2"></i> Bajas
		</a>
		<a href="<?php echo SERVERURLDIR; ?>GraduateStd/" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
		   	<i class="fas fa-arrow-left fa-sm text-white-50 mr-2"></i> Graduados
		</a>
	</div>

	<div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">
          	Perfil del alumno
          </h6>
        </div>
        <div class="card-body">
          <div class="row">
          	<div class="col-sm-6 mb-4 shadow p-3 rounded">
          		<h5 class="text-left text-capitalize text-primary">
					<i class="fas fa-user-graduate mr-2"></i>
					<b><?php echo $datAlm -> nombre_c_al; ?>.</b>
				</h5>
				<h5 class="text-left text-capitalize text-primary mt-4">
					<i class="fas fa-calendar-check mr-2"></i>
					Registro : <b><?php echo formatFech($datAlm->fecha_reg); ?>.</b>
				</h5>
				<h5 class="text-left text-capitalize text-primary mt-4">
					<i class="fas fa-calendar mr-2"></i>
					Ultima sesion : <b><?php echo formatFech($datAlm->fecha_ult_ses_alm); ?>.</b>
				</h5>
				<?php 
					if ($datAlm -> fin_car == 0) {
				?>
				<h5 class="text-left text-primary mt-4">
					<i class="fas fa-id-badge mr-2"></i>
					Cuenta :
					<?php
						if ($datAlm -> estado_al != 1) {
					?>
						<span class="badge badge-danger">
							<i class="fas fa-times-circle mr-2"></i>
							Inactiva
						</span>
					<?php	
						} else {
					?>
						<span class="badge badge-primary">
							<i class="fas fa-check-circle mr-2"></i>
							Activa
						</span>
					<?php
						}
					?>
				</h5>
				<h5 class="text-left text-primary mt-4">
					<i class="fas fa-user-friends mr-2"></i>
					En el grupo:
					<?php 
						if ($datAlm -> acept_grp == 1) {
					?>
						<span class="badge badge-primary">
							<i class="fas fa-check-circle mr-2"></i>
							Aceptado
						</span>	
					<?php
						} else {
					?>
						<span class="badge badge-warning">
							<i class="fas fa-times-circle mr-2"></i>
							Sin aceptar
						</span>
					<?php
						}
					?>
				</h5>
				<?php
					}
				?>

				<?php 
					if ($datAlm -> fin_car == 1) {
				?>
					<div>
						<h5 class="text-center mt-4">
							<span class="badge-success badge p-1">
								<i class="fas fa-check-circle mr-2"></i>
								Finalizo la carrera.
							</span>
						</h5>
					</div>
				<?php
					}
				?>
				
          	</div>
          	<div class="col-sm-6 mb-4 text-center rounded">
          		<?php
					if ($datAlm -> foto_perf_alm == "" && $datAlm -> sexo_al == "Masculino") {
						echo "<img src='".SERVERURL."vistas/img/usermal.png' class='img-fluid' width='200'>";
					} else if ($datAlm -> foto_perf_alm != "" && $datAlm -> sexo_al == "Masculino") {
				?>
					<img src="<?php echo SERVERURLFRONT;?>modAlm/Arch/perfil/<?php echo $datAlm->foto_perf_alm ?>" class="img-fluid rounded" width="200">
				<?php
					} else if ($datAlm -> foto_perf_alm == "" && $datAlm -> sexo_al == "Femenino") {
						echo "<img src='".SERVERURL."vistas/img/userfem.png' class='img-fluid' width='200'>";
					} else if ($datAlm -> foto_perf_alm != "" && $datAlm -> sexo_al == "Femenino") {
				?>
					<img src="<?php echo SERVERURLFRONT;?>modAlm/Arch/perfil/<?php echo $datAlm->foto_perf_alm ?>" class="img-fluid rounded" width="200">
				<?php
					} else {
						echo "<img src='".SERVERURL."vistas/img/icous.png' class='img-fluid' width='200'>";
					}
				?>
				<?php 
					if ($datAlm -> fin_car == 0) {
				?>
					<h5 class="text-center text-info mb-2 mt-4">
						<?php 
							if ($datAlm -> estado_al != 1) {
						?>
							<div class="">
								<button onclick="activarAlm(<?php echo $datAlm->id_alumno; ?>)" class="btn btn-outline-primary ml-3 btn-sm" type="button">
									<i class="fas fa-check mr-2"></i>
									Activar Cuenta
								</button>
							</div>
						<?php
							} else {
						?>
							<div class="">
								<button onclick="desactivarAlm(<?php echo $datAlm->id_alumno; ?>)" class="btn btn-outline-danger ml-3 btn-sm" type="button">
									<i class="fas fa-times mr-2"></i>
									Desactivar Cuenta
								</button>
							</div>
						<?php
							}
						?>
					</h5>
				<?php
					}
				?>
          	</div>

		
			<div class="col-sm-12 mb-4">
				<div class="row mt-5 animated fadeInDown delay-1s">
					<div class="col-sm-3 text-center">
						<button id="btnDatGrp" class="btn bg-white text-primary cardShadow btn-md" onclick="mostDatGrp(true),mostJustif(false), mostDatPer(false), mostDatHist(false)">
							<i class="fas fa-users fa-lg icoIni mr-2"></i>
							Grupo <?php echo $datAlm->grupo_n; ?>
						</button>
					</div>
					<div class="col-sm-3 text-center">
						<button id="btnJustif" class="btn bg-white text-primary cardShadow btn-md" onclick="mostJustif(true), mostDatPer(false), mostDatGrp(false), mostDatHist(false)">
							<i class="fas fa-file-alt fa-lg icoIni mr-2"></i>
							Justificantes
						</button>
					</div>
					<div class="col-sm-3 text-center">
						<button id="btnDatPer" class="btn bg-white text-primary cardShadow btn-md" onclick="mostDatPer(true), mostJustif(false), mostDatGrp(false), mostDatHist(false)">
							<i class="fas fa-book fa-lg icoIni mr-2"></i>
							Datos personales
						</button>
					</div>
					<div class="col-sm-3 text-center">
						<button id="btnDatHist" class="btn bg-white text-primary cardShadow btn-md" onclick="mostDatPer(false), mostJustif(false), mostDatGrp(false), mostDatHist(true)">
							<i class="fas fa-book-open fa-lg icoIni mr-2"></i>
							Historial
						</button>
					</div>
				</div>
				<div class="row mt-5 ocult animated fadeIn" id="mostDatGrp">
					<div class="col-sm-2"></div>
					<div class="col-sm-8">
							<div class="card pad10 shadow rounded">
								<div class=" card-body">
									<div class="card-title mb-4 text-center">
										<?php
											if ($datAlm->foto_perf_doc != "") {
										?>
											<img src="../moddoc/perfilFot/<?php echo $datAlm->foto_perf_doc; ?>" width="200" class="img-fluid img-thumbnail rounded" alt="">
										<?php		
											} else {
										?>
											<h5 class="text-center">
												<i class="fas text-primary fa-user fa-2x text-center"></i>
											</h5>
										<?php
											}
										?>
										<br>
										<h4 class="text-center">
											<i class="fas fa-chalkboard-teacher mr-2 text-primary"></i>
											Tutor : <?php echo $datAlm -> nombre_c_doc; ?>
										</h4>
									</div>
									<div class="dropdown-divider"></div>
									<div class="card-text mt-4">
										<h5 class="text-center">
											<i class="fas fa-users mr-2 text-primary"></i>
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
				<div class="row mt-5 ocult animated fadeIn" id="mostJustif">
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
							<div class="card pad10 shadow rounded border-left-primary">
								<div class=" card-body">
									<div class="card-title mb-4">
										<h5 class="text-center">
											Cuatrimestre : 
											<?php echo $res->Cuatrimestre; ?>
										</h5>
									</div>
									<hr style="height: 2px;" class="bg-primary rounded">
									<div class="card-text mt-4">
										<h5 class="text-center">
											<i class="fas fa-file-alt mr-2 text-primary"></i>
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
							<div class="col-sm-12 text-center">
								<img class="img-fluid px-3 px-sm-4 mb-4" style="width: 13rem;" src="<?php echo SERVERURL; ?>assets/img/notdata.svg" alt="info site">
							<h3 class="text-center text-danger">
								<b>
									Aún no se han generado registros...
								</b>
							</h3>
						</div>
						<?php 
							}
						?>
				</div>
				<div class="row mt-5 ocult animated fadeIn" id="mostDatPer">
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
						<div class="col-sm-12 text-center">
							<img class="img-fluid px-3 px-sm-4 mb-4" style="width: 13rem;" src="<?php echo SERVERURL; ?>assets/img/notdata.svg" alt="info site">
							<h3 class="text-center text-danger">
								<b>
									Aún no se han generado registros...
								</b>
							</h3>
						</div>
					<?php		
						}
					?>
				</div>
				<div class="row mt-5 ocult animated fadeIn" id="mostDatHist">
					<div class="col-sm-12 text-right">
						<button class="btn btn-sm btn-outline-danger" onclick="mostDatHist(false), mostDatGrp(true)">
							<i class="fas fa-times fa-lg"></i>
						</button>
						<br><br>
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
								<div class="shadow rounded p-4">
									<div class="card-title mt-3">
										<h5 class="text-center">Cuatrimestre: <?php echo $res->cuatri_almhist; ?></h5>
									</div>
									<h6 class="mt-3 text-center">Tutor: <?php echo $res->tutor_almhist; ?></h6>
									<hr style="height: 2px;" class="bg-primary rounded">
									<div class="text-center mt-3 row">
										<div class="col-sm-6">
											<h6 class="mt-3">
												<i class="fas fa-users mr-2 text-primary"></i>
												<?php echo $res->grupo_almhist; ?>.
											</h6>
										</div>
										<div class="col-sm-6">
											<h6 class="mt-3">
												<i class="fas fa-calendar mr-2 text-primary"></i>
												<?php echo $res->periodcuat_almhist; ?>.
											</h6>
										</div>
									</div>
								</div>
							</div>
					<?php
						 	}
						} else {
					?>	
						<div class="col-sm-12 text-center">
							<img class="img-fluid px-3 px-sm-4 mb-4" style="width: 13rem;" src="<?php echo SERVERURL; ?>assets/img/notdata.svg" alt="info site">
							<h3 class="text-center text-danger">
								<b>
									Aún no se han generado registros...
								</b>
							</h3>
						</div>
					<?php
						}
					?>
				</div>
			</div>
			

          </div>
        </div>
    </div>

	
</div>

    <script src="<?php echo SERVERURLDIR; ?>dir/js/almInact.js"></script>