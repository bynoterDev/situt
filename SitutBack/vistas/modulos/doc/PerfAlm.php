<?php 

ob_start();
session_start();

if ($_SESSION['keyDoc'] == "" || $_SESSION['keyDoc'] == null) {
	header("Location:../Index.php");
} else {
	include '../modelos/docente.modelo.php';
	include '../modelos/rutas.php';
	$urlFront = new Ruta();
	$urlFront = $urlFront -> ctrRutaFront();
	$docente = new Docentes();
	$keyDoc = $_SESSION['keyDoc'];
	$valPerfAlm = $_GET['v'];
	$valPerfAlmDec = base64_decode($valPerfAlm);
	$datDoce = $docente->userDocDet($keyDoc);
	$grp = $_SESSION["clvGrp"];
	$_SESSION["clvAlm"] = $valPerfAlmDec;
	$datGrup = $docente->datGrpSel($keyDoc, $grp);
	$datAlm = $docente->datPerfAlm($valPerfAlmDec);
	$cantJustif = $docente->cantJustif($valPerfAlmDec);
	$cantJusImp = $docente->cantJustifImp($valPerfAlmDec);
	$cantJustifAc = $docente->cantJustifAcept($valPerfAlmDec);
	$cantTutPer = $docente->cantTutPers($valPerfAlmDec);
	$cantTutPerAcp = $docente->cantTutPerAcept($valPerfAlmDec);
	$cantTutPerSol = $docente->cantTutPerSolic($valPerfAlmDec);
	$valDPAlm = $docente -> valDatPerAlm($valPerfAlmDec);
	$valEnc = $docente -> valDatEnc($valPerfAlmDec);
	if ($datDoce) {
?>
	
	<?php include 'header2.php'; ?>
	<style type="text/css">
		.ocult { display: none; }
		.colM {
			color: #28a745;
		}
		.colM:hover {
			color: #fff;
			background: #28a745;
			transition: 1s;
		}
		.bgBtnMost {
			/*background: #360033;
			background: -webkit-linear-gradient(to right, #0b8793, #360033);
			background: linear-gradient(to right, #0b8793, #360033);
			transition: 3s;
			color : white;*/
			background: #28a745;
			color: white;
		}
		.cardBg {
			background: #43cea2;  
			background: -webkit-linear-gradient(to right, #185a9d, #43cea2);
			background: linear-gradient(to right, #185a9d, #43cea2);
		}
	</style>
	<br><br><br><br>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-2"></div>
			<div class="col-sm-12 col-md-12 col-lg-8">
				<a href="DetGrp.php?v=<?php echo base64_encode($grp); ?>" class="btn text-primary bg-white cardShadow mr-3 btn-md">
					<i class="fas fa-arrow-left icoIni"></i>
					Regresar
				</a>
				<button data-backdrop="false" data-toggle="modal" data-target="#almList" class="btn text-primary bg-white cardShadow mr-3 btn-md">
					<i class="fas fa-list icoIni"></i>
					Mis alumnos
				</button>
			</div>
		</div>
	</div>

	<div class="container-fluid mt-4">
		<div class="row">
			<div class="col-md-4 col-lg-3">
				<!-- SobreMi -->
                <div class="container py-5">
                    <div class="card shDC">
                        <img class="card-img-top" src="../vistas/img/iceland.jpg" alt="Card image cap">

                        <div class="text-center margen-avatar">
                        	<?php 
								if ($datDoce -> foto_perf_doc != "") {
							?>
								<div class="text-center">
									<img src="perfilFot/<?php echo $datDoce->foto_perf_doc; ?>" class="rounded-circle" width="100px" >
								</div>
								<hr style="height: 2px;" class="bg-success rounded">
							<?php
								} else {
							?>
								<img src='../vistas/img/usermal.png' class='rounded-circle' width='100px'>
							<?php
								}
							?>
                        </div>
                        <div class="card-body text-center">
                        <h6 class="card-title font-weight-bold">
                        	<?php echo $datDoce->nombre_c_doc; ?>
                        </h6>
                        <h6 class="text-left mt-3">
                        	<i class="fas fa-certificate fa-lg icoIni"></i>
                        	<?php echo $datDoce->especialidad_doc; ?>
                        </h6>
						<h6 class=" text-left mt-3 text-truncate" title="<?php echo $datDoce->correo_doc; ?>">
							<i class="fas fa-envelope fa-lg icoIni"></i>
							<?php echo $datDoce -> correo_doc; ?>
						</h6>
						<h6 class=" text-left mt-3">
							<i class="fas fa-phone fa-lg icoIni"></i>
							<?php echo $datDoce -> telefono_doc; ?>
						</h6>
						<hr class="bg-info mt-4" style="height: 2px;">
						<h6 class="text-center text-info">
							<b>Docente</b>
						</h6>
                        </div>
                    </div>
                </div><!-- SobreMi -->
                <div class="container">
                    <!-- Comentarios -->
                    <div class="card">
                        <div class="card-header text-center">
                            Frase Celebre
                        </div>
                        <div class="card-body">
                            <blockquote class="blockquote mb-0">
                            <p class="font-italic text-info">
                            	<b>"</b> Todo el mundo tiene talento, solo es cuestión de moverse hasta descubrirlo. <b>"</b>
                            </p>
                            <footer class="blockquote-footer"><cite title="Source Title">George Lucas</cite></footer>
                            </blockquote>
                        </div>
                    </div><!-- Comentarios -->
                </div>
			</div>
			<div class="col-md-8 col-lg-9 ocult" id="loader">
				<div class="text-center mt-5">
					<img src="../vistas/img/load2.gif" width="200" alt="">
					<h1 class="text-info" id="textLoad">
						Cargando datos de <b><?php echo $datAlm->nombre_c_al; ?></b>
					</h1>
				</div>
			</div>
			<div class="col-md-8 col-lg-9 ocult" id="contend">
				<div class="text-center bg-primary p-1" style="border-radius: 8px;">
					<h4 class="text-center text-white mt-3"> 
						<?php echo "Carrera: ".$datGrup->nombre_car.", Grupo: ".$datGrup->grupo_n."."; ?>
					</h4>
				</div>
				<div class="row mt-4">
					<div class="col-sm-6">
						<h5 class="text-left text-capitalize text-info">
							<br>
							<i class="fas fa-user-graduate mr-2"></i>
							Alumno: <b><?php echo $datAlm->nombre_c_al; ?></b>
						</h5>
						<h5 class="text-left text-info mt-3">
							<i class="fas fa-certificate mr-2"></i>
							Matricula: <b><?php echo $datAlm->matricula_al; ?></b>
						</h5>
						<h5 class="text-left text-info  mt-3">
							<i class="fas fa-envelope mr-2"></i>
							Correo: <b><?php echo $datAlm->correo_al; ?></b>
						</h5>
						<h5 class="text-left text-info mt-3">
							<i class="fas fa-phone mr-2"></i>
							Telefono: <b><?php echo $datAlm->telefono_al; ?></b>
						</h5>
						<h5 class="text-left text-info mt-3">
							<i class="fas fa-id-badge mr-2"></i>
							Cuenta: 
							<?php 
								if ($datAlm->estado_al != 0) {
							?>
								<span class="badge badge-primary">
									Activa
								</span>
							<?php
								} else {
							?>
								<span class="badge badge-danger">
									Inactiva
								</span>
							<?php
								}
							?>
						</h5>
						<h5 class="text-center mt-4">
							<?php 
								if ($datAlm->estado_al != 0) {
							?>
								<button class="btn btn-outline-danger btn-sm" type="button" onclick="desactAlm(<?php echo $datAlm->id_alumno; ?>)">
									<i class="fas fa-times icoIni"></i>
									Desactivar cuenta
								</button>
							<?php	
								} else {
							?>
								<button class="btn btn-outline-primary btn-sm" type="button" onclick="activAlm(<?php echo $datAlm->id_alumno; ?>)">
									<i class="fas fa-check icoIni"></i>
									Activar cuenta
								</button>
							<?php
								}
							?>
						</h5>
						<hr style="height: 2px !important;" class="bg-info rounded">
					</div>
					<div class="col-sm-6 text-center mt-1">
						<?php 
							if ($datAlm -> foto_perf_alm == "" && $datAlm -> sexo_al == "Masculino") {
								echo "<img src='../vistas/img/usermal.png' class='img-fluid mt-4' width='200'>";
							} else if ($datAlm -> foto_perf_alm != "" && $datAlm -> sexo_al == "Masculino") {
						?>
							<img src="<?php echo $urlFront?>modAlm/Arch/perfil/<?php echo $datAlm->foto_perf_alm ?>" class="img-fluid img-thumbnail rounded mt-4" width="300">
						<?php
							} else if ($datAlm -> foto_perf_alm == "" && $datAlm -> sexo_al == "Femenino") {
								echo "<img src='../vistas/img/userfem.png' class='img-fluid mt-4' width='200'>";
							} else if ($datAlm -> foto_perf_alm != "" && $datAlm -> sexo_al == "Femenino") {
						?>
							<img src="<?php echo $urlFront?>modAlm/Arch/perfil/<?php echo $datAlm->foto_perf_alm ?>" class="img-fluid img-thumbnail rounded mt-4" width="300">
						<?php
							} else {
								echo "<img src='../vistas/img/icous.png' class='img-fluid mt-4' width='200'>";
							}
						?>
					</div>
				</div>
				<div class="row mt-4">
					<div class="col-sm-12 col-lg-12 cardShadow rounded">
						<ul class="nav nav-pills mb-3 mt-3" id="pills-tab" role="tablist">
						  <li class="nav-item mr-2">
						    <a class="nav-link active btn btn-sm" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">
								<h6 class="text-center">
									<i class="fas fa-file icoIni fa-lg mt-1"></i>
									Justificantes
								</h6>
						    </a>
						  </li>
						  <li class="nav-item mr-2">
						    <a class="nav-link btn btn-sm" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">
						    	<h6 class="text-center">
						    		<i class="fas fa-chalkboard-teacher fa-lg mt-1"></i>
						    		Tutorias
						    	</h6>
						    </a>
						  </li>
						  <li class="nav-item mr-2">
						    <a class="nav-link btn btn-sm" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">
						    	<h6 class="text-center">
						    		<i class="fas fa-book fa-lg mt-1"></i>
						    		Encuesta</h6>
						    	<div class="prubEnc"></div>
						    </a>
						  </li>
						  <li class="nav-item mr-2">
						    <a class="nav-link btn btn-sm" id="pills-contrasena-tab" data-toggle="pill" href="#pills-contrasena" role="tab" aria-controls="pills-contrasena" aria-selected="false">
						    	<h6 class="text-center">
						    		<i class="fas fa-key fa-lg mt-1"></i>
						    		Contraseña</h6>
						    	<div class="prubEnc"></div>
						    </a>
						  </li>
						  <li class="nav-item mr-2">
						    <a class="nav-link btn btn-sm" id="pills-baja-tab" data-toggle="pill" href="#pills-baja" role="tab" aria-controls="pills-baja" aria-selected="false">
						    	<h6 class="text-center">
						    		<i class="fas fa-times-circle fa-lg mt-1"></i>
						    		Iniciar baja</h6>
						    	<div class="prubEnc"></div>
						    </a>
						  </li>
						</ul>
						<hr>
						<div class="tab-content rounded" id="pills-tabContent">
						  <div class="tab-pane fade show active text-center pad10" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
						  	<div class="btn-group">
								<button data-backdrop="false" data-toggle="modal" data-target="#genJustif" class="btn btn-outline-primary btn-md"><i class="fas fa-plus icoIni"></i>Generar</button>
								<button data-backdrop="false" data-toggle="modal" data-target="#justifAlm" class="btn btn-outline-primary btn-md"><i class="fas fa-eye icoIni"></i>Aceptados 
									<span class="badge badge-danger" id="cantJustAcept">
										<!-- <?php echo $cantJusImp->Cantidad; ?> -->
									</span>
								</button>
								<button data-backdrop="false" data-toggle="modal" data-target="#justifAlmAc" class="btn btn-outline-primary btn-md"><i class="fas fa-check icoIni"></i>Por Aceptar 
									<span class="badge badge-danger" id="cantJustSinAcept">
										<!-- <?php echo $cantJustifAc->Cantidad; ?> -->
									</span></button>
							<?php 
								$dbc = new Connect();
								$dbc = $dbc -> getDB();
								$valid = 1;
								$stmt = $dbc -> prepare("SELECT * FROM alumnos alm 
									INNER JOIN det_grupo det On det.id_detgrupo = alm.id_detgrupo
									INNER JOIN grupos grp ON grp.id_grupo = det.id_grupo
									INNER JOIN justificantes just ON just.id_alumno = alm.id_alumno
									WHERE grp.cuatrimestre_g = just.cuatrimestre_justif && alm.id_alumno = :keyAlm && estado_justif = :valid && just.cuatrimestre_justif = grp.cuatrimestre_g");
								$stmt -> bindParam("keyAlm", $valPerfAlmDec, PDO::PARAM_INT);
								$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
								$stmt -> execute();
								$resstmt = $stmt -> rowCount();
								if ($resstmt == 2 || $resstmt > 2) {
							?>
								<button data-backdrop="false" data-toggle="modal" data-target="#justifAlmAc" class="btn btn-danger btn-lg">
									Ya se han ocupado los 2 justificantes generales
								</button>
							<?php
								} else if ($resstmt == 1) {
							?>
								<button data-backdrop="false" data-toggle="modal" data-target="#justifAlmAc" class="btn btn-primary btn-md">
									Aún queda 1 justificante general disponible
								</button>
							<?php		
								} else {
							?>
								<button data-backdrop="false" data-toggle="modal" data-target="#justifAlmAc" class="btn btn-primary btn-md">
									Aún quedan 2 justificantes generales disponibles
								</button>
							<?php		
								}
							?>
							</div>
							<br><br>
							<div class="text-right">
								<span class="badge badge-primary">
									Registros Totales : <span id="cantJustAll">
										<!-- <?php echo $cantJustif->Cantidad; ?> -->
											
										</span>
								</span>
							</div>
						  </div>
						  <div class="tab-pane fade text-center pad10" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
						  	<div class="btn-group">
								<button data-backdrop="false" data-toggle="modal" data-target="#genHist" class="btn btn-outline-primary btn-md"><i class="fas fa-plus icoIni"></i>Generar</button>
								<button data-backdrop="false" data-toggle="modal" data-target="#histAlm" class="btn btn-outline-primary btn-md"><i class="fas fa-eye icoIni"></i>Ver historial
									<span class="badge badge-danger" id="cantTut">
										<!-- <?php echo $cantTutPerAcp->Cantidad; ?> -->
									</span>
								</button>
								<button data-backdrop="false" data-toggle="modal" data-target="#histAlmSol" class="btn btn-outline-primary btn-md"><i class="fas fa-file icoIni"></i>Solicitudes
									<span class="badge badge-danger" id="cantTutPerSol">
										<!-- <?php echo $cantTutPerSol->Cantidad; ?> -->
									</span>
								</button>
							</div>
							<br><br>
							<div class="text-right">
								<span class="badge badge-primary">
									Registros totales : <span id="cantTutPerAll">
										<!-- <?php echo $cantTutPer->Cantidad ?> -->
											
										</span>
								</span>
							</div>
						  </div>
						  <div class="tab-pane fade text-center pad10" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
						  	<?php 
						  		if ($valEnc->CantEnc == 1) {
						  	?>
						  	<div class="btn-group text-center">
						  		<a href="MostDatEnc.php?v=<?php echo base64_encode($valEnc->id_enctestalm); ?>&&p=<?php echo base64_encode($valPerfAlmDec); ?>" class="btn btn-outline-primary btn-md">
						  			<i class="fas fa-eye icoIni"></i>
						  			Ver datos
						  		</a>
						  	</div>
						  	<br><br>
						  	<div class="text-right">
						  		<span class="badge badge-primary">
						  			Fecha de realización : <?php echo $valEnc->fecha_reg; ?> 
						  		</span>
						  	</div>
						  	<?php		
						  		} else {
						  	?>
						  		<i class="fas fa-times fa-2x text-danger"></i>
						  		<br>
								<h4 class="text-center text-info">Sin completar</h4>
						  	<?php		
						  		}
						  	?>
						  </div>
						  <div class="tab-pane fade show text-center pad10" id="pills-contrasena" role="tabpanel" aria-labelledby="pills-contrasena-tab">
						  	<div class="btn-group">
								<button data-backdrop="false" data-toggle="modal" data-target="#newContAlmEdit" class="btn btn-outline-primary btn-md">
									<i class="fas fa-key icoIni"></i>
									Nueva contraseña
								</button>
							</div>
							<br><br><br>
							<div></div>
						  </div>
							<div class="tab-pane fade show text-center pad10" id="pills-baja" role="tabpanel" aria-labelledby="pills-baja-tab">
						  	<div class="btn-group">
								<a href="RegBajaAlm.php?v=<?php echo base64_encode($datAlm->id_alumno); ?>" class="btn btn-outline-primary btn-md">
									<i class="fas fa-book-open icoIni"></i>
									Iniciar Proceso de Baja del Alumno 
								</a>
							</div>
							<br><br><br>
							<div></div>
						  </div>
						</div>
					</div>
				</div>
				<div class="row mt-5">
					<br>
					<?php 
						if ($valDPAlm -> Cantidad == 1) {
							$dat = $docente -> datAlmAll($valPerfAlmDec);
					?>
					<div class="col-sm-12 col-lg-3 text-center">
						<button onclick="mostDatPer(true),mostDatDom(false), mostDatOrg(false), mostDatHist(false)" class="btn text-primary bg-white cardShadow btn-md" type="button" id="btnMostPer">
							<i class="fas fa-address-card icoIni"></i>
							Datos Personales
						</button>
						<br><br>
					</div>
					<div class="col-sm-12 col-lg-3 text-center">
						<button onclick="mostDatDom(true), mostDatPer(false), mostDatOrg(false), mostDatHist(false)" class="btn text-primary bg-white cardShadow btn-md" type="button" id="btnMostDom">
							<i class="fas fa-address-card icoIni"></i>
							Domicilio Actual
						</button>
						<br><br>
					</div>
					<div class="col-sm-12 col-lg-3 text-center">
						<button onclick="mostDatOrg(true), mostDatDom(false), mostDatPer(false), mostDatHist(false)" class="btn text-primary bg-white cardShadow btn-md" type="button" id="btnMostOrg">
							<i class="fas fa-address-card icoIni"></i>
							Originario De
						</button>
					</div>
					<div class="col-sm-12 col-lg-3 text-center">
						<button onclick="mostDatHist(true), mostDatPer(false), mostDatDom(false), mostDatOrg(false)" class="btn text-primary bg-white cardShadow btn-md" type="button" id="btnMostHist">
							<i class="fas fa-book-open icoIni"></i>
							Historial
						</button>
					</div>
					<hr style="height: 2px;" class="bg-info rounded">
					<div id="datMostPer" class="ocult col-md-12 mt-4">
						<div class="row">
							<div class="col-sm-12 col-md-6 col-lg-6">
								<div class="form-group bg-info cardShadow text-white pad15 rounded">
									<mark class="lead bg-info text-white hInf">Sexo: <span class="rounded pad10"><?php echo $dat->sexo_al; ?></span></mark>
								</div>
								<div class="form-group bg-info cardShadow text-white pad15 rounded">
									<mark class="lead bg-info text-white hInf">Fecha de nacimiento: <span class="pad10 rounded"><?php echo $dat->fecha_nac_dat; ?></span></mark>
								</div>
								<div class="form-group bg-info cardShadow text-white pad15 rounded">
									<mark class="lead bg-info text-white hInf">Tipo de seguridad social: <span class="text-uppercase pad10 rounded"><?php echo $dat->tipo_segsocial_dat; ?></span></mark>
								</div>
								<div class="form-group bg-info cardShadow text-white pad15 rounded">
									<mark class="lead bg-info text-white hInf">Telefono casa: <span class="pad10 rounded"><?php echo $dat->telefono_casa_dat; ?></span></mark>
								</div>
								<div class="form-group bg-info cardShadow text-white pad15 rounded">
									<mark class="lead bg-info text-white hInf">Facebook: <span class="pad10 rounded"><?php echo $dat->facebook_alm_dat; ?></span></mark>
								</div>
								<br>
							</div>
							<div class="col-sm-12 col-md-6 col-lg-6">
								<div class="form-group bg-info cardShadow text-white pad15 rounded">
									<mark class="lead bg-info text-white hInf">Edad: <span class="rounded text-white pad10"><?php echo $dat->edad_dat; ?> Años</span></mark>
								</div>
								<div class="form-group bg-info cardShadow text-white pad15 rounded">
									<mark class="lead bg-info text-white hInf">Curp: <span class="text-uppercase rounded pad10"><?php echo $dat->curp_dat; ?></span></mark>
								</div>
								<div class="form-group bg-info cardShadow text-white pad15 rounded">
									<mark class="lead bg-info text-white hInf">No. seguridad social: <span class="text-uppercase rounded pad10"><?php echo $dat->num_segsocial_dat; ?></span></mark>
								</div>
								<div class="form-group bg-info cardShadow text-white pad15 rounded">
									<mark class="lead bg-info text-white hInf">Telefono recado: <span class="text-uppercase pad10 rounded"><?php echo $dat->telefono_rec_dat; ?></span></mark>
								</div>
								<div class="form-group bg-info cardShadow text-white pad15 rounded">
									<mark class="lead bg-info text-white hInf">Estado civil: <span class="rounded pad10"><?php echo $dat->estado_civil_dat; ?></span></mark>
								</div>
							</div>
						</div>
					</div>
					<div class="ocult col-md-12 mt-4" id="datMostDom">
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group bg-info cardShadow text-white rounded pad15">
									<mark class="lead bg-info text-white rounded pad15 hInf">Calle: <span class="rounded pad10"><?php echo $dat->calle_dat_act; ?></span></mark>
									<mark class="lead bg-info text-white rounded pad15 hInf">No: <span class="rounded pad10"><?php echo $dat->num_casa_dat_act; ?></span></mark>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group bg-info cardShadow text-white rounded pad15">
									<mark class="lead bg-info text-white rounded pad15 hInf">Colonia: <span class="rounded pad10"><?php echo $dat->colonia_dat_act; ?></span></mark>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group bg-info cardShadow text-white rounded pad15">
									<mark class="lead bg-info text-white hInf">Localidad: <span class="rounded pad10"><?php echo $dat->localidad_dat_act; ?></span></mark>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group bg-info cardShadow text-white rounded pad15">
									<mark class="lead bg-info text-white rounded pad15 hInf">Municipio: <span class="rounded pad10"><?php echo $dat->municipio_dat_act; ?></span></mark>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group bg-info cardShadow text-white rounded pad15">
									<mark class="lead bg-info text-white hInf">Estado: <span class="rounded pad10"><?php echo $dat->estado_dat_act; ?></span></mark>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group bg-info cardShadow text-white rounded pad15">
									<mark class="lead bg-info text-white hInf">C.P: <span class="rounded pad10"><?php echo $dat->codpostal_dat_act; ?></span></mark>
								</div>
							</div>
						</div>
					</div>
					<div class="ocult col-md-12 mt-4" id="datMostOrg">
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group bg-info cardShadow text-white rounded pad15">
									<mark class="lead bg-info text-white hInf">Municipio: <span class="rounded pad10"><?php echo $dat->municipio_dat_org; ?></span></mark>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group bg-info cardShadow text-white rounded pad15">
									<mark class="lead bg-info text-white hInf">Estado: <span class="rounded pad10"><?php echo $dat->estado_dat_org; ?></span></mark>
								</div>
							</div>
						</div>
					</div>
					<div class="ocult col-md-12 mt-4" id="datMostHist">
						<div class="row">
							<?php 
								$dbc = new Connect();
								$dbc = $dbc -> getDB();
								$valid = 1;
								$stmt = $dbc -> prepare("SELECT * FROM historial_academ 
									WHERE id_alumno = :valPerfAlmDec && estado_almhist = :valid");
								$stmt -> bindParam("valPerfAlmDec", $valPerfAlmDec, PDO::PARAM_INT);
								$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
								$stmt -> execute();
								$resstmt = $stmt -> rowCount();
								if ($resstmt > 0) {
									while ($res = $stmt -> fetch(PDO::FETCH_OBJ)) {
										if ($res->cuatri_almhist == $datGrup->cuatrimestre_g && $res->tutor_almhist == $datGrup->nombre_c_doc && $res->grupo_almhist == $datGrup->grupo_n && $res->periodcuat_almhist == $datGrup->period_cuat) {
								?>
									<div class="col-sm-4">
										<div class="cardShadow p-4">
											<span class="badge badge-primary">
												Actual
											</span>
											<div class="card-title mt-3">
												<h5 class="text-center">Cuatrimestre: <?php echo $res->cuatri_almhist; ?></h5>
											</div>
											<h6 class="mt-3 text-center">Tutor: <?php echo $res->tutor_almhist; ?></h6>
											<div class="text-right mt-3 border-top border-info row">
												<div class="col-sm-6">
													<h6 class="mt-3"><?php echo $res->grupo_almhist; ?></h6>
												</div>
												<div class="col-sm-6">
													<h6 class="mt-3"><?php echo $res->periodcuat_almhist; ?></h6>
												</div>
											</div>
										</div>
									</div>
								<?php
										} else {
								?>
									<div class="col-sm-4">
										<div class="cardShadow p-4">
											<span class="badge badge-danger">
												Pasado
											</span>
											<div class="card-title mt-3">
												<h5 class="text-center">Cuatrimestre: <?php echo $res->cuatri_almhist; ?></h5>
											</div>
											<h6 class="mt-3 text-center">Tutor: <?php echo $res->tutor_almhist; ?></h6>
											<div class="text-right mt-3 border-top border-info row">
												<div class="col-sm-6">
													<h6 class="mt-3"><?php echo $res->grupo_almhist; ?></h6>
												</div>
												<div class="col-sm-6">
													<h6 class="mt-3"><?php echo $res->periodcuat_almhist; ?></h6>
												</div>
											</div>
										</div>
									</div>
								<?php
										}
								?>
								<?php
									}
								} else {
							?>
								<h1 class="text-center">
									No hay datos
								</h1>
							<?php
								}
							?>
						</div>
					</div>
					<?php
						} else {
					?>
					<div class="text-center">
						<h2> El alumno no ha completado sus datos personales </h2>
						<br>
						<i class="fas fa-frown fa-5x"></i>
					</div>
					<?php 		
						}
					?>
				</div>
			</div>
		</div>
	</div>


	<div class="modal fade bgModal" id="almList" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title text-info" id="exampleModalLabel"><i class="fas fa-list fa-lg icoIni"></i>Listado alumnos</h5>
	        <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <div class="row">
	          <div class="col-sm-12 table-responsive">
	          	<table width="700" class="table" id="tbListadoAlumnos">
	          		<thead>
	          			<th>Nombre:</th>
	          			<th>Correo:</th>
	          			<th>Matricula:</th>
	          			<th>Acciones:</th>
	          		</thead>
	          		<tbody>
	          		</tbody>
	          		<tfoot>
	          			<th>Nombre:</th>
	          			<th>Correo:</th>
	          			<th>Matricula:</th>
	          			<th>Acciones:</th>
	          		</tfoot>
	          	</table>
	          </div>
	        </div>  
	      </div>
	      <div class="modal-footer">
	        <button type="button" id="btnCloseListAlm" class="btn btn-outline-danger" data-dismiss="modal">
			<i class="fas fa-times-circle mr-2"></i>
	        Cerrar</button>
	      </div>
	    </div>
	  </div>
	</div>

	<!--=================================================
	=            Ventana modal justificantes            =
	==================================================-->
	
	<div class="modal fade bgModal" id="genJustif" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title text-info" id="exampleModalLabel"><i class="fas fa-plus fa-lg icoIni"></i>Generar justificante</h5>
	        <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form class="row" method="POST" id="formGenJustif" name="formGenJustif">
	        	<div class="col-sm-1"></div>
	        	<div class="col-sm-10">
	        		<input type="hidden" class="form-control" value="<?php echo base64_encode($valPerfAlmDec); ?>" name="id_alumno">
	        		<div class="form-group">
	        			<label for="sitJustif">Situación:</label>
	        			<textarea id="sitJustif" name="sitJustif" class="form-control" rows="5"></textarea>
	        		</div>
	        		<?php 
	        			if ($datGrup->grupo_n == "101" || $datGrup->grupo_n == "102" || $datGrup->grupo_n == "103" ||
	        			$datGrup->grupo_n == "104" || $datGrup->grupo_n == "105" || $datGrup->grupo_n == "106") {
	        				echo "<div class='form-group'>
									<label for='cuatJustif'>Cuatrimestre:</label>			
									<input type='text' readonly value='Primero' name='cuatJustif' id='cuatJustif' class='form-control'>
	        					</div>";
	        			} else if ($datGrup->grupo_n == "201" || $datGrup->grupo_n == "202" || $datGrup->grupo_n == "203" || $datGrup->grupo_n == "204" || $datGrup->grupo_n == "205" || $datGrup->grupo_n == "206") {
	        				echo "<div class='form-group'>
									<label for='cuatJustif'>Cuatrimestre:</label>			
									<input type='text' readonly value='Segundo' name='cuatJustif' id='cuatJustif' class='form-control'>
	        					</div>";
	        			} else if ($datGrup->grupo_n == "301" || $datGrup->grupo_n == "302" || $datGrup->grupo_n == "303" || $datGrup->grupo_n == "304" || $datGrup->grupo_n == "305" || $datGrup->grupo_n == "306") {
	        				echo "<div class='form-group'>
									<label for='cuatJustif'>Cuatrimestre:</label>			
									<input type='text' readonly value='Tercero' name='cuatJustif' id='cuatJustif' class='form-control'>
	        					</div>";
	        			} else if ($datGrup->grupo_n == "401" || $datGrup->grupo_n == "402" || $datGrup->grupo_n == "403" || $datGrup->grupo_n == "404" || $datGrup->grupo_n == "405" || $datGrup->grupo_n == "406") {
	        				echo "<div class='form-group'>
									<label for='cuatJustif'>Cuatrimestre:</label>			
									<input type='text' readonly value='Cuarto' name='cuatJustif' id='cuatJustif' class='form-control'>
	        					</div>";
	        			} else if ($datGrup->grupo_n == "501" || $datGrup->grupo_n == "502" || $datGrup->grupo_n == "503" || $datGrup->grupo_n == "504" || $datGrup->grupo_n == "505" || $datGrup->grupo_n == "506") {
	        				echo "<div class='form-group'>
									<label for='cuatJustif'>Cuatrimestre:</label>			
									<input type='text' readonly value='Quinto' name='cuatJustif' id='cuatJustif' class='form-control'>
	        					</div>";
	        			} else if ($datGrup->grupo_n == "601" || $datGrup->grupo_n == "602" || $datGrup->grupo_n == "603" || $datGrup->grupo_n == "604" || $datGrup->grupo_n == "605" || $datGrup->grupo_n == "606") {
	        				echo "<div class='form-group'>
									<label for='cuatJustif'>Cuatrimestre:</label>			
									<input type='text' readonly value='Sexto' name='cuatJustif' id='cuatJustif' class='form-control'>
	        					</div>";
	        			} else if ($datGrup->grupo_n == "701" || $datGrup->grupo_n == "702" || $datGrup->grupo_n == "703" || $datGrup->grupo_n == "704" || $datGrup->grupo_n == "705" || $datGrup->grupo_n == "706") {
	        				echo "<div class='form-group'>
									<label for='cuatJustif'>Cuatrimestre:</label>			
									<input type='text' readonly value='Septimo' name='cuatJustif' id='cuatJustif' class='form-control'>
	        					</div>";
	        			} else if ($datGrup->grupo_n == "801" || $datGrup->grupo_n == "802" || $datGrup->grupo_n == "803" || $datGrup->grupo_n == "804" || $datGrup->grupo_n == "805" || $datGrup->grupo_n == "806") {
	        				echo "<div class='form-group'>
									<label for='cuatJustif'>Cuatrimestre:</label>			
									<input type='text' readonly value='Octavo' name='cuatJustif' id='cuatJustif' class='form-control'>
	        					</div>";
	        			} else if ($datGrup->grupo_n == "901" || $datGrup->grupo_n == "902" || $datGrup->grupo_n == "903" || $datGrup->grupo_n == "904" || $datGrup->grupo_n == "905" || $datGrup->grupo_n == "906") {
	        				echo "<div class='form-group'>
									<label for='cuatJustif'>Cuatrimestre:</label>			
									<input type='text' readonly value='Noveno' name='cuatJustif' id='cuatJustif' class='form-control'>
	        					</div>";
	        			} else if ($datGrup->grupo_n == "1001" || $datGrup->grupo_n == "1002" || $datGrup->grupo_n == "1003" || $datGrup->grupo_n == "1004" || $datGrup->grupo_n == "1005" || $datGrup->grupo_n == "1006") {
	        				echo "<div class='form-group'>
									<label for='cuatJustif'>Cuatrimestre:</label>			
									<input type='text' readonly value='Decimo' name='cuatJustif' id='cuatJustif' class='form-control'>
	        					</div>";
	        			} else if ($datGrup->grupo_n == "1101" || $datGrup->grupo_n == "1102" || $datGrup->grupo_n == "1103" || $datGrup->grupo_n == "1104" || $datGrup->grupo_n == "1105" || $datGrup->grupo_n == "1106") {
	        				echo "<div class='form-group'>
									<label for='cuatJustif'>Cuatrimestre:</label>			
									<input type='text' readonly value='Onceavo' name='cuatJustif' id='cuatJustif' class='form-control'>
	        					</div>";
	        			} else {
	        				echo "<div class='form-group'>
									<label for='cuatJustif'>Cuatrimestre:</label>			
									<input type='text' readonly value='sin dato' name='cuatJustif' id='cuatJustif' class='form-control'>
	        					</div>";
	        			}
	        		?>
	        		<div class="form-group">
	        			<label for="fechJustif">Fecha:</label>
	        			<input type="date" id="fechJustif" name="fechJustif" class="form-control">
	        		</div>
	        	</div>
	        	<div class="col-sm-1"></div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" id="btnCloseJustif" class="btn btn-outline-danger" data-dismiss="modal">
			<i class="fas fa-times-circle mr-2"></i>
	        Cerrar</button>
	        <button type="submit" class="btn btn-outline-primary">
			<i class="fas fa-check-circle mr-2"></i>
	        Guardar</button>
	        </form>
	      </div>
	    </div>
	  </div>
	</div>
	
	<!--====  End of Ventana modal generar justificantes  ====-->
	
	<!--=====================================================
	=            Ventana modal ver justificantes            =
	======================================================-->
	
	<div class="modal fade bgModal" id="justifAlm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title text-info" id="exampleModalLabel"><i class="fas fa-list fa-lg icoIni"></i>Listado justificantes</h5>
	        <button id="btnJustAlmRel" type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <div class="row">
	          <div class="col-sm-12 table-responsive">
	          	<table width="700" class="table" id="tbListadoJustificantes">
	          		<thead>
	          			<th>Situación:</th>
	          			<th>Cuatrimestre:</th>
	          			<th>Fecha justificante:</th>
	          			<th>Fecha registro:</th>
	          			<th>Archivo:</th>
	          			<th>Acciones:</th>
	          		</thead>
	          		<tbody>
	          		</tbody>
	          		<tfoot>
	          			<th>Situación:</th>
	          			<th>Cuatrimestre:</th>
	          			<th>Fecha justificante:</th>
	          			<th>Fecha registro:</th>
	          			<th>Archivo:</th>
	          			<th>Acciones:</th>
	          		</tfoot>
	          	</table>
	          </div>
	        </div>  
	      </div>
	      <div class="modal-footer">
	        <button type="button" id="btnCloseListAlm" class="btn btn-outline-danger" data-dismiss="modal">
			<i class="fas fa-times-circle mr-2"></i>
	        Cerrar</button>
	      </div>
	    </div>
	  </div>
	</div>
	
	<!--====  End of Ventana modal ver justificantes  ====-->
	
	<!--=====================================================
	=            Ventana modal ver justificantes aceptar            =
	======================================================-->
	
	<div class="modal fade bgModal" id="justifAlmAc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title text-info" id="exampleModalLabel"><i class="fas fa-list fa-lg icoIni"></i>Listado justificantes</h5>
	        <button id="btnJustAlmAceptRel" type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <div class="row">
	          <div class="col-sm-12 table-responsive">
	          	<table width="700" class="table" id="tbListadoJustificantesAC">
	          		<thead>
	          			<th>Situación:</th>
	          			<th>Cuatrimestre:</th>
	          			<th>Fecha justificante:</th>
	          			<th>Fecha registro:</th>
	          			<th>Archivo:</th>
	          			<th>Acciones:</th>
	          		</thead>
	          		<tbody>
	          		</tbody>
	          		<tfoot>
	          			<th>Situación:</th>
	          			<th>Cuatrimestre:</th>
	          			<th>Fecha justificante:</th>
	          			<th>Fecha registro:</th>
	          			<th>Archivo:</th>
	          			<th>Acciones:</th>
	          		</tfoot>
	          	</table>
	          </div>
	        </div>  
	      </div>
	      <div class="modal-footer">
	        <button type="button" id="btnCloseListAlmAcept" class="btn btn-outline-danger" data-dismiss="modal">
			<i class="fas fa-times-circle mr-2"></i>
	        Cerrar</button>
	      </div>
	    </div>
	  </div>
	</div>
	
	<!--====  End of Ventana modal justificantes aceptar  ====-->

	<!--=================================================
	=            Ventana modal generar historial            =
	==================================================-->
	
	<div class="modal fade bgModal" id="genHist" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title text-info" id="exampleModalLabel"><i class="fas fa-plus fa-lg icoIni"></i>Tutoria personalizada</h5>
	        <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form class="row" method="POST" id="formHistAlm" name="formHistAlm">
	        	<div class="col-sm-1"></div>
	        	<div class="col-sm-10">
	        		<input type="hidden" class="form-control" value="<?php echo base64_encode($valPerfAlmDec); ?>" name="id_alumno">
	        		<div class="form-group">
	        			<label>Cuatrimestre:</label>
	        			<input type="text" class="form-control" value="<?php echo $datAlm->cuatrimestre_g; ?>" name="cuatnom" readonly>
	        		</div>
	        		<div class="form-group">
	        			<label for="razHist">Razones:</label>
	        			<textarea id="razHist" name="razHist" class="form-control" rows="5"></textarea>
	        		</div>
	        		<div class="form-group">
	        			<label for="priHist">Prioridad:</label>
	        			<select class="form-control" id="priHist" name="priHist">
							<option value="0" selected="">Selecciona</option>
							<option value="Alta">Alta</option>
							<option value="Media">Media</option>
							<option value="Baja">Baja</option>
						</select>
	        		</div>
	        		<div class="form-group">
	        			<label for="obsHist">Observaciones</label>
	        			<textarea id="obsHist" name="obsHist" class="form-control" rows="5"></textarea>
	        		</div>
	        		<div class="form-group">
		          		<label for="citFech2">Fecha de la cita:</label>
		          		<input required="" type="date" id="citFech2" name="citFech" class="form-control">
		          	</div>
		          	<div class="form-group">
		          		<label for="timCit2">Hora de la cita:</label>
		          		<input required="" type="time" id="timCit2" name="timCit" class="form-control">
		          	</div>
	        	</div>
	        	<div class="col-sm-1"></div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" id="btnCloseHist" class="btn btn-outline-danger" data-dismiss="modal">
			<i class="fas fa-times-circle mr-2"></i>
	        Cerrar</button>
	        <button type="submit" class="btn btn-outline-primary">
			<i class="fas fa-check-circle mr-2"></i>
	        Guardar</button>
	        </form>
	      </div>
	    </div>
	  </div>
	</div>
	
	<!--====  End of Ventana modal generar historial  ====-->
	
	<!--=================================================
	=            Ventana modal ver historial            =
	==================================================-->
	
	<div class="modal fade bgModal" id="histAlm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title text-info" id="exampleModalLabel"><i class="fas fa-list fa-lg icoIni"></i>Listado tutorías personalizada</h5>
	        <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
			<div class="row">
	          <div class="col-sm-12 table-responsive">
	          	<table width="700" class="table" id="tbListadoHistorial">
	          		<thead>
	          			<th>Cuatrimestre:</th>
	          			<th>Razones:</th>
	          			<th>Prioridad:</th>
	          			<th>Fecha registro:</th>
	          			<th>Acciones:</th>
	          		</thead>
	          		<tbody>
	          		</tbody>
	          		<tfoot>
	          			<th>Cuatrimestre:</th>
	          			<th>Razones:</th>
	          			<th>Prioridad:</th>
	          			<th>Fecha registro:</th>
	          			<th>Acciones:</th>
	          		</tfoot>
	          	</table>
	          </div>
	        </div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" id="btnCloseHist" class="btn btn-outline-danger" data-dismiss="modal">
			<i class="fas fa-times-circle mr-2"></i>
	        Cerrar</button>
	        <button type="submit" class="btn btn-outline-primary">
			<i class="fas fa-check-circle mr-2"></i>
	        Guardar</button>
	      </div>
	    </div>
	  </div>
	</div>
	
	<!--====  End of Ventana modal ver historial  ====-->

	<!--=================================================
	=            Ventana modal ver historial solicitudes            =
	==================================================-->
	
	<div class="modal fade bgModal" id="histAlmSol" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title text-info" id="exampleModalLabel"><i class="fas fa-list fa-lg icoIni"></i>Listado tutorías personalizada (Solicitudes)</h5>
	        <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
			<div class="row">
	          <div class="col-sm-12 table-responsive">
	          	<table width="700" class="table" id="tbListadoHistorialSolic">
	          		<thead>
	          			<th>Razones:</th>
	          			<th>Prioridad:</th>
	          			<th>Fecha registro:</th>
	          			<th>Acciones:</th>
	          		</thead>
	          		<tbody>
	          		</tbody>
	          		<tfoot>
	          			<th>Razones:</th>
	          			<th>Prioridad:</th>
	          			<th>Fecha registro:</th>
	          			<th>Acciones:</th>
	          		</tfoot>
	          	</table>
	          </div>
	        </div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" id="btnCloseHist" class="btn btn-outline-danger" data-dismiss="modal">
			<i class="fas fa-times-circle mr-2"></i>
	        Cerrar</button>
	        <button type="submit" class="btn btn-outline-primary">
			<i class="fas fa-check-circle mr-2"></i>
	        Guardar</button>
	      </div>
	    </div>
	  </div>
	</div>
	
	<!--====  End of Ventana modal ver historial solicitudes  ====-->	

	<br><br><br>
	<?php include 'modalsconf.php'; ?>
	<?php include 'modTest/modalNewContAlm.php'; ?>
	<?php include 'modTest/tutPerCit.php'; ?>

	<script src="../vistas/js/jquery-3.1.1.min.js"></script>
	<!-- SweetAlert -->
    <script src="../vistas/node_modules/sweetalert/dist/sweetalert.min.js"></script>
    <script src="../vistas/datatables/jquery.dataTables.min.js"></script>    
    <script src="../vistas/datatables/dataTables.buttons.min.js"></script>
    <script src="../vistas/datatables/buttons.html5.min.js"></script>
    <script src="../vistas/datatables/buttons.colVis.min.js"></script>
    <script src="../vistas/datatables/jszip.min.js"></script>
    <script src="../vistas/datatables/pdfmake.min.js"></script>
    <script src="../vistas/datatables/vfs_fonts.js"></script> 
    <!-- Bootstrap -->
    <script src="../vistas/Assets/js/vendor/popper.min.js"></script>
    <script src="../vistas/Js/bootstrap.min.js"></script>
    <script src="../vistas/assets/js/vendor/holder.min.js"></script>
    <!--- Personalizados -->
    <script src="../vistas/modulos/doc/js/confDatDoc.js"></script>
	<script src="../vistas/modulos/doc/js/AlmGrp.js"></script>
	<script src="../vistas/modulos/doc/js/notifAlmGrp.js"></script>
	<?php include 'footer2.php'; ?>

<?php		
	} else {
		header("Location:Logout.php");
	}
}

ob_end_flush();
?>