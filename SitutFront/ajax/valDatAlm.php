<?php 

session_start();

require_once '../modelos/conect.php';
//require_once '../modelos/conexion.php';

switch ($_GET["oper"]) {
	case 'logAlm':
		$dbc = new Connect();
		$dbc = $dbc -> getDB();
		$cormatAlm = isset($_POST['cormatAlm']) ? trim($_POST['cormatAlm']) : "";
		$passAlm = isset($_POST['passAlm']) ? trim($_POST['passAlm']) : "";
		$passEncript = sha1($passAlm); $valid = 1;
		$stmt = $dbc -> prepare("SELECT * FROM alumnos as al inner join carreras as car
on al.id_carrera = car.id_carrera WHERE al.matricula_al = :cormatAlm && al.contrasena_al = :passEncript && al.estado_al = :valid");
		$stmt -> bindParam("cormatAlm", $cormatAlm, PDO::PARAM_STR);
		$stmt -> bindParam("passEncript", $passEncript, PDO::PARAM_STR);
		$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
		$stmt -> execute(); $filResStmt = $stmt -> rowCount();
		if ($filResStmt === 1) {
			$row = $stmt -> fetch(PDO::FETCH_OBJ);
			if (isset($row)) {
				$_SESSION['keyAlm'] = $row->id_alumno;
				$_SESSION['nombre_car'] = $row->nombre_car;
			} 
			echo 1;
		} else {
			echo "mal";
		}
		$stmt = null; $dbc = null;
		break;
	case 'regAlm':
		$dbConexion = new Connect();
		$dbConexion = $dbConexion -> getDB();
		$nomAlm = isset($_POST['nomAlm']) ? trim($_POST['nomAlm']) : "";
		$matAlm = isset($_POST['matAlm']) ? trim($_POST['matAlm']) : "";
		$corAlm = isset($_POST['corAlm']) ? trim($_POST['corAlm']) : "";
		$contAlm = isset($_POST['contAlm']) ? trim($_POST['contAlm']) : "";
		$telAlm = isset($_POST['telAlm']) ? trim($_POST['telAlm']) : "";
		$sexAlm = isset($_POST['sexAlm']) ? trim($_POST['sexAlm']) : "";
		$carAlm = isset($_POST['carAlm']) ? trim($_POST['carAlm']) : "";
		$contAlmEnc = sha1($contAlm);
		$estAlm = 1;
		$matMay = strtoupper($matAlm); 
		$nomMay = ucfirst($nomAlm);
		$valid1 = $dbConexion -> prepare("SELECT * FROM alumnos WHERE matricula_al = :matMay");
		$valid1 -> bindParam("matMay", $matMay, PDO::PARAM_STR);
		$valid1 -> execute();
		$resValid1 = $valid1 -> rowCount();
		if ($resValid1 === 1) {
			echo "extDatMat";
		} else {
			$valid2 = $dbConexion -> prepare("SELECT * FROM alumnos WHERE correo_al = :corAlm");
			$valid2 -> bindParam("corAlm", $corAlm, PDO::PARAM_STR);
			$valid2 -> execute();
			$resValid2 = $valid2 -> rowCount();
			if ($resValid2 === 1) {
				echo "extDatCor";
			} else {
				$stmt = $dbConexion -> prepare("INSERT INTO alumnos (nombre_c_al, correo_al, contrasena_al, contdesc_al, matricula_al, telefono_al, sexo_al, estado_al, acept_grp, id_carrera) VALUES (:nomMay, :corAlm, :contAlmEnc, :contAlm, :matMay, :telAlm, :sexAlm, :estAlm, 0, :carAlm)");
				$stmt -> bindParam("nomMay", $nomMay, PDO::PARAM_STR);
				$stmt -> bindParam("corAlm", $corAlm, PDO::PARAM_STR);
				$stmt -> bindParam("contAlmEnc", $contAlmEnc, PDO::PARAM_STR);
				$stmt -> bindParam("contAlm", $contAlm, PDO::PARAM_STR);
				$stmt -> bindParam("matMay", $matMay, PDO::PARAM_STR);
				$stmt -> bindParam("telAlm", $telAlm, PDO::PARAM_STR);
				$stmt -> bindParam("sexAlm", $sexAlm, PDO::PARAM_STR);
				$stmt -> bindParam("estAlm", $estAlm, PDO::PARAM_INT);
				$stmt -> bindParam("carAlm", $carAlm, PDO::PARAM_INT);
				$stmt -> execute();
				$resstmt = $stmt -> rowCount();
				if ($resstmt === 1) {
					echo "goodIns";
				} else {
					echo "failIns";
				}
			}
		}
		$valid1 = null; $valid2 = null; $stmt = null; $dbConexion = null;
	break;	
	default:
		$dbc = null; $dbConexion = null;
		break;
}