<?php

session_start();

if ($_SESSION['keyDir'] == "" || $_SESSION['keyDir'] == null) {
	header("Location:../../Index.php");
} else {
	include '../../modelos/rutasAmig.php';
	require_once '../../modelos/director.modelo.php';
	function formatFech($fechForm) {
	    $fechDat = substr($fechForm, 0,4);
	    $fechM = substr($fechForm, 5,2);
	    $fechD = substr($fechForm, 8,2);
	    $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
	    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
	    $Fecha = date($fechD)." de ".$meses[date($fechM)-1]. " del ".date($fechDat);
	    return $Fecha;
	}
	$director = new Director();
	$keyDir = $_SESSION['keyDir'];
	$datDirec = $director->userDirDet($_SESSION['keyDir']);
	$id_car = $datDirec->id_carrera;
	$fechAct = date("Y-m-d");
	$dbConexion = new Connect();
	$dbConexion = $dbConexion -> getDB();
	switch ($_GET['oper']) {
		case 'listAlmInact':
			$inval = 0;
			$valid = 1;
			$stmt = $dbConexion -> prepare("SELECT alm.id_alumno, grp.grupo_n, alm.nombre_c_al, 
				doc.nombre_c_doc FROM alumnos alm 
				INNER JOIN det_grupo det ON det.id_detgrupo = alm.id_detgrupo
				INNER JOIN carreras car ON det.id_carrera = car.id_carrera
				INNER JOIN grupos grp ON grp.id_grupo = det.id_grupo
				INNER JOIN docentes doc ON doc.id_docente = det.id_docente
				WHERE NOT id_alumno In (SELECT id_alumno FROM bajasalm_dat dat 
					WHERE dat.id_alumno = alm.id_alumno && dat.estado_baj_alm = :valid) &&
				car.id_carrera = :id_car && alm.estado_al = :inval");
			$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
			$stmt -> bindParam("id_car", $id_car, PDO::PARAM_INT);
			$stmt -> bindParam("inval", $inval, PDO::PARAM_INT);
			$stmt -> execute();
			$data = Array();
			while ($res = $stmt -> fetch(PDO::FETCH_OBJ)) {
				$data[] = array(
					"0" => $res -> nombre_c_al,
					"1" => $res -> grupo_n,
					"2" => $res -> nombre_c_doc,
					"3" => '<a href="'.SERVERURLDIR.'PerfAlm/'.base64_encode($res->id_alumno).'/" class="btn btn-outline-primary btn-sm"><i class="fas fa-eye mr-2"></i>Perfil</a>'
				);
			}
			$results = array(
        		"sEcho"=>1,
        		"iTotalRecords"=>count($data),
        		"iTotalDisplayRecords"=>count($data),
        		"aaData"=>$data);
        	echo json_encode($results);
        	$stmt = null; $dbConexion = null;
			break;
		case 'activarAlm':
			$id_alumno = isset($_POST['id_alumno']) ? limpiarDatos($_POST['id_alumno']) : "";
			$valid = 1;
			$stmt = $dbConexion -> prepare("UPDATE alumnos alm INNER JOIN det_grupo det ON det.id_detgrupo = alm.id_detgrupo INNER JOIN carreras car ON car.id_carrera = det.id_carrera SET alm.estado_al = :valid
				WHERE alm.id_alumno = :id_alumno && car.id_carrera = :id_car");
			$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
			$stmt -> bindParam("id_alumno", $id_alumno, PDO::PARAM_INT);
			$stmt -> bindParam("id_car", $id_car, PDO::PARAM_INT);
			$resstmt = $stmt -> execute();
			if ($resstmt) {
				echo "Cuenta activada";
			} else {
				echo "Fallo la activación";
			}
			$stmt = null; $dbConexion = null; $resstmt = null;
			break;	
		case 'desactivarAlm':
			$id_alumno = isset($_POST['id_alumno']) ? limpiarDatos($_POST['id_alumno']) : "";
			$inval = 0;
			$stmt = $dbConexion -> prepare("UPDATE alumnos alm INNER JOIN det_grupo det ON det.id_detgrupo = alm.id_detgrupo INNER JOIN carreras car ON car.id_carrera = det.id_carrera SET alm.estado_al = :inval
				WHERE alm.id_alumno = :id_alumno && car.id_carrera = :id_car");
			$stmt -> bindParam("inval", $inval, PDO::PARAM_INT);
			$stmt -> bindParam("id_alumno", $id_alumno, PDO::PARAM_INT);
			$stmt -> bindParam("id_car", $id_car, PDO::PARAM_INT);
			$resstmt = $stmt -> execute();
			if ($resstmt) {
				echo "Cuenta desactivada";
			} else {
				echo "Fallo la desactivación";
			}
			$stmt = null; $dbConexion = null; $resstmt = null;
			break;	
		case 'listarAlmBaj':
			$valid = 1;
			$stmt = $dbConexion -> prepare("SELECT baj.id_bajaalmdat, alm.id_alumno, doc.nombre_c_doc, grp.grupo_n, alm.nombre_c_al, baj.fecha_reg_baj FROM bajasalm_dat baj 
				INNER JOIN alumnos alm ON alm.id_alumno = baj.id_alumno
				INNER JOIN det_grupo det ON det.id_detgrupo = alm.id_detgrupo
				INNER JOIN docentes doc ON doc.id_docente = det.id_docente
				INNER JOIN grupos grp ON grp.id_grupo = det.id_grupo
				INNER JOIN carreras car ON car.id_carrera = det.id_carrera
				WHERE car.id_carrera = :id_car && baj.estado_baj_alm = :valid");
			$stmt -> bindParam("id_car", $id_car, PDO::PARAM_INT);
			$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
			$stmt -> execute();
			$data = Array();
			while ($res = $stmt -> fetch(PDO::FETCH_OBJ)) {
				$data[] = array(
					"0" => $res -> nombre_c_al,
					"1" => $res -> grupo_n,
					"2" => $res -> nombre_c_doc,
					"3" => formatFech($res->fecha_reg_baj),
					"4" => '<a target="_blank" href="'.SERVERURLDIR.'dir/DocBajAlm.php?v='.base64_encode($res->id_alumno).'&&p='.base64_encode($res->id_bajaalmdat).'" class="btn btn-outline-primary btn-sm"><i class="fas fa-print mr-2"></i>Documento</a>'.' <a href="'.SERVERURLDIR.'PerfAlm/'.base64_encode($res->id_alumno).'/" class="btn btn-outline-primary btn-sm"><i class="fas fa-eye mr-2"></i>Perfil</a>'
				);
			}
			$results = array(
        		"sEcho"=>1,
        		"iTotalRecords"=>count($data),
        		"iTotalDisplayRecords"=>count($data),
        		"aaData"=>$data);
        	echo json_encode($results);
        	$stmt = null; $dbConexion = null;
			break;	

		case 'listAlmGraduate':
			$valid = 1;
			$stmt = $dbConexion -> prepare("SELECT * FROM alumnos alm
				INNER JOIN det_grupo det ON det.id_detgrupo = alm.id_detgrupo
				INNER JOIN carreras car ON car.id_carrera = det.id_carrera 
				INNER JOIN grupos grp ON grp.id_grupo = det.id_grupo 
				WHERE grp.grupo_n > 1000 && car.id_carrera = :id_car ORDER BY alm.fin_car ASC");
			$stmt -> bindParam("id_car", $id_car, PDO::PARAM_INT);
			$stmt -> execute();
			$data = Array();
			while ($res = $stmt -> fetch(PDO::FETCH_OBJ)) {
				$data[] = array(
					"0" => $res -> nombre_c_al,
					"1" => $res -> correo_al,
					"2" => $res -> grupo_n,
					"3" => ($res->fin_car)?'<button type="button" class="mr-2 btn btn-sm btn-primary"> <i class="fas fa-check mr-2"></i> Confirmado</span> </button>'.'<a href="'.SERVERURLDIR.'PerfAlm/'.base64_encode($res->id_alumno).'/" class="btn btn-outline-primary btn-sm"><i class="fas fa-eye mr-2"></i>Perfil</a>' :'<button class="btn btn-outline-danger btn-sm mr-2" type="button" onclick="desactAlm('.$res->id_alumno.')">
		            		<i class="fas fa-times mr-2"></i>
		            		<b>Confirmar</b>
		            	</button>' .'<a href="'.SERVERURLDIR.'PerfAlm/'.base64_encode($res->id_alumno).'/" class="btn btn-outline-primary btn-sm"><i class="fas fa-eye mr-2"></i>Perfil</a>'
		            );
			}
			$results = array(
        		"sEcho"=>1,
        		"iTotalRecords"=>count($data),
        		"iTotalDisplayRecords"=>count($data),
        		"aaData"=>$data);
        	echo json_encode($results);
        	$stmt = null; $dbConexion = null;
			break;

		case 'desactAlm':

			$valid = 1;
			$inval = 0;
			$idalumno = isset($_POST['idalumno']) ? limpiarDatos($_POST['idalumno']) : "";
			$stmt = $dbConexion -> prepare("UPDATE alumnos SET estado_al = :inval, acept_grp = :inval, fin_car = :valid, becado_alm = :inval WHERE id_alumno = :idalumno");
			$stmt -> bindParam("inval", $inval, PDO::PARAM_INT);
			$stmt -> bindParam("inval", $inval, PDO::PARAM_INT);
			$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
			$stmt -> bindParam("inval", $inval, PDO::PARAM_INT);
			$stmt -> bindParam("idalumno", $idalumno, PDO::PARAM_INT);
			$resstmt = $stmt -> execute();
			if ($resstmt) {
				echo 1;
			} else {
				echo 2;
			}
			$stmt = null; $dbConexion = null;

			break;

		default:
			$dbConexion = null;
			break;
	}
}
