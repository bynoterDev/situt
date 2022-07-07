<?php 

ob_start();
session_start();

if ($_SESSION['keyDir'] == "" || $_SESSION['keyDir'] == null) {
	header("Location:../../Index.php");
} else {
	require_once '../../modelos/director.modelo.php';
	$director = new Director();
	$keyDir = $_SESSION['keyDir'];
	$fechAct = date("Y-m-d");
	$dbConexion = new Connect();
	$dbConexion = $dbConexion -> getDB();
	switch ($_GET['oper']) {
		case 'confContDir':
			$contActDir = isset($_POST['contActDir']) ? limpiarDatos($_POST['contActDir']) : "";
			$newContDir = isset($_POST['newContDir']) ? limpiarDatos($_POST['newContDir']) : "";
			$repContDir = isset($_POST['repContDir']) ? limpiarDatos($_POST['repContDir']) : "";
			$contActDirEnc = sha1($contActDir);
			$newContDirEnc = sha1($newContDir);
			$valid = $dbConexion->prepare("SELECT nombre_c_dir FROM directores WHERE id_director = :keyDir && contrasena_dir = :contActDirEnc");
			$valid -> bindParam("keyDir", $keyDir, PDO::PARAM_INT);
			$valid -> bindParam("contActDirEnc", $contActDirEnc, PDO::PARAM_STR);
			$valid -> execute();
			$resvalid = $valid -> rowCount();
			if ($resvalid === 1) {
				$stmt = $dbConexion->prepare("UPDATE directores SET contrasena_dir = :newContDirEnc, contdesc_dir = :newContDir WHERE id_director = :keyDir");
				$stmt -> bindParam("newContDirEnc", $newContDirEnc, PDO::PARAM_STR);
				$stmt -> bindParam("newContDir", $newContDir, PDO::PARAM_STR);
				$stmt -> bindParam("keyDir", $keyDir, PDO::PARAM_INT);
				$resstmt = $stmt -> execute();
				if ($resstmt) {
					echo "goodup";
				} else {
					echo "failup";
				}
			} else {
				echo "failcont";
			}
			$valid = null; $resvalid = null; $stmt = null; $resstmt = null; $dbConexion = null;
			break;
		case 'confDatDir':
			$nomDir = isset($_POST['nomDir']) ? limpiarDatos($_POST['nomDir']) : "";
			$corDir = isset($_POST['corDir']) ? limpiarDatos($_POST['corDir']) : "";
			$telDir = isset($_POST['telDir']) ? limpiarDatos($_POST['telDir']) : "";
			$passConfDir = isset($_POST['passConfDir']) ? limpiarDatos($_POST['passConfDir']) : "";
			$passConfDirEnc = sha1($passConfDir);
			$valid = $dbConexion->prepare("SELECT nombre_c_dir FROM directores WHERE id_director = :keyDir && contrasena_dir = :passConfDirEnc");
			$valid -> bindParam("keyDir", $keyDir, PDO::PARAM_INT);
			$valid -> bindParam("passConfDirEnc", $passConfDirEnc, PDO::PARAM_STR);
			$valid -> execute();
			$resvalid = $valid -> rowCount();
			if ($resvalid === 1) {
				$stmt = $dbConexion->prepare("UPDATE directores SET nombre_c_dir = :nomDir, correo_dir = :corDir, telefono_dir = :telDir WHERE id_director = :keyDir");
				$stmt -> bindParam("nomDir", $nomDir, PDO::PARAM_STR);
				$stmt -> bindParam("corDir", $corDir, PDO::PARAM_STR);
				$stmt -> bindParam("telDir", $telDir, PDO::PARAM_STR);
				$stmt -> bindParam("keyDir", $keyDir, PDO::PARAM_INT);
				$resstmt = $stmt -> execute();
				if ($resstmt) {
					echo "goodup";
				} else {
					echo "failup";
				}
			} else {
				echo "failcont";
			}
			break;
		case 'confFotPerf':
			$newFotPerf = isset($_POST['newFotPerf']) ? limpiarDatos($_POST['newFotPerf']) : "";
			$sqlConsImg = "SELECT foto_perf_dir FROM directores WHERE id_director = '".$keyDir."'";
			$resConsImg = $conexion->query($sqlConsImg);
			$rowImg = mysqli_fetch_array($resConsImg);
			$imgBD = $rowImg['foto_perf_dir'];
			if ($imgBD != "") {
				unlink("../../moddir/perfilFot/".$imgBD);
			}
			$newFotPerf = $_FILES['newFotPerf']['name'];
			$tipoImg = $_FILES['newFotPerf']['type'];
			if (($newFotPerf == !NULL)) {
				if ($tipoImg == "image/jpeg" || $tipoImg == "image/jpg" || $tipoImg == "image/png") {
					$directorioG = "../../moddir/perfilFot/";
					move_uploaded_file($_FILES['newFotPerf']['tmp_name'], $directorioG.$newFotPerf);
				}
			}
			$stmt = $dbConexion -> prepare("UPDATE directores SET foto_perf_dir = :newFotPerf WHERE id_director = :keyDir");
			$stmt -> bindParam("newFotPerf", $newFotPerf, PDO::PARAM_STR);
			$stmt -> bindParam("keyDir", $keyDir, PDO::PARAM_INT);
			$resstmt = $stmt -> execute();
			if ($resstmt) {
				echo "goodUpd";
			} else {
				echo "failUpd";
			}
			$sqlConsImg = null; $resConsImg = null; $conexion = null; $stmt = null; 
			$resstmt = null; $dbConexion = null;
			break;		
		default:
			# code...
			break;
	}
}