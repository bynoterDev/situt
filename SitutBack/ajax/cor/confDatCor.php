<?php 

session_start();

if ($_SESSION['keyCor'] == "" || $_SESSION['keyCor'] == null) {
	header("Location:../../Index.php");
} else {
	require_once '../../modelos/coordinador.modelo.php';
	include '../../modelos/rutasAmig.php';
	$coordinador = new Coordinador();
	$keyCor = $_SESSION['keyCor'];
	$dbConexion =  new Connect();
	$dbConexion = $dbConexion -> getDB();
	switch ($_GET['oper']) {
		case 'confContCor':
			$contActCor = isset($_POST['contActCor']) ? limpiarDatos($_POST['contActCor']) : "";
			$newContCor = isset($_POST['newContCor']) ? limpiarDatos($_POST['newContCor']) : "";
			$contEnc = sha1($contActCor);
			$newContEnc = sha1($newContCor);
			$valid = $dbConexion -> prepare("SELECT nombre_c_cor FROM coordinadores WHERE contrasena_cor = :contEnc && id_coordinador = :keyCor");
			$valid -> bindParam("contEnc", $contEnc, PDO::PARAM_STR);
			$valid -> bindParam("keyCor", $keyCor, PDO::PARAM_INT);
			$valid -> execute();
			$resValid = $valid -> rowCount();
			if ($resValid === 1) {
				$stmt = $dbConexion -> prepare("UPDATE coordinadores SET contrasena_cor = :newContEnc, contdesc_cor = :newContCor WHERE id_coordinador = :keyCor");
				$stmt -> bindParam("newContEnc", $newContEnc, PDO::PARAM_STR);
				$stmt -> bindParam("newContCor", $newContCor, PDO::PARAM_STR);
				$stmt -> bindParam("keyCor", $keyCor, PDO::PARAM_INT);
				$resstmt = $stmt -> execute();
				if ($resstmt) {
					echo "goodUpd";
				} else {
					echo "failUpd";
				}
			} else {
				echo "failCont";
			}
			$valid = null; $resValid = null; $stmt = null; $resstmt = null; $dbConexion = null;
			break;
	 	case 'confDatCor':
	 		$nomCor = isset($_POST['nomCor']) ? limpiarDatos($_POST['nomCor']) : "";
			$corCor = isset($_POST['corCor']) ? limpiarDatos($_POST['corCor']) : "";
			$telCor = isset($_POST['telCor']) ? limpiarDatos($_POST['telCor']) : "";
			$sexCor = isset($_POST['sexCor']) ? limpiarDatos($_POST['sexCor']) : "";
			$passConfCor = isset($_POST['passConfCor']) ? limpiarDatos($_POST['passConfCor']) : "";
			$passEnc = sha1($passConfCor);
			$validPas = $dbConexion -> prepare("SELECT nombre_c_cor FROM coordinadores WHERE contrasena_cor = :passEnc && id_coordinador = :keyCor");
			$validPas -> bindParam("passEnc", $passEnc, PDO::PARAM_STR);
			$validPas -> bindParam("keyCor", $keyCor, PDO::PARAM_INT);
			$validPas -> execute();
			$resValidPas = $validPas -> rowCount();
			if ($resValidPas === 1) {
				$stmt = $dbConexion -> prepare("UPDATE coordinadores SET nombre_c_cor = :nomCor, correo_cor = :corCor, telefono_cor = :telCor, sexo_cor = :sexCor WHERE id_coordinador = :keyCor");
				$stmt -> bindParam("nomCor", $nomCor, PDO::PARAM_STR);
				$stmt -> bindParam("corCor", $corCor, PDO::PARAM_STR);
				$stmt -> bindParam("telCor", $telCor, PDO::PARAM_STR);
				$stmt -> bindParam("sexCor", $sexCor, PDO::PARAM_STR);
				$stmt -> bindParam("keyCor", $keyCor, PDO::PARAM_INT);
				$resstmt = $stmt -> execute();
				if ($resstmt) {
					echo "goodUpd";
				} else {
					echo "failUpd";
				}
			} else {
				echo "failCont";
			}
			$validPas = null; $resValidPas = null; $stmt = null; $resstmt = null; $dbConexion = null;
	 		break;
	 	case 'confFotCor':
	 		$newFotPerf = isset($_POST['newFotPerf']) ? limpiarDatos($_POST['newFotPerf']) : "";
	 		$validImg = $dbConexion -> prepare("SELECT foto_perf_cor FROM coordinadores WHERE id_coordinador = :keyCor");
	 		$validImg -> bindParam("keyCor", $keyCor, PDO::PARAM_INT);
	 		$validImg -> execute();
	 		$imgRes = $validImg -> fetch(PDO::FETCH_OBJ);
	 		if ($imgRes->foto_perf_cor != "") {
	 			unlink("../../modCor/perfilFot/".$imgRes->foto_perf_cor);
	 		}
	 		$newFotPerf = $_FILES['newFotPerf']['name'];
	 		$tipoImg = $_FILES['newFotPerf']['type'];
	 		if (($newFotPerf == !NULL)) {
	 			if ($tipoImg == "image/jpeg" || $tipoImg == "image/jpg" || $tipoImg == "image/png") {
	 				$directorioG = "../../modCor/perfilFot/";
	 				move_uploaded_file($_FILES['newFotPerf']['tmp_name'], $directorioG.$newFotPerf);
	 			}
	 		}
	 		$stmt = $dbConexion -> prepare("UPDATE coordinadores SET foto_perf_cor = :newFotPerf WHERE id_coordinador = :keyCor");
	 		$stmt -> bindParam("newFotPerf", $newFotPerf, PDO::PARAM_STR);
	 		$stmt -> bindParam("keyCor", $keyCor, PDO::PARAM_INT);
	 		$resstmt = $stmt -> execute();
	 		if ($resstmt) {
	 			echo "goodUpd";
	 		} else {
	 			echo "failUpd";
	 		}
	 		break;	
		default:
			$dbConexion = null;
			break;
	}
}