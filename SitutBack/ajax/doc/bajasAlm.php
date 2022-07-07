<?php 

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
		case 'regBajaAlm':
			$id_alumno = isset($_POST['id_alumno']) ? limpiarDatos($_POST['id_alumno']) : "";
			$tipobaja = isset($_POST['tipobaja']) ? limpiarDatos($_POST['tipobaja']) : "";
			$periodo = isset($_POST['periodo']) ? limpiarDatos($_POST['periodo']) : "";
			$bajasolicitada = isset($_POST['bajasolicitada']) ? limpiarDatos($_POST['bajasolicitada']) : "";
			$motivBaja = isset($_POST['motivBaja']) ? limpiarDatos($_POST['motivBaja']) : "";
			$id_alumnoDec = base64_decode($id_alumno);
			$valid = 1;
			$passConf = isset($_POST['passConf']) ? limpiarDatos($_POST['passConf']) : "";
			$passConfEnc = sha1($passConf);
			$validPass = $dbConexion -> prepare("SELECT nombre_c_doc FROM docentes WHERE id_docente = :keyDoc && contrasena_doc = :passConfEnc");
			$validPass -> bindParam("keyDoc", $keyDoc, PDO::PARAM_INT);
			$validPass -> bindParam("passConfEnc", $passConfEnc, PDO::PARAM_STR);
			$validPass -> execute();
			$resValidPass = $validPass -> rowCount();
			if ($resValidPass == 1) {
				$validDat = $dbConexion -> prepare("SELECT * FROM bajasalm_dat WHERE id_alumno = :id_alumnoDec && estado_baj_alm = :valid");
				$validDat -> bindParam("id_alumnoDec", $id_alumnoDec, PDO::PARAM_INT);
				$validDat -> bindParam("valid", $valid, PDO::PARAM_INT);
				$validDat -> execute();
				$resValidDat = $validDat -> rowCount();
				if ($resValidDat == 0) {
					$stmt = $dbConexion -> prepare("INSERT INTO bajasalm_dat (tipobaja, periodo, bajasolicitada, motivo_baja, fecha_reg_baj, estado_baj_alm, id_alumno) VALUES (:tipobaja, :periodo, :bajasolicitada, :motivBaja, :fecha_reg_baj, :estado_baj_alm, :id_alumnoDec)");
					$stmt -> bindParam(":tipobaja", $tipobaja, PDO::PARAM_STR);
					$stmt -> bindParam(":periodo", $periodo, PDO::PARAM_STR);
					$stmt -> bindParam(":bajasolicitada", $bajasolicitada, PDO::PARAM_STR);
					$stmt -> bindParam(":motivBaja", $motivBaja, PDO::PARAM_STR);
					$stmt -> bindParam(":fecha_reg_baj", $fechAct, PDO::PARAM_STR);
					$stmt -> bindParam(":estado_baj_alm", $valid, PDO::PARAM_INT);
					$stmt -> bindParam(":id_alumnoDec", $id_alumnoDec, PDO::PARAM_INT);
					$stmt -> execute();
					$resstmt = $stmt -> rowCount();
					if ($resstmt === 1) {
						echo "goodIns";
					} else {
						echo "failIns";
					}
				} else {
					echo "extDat";
				}
			} else {
				echo "failCont";
			}
			$validPass = null; $resValidPass = null; $validDat = null; $resValidDat = null;
			$stmt = null; $resstmt = null; $dbConexion = null;
			break;		
		default:
			$dbConexion = null;
			break;
	}
}