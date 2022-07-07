 <?php 

ob_start();
session_start();

if ($_SESSION['keyDevop'] == "" || $_SESSION['keyDevop'] == null) {
	header("Location:../../");
} else {
	require_once '../../modelos/devop.modelo.php';
	$devop = new Developer();
	$keyDevop = $_SESSION['keyDevop'];
	$fechAct = date("Y-m-d");
	$dbConexion = new Connect();
	$dbConexion = $dbConexion -> getDB();
	switch ($_GET['oper']) {
		case 'cuentCor':
			$inval = 0; $valid = 1;
			$param = isset($_POST['param']) ? trim($_POST['param']) : "";
			$opc = isset($_POST['opc']) ? trim($_POST['opc']) : "";
			if ($opc == 'desc') {
				$stmt = $dbConexion -> prepare("UPDATE coordinadores SET estado_cor = :inval WHERE id_coordinador = :param");
				$stmt -> bindParam("inval", $inval, PDO::PARAM_INT);
			} else if ($opc == 'acti') {
				$stmt = $dbConexion -> prepare("UPDATE coordinadores SET estado_cor = :valid WHERE id_coordinador = :param");
				$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
			}
			$stmt -> bindParam("param", $param, PDO::PARAM_INT);
			$resstmt = $stmt -> execute();
			if ($resstmt) {
				echo 1;
			} else {
				echo 0;
			}
			$stmt = null; $dbConexion = null;
			break;
		case 'reporCor':
			$inval = 0; $valid = 1;
			$param = isset($_POST['param']) ? trim($_POST['param']) : "";
			$opc = isset($_POST['opc']) ? trim($_POST['opc']) : "";
			if ($opc == 'desc') {
				$stmt = $dbConexion -> prepare("UPDATE coordinadores SET us_mod_rep = :inval WHERE id_coordinador = :param");
				$stmt -> bindParam("inval", $inval, PDO::PARAM_INT);
			} else if ($opc == 'acti') {
				$stmt = $dbConexion -> prepare("UPDATE coordinadores SET us_mod_rep = :valid WHERE id_coordinador = :param");
				$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
			}
			$stmt -> bindParam("param", $param, PDO::PARAM_INT);
			$resstmt = $stmt -> execute();
			if ($resstmt) {
				echo 1;
			} else {
				echo 0;
			}
			$stmt = null; $dbConexion = null;
			break;
		case 'cuentAdm':
			$inval = 0; $valid = 1;
			$param = isset($_POST['param']) ? trim($_POST['param']) : "";
			$opc = isset($_POST['opc']) ? trim($_POST['opc']) : "";
			if ($opc == 'desc') {
				$stmt = $dbConexion -> prepare("UPDATE administradores SET condicion = :inval WHERE id_admin = :param");
				$stmt -> bindParam("inval", $inval, PDO::PARAM_INT);
			} else if ($opc == 'acti') {
				$stmt = $dbConexion -> prepare("UPDATE administradores SET condicion = :valid WHERE id_admin = :param");
				$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
			}
			$stmt -> bindParam("param", $param, PDO::PARAM_INT);
			$resstmt = $stmt -> execute();
			if ($resstmt) {
				echo 1;
			} else {
				echo 0;
			}
			$stmt = null; $dbConexion = null;
			break;
		case 'reporAdm':
			$inval = 0; $valid = 1;
			$param = isset($_POST['param']) ? trim($_POST['param']) : "";
			$opc = isset($_POST['opc']) ? trim($_POST['opc']) : "";
			if ($opc == 'desc') {
				$stmt = $dbConexion -> prepare("UPDATE administradores SET us_mod_rep = :inval WHERE id_admin = :param");
				$stmt -> bindParam("inval", $inval, PDO::PARAM_INT);
			} else if ($opc == 'acti') {
				$stmt = $dbConexion -> prepare("UPDATE administradores SET us_mod_rep = :valid WHERE id_admin = :param");
				$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
			}
			$stmt -> bindParam("param", $param, PDO::PARAM_INT);
			$resstmt = $stmt -> execute();
			if ($resstmt) {
				echo 1;
			} else {
				echo 0;
			}
			$stmt = null; $dbConexion = null;
			break;
		case 'cuentDir':
			$inval = 0; $valid = 1;
			$param = isset($_POST['param']) ? trim($_POST['param']) : "";
			$opc = isset($_POST['opc']) ? trim($_POST['opc']) : "";
			if ($opc == 'desc') {
				$stmt = $dbConexion -> prepare("UPDATE directores SET estado_dir = :inval WHERE id_director = :param");
				$stmt -> bindParam("inval", $inval, PDO::PARAM_INT);
			} else if ($opc == 'acti') {
				$stmt = $dbConexion -> prepare("UPDATE directores SET estado_dir = :valid WHERE id_director = :param");
				$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
			}
			$stmt -> bindParam("param", $param, PDO::PARAM_INT);
			$resstmt = $stmt -> execute();
			if ($resstmt) {
				echo 1;
			} else {
				echo 0;
			}
			$stmt = null; $dbConexion = null;
			break;
		case 'reporDir':
			$inval = 0; $valid = 1;
			$param = isset($_POST['param']) ? trim($_POST['param']) : "";
			$opc = isset($_POST['opc']) ? trim($_POST['opc']) : "";
			if ($opc == 'desc') {
				$stmt = $dbConexion -> prepare("UPDATE directores SET us_mod_rep = :inval WHERE id_director = :param");
				$stmt -> bindParam("inval", $inval, PDO::PARAM_INT);
			} else if ($opc == 'acti') {
				$stmt = $dbConexion -> prepare("UPDATE directores SET us_mod_rep = :valid WHERE id_director = :param");
				$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
			}
			$stmt -> bindParam("param", $param, PDO::PARAM_INT);
			$resstmt = $stmt -> execute();
			if ($resstmt) {
				echo 1;
			} else {
				echo 0;
			}
			$stmt = null; $dbConexion = null;
			break;
		case 'cuentDoc':
			$inval = 0; $valid = 1;
			$param = isset($_POST['param']) ? trim($_POST['param']) : "";
			$opc = isset($_POST['opc']) ? trim($_POST['opc']) : "";
			if ($opc == 'desc') {
				$stmt = $dbConexion -> prepare("UPDATE docentes SET condicion_doc = :inval WHERE id_docente = :param");
				$stmt -> bindParam("inval", $inval, PDO::PARAM_INT);
			} else if ($opc == 'acti') {
				$stmt = $dbConexion -> prepare("UPDATE docentes SET condicion_doc = :valid WHERE id_docente = :param");
				$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
			}
			$stmt -> bindParam("param", $param, PDO::PARAM_INT);
			$resstmt = $stmt -> execute();
			if ($resstmt) {
				echo 1;
			} else {
				echo 0;
			}
			$stmt = null; $dbConexion = null;
			break;
		case 'reporDoc':
			$inval = 0; $valid = 1;
			$param = isset($_POST['param']) ? trim($_POST['param']) : "";
			$opc = isset($_POST['opc']) ? trim($_POST['opc']) : "";
			if ($opc == 'desc') {
				$stmt = $dbConexion -> prepare("UPDATE docentes SET us_mod_rep = :inval WHERE id_docente = :param");
				$stmt -> bindParam("inval", $inval, PDO::PARAM_INT);
			} else if ($opc == 'acti') {
				$stmt = $dbConexion -> prepare("UPDATE docentes SET us_mod_rep = :valid WHERE id_docente = :param");
				$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
			}
			$stmt -> bindParam("param", $param, PDO::PARAM_INT);
			$resstmt = $stmt -> execute();
			if ($resstmt) {
				echo 1;
			} else {
				echo 0;
			}
			$stmt = null; $dbConexion = null;
			break;
		case 'contAdm':
			$clv_adm = isset($_POST['clv_adm']) ? trim($_POST['clv_adm']) : "";
			$nuevpas = isset($_POST['nuevpas']) ? trim($_POST['nuevpas']) : "";
			$nuevpasEnc = sha1($nuevpas);
			$passact = isset($_POST['passact']) ? trim($_POST['passact']) : "";
			$passact = sha1($passact);
			try {
				$stmt = $dbConexion -> prepare("SELECT nombre_devop FROM devop WHERE id_devop = :keyDevop && pass_devop = :passact");
				$stmt -> bindParam("keyDevop", $keyDevop, PDO::PARAM_INT);
				$stmt -> bindParam("passact", $passact, PDO::PARAM_STR);
				$stmt -> execute(); 
				$filStmt = $stmt -> rowCount();
				if ($filStmt == 1) {
					$stmt2 = $dbConexion -> prepare("UPDATE administradores SET contrasena = :nuevpasEnc, contdesc = :nuevpas WHERE id_admin = :clv_adm");
					$stmt2 -> bindParam("nuevpasEnc", $nuevpasEnc, PDO::PARAM_STR);
					$stmt2 -> bindParam("nuevpas", $nuevpas, PDO::PARAM_STR);
					$stmt2 -> bindParam("clv_adm", $clv_adm, PDO::PARAM_INT);
					$resUpd = $stmt2 -> execute();
					if ($resUpd) {
						echo 1;
					} else {
						echo 0;
					}
				} else {
					echo 2;
				}
			} catch (PDOException $e) {
				echo $e->getMessage();
			} finally {
				$dbConexion = null; $stmt = null;
			}
			break;
	default:
		$dbConexion = null;
		break;
	}
}

ob_end_flush();

?>