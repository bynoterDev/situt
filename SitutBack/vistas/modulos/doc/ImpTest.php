<?php 

session_start();
ob_start();
if ($_SESSION['keyDoc'] == "" || $_SESSION['keyDoc'] == null) {
	header("Location:../Index.php");
} else {
	$datObt = base64_decode($_GET['v']);
	include '../modelos/docente.modelo.php';
	$docente = new Docentes();
	$dtest = $docente -> dataImpTest($datObt);
	$fechAct = date("Y-m-d");
	if ($dtest) {
?>
	<style type="text/css">
		#div-1fot {
		    position:relative;
		    height:20px;
		}
		#div-1afot {
		    position:absolute;
		    top:0;
		    right:0;
		    width:100px; 
		}
		#div-1bfot {
		    position:absolute;
		    top:0;
		    left:0;
		    width:600px; 
		}
		.div {
			border: 2px; border-color: black; padding: 7px;
		}
		.label {
			margin-left: 120px;
		}
		#div-1 {
		    position:relative;
		    height:200px;
		    margin-left: 50px;	
		}
		#div-1a {
		    position:absolute;
		    top:0;
		    right:0;
		    width:300px;
		}
		#div-1b {
		    position:absolute;
		    top:0;
		    left:0;
		    width:400px;
		}
		#divA-1 {
			position:relative;
		    height:280px;
		    margin-left: 50px;	
		    
		}
		#divA-1b {
			position:absolute;
		    top:0;
		    left:0;
		    width:700px;
		    
		}
		#divB-1 {
			position:relative;
		    height:280px;
		    margin-left: 50px;	
		}
		#divB-1b {
			position:absolute;
		    top:0;
		    left:0;
		    width:700px;
		}
		#divBB-1 {
			position:relative;
		    height:240px;
		    margin-left: 50px;	
		}
		#divBB-1b {
			position:absolute;
		    top:0;
		    left:0;
		    width:700px;
		}
		#divC-1 {
			position:relative;
		    height:440px;
		    margin-left: 50px;
		}
		#divC-1b {
			position:absolute;
		    top:0;
		    left:0;
		    width:700px;
		}
		#divd-1 {
			position:relative;
		    height:440px;
		    margin-left: 30px;
		    /*background-color: red;*/
		}
		#divd-1b {
			position:absolute;
		    top:0;
		    left:0;
		    width:700px;
		    /*background-color: green;*/
		}
		.titleAsp {
			text-align: left;
		}
		h5 {
			margin: 0px;
		}
	</style>
	<page>
	<img src="../vistas/img/utsemlog.jpg" width="100">
	<b style="font-size: 20px; margin-left: 50px;">Universidad Tecnológica del Sur del Estado de México.</b> 
	<hr style="height: 3px; background-color: black;">
	<h4 style="text-align: center;"><b>ENTREVISTA INICIAL PARA TUTORIAS</b></h4>
	<br><br>
	<div id="div-1">
		<div id="div-1b">
			<label>Nombre: <b><?php echo $dtest->nombre_c_al; ?>.</b></label>
			<br><br>
			<label>Matricula: <b><?php echo $dtest->matricula_al; ?>.</b></label>
			<br><br>
			<label>Carrera: <b><?php echo $dtest->nombre_car; ?>.</b></label>
			<br><br>
			<label>Grupo Escolar: <b><?php echo $dtest->grupo_n; ?>.</b></label>
			<br><br>
			<label>Nombre del tutor: <b><?php echo $dtest->nombre_c_doc; ?>.</b></label>
			<br><br>
			<label>CURP: <b><?php echo $dtest->curp_dat; ?>.</b></label>
		</div>
		<div id="div-1a">
			<label class="">Direccion: <b><?php echo $dtest->calle_dat_act.", ".$dtest->colonia_dat_act; ?>.</b> </label>
			<br><br>
			<label class="">Teléfono: <b><?php echo $dtest->telefono_casa_dat; ?>.</b></label>
			<br><br>
			<label class="">Celular: <b><?php echo $dtest->telefono_al; ?>.</b></label>
			<br><br>
			<label class="">Estado Civil: <b><?php echo $dtest->estado_civil_dat; ?>.</b></label>
			<br><br>
			<label class="">Edad: <b><?php echo $dtest->edad_dat; ?>.</b></label>
		</div>
	</div>
	<div class="div">
		<h5 class="titleAsp"><b>I. ASPECTOS SOCIOECONOMICOS</b></h5>
	</div>
	<br>
	<div id="divA-1">
		<div id="divA-1b">
			<label>¿Resides en esta ciudad? <b><?php echo $dtest->reside; ?>.</b></label>
			<br><br>
			<?php 
				if ($dtest->reside == "Si") {
			?>
			<label>Tiempo: <b><?php echo $dtest->tiempo_Res; ?>.</b></label>
			<?php
				} else {
			?>
			<label>Especifica: <b><?php echo $dtest->especifica_res; ?>.</b></label>
			<?php
				}
			?>
			<br><br>
			<label>¿Con quien vives actualmente? <b><?php echo $dtest->vives; ?>.</b></label>
			<br><br>
			<label>¿Trabajas? <b><?php echo $dtest->trabajas; ?></b></label>
			<br><br>
			<?php 
				if ($dtest->trabajas == "Si") {
			?>
			<label>En donde: <b><?php echo $dtest->donde_trabajas; ?>.</b></label>
			<label style="margin-left: 10px;">Ingreso: <b><?php echo $dtest->ingresoTrab; ?>.</b></label>
			<label style="margin-left: 10px;">Horas semanales: <b><?php echo $dtest->horas_tr; ?>.</b></label>
			<?php
				} else {
			?>
			<label>Ingreso Mensual: <b><?php echo $dtest->ingrDependes; ?>.</b></label>
			<?php		
				}
			?>
			<br><br>
			<label>¿De quien dependes economicamente? <b><?php echo $dtest->economicamente; ?>.</b></label>
			<br><br>
			<label>¿A que se dedica tu Papá? <b><?php echo $dtest->papa; ?>.</b></label>
			<label style="margin-left: 10px;">¿A que se dedica tu Mamá? <b><?php echo $dtest->mama; ?>.</b></label>
			<br><br>
			<label>Si tienes hermanos señala cuantos son: <b><?php echo $dtest->hermanos; ?>.</b></label>
			<br><br>
			<label>Señala la actividad de cada uno de ellos:<b><?php echo $dtest->actividad_herm; ?>.</b></label>
			<br><br>
			<label>La casa que habitas es: <b><?php echo $dtest->habitas; ?>.</b></label>
			<label style="margin-left: 10px;">Ingreso Mensual Familiar (Aproximado): <b><?php echo $dtest->ingreso_familiar; ?>.</b></label>
		</div>
	</div>
	<br><br>
	<div class="div">
		<h5 class="titleAsp">II. ASPECTOS PERSONALES</h5>
	</div>
	<br>
	<div id="divB-1">
		<div id="divB-1b">
			<label>1. ¿Padeces de alguna enfermedad o alergia? <b><?php echo $dtest->padeces; ?>.</b></label>
			<?php 
				if ($dtest->padeces == "Si") {
			?>
			<label style="margin-left: 10px;">Especifica: <b><?php echo $dtest->especificaEnf; ?>.</b></label>
			<?php		
				}
			?>
			<br><br>
			<label>2. ¿Con qué frecuencia presentas enfermedades menores como gripe, infecciones estomacales, dolores de cabeza, etc? <b><?php echo $dtest->frec_enferm." ".$dtest->espEnf; ?>.</b></label>
			<br><br>
			<label>
				3. De los siguientes aspectos, indique el aspecto que observa en el alumno de forma evidente:
				<br><br> 
				<b>
					<?php echo ($dtest->obesidad != "") ? $dtest->obesidad.", ": ""; ?>
					<?php echo ($dtest->delgadezExt != "") ? $dtest->delgadezExt.", ": ""; ?>
					<?php echo ($dtest->manchasPiel != "") ? $dtest->manchasPiel.", ": ""; ?>
					<?php echo ($dtest->faltaEnergia != "") ? $dtest->faltaEnergia.", ": ""; ?>
					<?php echo ($dtest->problemDen != "") ? $dtest->problemDen.", ": ""; ?>
					<?php echo ($dtest->problemVis != "") ? $dtest->problemVis.", ": ""; ?>
					<?php echo ($dtest->problemAud != "") ? $dtest->problemAud.", ": ""; ?>
					<?php echo ($dtest->discapacidades != "") ? $dtest->discapacidades.", ": ""; ?>
					<?php echo ($dtest->otro != "") ? $dtest->otro : ""; ?>
				</b>
			</label>
			<br><br>
			<label>4. ¿Tomas algún medicamento periodicamente? <b><?php echo $dtest->medicamento; ?>.</b></label>
			<?php 
				if ($dtest->medicamento == "Si") {
			?>
			<label style="margin-left: 10px;">¿Cual? <b><?php echo $dtest->cualMed; ?>.</b></label>
			<?php
				}
			?>
			<br><br>
			<label>5. ¿Fumas? <b><?php echo $dtest->fumas; ?>.</b></label>
			<?php 
				if ($dtest->fumas == "Si") {		
			?>
			<label style="margin-left: 10px;">Cantidad y Frecuencia: <b><?php echo $dtest->cantidadFum; ?>.</b></label>
			<?php	}
			?>
			<br><br>
			<label>6. ¿Ingieres bebidas alchólicas? <b><?php echo $dtest->alchol; ?>.</b></label>
			<?php 
				if ($dtest->alchol == "Si") {
			?>
			<label style="margin-left: 10px;">Cantidad y Frecuencia: <b><?php echo $dtest->cantidadBeb; ?>.</b></label>
			<?php	}
			?>
			<br><br>
			<label>7. ¿Cuáles consideras que son tus principales cualidades? <b><?php echo $dtest->cualidades; ?>.</b></label>
			<br><br>
			<label>8. ¿Cuáles consideras queson tus principales defectos? <b><?php echo $dtest->defectos; ?>.</b></label>
		</div>
	</div>
	<br>
	<div id="div-1fot">
		<div id="div-1bfot">
			<b>FE: <?php echo $fechAct; ?></b>
			<label style="margin-left: 250px;">Pagina 1 de 3</label>
		</div>
		<div id="div-1afot">
			<b>FO-DIC-43/02</b>
		</div>
	</div>
	<img src="../vistas/img/utsemlog.jpg" width="100">
	<b style="font-size: 20px; margin-left: 50px;">Universidad Tecnológica del Sur del Estado de México.</b> 
	<hr style="height: 3px; background-color: black;">
	<h4 style="text-align: center;"><b>ENTREVISTA INICIAL PARA TUTORIAS</b></h4>
	<br><br>
	<div id="divBB-1">
		<div id="divBB-1b">
			<label>9. ¿Qué valores aprecias más en la gente? <b><?php echo $dtest->aprecias; ?>.</b></label>
			<br><br>
			<label>10. ¿Qué es lo que más te disgusta de la gente? <b><?php echo $dtest->disgusta; ?>.</b></label>
			<br><br>
			<label>11. Señala res situaciones o aspectos que te provocan temor: <b><?php echo $dtest->temor; ?>.</b></label>
			<br><br>
			<label>12. ¿Actualmente tienes novio(a)? <b><?php echo $dtest->novio; ?>.</b></label>
			<label style="margin-left: 10px;">13. ¿Tienes planes de matrinomio en el corto plazo? <b><?php echo $dtest->planes; ?>.</b></label>
			<br><br>
			<label>14. ¿Qué planes tienes para tu futuro personal? <b><?php echo $dtest->f_personal; ?>.</b></label>
			<br><br>
			<label>15. ¿Qué planes tienes para tu futuro académico? <b><?php echo $dtest->f_academico; ?>.</b></label>
			<br><br>
			<label>16. ¿Qué planes tienes para tu futuro profesional? <b><?php echo $dtest->f_profesional; ?>.</b></label>
			<br><br>
			<label>17. ¿A qué te dedicas en tu tiempo libre? <b><?php echo $dtest->t_libre; ?>.</b></label>
		</div>
	</div>
	<br><br>
	<div class="div">
		<h5 class="titleAsp">III. ASPECTOS ACADEMICOS</h5>
	</div>
	<br>
	<div id="divC-1">
		<div id="divC-1b">
			<label>1. Bachillerato: <b><?php echo $dtest->bachillerato; ?>.</b></label>
			<br><br>
			<label>Turno: <b><?php echo $dtest->turno; ?>.</b></label>
			<label style="margin-left: 10px;">Localidad: <b><?php echo $dtest->localidadBach; ?>.</b></label>
			<label style="margin-left: 10px;">Entidad: <b><?php echo $dtest->entidadBach; ?></b></label>
			<br><br>
			<label>Especialidad: <b><?php echo $dtest->especialidadBach; ?>.</b></label>
			<label style="margin-left: 10px;">Promedio: <b><?php echo $dtest->promedioBach; ?>.</b></label>
			<br><br>
			<label>2. Puntaje examen CENEVAL: <b><?php echo $dtest->ceneval;?>.</b></label>
			 <br><br>
			 <label>3. ¿Por qué elegiste estudiar en una Universidad Tecnológica? <b><?php echo $dtest->estudiar; ?>.</b></label>
			 <br><br>
			 <label>4. ¿Ésta Universidad era tu primera opción? <b><?php echo $dtest->opcionUni; ?>.</b></label>
			 <label style="margin-left: 10px;">5. ¿Ésta Carrera era tu primera opción? <b><?php echo $dtest->opcionCar; ?>.</b></label>
			 <br><br>
			 <label>6. ¿Qué esperas de esta carrera? <b><?php echo $dtest->carreraEsp; ?>.</b></label>
			 <br><br>
			 <label>7. ¿Tienes planeado presentar examen de admisión para ingresar a otra escuela o carrera? <b><?php echo $dtest->planExm; ?>.</b></label>
			 <br><br>
			 <label>8. ¿Qué materias se te dificultan más? <b><?php echo $dtest->dificultMat; ?>.</b></label>
			 <br><br>
			 <label>9. ¿Has reprobado alguna materia o presentado examen extraordinario? <b><?php echo $dtest->reprobado; ?>.</b></label>
			 <br><br>
			 <?php 
			 	if ($dtest->reprobado == "Si") {
			?>
			<label>¿Qué materias? <b><?php echo $dtest->materiasRep; ?></b></label>
			<br><br>
			<?php
			 	}
			 ?>
			 <label>10. ¿Utilizas alguna manera o técnica de estudio? <b><?php echo $dtest->tecnica; ?>.</b></label>
			 <br><br>
			<?php 
				if ($dtest->tecnica == "Si") {
			?>
			<label>¿Cuál? <b><?php echo $dtest->cualTec; ?>.</b></label>
			<br><br>
			<?php
				}
			?>
			<label>11. ¿Cuentas en tu casa con algunos libros que apoyan tus estudios? <b><?php echo $dtest->libros; ?>.</b></label>
			<?php 
				if ($dtest->libros == "Si") {
			?>
			<label style="margin-left: 10px;">¿Cuantos (Aprox)? <b><?php echo $dtest->cantLib; ?></b></label>
			<br><br>
			<?php
				}
			?>
			<label>12. ¿Tienes computadora en tu casa como apoyo para tus trabajos y tareas escolares? <b><?php echo $dtest->computadora; ?>.</b></label>
			<br>
		</div>
	</div>
	<br><br><br><br><br><br><br><br><br><br>
	<div id="div-1fot">
		<div id="div-1bfot">
			<b>FE: <?php echo $fechAct; ?></b>
			<label style="margin-left: 250px;">Pagina 2 de 3</label>
		</div>
		<div id="div-1afot">
			<b>FO-DIC-43/02</b>
		</div>
	</div>
	<img src="../vistas/img/utsemlog.jpg" width="100">
	<b style="font-size: 20px; margin-left: 50px;">Universidad Tecnológica del Sur del Estado de México.</b> 
	<hr style="height: 3px; background-color: black;">
	<h4 style="text-align: center;"><b>ENTREVISTA INICIAL PARA TUTORIAS</b></h4>
	<br><br>
	<div class="div">
		<h5 class="" style="text-align: center;">EVALUACIÓN TUTOR</h5>
	</div>
	<br>
	<div id="divd-1">
		<div id="divd-1b">
			<label>De acuerdo a la información obtenida en los aspectos I, II Y III ¿Se considera al alumno como elemento de uno o más grupos altamente vulnerables? 
				<br><br>
				<b><?php echo $dtest->vulnerable; ?>.</b></label>
			<br><br>
			<label>Grupos en los que se considera se incluye al alumno como altamente vulnerable:</label>
			<br><br><br>
			<b><?php echo $dtest->opcion1; ?></b>
			<b style="margin-left: 10px;"><?php echo $dtest->opcion2; ?></b>
			<b style="margin-left: 10px;"><?php echo $dtest->opcion3; ?></b>
			<br><br><br>
			<label>OBSERVACIONES DEL TUTOR: <b><?php echo $dtest->obseval; ?>.</b></label>
		</div>
	</div>
	<br><br><br><br><br><br><br><br><br><br>
	<br><br><br><br>
	<br><br><br><br>
	<br><br><br><br>
	<br><br><br><br>
	<br>
	<div id="div-1fot">
		<div id="div-1bfot">
			<b>FE: <?php echo $fechAct; ?></b>
			<label style="margin-left: 250px;">Pagina 3 de 3</label>
		</div>
		<div id="div-1afot">
			<b>FO-DIC-43/02</b>
		</div>
	</div>

	</page>

	<?php 

	$content = ob_get_clean();
	include '../vistas/html/html2pdf.class.php';
	$pdf = new HTML2PDF('P','A4','fr','UTF-8');
	$pdf->writeHTML($content);
	$pdf->pdf->IncludeJS('print(TRUE)');
	$pdf->output('Encuesta.pdf');

	?>
<?php		
	} else {
		header("Location:../vistas/modulos/doc/Logout.php");
	}
}
