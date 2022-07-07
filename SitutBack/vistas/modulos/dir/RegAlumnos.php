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
						! Director de <b><?php echo $datDirec->nombre_car; ?> </b>¡
					</h4>
				</div>
				<div class="row mt-5">
					<div class="col-sm-3"></div>
					<div class="col-sm-6 border border-primary p-3 rounded">
						<form enctype="multipart/form-data" class="" method="POST" name="formRegAlmArch" id="formRegAlmArch" action="<?php echo $_SERVER['PHP_SELF']; ?>">
							<input type="hidden" value="<?php echo $car_Dir; ?>" name="id_carrera">
							<div class="form-group">
								<label for="archAlm">
									<i class="fas fa-file mr-2 text-info"></i>
									Seleccionar archivo</label>
								<input required="" type="file" id="archAlm" name="archAlm" class="form-control">
							</div>
							<div class="form-group">
								<label for="passAlm">
									<i class="fas fa-key mr-2 text-info"></i>
									Contraseña para los alumnos</label>
								<input type="password" name="passAlm" id="passAlm" class="form-control">
								<div id="mensaje"></div>
							</div>
							<div class="form-group">
								<label for="repPass">
									<i class="fas fa-key mr-2 text-info"></i>
									Repetir contraseña</label>
								<input type="password" name="repPass" id="repPass" class="form-control">
								<div id="mensaje2"></div>
							</div>
						</form>
						<div class="mt-4 form-group text-center">
							<button class="btn btn-outline-primary" id="btnRegAlm">
								<i class="fas fa-check-circle mr-2"></i>
								Enviar
							</button>
						</div>
					</div>
				</div>
				<div class="row mt-5">
					<div class="col-sm-12">
						<h5>Resultados:</h5>
					</div>
					<?php 
						// Recibir datos archivo excel insertar alumnos //
						require_once '../vistas/modulos/dir/Classes/PHPExcel/IOFactory.php';
						if (isset($_FILES['archAlm']) && isset($_POST['passAlm'])) {
							//unset($_POST['archAlm']);
							$valid = 1;
							$passAlm = $_POST['passAlm'];
							$id_carrera = $_POST['id_carrera'];
							$passAlmEnc = sha1($passAlm);
							$archAlm = $_FILES['archAlm']['name'];
							$destino = "bak_" . $archAlm;
							if (copy($_FILES['archAlm']['tmp_name'],$destino)) {
								if (file_exists("bak_" . $archAlm)) {
									$objPHPExcel = PHPExcel_IOFactory::load("bak_" . $archAlm);
									$objPHPExcel -> setActiveSheetIndex(0);
									$numFils = $objPHPExcel -> setActiveSheetIndex(0) -> getHighestRow();
									$msjExist = ''; $msjGood = '';
									echo '
										<div class="col-sm-6">
											<ul class="list-group">
									';
									for ($i = 2; $i <= $numFils; $i++) {
										$nombreAlm = $objPHPExcel -> getActiveSheet() -> getCell('A'.$i) -> getCalculatedValue();
										$nombreAlmMay = ucfirst($nombreAlm);
										$matriculaAlm = $objPHPExcel -> getActiveSheet() -> getCell('B'.$i) -> getCalculatedValue();
										$matriculaAlmMay = strtoupper($matriculaAlm);
										$conex = new Connect();
										$conex = $conex -> getDB();
										$stmt = $conex -> prepare("SELECT * FROM alumnos WHERE nombre_c_al = :nombreAlmMay");
										$stmt -> bindParam("nombreAlmMay", $nombreAlmMay, PDO::PARAM_STR);
										$stmt -> execute(); $filValid = $stmt -> rowCount();
										if ($filValid > 0) {
											$rowValid = $stmt -> fetch(PDO::FETCH_OBJ);
											echo '<li class="list-group-item">El Alumno <b class="text-danger">'.$rowValid -> nombre_c_al.'</b> ya esta registrado</li>';
											echo '<style> #alertCor{display:none;} </style>';
										} else {
											$stmt2 = $conex -> prepare("SELECT * FROM alumnos WHERE matricula_al = :matriculaAlmMay");
											$stmt2 -> bindParam("matriculaAlmMay", $matriculaAlmMay, PDO::PARAM_STR);
											$stmt2 -> execute(); $filValid2 = $stmt2 -> rowCount();
											if ($filValid2 > 0) {
												$rowValid2 = $stmt2 -> fetch(PDO::FETCH_OBJ);
												echo '<li class="list-group-item">La matricula <b class="text-danger">'.$rowValid2 -> matricula_al.'</b> ya esta registrado</li>';
												echo '<style> #alertCor{display:none;} </style>';
											} else {
												$stmtIns = $conex -> prepare("INSERT INTO alumnos (nombre_c_al, contrasena_al, contdesc_al, matricula_al, estado_al, id_carrera) VALUES (:nombreAlmMay, :passAlmEnc, :passAlm, :matriculaAlmMay, :valid, :id_carrera)");
												$stmtIns -> bindParam("nombreAlmMay", $nombreAlmMay, PDO::PARAM_STR);
												$stmtIns -> bindParam("passAlmEnc", $passAlmEnc, PDO::PARAM_STR);
												$stmtIns -> bindParam("passAlm", $passAlm, PDO::PARAM_STR);
												$stmtIns -> bindParam("matriculaAlmMay", $matriculaAlmMay, PDO::PARAM_STR);
												$stmtIns -> bindParam("valid", $valid, PDO::PARAM_INT);
												$stmtIns -> bindParam("id_carrera", $id_carrera, PDO::PARAM_INT);
												$stmtIns -> execute(); $filStmtIns = $stmtIns -> rowCount();
											}
										}
									}
									if ($filValid > 0 && !empty($filStmtIns) > 0 || !empty($filValid2) > 0 && !empty($filStmtIns) > 0) {
										echo '<style> #alertCor{display:block;} </style>';
										$msjGood .= 'Correcto!, algunos datos han sido insertados!';
									} else if ($filValid == 0 && $filValid2 == 0) {
										echo '<style> #alertCor{display:block;} </style>';
										$msjGood .= 'Correcto!, Datos insertados!';
									}
									
									echo '
											</ul>
										</div>
										<div class="col-sm-6">
											<div class="alert alert-success alert-dismissible fade show" role="alert" id="alertCor">
											  	<strong> '.$msjGood.' </strong>
											  		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											    	<span aria-hidden="true">&times;</span>
											  	</button>
											</div>
										</div>
									';
								} else {
									echo "fallo";
								}
							} else {
								echo "fallo";
							}
							unlink($destino);
						}
					?>
				</div>
			</div>
		</div>
	</div>

	<br><br><br>
	<?php include 'modalsconf.php'; ?>
	<?php include 'modalsInfo/modalInfoInd.php'; ?>
	<?php include 'footer2.php'; ?>

    <!--- Personalizados -->
    <script src="../vistas/modulos/dir/js/confDatContDir.js"></script>
    <script src="../vistas/modulos/dir/js/notifInd.js"></script>
    <script src="../vistas/modulos/dir/js/regAlum.js"></script>
    <script type="text/javascript">
    	$(function(){
    		$(window).scroll(function() {
			  if ($("#menu1").offset().top > 56) {
			      $("#menu1").addClass("bg-info");
			  } else {
			      $("#menu1").removeClass("bg-info");
			  }
			});
			$(window).scroll(function(){
				if ($("#menu2").offset().top > 56) {
			      $("#menu2").addClass("bg-info");
			      $("#textLog").text("U T S E M");
			  } else {
			      $("#menu2").removeClass("bg-info");
			      $("#textLog").text("S I T U T");
			  }
			});
    	});
    </script>
</body>
</html>

<?php		
	} else {
		header("Location:../vistas/modulos/dir/Logout.php");
	}
}

?>