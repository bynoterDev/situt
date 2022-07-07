<?php 

session_start();

if ($_SESSION['keyDir'] == "" || $_SESSION['keyDir'] == null) {
	header("Location:../");
} else {
	include '../../modelos/rutasAmig.php';
	include '../../modelos/director.modelo.php';
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

<div class="container-fluid mt-5">
	
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
	    <h1 class="h3 mb-0 text-gray-800 text-center">Registrar alumnos mediante excel.</h1>
	    <a href="<?php echo SERVERURLDIR; ?>Home/" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
	        <i class="fas fa-arrow-left fa-sm text-white-50 mr-2"></i> Regresar 
	    </a>
	</div>

	<div class="row mt-5">
		<div class="col-sm-1"></div>
		<div class="col-sm-5 border border-left-primary p-3 rounded shadow">
			<form enctype="multipart/form-data" class="" method="POST" name="formRegAlmArch" id="formRegAlmArch" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<input type="hidden" value="<?php echo $car_Dir; ?>" name="id_carrera">
				<div class="form-group">
					<label for="archAlm">
						<i class="fas fa-file text-primary mr-2"></i>
						Seleccionar archivo</label>
					<input required="" type="file" id="archAlm" name="archAlm" class="form-control">
				</div>
				<div class="form-group">
					<label for="passAlm">
						<i class="fas fa-key mr-2 text-primary"></i>
						Contraseña para los alumnos</label>
					<input type="password" name="passAlm" id="passAlm" class="form-control">
					<div id="mensaje"></div>
				</div>
				<div class="form-group">
					<label for="repPass">
						<i class="fas fa-key mr-2 text-primary"></i>
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
		<div class="col-sm-5">
			<h3 class="text-center">
				<span class="badge-primary badge p-2">Resultados:</span>
			</h3>
		<?php 
			// Recibir datos archivo excel insertar alumnos //
			require_once 'Classes/PHPExcel/IOFactory.php';
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
							<div class="mt-5">
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
</body>
</html>

<?php		
	} else {
		header("Location:".SERVERURLDIR."dir/Logout.php");
	}
}

?>