<?php 

session_start();

if ($_SESSION['keyDoc'] == "" || $_SESSION['keyDoc'] == null) {
	header("Location:../../Index.php");
} else {
	require_once '../../modelos/docente.modelo.php';
	$docente = new Docentes();
	$keyDoc = $_SESSION['keyDoc'];
	$alm = $_SESSION["clvAlm"];
	$grp = $_SESSION["clvGrp"];
	$datGrp = $docente -> datGrpSel($keyDoc, $grp);
	$fechAct = date("Y-m-d");
	$dbConexion = new Connect();
	$dbConexion = $dbConexion -> getDB();
	switch ($_GET['oper']) {
		case 'cantTutPer':
			$valid = 1;
			$stmt = $dbConexion -> prepare("SELECT COUNT(id_tutpersonales) AS 'Cantidad' FROM tut_personales tut INNER JOIN alumnos alm ON alm.id_alumno = tut.id_alumno
				INNER JOIN det_grupo det ON det.id_detgrupo = alm.id_detgrupo
				INNER JOIN grupos grp ON grp.id_grupo = det.id_grupo  
				WHERE alm.id_alumno = :alm && estado_tut = :valid && tut.cuatrimestre_tut = grp.cuatrimestre_g");
			$stmt -> bindParam("alm", $alm, PDO::PARAM_INT);
			$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
			$stmt -> execute();
			$salida = "";
			while ($data = $stmt -> fetch(PDO::FETCH_ASSOC)) {
				$salida .= $data["Cantidad"];
			}
			echo $salida;
			$stmt = null; $dbConexion = null;
			break;
		case 'cantTutPerSol':
			$inval = 0;
			$stmt = $dbConexion -> prepare("SELECT COUNT(id_tutpersonales) AS 'Cantidad' FROM tut_personales tut INNER JOIN alumnos alm ON alm.id_alumno = tut.id_alumno
				INNER JOIN det_grupo det ON det.id_detgrupo = alm.id_detgrupo
				INNER JOIN grupos grp ON grp.id_grupo = det.id_grupo 
				WHERE alm.id_alumno = :alm && tut.estado_tut = :inval && tut.cuatrimestre_tut = grp.cuatrimestre_g");
			$stmt -> bindParam("alm", $alm, PDO::PARAM_INT);
			$stmt -> bindParam("inval", $inval, PDO::PARAM_INT);
			$stmt -> execute();
			$salida = "";
			while ($data = $stmt -> fetch(PDO::FETCH_ASSOC)) {
				$salida .= $data["Cantidad"];
			}
			echo $salida;
			$stmt = null; $dbConexion = null;
			break;
		case 'cantTutPerAll':
			$stmt = $dbConexion -> prepare("SELECT COUNT(id_tutpersonales) AS 'Cantidad' FROM tut_personales tut INNER JOIN alumnos alm ON alm.id_alumno = tut.id_alumno
				INNER JOIN det_grupo det ON det.id_detgrupo = alm.id_detgrupo
				INNER JOIN grupos grp ON grp.id_grupo = det.id_grupo  
				WHERE alm.id_alumno = :alm && tut.cuatrimestre_tut = grp.cuatrimestre_g");
			$stmt -> bindParam("alm", $alm, PDO::PARAM_INT);
			$stmt -> execute();
			$salida = "";
			while ($data = $stmt -> fetch(PDO::FETCH_ASSOC)) {
				$salida .= $data["Cantidad"];
			}
			echo $salida;
			$stmt = null; $dbConexion = null;
			break;		
		case 'cantJustAll':
			$stmt = $dbConexion -> prepare("SELECT COUNT(id_justificante) AS 'Cantidad' FROM justificantes jus INNER JOIN alumnos alm ON alm.id_alumno = jus.id_alumno
				INNER JOIN det_grupo det ON det.id_detgrupo = alm.id_detgrupo 
				INNER JOIN grupos grp ON grp.id_grupo = det.id_grupo  
				WHERE alm.id_alumno = :alm && jus.cuatrimestre_justif = grp.cuatrimestre_g");
			$stmt -> bindParam("alm", $alm, PDO::PARAM_INT);
			$stmt -> execute();	
			$salida = "";
			while ($data = $stmt -> fetch(PDO::FETCH_ASSOC)) {
				$salida .= $data["Cantidad"];
			}
			echo $salida;
			$stmt = null; $dbConexion = null;
			break;
		case 'cantJustAcept':
			$valValid = 1;
			$stmt = $dbConexion -> prepare("SELECT COUNT(id_justificante) AS 'Cantidad' FROM justificantes jus 
				INNER JOIN alumnos alm ON alm.id_alumno = jus.id_alumno
				INNER JOIN det_grupo det ON det.id_detgrupo = alm.id_detgrupo 
				INNER JOIN grupos grp ON grp.id_grupo = det.id_grupo 
				WHERE alm.id_alumno = :alm && estado_justif = :valValid && jus.cuatrimestre_justif = grp.cuatrimestre_g");
			$stmt -> bindParam("alm", $alm, PDO::PARAM_INT);
			$stmt -> bindParam("valValid", $valValid, PDO::PARAM_INT);
			$stmt -> execute();
			$salida = "";
			while ($data = $stmt -> fetch(PDO::FETCH_ASSOC)) {
				$salida .= $data["Cantidad"];
			}
			echo $salida;
			$stmt = null; $dbConexion = null;
			break;	
			case 'cantJustSinAcept':
				$valInval = 0;
				$stmt = $dbConexion -> prepare("SELECT COUNT(id_justificante) AS 'Cantidad' FROM justificantes jus INNER JOIN alumnos alm ON alm.id_alumno = jus.id_alumno 
					INNER JOIN det_grupo det ON det.id_detgrupo = alm.id_detgrupo 
					INNER JOIN grupos grp ON grp.id_grupo = det.id_grupo 
					WHERE alm.id_alumno = :alm && estado_justif = :valInval && jus.cuatrimestre_justif = grp.cuatrimestre_g");
				$stmt -> bindParam("alm", $alm, PDO::PARAM_INT);
				$stmt -> bindParam("valInval", $valInval, PDO::PARAM_INT);
				$stmt -> execute();
				$salida = "";
				while ($data = $stmt -> fetch(PDO::FETCH_ASSOC)) {
					$salida .= $data["Cantidad"];
				}
				echo $salida;
				$stmt = null; $dbConexion = null;
				break;
		default:
			$dbConexion = null;
			break;
	}
}