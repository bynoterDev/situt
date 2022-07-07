<?php

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
		case 'editGrp':
			$editGrpOpc = isset($_POST['editGrpOpc']) ? limpiarDatos($_POST['editGrpOpc']) : "";
			//echo $editGrpOpc;
			$valHist = $alumno->datValidObtHist($editGrpOpc); 
			$datHist = $alumno->datHistValid($keyAlm);
			$nombre_c_doc = $valHist->nombre_c_doc;
			$grupo_n = $valHist->grupo_n;
			$cuatrimestre_g = $valHist->cuatrimestre_g;
			$period_cuat = $valHist->period_cuat;
			$inval = 0;
			$valid1 = $dbConexion -> prepare("SELECT * FROM historial_academ WHERE tutor_almhist = :nombre_c_doc && grupo_almhist = :grupo_n && cuatri_almhist = :cuatrimestre_g && periodcuat_almhist = :period_cuat && id_alumno = :keyAlm");
			$valid1 -> bindParam("nombre_c_doc", $nombre_c_doc, PDO::PARAM_STR);
			$valid1 -> bindParam("grupo_n", $grupo_n, PDO::PARAM_STR);
			$valid1 -> bindParam("cuatrimestre_g", $cuatrimestre_g, PDO::PARAM_STR);
			$valid1 -> bindParam("period_cuat", $period_cuat, PDO::PARAM_STR);
			$valid1 -> bindParam("keyAlm", $keyAlm, PDO::PARAM_INT);
			$valid1 -> execute();
			$resvalid1 = $valid1 -> rowCount();
			if ($resvalid1 === 1) {
				echo "existe";
			} else {
				$insHist = $dbConexion -> prepare("INSERT INTO historial_academ (id_alumno, tutor_almhist, grupo_almhist, cuatri_almhist, periodcuat_almhist, estado_almhist) VALUES (:keyAlm, :nombre_c_doc, :grupo_n, :cuatrimestre_g, :period_cuat, :inval)");
				$insHist -> bindParam(":keyAlm", $keyAlm, PDO::PARAM_INT);
				$insHist -> bindParam(":nombre_c_doc", $nombre_c_doc, PDO::PARAM_STR);
				$insHist -> bindParam(":grupo_n", $grupo_n, PDO::PARAM_STR);
				$insHist -> bindParam(":cuatrimestre_g", $cuatrimestre_g, PDO::PARAM_STR);
				$insHist -> bindParam(":period_cuat", $period_cuat, PDO::PARAM_STR);
				$insHist -> bindParam(":inval", $inval, PDO::PARAM_INT);
				$insHist -> execute();
				$resInsHist = $insHist -> rowCount();
				if ($resInsHist === 1) {
					$stmt = $dbConexion -> prepare("UPDATE alumnos SET acept_grp = :inval, id_detgrupo = :editGrpOpc WHERE id_alumno = :keyAlm");
					$stmt -> bindParam(":inval", $inval, PDO::PARAM_INT);
					$stmt -> bindParam(":editGrpOpc", $editGrpOpc, PDO::PARAM_INT);
					$stmt -> bindParam(":keyAlm", $keyAlm, PDO::PARAM_INT);
					$resstmt = $stmt -> execute();
					if ($resstmt) {
						echo "goodUpd";
					} else {
						echo "failUpd";
					}
				} else {
					echo "fallo inserción";
				}
			}

			//echo $valHist->nombre_c_doc." ".$valHist->grupo_n." ".$valHist->cuatrimestre_g." ".$valHist->period_cuat;
			// echo $datHist->nombre_c_doc." ".$datHist->grupo_n." ".$datHist->cuatrimestre_g." ".$datHist->period_cuat;
			/*$stmt = $dbConexion -> prepare("UPDATE alumnos SET acept_grp = :inval, id_detgrupo = :editGrpOpc WHERE id_alumno = :keyAlm");
			$stmt -> bindParam(":inval", $inval, PDO::PARAM_INT);
			$stmt -> bindParam(":editGrpOpc", $editGrpOpc, PDO::PARAM_INT);
			$stmt -> bindParam(":keyAlm", $keyAlm, PDO::PARAM_INT);
			$resstmt = $stmt -> execute();
			if ($resstmt) {
				echo "goodUpd";
			} else {
				echo "failUpd";
			}*/
			$stmt = null; $resstmt = null; $dbConexion = null;
			break;
		case 'regGrpP':
			$clvDetGrp = isset($_POST['clvDetGrp']) ? limpiarDatos($_POST['clvDetGrp']) : "";
			$stmt = $dbConexion -> prepare("UPDATE alumnos SET id_detgrupo = :clvDetGrp WHERE id_alumno = :keyAlm");
			$stmt -> bindParam(":clvDetGrp", $clvDetGrp, PDO::PARAM_INT);
			$stmt -> bindParam(":keyAlm", $keyAlm, PDO::PARAM_INT);
			$resstmt = $stmt -> execute();
			if ($resstmt) {
				echo "goodUpd";
			} else {
				echo "failUpd";
			}
			$stmt = null; $resstmt = null; $dbConexion = null;
			break;	
		default:
			$dbConexion = null;
			break;
	}
}
