<?php 

session_start();

if ($_SESSION['keyDoc'] == "" || $_SESSION['keyDoc'] == null) {
	header("Location:../Index.php");
} else {
	include '../modelos/docente.modelo.php';
	$docente = new Docentes();
	$keyDoc = $_SESSION['keyDoc'];
	$fechAct = date("Y-m-d");
	$valJustif = $_GET['v'];
	$justifVal = $docente -> validJustif(base64_decode($valJustif));
	if ($justifVal -> ValJustif == 1) {
		$datJustif = $docente -> justifDat(base64_decode($valJustif));
		$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
		$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
		$Fecha = $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y');

		require '../vistas/pdf/fpdf.php';

		$pdf = new FPDF();
		$pdf -> AddPage();
		$pdf -> SetFont('Arial','B',14);
		$pdf -> Image('../vistas/img/gob1.jpg',5,7,45);
		$pdf -> Image('../vistas/img/utsemlog.jpg',156,20,30);
		$pdf -> SetFont("Arial","",10);
		$pdf -> Ln(); $pdf -> Ln(); $pdf -> Ln(); $pdf -> Ln();
		$pdf -> Ln(); $pdf -> Ln();
		$pdf -> Cell(190, 10,"", 0, 0, 'C');
		$pdf -> Ln(); $pdf -> Ln();
		$pdf -> Cell(190, 10,"", 0, 0, 'C');
		$pdf -> Ln(); $pdf -> Ln(); $pdf -> Ln();
		$pdf -> Cell(190, 10, utf8_decode('Tejupilco de Hidalgo, '.$Fecha), 0, 0, 'R');
		$pdf -> Ln(); $pdf -> Ln(); $pdf -> Ln();
		$pdf -> SetFont('Arial', 'B', 10);
		$pdf -> Cell(50, 4, utf8_decode('PROFESORES DE TIEMPO COMPLETO'),0, 0, 'L');
		$pdf -> Ln();
		$pdf -> Cell(50, 4, utf8_decode('Y DE ASIGNATURA'),0, 0, 'L');
		$pdf -> Ln();
		$pdf -> Cell(50, 4, utf8_decode('P R E S E N T E:'),0, 0, 'L');
		$pdf -> Ln(); $pdf -> Ln(); $pdf -> Ln(); $pdf -> Ln(); $pdf -> Ln(); $pdf -> Ln();
		$pdf -> SetFont('Arial', '', 10);
		$pdf -> MultiCell(190, 4, utf8_decode('Por este medio me dirijo a usted para informarle que el alumno(a): '.$datJustif->nombre_c_al.' de la carrera Ingeniería en '.$datJustif->nombre_car.', quien cursa actualmente el '.$datJustif->cuatrimestre_justif.' cuatrimestre, no asistió a clases en la fecha '.$datJustif->fecha_justif.' por cuestiones de '.$datJustif->situacion_justif.' por lo cual le pido tenga la amabilidad de justificar sus faltas, trabajos o tareas pendientes, con la obligación del alumno de actualizarse en las actividades correspondientes.'),0, 'J', 0);
		$pdf -> Ln(); $pdf -> Ln(); $pdf -> Ln(); $pdf -> Ln(); $pdf -> Ln();
		$pdf -> Cell(100, 4, utf8_decode('Sin otro particular, reciba un cordian saludo y quedo de usted para cualquier aclaración.'), 0, 0, 'L');
		$pdf -> Ln(); $pdf -> Ln(); $pdf -> Ln(); $pdf -> Ln(); $pdf -> Ln(); $pdf -> Ln();
		$pdf -> SetX(0); $pdf -> SetFont('Arial','B',10);
		$pdf -> Cell(200, 4, utf8_decode('A T E N T A M E N T E'), 0, 0, 'C');
		$pdf -> Line(50, 198, 155, 198);
		$pdf -> Ln(); $pdf -> Ln(); $pdf -> Ln(); $pdf -> Ln(); $pdf -> Ln();
		$pdf -> SetX(0);
		$pdf -> Cell(200, 4, utf8_decode(strtoupper($datJustif->nombre_c_doc)), 0, 0, 'C');
		$pdf -> Ln(); $pdf -> Ln(); $pdf -> Ln();
		$pdf -> SetX(0);
		$pdf -> Cell(200, 4, utf8_decode('TUTOR DE GRUPO'), 0, 0, 'C');
		$pdf -> Ln(); $pdf -> Ln(); $pdf -> Ln(); $pdf -> Ln(); 
		$pdf -> Ln(); $pdf -> Ln(); $pdf -> Ln(); $pdf -> Ln();
		$pdf -> Ln(); $pdf -> Ln(); 
		$pdf -> SetFont('Arial', '', 7.5);
		$pdf -> SetX(0);
		$pdf -> Cell(105, 4, utf8_decode('SISTEMA DE EDUCACIÓN'), 0, 0, 'R');
		$pdf -> Cell(105, 4, utf8_decode('EXHACIENDA DE SAN MIGUEL IXTAPAN, KM 12 CARRETERA TEJUPILCO'), 0, 0, 'L');
		$pdf -> Ln();
		$pdf -> SetX(0);
		$pdf -> Cell(105, 4, utf8_decode('SUBSECRETARÍA DE EDUCACIÓN MEDIA SUPERIOR Y SUPERIOR'), 0, 0, 'R');
		$pdf -> Cell(105, 4, utf8_decode('- AMATEPEC, TEJUPILCO, ESTADO DE MÉXICO'), 0, 0, 'L');
		$pdf -> Ln();
		$pdf -> SetX(0);
		$pdf -> Cell(105, 4, utf8_decode('UNIVERSIDAD TECNOLÓGICA DEL SUR DEL ESTADO DE MÉXICO'), 0, 0, 'R');
		$pdf -> Cell(105, 4, utf8_decode('TELS 0172426 269-40-16 AL 24, FAX: EXT. 207'), 0, 0, 'L');
		$pdf -> Ln();
		$pdf -> SetX(0);
		$pdf -> Cell(105, 4, utf8_decode(''), 0, 0, 'R');
		$pdf -> Cell(105, 4, utf8_decode('http://www.utsem.edu.mx'), 0, 0, 'L');
		$pdf -> Output('I','JustifAlm.pdf',true);
		
	} else {

	}
}


