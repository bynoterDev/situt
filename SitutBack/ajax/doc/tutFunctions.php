<?php

ob_start(); session_start();

if ($_SESSION['keyDoc'] == "" || $_SESSION['keyDoc'] == "") {
	header("Location:../../Index.php");
} else {
	require_once '../../modelos/docente.modelo.php';
	include '../../modelos/rutas.php';
	include '../../modelos/rutasAmig.php';
	$docente = new Docentes();
	$keyDoc = $_SESSION['keyDoc'];
	$id_carrera = $_SESSION['id_carrera']; /*Se agreo esta linea de codigo y mas adelante tambien*/

	$grp = $_SESSION["clvGrp"];
	$fechAct = date("Y-m-d");
	$urlFront = new Ruta();
	$urlFront = $urlFront -> ctrRutaFront();
	$dbConexion = new Connect();
	$dbConexion = $dbConexion -> getDB();

	switch ($_GET['oper']) {
		case 'regAlmGrp':
			$nomAl = isset($_POST['nomAl']) ? limpiarDatos($_POST['nomAl']) : "";
			$corAl = isset($_POST['corAl']) ? limpiarDatos($_POST['corAl']) : "";
			$contAl = isset($_POST['contAl']) ? limpiarDatos($_POST['contAl']) : "";
			$matAl = isset($_POST['matAl']) ? limpiarDatos($_POST['matAl']) : "";
			$telAl = isset($_POST['telAl']) ? limpiarDatos($_POST['telAl']) : "";
			$sexAl = isset($_POST['sexAl']) ? limpiarDatos($_POST['sexAl']) : "";
			$estAl = isset($_POST['estAl']) ? limpiarDatos($_POST['estAl']) : "";
			$aceptGrp = isset($_POST['aceptGrp']) ? limpiarDatos($_POST['aceptGrp']) : "";
			$idgrp = isset($_POST['idgrp']) ? limpiarDatos($_POST['idgrp']) : "";
			$nomAlM = ucwords($nomAl); $matAlM = strtoupper($matAl);
			$passEnc = sha1($contAl);
			$valid = $dbConexion -> prepare("SELECT nombre_c_al FROM alumnos WHERE nombre_c_al = :nomAlM");
			$valid -> bindParam("nomAlM", $nomAlM, PDO::PARAM_STR);
			$valid -> execute();
			$resvalid = $valid -> rowCount();
			if ($resvalid === 0) {
				$valid2 = $dbConexion -> prepare("SELECT correo_al FROM alumnos WHERE correo_al = :corAl");
				$valid2 -> bindParam("corAl", $corAl, PDO::PARAM_STR);
				$valid2 -> execute();
				$resvalid2 = $valid2 -> rowCount();
				if ($resvalid2 === 0) {
					$valid3 = $dbConexion -> prepare("SELECT matricula_al FROM alumnos WHERE matricula_al = :matAlM");
					$valid3 -> bindParam("matAlM", $matAlM, PDO::PARAM_STR);
					$valid3 -> execute();
					$resvalid3 = $valid3 -> rowCount();
					if ($resvalid3 === 0) {
						$stmt = $dbConexion -> prepare("INSERT INTO alumnos (nombre_c_al, correo_al, contrasena_al, contdesc_al, matricula_al, telefono_al, sexo_al, estado_al, acept_grp, fecha_reg, id_detgrupo, becado_alm, id_carrera) VALUES (:nomAlM, :corAl, :passEnc, :contAl, :matAlM, :telAl, :sexAl, :estAl, :aceptGrp, :fechAct, :idgrp, null, :id_carrera)");
						/*Seleccionar el insert y pegarlo en el otro script*/
						$stmt -> bindParam(":nomAlM", $nomAlM, PDO::PARAM_STR);
						$stmt -> bindParam(":corAl", $corAl, PDO::PARAM_STR);
						$stmt -> bindParam(":passEnc", $passEnc, PDO::PARAM_STR);
						$stmt -> bindParam(":contAl", $contAl, PDO::PARAM_STR);
						$stmt -> bindParam(":matAlM", $matAlM, PDO::PARAM_STR);
						$stmt -> bindParam(":telAl", $telAl, PDO::PARAM_STR);
						$stmt -> bindParam(":sexAl", $sexAl, PDO::PARAM_STR);
						$stmt -> bindParam(":estAl", $estAl, PDO::PARAM_INT);
						$stmt -> bindParam(":aceptGrp", $aceptGrp, PDO::PARAM_INT);
						$stmt -> bindParam(":fechAct", $fechAct, PDO::PARAM_STR);
						$stmt -> bindParam(":idgrp", $idgrp, PDO::PARAM_INT);
						$stmt -> bindParam(":id_carrera", $id_carrera, PDO::PARAM_INT);//Añadir est linea de codigo eso es todo
						$stmt -> execute(); $resstmt = $stmt -> rowCount();
						if ($resstmt === 1) {
							echo "goodIns";
						} else {
							echo "failIns";
						}
					} else {
						echo "matExt";
					}
				} else {
					echo "corExt";
				}
			} else {
				echo "nomExt";
			}
			$valid = null; $resvalid = null; $valid2 = null; $resvalid2 = null; $valid3 = null;  
			$resvalid3 = null; $stmt = null; $resstmt = null; $dbConexion = null;
			break;
		case 'listarAlumnos':
			$car = $_SESSION['id_carrera'];
			$valValid = 1;
			$consult = $dbConexion -> prepare("SELECT * FROM alumnos WHERE id_detgrupo = :grp && acept_grp = :valValid && id_carrera = :car");
			$consult -> bindParam("grp", $grp, PDO::PARAM_INT);
			$consult -> bindParam("valValid", $valValid, PDO::PARAM_INT);
			$consult -> bindParam("car", $car, PDO::PARAM_INT);
			$consult -> execute();
			$data = Array();
			while ($reg = $consult->fetch(PDO::FETCH_OBJ)) {
				$notifAlmJustif = $docente->notifJustifAlm($keyDoc, $grp, $reg->id_alumno);
				if ($notifAlmJustif->Cantidad > 0) {
					if ($reg->becado_alm == 1) {
						$data[] = array(
							"0" => "<i class='fas fa-clock text-danger mr-2'></i>".$reg -> nombre_c_al."",
			                "1" => $reg -> matricula_al,
			                "2" => '<a href="'.SERVERURLDOC.'PerfAlm/'.base64_encode($reg->id_alumno).'/" class="btn btn-primary text-white btn-sm">
			                			<i class="fas fa-eye"></i>
			                		</a> <button class="btn btn-danger btn-sm" onclick="desactivarAlmGrp('.$reg->id_alumno.')"><i class="fa fa-times"></i></button>',
			                "3" => 	'<button type="button" class="btn btn-primary btn-sm"><i class="fa fa-check-circle fa-lg"></i></button>'	
						);
					} else {
						$data[] = array(
							"0" => "<i class='fas fa-clock text-danger mr-2'></i>".$reg -> nombre_c_al."",
			                "1" => $reg -> matricula_al,
			                "2" => '<a href="'.SERVERURLDOC.'PerfAlm/'.base64_encode($reg->id_alumno).'/" class="btn btn-primary text-white btn-sm">
			                			<i class="fas fa-eye"></i>
			                		</a> <button class="btn btn-danger btn-sm" onclick="desactivarAlmGrp('.$reg->id_alumno.')"><i class="fa fa-times"></i></button>',
			                "3" => 	'<button class="btn btn-outline-primary btn-sm" onclick="becadoAlm('.$reg->id_alumno.')"><i class="fa fa-check-circle fa-lg"></i></button>'	
						);
					}
					
				} else {	
					if ($reg->becado_alm == 1) {
						$data[] = array(
							"0" => "<i class='fas fa-clock text-success mr-2'></i>".$reg -> nombre_c_al."",
			                "1" => $reg -> matricula_al,
			                "2" => '<a href="'.SERVERURLDOC.'PerfAlm/'.base64_encode($reg->id_alumno).'/" class="btn btn-primary text-white btn-sm">
			                			<i class="fas fa-eye "></i>
			                			
			                		</a> <button class="btn btn-danger btn-sm" onclick="desactivarAlmGrp('.$reg->id_alumno.')"><i class="fa fa-times"></i></button>',
			                "3" => '<button class="btn btn-primary btn-sm" type="button"><i class="fa fa-check-circle fa-lg"></i></button>'		
						);
					} else {	
						$data[] = array(
							"0" => "<i class='fas fa-clock text-success mr-2'></i>".$reg -> nombre_c_al."",
			                "1" => $reg -> matricula_al,
			                "2" => '<a href="'.SERVERURLDOC.'PerfAlm/'.base64_encode($reg->id_alumno).'/" class="btn btn-primary text-white btn-sm">
			                			<i class="fas fa-eye"></i>
			                		</a> <button class="btn btn-danger btn-sm" onclick="desactivarAlmGrp('.$reg->id_alumno.')"><i class="fa fa-times"></i></button>',
			                "3" => '<button class="btn btn-outline-primary btn-sm" onclick="becadoAlm('.$reg->id_alumno.')"><i class="fa fa-check-circle fa-lg"></i></button>'		
						);
					}
				}
			}
			$results = array(
        		"sEcho"=>1,
        		"iTotalRecords"=>count($data),
        		"iTotalDisplayRecords"=>count($data),
        		"aaData"=>$data);
        	echo json_encode($results);
        	$consult = null;
        	$dbConexion = null;
			break;
			case 'listarAlumnosAcept':
				$car = $_SESSION['id_carrera'];
				$valValid = 1;
				$valInval = 0;
				$consult = $dbConexion -> prepare("SELECT * FROM alumnos WHERE id_detgrupo = :grp && estado_al = :valValid && acept_grp = :valInval && id_carrera = :car");
				$consult -> bindParam("grp", $grp, PDO::PARAM_INT);
				$consult -> bindParam("valValid", $valValid, PDO::PARAM_INT);
				$consult -> bindParam("valInval", $valInval, PDO::PARAM_INT);
				$consult -> bindParam("car", $car, PDO::PARAM_INT);
				$consult -> execute();
				$data = Array();
				while ($reg = $consult -> fetch(PDO::FETCH_OBJ)) {
					if ($reg -> foto_perf_alm != "") {
						$data[] = array(
							"0" => '<img src="'.$urlFront.'modAlm/Arch/perfil/'.$reg->foto_perf_alm.'" class="img-fluid rounded" width="100">',
							"1" => $reg -> nombre_c_al,
							"2" => $reg -> matricula_al,
							"3" => '<button class="btn btn-primary btn-sm" onclick="activarAlmGrp('.$reg->id_alumno.')"><i class="fa fa-check"></i></button>'
						);
					} else {
						if ($reg -> sexo_al == "Masculino") {
							$data[] = array(
								"0" => '<img src="../../../assets/img/usermal.png" class="img-fluid rounded" width="50">',
								"1" => $reg -> nombre_c_al,
								"2" => $reg -> matricula_al,
								"3" => '<button class="btn btn-primary btn-sm" onclick="activarAlmGrp('.$reg->id_alumno.')"><i class="fa fa-check"></i></button>'
							);
						} else {
							$data[] = array(
								"0" => '<img src="../../../assets/img/userfem.png" class="img-fluid rounded" width="50">',
								"1" => $reg -> nombre_c_al,
								"2" => $reg -> matricula_al,
								"3" => '<button class="btn btn-primary btn-sm" onclick="activarAlmGrp('.$reg->id_alumno.')"><i class="fa fa-check"></i></button>'
							);
						}
					}
				}
				$results = array(
					"sEcho" => 1,
					"iTotalRecords" => count($data),
					"iTotalDisplayRecords" => count($data),
					"aaData" => $data);
				echo json_encode($results);
				$consult = null;
				$dbConexion = null;
				break;
			case 'activarAlmGrp':
				$id_alumno = isset($_POST['id_alumno']) ? limpiarDatos($_POST['id_alumno']) : "";
				$datValid = $docente->datGrpSel($keyDoc, $grp);
				$nombre_c_doc = $datValid->nombre_c_doc;
				$grupo_n = $datValid->grupo_n;
				$cuatrimestre_g = $datValid->cuatrimestre_g;
				$period_cuat = $datValid->period_cuat;
				$valid = 1;
				$stmt1 = $dbConexion -> prepare("UPDATE alumnos SET acept_grp = :valid WHERE id_alumno = :id_alumno");
				$stmt1 -> bindParam("valid", $valid, PDO::PARAM_INT);
				$stmt1 -> bindParam("id_alumno", $id_alumno, PDO::PARAM_INT);
				$resstmt1 = $stmt1 -> execute();
				if ($resstmt1) {
					/*
					$stmt2 = $dbConexion -> prepare("SELECT id_historialaca FROM historial_academ WHERE tutor_almhist = :nombre_c_doc && grupo_almhist = :grupo_n && cuatri_almhist = :cuatrimestre_g && periodcuat_almhist = :period_cuat && id_alumno = :id_alumno");
					$stmt2 -> bindParam("nombre_c_doc", $nombre_c_doc, PDO::PARAM_STR);
					$stmt2 -> bindParam("grupo_n", $grupo_n, PDO::PARAM_STR);
					$stmt2 -> bindParam("cuatrimestre_g", $cuatrimestre_g, PDO::PARAM_STR);
					$stmt2 -> bindParam("period_cuat", $period_cuat, PDO::PARAM_STR);
					$stmt2 -> bindParam("id_alumno", $id_alumno, PDO::PARAM_INT);
					$resstmt2 = $stmt2 -> execute();
					if ($resstmt2) {
						$dataStmt2 = $stmt2 -> fetch(PDO::FETCH_OBJ);
						$id_historialaca = $dataStmt2->id_historialaca;
						$stmtUpd = $dbConexion->prepare("UPDATE historial_academ SET estado_almhist = :valid WHERE id_historialaca = :id_historialaca");
						$stmtUpd -> bindParam("valid", $valid, PDO::PARAM_INT);
						$stmtUpd -> bindParam("id_historialaca", $id_historialaca, PDO::PARAM_INT);
						$resStmtUpd =  $stmtUpd -> execute();
						if ($resStmtUpd) {
							echo 1;
						} else {
							echo 0;
						}
					} else {
						echo 0;
					}*/
					echo 1;
				} else {
					echo 0;
				}
				break;
			case 'desactivarAlmGrp':
				$id_alumno = isset($_POST['id_alumno']) ? limpiarDatos($_POST['id_alumno']) : "";
				$result = $docente -> desactivarAlmGrp($id_alumno);
				echo $result ? "Alumno rechazado del grupo" : "No se pudo rechazar del grupo";
				$result = null;
				break;	
			case 'becadoAlm':
				$id_alumno = isset($_POST['id_alumno']) ? limpiarDatos($_POST['id_alumno']) : "";
				$resutl = $docente -> becadoAlm($id_alumno);
				$valid = $dbConexion -> prepare("SELECT * FROM becados_alm WHERE id_alumno = :id_alumno");
				$valid -> bindParam("id_alumno", $id_alumno, PDO::PARAM_INT);
				$valid -> execute();
				$resvalid = $valid -> rowCount();
				if ($resvalid == 0) {
					$stmt = $dbConexion -> prepare("INSERT INTO becados_alm (id_alumno, tipo_beca_alm ,fecha_reg_beca) VALUES (:id_alumno, '', :fechAct)");
					$stmt -> bindParam(":id_alumno", $id_alumno, PDO::PARAM_INT);
					$stmt -> bindParam(":fechAct", $fechAct, PDO::PARAM_STR);
					$stmt -> execute();
					$resstmt = $stmt -> rowCount();
					if ($resstmt === 1) {
						echo $resutl ? "Correcto" : "No se pudo completar";
					} else {
						echo "fallo";
					}
				} else {
					echo $resutl ? "Correcto" : "No se pudo completar";
				}
				$valid = null; $resvalid = null; $stmt = null; $resstmt = null; $dbConexion = null;
				break;	
			case 'listarAlumnosBec':
				$car = $_SESSION['id_carrera'];
				$valValid = 1;
				$consult = $dbConexion -> prepare("SELECT * FROM becados_alm bec  INNER JOIN alumnos alm ON alm.id_alumno = bec.id_alumno INNER JOIN det_grupo det ON det.id_detgrupo = alm.id_detgrupo INNER JOIN docentes doc ON doc.id_docente = det.id_docente 
					WHERE NOT alm.id_alumno IN (SELECT baj.id_alumno FROM bajasalm_dat baj 
						WHERE baj.id_alumno = alm.id_alumno && baj.estado_baj_alm = 1) && det.id_detgrupo = :grp && doc.id_docente = :keyDoc && alm.becado_alm = :valValid && alm.estado_al = :valValid && alm.acept_grp = :valValid && alm.id_carrera = :car");
				$consult -> bindParam("grp", $grp, PDO::PARAM_INT);
				$consult -> bindParam("keyDoc", $keyDoc, PDO::PARAM_INT);
				$consult -> bindParam("valValid", $valValid, PDO::PARAM_INT);
				$consult -> bindParam("valValid", $valValid, PDO::PARAM_INT);
				$consult -> bindParam("valValid", $valValid, PDO::PARAM_INT);
				$consult -> bindParam("car", $car, PDO::PARAM_INT);
				$consult -> execute();
				$data = Array();
				while ($reg = $consult -> fetch(PDO::FETCH_OBJ)) {
					if ($reg->tipo_beca_alm == "") {
						$data[] = array(
							"0" => $reg->nombre_c_al,
							"1" => $reg->matricula_al,
							"2" => '<span class="badge badge-warning p-1">Sin Dato</span>',
							"3" => '<button class="btn btn-outline-warning btnEditBec btn-sm" type="button" data-target="#editBec" data-toggle="modal" onclick="editBec('.$reg->id_becadoalm.'),btnEditBec()"><i class="fas fa-edit"></i></button>
									<button class="btn btn-outline-danger btn-sm" type="button" onclick="becadoRechAlm('.$reg->id_alumno.')"><i class="fas fa-times"></i></button>'
						);
					} else {
						$data[] = array(
							"0" => $reg->nombre_c_al,
							"1" => $reg->matricula_al,
							"2" => $reg->tipo_beca_alm,
							"3" => '<button class="btn btn-outline-warning btnEditBec btn-sm" type="button" data-target="#editBec" data-toggle="modal" onclick="editBec('.$reg->id_becadoalm.'), btnEditBec()"><i class="fas fa-edit"></i></button>
									<button class="btn btn-outline-danger btn-sm" type="button" onclick="becadoRechAlm('.$reg->id_alumno.')"><i class="fas fa-times"></i></button>'
						);
					}
				}
				$results = array(
	        		"sEcho"=>1,
	        		"iTotalRecords"=>count($data),
	        		"iTotalDisplayRecords"=>count($data),
	        		"aaData"=>$data);
	        	echo json_encode($results);
	        	$consult = null;
	        	$dbConexion = null;
				break;	
			case 'becadoRechAlm':
				$id_alumno = isset($_POST['id_alumno']) ? limpiarDatos($_POST['id_alumno']) : "";
				$result = $docente -> becadoRechAlm($id_alumno);
				echo $result ? "Correcto" : "No se pudo completar";
				$result = null;
				break;	
			case 'editBec':
				$id_becadoalm = isset($_POST['id_becadoalm']) ? limpiarDatos($_POST['id_becadoalm']) : "";
				$result = $docente->mostrarBec($id_becadoalm);
				echo json_encode($result);
				$result = null;
				break;	
			case 'editBecAlm':
				$id_becadoalm = isset($_POST['id_becadoalm']) ? limpiarDatos($_POST['id_becadoalm']) : "";
				$tipBeca = isset($_POST['tipBeca']) ? limpiarDatos($_POST['tipBeca']) : "";
				$stmt = $dbConexion -> prepare("UPDATE becados_alm SET tipo_beca_alm = :tipBeca WHERE id_becadoalm = :id_becadoalm");
				$stmt -> bindParam("tipBeca", $tipBeca, PDO::PARAM_STR);
				$stmt -> bindParam("id_becadoalm", $id_becadoalm, PDO::PARAM_INT);
				$resstmt = $stmt -> execute();
				if ($resstmt) {
				  	echo "goodUpd";
				} else {
				  	echo "failUpd";
				}
				$stmt = null; $resstmt = null; $dbConexion = null;
				break;	
		default:
			$dbConexion = null;
			break;
	}
}