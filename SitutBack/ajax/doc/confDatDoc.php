<?php 

ob_start();
session_start();

if ($_SESSION['keyDoc'] == "" || $_SESSION['keyDoc'] == null) {
	header("Location:../../Index.php");
} else {
	require_once '../../modelos/docente.modelo.php';
	$docente = new Docentes();
	$keyDoc = $_SESSION['keyDoc'];
	$fechAct = date("Y-m-d");
	$dbConexion = new Connect();
	$dbConexion = $dbConexion -> getDB();
	switch ($_GET['oper']) {
		case 'confContDoc':
			$contActDoc = isset($_POST['contActDoc']) ? limpiarDatos($_POST['contActDoc']) : "";
			$newContDoc = isset($_POST['newContDoc']) ? limpiarDatos($_POST['newContDoc']) : "";
			$repContDoc = isset($_POST['repContDoc']) ? limpiarDatos($_POST['repContDoc']) : "";
			$contActDocEnc = sha1($contActDoc);
			$newContDocEnc = sha1($newContDoc);
			$valid = $dbConexion -> prepare("SELECT nombre_c_doc FROM docentes WHERE id_docente = :keyDoc && contrasena_doc = :contActDocEnc");
			$valid -> bindParam("keyDoc", $keyDoc, PDO::PARAM_INT);
			$valid -> bindParam("contActDocEnc", $contActDocEnc, PDO::PARAM_STR);
			$valid -> execute();
			$resvalid = $valid -> rowCount();
			if ($resvalid === 1) {
				$stmt = $dbConexion -> prepare("UPDATE docentes SET contrasena_doc = :newContDocEnc, contdesc_doc = :newContDoc WHERE id_docente = :keyDoc");
				$stmt -> bindParam("newContDocEnc", $newContDocEnc, PDO::PARAM_STR);
				$stmt -> bindParam("newContDoc", $newContDoc, PDO::PARAM_STR);
				$stmt -> bindParam("keyDoc", $keyDoc, PDO::PARAM_INT);
				$resstmt = $stmt -> execute();
				if ($resstmt) { echo "goodUp"; } else { echo "failUp"; }
			} else { echo "failCont"; }
			$valid = null; $resvalid = null; $stmt = null; $resstmt = null; $dbConexion = null;
			break;
		case 'confDatDoc':
			$nomDoc = isset($_POST['nomDoc']) ? limpiarDatos($_POST['nomDoc']) : "";
			$corDoc = isset($_POST['corDoc']) ? limpiarDatos($_POST['corDoc']) : "";
			$telDoc = isset($_POST['telDoc']) ? limpiarDatos($_POST['telDoc']) : "";
			$dirDoc = isset($_POST['dirDoc']) ? limpiarDatos($_POST['dirDoc']) : "";
			$espDoc = isset($_POST['espDoc']) ? limpiarDatos($_POST['espDoc']) : "";
			$passConfDoc = isset($_POST['passConfDoc']) ? limpiarDatos($_POST['passConfDoc']) : "";
			$passEnc = sha1($passConfDoc);
			$valid = $dbConexion -> prepare("SELECT nombre_c_doc FROM docentes WHERE id_docente = :keyDoc && contrasena_doc = :passEnc");
			$valid -> bindParam("keyDoc", $keyDoc, PDO::PARAM_INT);
			$valid -> bindParam("passEnc", $passEnc, PDO::PARAM_STR);
			$valid -> execute();
			$resvalid = $valid -> rowCount();
			if ($resvalid === 1) {
				$stmt = $dbConexion -> prepare("UPDATE docentes SET nombre_c_doc = :nomDoc, correo_doc = :corDoc, direccion_doc = :dirDoc, especialidad_doc = :espDoc, telefono_doc = :telDoc WHERE id_docente = :keyDoc");
				$stmt -> bindParam("nomDoc", $nomDoc, PDO::PARAM_STR);
				$stmt -> bindParam("corDoc", $corDoc, PDO::PARAM_STR);
				$stmt -> bindParam("dirDoc", $dirDoc, PDO::PARAM_STR);
				$stmt -> bindParam("espDoc", $espDoc, PDO::PARAM_STR);
				$stmt -> bindParam("telDoc", $telDoc, PDO::PARAM_STR);
				$stmt -> bindParam("keyDoc", $keyDoc, PDO::PARAM_INT);
				$resstmt = $stmt -> execute();
				if ($resstmt) { echo "goodUp"; } else { echo "failUp"; }
			} else { echo "failCont"; }
			$valid = null; $resvalid = null; $stmt = null; $resstmt = null; $dbConexion = null;
			break;	
		case 'confFotPerf':
			$newFotPerf = isset($_POST['newFotPerf']) ? limpiarDatos($_POST['newFotPerf']) : "";
			$sqlConsImg = "SELECT foto_perf_doc FROM docentes WHERE id_docente = '".$keyDoc."'";
			$resConsImg = $conexion->query($sqlConsImg);
			$rowImg = mysqli_fetch_array($resConsImg);
			$imgBD = $rowImg['foto_perf_doc'];
			if ($imgBD != "") {
				unlink("../../moddoc/perfilFot/".$imgBD);
			}
			$newFotPerf = $_FILES['newFotPerf']['name'];
			$tipoImg = $_FILES['newFotPerf']['type'];
			if (($newFotPerf == !NULL)) {
				if ($tipoImg == "image/jpeg" || $tipoImg == "image/jpg" || $tipoImg == "image/png") {
					$directorioG = "../../moddoc/perfilFot/";
					move_uploaded_file($_FILES['newFotPerf']['tmp_name'], $directorioG.$newFotPerf);
				}
			}
			$stmt = $dbConexion -> prepare("UPDATE docentes SET foto_perf_doc = :newFotPerf WHERE id_docente = :keyDoc");
			$stmt -> bindParam("newFotPerf", $newFotPerf, PDO::PARAM_STR);
			$stmt -> bindParam("keyDoc", $keyDoc, PDO::PARAM_INT);
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
			$dbConexion = null;
			break;
	}
}