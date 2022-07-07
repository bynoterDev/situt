<?php 

session_start();

if ($_SESSION['keyDoc'] == "" || $_SESSION['keyDoc'] == null) {
	header("Location:../../");
} else {
	include '../../modelos/docente.modelo.php';
	include '../../modelos/rutasAmig.php';
	$docente = new Docentes();
	$keyDoc = $_SESSION['keyDoc'];
	$fechAct = date("Y-m-d");
	$keyBaj = $_GET['v'];
	$clvAlp = $_GET['p'];
	$grp = $_SESSION["clvGrp"];
	$datBajVal = $docente -> datBajAlmValid(base64_decode($keyBaj));
	if ($datBajVal -> CantVal == 1) {
		$datAlm = $docente -> datAlmAll(base64_decode($clvAlp));
		$datEnc = $docente -> datEncBaj(base64_decode($clvAlp));
		$datBaj = $docente -> datBajAlm(base64_decode($keyBaj));
		$datBec = $docente -> datBecAlm(base64_decode($clvAlp));
		$id_car = $docente -> datGrpSel($keyDoc, $grp);
		$datDir = $docente -> dirNomb($id_car->id_carrera);

		require '../../vistas/pdf/fpdf.php';

		$pdf = new FPDF();
		$pdf -> AddPage();
		$pdf -> SetFont('Arial','B',14);
		$pdf -> Image('../../vistas/img/utsemlog.jpg',5,4,25);
		$pdf -> Cell(200, 10, utf8_decode('Universidad Tecnológica del Sur del Estado de México'), 0, 0, 'C');
		$pdf -> SetDrawColor(29, 131, 72);
		$pdf -> SetLineWidth(1);
		$pdf -> Line(20,25,190,25);
		$pdf -> Ln(); $pdf -> Ln();
		$pdf -> SetFont('Arial', 'B', 14);
		$pdf -> Cell(200, 4, utf8_decode('REGISTRO DE BAJA DE ALUMNO'), 0, 0, 'C');
		$pdf -> Ln(); $pdf -> Ln();
		$pdf -> SetFont('Arial','',8);
		$pdf -> SetX(4);
		$pdf -> Cell(50, 4, utf8_decode('Fecha de solicitud de la baja :'), 0, 0, 'L');
		$pdf -> SetDrawColor(0,0,0);
		$pdf -> SetLineWidth(0.1);
		$pdf -> SetFont('Arial','B',8);
		$pdf -> Cell(60, 4, utf8_decode($datBaj->fecha_reg_baj), 1, 0, 'C');
		$pdf -> SetFont('Arial','B',8);
		$pdf -> Ln(); $pdf -> Ln();
		$pdf -> SetLineWidth(0.5);
		$pdf -> Line(0, 44, 250, 44);
		$pdf -> Cell(200, 4, utf8_decode('SERVICIOS ESCOLARES'), 0, 0, 'C');
		$pdf -> Ln(); $pdf -> Ln();
		$pdf -> SetFont('Arial', '', 8);
		$pdf -> SetX(2);
		$pdf -> Cell(60, 4, utf8_decode('Folio Num. ______________________'), 0, 0, 'C');
		$pdf -> Cell(73, 4, utf8_decode('Fecha de Autorización: ______________________'), 0, 0, 'C');
		$pdf -> Cell(68, 4, utf8_decode('Sello de Servicios Escolares'), 0, 1, 'C');
		$pdf -> Ln(); $pdf -> Ln();
		$pdf -> Line(0, 60, 250, 60);
		$pdf -> Line(0, 62, 250, 62);
		$pdf -> SetFont('Arial', 'B', 8);
		$pdf -> Cell(200, 1, utf8_decode('SERVICIOS ESTUDIANTILES'), 0, 1, 'C');
		$pdf -> Ln(); $pdf -> Ln();
		$pdf -> SetFont('Arial', '', 8);
		$pdf -> SetX(5);
		$pdf -> Cell(35, 6, utf8_decode('Cuenta con beca(s) :'), 0, 0, 'L');
		if ($datBec) {
			$pdf -> Cell(20, 6, utf8_decode('SI ( X )'), 0, 0, 'C');
			$pdf -> Cell(17, 6, utf8_decode('Cual(ES):'), 0, 0, 'L');
			$pdf -> SetFont('Arial', 'U', 8);
			$pdf -> Cell(60, 6, utf8_decode('_________'.$datBec->tipo_beca_alm.'_________'), 0, 0, 'L');
			$pdf -> SetFont('Arial', '', 8);
			$pdf -> Cell(20, 6, utf8_decode('NO ( )'), 0, 0, 'C');
		} else {
			$pdf -> Cell(20, 6, utf8_decode('SI ( )'), 0, 0, 'C');
			$pdf -> Cell(122, 6, utf8_decode('Cual(ES):______________________________________________________'), 0, 0, 'C');
			$pdf -> Cell(20, 6, utf8_decode('NO ( X )'), 0, 0, 'C');
		}
		$pdf -> Line(0, 76, 250, 76);
		$pdf -> Line(0, 78, 250, 78);
		$pdf -> Ln(); $pdf -> Ln();
		$pdf -> SetFont('Arial', 'B', 8);
		$pdf -> SetX(5);
		$pdf -> Cell(50, 8, utf8_decode('I.   DATOS GENERALES DEL ALUMNO'), 0, 0, 'L');
		$pdf -> Ln(); $pdf -> Ln();
		$pdf -> SetFont('Arial', '', 8);
		$pdf -> SetX(5);
		$pdf -> Cell(25, 4, utf8_decode('Nombre:'), 0, 0, 'L');
		//$pdf -> SetFont('Arial', 'B', 10);
		$pdf -> Cell(73, 4, utf8_decode($datAlm->nombre_c_al), 0, 0, 'L');
		$pdf -> SetLineWidth(0.0);
		$pdf -> Line(30, 101, 200, 101);
		$pdf -> Ln(); $pdf -> Ln();
		$pdf -> SetFont('Arial', '', 8);
		$pdf -> SetX(5);
		$pdf -> Cell(25, 4, utf8_decode('Matricula:'), 0, 0, 'L');
		//$pdf -> SetFont('Arial', 'B', 10);
		$pdf -> Cell(93, 4, utf8_decode($datAlm->matricula_al), 0, 0, 'L');
		$pdf -> Line(30, 109, 100, 109);
		$pdf -> SetFont('Arial', '', 8);
		$pdf -> Cell(40, 4, utf8_decode('Grupo Escolar:'), 0, 0, 'L');
		$pdf -> SetFont('Arial', 'U', 8);
		$pdf -> Cell(10, 5, utf8_decode("          ".$datAlm->grupo_n."          "), 0, 0, 'C');
		$pdf -> Ln(); $pdf -> Ln();
		$pdf -> SetFont('Arial', '', 8);
		$pdf -> SetX(5);
		$pdf -> Cell(25, 4, utf8_decode('Carrera:'), 0, 0, 'L');
		$pdf -> Cell(93, 4, utf8_decode($datAlm->nombre_car), 0, 0, 'L');
		$pdf -> Line(30, 119, 120, 119);
		$pdf -> Cell(40, 4, utf8_decode('Firma del Alumno:'), 0, 0, 'L');
		$pdf -> Cell(10, 5, utf8_decode("_______________________"), 0, 0, 'C');
		$pdf -> Ln(); $pdf -> Ln();
		$pdf -> SetX(5);
		$pdf -> Cell(100, 4, utf8_decode('¿Pertenecía el alumno a algún grupo altamente vulnerable?'), 0, 0, 'L');
		if ($datEnc->opcion1 != "" || $datEnc->opcion2 != "" || $datEnc->opcion3 != "") {
			$pdf -> Cell(15, 4, utf8_decode('SI ( X )'), 0, 0, 'L');
			$pdf -> Cell(15, 4, utf8_decode('NO (  )'), 0, 0, 'L');
		} else {
			$pdf -> Cell(15, 4, utf8_decode('SI ( )'), 0, 0, 'L');
			$pdf -> Cell(15, 4, utf8_decode('NO ( X )'), 0, 0, 'L');
		}
		$pdf -> Ln(); $pdf -> Ln();
		$pdf -> SetX(5);
		$pdf -> Cell(100, 4, utf8_decode('Si la respuesta es afirmativa, marque en los paréntesis correspondientes en que grupos altamente vulnerables estuvo registrado.'), 0, 0, 'L');
		$pdf -> Ln(); $pdf -> Ln();
		$pdf -> SetX(5);
		$pdf -> SetFont('Arial', '', 7.5);
		if ($datEnc->opcion3 != "") {
			$pdf -> Cell(67, 4, utf8_decode('a) POR PROBLEMAS ACADÉMICOS ( X )'), 0, 0, 'L');
		} else {
			$pdf -> Cell(67, 4, utf8_decode('a) POR PROBLEMAS ACADÉMICOS ( )'), 0, 0, 'L');
		}
		if ($datEnc->opcion1 != "") {
			$pdf -> Cell(67, 4, utf8_decode('b) POR PROBLEMAS ECONÓMICOS ( X )'), 0, 0, 'L');
		} else {
			$pdf -> Cell(67, 4, utf8_decode('b) POR PROBLEMAS ECONÓMICOS ( )'), 0, 0, 'L');
		}
		if ($datEnc-> opcion2 != "") {
			$pdf -> Cell(67, 4, utf8_decode('c) POR PROBLEMAS PERSONALES ( X )'), 0, 0, 'L');
		} else {
			$pdf -> Cell(67, 4, utf8_decode('c) POR PROBLEMAS PERSONALES ( )'), 0, 0, 'L');
		}
		$pdf -> SetLineWidth(0.5);
		$pdf -> Line(0, 146, 250, 146);
		$pdf -> Line(0, 148, 250, 148);
		$pdf -> Ln(); $pdf -> Ln();
		$pdf -> SetFont('Arial', 'B', 8);
		$pdf -> SetX(5);
		$pdf -> Cell(50, 8, utf8_decode('II.   INFORMACIÓN SOBRE LA BAJA'), 0, 0, 'L');
		$pdf -> Ln(); $pdf -> Ln();
		$pdf -> SetFont('Arial', '', 8);
		$pdf -> SetX(5);
		if ($datBaj->tipobaja == "BAJA DEFINITIVA") {
			$pdf -> Cell(37, 4, utf8_decode('BAJA DEFINITIVA ( X )'), 0, 0, 'L');
			$pdf -> Cell(40, 4, utf8_decode('BAJA TEMPORAL ( )'), 0, 0, 'L');
		} else {
			$pdf -> Cell(37, 4, utf8_decode('BAJA DEFINITIVA ( )'), 0, 0, 'L');
			$pdf -> Cell(40, 4, utf8_decode('BAJA TEMPORAL ( X )'), 0, 0, 'L');
		}
		$pdf -> Cell(55, 4, utf8_decode('Periodo de reincorporación:'), 0, 0, 'L');
		$pdf -> SetFont('Arial', 'U', 8);
		$pdf -> Cell(37, 4, utf8_decode("        ".$datBaj->periodo."        "), 0, 0, 'L');
		$pdf -> Ln(); $pdf -> Ln();
		$pdf -> SetX(5);
		$pdf -> SetFont('Arial', '', 8);
		$pdf -> Cell(85, 4, utf8_decode('¿LA BAJA FUE SOLICITADA POR EL ALUMNO?'), 0, 0, 'L');
		if ($datBaj->bajasolicitada == "SI") {
			$pdf -> Cell(15, 4, utf8_decode('SI ( X )'), 0, 0, 'L');
			$pdf -> Cell(15, 4, utf8_decode('NO (  )'), 0, 0, 'L');
		} else {
			$pdf -> Cell(15, 4, utf8_decode('SI ( )'), 0, 0, 'L');
			$pdf -> Cell(15, 4, utf8_decode('NO ( X )'), 0, 0, 'L');
		}
		$pdf -> Ln(); $pdf -> Ln();
		$pdf -> SetFont('Arial', 'B', 8);
		$pdf -> SetX(5);
		$pdf -> Cell(40, 4, utf8_decode('MOTIVO DE LA BAJA'), 0, 0, 'L');
		$pdf -> SetFont('Arial', '', 8);
		$pdf -> SetLineWidth(0.2);
		$pdf -> MultiCell(150, 4.5, utf8_decode($datBaj->motivo_baja), 1, 'L', 0);
		if (strlen($datBaj->motivo_baja) >= 440) {
			$pdf -> Ln(); $pdf -> Ln();
		}
		if (strlen($datBaj->motivo_baja) >= 240 && strlen($datBaj->motivo_baja) <= 350) {
			$pdf -> Ln(); $pdf -> Ln(); $pdf -> Ln();
		} 
		if (strlen($datBaj->motivo_baja) >= 124 && strlen($datBaj->motivo_baja) <= 240) {
			$pdf -> Ln(); $pdf -> Ln(); $pdf -> Ln(); $pdf -> Ln(); 
		}
		if (strlen($datBaj->motivo_baja) > 0 && strlen($datBaj->motivo_baja) <= 118) {
			$pdf -> Ln(); $pdf -> Ln(); $pdf -> Ln(); $pdf -> Ln(); $pdf -> Ln();
		}
		$pdf -> SetLineWidth(0.5);
		$pdf -> Line(0, 210, 250, 210);
		$pdf -> Line(0, 220, 250, 220);
		$pdf -> Ln(); $pdf -> Ln(); $pdf -> Ln(); $pdf -> Ln();
		$pdf -> SetX(5);
		$pdf -> SetFont('Arial', '', 10);
		$pdf -> Cell(100, 20, utf8_decode($datAlm->nombre_c_doc), 1, 0, 'C');
		$pdf -> Cell(100, 20, utf8_decode($datDir->nombre_c_dir), 1, 0, 'C');
		$pdf -> Ln();
		$pdf -> SetX(5);
		$pdf -> SetFont('Arial','B',10);
		$pdf -> Cell(100, 5, utf8_decode('TUTOR'), 1, 0, 'C');
		$pdf -> Cell(100, 5, utf8_decode('DIRECTOR DE CARRERA'), 1, 0, 'C');
		$pdf -> Ln();
		$pdf -> SetX(5);
		$pdf -> Cell(100, 20, utf8_decode(''), 1, 0, 'C');
		$pdf -> Cell(100, 20, utf8_decode(''), 1, 0, 'C');
		$pdf -> Ln();
		$pdf -> SetX(5);
		$pdf -> Cell(100, 5, utf8_decode('JEFE DE DEPARTAMENTO DE CONTABILIDAD'), 1, 0, 'C');
		$pdf -> Cell(100, 5, utf8_decode('JEFE DEL DEPARTAMENTO DE SERVICIOS ESCOLARES'), 1, 0, 'C');
		$pdf -> Output('I','BajaAlumno'.$datAlm->nombre_c_al.'.pdf',true);

	} else {
		header("Location:".SERVERURLDOC."doc/Logout.php");
	}	
}


