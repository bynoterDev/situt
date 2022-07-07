<?php 

session_start();

if ($_SESSION['keyDoc'] == "" || $_SESSION['keyDoc'] == null) {
	header("Location:../../Index.php");
} else {
	require_once '../../modelos/docente.modelo.php';
	include '../../modelos/rutas.php';
	include '../../modelos/rutasAmig.php';
	$urlFront = new Ruta();
	$urlFront = $urlFront -> ctrRutaFront();
	$docente = new Docentes();
	$keyDoc = $_SESSION['keyDoc'];
	$alm = $_SESSION["clvAlm"];
	$grp = $_SESSION["clvGrp"];
	$datGrp = $docente -> datGrpSel($keyDoc, $grp);
	$dbConexion = new Connect();
	$dbConexion = $dbConexion -> getDB();
	$fechAct = date("Y-m-d");
	switch ($_GET['oper']) {
		case 'listaAlumnos':
			$valValid = 1;
			$consult = $dbConexion -> prepare("SELECT * FROM alumnos WHERE id_detgrupo = :grp && estado_al = :valValid && acept_grp = :valValid && id_alumno != :alm");
			$consult -> bindParam("grp", $grp, PDO::PARAM_INT);
			$consult -> bindParam("valValid", $valValid, PDO::PARAM_INT);
			$consult -> bindParam("valValid", $valValid, PDO::PARAM_INT);
			$consult -> bindParam("alm", $alm, PDO::PARAM_INT);
			$consult -> execute();
			$data = Array();
			while ($reg = $consult->fetch(PDO::FETCH_OBJ)) {
				$data[] = array(
					"0" => $reg -> nombre_c_al,
		            "1" => $reg -> matricula_al,
		            "2" => '<a href="'.SERVERURLDOC.'PerfAlm/'.base64_encode($reg->id_alumno).'/" class="btn btn-outline-primary btn-sm">
	                		<i class="fas fa-eye"></i>
	                	'
					);
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
			case 'regJustif':
				$sitJustif = isset($_POST['sitJustif']) ? limpiarDatos($_POST['sitJustif']) : "";
				$fechJustif = isset($_POST['fechJustif']) ? limpiarDatos($_POST['fechJustif']) : "";
				$id_alumno = isset($_POST['id_alumno']) ? limpiarDatos($_POST['id_alumno']) : "";
				$cuatJustif = isset($_POST['cuatJustif']) ? limpiarDatos($_POST['cuatJustif']) : "";
				$id_alumnoDec = base64_decode($id_alumno);
				$stmt = $dbConexion -> prepare("INSERT INTO justificantes (situacion_justif, cuatrimestre_justif, fecha_justif, fecha_reg_justif, estado_justif, id_alumno) VALUES (:sitJustif, :cuatJustif, :fechJustif, :fechAct, 1, :id_alumnoDec)");
				$stmt -> bindParam(":sitJustif", $sitJustif, PDO::PARAM_STR);
				$stmt -> bindParam(":cuatJustif", $cuatJustif, PDO::PARAM_STR);
				$stmt -> bindParam(":fechJustif", $fechJustif, PDO::PARAM_STR);
				$stmt -> bindParam(":fechAct", $fechAct, PDO::PARAM_STR);
				$stmt -> bindParam(":id_alumnoDec", $id_alumnoDec, PDO::PARAM_INT);
				$stmt -> execute();
				$resstmt = $stmt -> rowCount();
				if ($resstmt === 1) {
					echo "goodIns";
				} else {
					echo "failIns";
				}
				$stmt = null; $dbConexion = null;
				break;
			case 'listarJustif':
				$valValid = 1;
				$consult = $dbConexion -> prepare("SELECT * FROM justificantes WHERE id_alumno = :alm && estado_justif = :valValid ORDER BY fecha_reg_justif DESC");
				$consult -> bindParam("alm", $alm, PDO::PARAM_INT);
				$consult -> bindParam("valValid", $valValid, PDO::PARAM_INT);
				$consult -> execute();
				$data = Array();
				while ($reg = $consult -> fetch(PDO::FETCH_OBJ)) {
					if ($reg -> cuatrimestre_justif === $datGrp -> cuatrimestre_g) {
						if ($reg -> archivo_justif == "") {
							
							$data[] = array(
							"0" => $reg -> situacion_justif,
							"1" => $reg -> cuatrimestre_justif,
							"2" => $reg -> fecha_justif,
							"3" => $reg -> fecha_reg_justif,
							"4" => '<i class="fas fa-times text-danger"></i>',
							"5" => '<a target="_blank" class="btn btn-outline-primary btn-sm" href="'.SERVERURLDOC.'doc/JustifAlm.php?v='.base64_encode($reg->id_justificante).'"><i class="fas fa-print"></i></a>
								<button type="button" onclick="rechJustif('.$reg->id_justificante.')" class="btn btn-outline-danger btn-sm"><i class="fas fa-times-circle"></i></button>'
						);
						} else {
							$data[] = array(
								"0" => $reg -> situacion_justif,
								"1" => $reg -> cuatrimestre_justif,
								"2" => $reg -> fecha_justif,
								"3" => $reg -> fecha_reg_justif,
								"4" => '<a target="_blank" href="'.$urlFront.'modAlm/Arch/justificantes/'.$reg -> archivo_justif.'"><i class="fas fa-file text-primary"></i></a>',
								"5" => '<a target="_blank" class="btn btn-outline-primary" href="'.SERVERURLDOC.'doc/ImprmJustif.php?v='.base64_encode($reg->id_justificante).'"><i class="fas fa-print"></i></a>
									<button type="button" onclick="rechJustif('.$reg->id_justificante.')" class="btn btn-outline-danger btn-sm"><i class="fas fa-times-circle"></i></button>'
							);
						}
					} else {
						if ($reg -> archivo_justif == "") {
							$data[] = array(
								"0" => $reg -> situacion_justif,
								"1" => $reg -> cuatrimestre_justif,
								"2" => $reg -> fecha_justif,
								"3" => $reg -> fecha_reg_justif,
								"4" => '<i class="fas fa-times text-danger"></i>',
								"5" => '-----'
							);
						} else {
							$data[] = array(
								"0" => $reg -> situacion_justif,
								"1" => $reg -> cuatrimestre_justif,
								"2" => $reg -> fecha_justif,
								"3" => $reg -> fecha_reg_justif,
								"4" => '<a target="_blank" href="'.$urlFront.'modAlm/Arch/justificantes/'.$reg -> archivo_justif.'"><i class="fas fa-file text-primary"></i></a>',
								"5" => '-----'
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
			case 'listarJustifAC':
				$valInval = 0;
				$tabla = "justificantes";
				$consult = $dbConexion -> prepare("SELECT * FROM justificantes jus 
					INNER JOIN alumnos alm ON alm.id_alumno = jus.id_alumno
					INNER JOIN det_grupo det ON det.id_detgrupo = alm.id_detgrupo 
					INNER JOIN grupos grp ON grp.id_grupo = det.id_grupo
					WHERE alm.id_alumno = :alm && jus.estado_justif = :valInval && jus.cuatrimestre_justif = grp.cuatrimestre_g ORDER BY fecha_reg_justif DESC");
				$consult -> bindParam("alm", $alm, PDO::PARAM_INT);
				$consult -> bindParam("valInval", $valInval, PDO::PARAM_INT);
				$consult -> execute();
				$data = Array();
				while ($reg = $consult -> fetch(PDO::FETCH_OBJ)) {
					if ($reg -> cuatrimestre_justif === $datGrp -> cuatrimestre_g) {
						if ($reg -> archivo_justif == "") {
							$data[] = array(
							"0" => $reg -> situacion_justif,
							"1" => $reg -> cuatrimestre_justif,
							"2" => $reg -> fecha_justif,
							"3" => $reg -> fecha_reg_justif,
							"4" => '<i class="fas fa-times text-danger"></i>',
							"5" => '<button type="button" onclick="aceptJustif('.$reg->id_justificante.')" class="btn btn-outline-primary btm-sm"> <i class="fas fa-check"></i></button> <button type="button" onclick="rechJustif('.$reg->id_justificante.')" class="btn btn-outline-danger btm-sm"> <i class="fas fa-times-circle"></i></button>'
						);
						} else {
							$data[] = array(
								"0" => $reg -> situacion_justif,
								"1" => $reg -> cuatrimestre_justif,
								"2" => $reg -> fecha_justif,
								"3" => $reg -> fecha_reg_justif,
								"4" => '<a target="_blank" href="'.$urlFront.'modAlm/Arch/justificantes/'.$reg -> archivo_justif.'"><i class="fas fa-file text-primary"></i></a>',
								"5" => '<button type="button" onclick="aceptJustif('.$reg->id_justificante.')" class="btn btn-outline-primary btm-sm"> <i class="fas fa-check"></i></button> <button type="button" onclick="rechJustif('.$reg->id_justificante.')" class="btn btn-outline-danger btm-sm"> <i class="fas fa-times-circle"></i></button>'
							);
						}
					} else {
						if ($reg -> archivo_justif == "") {
							$data[] = array(
								"0" => $reg -> situacion_justif,
								"1" => $reg -> cuatrimestre_justif,
								"2" => $reg -> fecha_justif,
								"3" => $reg -> fecha_reg_justif,
								"4" => '<i class="fas fa-times text-danger"></i>',
								"5" => '-----'
							);
						} else {
							$data[] = array(
								"0" => $reg -> situacion_justif,
								"1" => $reg -> cuatrimestre_justif,
								"2" => $reg -> fecha_justif,
								"3" => $reg -> fecha_reg_justif,
								"4" => '<a target="_blank" href="'.$urlFront.'modAlm/Arch/justificantes/'.$reg -> archivo_justif.'"><i class="fas fa-file text-primary"></i></a>',
								"5" => '-----'
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
			case 'aceptJustif':
				$valid = 1;
				$id_justificante = isset($_POST['id_justificante']) ? limpiarDatos($_POST['id_justificante']) : "";
				$stmt = $dbConexion -> prepare("UPDATE justificantes SET estado_justif = :valid, fecha_acept_justif = :fechAct WHERE id_justificante = :id_justificante");
				$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
				$stmt -> bindParam("fechAct", $fechAct, PDO::PARAM_STR);
				$stmt -> bindParam("id_justificante", $id_justificante, PDO::PARAM_INT);
				$resstmt = $stmt -> execute();
				if ($resstmt) {
					echo 1;
				} else {
					echo 0;
				}
				
				break;	
			case 'rechJustif':
				$inval = 2;
				$valVac = "0000-00-00";
				$id_justificante = isset($_POST['id_justificante']) ? limpiarDatos($_POST['id_justificante']) : "";
				$stmt = $dbConexion -> prepare("UPDATE justificantes SET estado_justif = :inval, fecha_acept_justif = :valVac WHERE id_justificante = :id_justificante");
				$stmt -> bindParam("inval", $inval, PDO::PARAM_INT);
				$stmt -> bindParam("valVac", $valVac, PDO::PARAM_STR);
				$stmt -> bindParam("id_justificante", $id_justificante, PDO::PARAM_INT);
				$resstmt = $stmt -> execute();
				if ($resstmt) {
					echo 1;
				} else {
					echo 0;
				}
				break;	
			case 'regHist':
				$id_alumno = isset($_POST['id_alumno']) ? limpiarDatos($_POST['id_alumno']) : "";
				$id_alumno = base64_decode($id_alumno);
				$cuatnom = isset($_POST['cuatnom']) ? limpiarDatos($_POST['cuatnom']) : "";
				$razHist = isset($_POST['razHist']) ? limpiarDatos($_POST['razHist']) : "";
				$priHist = isset($_POST['priHist']) ? limpiarDatos($_POST['priHist']) : "";
				$obsHist = isset($_POST['obsHist']) ? limpiarDatos($_POST['obsHist']) : "";
				$citFech = isset($_POST['citFech']) ? limpiarDatos($_POST['citFech']) : "";
				$timCit = isset($_POST['timCit']) ? limpiarDatos($_POST['timCit']) : "";
				$stmt = $dbConexion -> prepare("INSERT INTO tut_personales (razones_tut, prioridad_tut, observaciones_tut, cuatrimestre_tut, fecha_reg_obs, fecha_cita_tut, hora_cit_tut, fecha_acp_tut, id_alumno, estado_tut) VALUES (:razHist, :priHist, :obsHist, :cuatnom, :fechAct, :citFech, :timCit, :fechAct, :id_alumno, 1)");
				$stmt -> bindParam(":razHist", $razHist, PDO::PARAM_STR);
				$stmt -> bindParam(":priHist", $priHist, PDO::PARAM_STR);
				$stmt -> bindParam(":obsHist", $obsHist, PDO::PARAM_STR);
				$stmt -> bindParam(":cuatnom", $cuatnom, PDO::PARAM_STR);
				$stmt -> bindParam(":fechAct", $fechAct, PDO::PARAM_STR);
				$stmt -> bindParam(":citFech", $citFech, PDO::PARAM_STR);
				$stmt -> bindParam(":timCit", $timCit, PDO::PARAM_STR);
				$stmt -> bindParam(":fechAct", $fechAct, PDO::PARAM_STR);
				$stmt -> bindParam(":id_alumno", $id_alumno, PDO::PARAM_INT);
				$stmt -> execute();
				$resstmt = $stmt -> rowCount();
				if ($resstmt === 1) {
					echo "goodIns";
				} else {
					echo "failIns";
				}
				$stmt = null; $resstmt = null; $dbConexion = null;
				break;		
			case 'listadoHistorial':
				$valid = 1;
				$consult = $dbConexion -> prepare("SELECT * FROM tut_personales WHERE id_alumno = :alm && estado_tut = :valid ORDER BY fecha_reg_obs DESC");
				$consult -> bindParam("alm", $alm, PDO::PARAM_INT);
				$consult -> bindParam("valid", $valid, PDO::PARAM_INT);
				$consult -> execute();
				$data = Array();
				while ($reg = $consult -> fetch(PDO::FETCH_OBJ)) {
					$datCol = "";
					if ($reg -> prioridad_tut == "Alta") {
						$datCol = '<span class="badge-danger badge p-1">Alta</span>';
					} else if ($reg -> prioridad_tut == "Media") {
						$datCol = '<span class="badge-warning badge p-1">Media</span>';
					} else if ($reg -> prioridad_tut == "Baja") {
						$datCol = '<span class="badge-primary badge p-1">Baja</span>';
					} else {
						$datCol = $reg -> prioridad_tut;
					}
					$data[] = array(
						"0" => $reg->cuatrimestre_tut,
						"1" => $reg -> razones_tut,
						"2" => $datCol,
						"3" => $reg -> fecha_reg_obs,
						"4" => '<a class="btn btn-outline-primary btn-sm" href="'.SERVERURLDOC.'HistAlm/'.base64_encode($reg->id_tutpersonales).'/"><i class="fas fa-eye"></i></a>'
					);
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
		case 'listadoHistorialSolic':
			$inval = 0;
			$consult = $dbConexion -> prepare("SELECT * FROM tut_personales tut
				INNER JOIN alumnos alm ON alm.id_alumno = tut.id_alumno
				INNER JOIN det_grupo det ON det.id_detgrupo = alm.id_detgrupo
				INNER JOIN grupos grp ON grp.id_grupo = det.id_grupo
				WHERE alm.id_alumno = :alm && tut.estado_tut = :inval && tut.cuatrimestre_tut = grp.cuatrimestre_g ORDER BY tut.fecha_reg_obs DESC");
			$consult -> bindParam("alm", $alm, PDO::PARAM_INT);
			$consult -> bindParam("inval", $inval, PDO::PARAM_INT);
			$consult -> execute();
			$data = Array();
			while ($reg = $consult -> fetch(PDO::FETCH_OBJ)) {
				$datCol = "";
				if ($reg -> prioridad_tut == "Alta") {
					$datCol = '<b class="text-danger">Alta</b>';
				} else if ($reg -> prioridad_tut == "Media") {
					$datCol = '<b class="text-warning">Media</b>';
				} else if ($reg -> prioridad_tut == "Baja") {
					$datCol = '<b class="text-primary">Baja</b>';
				} else {
					$datCol = $reg -> prioridad_tut;
				}
				$data[] = array(
					"0" => $reg -> razones_tut,
					"1" => $datCol,
					"2" => $reg -> fecha_reg_obs,
					"3" => '<button onclick="datIdTut('.$reg->id_tutpersonales.')" data-target="#citTut" data-toggle="modal" class="btn btn-outline-primary btn-sm">
						<i class="fas fa-check-circle mr-2"></i>
						Aceptar</button>'
					// "3" => '<button onclick="aceptHist('.$reg->id_tutpersonales.')" class="btn btn-outline-success btn-lg">
					// 	<i class="fas fa-check-circle"></i>
					// 	</button>'
				);
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
		case 'aceptHist':
			$id_tutpersonales = isset($_POST['id_tutpersonales']) ? limpiarDatos($_POST['id_tutpersonales']) : "";
			$valid = 1;
			$stmt = $dbConexion -> prepare("UPDATE tut_personales SET estado_tut = :valid WHERE id_tutpersonales = :id_tutpersonales");
			$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
			$stmt -> bindParam("id_tutpersonales", $id_tutpersonales, PDO::PARAM_INT);
			$resstmt = $stmt -> execute();
			if ($resstmt) {
				echo 1;
			} else {
				echo 0;
			}
			$stmt = null; $dbConexion = null; $resstmt = null;
			break;	
		case 'regEvalTest':
			$vulnerable = isset($_POST['vulnerable']) ? limpiarDatos($_POST['vulnerable']) : "";
			$opcion1 = isset($_POST['opcion1']) ? limpiarDatos($_POST['opcion1']) : "";
			$opcion2 = isset($_POST['opcion2']) ? limpiarDatos($_POST['opcion2']) : "";
			$opcion3 = isset($_POST['opcion3']) ? limpiarDatos($_POST['opcion3']) : "";
			$obesidad = isset($_POST['obesidad']) ? limpiarDatos($_POST['obesidad']) : "";
			$delgadezExt = isset($_POST['delgadezExt']) ? limpiarDatos($_POST['delgadezExt']) : "";
			$manchasPiel = isset($_POST['manchasPiel']) ? limpiarDatos($_POST['manchasPiel']) : "";
			$faltaEnergia = isset($_POST['faltaEnergia']) ? limpiarDatos($_POST['faltaEnergia']) : "";
			$problemDen = isset($_POST['problemDen']) ? limpiarDatos($_POST['problemDen']) : "";
			$problemVis = isset($_POST['problemVis']) ? limpiarDatos($_POST['problemVis']) : "";
			$problemAud = isset($_POST['problemAud']) ? limpiarDatos($_POST['problemAud']) : "";
			$discapacidades = isset($_POST['discapacidades']) ? limpiarDatos($_POST['discapacidades']) : "";
			$otro = isset($_POST['otro']) ? limpiarDatos($_POST['otro']) : "";
			$obseval = isset($_POST['obseval']) ? limpiarDatos($_POST['obseval']) : "";
			$id_testalm = isset($_POST['id_testalm']) ? limpiarDatos($_POST['id_testalm']) : ""; 
			$id_testalmDec = base64_decode($id_testalm);
			$valid = $dbConexion -> prepare("SELECT * FROM evaluacion_test evt WHERE id_enctestalm = :id_testalmDec");
			$valid -> bindParam("id_testalmDec", $id_testalmDec, PDO::PARAM_INT);
			$valid -> execute();
			$resvalid = $valid -> rowCount();
			if ($resvalid == 0) {
				$stmt = $dbConexion -> prepare("INSERT INTO evaluacion_test (id_enctestalm, vulnerable, opcion1, opcion2, opcion3, obseval, obesidad, delgadezExt, manchasPiel, faltaEnergia, problemDen, problemVis, problemAud, discapacidades, otro, fecha_reg_eval) VALUES (:id_enctestalm, :vulnerable, :opcion1, :opcion2, :opcion3, :obseval, :obesidad, :delgadezExt, :manchasPiel, :faltaEnergia, :problemDen, :problemVis, :problemAud, :discapacidades, :otro, :fechAct)");
				$stmt -> bindParam(":id_enctestalm", $id_testalmDec, PDO::PARAM_INT);
				$stmt -> bindParam(":vulnerable", $vulnerable, PDO::PARAM_STR);
				$stmt -> bindParam(":opcion1", $opcion1, PDO::PARAM_STR);
				$stmt -> bindParam(":opcion2", $opcion2, PDO::PARAM_STR);
				$stmt -> bindParam(":opcion3", $opcion3, PDO::PARAM_STR);
				$stmt -> bindParam(":obseval", $obseval, PDO::PARAM_STR);
				$stmt -> bindParam(":obesidad", $obesidad, PDO::PARAM_STR);
				$stmt -> bindParam(":delgadezExt", $delgadezExt, PDO::PARAM_STR);
				$stmt -> bindParam(":manchasPiel", $manchasPiel, PDO::PARAM_STR);
				$stmt -> bindParam(":faltaEnergia", $faltaEnergia, PDO::PARAM_STR);
				$stmt -> bindParam(":problemDen", $problemDen, PDO::PARAM_STR);
				$stmt -> bindParam(":problemVis", $problemVis, PDO::PARAM_STR);
				$stmt -> bindParam(":problemAud", $problemAud, PDO::PARAM_STR);
				$stmt -> bindParam(":discapacidades", $discapacidades, PDO::PARAM_STR);
				$stmt -> bindParam(":otro", $otro, PDO::PARAM_STR);
				$stmt -> bindParam(":fechAct", $fechAct, PDO::PARAM_STR);
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
			$dbConexion = null; $valid = null; $resvalid = null; $stmt = null; $resstmt = null;
			break;	
		case 'editEvalTest':
			$vulnerable = isset($_POST['vulnerable']) ? limpiarDatos($_POST['vulnerable']) : "";
			$opcion1 = isset($_POST['opcion1']) ? limpiarDatos($_POST['opcion1']) : "";
			$opcion2 = isset($_POST['opcion2']) ? limpiarDatos($_POST['opcion2']) : "";
			$opcion3 = isset($_POST['opcion3']) ? limpiarDatos($_POST['opcion3']) : "";
			$obseval = isset($_POST['obseval']) ? limpiarDatos($_POST['obseval']) : "";
			$obesidad = isset($_POST['obesidad']) ? limpiarDatos($_POST['obesidad']) : "";
			$delgadezExt = isset($_POST['delgadezExt']) ? limpiarDatos($_POST['delgadezExt']) : "";
			$manchasPiel = isset($_POST['manchasPiel']) ? limpiarDatos($_POST['manchasPiel']) : "";
			$faltaEnergia = isset($_POST['faltaEnergia']) ? limpiarDatos($_POST['faltaEnergia']) : "";
			$problemDen = isset($_POST['problemDen']) ? limpiarDatos($_POST['problemDen']) : "";
			$problemVis = isset($_POST['problemVis']) ? limpiarDatos($_POST['problemVis']) : "";
			$problemAud = isset($_POST['problemAud']) ? limpiarDatos($_POST['problemAud']) : "";
			$discapacidades = isset($_POST['discapacidades']) ? limpiarDatos($_POST['discapacidades']) : "";
			$otro = isset($_POST['otro']) ? limpiarDatos($_POST['otro']) : "";
			$id_testalm = isset($_POST['id_testalm']) ? limpiarDatos($_POST['id_testalm']) : ""; 
			$id_testalmDec = base64_decode($id_testalm);
			$id_enctest = isset($_POST['id_enctest']) ? limpiarDatos($_POST['id_enctest']) : "";
			$id_enctestDec = base64_decode($id_enctest);
			$passEditEval = isset($_POST['passEditEval']) ? limpiarDatos($_POST['passEditEval']) : "";
			$passEditEvalEnc = sha1($passEditEval);
			$valid = $dbConexion -> prepare("SELECT nombre_c_doc FROM docentes WHERE contrasena_doc = :passEditEvalEnc && id_docente = :keyDoc");
			$valid -> bindParam("passEditEvalEnc", $passEditEvalEnc, PDO::PARAM_STR);
			$valid -> bindParam("keyDoc", $keyDoc, PDO::PARAM_INT);
			$valid -> execute();
			$resvalid = $valid -> rowCount();
			if ($resvalid == 1) {
				$stmt = $dbConexion -> prepare("UPDATE evaluacion_test SET vulnerable = :vulnerable, opcion1 = :opcion1, opcion2 = :opcion2, opcion3 = :opcion3, obseval = :obseval, obesidad = :obesidad, delgadezExt = :delgadezExt, manchasPiel = :manchasPiel, faltaEnergia = :faltaEnergia, problemDen = :problemDen, problemVis = :problemVis, problemAud = :problemAud, discapacidades = :discapacidades, otro = :otro WHERE id_evaltest = :id_enctestDec && id_enctestalm = :id_testalmDec");
				$stmt -> bindParam("vulnerable", $vulnerable, PDO::PARAM_STR);
				$stmt -> bindParam("opcion1", $opcion1, PDO::PARAM_STR);
				$stmt -> bindParam("opcion2", $opcion2, PDO::PARAM_STR);
				$stmt -> bindParam("opcion3", $opcion3, PDO::PARAM_STR);
				$stmt -> bindParam("obseval", $obseval, PDO::PARAM_STR);
				$stmt -> bindParam("obesidad", $obesidad, PDO::PARAM_STR);
				$stmt -> bindParam("delgadezExt", $delgadezExt, PDO::PARAM_STR);
				$stmt -> bindParam("manchasPiel", $manchasPiel, PDO::PARAM_STR);
				$stmt -> bindParam("faltaEnergia", $faltaEnergia, PDO::PARAM_STR);
				$stmt -> bindParam("problemDen", $problemDen, PDO::PARAM_STR);
				$stmt -> bindParam("problemVis", $problemVis, PDO::PARAM_STR);
				$stmt -> bindParam("problemAud", $problemAud, PDO::PARAM_STR);
				$stmt -> bindParam("discapacidades", $discapacidades, PDO::PARAM_STR);
				$stmt -> bindParam("otro", $otro, PDO::PARAM_STR);
				$stmt -> bindParam("id_enctestDec", $id_enctestDec, PDO::PARAM_INT);
				$stmt -> bindParam("id_testalmDec", $id_testalmDec, PDO::PARAM_INT);
				$resstmt = $stmt -> execute();
				if ($resstmt) {
					echo "goodUpd";
				} else {
					echo "failUpd";
				}
			} else {
				echo "mal";
			}
			$dbConexion = null; $valid = null; $resvalid = null; $stmt = null; $resstmt = null;
			break;
		case 'confContNewAlm':
			$id_alumno = isset($_POST['id_alumno']) ? limpiarDatos($_POST['id_alumno']) : "";
			$keyAlmEnc = base64_decode($id_alumno);
			$newContAlm = isset($_POST['newContAlm']) ? limpiarDatos($_POST['newContAlm']) : "";
			$newContAlmEnc = sha1($newContAlm);
			$contConfDoc = isset($_POST['contConfDoc']) ? limpiarDatos($_POST['contConfDoc']) : "";
			$contConfDocEnc = sha1($contConfDoc);
			$valid = $dbConexion -> prepare("SELECT nombre_c_doc FROM docentes WHERE contrasena_doc = :contConfDocEnc && id_docente = :keyDoc");
			$valid -> bindParam("contConfDocEnc", $contConfDocEnc, PDO::PARAM_STR);
			$valid -> bindParam("keyDoc", $keyDoc, PDO::PARAM_INT);
			$valid -> execute();
			$resvalid = $valid -> rowCount();
			if ($resvalid == 1) {
				$stmt = $dbConexion -> prepare("UPDATE alumnos SET contrasena_al = :newContAlmEnc, contdesc_al = :newContAlm WHERE id_alumno = :id_alumno");
				$stmt -> bindParam("newContAlmEnc", $newContAlmEnc, PDO::PARAM_STR);
				$stmt -> bindParam("newContAlm", $newContAlm, PDO::PARAM_STR);
				$stmt -> bindParam("id_alumno", $keyAlmEnc, PDO::PARAM_INT);
				$resstmt = $stmt -> execute();
				if ($resstmt) {
					echo "goodUpd";
				} else {
					echo "failUpd";
				}
			} else {
				echo "failCont";
			}
			$dbConexion = null; $valid = null; $resvalid = null; $stmt = null; $resstmt = null;
			break;
		case 'desactAlm':
			$id_alumno = isset($_POST['id_alumno']) ? limpiarDatos($_POST['id_alumno']) : "";
			$inval = 0;
			$stmt = $dbConexion -> prepare("UPDATE alumnos SET estado_al = :inval WHERE id_alumno = :id_alumno");
			$stmt -> bindParam("inval", $inval, PDO::PARAM_INT);
			$stmt -> bindParam("id_alumno", $id_alumno, PDO::PARAM_INT);
			$resstmt = $stmt -> execute();
			if ($resstmt) {
				echo "goodUpd";
			} else {
				echo "failUpd";
			}
			$stmt = null; $dbConexion = null; $resstmt = null;
			break;
		case 'activAlm':
			$id_alumno = isset($_POST['id_alumno']) ? limpiarDatos($_POST['id_alumno']) : "";
			$valid = 1;
			$stmt = $dbConexion -> prepare("UPDATE alumnos SET estado_al = :valid WHERE id_alumno = :id_alumno");
			$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
			$stmt -> bindParam("id_alumno", $id_alumno, PDO::PARAM_INT);
			$resstmt = $stmt -> execute();
			if ($resstmt) {
				echo "goodUpd";
			} else {
				echo "failUpd";
			}
			$stmt = null; $dbConexion = null; $resstmt = null;
			break;	
		case 'datIdTut':
			$id_tutpersonales = isset($_POST['id_tutpersonales']) ? limpiarDatos($_POST['id_tutpersonales']) : "";
			$stmt = $dbConexion -> prepare("SELECT id_tutpersonales FROM tut_personales WHERE id_tutpersonales = :id_tutpersonales");
			$stmt -> bindParam("id_tutpersonales", $id_tutpersonales, PDO::PARAM_INT);
			$stmt -> execute();
			$data = $stmt -> fetch(PDO::FETCH_ASSOC);
			echo json_encode($data);
			break;	
		case 'aceptTutCit':
			$valid = 1;
			$id_tutpersonales = isset($_POST['id_tutpersonales']) ? limpiarDatos($_POST['id_tutpersonales']) : "";
			$citFech = isset($_POST['citFech']) ? limpiarDatos($_POST['citFech']) : "";
			$timCit = isset($_POST['timCit']) ? limpiarDatos($_POST['timCit']) : "";
			if ($citFech >= $fechAct) {
				$stmt = $dbConexion -> prepare("UPDATE tut_personales SET fecha_cita_tut = :citFech, hora_cit_tut = :timCit, fecha_acp_tut = :fechAct, estado_tut = :valid WHERE id_tutpersonales = :id_tutpersonales");
				$stmt -> bindParam("citFech", $citFech, PDO::PARAM_STR);
				$stmt -> bindParam("timCit", $timCit, PDO::PARAM_STR);
				$stmt -> bindParam("fechAct", $fechAct, PDO::PARAM_STR);
				$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
				$stmt -> bindParam("id_tutpersonales", $id_tutpersonales, PDO::PARAM_INT);
				$resstmt = $stmt -> execute();
				if ($resstmt) {
					echo "goodUpd";
				} else {
					echo "failUpd";
				}
			} else {
				echo "mal";
			}
			break;				
		default:
			$dbConexion = null;
			break;
	}
}