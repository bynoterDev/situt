<?php 

session_start();

if ($_SESSION['keyDoc'] == "" || $_SESSION['keyDoc'] == null) {
	header("Location:../../Index.php");
} else {
	require_once '../../modelos/docente.modelo.php';
	$docente = new Docentes();
	include '../../modelos/rutas.php';
	include '../../modelos/rutasAmig.php';
	$urlFront = new Ruta();
	$urlFront = $urlFront -> ctrRutaFront();
	$keyDoc = $_SESSION['keyDoc'];
	// $alm = $_SESSION["clvAlm"];
	
	if (!empty($_SESSION['clvGrp'])) {
		$grp = $_SESSION["clvGrp"];
		$datGrp = $docente -> datGrpSel($keyDoc, $grp);
	}
	$fechAct = date("Y-m-d");
	$dbConexion = new Connect();
	$dbConexion = $dbConexion -> getDB();
	switch ($_GET['oper']) {
		case 'mostNotifCan':
			$consult = $dbConexion -> prepare("SELECT COUNT(just.id_justificante) AS 'CantJust' FROM justificantes just 
			INNER JOIN alumnos alm ON alm.id_alumno = just.id_alumno 
			INNER JOIN det_grupo det ON det.id_detgrupo = alm.id_detgrupo 
			INNER JOIN grupos grp ON grp.id_grupo = det.id_grupo
			INNER JOIN docentes doc ON doc.id_docente = det.id_docente
			WHERE just.estado_justif = 0 && doc.id_docente = :keyDoc && det.id_detgrupo = :grp && just.cuatrimestre_justif = grp.cuatrimestre_g && alm.acept_grp = 1");
			$consult -> bindParam("keyDoc", $keyDoc, PDO::PARAM_INT);
			$consult -> bindParam("grp", $grp, PDO::PARAM_INT);
			$consult -> execute();
			$salida = "";
			while ( $data = $consult -> fetch(PDO::FETCH_ASSOC) ) {
				$salida .= $data["CantJust"];
			}
			echo $salida;
			$dbConexion = null; $consult = null;
			break;
		case 'mostNotif':
			$consult = $dbConexion -> prepare("SELECT alm.nombre_c_al, alm.foto_perf_alm, alm.sexo_al, alm.id_alumno FROM justificantes just 
				INNER JOIN alumnos alm ON alm.id_alumno = just.id_alumno 
				INNER JOIN det_grupo det ON det.id_detgrupo = alm.id_detgrupo 
				INNER JOIN grupos grp ON grp.id_grupo = det.id_grupo
				INNER JOIN docentes doc ON doc.id_docente = det.id_docente 
				WHERE just.estado_justif = 0 && doc.id_docente = :keyDoc && det.id_detgrupo = :grp && just.cuatrimestre_justif = grp.cuatrimestre_g && alm.acept_grp = 1");
			$consult -> bindParam("keyDoc", $keyDoc, PDO::PARAM_INT);
			$consult -> bindParam("grp", $grp, PDO::PARAM_INT);
			$consult -> execute();
			$salida = "";
			$resConsult = $consult -> rowCount();
			if ($resConsult > 0) {
				while ($data = $consult->fetch(PDO::FETCH_OBJ)) {
					// if ($data->foto_perf_alm != "") {
					// 	$salida .= 
					// 		"<div class='row pad10'>
					// 			<div class='col-sm-3'>
					// 				<img src='".$urlFront."modAlm/Arch/perfil/".$data->foto_perf_alm."' class='img-fluid rounded' height='70' width='70'>
					// 			</div>
					// 			<div class='col-sm-8'>
					// 				<a href='".SERVERURLDOC."PerfAlm/".base64_encode($data->id_alumno)."/' class='dropdown-item text-primary' href='#'>".$data->nombre_c_al." <br> solicito un nuevo justificante </a>
					// 			</div>
					// 			<div class='col-sm-1'>
					// 				<span class='badge badge-info'>".$data->CantJust."</span>
					// 			</div>
					// 		</div>
					// 		<div class='dropdown-divider'></div>
					// 		"
					// 	;
					// } else {
					// 	if ($data->sexo_al == "Masculino") {
					// 		$salida .= 
					// 			"<div class='row pad10'>
					// 				<div class='col-sm-3'>
					// 					<img src='".$urlFront."vistas/img/usermal.png' class='img-fluid rounded' height='70' width='70'>
					// 				</div>
					// 				<div class='col-sm-8'>
					// 					<a href='".SERVERURLDOC."PerfAlm/".base64_encode($data->id_alumno)."/' class='dropdown-item text-primary' href='#'>".$data->nombre_c_al." <br> solicito un nuevo justificante </a>
					// 				</div>
					// 				<div class='col-sm-1'>
					// 					<span class='text-info'>".$data->CantJust."</span>
					// 				</div>
					// 			</div>
					// 			<div class='dropdown-divider'></div>
					// 			"
					// 		;
					// 	} else {
					// 		$salida .= 
					// 			"<div class='row pad10'>
					// 				<div class='col-sm-3'>
					// 					<img src='".$urlFront."vistas/img/userfem.png' class='img-fluid rounded' height='70' width='70'>
					// 				</div>
					// 				<div class='col-sm-8'>
					// 					<a href='".SERVERURLDOC."PerfAlm/".base64_encode($data->id_alumno)."/' class='dropdown-item lead text-primary' href='#'>".$data->nombre_c_al." <br> solicito un nuevo justificante </a>
					// 				</div>
					// 				<div class='col-sm-1'>
					// 					<span class='text-info'>".$data->CantJust."</span>
					// 				</div>
					// 			</div>
					// 			<div class='dropdown-divider'></div>
					// 			"
					// 		;
					// 	}
					// }
					$salida .= '<a class="dropdown-item d-flex align-items-center" href="'.SERVERURLDOC."PerfAlm/".base64_encode($data->id_alumno).'/">
	                    <div class="mr-3">
	                      <div class="icon-circle bg-primary">
	                        <i class="fas fa-file-alt text-white"></i>
	                      </div>
	                    </div>
	                    <div>
	                      <span class="font-weight-bold">
							'.$data->nombre_c_al.'
	                      </span>
	                      <div class="small text-gray-500">Solicito un nuevo justificante</div>
	                    </div>
	                  </a>';
				}
			} else {
				$salida .= "<h5 class='text-primary text-center mb-0 mt-3 font-weight-bold'>No hay nuevas solicitudes</h5>";
			}
			echo $salida;
			$dbConexion = null; $consult = null;
			break;
		case 'mostNotifCant':
			$valInval = 0;
			$consult = $dbConexion -> prepare("SELECT COUNT(just.id_justificante) AS 'CantJust' FROM justificantes just 
				INNER JOIN alumnos alm ON alm.id_alumno = just.id_alumno 
				INNER JOIN det_grupo det ON det.id_detgrupo = alm.id_detgrupo 
				INNER JOIN grupos grp ON grp.id_grupo = det.id_grupo
				INNER JOIN docentes doc ON doc.id_docente = det.id_docente 
				WHERE just.estado_justif = :valInval && doc.id_docente = :keyDoc && det.id_detgrupo = :grp && just.cuatrimestre_justif = grp.cuatrimestre_g && alm.acept_grp = 1");
			$consult -> bindParam("valInval", $valInval, PDO::PARAM_INT);
			$consult -> bindParam("keyDoc", $keyDoc, PDO::PARAM_INT);
			$consult -> bindParam("grp", $grp, PDO::PARAM_INT);
			$consult -> execute();
			$salida = "";
			while ($data = $consult -> fetch(PDO::FETCH_ASSOC)) {
				$salida .= $data["CantJust"];
			}
			echo $salida;
			$dbConexion = null; $consult = null;
			break;	
		case 'cantMale':
			$valValid = 1;
			$sexo = "Masculino";
			$stmt = $dbConexion -> prepare("SELECT COUNT(id_alumno) AS 'CantidadMale' FROM alumnos alm INNER JOIN det_grupo det ON det.id_detgrupo = alm.id_detgrupo INNER JOIN docentes doc ON doc.id_docente = det.id_docente WHERE det.id_detgrupo = :grp && doc.id_docente = :keyDoc && alm.sexo_al = :sexo && alm.acept_grp = :valValid && alm.estado_al = :valValid");
			$stmt -> bindParam("grp", $grp, PDO::PARAM_INT);
			$stmt -> bindParam("keyDoc", $keyDoc, PDO::PARAM_INT);
			$stmt -> bindParam("sexo", $sexo, PDO::PARAM_STR);
			$stmt -> bindParam("valValid", $valValid, PDO::PARAM_STR);
			$stmt -> bindParam("valValid", $valValid, PDO::PARAM_STR);
			$stmt -> execute();
			$salida = "";
			while ($data = $stmt -> fetch(PDO::FETCH_ASSOC)) {
				$salida .= $data["CantidadMale"];
			}
			echo $salida; 
			$stmt = null; $dbConexion = null;
			break;
			
			case 'cantFemale':
				$valValid = 1;
				$sexo = "Femenino";
				$stmt = $dbConexion -> prepare("SELECT COUNT(id_alumno) AS 'CantidadFemale' FROM alumnos alm INNER JOIN det_grupo det ON det.id_detgrupo = alm.id_detgrupo INNER JOIN docentes doc ON doc.id_docente = det.id_docente WHERE det.id_detgrupo = :grp && doc.id_docente = :keyDoc && alm.sexo_al = :sexo && alm.acept_grp = :valValid && alm.estado_al = :valValid");
				$stmt -> bindParam("grp", $grp, PDO::PARAM_INT);
				$stmt -> bindParam("keyDoc", $keyDoc, PDO::PARAM_INT);
				$stmt -> bindParam("sexo", $sexo, PDO::PARAM_STR);
				$stmt -> bindParam("valValid", $valValid, PDO::PARAM_STR);
				$stmt -> bindParam("valValid", $valValid, PDO::PARAM_STR);
				$stmt -> execute();
				$salida = "";
				while ($data = $stmt -> fetch(PDO::FETCH_ASSOC)) {
					$salida .= $data["CantidadFemale"];
				}
				echo $salida; 
				$stmt = null; $dbConexion = null;
				break;		
/* 		case 'cantFemale':
			$valValid = 1;
			$sexo = "Femenino";
			$stmt = $dbConexion -> prepare("SELECT COUNT(id_alumno) AS 'CantidadFemale' FROM alumnos alm INNER JOIN det_grupo det ON det.id_detgrupo = alm.id_detgrupo INNER JOIN docentes doc ON doc.id_docente = det.id_docente WHERE det.id_detgrupo = :grp && doc.id_docente = :keyDoc && alm.sexo_al = :sexo && alm.acept_grp = :valValid && alm.estado_al = :valValid");
			$stmt -> bindParam("grp", $grp, PDO::PARAM_INT);
			$stmt -> bindParam("keyDoc", $keyDoc, PDO::PARAM_INT);
			$stmt -> bindParam("sexo", $sexo, PDO::PARAM_INT);
			$stmt -> bindParam("valValid", $valValid, PDO::PARAM_STR);
			$stmt -> bindParam("valValid", $valValid, PDO::PARAM_STR);
			$stmt -> execute();
			$salida = "";
			while ($data = $stmt -> fetch(PDO::FETCH_ASSOC)) {
				
				$salida .= $data["CantidadFemale"];
			}
			echo $salida;
			$stmt = null; $dbConexion = null;
			
			break; */
		case 'cantAllAlm':
			$valValid = 1;
			$stmt = $dbConexion -> prepare("SELECT COUNT(id_alumno) AS 'cantAllAlm' FROM alumnos alm INNER JOIN det_grupo det ON det.id_detgrupo = alm.id_detgrupo INNER JOIN docentes doc ON doc.id_docente = det.id_docente WHERE det.id_detgrupo = :grp && doc.id_docente = :keyDoc && alm.acept_grp = :valValid && alm.estado_al = :valValid");
			$stmt -> bindParam("grp", $grp, PDO::PARAM_INT);
			$stmt -> bindParam("keyDoc", $keyDoc, PDO::PARAM_INT);
			$stmt -> bindParam("valValid", $valValid, PDO::PARAM_INT);
			$stmt -> bindParam("valValid", $valValid, PDO::PARAM_INT);
			$stmt -> execute();
			$salida = "";
			while ($data = $stmt -> fetch(PDO::FETCH_ASSOC)) {
				$salida .= $data["cantAllAlm"];
			}
			echo $salida;
			$stmt = null; $dbConexion = null;
			break;	
		case 'cantMaleBec':
			$valValid = 1;
			$sexo = "Masculino";
			$stmt = $dbConexion -> prepare("SELECT COUNT(bec.id_becadoalm) AS 'CantidadBecMale' FROM becados_alm bec INNER JOIN alumnos alm ON alm.id_alumno = bec.id_alumno INNER JOIN det_grupo det ON det.id_detgrupo = alm.id_detgrupo INNER JOIN docentes doc ON doc.id_docente = det.id_docente 
				WHERE det.id_detgrupo = :grp && doc.id_docente = :keyDoc && alm.sexo_al = :sexo && alm.becado_alm = :valValid && alm.estado_al = :valValid && alm.acept_grp = :valValid");
			$stmt -> bindParam("grp", $grp, PDO::PARAM_INT);
			$stmt -> bindParam("keyDoc", $keyDoc, PDO::PARAM_INT);
			$stmt -> bindParam("sexo", $sexo, PDO::PARAM_STR);
			$stmt -> bindParam("valValid", $valValid, PDO::PARAM_INT);
			$stmt -> bindParam("valValid", $valValid, PDO::PARAM_INT);
			$stmt -> bindParam("valValid", $valValid, PDO::PARAM_INT);
			$stmt -> execute();
			$salida = "";
			while ($data = $stmt -> fetch(PDO::FETCH_ASSOC) ) {
				$salida .= $data["CantidadBecMale"];
			}
			echo $salida;
			$stmt = null; $dbConexion = null;
			break;	
		case 'cantFemaleBec':
			$valValid = 1;
			$sexo = "Femenino";
			$stmt = $dbConexion -> prepare("SELECT COUNT(bec.id_becadoalm) AS 'CantidadBecFemale' FROM becados_alm bec INNER JOIN alumnos alm ON alm.id_alumno = bec.id_alumno INNER JOIN det_grupo det ON det.id_detgrupo = alm.id_detgrupo INNER JOIN docentes doc ON doc.id_docente = det.id_docente WHERE det.id_detgrupo = :grp && doc.id_docente = :keyDoc && alm.sexo_al = :sexo && alm.becado_alm = :valValid && alm.estado_al = :valValid && alm.acept_grp = :valValid");
			$stmt -> bindParam("grp", $grp, PDO::PARAM_INT);
			$stmt -> bindParam("keyDoc", $keyDoc, PDO::PARAM_INT);
			$stmt -> bindParam("sexo", $sexo, PDO::PARAM_STR);
			$stmt -> bindParam("valValid", $valValid, PDO::PARAM_INT);
			$stmt -> bindParam("valValid", $valValid, PDO::PARAM_INT);
			$stmt -> bindParam("valValid", $valValid, PDO::PARAM_INT);
			$stmt -> execute();
			$salida = "";
			while ($data = $stmt -> fetch(PDO::FETCH_ASSOC)) {
				$salida .= $data["CantidadBecFemale"];
			} 
			echo $salida;
			$stmt = null; $dbConexion = null;
			break;	
		case 'cantAllBec':
			$valValid = 1;
			$stmt = $dbConexion -> prepare("SELECT COUNT(bec.id_becadoalm) AS 'cantAllBec' FROM becados_alm bec INNER JOIN alumnos alm ON alm.id_alumno = bec.id_alumno INNER JOIN det_grupo det ON det.id_detgrupo = alm.id_detgrupo INNER JOIN docentes doc ON doc.id_docente = det.id_docente WHERE det.id_detgrupo = :grp && doc.id_docente = :keyDoc && alm.becado_alm = :valValid && alm.estado_al = :valValid && alm.acept_grp = :valValid");
			$stmt -> bindParam("grp", $grp, PDO::PARAM_INT);
			$stmt -> bindParam("keyDoc", $keyDoc, PDO::PARAM_INT);
			$stmt -> bindParam("valValid", $valValid, PDO::PARAM_INT);
			$stmt -> bindParam("valValid", $valValid, PDO::PARAM_INT);
			$stmt -> execute();
			$salida = "";
			while ($data = $stmt -> fetch(PDO::FETCH_ASSOC)) {
				$salida .= $data["cantAllBec"];
			} 
			echo $salida;
			$stmt = null; $dbConexion = null;
			break;	
		case 'cantAlmRech':
			$valInval = 0;
			$valid = 1;
			$stmt = $dbConexion -> prepare("SELECT COUNT(alm.id_alumno) AS 'CantAlmRech' FROM alumnos alm 
				INNER JOIN det_grupo det ON det.id_detgrupo = alm.id_detgrupo
				INNER JOIN docentes doc ON doc.id_docente = det.id_docente
				WHERE det.id_detgrupo = :grp && doc.id_docente = :keyDoc && alm.acept_grp = :valInval && alm.estado_al = :valid");
			$stmt -> bindParam("grp", $grp, PDO::PARAM_INT);
			$stmt -> bindParam("keyDoc", $keyDoc, PDO::PARAM_INT);
			$stmt -> bindParam("valInval", $valInval, PDO::PARAM_INT);
			$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
			$stmt -> execute();
			$salida = "";
			while ($data = $stmt -> fetch(PDO::FETCH_ASSOC)) {
				$salida .= $data["CantAlmRech"];
			}
			echo $salida;
			$stmt = null; $dbConexion = null;
			break;
		case 'cargarNotifTut':
			$inval = 0;
			$stmt = $dbConexion -> prepare("SELECT * FROM tut_personales tut 
				INNER JOIN alumnos alm ON alm.id_alumno = tut.id_alumno
				INNER JOIN det_grupo det ON det.id_detgrupo = alm.id_detgrupo
				INNER JOIN grupos grp ON grp.id_grupo = det.id_grupo
				INNER JOIN docentes doc ON doc.id_docente = det.id_docente
				WHERE doc.id_docente = :keyDoc && det.id_detgrupo = :grp && tut.estado_tut = :inval && alm.acept_grp = 1 && grp.cuatrimestre_g = tut.cuatrimestre_tut");
			$stmt -> bindParam("keyDoc", $keyDoc, PDO::PARAM_INT);
			$stmt -> bindParam("grp", $grp, PDO::PARAM_INT);
			$stmt -> bindParam("inval", $inval, PDO::PARAM_INT);
			$stmt -> execute();
			$salida = "";
			$resstmt = $stmt -> rowCount();
			if ($resstmt > 0) {
				while ($data = $stmt -> fetch(PDO::FETCH_OBJ)) {
					// if ($data->foto_perf_alm != "") {
					// 	$salida .= 
					// 		"<div class='row pad10'>
					// 			<div class='col-sm-3'>
					// 				<img src='".$urlFront."modAlm/Arch/perfil/".$data->foto_perf_alm."' class='img-fluid rounded' height='70' width='70'>
					// 			</div>
					// 			<div class='col-sm-8'>
					// 				<a href='PerfAlm.php?v=".base64_encode($data->id_alumno)."' class='dropdown-item lead text-primary' href='#'>".$data->nombre_c_al." <br> solicito una tutoría personal </a>
					// 			</div>
					// 		</div>
					// 		<div class='dropdown-divider'></div>
					// 		"
					// 	;
					// } else {
					// 	if ($data->sexo_al == "Masculino") {
					// 		$salida .= 
					// 			"<div class='row pad10'>
					// 				<div class='col-sm-3'>
					// 					<img src='".$urlFront."vistas/img/usermal.png' class='img-fluid rounded' height='70' width='70'>
					// 				</div>
					// 				<div class='col-sm-8'>
					// 					<a href='PerfAlm.php?v=".base64_encode($data->id_alumno)."' class='dropdown-item lead text-primary' href='#'>".$data->nombre_c_al." <br> solicito una tutoría personal </a>
					// 				</div>
					// 			</div>
					// 			<div class='dropdown-divider'></div>
					// 			"
					// 		;
					// 	} else {
					// 		$salida .= 
					// 			"<div class='row pad10'>
					// 				<div class='col-sm-3'>
					// 					<img src='".$urlFront."vistas/img/userfem.png' class='img-fluid rounded' height='70' width='70'>
					// 				</div>
					// 				<div class='col-sm-8'>
					// 					<a href='PerfAlm.php?v=".base64_encode($data->id_alumno)."' class='dropdown-item lead text-primary' href='#'>".$data->nombre_c_al." <br> solicito una tutoría personal </a>
					// 				</div>
					// 			</div>
					// 			<div class='dropdown-divider'></div>
					// 			"
					// 		;
					// 	}
					// }
					$salida .= '<a class="dropdown-item d-flex align-items-center" href="'.SERVERURLDOC."PerfAlm/".base64_encode($data->id_alumno).'/">
                    <div class="mr-3">
                      <div class="icon-circle bg-primary">
                        <i class="fas fa-chalkboard-teacher text-white"></i>
                      </div>
                    </div>
                    <div>
                      <span class="font-weight-bold">
						'.$data->nombre_c_al.'
                      </span>
                      <div class="small text-gray-500">Solicito una tutoria personal</div>
                    </div>
                  </a>';
				}
			} else {
				$salida .= "<h5 class='text-primary text-center mb-0 mt-3 font-weight-bold'>No hay nuevas solicitudes</h5>";
			}
			echo $salida;
			break;
		case 'cantNotifTut':
			$inval = 0;
			$stmt = $dbConexion -> prepare("SELECT COUNT(tut.id_tutpersonales) AS 'CantTut' FROM tut_personales tut 
				INNER JOIN alumnos alm ON alm.id_alumno = tut.id_alumno
				INNER JOIN det_grupo det ON det.id_detgrupo = alm.id_detgrupo
				INNER JOIN grupos grp ON grp.id_grupo = det.id_grupo
				INNER JOIN docentes doc ON doc.id_docente = det.id_docente
				WHERE doc.id_docente = :keyDoc && det.id_detgrupo = :grp && tut.estado_tut = :inval && alm.acept_grp = 1 && grp.cuatrimestre_g = tut.cuatrimestre_tut");
			$stmt -> bindParam("keyDoc", $keyDoc, PDO::PARAM_INT);
			$stmt -> bindParam("grp", $grp, PDO::PARAM_INT);
			$stmt -> bindParam("inval", $inval, PDO::PARAM_INT);
			$stmt -> execute();
			$salida = "";
			while ($data = $stmt -> fetch(PDO::FETCH_ASSOC)) {
				$salida = $data["CantTut"];
			}
			echo $salida;
			break;		
		case 'notifRep':
			$valid = 0; $tag = 'Docente';
			$stmt = $dbConexion -> prepare("SELECT * FROM represult rs INNER JOIN reportsprob rp ON rp.id_report = rs.id_reportprob WHERE rp.estado_rep = :valid && rp.id_user = :keyDoc && rp.tag_user = :tag && rs.fecha_result = :fechAct");
			$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
			$stmt -> bindParam("keyDoc", $keyDoc, PDO::PARAM_INT);
			$stmt -> bindParam("tag", $tag, PDO::PARAM_STR);
			$stmt -> bindParam("fechAct", $fechAct, PDO::PARAM_STR);
			$stmt -> execute();
			$salida = "";
			$resstmt = $stmt -> rowCount();
			if ($resstmt > 0) {
				while ($data = $stmt -> fetch(PDO::FETCH_OBJ)) {
					$salida .= '<a class="dropdown-item d-flex align-items-center" href="'.SERVERURLDOC.'MyReports/">
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
			$valid = 0; $tag = 'Docente';
			$stmt = $dbConexion -> prepare("SELECT COUNT(rs.id_represult) AS 'Cantidad' FROM represult rs INNER JOIN reportsprob rp ON rp.id_report = rs.id_reportprob WHERE rp.estado_rep = :valid && rp.id_user = :keyDoc && rp.tag_user = :tag && rs.fecha_result = :fechAct");
			$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
			$stmt -> bindParam("keyDoc", $keyDoc, PDO::PARAM_INT);
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