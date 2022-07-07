<?php 

session_start();

ob_start();

if ($_SESSION['keyDoc'] == "" || $_SESSION['keyDoc'] == null) {
	header("Location:../Index.php");
} else {
	include '../modelos/docente.modelo.php';
	$docente = new Docentes();
	$keyDoc = $_SESSION['keyDoc'];
	$valJustif = $_GET['v'];
	//$valJustifDec = base64_decode($valJustif);
	$fechAct = date("Y-m-d");
	$valid = "SELECT * FROM justificantes WHERE id_justificante = '".base64_decode($valJustif)."'";
	$resValid = $conexion -> query($valid);
	$filResValid = mysqli_num_rows($resValid);
	if ($filResValid === 1) {
		$consult = "SELECT * FROM justificantes jus 
		INNER JOIN alumnos alm ON alm.id_alumno = jus.id_alumno
		INNER JOIN det_grupo det ON det.id_detgrupo = alm.id_detgrupo
		INNER JOIN carreras car ON car.id_carrera = det.id_carrera
		INNER JOIN docentes doc ON doc.id_docente = det.id_docente
		WHERE jus.id_justificante = '".base64_decode($valJustif)."' ";
		$resConsult = $conexion -> query($consult);
		$filResConsult = mysqli_num_rows($resConsult);
		if ($filResConsult === 1) {
			$rowJus = mysqli_fetch_array($resConsult);
?>
	<style type="text/css">
		#divB-1 {
		position:relative;
	    height:60px;
	    margin-left: 50px;
		}
		#divB-1b {
			position:absolute;
		    top:0;
		    left:0;
		    width:500px;
		}
		#divC-1 {
			position:relative;
		    height:130px;
		    margin-left: 50px;
		    margin-right: 50px;
		}
		#divC-1b {
			position:absolute;
		    top:0;
		    left:0;
		    width:654px;
		}
		#div-1 {
		    position:relative;
		    height:60px;
		}
		#div-1a {
		    position:absolute;
		    top:0;
		    right:0;
		    width:270px;
		    margin-right: 80px;
		}
		#div-1b {
		    position:absolute;
		    top:0;
		    left:0;
		    width:320px;
		    margin-left: 80px;
		    text-align: right;
		}
		.fot {
			font-size: 9px;
			margin: 0px;
		}
	</style>
	
	<page>
		<img style="margin-left: 80px;" src="../vistas/img/gob1.jpg" width="170"/>
		<img style="margin-left: 250px; margin-top: 40px;" src="../vistas/img/utsem.png" width="170"/>
		<br>
		<?php 	
			$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
			$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
		   	$Fecha = $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y');
		?>
		<p style="margin-left: 400px;"><?php echo "Tejupilco de Hidalgo, ".$Fecha; ?>.</p>
		<br><br><br>
		<div id="divB-1">
			<div id="divB-1b">
				<b style="padding: 5px;">PROFESORES DE TIEMPO COMPLETO</b>
				<br>
				<b style="padding: 5px;">Y DE ASIGNATURA.</b><br>
				<b style="padding: 5px;">P R E S E N T E:</b>
			</div>
		</div>
		<br><br>
		<div id="divC-1">
			<div id="divC-1b">
				<p style="font-size: 14px; text-align: justify;">
					Por este medio me dirijo a usted para informarle que el alumno(a): <b><?php echo $nombAlm = $rowJus['nombre_c_al']; ?></b>
					de la carrera Ingeniería en <b><?php echo $carrera = $rowJus['nombre_car']; ?></b>
					, quien cursa actualmente el <b><?php echo $cuat = $rowJus['cuatrimestre_justif']; ?></b>
					cuatrimestre, no asistió a clases en la fecha <b><?php echo $fechreg = $rowJus['fecha_justif']; ?></b>
					por cuestiones de <b><?php echo $situacion = $rowJus['situacion_justif']; ?></b>, por lo cual
					le pido tenga la amabilidad de justificar sus faltas, trabajos o tareas pendientes,
					con la obligación del alumno de actualizarse en las actividades correspondientes.
				</p>
				<br><br><br>
				<p style="font-size: 14px;">
					Sin otro particular, reciba un cordian saludo y quedo de usted para cualquier aclaración.
				</p>
			</div>
		</div>
		<br><br><br><br><br><br><br><br><br><br><br><br><br>
	<b style="margin-left:  300px; margin-right: 300px;">A T E N T A M E N T E</b>
	<br><br><br>
	<b style="margin-left: 230px;">______________________________________</b>
	<br><br>
	<b style="margin-left: 310px; "><?php echo strtoupper($NDocente = $rowJus['nombre_c_doc']); ?></b>
	<br><br>
	<b style="margin-left: 310px;">TUTOR DE GRUPO</b>
	<br><br><br><br><br><br>
	<br><br><br><br>
	<br><br><br><br>
	<div id="div-1">
		<div id="div-1b">
			<p class="fot">SISTEMA DE EDUCACIÓN</p>
			<p class="fot">SUBSECRETARÍA DE EDUCACIÓN MEDIA SUPERIOR Y SUPERIOR</p>
			<p class="fot">UNIVERSIDAD TECNÓLOGICA DEL SUR DEL ESTADO DE MÉXICO</p>
		</div>
		<div id="div-1a">
			<p class="fot">EXHACIENDA DE SAN MIGUEL IXTAPAN, KM 12 CARRETERA TEJUPILCO</p>
			<p class="fot">- AMATEPEC, TEJUPILCO, ESTADO DE MÉXICO</p>
			<p class="fot">TELS 0172426 269-40-16 AL 24, FAX: EXT. 207</p>
			<p class="fot"><b>http://www.utsem.edu.mx</b></p>
		</div>
	</div>
	</page>

<?php
		} else {
			header("Location:../vistas/modulos/doc/Logout.php");
			$conexion = null; $consult = null; $resConsult = null;
		}		
	} else {
		header("Location:../vistas/modulos/doc/Logout.php");
		$conexion = null; $valid = null; $resValid = null;
	}
	
}

$content = ob_get_clean();
include '../vistas/html/html2pdf.class.php';
$pdf = new HTML2PDF('P','A4','fr','UTF-8');
$pdf->writeHTML($content);
$pdf->pdf->IncludeJS('print(TRUE)');
$pdf->output('justificante.pdf');
