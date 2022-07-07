<?php 

session_start();
error_reporting(E_ERROR | E_WARNING | E_PARSE);
require_once '../modelos/conect.php';
$dbc = new Connect();
$dbc = $dbc -> getDB();
$fechAct = date("Y-m-d");

if ($_GET["oper"] != "") {
	switch ($_GET["oper"]) {
		case 'verificarLog':
			try {
				$correoAdm = isset($_POST['correoAdm']) ? trim($_POST['correoAdm']) : "";
				$passAdm = isset($_POST['passAdm']) ? trim($_POST['passAdm']) : "";
				$passEncript = sha1($passAdm); $valid = 1;
				$stmt = $dbc -> prepare("SELECT * FROM administradores WHERE  usuario = :correoAdm AND contrasena = :passEncript && condicion = :valid");
				$stmt -> bindParam("correoAdm", $correoAdm, PDO::PARAM_STR);
				$stmt -> bindParam("passEncript", $passEncript, PDO::PARAM_STR);
				$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
				$stmt -> execute(); $filStmt = $stmt -> rowCount();
				if ($filStmt === 1) {
					$row = $stmt -> fetch(PDO::FETCH_OBJ);
					$keyAdm = $row->id_admin;
					$stmtSes = $dbc -> prepare("UPDATE administradores SET fecha_ult_ses_adm = :fechAct WHERE id_admin = :keyAdm");
					$stmtSes -> bindParam("fechAct", $fechAct, PDO::PARAM_STR);
					$stmtSes -> bindParam("keyAdm", $keyAdm, PDO::PARAM_INT);
					$stmtSes -> execute();
					if (isset($row)) {
						$_SESSION['keyAdm'] = $row->id_admin;
					}
					echo 1;
				} else {
					echo "mal";
				}
			} catch (PDOException $e) {
				echo $e->getMessage();
			} finally {
				$stmt = null; $stmtSes = null; $dbc = null;
				unset($correoAdm); unset($passAdm); unset($passEncript);
			}
			break;
		case 'verificarLogCor':
			try {
				$correoCor = isset($_POST['correoCor']) ? trim($_POST['correoCor']) : "";
				$passCor = isset($_POST['passCor']) ? trim($_POST['passCor']) : "";
				$passEncript = sha1($passCor); $valid = 1;
				$stmt = $dbc -> prepare("SELECT * FROM coordinadores WHERE correo_cor = :correoCor && contrasena_cor = :passEncript && estado_cor = :valid");
				$stmt -> bindParam("correoCor", $correoCor, PDO::PARAM_STR);
				$stmt -> bindParam("passEncript", $passEncript, PDO::PARAM_STR);
				$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
				$stmt -> execute(); $filStmt = $stmt -> rowCount();
				if ($filStmt === 1) {
					$row = $stmt -> fetch(PDO::FETCH_OBJ);
					$keyCor = $row->id_coordinador;
					$stmtSes = $dbc -> prepare("UPDATE coordinadores SET fecha_ult_ses_cor = :fechAct WHERE id_coordinador = :keyCor");
					$stmtSes -> bindParam("fechAct", $fechAct, PDO::PARAM_STR);
					$stmtSes -> bindParam("keyCor", $keyCor, PDO::PARAM_INT);
					$stmtSes -> execute();
					if (isset($row)) {
						$_SESSION['keyCor'] = $row->id_coordinador;
					}
					echo 1;
				} else {
					echo "mal";
				} 
			} catch (PDOException $e) {
				echo $e->getMessage();
			} finally {
				$stmt = null; $stmtSes = null; $dbc = null;
				unset($correoCor); unset($passCor); unset($passEncript);
			}
			break;	
		case 'verificarLogDir':
			try {
				$correoDir = isset($_POST['correoDir']) ? trim($_POST['correoDir']) : "";
				$passDir = isset($_POST['passDir']) ? trim($_POST['passDir']) : "";
				$passDirEnc = sha1($passDir); $valid = 1;
				$stmt = $dbc -> prepare("SELECT * FROM directores WHERE correo_dir = :correoDir && contrasena_dir = :passDirEnc && estado_dir = :valid");
				$stmt -> bindParam("correoDir", $correoDir, PDO::PARAM_STR);
				$stmt -> bindParam("passDirEnc", $passDirEnc, PDO::PARAM_STR);
				$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
				$stmt -> execute(); $filStmt = $stmt -> rowCount();
				if ($filStmt === 1) {
					$row = $stmt -> fetch(PDO::FETCH_OBJ);
					$keyDir = $row->id_director;
					$stmtSes = $dbc -> prepare("UPDATE directores SET fecha_ult_ses_dir = :fechAct WHERE id_director = :keyDir");
					$stmtSes -> bindParam("fechAct", $fechAct, PDO::PARAM_STR);
					$stmtSes -> bindParam("keyDir", $keyDir, PDO::PARAM_INT);
					$stmtSes -> execute();
					if (isset($row)) {
						$_SESSION['keyDir'] = $row->id_director;
						$_SESSION['id_carrera'] = $row->id_carrera;
					}
					echo 1;
				} else {
					echo "mal";
				}
			} catch (PDOException $e) {
				echo $e->getMessage();
			} finally {
				$stmt = null; $stmtSes = null; $dbc = null;
				unset($correoDir); unset($passDir); unset($passDirEnc);
			}
			break;	
		case 'verificarLogDoc':
			try {
				$correoDoc = isset($_POST['correoDoc']) ? trim($_POST['correoDoc']) : "";
				$passDoc = isset($_POST['passDoc']) ? trim($_POST['passDoc']) : "";
				$passDocEnc = sha1($passDoc); $valid = 1;
				$stmt = $dbc -> prepare("SELECT * FROM docentes WHERE correo_doc = :correoDoc && contrasena_doc = :passDocEnc && condicion_doc = :valid");
				$stmt -> bindParam("correoDoc", $correoDoc, PDO::PARAM_STR);
				$stmt -> bindParam("passDocEnc", $passDocEnc, PDO::PARAM_STR);
				$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
				$stmt -> execute(); $filStmt = $stmt -> rowCount();
				if ($filStmt === 1) {
					$row = $stmt -> fetch(PDO::FETCH_OBJ);
					$keyDoc = $row->id_docente;
					$stmtSes = $dbc -> prepare("UPDATE docentes SET fecha_ult_ses_doc = :fechAct WHERE id_docente = :keyDoc");
					$stmtSes -> bindParam("fechAct", $fechAct, PDO::PARAM_STR);
					$stmtSes -> bindParam("keyDoc", $keyDoc, PDO::PARAM_INT);
					$stmtSes -> execute();
					if (isset($row)) {
						$_SESSION['keyDoc'] = $row->id_docente;
						$_SESSION['id_carrera'] = $row->id_carrera;
					}
					echo 1;
				} else {
					echo "mal";
				}
			} catch (PDOException $e) {
				echo $e->getMessage();
			} finally {
				$dbc = null; $stmtSes = null; $stmt = null;
				unset($correoDoc); unset($passDoc); unset($passDocEnc);
			}
			break;
		case 'verificarLogDevop':
			try {
				$usDevop = isset($_POST['usDevop']) ? trim($_POST['usDevop']) : "";
				$codDevop = isset($_POST['codDevop']) ? trim($_POST['codDevop']) : "";
				$codEnc = sha1($codDevop); 
				$valid = 1;
				$stmt = $dbc -> prepare("SELECT * FROM devop WHERE user_devop = :usDevop && pass_devop = :codEnc && estado_devop = :valid");
				$stmt -> bindParam("usDevop", $usDevop, PDO::PARAM_STR);
				$stmt -> bindParam("codEnc", $codEnc, PDO::PARAM_STR);
				$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
				$stmt -> execute(); $filStmt = $stmt -> rowCount();
				if ($filStmt === 1) {
					$row = $stmt -> fetch(PDO::FETCH_OBJ);
					if (isset($row)) {
						$_SESSION['keyDevop'] = $row->id_devop;
						$_SESSION['tokSeg'] = $row -> token_seg;
					}
					echo 1;
				} else {
					echo "mal";
				}
			} catch (PDOException $e) {
				echo $e->getMessage();
			} finally {
				$dbc = null; $stmt = null;
				unset($correoDoc); unset($passDoc); unset($passDocEnc);
			}
			break;
		default:
			//header("Location:../Index.php");
			$dbc = null;
			die();
			break;
	}
} else {
	include 'Error.php';
}
