 <?php 

ob_start();
session_start();

if ($_SESSION['keyAdm'] == "" || $_SESSION['keyAdm'] == null) {
	header("Location:../../Index.php");
} else {
	require_once '../../modelos/admin.modelo.php';
	include '../../modelos/rutasAmig.php';
	$administrador = new Administrador();
	$keyAdm = $_SESSION['keyAdm'];
	$fechAct = date("Y-m-d");
	$dbConexion = new Connect();
	$dbConexion = $dbConexion -> getDB();
	switch ($_GET['oper']) {
		case 'cantTotCar':
			try {
				$consult = $dbConexion -> prepare("SELECT COUNT(id_carrera) AS 'cantTotCar' FROM carreras");
				$consult -> execute();
				$salida = "";
				while ( $data = $consult -> fetch(PDO::FETCH_ASSOC) ) {
					$salida .= $data["cantTotCar"];
				}
				echo $salida;
			} catch (PDOException $e) {
				echo $e->getMessage();
			} finally {
				$dbConexion = null; $consult = null;
				unset($salida);
			}
			break;
		case 'cantTotCarAct':
			try {
				$valid = 1;
				$consult = $dbConexion -> prepare("SELECT count(id_carrera) AS 'cantTotCarAct' FROM carreras WHERE estado_car = :valid");
				$consult -> bindParam("valid", $valid, PDO::PARAM_INT);
				$consult -> execute();
				$salida = "";
				while ( $data = $consult -> fetch(PDO::FETCH_ASSOC) ) {
					$salida .= $data["cantTotCarAct"];
				}
				echo $salida;
			} catch (PDOException $e) {
				echo $e->getMessage();
			} finally {
				$dbConexion = null; $consult = null;
				unset($valid, $salida);
			}
			break;
		case 'cantTotCarDes':
			try {
				$inval = 0;
				$consult = $dbConexion -> prepare("SELECT COUNT(id_carrera) AS 'cantTotCarDes' FROM carreras WHERE estado_car = :inval");
				$consult -> bindParam("inval", $inval, PDO::PARAM_INT);
				$consult -> execute();
				$salida = "";
				while ( $data = $consult -> fetch(PDO::FETCH_ASSOC) ) {
					$salida .= $data["cantTotCarDes"];
				}
				echo $salida;
			} catch (PDOException $e) {
				echo $e->getMessage();
			} finally {
				$dbConexion = null; $consult = null;
				unset($inval, $salida);
			}
			break;
		case 'cantTotDoc':
			try {
				$consult = $dbConexion -> prepare("SELECT COUNT(id_docente) AS 'cantTotDoc' FROM docentes");
				$consult -> execute();
				$salida = "";
				while ( $data = $consult -> fetch(PDO::FETCH_ASSOC) ) {
					$salida .= $data["cantTotDoc"];
				}
				echo $salida;
			} catch (PDOException $e) {
				echo $e->getMessage();
			} finally {
				$dbConexion = null; $consult = null;
				unset($salida);
			}
			break;
		case 'cantTotDocAct':
			try {
				$valid = 1;
				$consult = $dbConexion -> prepare("SELECT COUNT(id_docente) AS 'cantTotDocAct' FROM docentes WHERE condicion_doc = :valid");
				$consult -> bindParam("valid", $valid, PDO::PARAM_INT);
				$consult -> execute();
				$salida = "";
				while ( $data = $consult -> fetch(PDO::FETCH_ASSOC) ) {
					$salida .= $data["cantTotDocAct"];
				}
				echo $salida;
			} catch (PDOException $e) {
				echo $e->getMessage();
			} finally {
				$dbConexion = null; $consult = null; 
				unset($valid, $salida);
			}
			break;
		case 'cantTotDocDes':
			try {
				$inval = 0;
				$consult = $dbConexion -> prepare("SELECT COUNT(id_docente) AS 'cantTotDocDes' FROM docentes WHERE condicion_doc = :inval");
				$consult -> bindParam("inval", $inval, PDO::PARAM_INT);
				$consult -> execute();
				$salida = "";
				while ( $data = $consult -> fetch(PDO::FETCH_ASSOC) ) {
					$salida .= $data["cantTotDocDes"];
				}
				echo $salida;
			} catch (PDOException $e) {
				echo $e->getMessage();
			} finally {
				$dbConexion = null; $consult = null;
				unset($inval, $salida);
			}
			break;	
		case 'cantTotDir':
			try {	
				$consult = $dbConexion -> prepare("SELECT COUNT(id_director) AS 'cantTotDir' FROM directores");
				$consult -> execute();
				$salida = "";
				while ( $data = $consult -> fetch(PDO::FETCH_ASSOC) ) {
					$salida .= $data["cantTotDir"];
				}
				echo $salida;
			} catch (PDOException $e) {
				echo $e->getMessage();
			} finally {
				$dbConexion = null; $consult = null;
				unset($salida);
			}
			break;
		case 'cantTotDirAct':
			try {
				$valid = 1;
				$consult = $dbConexion -> prepare("SELECT COUNT(id_director) AS 'cantTotDirAct' FROM directores WHERE estado_dir = :valid");
				$consult -> bindParam("valid", $valid, PDO::PARAM_INT);
				$consult -> execute();
				$salida = "";
				while ( $data = $consult -> fetch(PDO::FETCH_ASSOC) ) {
					$salida .= $data["cantTotDirAct"];
				}
				echo $salida;
			} catch (PDOException $e) {
				$e->getMessage();
			} finally {
				$dbConexion = null; $consult = null;
				unset($valid, $salida);
			}
			break;
		case 'cantTotDirDes':
			try {
				$inval = 0;
				$consult = $dbConexion -> prepare("SELECT COUNT(id_director) AS 'cantTotDirDes' FROM directores WHERE estado_dir = :inval");
				$consult -> bindParam("inval", $inval, PDO::PARAM_INT);
				$consult -> execute();
				$salida = "";
				while ( $data = $consult -> fetch(PDO::FETCH_ASSOC) ) {
					$salida .= $data["cantTotDirDes"];
				}
				echo $salida;
			} catch (PDOException $e) {
				echo $e->getMessage();
			} finally {
				$dbConexion = null; $consult = null;
				unset($inval, $salida);
			}
			break;
		case 'cantTotAlm':
			try {
				$inval = 0;
				$consult = $dbConexion -> prepare("SELECT COUNT(id_alumno) AS 'cantTotAlm' FROM alumnos");
				$consult -> execute();
				$salida = "";
				while ( $data = $consult -> fetch(PDO::FETCH_ASSOC) ) {
					$salida .= $data["cantTotAlm"];
				}
				echo $salida;
			} catch (PDOException $e) {
				echo $e->getMessage();
			} finally {
				$dbConexion = null; $consult = null;
				unset($inval, $salida);
			}
			break;
		case 'cantTotAlmAct':
			try {
			$valid = 1;
			$consult = $dbConexion -> prepare("SELECT COUNT(id_alumno) AS 'cantTotAlmAct' FROM alumnos WHERE estado_al = :valid && acept_grp = :valid");
			$consult -> bindParam("valid", $valid, PDO::PARAM_INT);
			$consult -> bindParam("valid", $valid, PDO::PARAM_INT);
			$consult -> execute();
			$salida = "";
			while ( $data = $consult -> fetch(PDO::FETCH_ASSOC) ) {
				$salida .= $data["cantTotAlmAct"];
			}
			echo $salida;
			} catch (PDOException $e) {
				echo $e->getMessage();
			} finally {
				$dbConexion = null; $consult = null;
				unset($valid, $salida);
			}
			break;
		case 'cantTotAlmDes':
			try {
				$valid = 1;
				$inval = 0;
				$consult = $dbConexion -> prepare("SELECT COUNT(id_alumno) AS 'cantTotAlmDes' FROM alumnos WHERE estado_al = :inval && acept_grp = :inval OR estado_al = :valid && acept_grp = :inval ");
				$consult -> bindParam("inval", $inval, PDO::PARAM_INT);
				$consult -> bindParam("inval", $inval, PDO::PARAM_INT);
				$consult -> bindParam("valid", $valid, PDO::PARAM_INT);
				$consult -> bindParam("inval", $inval, PDO::PARAM_INT);
				$consult -> execute();
				$salida = "";
				while ( $data = $consult -> fetch(PDO::FETCH_ASSOC) ) {
					$salida .= $data["cantTotAlmDes"];
				}
				echo $salida;
			} catch (PDOException $e) {
				echo $e->getMessage();
			} finally {
				$dbConexion = null; $consult = null;
				unset($valid, $inval, $salida);
			}
			break;	
		case 'cantTotCor':
			try {
				$consult = $dbConexion -> prepare("SELECT COUNT(id_coordinador) AS 'cantTotCor' FROM coordinadores;");
				$consult -> execute();
				$salida = "";
				while ( $data = $consult -> fetch(PDO::FETCH_ASSOC) ) {
					$salida .= $data["cantTotCor"];
				}
				echo $salida;
			} catch (PDOException $e) {
				echo $e->getMessage();
			} finally {
				$dbConexion = null; $consult = null;
				unset($salida);
			}
			break;
		case 'cantCorAct':
			try {
				$valid = 1;
				$consult = $dbConexion -> prepare("SELECT COUNT(id_coordinador) AS 'cantCorAct' FROM coordinadores WHERE estado_cor = :valid");
				$consult -> bindParam("valid", $valid, PDO::PARAM_INT);
				$consult -> execute();
				$salida = "";
				while ( $data = $consult -> fetch(PDO::FETCH_ASSOC) ) {
					$salida .= $data["cantCorAct"];
				}
				echo $salida;
			} catch (PDOException $e) {
				echo $e->getMessage();
			} finally {
				$dbConexion = null; $consult = null;
				unset($valid, $salida);
			}
			break;
		case 'cantCorDes':
			try {
				$valid = 1;
				$inval = 0;
				$consult = $dbConexion -> prepare("SELECT COUNT(id_coordinador) AS 'cantCorDes' FROM coordinadores WHERE estado_cor = :inval");
				$consult -> bindParam("inval", $inval, PDO::PARAM_INT);
				$consult -> execute();
				$salida = "";
				while ( $data = $consult -> fetch(PDO::FETCH_ASSOC) ) {
					$salida .= $data["cantCorDes"];
				}
				echo $salida;
			} catch (PDOException $e) {
				echo $e->getMessage();
			} finally {
				$dbConexion = null; $consult = null;
				unset($valid, $inval, $salida);
			}
			break;		
		case 'cantJusTot':
			try {
				$consult = $dbConexion -> prepare("SELECT COUNT(id_justificante) AS 'cantJusTot' FROM justificantes;");
				$consult -> execute();
				$salida = "";
				while ( $data = $consult -> fetch(PDO::FETCH_ASSOC) ) {
					$salida .= $data["cantJusTot"];
				}
				echo $salida;
			} catch (PDOException $e) {
				echo $e->getMessage();
			} finally {
				$dbConexion = null; $consult = null;
				unset($salida);
			}
			break;
		case 'cantJusAct':
			try {
				$valid = 1;
				$consult = $dbConexion -> prepare("SELECT COUNT(id_justificante) AS 'cantJusAct' FROM justificantes WHERE estado_justif = :valid");
				$consult -> bindParam("valid", $valid, PDO::PARAM_INT);
				$consult -> execute();
				$salida = "";
				while ( $data = $consult -> fetch(PDO::FETCH_ASSOC) ) {
					$salida .= $data["cantJusAct"];
				}
				echo $salida;
			} catch (PDOException $e) {
				echo $e->getMessage();
			} finally {
				$dbConexion = null; $consult = null;
				unset($valid, $salida);
			}
			break;
		case 'cantJusDes':
			try {
				$inval = 0;
				$consult = $dbConexion -> prepare("SELECT COUNT(id_justificante) AS 'cantJusDes' FROM justificantes WHERE estado_justif = :inval");
				$consult -> bindParam("inval", $inval, PDO::PARAM_INT);
				$consult -> execute();
				$salida = "";
				while ( $data = $consult -> fetch(PDO::FETCH_ASSOC) ) {
					$salida .= $data["cantJusDes"];
				}
				echo $salida;
			} catch (PDOException $e) {
				echo $e->getMessage();
			} finally {
				$dbConexion = null; $consult = null;
				unset($inval, $salida);
			}
			break;
		case 'cantTotBaj':
			try {
				$valid = 1;
				$consult = $dbConexion -> prepare("SELECT COUNT(baj.id_bajaalmdat) AS 'cantTotBaj' FROM bajasalm_dat baj WHERE baj.estado_baj_alm = :valid");
				$consult -> bindParam("valid", $valid, PDO::PARAM_INT);
				$consult -> execute();
				$salida = "";
				while ( $data = $consult -> fetch(PDO::FETCH_ASSOC) ) {
					$salida .= $data["cantTotBaj"];
				}
				echo $salida;
			} catch (PDOException $e) {
				echo $e->getMessage();
			} finally {
				$dbConexion = null; $consult = null;
				unset($valid, $salida);
			}
			break;
		case 'cantTotTest':
			try {
				$consult = $dbConexion -> prepare("SELECT COUNT(id_enctestalm) AS 'cantTotTest' FROM enctes_alm");
				$consult -> bindParam("valid", $valid, PDO::PARAM_INT);
				$consult -> execute();
				$salida = "";
				while ( $data = $consult -> fetch(PDO::FETCH_ASSOC) ) {
					$salida .= $data["cantTotTest"];
				}
				echo $salida;
			} catch (PDOException $e) {
				echo $e->getMessage();
			} finally {
				$dbConexion = null; $consult = null;
				unset($salida);
			}
			break;	
		case 'notifRep':
			$valid = 0; $tag = 'Administrador';
			$stmt = $dbConexion -> prepare("SELECT * FROM represult rs INNER JOIN reportsprob rp ON rp.id_report = rs.id_reportprob WHERE rp.estado_rep = :valid && rp.id_user = :keyAdm && rp.tag_user = :tag && rs.fecha_result = :fechAct");
			$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
			$stmt -> bindParam("keyAdm", $keyAdm, PDO::PARAM_INT);
			$stmt -> bindParam("tag", $tag, PDO::PARAM_STR);
			$stmt -> bindParam("fechAct", $fechAct, PDO::PARAM_STR);
			$stmt -> execute();
			$salida = "";
			$resstmt = $stmt -> rowCount();
			if ($resstmt > 0) {
				while ($data = $stmt -> fetch(PDO::FETCH_OBJ)) {
					$salida .= '<a class="dropdown-item d-flex align-items-center" href="'.SERVERURLADM.'MyReports/">
                    <div class="mr-3">
                      <div class="icon-circle bg-primary">
                        <i class="fas fa-check-circle text-white"></i>
                      </div>
                    </div>
                    <div>
                      <span class="font-weight-bold">
						'.$data->num_serie_rep.'
                      </span>
                      <div class="small text-gray-500">Reporte resuelto</div>
                    </div>
                  </a>';
				}
			} else {
				$salida .= "<h5 class='text-primary text-center mb-0 mt-3 font-weight-bold'> <i class='fas fa-thumbs-up mr-2 text-primary'></i> Sin novedad!... </h5>";
			}
			echo $salida;
			break;
		case 'cantNotif':
			$valid = 0; $tag = 'Administrador';
			$stmt = $dbConexion -> prepare("SELECT COUNT(rs.id_represult) AS 'Cantidad' FROM represult rs INNER JOIN reportsprob rp ON rp.id_report = rs.id_reportprob WHERE rp.estado_rep = :valid && rp.id_user = :keyAdm && rp.tag_user = :tag && rs.fecha_result = :fechAct");
			$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
			$stmt -> bindParam("keyAdm", $keyAdm, PDO::PARAM_INT);
			$stmt -> bindParam("tag", $tag, PDO::PARAM_STR);
			$stmt -> bindParam("fechAct", $fechAct, PDO::PARAM_STR);
			$stmt -> execute();
			$stmt -> execute();
			$salida = "";
			while ( $data = $stmt -> fetch(PDO::FETCH_ASSOC) ) {
				$salida .= $data["Cantidad"];
			}
			echo $salida;
			$dbConexion = null; $stmt = null;
			break;
	default:
		$dbConexion = null;
		break;
	}
}

ob_end_flush();

?>