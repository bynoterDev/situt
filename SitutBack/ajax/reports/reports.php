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

		case 'repsol':
			
			$clvRep = isset($_POST['clvRep']) ? trim($_POST['clvRep']) : "";
			$notaAg = isset($_POST['notaAg']) ? trim($_POST['notaAg']) : "";
			$selectEst = isset($_POST['selectEst']) ? trim($_POST['selectEst']) : "";
			$confirmPs = isset($_POST['confirmPs']) ? trim($_POST['confirmPs']) : "";
			$confirmPs = sha1($confirmPs);

			try {
				$valid = $dbConexion -> prepare("SELECT nombre_devop FROM devop WHERE id_devop = :keyDevop && pass_devop = :confirmPs");
				$valid -> bindParam("keyDevop", $keyDevop, PDO::PARAM_INT);
				$valid -> bindParam("confirmPs", $confirmPs, PDO::PARAM_INT);
				$valid -> execute();
				$rowValid = $valid -> rowCount();
				if ($rowValid == 1) {
					$stmt = $dbConexion -> prepare("INSERT INTO represult (fecha_result, nota_result, id_reportprob) VALUES (:fechAct, :notaAg, :clvRep)");
					$stmt -> bindParam("fechAct", $fechAct, PDO::PARAM_INT);
					$stmt -> bindParam("notaAg", $notaAg, PDO::PARAM_STR);
					$stmt -> bindParam("clvRep", $clvRep, PDO::PARAM_STR);
					$resstmt = $stmt -> execute();
					if ($resstmt) {
						$stmt1 = $dbConexion -> prepare("UPDATE reportsprob SET estado_rep = :selectEst WHERE id_report = :clvRep");
						$stmt1 -> bindParam("selectEst", $selectEst, PDO::PARAM_STR);
						$stmt1 -> bindParam("clvRep", $clvRep, PDO::PARAM_STR);
					 	$resstmt1 = $stmt1 -> execute();
					 	if ($resstmt1) {
					 		echo 1;
					 	} else {
					 		echo 3;
					 	}
					} else {
						echo 3;
					}
				} else {
					echo 2;
				}
			} catch (PDOException $e) {
				echo $e->getMessage();
			} finally {
				$dbConexion = null; $stmt = null; $stmt1 = null;
			}

			break;

	default:
		$dbConexion = null;
		break;
	}
}

ob_end_flush();

?>