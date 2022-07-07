<?php 

ob_start(); 
session_start();
if ($_SESSION['keyAlm'] == "" || $_SESSION['keyAlm'] == null) {
	header("Location:../Index.php");
} else {
	include '../modelos/alumno.modelo.php';
	$alumno = new Alumno();
	$datAlm = $alumno->userAlmDet($_SESSION['keyAlm']);
	if ($datAlm) {
		if ($datAlm->id_detgrupo != "") {
		$datGrpAlm = $alumno->datGrpAlm($_SESSION['keyAlm']);
		$cantJustTot = $alumno->cantTotJustif($_SESSION['keyAlm']);
		$cantAcJust = $alumno -> cantJustifAcept($_SESSION['keyAlm'], $datGrpAlm->cuatrimestre_g);
		$cantReJust = $alumno -> cantJustifRecha($_SESSION['keyAlm'], $datGrpAlm->cuatrimestre_g);
		$cantTotCut = $alumno -> cantJustifCuat($_SESSION['keyAlm'], $datGrpAlm->cuatrimestre_g);
		} 
	$valDatPer = $alumno -> cantDatPerVal($_SESSION['keyAlm']);
	$datEPer = $alumno -> datPerEditAlm($_SESSION['keyAlm']);
	$valTest = $alumno -> valTestIniAlm($_SESSION['keyAlm']);
	// $fechact = date($datAlm->fecha_reg);
	// $fecho = date("Y-m-d");
	// $fecha = date_create($fechact);
	// $fecha1 = date_add($fecha, date_interval_create_from_date_string('60 days'));
	// $fecha2 = date_format($fecha, 'Y-m-d');
	// if ($fecho > $fecha2) {
	// 	echo "1";
	// } else {
	// 	echo "0";
	// }
	/*$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
	$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
	$Fecha = $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y');
	echo $datAlm->fecha_reg;
	echo "<br>";
	$fechAlm = $datAlm->fecha_reg;
	echo "<br>";
	echo substr($fechAlm, 0,4);
	echo "<br>";
	echo substr($fechAlm, 5,2);
	echo "<br>";
	echo substr($fechAlm, 8,2);*/

?>
	<?php include 'header.php'; ?>

	<br><br>
	<style type="text/css">
		div .list-group .active {
			background:#fff!important;
			color: black;
			outline: none;
			list-style: none;
			text-decoration: none;
			border-color: #28a745!important;
		}
		.ocult {
			display: none;
		}
	</style>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<?php 
					if ($datAlm -> id_detgrupo != "" && $datAlm -> acept_grp == 1) {
				?>
					<button class="btn bg-white text-success cardShadow btn-lg dropdown-toggle mr-3" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				    Justificantes <i id="bell" class="fas fa-bell fa-lg icoPri"></i>
				    	<span class="lead icoIni icoPri" id="cantNotifNum"></span>
				  	</button>
				  	<div class="dropdown-menu" style="width: 500px;" aria-labelledby="dropdownMenuLink">
				  		<div class="container-fluid listNot">
				  		</div>
					</div>
					<div class="btn-group mr-3">
					  	<button class="btn text-success bg-white cardShadow btn-lg dropdown-toggle" href="#" role="button" id="dropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					    Tutorías <i id="bell" class="fas fa-bell fa-lg icoPri"></i>
					    	<span class="lead icoIni icoPri" id="cantNotifTut"></span>
					  	</button>
					  	<div class="dropdown-menu" style="width: 500px;" aria-labelledby="dropdownMenuLink2">
					  		<div class="container-fluid listTut">
				  			</div>
					  		</div>
						</div>
					</div>

				<?php
					}
				?>
			</div>
		</div>
	</div>
	<br><br><br><br>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-3 text-center">
				<div class="cardShadow rounded pad30">
					<?php 
						if ($datAlm -> foto_perf_alm == "" && $datAlm -> sexo_al == "Masculino") {
							echo "<img src='../vistas/img/usermal.png' class='img-fluid' width='200'>";
						} else if ($datAlm -> foto_perf_alm != "" && $datAlm -> sexo_al == "Masculino") {
					?>
						<img src="Arch/perfil/<?php echo $datAlm->foto_perf_alm ?>" class="img-fluid img-thumbnail rounded" width="300">
					<?php
						} else if ($datAlm -> foto_perf_alm == "" && $datAlm -> sexo_al == "Femenino") {
							echo "<img src='../vistas/img/userfem.png' class='img-fluid' width='200'>";
						} else if ($datAlm -> foto_perf_alm != "" && $datAlm -> sexo_al == "Femenino") {
					?>
						<img src="Arch/perfil/<?php echo $datAlm->foto_perf_alm ?>" class="img-fluid img-thumbnail rounded" width="300">
					<?php
						} else {
							echo "<img src='../vistas/img/icous.png' class='img-fluid' width='200'>";
						}
					?>
					<h4 class="text-center mt-3">
						<?php echo $datAlm -> nombre_c_al; ?>
					</h4>
					<hr style="height: 2px;" class="bg-success rounded cardShadow">
					<h5 class=" text-left mt-4">
						<i class="fas fa-id-card-alt fa-lg icoIni"></i>
						<?php echo $datAlm -> matricula_al; ?>
					</h5>
					<h5 class=" text-left mt-3">
						<i class="fas fa-envelope fa-lg icoIni"></i>
						<?php echo $datAlm -> correo_al; ?>
					</h5>
					<h5 class=" text-left mt-3">
						<i class="fas fa-phone fa-lg icoIni"></i>
						<?php echo $datAlm -> telefono_al; ?>
					</h5>
				</div>
				<br><br><br>
			</div>
			<?php 
				if ($datAlm->id_detgrupo != "") {
			?>
				<div class="col-sm-12 col-md-12 col-lg-9 ">
				<div class="row">
				  <div class="col-sm-12 col-md-12 col-lg-4 pad10">
				    <div class="list-group list-group-flush cardShadow rounded" id="list-tab" role="tablist">
				    <?php 
				    	if ($datGrpAlm -> acept_grp == 1) {
				    ?>		
				    	<a class="list-group-item list-group-item-action active labEst" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home"><i class="fas fa-flag fa-lg icoPri pad10 icoIni">
				     	</i>Noticias</a>
				      	<a class="list-group-item list-group-item-action labEst" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile"><i class="fas fa-file-medical fa-lg icoPri pad10 icoIni"></i>Justificantes</a>
				      	<a class="list-group-item list-group-item-action labEst" id="list-messages-list" data-toggle="list" href="#list-messages" role="tab" aria-controls="messages"><i class="fas fa-book fa-lg icoPri pad10 icoIni"></i>Encuesta</a>
				      	<a class="list-group-item list-group-item-action labEst" id="list-tutoria-list" data-toggle="list" href="#list-tutoria" role="tab" aria-controls="tutoria"><i class="fas fa-chalkboard-teacher fa-lg icoPri pad10 icoIni"></i>Tutoría</a>
				      	<?php 
				      		if ($valDatPer -> CantDat == 1) {
				      	?>
						<a class="list-group-item list-group-item-action labEst" id="list-datper-list" data-toggle="list" href="#list-datper" role="tab" aria-controls="datper"><i class="fas fa-address-book fa-lg icoPri pad10 icoIni"></i>Datos personales</a>
				      	<?php
				      		}
				      	?>
				      	<a class="list-group-item list-group-item-action labEst" id="list-datgrp-list" data-toggle="list" href="#list-datgrp" role="tab" aria-controls="datgrp"><i class="fas fa-users fa-lg icoPri pad10 icoIni"></i>Grupo</a>
				    <?php	
						} else {
				    ?>
				    	<a class="list-group-item list-group-item-action active labEst" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home"><i class="fas fa-flag fa-lg icoPri pad10 icoIni">
				      	</i>Noticias</a>
				      	<a class="list-group-item list-group-item-action labEst disabled" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile"><i class="fas fa-file-medical fa-lg icoPri pad10 icoIni"></i>Justificantes</a>
				      	<a class="list-group-item list-group-item-action labEst disabled" id="list-messages-list" data-toggle="list" href="#list-messages" role="tab" aria-controls="messages"><i class="fas fa-book fa-lg icoPri pad10 icoIni"></i>Encuesta</a>
				      	<a class="list-group-item list-group-item-action labEst disabled" id="list-tutoria-list" data-toggle="list" href="#list-tutoria" role="tab" aria-controls="tutoria"><i class="fas fa-chalkboard-teacher fa-lg icoPri pad10 icoIni"></i>Tutoría</a>
				      	<a class="list-group-item list-group-item-action labEst" id="list-datgrp-list" data-toggle="list" href="#list-datgrp" role="tab" aria-controls="datgrp"><i class="fas fa-users fa-lg icoPri pad10 icoIni"></i>Grupo</a>
				    <?php
				    	}
				    ?>
				    </div>
				  </div>
				  <div class="col-sm-12 col-md-12 col-lg-8 rounded pad10">
				    <div class="tab-content" id="nav-tabContent">
				      <div class="tab-pane cardShadow rounded pad10 fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
				      	<p class="lead text-center">
				      		Ultima actualización 19/08/2018
				      		<br>
				      	</p>
				      	<b class="text-left lead">Proyecto Desarrollado Por:</b>
				      	<br><br><br>
				      	<div class="row">
				      		<div class="col-sm-6 text-center" id="dev1">
				      			<a href="#" style="color:#1E6E50;" class="lead"> <i class="fas fa-user-astronaut fa-lg icoIni icoPri" id="dev11"></i> Marco Aguilar</a>
				      		</div>
				      		<div class="col-sm-6 text-center border-left">
				      			<a href="#" target="_blank" style="color:#1E6E50;" class="lead"> <i class="fas fa-code fa-lg icoIni icoPri"></i> Mario Jaimes</a>
				      		</div>
				      	</div>
				      	<br>
				      	<div class="row">
				      		<div class="col-sm-4 text-center border-right">
				      			<a href="#" style="color:#1E6E50;" class="lead"> <i class="fab fa-connectdevelop fa-lg icoIni icoPri"></i>Briian Vidal</a>
				      		</div>
				      		<div class="col-sm-4 text-center">
				      			<a href="#" style="color:#1E6E50;" class="lead"> <i class="fas fa-file-code fa-lg icoIni icoPri"></i> Alex Solis</a>
				      		</div>
				      		<div class="col-sm-4 text-center border-left">
				      			<a href="#" style="color:#1E6E50;" class="lead"> <i class="fas fa-laptop fa-lg icoIni icoPri"></i> Guillermo Lopez</a>
				      		</div>
				      	</div>
				      	<br><br>
				      	<b class="text-left lead">Profesores A Cargo:</b>
				      	<br><br>
				      	<div class="row">
				      		<div class="col-sm-6 text-center">
				      			<a href="#"  style="color:#1E6E50;" class="lead"> <i class="fas fa-chalkboard-teacher fa-lg icoIni icoPri"></i> Antonio De Jesus</a>
				      		</div>
				      		<div class="col-sm-6 text-center border-left">
				      			<a href="#" style="color:#1E6E50;" class="lead"> <i class="fas fa-chalkboard-teacher fa-lg icoIni icoPri"></i> Adan Jaimes</a>
				      		</div>
				      	</div>
				      </div>
				      <div class="tab-pane cardShadow rounded pad10 fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
				      	<h4 class="text-center">Justificantes</h4>
				      	<br>
				      	<div class="row">
							<div class="col-sm-3 text-right">
								<img src="../vistas/img/icous.png" width="70" class="img-fluid" alt="">
							</div>
							<div class="col-sm-9 text-left text-justify">
							    <span class="lead">
									Hola! En este apartado puedes solicitar justificantes cada vez que los requieras, la solicitud de petición se enviara al tutor a cargo del grupo...
								</span>
							</div>
						</div>
						<hr style="height: 2px;" class="bg-success rounded cardShadow">
				      	<br>
				      	<?php 
				      		if ($valTest -> CantidadVal == 1) {
				      	?>
				      	<div class="text-center">
				      		<button  data-backdrop="false" class="btn btn-outline-success cardShadow mr-3 btn-lg mb-4" type="button" data-target="#solJustif"
				      		data-toggle="modal">
				      			<i class="fas fa-plus fa-lg icoIni"></i>
				      			Solicitar
				      		</button>
				      		<a href="DetJustif.php" class="btn btn-outline-success btn-lg cardShadow mb-4">
				      			<i class="fas fa-plus fa-lg icoIni"></i>
				      			Ver más detalles
				      		</a>
				      	</div>
				      	<?php
				      		} else {
				      	?>
				      	<br>
						<div class="text-center">
							<p class="lead">
								Antes de poder solicitar un justificante tienes que realizar 
								la Encuesta Inicial
							</p>
						</div>
				      	<?php
				      		}
				      	?>
				      </div>
				      <div class="tab-pane fade cardShadow rounded pad10" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">
				      	<h4 class="text-center">Encuesta Inicial</h4>
				      	<br>
				      	<?php 
				      		if ($valDatPer -> CantDat == 1) {
				      	?>
					      	<?php 
					      		if ($valTest -> CantidadVal == 1) {
					      			$idEnc = $alumno -> valObtEnc($_SESSION['keyAlm']);
					      	?>
					      		<div class="row">
							      	<div class="col-sm-3 text-right">
										<img src="../vistas/img/icous.png" width="70" class="img-fluid" alt="">
							      	</div>
							      	<div class="col-sm-9 text-left text-justify">
							      		<span class="lead">
											Hola! Has llenado satisfactoriamente la encuesta, ahora cada vez que tengas que actualizar los datos este es el apartado indicado!...
										</span>
							      	</div>
							    </div>
							    <hr style="height: 2px;" class="bg-success rounded cardShadow">
							    <br>
					      		<div class="row">
						      		<div class="col-sm-12 text-center mb-4">
						      			<a href="TestIniEdit.php?v=<?php echo base64_encode($idEnc->id_enctestalm); ?>" class="btn btn-outline-success lead btn-lg">
						      				<i class="fas fa-edit fa-lg icoIni"></i>
						      				Editar Encuesta
						      			</a>
						      		</div>
						      	</div>
					      	<?php		
					      		} else {
					      	?>
					      		<div class="row">
							      	<div class="col-sm-3 text-right">
										<img src="../vistas/img/icous.png" width="70" class="img-fluid" alt="">
							      	</div>
							      	<div class="col-sm-9 text-left text-justify">
							      		<span class="lead">
											Hola! ahora que tus datos personales han sido completados puedes proseguir con el llenado de la encuesta inicial de tutorías!...
										</span>
							      	</div>
							    </div>
							    <hr>
							    <br>
							    <br>
								<div class="row">
									<div class="col-sm-12 text-center">
						      			<a href="TestIni.php" class="btn btn-outline-success lead btn-lg">
											<i class="fas fa-check fa-lg icoIni"></i>
						      				Realizar Encuesta
						      			</a>
						      		</div>
								</div>
					      	<?php
					      		}
					      	?>
				      	<?php
				      		} else {
				      	?>
				      	<div class="row">
				      		<div class="col-sm-6 text-center border-right">
				      			<br>
				      			<p class="lead text-justify">
				      				Antes de realizar la encuesta inicial porfavor completa tus datos personales, para continuar con el proceso.
				      			</p>
				      			<i class="fas fa-address-book fa-3x"></i>
				      		</div>
				      		<div class="col-sm-6 text-center">
								<br><br><br>
								<button class="btn btn-outline-success btn-lg" type="button" data-target="#datPerAlm" data-toggle="modal">
									<i class="fas fa-address-card fa-lg icoIni"></i>
									Completar
								</button>
				      		</div>
				      	</div>
				      	<?php		
				      		}
				      	?>
				      </div>
				      <?php 
				      	if ($valDatPer -> CantDat == 1) {
				     ?>
				     <div class="tab-pane cardShadow rounded pad10 fade" id="list-datper" role="tabpanel" aria-labelledby="list-datper-list">
				      	<h4 class="text-center">Datos personales</h4>
				      	<br>
				      	<div class="row">
				      		<div class="col-sm-3 text-right">
								<img src="../vistas/img/icous.png" width="70" class="img-fluid" alt="">
				      		</div>
				      		<div class="col-sm-9 text-left text-justify">
				      			<span class="lead">
				      				Hola! este es un apartado para la edición de sus datos personales, es de vital importancia mentenerlos actualizados para brindar una mejor atención!...
								</span>
				      		</div>
				      	</div>
				      	<hr style="height: 2px;" class="bg-success rounded cardShadow">
				      	<br>
				      	<div class="text-center mb-4">
				      		<button data-backdrop="false" data-target="#datPerAlmEdit" data-toggle="modal" class="btn btn-lg btn-outline-success"><i class="fas fa-edit fa-lg icoIni"></i>Editar</button>
				      	</div>
				      </div>
				     <?php 		
				      	}
				      ?>
				      <div class="tab-pane cardShadow rounded pad10 fade" id="list-tutoria" role="tabpanel" aria-labelledby="list-tutoria-list">
				      	<h4 class="text-center">Tutoría</h4>
				      	<br>
				      	<div class="row">
				      		<div class="col-sm-3 text-right">
								<img src="../vistas/img/icous.png" width="70" class="img-fluid" alt="">
				      		</div>
				      		<div class="col-sm-9 text-left text-justify">
				      			<span class="lead">
									Hola! en este apartado puedes solicitar una tutoría personal a tu tutor, solo completa los datos del formulario para enviar la solicitud!...
								</span>
				      		</div>
				      	</div>
				      	<hr style="height: 2px;" class="bg-success rounded cardShadow">
				      	<br>
				      	<?php 
				      		if ($valTest -> CantidadVal == 1) {
				      	?>
				      	<div class="text-center">
				      		<button data-backdrop="false" class="btn btn-lg cardShadow btn-outline-success mb-4 mr-3" type="button" data-target="#solTut" data-toggle="modal">
				      			<i class="fas fa-plus fa-lg icoIni"></i>
				      			Solicitar 
				      		</button>
				      		<a href="DetTutPer.php" class="btn btn-lg btn-outline-success mb-4 cardShadow">
				      			<i class="fas fa-plus fa-lg icoIni"></i>
				      			Ver más detalles
				      		</a>
				      	</div>
				      	<?php
				      		} else {
				      	?>
						<div class="text-center">
							<p class="lead">
								Antes de poder solicitar una tutoría personal, tienes que llenar la Encuesta Inicial.
							</p>
						</div>
				      	<?php
				      		}
				      	?>
				      </div>
				      <div class="tab-pane cardShadow rounded pad10 fade" id="list-datgrp" role="tabpanel" aria-labelledby="list-datgrp-list">
				      	<h4 class="text-center">Mi Grupo</h4>
				      	<br>
				      	<?php 
				      		if ($datGrpAlm->acept_grp == 1) {
				      	?>
				      	<div class="row">
				      		<div class="col-sm-12 text-center pad10 border-right border-light rounded">
				      			<?php 
				      				if ($datGrpAlm -> foto_perf_doc != "") {
				      			?>
				      			<img class="img-fluid img-thumbnail" width="200" src="http://localhost/TutoriasBack/moddoc/perfilFot/<?php echo $datGrpAlm->foto_perf_doc; ?>" alt="">
				      			<br>
				      			<?php		
				      				}
				      			?>
				      			<span class="lead">
				      				Tutor: <?php echo $datGrpAlm->nombre_c_doc; ?>
				      			</span>
				      		</div>
				      	</div>
				      	<div class="row">
				      		<div class="col-sm-6 text-center pad10 rounded border-right">
				      			<span class="lead">
				      				Carrera: <?php echo $datGrpAlm->nombre_car; ?>
				      			</span>
				      		</div>
				      		<div class="col-sm-6 text-center pad10 rounded">
				      			<span class="lead">
				      				Periodo: <?php echo $datGrpAlm->period_cuat." ".date("Y"); ?> 
				      			</span>
				      		</div>
				      	</div>
				      	<div class="row">
				      		<div class="col-sm-12 text-center pad10 rounded">
				      			<span class="lead">
				      				Grupo: <?php echo $datGrpAlm->grupo_n; ?>
				      			</span>
				      		</div>
				      	</div>
				      	<?php
				      		} else {
				      	?>
				      	<div class="row">
				      		<div class="col-sm-6 text-center pad10 border-right border-success">
				      			<span class="lead">Oops! Aún no has sido aceptado</span>
				      			<br><br>
				      			<i class="fas fa-frown fa-3x"></i>
				      		</div>
				      		<div class="col-sm-6 text-center pad10">
				      			<span class="lead">
				      				Tutor: <?php echo $datGrpAlm->nombre_c_doc; ?>
				      			</span>
				      			<br><br>
				      			<span class="lead">
				      				Grupo y Carrera: <?php echo $datGrpAlm->grupo_n.", ".$datGrpAlm->nombre_car; ?>
				      			</span>
				      		</div>
				      	</div>
				      	<?php		
				      		}
				      	?>
				      	<br>
				      	<div class="text-center mb-4">
				      		<button type="button" class="btn btn-outline-success btn-lg" data-target="#editMyGrp" data-toggle="modal"> 
								<i class="fas fa-edit fa-lg icoIni"></i>
				      			Editar
				      		</button>
				      	</div>
				      </div>
				    </div>
				  </div>
				  <div class="col-sm-12 col-md-12 col-lg-1 "></div>
				</div>
			</div>
			<?php
				} else {
			?>
				<div class="col-sm-9">
					<h5 class="text-center">
						Para continuar, selecciona el grupo al que perteneces, posteriormente el Tutor a cargo tendrá que enrrolarte al grupo.
					</h5>
					<br>
					<form name="formRegGrp" id="formRegGrp" method="POST">
						<div class="row">
							<div class="col-sm-3"></div>
							<div class="col-sm-6 cardShadow pad30 text-success">
								<div class="form-group">
									<label class="lead" for="clvDetGrp">Grupo:</label>
									<select class="form-control" name="clvDetGrp" id="clvDetGrp">
										<option selected="" value="SN">Selecciona</option>
										<?php 
											try {
												$valid = 1;
												$clvCar = $datAlm -> id_carrera;
												//$dbc = Connect::getDB();
												$dbc = new Connect();
												$dbc = $dbc -> getDB();
												$stmt = $dbc -> prepare("SELECT det.id_detgrupo, grp.grupo_n, doc.nombre_c_doc FROM det_grupo det
													INNER JOIN grupos grp ON grp.id_grupo = det.id_grupo
													INNER JOIN docentes doc ON doc.id_docente = det.id_docente
													INNER JOIN carreras car ON car.id_carrera = det.id_carrera
													WHERE det.estado_detgrp = :valid && det.id_carrera = :clvCar");
												$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
												$stmt -> bindParam("clvCar", $clvCar, PDO::PARAM_INT);
												$stmt -> execute();
												while ($res = $stmt -> fetch(PDO::FETCH_OBJ)) {
										?>
												<option value="<?php echo $res->id_detgrupo; ?>">
													<?php echo $res->grupo_n.", ".$res->nombre_c_doc;?>
												</option>
										<?php
												}
										?>
												
										<?php
											} catch (PDOException $e) {
												echo '{"error":{"text":'. $e->getMessage() .'}}';	
											}
										?>
									</select>
								</div>
							</div>
							<div class="col-sm-3"></div>
						</div>
						<br>
						<div class="text-center">
							<button class="btn btn-lg btn-success">
								Registrar
								<i class="fas fa-check fa-lg icoPri"></i>
							</button>
						</div>
					</form>
				</div>
			<?php		
				}
			?>
		</div>
	</div>

	<?php include 'modals/modalJustifSol.php'; ?>
	
	<?php include 'modals/modalDatPerAlm.php'; ?>

	<?php include 'modals/modalEditDatPerAlm.php'; ?>

	<?php include 'modals/EncuestaAlm.php'; ?>

	<?php include 'modals/modalEditGrp.php'; ?>

	<?php include 'modals/modalTutSol.php'; ?>

	<br><br><br>
	<?php include 'modals/modalsconfalm.php'; ?>
	<script src="../vistas/js/jquery-3.1.1.min.js"></script>
	<!-- SweetAlert -->
    <script src="../vistas/node_modules/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vistas/Assets/js/vendor/popper.min.js"></script>
    <script src="../vistas/Js/bootstrap.min.js"></script>
    <script src="../vistas/assets/js/vendor/holder.min.js"></script>
    <!--- Personalizados -->
    <script src="../vistas/modulos/js/confDatAlm.js"></script>
    <script src="../vistas/modulos/js/justif.js"></script>
    <script src="../vistas/modulos/js/datPerAlm.js"></script>
    <script src="../vistas/modulos/js/editDatPerAlm.js"></script>
    <script src="../vistas/modulos/js/grpAlm.js"></script>
    <script src="../vistas/modulos/js/tutAlm.js"></script>
    
	<?php include 'footer.php'; ?>
<?php
	} else {
		header("Location:../vistas/modulos/Logout.php");
	}
	  
}

