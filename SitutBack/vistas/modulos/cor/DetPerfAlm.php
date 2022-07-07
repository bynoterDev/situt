<?php 

session_start();

if ($_SESSION['keyCor'] == "" || $_SESSION['keyCor'] == null) {
	header("Location:../Index.php");
} else {
	include '../modelos/coordinador.modelo.php';
	include '../modelos/rutas.php';
	$urlFront = new Ruta();
	$urlFront = $urlFront -> ctrRutaFront();
	$cordinador = new Coordinador();
	$keyCor = $_SESSION['keyCor'];
	$datCor = $cordinador->userCorDet($keyCor);
	$valAlm = $_GET['v'];
	$clvCar = base64_decode($_SESSION['clvCar']);
	$clvGrp = base64_decode($_SESSION['clvGrp']);
	if ($datCor) {
		$datValAlm = $cordinador -> datAlmGrpCarSel($clvGrp, $clvCar, base64_decode($valAlm));
		if ($datValAlm) {
			$datPer = $cordinador -> datPerAlm(base64_decode($valAlm), $clvCar, $clvGrp);
			include 'header2.php';
?>
	<br><br><br><br>
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<a href="DetCar.php?v=<?php echo base64_encode($clvCar); ?>" class="bg-white text-primary cardShadow btn btn-md">
					<i class="fas fa-users icoIni fa-lg"></i>
					Grupos de la carrera
				</a>
				<a href="DetGrp.php?v=<?php echo base64_encode($clvGrp); ?>" class="bg-white text-primary cardShadow btn btn-md">
					<i class="fas fa-list icoIni fa-lg"></i>
					Lista de alumnos
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
			<div class="col-md-8 col-lg-9">
				<div class="text-center bg-primary p-1" style="border-radius: 8px;">
					<h4 class="text-center text-white mt-3">
						<?php echo $datValAlm -> nombre_car.", ".$datValAlm -> grupo_n; ?>
					</h4>
				</div>
				<div class="row mt-4">
					<div class="col-sm-6 text-center mt-3">
						<h5 class="text-center text-capitalize text-info mt-5">
							<br>
							Alumno : <b><?php echo $datValAlm -> nombre_c_al; ?></b>
							<hr style="height: 2px;" class="bg-info rounded">
						</h5>
					</div>
					<div class="col-sm-6 text-center">
						<?php
							if ($datValAlm -> foto_perf_alm == "" && $datValAlm -> sexo_al == "Masculino") {
								echo "<img src='../vistas/img/usermal.png' class='img-fluid' width='200'>";
							} else if ($datValAlm -> foto_perf_alm != "" && $datValAlm -> sexo_al == "Masculino") {
						?>
							<img src="<?php echo $urlFront;?>modAlm/Arch/perfil/<?php echo $datValAlm->foto_perf_alm ?>" class="img-fluid img-thumbnail rounded" width="200">
						<?php
							} else if ($datValAlm -> foto_perf_alm == "" && $datValAlm -> sexo_al == "Femenino") {
								echo "<img src='../vistas/img/userfem.png' class='img-fluid' width='200'>";
							} else if ($datValAlm -> foto_perf_alm != "" && $datValAlm -> sexo_al == "Femenino") {
						?>
							<img src="<?php echo $urlFront;?>modAlm/Arch/perfil/<?php echo $datValAlm->foto_perf_alm ?>" class="img-fluid img-thumbnail rounded" width="200">
						<?php
							} else {
								echo "<img src='../vistas/img/icous.png' class='img-fluid' width='200'>";
							}
						?>
					</div>
				</div>
				
				<div class="row mt-5">
					<div class="col-sm-6 col-md-6 col-lg-3 text-center">
						<button id="btnDatGrp" class="btn bg-white text-primary cardShadow btn-md" onclick="mostDatGrp(true),mostJustif(false), mostDatPer(false), mostDatHist(false)">
							<i class="fas fa-users fa-lg icoIni"></i>
							Grupo <?php echo $datValAlm->grupo_n; ?>
						</button>
						<br><br>
					</div>
					<div class="col-sm-6 col-md-6 col-lg-3 text-center">
						<button id="btnJustif" class="btn bg-white text-primary cardShadow btn-md" onclick="mostJustif(true), mostDatPer(false), mostDatGrp(false), mostDatHist(false)">
							<i class="fas fa-file-alt fa-lg icoIni"></i>
							Justificantes
						</button>
						<br><br>
					</div>
					<div class="col-sm-6 col-md-6 col-lg-3 text-center">
						<button id="btnDatPer" class="btn bg-white text-primary cardShadow btn-md" onclick="mostDatPer(true), mostJustif(false), mostDatGrp(false), mostDatHist(false)">
							<i class="fas fa-book fa-lg icoIni"></i>
							Datos personales
						</button>
						<br><br>
					</div>
					<div class="col-sm-6 col-md-6 col-lg-3 text-center">
						<button id="btnDatHist" class="btn bg-white text-primary cardShadow btn-md" onclick="mostDatPer(false), mostJustif(false), mostDatGrp(false), mostDatHist(true)">
							<i class="fas fa-book-open fa-lg icoIni"></i>
							Historial
						</button>
						<br><br>
					</div>
				</div>
				<div class="row pad10 ocult" id="mostDatGrp">
					<div class="col-sm-2"></div>
					<div class="col-sm-8">
						<div class="card pad10 cardShadow rounded">
							<div class=" card-body">
								<div class="card-title mb-4 text-center">
									<?php
										if ($datValAlm->foto_perf_doc != "") {
									?>
										<img src="../moddoc/perfilFot/<?php echo $datValAlm->foto_perf_doc; ?>" width="150" class="img-fluid img-thumbnail rounded" alt="">
									<?php		
										} else {
									?>
										<h5 class="text-center">
											<i class="fas fa-user text-info fa-2x text-center"></i>
										</h5>
									<?php
										}
									?>
									<br>
									<h4 class="text-center">
										<i class="fas fa-chalkboard-teacher fa-lg icoIni text-info"></i>
										Tutor : <?php echo $datValAlm -> nombre_c_doc; ?>
									</h4>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-2"></div>
				</div>
				<div class="row pad10 ocult" id="mostJustif">
					<div class="col-sm-12 text-right">
						<button class="btn btn-sm btn-outline-danger" onclick="mostJustif(false), mostDatGrp(true)">
							<i class="fas fa-times fa-2x"></i>
						</button>
						<br><br>
					</div>
					<?php 
						$dbc = new Connect();
						$dbc = $dbc -> getDB();
						$valAlmDec = base64_decode($valAlm);
						$stmt = $dbc -> prepare("SELECT COUNT(jus.id_justificante) AS 'Solicitados', jus.cuatrimestre_justif AS 'Cuatrimestre' FROM justificantes jus
							INNER JOIN alumnos alm ON alm.id_alumno = jus.id_alumno
							WHERE alm.id_alumno = :valAlm GROUP BY jus.cuatrimestre_justif");
						$stmt -> bindParam("valAlm", $valAlmDec, PDO::PARAM_INT);
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
									<div class="dropdown-divider"></div>
									<div class="card-text mt-4">
										<h5 class="text-center">
											<i class="fas fa-file-alt fa-lg icoIni text-info"></i>
											Justificantes : 
											<span class="font-weight-normal badge badge-pill badge-info">
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
							<h2 class="text-center text-info">
								<i class="fas fa-file-excel fa-2x"></i>
									<br><br>
									Aún no se han generado registros...
							</h2>
						</div>
					<?php 
						}
					?>
				</div>
				<div class="row pad10 ocult" id="mostDatPer">
					<div class="col-sm-12 text-right">
						<button class="btn btn-outline-danger btn-sm" onclick="mostDatPer(false), mostDatGrp(true)">
							<i class="fas fa-times fa-2x"></i>
						</button>
						<br><br>
					</div>
					<?php 
						if ($datPer) {
							include 'archExt/datPerAlm.php';
						} else {
					?>
						<div class="col-sm-12">
							<h2 class="text-center text-info">
								<i class="fas fa-file-excel fa-2x"></i>
								<br><br>
								Aún no se han generado registros...
							</h2>
						</div>
					<?php		
						}
					?>
				</div>
				<div class="row pad10 ocult" id="mostDatHist">
					<div class="col-sm-12">
						<h1 class="text-center mt-2 mb-3">Historial</h1>
					</div>
					<?php 
						$dbc = new Connect();
						$dbc = $dbc -> getDB();
						$valid = 1;
						$valAlmDec = base64_decode($valAlm);
						$stmt = $dbc -> prepare("SELECT * FROM historial_academ hist WHERE hist.id_alumno = :valAlmDec && hist.estado_almhist = :valid");
						$stmt -> bindParam("valAlmDec", $valAlmDec, PDO::PARAM_INT);
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
	<?php include 'footer2.php'; ?>
    <!--- Personalizados -->
    <script src="../vistas/modulos/cor/js/perfAlmGC.js"></script>
</body>
</html>

<?php
		} else {
			header("Location:../vistas/modulos/cor/Logout.php");
		}		
	} else {
		header("Location:../vistas/modulos/cor/Logout.php");
	}
}

?>