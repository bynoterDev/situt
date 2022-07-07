<?php 

session_start();

if ($_SESSION['keyCor'] == "" || $_SESSION['keyCor'] == null) {
	header("Location:../../Index.php");
} else {
	require_once '../../modelos/coordinador.modelo.php';
	include '../../modelos/rutasAmig.php';
	$coordinador = new Coordinador();
	$keyCor = $_SESSION['keyCor'];
	$fechAct = date("Y-m-d");
	if (!empty($_SESSION['clvCar'])) {
		$clvCar = base64_decode($_SESSION['clvCar']);
	} 
	$dbConexion = new Connect();
	$dbConexion = $dbConexion -> getDB();
	switch ($_GET['oper']) {
		case 'listGrpCar':
			try {
				$valid = 1;
				$stmt = $dbConexion -> prepare("SELECT grp.id_grupo, COUNT(alm.id_alumno) AS 'CantAlm', grp.grupo_n, car.id_carrera FROM alumnos alm 
					INNER JOIN det_grupo det ON det.id_detgrupo = alm.id_detgrupo
					INNER JOIN carreras car ON car.id_carrera = det.id_carrera
					INNER JOIN grupos grp ON grp.id_grupo = det.id_grupo
					WHERE car.id_carrera = :clvCar && alm.estado_al = :valid && alm.acept_grp = :valid GROUP BY grp.grupo_n ORDER BY grp.grupo_n DESC");
				$stmt -> bindParam("clvCar", $clvCar, PDO::PARAM_INT);
				$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
				$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
				$stmt -> execute();
				$data = Array();
				while ($res = $stmt -> fetch(PDO::FETCH_OBJ)) {
					$data[] = array(
						"0" => '<span class="font-weight-bold text-dark">'.$res -> grupo_n.'</span>',
						"1" => '<span class="font-weight-bold text-dark">'.$res -> CantAlm.'</span>',
						"2" => '<a href="'.SERVERURLCOR.'DetGrp/'.base64_encode($res->id_grupo).'/'.base64_encode($res->id_carrera).'/" class="btn btn-outline-primary btn-sm text-center"> <i class="fas fa-plus-circle mr-2 ml-1"></i>Detalles </a>'
					);
				}
				$results = array(
	        		"sEcho"=>1,
	        		"iTotalRecords"=>count($data),
	        		"iTotalDisplayRecords"=>count($data),
	        		"aaData"=>$data);
	        	echo json_encode($results);
			} catch (PDOException $e) {
				echo $e->getMessage();
			} finally {
				$stmt = null; $dbConexion = null;
				unset($valid, $data, $results);
			}
			break;		
		case 'listAlmGrpCar':
			try {
				$clvGrp = base64_decode($_SESSION['clvGrp']);
				$valid = 1;
				$stmt = $dbConexion -> prepare("SELECT * FROM alumnos alm 
					INNER JOIN det_grupo det ON det.id_detgrupo = alm.id_detgrupo
					INNER JOIN grupos grp ON grp.id_grupo = det.id_grupo
					INNER JOIN carreras car ON car.id_carrera = det.id_carrera
					INNER JOIN docentes doc ON doc.id_docente = det.id_docente
					WHERE grp.id_grupo = :clvGrp && car.id_carrera = :clvCar && alm.estado_al = :valid && alm.acept_grp = :valid ORDER BY alm.nombre_c_al DESC");
				$stmt -> bindParam("clvGrp", $clvGrp, PDO::PARAM_INT);
				$stmt -> bindParam("clvCar", $clvCar, PDO::PARAM_INT);
				$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
				$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
				$stmt -> execute();
				$data = Array();
				while ($res = $stmt -> fetch(PDO::FETCH_OBJ)) {
					$data[] = array(
						"0" => $res -> nombre_c_al,
						"1" => $res -> matricula_al,
						"2" => $res -> correo_al,
						"3" => '<a href="'.SERVERURLCOR.'DetPerfAlm/'.base64_encode($res->id_alumno).'/'.base64_encode($res->id_carrera).'/'.base64_encode($res->id_grupo).'/" class="btn btn-outline-primary btn-sm"> <i class="fas fa-eye mr-2"></i>Perfil </a>'
					);
				}
				$results = array(
	        		"sEcho"=>1,
	        		"iTotalRecords"=>count($data),
	        		"iTotalDisplayRecords"=>count($data),
	        		"aaData"=>$data);
	        	echo json_encode($results);
	        	$stmt = null;
	        	$dbConexion = null;
			} catch (PDOException $e) {
				echo $e->getMessage();
			} finally {
				$dbConexion = null; $stmt = null;
				unset($valid, $data, $results);
			}
			break;
		case 'notifRep':
			$valid = 0; $tag = 'Coordinador';
			$stmt = $dbConexion -> prepare("SELECT * FROM represult rs INNER JOIN reportsprob rp ON rp.id_report = rs.id_reportprob WHERE rp.estado_rep = :valid && rp.id_user = :keyCor && rp.tag_user = :tag && rs.fecha_result = :fechAct");
			$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
			$stmt -> bindParam("keyCor", $keyCor, PDO::PARAM_INT);
			$stmt -> bindParam("tag", $tag, PDO::PARAM_STR);
			$stmt -> bindParam("fechAct", $fechAct, PDO::PARAM_STR);
			$stmt -> execute();
			$salida = "";
			$resstmt = $stmt -> rowCount();
			if ($resstmt > 0) {
				while ($data = $stmt -> fetch(PDO::FETCH_OBJ)) {
					$salida .= '<a class="dropdown-item d-flex align-items-center" href="'.SERVERURLCOR.'MyReports/">
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
			$valid = 0; $tag = 'Coordinador';
			$stmt = $dbConexion -> prepare("SELECT COUNT(rs.id_represult) AS 'Cantidad' FROM represult rs INNER JOIN reportsprob rp ON rp.id_report = rs.id_reportprob WHERE rp.estado_rep = :valid && rp.id_user = :keyCor && rp.tag_user = :tag && rs.fecha_result = :fechAct");
			$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
			$stmt -> bindParam("keyCor", $keyCor, PDO::PARAM_INT);
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