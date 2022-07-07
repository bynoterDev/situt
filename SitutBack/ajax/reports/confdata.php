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

		case 'cont':

			$newPas = isset($_POST['newPas']) ? trim($_POST['newPas']) : "";
			$actPas = isset($_POST['actPas']) ? trim($_POST['actPas']) : "";
			$newPas = sha1($newPas);
			$actPas = sha1($actPas);

			try {
				$stmt = $dbConexion -> prepare("SELECT nombre_devop FROM devop WHERE pass_devop = :actPas && id_devop = :keyDevop");
				$stmt -> bindParam("actPas", $actPas, PDO::PARAM_STR);
				$stmt -> bindParam("keyDevop", $keyDevop, PDO::PARAM_INT);
				$stmt -> execute();
				$filstmt = $stmt -> rowCount();
				if ($filstmt == 1) {
					$upd = $dbConexion -> prepare("UPDATE devop SET pass_devop = :newPas WHERE id_devop = :keyDevop");
					$upd -> bindParam("newPas", $newPas, PDO::PARAM_STR);
					$upd -> bindParam("keyDevop", $keyDevop, PDO::PARAM_INT);
					$upd -> execute();
					if ($upd) {
						echo 1;
					} else { 
						echo 2;
					}
				} else {
					echo 0;
				}
			} catch (PDOException $e) {
				echo $e->getMessage();
			} finally {
				$dbConexion = null; $stmt = null; $upd = null;
			}


			break;

	default:
		$dbConexion = null;
		break;
	}
}

ob_end_flush();

?>