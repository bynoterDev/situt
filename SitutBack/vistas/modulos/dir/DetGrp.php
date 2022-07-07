<?php 

session_start();

if ($_SESSION['keyDir'] == "" || $_SESSION['keyDir'] == null) {
	header("Location:../Index.php");
} else {
	include '../modelos/director.modelo.php';
	$director = new Director();
	$keyDir = $_SESSION['keyDir'];
	$datDirec = $director->userDirDet($keyDir);
	$valGrp = $_GET['v'];
	$grpClv = base64_decode($valGrp);
	if ($datDirec) {
		$car_Dir = $datDirec->id_carrera;
		$valCarGrp = $director -> valCarGrp($grpClv, $car_Dir);
		if ($valCarGrp -> CantVal == 1) {
			$datGrp = $director -> datGrpSel($grpClv);
			$cantAlm = $director -> cantAlmGrp($grpClv);
			include 'header2.php';
?>
	<br><br><br><br>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<a class="btn bg-white text-primary cardShadow mr-3 btn-md" href="RegGrupos.php">
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
				<div class="row mt-4 text-center">
					<div class="col-sm-2">
						<h5 class="text-info">
							Grupohhh: 
							<span class="badge badge-primary">
								<?php echo $datGrp->grupo_n; ?>
								
							</span>
						</h5>
					</div>
					<div class="col-sm-4">
						<h5 class="text-info">
							Alumnos en el grupo:
							<span class="badge badge-primary">
								<?php echo $cantAlm->CantAlm; ?>
							</span>
						</h5>
					</div>
					<div class="col-sm-6">
						<h5>
							Tutor: 
							<span class="badge badge-primary">
								<a class="text-white" href="PerfDoc.php?v=<?php echo base64_encode($datGrp->id_docente); ?>">
									<?php echo $datGrp -> nombre_c_doc; ?>
								</a> 
							</span>		
						</h5>
					</div>
				</div>
				<div class="row mt-4">
					<div class="col-sm-12 table-responsive">
						<table class="table bg-white table-hover table-bordered" id="tbListadoAlumnosGrp">
							<thead class="text-primary">
								<th>Nombre:</th>
								<th>Accion:</th>
							</thead>
							<tbody class="text-dark">
								<?php 
									$dbc = new Connect();
									$dbc = $dbc -> getDB();
									$valid = 1;
									$stmt = $dbc -> prepare("SELECT * FROM alumnos alm 
									INNER JOIN det_grupo det ON det.id_detgrupo = alm.id_detgrupo
									INNER JOIN carreras car ON car.id_carrera = det.id_carrera
									WHERE alm.acept_grp = :valid && alm.estado_al = :valid && det.id_detgrupo = :grpClv && car.id_carrera = :car_Dir");
									$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
									$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
									$stmt -> bindParam("grpClv", $grpClv, PDO::PARAM_INT);
									$stmt -> bindParam("car_Dir", $car_Dir, PDO::PARAM_INT);
									$stmt -> execute();
									while ($res = $stmt -> fetch(PDO::FETCH_OBJ)) {
								?>
									<tr>
										<td><?php echo $res->nombre_c_al; ?></td>
										<td>
											<a class="btn btn-primary btn-sm" href="PerfAlm.php?v=<?php echo base64_encode($res->id_alumno); ?>&&g=<?php echo base64_encode($grpClv); ?>">
												<i class="fas fa-eye"></i>
												Perfil
											</a>
										</td>
									</tr>
								<?php
									}
									$dbc = null; $stmt = null;
								?>
							</tbody>
							<tfoot class="text-primary">
								<th>Nombre:</th>
								<th>Accion:</th>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

		<!-- <div class="container-fluid">
			<div class="row">
				<div class="col-sm-12">
					<div class="row">
						<?php 
							$dbc = new Connect();
							$dbc = $dbc -> getDB();
							$valid = 1;
							$stmt = $dbc -> prepare("SELECT * FROM alumnos alm 
								INNER JOIN det_grupo det ON det.id_detgrupo = alm.id_detgrupo
								INNER JOIN carreras car ON car.id_carrera = det.id_carrera
								WHERE alm.acept_grp = :valid && alm.estado_al = :valid && det.id_detgrupo = :grpClv && car.id_carrera = :car_Dir");
							$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
							$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
							$stmt -> bindParam("grpClv", $grpClv, PDO::PARAM_INT);
							$stmt -> bindParam("car_Dir", $car_Dir, PDO::PARAM_INT);
							$stmt -> execute();
							$filStmt = $stmt -> rowCount();
							if ($filStmt >= 1) {
								while ($res = $stmt -> fetch(PDO::FETCH_OBJ)) {
						?>	
							<div class="col-sm-3">
								<div class="card pad10 cardShadow rounded">
									<div class=" card-body">
										<div class="card-title mb-4">
											<h4 class="text-center">
												<?php echo $res->nombre_c_al; ?>
											</h4>
										</div>
										<hr style="height: 1px !important;" class="bg-success">
										<div class="card-text mt-4">
											<h5 class="text-center">
												<a class="btn btn-success" href="PerfAlm.php?v=<?php echo base64_encode($res->id_alumno);?>&&g=<?php echo base64_encode($grpClv); ?>">
													<i class="fas fa-id-card fa-lg icoIni"></i>
													Ver Perfil 
												</a>
											</h5>
										</div>
									</div>
								</div>
								<br>
							</div>

						<?php
								}
							} else {
						?>
							<div class="col-sm-12">
								<h2 class="text-center">
									<i class="fas fa-file-excel fa-2x"></i>
									<br><br>
									Aún no se han generado registros...
								</h2>
							</div>
						<?php								
							}
						?>
					</div>
				</div>		
			</div>
		</div> -->



	<br><br><br>
	<?php include 'modalsconf.php'; ?>
	<?php include 'footer2.php'; ?>
    <!--- Personalizados -->
    <script src="../vistas/modulos/dir/js/confDatContDir.js"></script>
    <script src="../vistas/modulos/dir/js/almInact.js"></script>
	<script type="text/javascript">
		$(function() {
			$('#tbListadoAlumnosGrp').DataTable({
		      "aProcessing" : true,
		      "aServerSide" : true,
		      dom : 'Bfrtip',
		      buttons: [
		      ],
		      "bDestroy" : true,
		      "iDisplayLength" : 5
		      });
		});
	</script>
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