<?php

ob_start();
session_start();

if ($_SESSION['keyAlm'] == "" || $_SESSION['keyAlm'] == null) {
	header("Location:../../Index.php");
} else {
	require_once '../../modelos/alumno.modelo.php';
	$alumno = new Alumno();
	$keyAlm = $_SESSION['keyAlm'];
	$fechAct = date("Y-m-d");
	//$dbConexion = Connect::getDB();
	
	$dbConexion = new Connect();
	$dbConexion = $dbConexion -> getDB();
	switch ($_GET['oper']) {
		case 'confContAlm':
			$contActAlm = isset($_POST['contActAlm']) ? limpiarDatos($_POST['contActAlm']) : "";
			$newContAlm = isset($_POST['newContAlm']) ? limpiarDatos($_POST['newContAlm']) : "";
			$newContAlmEnc = sha1($newContAlm); $contActAlmEnc = sha1($contActAlm);
			$valid = $dbConexion -> prepare("SELECT nombre_c_al FROM alumnos WHERE id_alumno = :keyAlm && contrasena_al = :contActAlmEnc");
			$valid -> bindParam("keyAlm", $keyAlm, PDO::PARAM_INT);
			$valid -> bindParam("contActAlmEnc", $contActAlmEnc, PDO::PARAM_STR);
			$valid -> execute();
			$resvalid = $valid -> rowCount();
			if ($resvalid === 1) {
				$stmt = $dbConexion -> prepare("UPDATE alumnos SET contrasena_al = :newContAlmEnc, contdesc_al = :newContAlm WHERE id_alumno = :keyAlm");
				$stmt -> bindParam("newContAlmEnc", $newContAlmEnc, PDO::PARAM_STR);
				$stmt -> bindParam("newContAlm", $newContAlm, PDO::PARAM_STR);
				$stmt -> bindParam("keyAlm", $keyAlm, PDO::PARAM_INT);
				$resstmt = $stmt -> execute();
				if ($resstmt) { echo "goodUpd"; } else { echo "failUpd"; }
			} else {
				echo "failCont";
			}
			$valid = null; $resvalid = null; $stmt = null; $resstmt = null; $dbConexion = null;
			break;
		case 'confDataAlm':
			$nomAlm = isset($_POST['nomAlm']) ? limpiarDatos($_POST['nomAlm']) : "";
			$corAlm = isset($_POST['corAlm']) ? limpiarDatos($_POST['corAlm']) : "";
			$telAlm = isset($_POST['telAlm']) ? limpiarDatos($_POST['telAlm']) : "";
			$matAlm = isset($_POST['matAlm']) ? limpiarDatos($_POST['matAlm']) : "";
			$sexAlm = isset($_POST['sexAlm']) ? limpiarDatos($_POST['sexAlm']) : "";
			$passConfAlm = isset($_POST['passConfAlm']) ? limpiarDatos($_POST['passConfAlm']) : "";
			$nomAlmM = ucwords($nomAlm); $matAlmM = strtoupper($matAlm);
			$passConfAlmEnc = sha1($passConfAlm);
			$valid = $dbConexion -> prepare("SELECT nombre_c_al FROM alumnos WHERE id_alumno = :keyAlm && contrasena_al = :passConfAlmEnc");
			$valid -> bindParam("keyAlm", $keyAlm, PDO::PARAM_INT);
			$valid -> bindParam("passConfAlmEnc", $passConfAlmEnc, PDO::PARAM_STR);
			$valid -> execute();
			$resvalid = $valid -> rowCount();
			if ($resvalid === 1) {
				//Validar matricula y correo 
				$valid1 = $dbConexion -> prepare("SELECT nombre_c_al FROM alumnos WHERE correo_al = :corAlm && id_alumno != :keyAlm");
				$valid1 -> bindParam("corAlm", $corAlm, PDO::PARAM_STR);
				$valid1 -> bindParam("keyAlm", $keyAlm, PDO::PARAM_INT);
				$valid1 -> execute();
				$resvalid1 = $valid1 -> rowCount();
				if ($resvalid1 === 0) {
					$valid2 = $dbConexion -> prepare("SELECT nombre_c_al FROM alumnos WHERE matricula_al = :matAlm && id_alumno != :keyAlm");
					$valid2 -> bindParam("matAlm", $matAlm, PDO::PARAM_STR);
					$valid2 -> bindParam("keyAlm", $keyAlm, PDO::PARAM_INT);
					$valid2 -> execute();
					$resvalid2 = $valid2 -> rowCount();
					if ($resvalid2 === 0) {
						$stmt = $dbConexion -> prepare("UPDATE alumnos SET nombre_c_al = :nomAlm, correo_al = :corAlm, matricula_al = :matAlm, telefono_al = :telAlm, sexo_al = :sexAlm WHERE id_alumno = :keyAlm");
						$stmt -> bindParam("nomAlm", $nomAlmM, PDO::PARAM_STR);
						$stmt -> bindParam("corAlm", $corAlm, PDO::PARAM_STR);
						$stmt -> bindParam("matAlm", $matAlmM, PDO::PARAM_STR);
						$stmt -> bindParam("telAlm", $telAlm, PDO::PARAM_STR);
						$stmt -> bindParam("sexAlm", $sexAlm, PDO::PARAM_STR);
						$stmt -> bindParam("keyAlm", $keyAlm, PDO::PARAM_INT);
						$resstmt = $stmt -> execute();
						if ($resstmt) {
							echo "goodUpd";
						} else {
							echo "failUpd";
						}
					} else {
						echo "matExt";
					}
				} else {
					echo "corExt";
				}
			} else { 
				echo "failCont";
			}
			$valid = null; $resvalid = null; $valid1 = null; $resvalid1 = null; $valid2 = null; $resvalid2 = null;
			$stmt = null; $resstmt = null; $dbConexion = null;
			break;
		case 'confFotPerf':
			$newFotPerf = isset($_POST['newFotPerf']) ? limpiarDatos($_POST['newFotPerf']) : "";
			$sqlConsImg = "SELECT foto_perf_alm FROM alumnos WHERE id_alumno = '".$keyAlm."'";
			$resConsImg = $conexion->query($sqlConsImg);
			$rowImg = mysqli_fetch_array($resConsImg);
			$imgBD = $rowImg['foto_perf_alm'];
			if ($imgBD != "") {
				unlink("../../modAlm/Arch/perfil/".$imgBD);
			}
			$newFotPerf = $_FILES['newFotPerf']['name'];
			$tipoImg = $_FILES['newFotPerf']['type'];
			if (($newFotPerf == !NULL)) {
				if ($tipoImg == "image/jpeg" || $tipoImg == "image/jpg" || $tipoImg == "image/png") {
					$directorioG = "../../modAlm/Arch/perfil/";
					move_uploaded_file($_FILES['newFotPerf']['tmp_name'], $directorioG.$newFotPerf);
				}
			}
			$stmt = $dbConexion -> prepare("UPDATE alumnos SET foto_perf_alm = :newFotPerf WHERE id_alumno = :keyAlm");
			$stmt -> bindParam("newFotPerf", $newFotPerf, PDO::PARAM_STR);
			$stmt -> bindParam("keyAlm", $keyAlm, PDO::PARAM_INT);
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
