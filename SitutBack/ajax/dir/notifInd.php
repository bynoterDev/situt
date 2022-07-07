<?php 

ob_start();
session_start();

if ($_SESSION['keyDir'] == "" || $_SESSION['keyDir'] == null) {
	header("Location:../../Index.php");
} else {
	require_once '../../modelos/director.modelo.php';
	include '../../modelos/rutasAmig.php';
	$director = new Director();
	$keyDir = $_SESSION['keyDir'];
	$fechAct = date("Y-m-d");
	$dbConexion = new Connect();
	$dbConexion = $dbConexion -> getDB();
	switch ($_GET['oper']) {
		case 'cantAlmCar':
			$clvCar = $director -> userDirDet($keyDir);
			$idCar = $clvCar->id_carrera;
			$consult = $dbConexion -> prepare("SELECT COUNT(id_alumno) AS 'cantAlmCar' FROM alumnos alm
				INNER JOIN det_grupo det ON det.id_detgrupo = alm.id_detgrupo
				INNER JOIN carreras car ON car.id_carrera = det.id_carrera
				WHERE car.id_carrera = :id_car");
			$consult -> bindParam("id_car", $idCar, PDO::PARAM_INT);
			$consult -> execute();
			$salida = "";
			while ( $data = $consult -> fetch(PDO::FETCH_ASSOC) ) {
				$salida .= $data["cantAlmCar"];
			}
			echo $salida;
			$dbConexion = null; $consult = null;
			break;
		case 'cantGrpCar':
			$clvCar = $director -> userDirDet($keyDir);
			$idCar = $clvCar->id_carrera;
			$consult = $dbConexion -> prepare("SELECT COUNT(id_detgrupo) AS 'cantGrpCar' FROM det_grupo det
				INNER JOIN carreras car ON car.id_carrera = det.id_carrera
				WHERE car.id_carrera = :id_car");
			$consult -> bindParam("id_car", $idCar, PDO::PARAM_INT);
			$consult -> execute();
			$salida = "";
			while ( $data = $consult -> fetch(PDO::FETCH_ASSOC) ) {
				$salida .= $data["cantGrpCar"];
			}
			echo $salida;
			$dbConexion = null; $consult = null;
			break;	
		case 'notifRep':
			$valid = 0; $tag = 'Director';
			$stmt = $dbConexion -> prepare("SELECT * FROM represult rs INNER JOIN reportsprob rp ON rp.id_report = rs.id_reportprob WHERE rp.estado_rep = :valid && rp.id_user = :keyDir && rp.tag_user = :tag && rs.fecha_result = :fechAct");
			$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
			$stmt -> bindParam("keyDir", $keyDir, PDO::PARAM_INT);
			$stmt -> bindParam("tag", $tag, PDO::PARAM_STR);
			$stmt -> bindParam("fechAct", $fechAct, PDO::PARAM_STR);
			$stmt -> execute();
			$salida = "";
			$resstmt = $stmt -> rowCount();
			if ($resstmt > 0) {
				while ($data = $stmt -> fetch(PDO::FETCH_OBJ)) {
					$salida .= '<a class="dropdown-item d-flex align-items-center" href="'.SERVERURLDIR.'MyReports/">
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
			$valid = 0; $tag = 'Director';
			$stmt = $dbConexion -> prepare("SELECT COUNT(rs.id_represult) AS 'Cantidad' FROM represult rs INNER JOIN reportsprob rp ON rp.id_report = rs.id_reportprob WHERE rp.estado_rep = :valid && rp.id_user = :keyDir && rp.tag_user = :tag && rs.fecha_result = :fechAct");
			$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
			$stmt -> bindParam("keyDir", $keyDir, PDO::PARAM_INT);
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