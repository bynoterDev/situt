<?php

ob_start();
session_start();

if ($_SESSION['keyAlm'] == "" || $_SESSION['keyAlm'] == null) {
	header("Location:../../Index.php");
} else {
	require_once '../../modelos/alumno.modelo.php';
	$alumno = new Alumno();
	$keyAlm = $_SESSION['keyAlm'];
	$fechAct = date("Y-m-d");
	$dbConexion = new Connect();
	$dbConexion = $dbConexion -> getDB();
	switch ($_GET['oper']) {
		
		case 'envDatTest':
			/*----------  Datos SocioEconomicos  ----------*/
			$reside = isset($_POST['reside']) ? limpiarDatos($_POST['reside']) : "";
			$tiempo = isset($_POST['tiempo']) ? limpiarDatos($_POST['tiempo']) : "";
			$especifica = isset($_POST['especifica']) ? limpiarDatos($_POST['especifica']) : "";
			$vives = isset($_POST['vives']) ? limpiarDatos($_POST['vives']) : "";
			$trabajas = isset($_POST['trabajas']) ? limpiarDatos($_POST['trabajas']) : "";
			$donde_trabajas = isset($_POST['donde_trabajas']) ? limpiarDatos($_POST['donde_trabajas']) : "";
			$ingresoTrab = isset($_POST['ingresoTrab']) ? limpiarDatos($_POST['ingresoTrab']) : "";
			$horas_tr = isset($_POST['horas_tr']) ? limpiarDatos($_POST['horas_tr']) : "";
			$ingrDependes = isset($_POST['ingrDependes']) ? limpiarDatos($_POST['ingrDependes']) : "";
			$economicamente = isset($_POST['economicamente']) ? limpiarDatos($_POST['economicamente']) : "";
			$papa = isset($_POST['papa']) ? limpiarDatos($_POST['papa']) : "";
			$mama = isset($_POST['mama']) ? limpiarDatos($_POST['mama']) : "";
			$hermanos = isset($_POST['hermanos']) ? limpiarDatos($_POST['hermanos']) : "";
			$actividad_herm = isset($_POST['actividad_herm']) ? limpiarDatos($_POST['actividad_herm']) : "";
			$habitas = isset($_POST['habitas']) ? limpiarDatos($_POST['habitas']) : "";
			$ingreso_familiar = isset($_POST['ingreso_familiar']) ? limpiarDatos($_POST['ingreso_familiar']) : "";

			/*----------  Datos personales  ----------*/
			$padeces = isset($_POST['padeces']) ? limpiarDatos($_POST['padeces']) : "";
			$especificaEnf = isset($_POST['especificaEnf']) ? limpiarDatos($_POST['especificaEnf']) : "";
			$frec_enferm = isset($_POST['frec_enferm']) ? limpiarDatos($_POST['frec_enferm']) : "";
			$espEnf = isset($_POST['espEnf']) ? limpiarDatos($_POST['espEnf']) : "";
			$medicamento = isset($_POST['medicamento']) ? limpiarDatos($_POST['medicamento']) : "";
			$cualMed = isset($_POST['cualMed']) ? limpiarDatos($_POST['cualMed']) : "";
			$fumas = isset($_POST['fumas']) ? limpiarDatos($_POST['fumas']) : "";
			$cantidadFum = isset($_POST['cantidadFum']) ? limpiarDatos($_POST['cantidadFum']) : "";
			$alchol = isset($_POST['alchol']) ? limpiarDatos($_POST['alchol']) : "";
			$cantidadBeb = isset($_POST['cantidadBeb']) ? limpiarDatos($_POST['cantidadBeb']) : "";
			$cualidades = isset($_POST['cualidades']) ? limpiarDatos($_POST['cualidades']) : "";
			$defectos = isset($_POST['defectos']) ? limpiarDatos($_POST['defectos']) : "";
			$aprecias = isset($_POST['aprecias']) ? limpiarDatos($_POST['aprecias']) : "";
			$disgusta = isset($_POST['disgusta']) ? limpiarDatos($_POST['disgusta']) : "";
			$temor = isset($_POST['temor']) ? limpiarDatos($_POST['temor']) : "";
			$novio = isset($_POST['novio']) ? limpiarDatos($_POST['novio']) : "";
			$planes = isset($_POST['planes']) ? limpiarDatos($_POST['planes']) : "";
			$f_personal = isset($_POST['f_personal']) ? limpiarDatos($_POST['f_personal']) : "";
			$f_academico = isset($_POST['f_academico']) ? limpiarDatos($_POST['f_academico']) : "";	
			$f_profesional = isset($_POST['f_profesional'])	? limpiarDatos($_POST['f_profesional']) : "";
			$t_libre = isset($_POST['t_libre']) ? limpiarDatos($_POST['t_libre']) : "";

			/*----------  Datos Academicos  ----------*/
			$bachillerato = isset($_POST['bachillerato']) ? limpiarDatos($_POST['bachillerato']) : "";
			$turno = isset($_POST['turno']) ? limpiarDatos($_POST['turno']) : "";
			$localidadBach = isset($_POST['localidadBach']) ? limpiarDatos($_POST['localidadBach']) : "";
			$entidadBach = isset($_POST['entidadBach']) ? limpiarDatos($_POST['entidadBach']) : "";
			$especialidadBach = isset($_POST['especialidadBach']) ? limpiarDatos($_POST['especialidadBach']) : "";
			$promedioBach = isset($_POST['promedioBach']) ? limpiarDatos($_POST['promedioBach']) : "";
			$ceneval = isset($_POST['cenval']) ? limpiarDatos($_POST['ceneval']) : "";
			$estudiar = isset($_POST['estudiar']) ? limpiarDatos($_POST['estudiar']) : "";
			$opcionUni = isset($_POST['opcionUni']) ? limpiarDatos($_POST['opcionUni']) : "";
			$opcionCar = isset($_POST['opcionCar']) ? limpiarDatos($_POST['opcionCar']) : "";
			$carreraEsp = isset($_POST['carreraEsp']) ? limpiarDatos($_POST['carreraEsp']) : "";
			$planExm = isset($_POST['planExm']) ? limpiarDatos($_POST['planExm']) : "";
			$dificultMat = isset($_POST['dificultMat']) ? limpiarDatos($_POST['dificultMat']) : "";
			$reprobado = isset($_POST['reprobado']) ? limpiarDatos($_POST['reprobado']) : "";
			$materiasRep = isset($_POST['materiasRep']) ? limpiarDatos($_POST['materiasRep']) : "";
			$tecnica = isset($_POST['tecnica']) ? limpiarDatos($_POST['tecnica']) : "";
			$cualTec = isset($_POST['cualTec']) ? limpiarDatos($_POST['cualTec']) : "";
			$libros = isset($_POST['libros']) ? limpiarDatos($_POST['libros']) : "";
			$cantLib = isset($_POST['cantLib']) ? limpiarDatos($_POST['cantLib']) : "";
			$computadora = isset($_POST['computadora']) ? limpiarDatos($_POST['computadora']) : "";
			$valid1 = $dbConexion -> prepare("SELECT * FROM enctes_alm WHERE id_alumno = :keyAlm");
			$valid1 -> bindParam("keyAlm", $keyAlm, PDO::PARAM_INT);
			$valid1 -> execute();
			$resvalid1 = $valid1 -> rowCount();
			if ($resvalid1 === 0) {
				$stmt = $dbConexion -> prepare("INSERT INTO enctes_alm (id_alumno, reside, tiempo_res, especifica_res, vives, trabajas, donde_trabajas, ingresoTrab, horas_tr, ingrDependes, economicamente, papa, mama, hermanos, actividad_herm, habitas, ingreso_familiar, padeces, especificaEnf, frec_enferm, espEnf, medicamento, cualMed, fumas, cantidadFum, alchol, cantidadBeb, cualidades, defectos, aprecias, disgusta, temor, novio, planes, f_personal, f_academico, f_profesional, t_libre, bachillerato, turno, localidadBach, entidadBach, especialidadBach, promedioBach, ceneval, estudiar, opcionUni, opcionCar, carreraEsp, planExm, dificultMat, reprobado, materiasRep, tecnica, cualTec, libros, cantLib, computadora, fecha_reg) VALUES (:keyAlm, :reside, :tiempo, :especifica, :vives, :trabajas, :donde_trabajas, :ingresoTrab, :horas_tr, :ingrDependes, :economicamente, :papa, :mama, :hermanos, :actividad_herm, :habitas, :ingreso_familiar, :padeces, :especificaEnf, :frec_enferm, :espEnf, :medicamento, :cualMed, :fumas, :cantidadFum, :alchol, :cantidadBeb, :cualidades, :defectos, :aprecias, :disgusta, :temor, :novio, :planes, :f_personal, :f_academico, :f_profesional, :t_libre, :bachillerato, :turno, :localidadBach, :entidadBach, :especialidadBach, :promedioBach, :ceneval, :estudiar, :opcionUni, :opcionCar, :carreraEsp, :planExm, :dificultMat, :reprobado, :materiasRep, :tecnica, :cualTec, :libros, :cantLib, :computadora, :fechAct)");
				$stmt -> bindParam("keyAlm", $keyAlm, PDO::PARAM_INT);
				$stmt -> bindParam("reside", $reside, PDO::PARAM_STR);
				$stmt -> bindParam("tiempo", $tiempo, PDO::PARAM_STR);
				$stmt -> bindParam("especifica", $especifica, PDO::PARAM_STR);
				$stmt -> bindParam("vives", $vives, PDO::PARAM_STR);
				$stmt -> bindParam("trabajas", $trabajas, PDO::PARAM_STR);
				$stmt -> bindParam("donde_trabajas", $donde_trabajas, PDO::PARAM_STR);
				$stmt -> bindParam("ingresoTrab", $ingresoTrab, PDO::PARAM_STR);
				$stmt -> bindParam("horas_tr", $horas_tr, PDO::PARAM_STR);
				$stmt -> bindParam("ingrDependes", $ingrDependes, PDO::PARAM_STR);
				$stmt -> bindParam("economicamente", $economicamente, PDO::PARAM_STR);
				$stmt -> bindParam("papa", $papa, PDO::PARAM_STR);
				$stmt -> bindParam("mama", $mama, PDO::PARAM_STR);
				$stmt -> bindParam("hermanos", $hermanos, PDO::PARAM_STR);
				$stmt -> bindParam("actividad_herm", $actividad_herm, PDO::PARAM_STR);
				$stmt -> bindParam("habitas", $habitas, PDO::PARAM_STR);
				$stmt -> bindParam("ingreso_familiar", $ingreso_familiar, PDO::PARAM_STR);
				$stmt -> bindParam("padeces", $padeces, PDO::PARAM_STR);
				$stmt -> bindParam("especificaEnf", $especificaEnf, PDO::PARAM_STR);
				$stmt -> bindParam("frec_enferm", $frec_enferm, PDO::PARAM_STR);
				$stmt -> bindParam("espEnf", $espEnf, PDO::PARAM_STR);
				$stmt -> bindParam("medicamento", $medicamento, PDO::PARAM_STR);
				$stmt -> bindParam("cualMed", $cualMed, PDO::PARAM_STR);
				$stmt -> bindParam("fumas", $fumas, PDO::PARAM_STR);
				$stmt -> bindParam("cantidadFum", $cantidadFum, PDO::PARAM_STR);
				$stmt -> bindParam("alchol", $alchol, PDO::PARAM_STR);
				$stmt -> bindParam("cantidadBeb", $cantidadBeb, PDO::PARAM_STR);
				$stmt -> bindParam("cualidades", $cualidades, PDO::PARAM_STR);
				$stmt -> bindParam("defectos", $defectos, PDO::PARAM_STR);
				$stmt -> bindParam("aprecias", $aprecias, PDO::PARAM_STR);
				$stmt -> bindParam("disgusta", $disgusta, PDO::PARAM_STR);
				$stmt -> bindParam("temor", $temor, PDO::PARAM_STR);
				$stmt -> bindParam("novio", $novio, PDO::PARAM_STR);
				$stmt -> bindParam("planes", $planes, PDO::PARAM_STR);
				$stmt -> bindParam("f_personal", $f_personal, PDO::PARAM_STR);
				$stmt -> bindParam("f_academico", $f_academico, PDO::PARAM_STR);
				$stmt -> bindParam("f_profesional", $f_profesional, PDO::PARAM_STR);
				$stmt -> bindParam("t_libre", $t_libre, PDO::PARAM_STR);
				$stmt -> bindParam("bachillerato", $bachillerato, PDO::PARAM_STR);
				$stmt -> bindParam("turno", $turno, PDO::PARAM_STR);
				$stmt -> bindParam("localidadBach", $localidadBach, PDO::PARAM_STR);
				$stmt -> bindParam("entidadBach", $entidadBach, PDO::PARAM_STR);
				$stmt -> bindParam("especialidadBach", $especialidadBach, PDO::PARAM_STR);
				$stmt -> bindParam("promedioBach", $promedioBach, PDO::PARAM_STR);
				$stmt -> bindParam("ceneval", $ceneval, PDO::PARAM_STR);
				$stmt -> bindParam("estudiar", $estudiar, PDO::PARAM_STR);
				$stmt -> bindParam("opcionUni", $opcionUni, PDO::PARAM_STR);
				$stmt -> bindParam("opcionCar", $opcionCar, PDO::PARAM_STR);
				$stmt -> bindParam("carreraEsp", $carreraEsp, PDO::PARAM_STR);
				$stmt -> bindParam("planExm", $planExm, PDO::PARAM_STR);
				$stmt -> bindParam("dificultMat", $dificultMat, PDO::PARAM_STR);
				$stmt -> bindParam("reprobado", $reprobado, PDO::PARAM_STR);
				$stmt -> bindParam("materiasRep", $materiasRep, PDO::PARAM_STR);
				$stmt -> bindParam("tecnica", $tecnica, PDO::PARAM_STR);
				$stmt -> bindParam("cualTec", $cualTec, PDO::PARAM_STR);
				$stmt -> bindParam("libros", $libros, PDO::PARAM_STR);
				$stmt -> bindParam("cantLib", $cantLib, PDO::PARAM_STR);
				$stmt -> bindParam("computadora", $computadora, PDO::PARAM_STR);
				$stmt -> bindParam("fechAct", $fechAct, PDO::PARAM_STR);
				$stmt -> execute();
				$resstmt = $stmt -> rowCount();
				if ($resstmt === 1) {
					echo "goodIns";
				} else {
					echo "failIns";
				}
			} else {
				die();
			}
			$valid1 = null; $resvalid1 = null; $stmt = null; $resstmt = null; $dbConexion = null;
			break;
		case 'editTest':
		/*----------  Datos SocioEconomicos  ----------*/
			$reside = isset($_POST['reside']) ? limpiarDatos($_POST['reside']) : "";
			$tiempo = isset($_POST['tiempo']) ? limpiarDatos($_POST['tiempo']) : "";
			$especifica = isset($_POST['especifica']) ? limpiarDatos($_POST['especifica']) : "";
			$vives = isset($_POST['vives']) ? limpiarDatos($_POST['vives']) : "";
			$trabajas = isset($_POST['trabajas']) ? limpiarDatos($_POST['trabajas']) : "";
			$donde_trabajas = isset($_POST['donde_trabajas']) ? limpiarDatos($_POST['donde_trabajas']) : "";
			$ingresoTrab = isset($_POST['ingresoTrab']) ? limpiarDatos($_POST['ingresoTrab']) : "";
			$horas_tr = isset($_POST['horas_tr']) ? limpiarDatos($_POST['horas_tr']) : "";
			$ingrDependes = isset($_POST['ingrDependes']) ? limpiarDatos($_POST['ingrDependes']) : "";
			$economicamente = isset($_POST['economicamente']) ? limpiarDatos($_POST['economicamente']) : "";
			$papa = isset($_POST['papa']) ? limpiarDatos($_POST['papa']) : "";
			$mama = isset($_POST['mama']) ? limpiarDatos($_POST['mama']) : "";
			$hermanos = isset($_POST['hermanos']) ? limpiarDatos($_POST['hermanos']) : "";
			$actividad_herm = isset($_POST['actividad_herm']) ? limpiarDatos($_POST['actividad_herm']) : "";
			$habitas = isset($_POST['habitas']) ? limpiarDatos($_POST['habitas']) : "";
			$ingreso_familiar = isset($_POST['ingreso_familiar']) ? limpiarDatos($_POST['ingreso_familiar']) : "";

			/*----------  Datos personales  ----------*/
			$padeces = isset($_POST['padeces']) ? limpiarDatos($_POST['padeces']) : "";
			$especificaEnf = isset($_POST['especificaEnf']) ? limpiarDatos($_POST['especificaEnf']) : "";
			$frec_enferm = isset($_POST['frec_enferm']) ? limpiarDatos($_POST['frec_enferm']) : "";
			$espEnf = isset($_POST['espEnf']) ? limpiarDatos($_POST['espEnf']) : "";
			$medicamento = isset($_POST['medicamento']) ? limpiarDatos($_POST['medicamento']) : "";
			$cualMed = isset($_POST['cualMed']) ? limpiarDatos($_POST['cualMed']) : "";
			$fumas = isset($_POST['fumas']) ? limpiarDatos($_POST['fumas']) : "";
			$cantidadFum = isset($_POST['cantidadFum']) ? limpiarDatos($_POST['cantidadFum']) : "";
			$alchol = isset($_POST['alchol']) ? limpiarDatos($_POST['alchol']) : "";
			$cantidadBeb = isset($_POST['cantidadBeb']) ? limpiarDatos($_POST['cantidadBeb']) : "";
			$cualidades = isset($_POST['cualidades']) ? limpiarDatos($_POST['cualidades']) : "";
			$defectos = isset($_POST['defectos']) ? limpiarDatos($_POST['defectos']) : "";
			$aprecias = isset($_POST['aprecias']) ? limpiarDatos($_POST['aprecias']) : "";
			$disgusta = isset($_POST['disgusta']) ? limpiarDatos($_POST['disgusta']) : "";
			$temor = isset($_POST['temor']) ? limpiarDatos($_POST['temor']) : "";
			$novio = isset($_POST['novio']) ? limpiarDatos($_POST['novio']) : "";
			$planes = isset($_POST['planes']) ? limpiarDatos($_POST['planes']) : "";
			$f_personal = isset($_POST['f_personal']) ? limpiarDatos($_POST['f_personal']) : "";
			$f_academico = isset($_POST['f_academico']) ? limpiarDatos($_POST['f_academico']) : "";	
			$f_profesional = isset($_POST['f_profesional'])	? limpiarDatos($_POST['f_profesional']) : "";
			$t_libre = isset($_POST['t_libre']) ? limpiarDatos($_POST['t_libre']) : "";

			/*----------  Datos Academicos  ----------*/
			$bachillerato = isset($_POST['bachillerato']) ? limpiarDatos($_POST['bachillerato']) : "";
			$turno = isset($_POST['turno']) ? limpiarDatos($_POST['turno']) : "";
			$localidadBach = isset($_POST['localidadBach']) ? limpiarDatos($_POST['localidadBach']) : "";
			$entidadBach = isset($_POST['entidadBach']) ? limpiarDatos($_POST['entidadBach']) : "";
			$especialidadBach = isset($_POST['especialidadBach']) ? limpiarDatos($_POST['especialidadBach']) : "";
			$promedioBach = isset($_POST['promedioBach']) ? limpiarDatos($_POST['promedioBach']) : "";
			$ceneval = isset($_POST['cenval']) ? limpiarDatos($_POST['ceneval']) : "";
			$estudiar = isset($_POST['estudiar']) ? limpiarDatos($_POST['estudiar']) : "";
			$opcionUni = isset($_POST['opcionUni']) ? limpiarDatos($_POST['opcionUni']) : "";
			$opcionCar = isset($_POST['opcionCar']) ? limpiarDatos($_POST['opcionCar']) : "";
			$carreraEsp = isset($_POST['carreraEsp']) ? limpiarDatos($_POST['carreraEsp']) : "";
			$planExm = isset($_POST['planExm']) ? limpiarDatos($_POST['planExm']) : "";
			$dificultMat = isset($_POST['dificultMat']) ? limpiarDatos($_POST['dificultMat']) : "";
			$reprobado = isset($_POST['reprobado']) ? limpiarDatos($_POST['reprobado']) : "";
			$materiasRep = isset($_POST['materiasRep']) ? limpiarDatos($_POST['materiasRep']) : "";
			$tecnica = isset($_POST['tecnica']) ? limpiarDatos($_POST['tecnica']) : "";
			$cualTec = isset($_POST['cualTec']) ? limpiarDatos($_POST['cualTec']) : "";
			$libros = isset($_POST['libros']) ? limpiarDatos($_POST['libros']) : "";
			$cantLib = isset($_POST['cantLib']) ? limpiarDatos($_POST['cantLib']) : "";
			$computadora = isset($_POST['computadora']) ? limpiarDatos($_POST['computadora']) : "";
			$clvTest = isset($_POST['clvTest']) ? limpiarDatos($_POST['clvTest']) : "";
			$clvTestDec = base64_decode($clvTest);
			$valid1 = $dbConexion -> prepare("SELECT * FROM enctes_alm WHERE id_alumno = :keyAlm && id_enctestalm = :clvTestDec");
			$valid1 -> bindParam(":keyAlm", $keyAlm, PDO::PARAM_INT);
			$valid1 -> bindParam(":clvTestDec", $clvTestDec, PDO::PARAM_INT);
			$valid1 -> execute();
			$resvalid1 = $valid1 -> rowCount();
			if ($resvalid1 === 1) {
				$stmt = $dbConexion -> prepare("UPDATE enctes_alm SET reside = :reside, tiempo_Res = :tiempo, especifica_res = :especifica, vives = :vives, trabajas = :trabajas, donde_trabajas = :donde_trabajas, ingresoTrab = :ingresoTrab, horas_tr = :horas_tr, ingrDependes = :ingrDependes, economicamente = :economicamente, papa = :papa, mama = :mama, hermanos = :hermanos, actividad_herm = :actividad_herm, habitas = :habitas, ingreso_familiar = :ingreso_familiar, padeces = :padeces, especificaEnf = :especificaEnf, frec_enferm = :frec_enferm, espEnf = :espEnf, medicamento = :medicamento, cualMed = :cualMed, fumas = :fumas, cantidadFum = :cantidadFum, alchol = :alchol, cantidadBeb = :cantidadBeb, cualidades = :cualidades, defectos = :defectos, aprecias = :aprecias, disgusta = :disgusta, temor = :temor, novio = :novio, planes = :planes, f_personal = :f_personal, f_academico = :f_academico, f_profesional = :f_profesional, t_libre = :t_libre, bachillerato = :bachillerato, turno = :turno, localidadBach = :localidadBach, entidadBach = :entidadBach, especialidadBach = :especialidadBach, promedioBach = :promedioBach, ceneval = :ceneval, estudiar = :estudiar, opcionUni = :opcionUni, opcionCar = :opcionCar, carreraEsp = :carreraEsp, planExm = :planExm, dificultMat = :dificultMat, reprobado = :reprobado, materiasRep = :materiasRep, tecnica = :tecnica, cualTec = :cualTec, libros = :libros, cantLib = :cantLib, computadora = :computadora WHERE id_alumno = :keyAlm && id_enctestalm = :clvTestDec");
				$stmt -> bindParam("reside", $reside, PDO::PARAM_STR);
				$stmt -> bindParam("tiempo", $tiempo, PDO::PARAM_STR);
				$stmt -> bindParam("especifica", $especifica, PDO::PARAM_STR);
				$stmt -> bindParam("vives", $vives, PDO::PARAM_STR);
				$stmt -> bindParam("trabajas", $trabajas, PDO::PARAM_STR);
				$stmt -> bindParam("donde_trabajas", $donde_trabajas, PDO::PARAM_STR);
				$stmt -> bindParam("ingresoTrab", $ingresoTrab, PDO::PARAM_STR);
				$stmt -> bindParam("horas_tr", $horas_tr, PDO::PARAM_STR);
				$stmt -> bindParam("ingrDependes", $ingrDependes, PDO::PARAM_STR);
				$stmt -> bindParam("economicamente", $economicamente, PDO::PARAM_STR);
				$stmt -> bindParam("papa", $papa, PDO::PARAM_STR);
				$stmt -> bindParam("mama", $mama, PDO::PARAM_STR);
				$stmt -> bindParam("hermanos", $hermanos, PDO::PARAM_STR);
				$stmt -> bindParam("actividad_herm", $actividad_herm, PDO::PARAM_STR);
				$stmt -> bindParam("habitas", $habitas, PDO::PARAM_STR);
				$stmt -> bindParam("ingreso_familiar", $ingreso_familiar, PDO::PARAM_STR);
				$stmt -> bindParam("padeces", $padeces, PDO::PARAM_STR);
				$stmt -> bindParam("especificaEnf", $especificaEnf, PDO::PARAM_STR);
				$stmt -> bindParam("frec_enferm", $frec_enferm, PDO::PARAM_STR);
				$stmt -> bindParam("espEnf", $espEnf, PDO::PARAM_STR);
				$stmt -> bindParam("medicamento", $medicamento, PDO::PARAM_STR);
				$stmt -> bindParam("cualMed", $cualMed, PDO::PARAM_STR);
				$stmt -> bindParam("fumas", $fumas, PDO::PARAM_STR);
				$stmt -> bindParam("cantidadFum", $cantidadFum, PDO::PARAM_STR);
				$stmt -> bindParam("alchol", $alchol, PDO::PARAM_STR);
				$stmt -> bindParam("cantidadBeb", $cantidadBeb, PDO::PARAM_STR);
				$stmt -> bindParam("cualidades", $cualidades, PDO::PARAM_STR);
				$stmt -> bindParam("defectos", $defectos, PDO::PARAM_STR);
				$stmt -> bindParam("aprecias", $aprecias, PDO::PARAM_STR);
				$stmt -> bindParam("disgusta", $disgusta, PDO::PARAM_STR);
				$stmt -> bindParam("temor", $temor, PDO::PARAM_STR);
				$stmt -> bindParam("novio", $novio, PDO::PARAM_STR);
				$stmt -> bindParam("planes", $planes, PDO::PARAM_STR);
				$stmt -> bindParam("f_personal", $f_personal, PDO::PARAM_STR);
				$stmt -> bindParam("f_academico", $f_academico, PDO::PARAM_STR);
				$stmt -> bindParam("f_profesional", $f_profesional, PDO::PARAM_STR);
				$stmt -> bindParam("t_libre", $t_libre, PDO::PARAM_STR);
				$stmt -> bindParam("bachillerato", $bachillerato, PDO::PARAM_STR);
				$stmt -> bindParam("turno", $turno, PDO::PARAM_STR);
				$stmt -> bindParam("localidadBach", $localidadBach, PDO::PARAM_STR);
				$stmt -> bindParam("entidadBach", $entidadBach, PDO::PARAM_STR);
				$stmt -> bindParam("especialidadBach", $especialidadBach, PDO::PARAM_STR);
				$stmt -> bindParam("promedioBach", $promedioBach, PDO::PARAM_STR);
				$stmt -> bindParam("ceneval", $ceneval, PDO::PARAM_STR);
				$stmt -> bindParam("estudiar", $estudiar, PDO::PARAM_STR);
				$stmt -> bindParam("opcionUni", $opcionUni, PDO::PARAM_STR);
				$stmt -> bindParam("opcionCar", $opcionCar, PDO::PARAM_STR);
				$stmt -> bindParam("carreraEsp", $carreraEsp, PDO::PARAM_STR);
				$stmt -> bindParam("planExm", $planExm, PDO::PARAM_STR);
				$stmt -> bindParam("dificultMat", $dificultMat, PDO::PARAM_STR);
				$stmt -> bindParam("reprobado", $reprobado, PDO::PARAM_STR);
				$stmt -> bindParam("materiasRep", $materiasRep, PDO::PARAM_STR);
				$stmt -> bindParam("tecnica", $tecnica, PDO::PARAM_STR);
				$stmt -> bindParam("cualTec", $cualTec, PDO::PARAM_STR);
				$stmt -> bindParam("libros", $libros, PDO::PARAM_STR);
				$stmt -> bindParam("cantLib", $cantLib, PDO::PARAM_STR);
				$stmt -> bindParam("computadora", $computadora, PDO::PARAM_STR);
				$stmt -> bindParam("keyAlm", $keyAlm, PDO::PARAM_INT);
				$stmt -> bindParam("clvTestDec", $clvTestDec, PDO::PARAM_INT);
				$resstmt = $stmt -> execute();
				if ($resstmt) {
					echo "goodUpd";
				} else {
					echo "failUpd";
				}
			} else {
				echo "malDat";
			}
			break;	
		default:
			$dbConexion = null;
			break;
	}
}
