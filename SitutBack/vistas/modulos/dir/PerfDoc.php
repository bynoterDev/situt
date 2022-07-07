<?php

session_start();

if ($_SESSION['keyDir'] == "" || $_SESSION['keyDir'] == null) {
	header("Location:../Index.php");
} else {
	include '../modelos/director.modelo.php';
	$director = new Director();
	$datDirec = $director->userDirDet($_SESSION['keyDir']);
	$clvTut = $_GET['v'];
	if ($datDirec) {
		$dTut = $director -> mostrarDatTut(base64_decode($clvTut));
?>

	<?php include 'header2.php'; ?>
	<br><br><br><br>
	<style type="text/css">
		.ocult {
			display: none;
		}
	</style>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<a class="btn text-primary bg-white cardShadow mr-3 btn-md" href="RegTutores.php">
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
					<div class="col-sm-6 mt-3">
						<h5 class="text-left text-capitalize text-info">
							<i class="fas fa-user-tie mr-2"></i>
							Docente : 
							<?php echo $dTut->nombre_c_doc; ?>
						</h5>
						<h5 class="text-left text-info mt-3">
							<i class="fas fa-id-badge mr-2"></i>
							Cuenta : 
							<?php 
								if ($dTut -> condicion_doc != 1) {
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
							<a class="text-info" href="#" data-backdrop="false" data-toggle="modal" data-target="#confContTut">
								<i class="fas fa-key mr-2"></i>
								Cambiar contraseña
							</a>
						</h5>
						<h5 class="text-center">
							<?php 
								if ($dTut -> condicion_doc != 1) {
							?>
								<button onclick="activarTut(<?php echo $dTut->id_docente; ?>)" class="btn btn-outline-primary mt-3 btn-sm" type="button">
									<i class="fas fa-check icoIni"></i>
									Activar Cuenta
								</button>
							<?php
								} else {
							?>
								<button onclick="desactivarTut(<?php echo $dTut->id_docente; ?>)" class="btn btn-outline-danger mt-3 btn-sm" type="button">
									<i class="fas fa-times icoIni"></i>
									Desactivar Cuenta
								</button>
							<?php
								}
							?>
						</h5>
						<hr style="height: 2px;" class="bg-info rounded">
					</div>
					<div class="col-sm-6 mt-3">
						<?php
							if ($dTut->foto_perf_doc != "") {
						?>
							<img src="../moddoc/perfilFot/<?php echo $dTut->foto_perf_doc; ?>" width="300" class="img-fluid img-thumbnail rounded" alt="">
						<?php		
							} else {
						?>
							<h5 class="text-center">
								<i class="fas fa-user fa-5x text-info text-center"></i>
								<br><br>
								Sin foto de perfil 
							</h5>
						<?php
							}
						?>
					</div>
				</div>
				<div class="row mt-4">
					<div class="col-sm-12">
						<h4 class="text-info">
							Grupos tutorados
						</h4>
					</div>
				</div>
				<div class="row pad10 mt-4">
					<?php 
						$dbc = new Connect();
						$dbc = $dbc -> getDB();
						$stmt = $dbc -> prepare("SELECT * FROM det_grupo det 
			    			INNER JOIN carreras car ON car.id_carrera = det.id_carrera
			    			INNER JOIN grupos gr ON gr.id_grupo = det.id_grupo
			    			INNER JOIN docentes doc ON doc.id_docente = det.id_docente
			    			WHERE doc.id_docente = :id_docente");
			    		$stmt -> bindParam("id_docente", $dTut->id_docente, PDO::PARAM_INT);
			    		$stmt -> execute();
			    		if ($stmt->rowCount() >= 1) {
				    		while ($res = $stmt -> fetch(PDO::FETCH_OBJ)) {
				   		?>
						<div class="col-sm-4">
							<div class="card pad10 cardShadow">
								<div class=" card-body" title="<?php echo $res->nombre_car; ?>">
									<div class="card-title mb-4">
										<h5 class="text-left text-truncate" title="<?php echo $res->nombre_car ?>">
											<!-- <i class="fas fa-university icoIni text-success"></i> -->
											<?php echo $res->nombre_car; ?>
										</h5>
									</div>
									<hr style="height: 2px;" class="bg-info rounded">
									<div class="card-text mt-4">
										<h5 class="text-center">
											<i class="fas fa-users fa-lg icoIni text-info"></i>
											<?php echo $res->grupo_n; ?>		
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
			    		<h4>
			    			<i class="fas fa-users fa-2x icoIni"></i>
			    			Sin grupos asignados
			    		</h4>
			    	</div>
			    	<?php			
			    		}
					?>
				</div>
			</div>
		</div>
	</div>

	<!-- <br><br><br>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-4 text-center">
				<?php
					if ($dTut->foto_perf_doc != "") {
				?>
					<img src="../moddoc/perfilFot/<?php echo $dTut->foto_perf_doc; ?>" width="300" class="img-fluid img-thumbnail rounded" alt="">
				<?php		
					} else {
				?>
					<h5 class="text-center">
						<i class="fas fa-user fa-2x text-center"></i>
						<br><br>
						Sin foto de perfil
					</h5>
				<?php
					}
				?>
				<br>
				<h3 class="text-center mt-3">
					<?php echo $dTut->nombre_c_doc; ?>
					<hr style="height: 2px;" class="bg-success rounded">
				</h3>
				<h4 class="text-center">
					<?php
						if ($dTut->condicion_doc != 1) {
					?>
					Cuenta: 
					<span class="badge badge-pill badge-danger">
						<b class="font-weight-normal ml-1 mr-1 mt-1 mb-1">Inactiva</b>
					</span>
					<br>
					<button onclick="activarTut(<?php echo $dTut->id_docente; ?>)" class="btn btn-success mt-3 btn-lg" type="button">
						<i class="fas fa-check fa-lg icoIni"></i>
						Activar
					</button>
					<?php	
						} else {
					?>
					Cuenta: 
					<span class="badge badge-pill badge-success">
						<b class="ml-1 mr-1 mt-1 mb-1 font-weight-normal">Activa</b>
					</span>
					<br>
					<button onclick="desactivarTut(<?php echo $dTut->id_docente; ?>)" class="btn btn-danger mt-3 btn-lg" type="button">
						<i class="fas fa-times fa-lg icoIni"></i>
						Desactivar
					</button>
					<?php		
						}
					?>
				</h4>
			</div>
			<div class="col-sm-8">
				<h2 class="text-left">Grupos tutorados</h2>
				<hr style="height: 2px;" class="bg-success rounded">
				<br>
				<div class="row pad10">
					<?php 
						$dbc = new Connect();
						$dbc = $dbc -> getDB();
						$stmt = $dbc -> prepare("SELECT * FROM det_grupo det 
			    			INNER JOIN carreras car ON car.id_carrera = det.id_carrera
			    			INNER JOIN grupos gr ON gr.id_grupo = det.id_grupo
			    			INNER JOIN docentes doc ON doc.id_docente = det.id_docente
			    			WHERE doc.id_docente = :id_docente");
			    		$stmt -> bindParam("id_docente", $dTut->id_docente, PDO::PARAM_INT);
			    		$stmt -> execute();
			    		if ($stmt->rowCount() >= 1) {
				    		while ($res = $stmt -> fetch(PDO::FETCH_OBJ)) {
				   		?>
						<div class="col-sm-4">
							<div class="card pad10 cardShadow">
								<div class=" card-body">
									<div class="card-title mb-4">
										<h4 class="text-left">
											<i class="fas fa-university fa-lg icoIni text-success"></i>
											<?php echo $res->nombre_car; ?>
										</h4>
									</div>
									<hr style="height: 2px;" class="bg-success rounded cardShadow">
									<div class="card-text mt-4">
										<h5 class="text-center">
											<i class="fas fa-users fa-lg icoIni text-success"></i>
											<?php echo $res->grupo_n; ?>		
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
			    		<h4>
			    			<i class="fas fa-users fa-2x icoIni"></i>
			    			Sin grupos asignados
			    		</h4>
			    	</div>
			    	<?php			
			    		}
					?>
				</div>
			</div>
		</div>
	</div> -->

	<?php include 'modalsconf.php'; ?>
	<?php include 'modalsInfo/modalConfContDoc.php'; ?>
	<br><br><br>
	<?php include 'footer2.php'; ?>
    <!--- Personalizados -->
    <script src="../vistas/modulos/dir/js/confDatContDir.js"></script>
    <script src="../vistas/modulos/dir/js/regTutores.js"></script>
    <script src="../vistas/modulos/dir/js/perfDoc.js"></script>
</body>
</html>
<?php		
	} else {
		header("Location:../vistas/modulos/dir/Logout.php");
	}
}

?>