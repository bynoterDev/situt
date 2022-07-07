<br><br>
	<br>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12 col-lg-1"></div>
			<div class="col-sm-12 col-lg-10 pad30 border border-success cardShadow" style="border-radius: 10px;">
				<ul class="nav nav-pills mb-3 pad10" id="pills-tab" role="tablist">
				  <li class="nav-item mr-2">
				    <a class="nav-link active btn colM bg" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">
						<h4 class="text-center">
							<i class="fas fa-file icoIni fa-lg mt-1"></i>
							Justificantes
						</h4>
				    </a>
				  </li>
				  <li class="nav-item mr-2">
				    <a class="nav-link btn colM" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">
				    	<h4 class="text-center">
				    		<i class="fas fa-chalkboard-teacher fa-lg icoIni mt-1"></i>
				    		Tutorias
				    	</h4>
				    </a>
				  </li>
				  <li class="nav-item mr-2">
				    <a class="nav-link btn colM" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">
				    	<h4 class="text-center">
				    		<i class="fas fa-book fa-lg icoIni mt-1"></i>
				    		Encuesta</h4>
				    	<div class="prubEnc"></div>
				    </a>
				  </li>
				  <li class="nav-item mr-2">
				    <a class="nav-link btn colM" id="pills-contrasena-tab" data-toggle="pill" href="#pills-contrasena" role="tab" aria-controls="pills-contrasena" aria-selected="false">
				    	<h4 class="text-center">
				    		<i class="fas fa-key fa-lg icoIni mt-1"></i>
				    		Contraseña</h4>
				    	<div class="prubEnc"></div>
				    </a>
				  </li>
				  <li class="nav-item mr-2">
				    <a class="nav-link btn colM" id="pills-baja-tab" data-toggle="pill" href="#pills-baja" role="tab" aria-controls="pills-baja" aria-selected="false">
				    	<h4 class="text-center">
				    		<i class="fas fa-times-circle fa-lg icoIni mt-1"></i>
				    		Iniciar baja</h4>
				    	<div class="prubEnc"></div>
				    </a>
				  </li>
				</ul>
				<hr>
				<div class="tab-content rounded" id="pills-tabContent">
				  <div class="tab-pane fade show active text-center pad10" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
				  	<div class="btn-group">
						<button data-backdrop="false" data-toggle="modal" data-target="#genJustif" class="btn btn-outline-success btn-lg"><i class="fas fa-plus icoIni"></i>Generar</button>
						<button data-backdrop="false" data-toggle="modal" data-target="#justifAlm" class="btn btn-outline-success btn-lg"><i class="fas fa-eye icoIni"></i>Aceptados 
							<span class="badge badge-danger" id="cantJustAcept" style="margin-left: 10px; font-size: 20px;">
								<!-- <?php echo $cantJusImp->Cantidad; ?> -->
							</span>
						</button>
						<button data-backdrop="false" data-toggle="modal" data-target="#justifAlmAc" class="btn btn-outline-success btn-lg"><i class="fas fa-check icoIni"></i>Por Aceptar 
							<span class="badge badge-danger" id="cantJustSinAcept" style="margin-left: 10px; font-size: 20px;">
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
						<button data-backdrop="false" data-toggle="modal" data-target="#justifAlmAc" class="btn btn-success btn-lg">
							Aún queda 1 justificante general disponible
						</button>
					<?php		
						} else {
					?>
						<button data-backdrop="false" data-toggle="modal" data-target="#justifAlmAc" class="btn btn-success btn-lg">
							Aún quedan 2 justificantes generales disponibles
						</button>
					<?php		
						}
					?>
					</div>
					<br><br>
					<div class="text-right">
						<span class="lead">
							Total : <span id="cantJustAll">
								<!-- <?php echo $cantJustif->Cantidad; ?> -->
									
								</span> Registros.
						</span>
					</div>
				  </div>
				  <div class="tab-pane fade text-center pad10" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
				  	<div class="btn-group">
						<button data-backdrop="false" data-toggle="modal" data-target="#genHist" class="btn btn-outline-success btn-lg"><i class="fas fa-plus icoIni"></i>Generar</button>
						<button data-backdrop="false" data-toggle="modal" data-target="#histAlm" class="btn btn-outline-success btn-lg"><i class="fas fa-eye icoIni"></i>Ver historial
							<span class="badge badge-danger" id="cantTut" style="margin-left: 10px; font-size: 20px;">
								<!-- <?php echo $cantTutPerAcp->Cantidad; ?> -->
							</span>
						</button>
						<button data-backdrop="false" data-toggle="modal" data-target="#histAlmSol" class="btn btn-outline-success btn-lg"><i class="fas fa-file icoIni"></i>Solicitudes
							<span class="badge badge-danger" id="cantTutPerSol" style="margin-left: 10px; font-size: 20px;">
								<!-- <?php echo $cantTutPerSol->Cantidad; ?> -->
							</span>
						</button>
					</div>
					<br><br>
					<div class="text-right">
						<span class="lead">
							Total : <span id="cantTutPerAll">
								<!-- <?php echo $cantTutPer->Cantidad ?> -->
									
								</span> Registros.
						</span>
					</div>
				  </div>
				  <div class="tab-pane fade text-center pad10" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
				  	<?php 
				  		if ($valEnc->CantEnc == 1) {
				  	?>
				  	<div class="btn-group text-center">
				  		<a href="MostDatEnc.php?v=<?php echo base64_encode($valEnc->id_enctestalm); ?>&&p=<?php echo base64_encode($valPerfAlmDec); ?>" class="btn btn-outline-success btn-lg">
				  			<i class="fas fa-eye icoIni"></i>
				  			Ver datos
				  		</a>
				  	</div>
				  	<br><br>
				  	<div class="text-right">
				  		<span class="lead">
				  			Fecha de realización : <?php echo $valEnc->fecha_reg; ?> 
				  		</span>
				  	</div>
				  	<?php		
				  		} else {
				  	?>
						<h1>Sin completar</h1>
				  	<?php		
				  		}
				  	?>
				  </div>
				  <div class="tab-pane fade show text-center pad10" id="pills-contrasena" role="tabpanel" aria-labelledby="pills-contrasena-tab">
				  	<div class="btn-group">
						<button data-backdrop="false" data-toggle="modal" data-target="#newContAlmEdit" class="btn btn-outline-success btn-lg">
							<i class="fas fa-key icoIni"></i>
							Nueva contraseña
						</button>
					</div>
					<br><br>
					<div></div>
				  </div>
					<div class="tab-pane fade show text-center pad10" id="pills-baja" role="tabpanel" aria-labelledby="pills-baja-tab">
				  	<div class="btn-group">
						<a href="RegBajaAlm.php?v=<?php echo base64_encode($datAlm->id_alumno); ?>" class="btn btn-outline-success btn-lg">
							<i class="fas fa-book-open icoIni"></i>
							Iniciar Proceso de Baja del Alumno 
						</a>
					</div>
					<br><br>
					<div></div>
				  </div>
				</div>
			</div>
			<div class="col-sm-12 col-lg-1"></div>
		</div>
	</div>
	<br><br>
	<hr><br>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-4">
				<div class="cardBg text-center cardShadow rounded border-top border-left border-right pad10">
					<?php 
						if ($datAlm -> foto_perf_alm == "" && $datAlm -> sexo_al == "Masculino") {
							echo "<img src='../vistas/img/usermal.png' class='img-fluid mt-4' width='200'>";
						} else if ($datAlm -> foto_perf_alm != "" && $datAlm -> sexo_al == "Masculino") {
					?>
						<img src="http://localhost/TutoriasFront/modAlm/Arch/perfil/<?php echo $datAlm->foto_perf_alm ?>" class="img-fluid img-thumbnail rounded mt-4" width="300">
					<?php
						} else if ($datAlm -> foto_perf_alm == "" && $datAlm -> sexo_al == "Femenino") {
							echo "<img src='../vistas/img/userfem.png' class='img-fluid mt-4' width='200'>";
						} else if ($datAlm -> foto_perf_alm != "" && $datAlm -> sexo_al == "Femenino") {
					?>
						<img src="http://localhost/TutoriasFront/modAlm/Arch/perfil/<?php echo $datAlm->foto_perf_alm ?>" class="img-fluid img-thumbnail rounded mt-4" width="300">
					<?php
						} else {
							echo "<img src='../vistas/img/icous.png' class='img-fluid mt-4' width='200'>";
						}
					?>
				</div>
				<div class="pad10 rounded cardShadow border-right border-left border-bottom">
					<h3 class="text-center text-capitalize mt-1 mb-4"><?php echo $datAlm->nombre_c_al; ?></h3>
					<hr style="height: 2px;" class="rounded bg-success cardShadow">
					<h5 class="text-left ml-2 mt-4">
						<i class="fas fa-envelope fa-lg icoIni"></i>
						<?php echo $datAlm->correo_al; ?></h5>
					<h5 class="text-left ml-2 mt-4">
						<i class="fas fa-id-card-alt fa-lg icoIni"></i>
						<?php echo $datAlm->matricula_al; ?></h5>
					<h5 class="text-left ml-2 mt-4">
						<i class="fas fa-phone fa-lg icoIni"></i>
						<?php echo $datAlm->telefono_al; ?></h5>
					<div class="text-center mt-4 mb-4">
					<?php 
						if ($datAlm->estado_al != 0) {
					?>
					<button class="btn btn-danger btn-lg" type="button" onclick="desactAlm(<?php echo $datAlm->id_alumno; ?>)">
						<i class="fas fa-times fa-lg icoIni"></i>
						Desactivar cuenta
					</button>
					<?php		
						} else {
					?>
					<button class="btn btn-success btn-lg" type="button" onclick="activAlm(<?php echo $datAlm->id_alumno; ?>)">
						<i class="fas fa-check fa-lg icoIni"></i>
						Activar cuenta
					</button>
					<?php
						}
					?>
				</div>
				</div>
			</div>
			<div class="col-sm-12 col-md-12 col-lg-8">
				<br>
				<?php 
					if ($valDPAlm -> Cantidad == 1) {
						$dat = $docente -> datAlmAll($valPerfAlmDec);
				?>
				<div class="row text-center">
					<div class="col-sm-12 col-lg-4">
						<button onclick="mostDatPer(true),mostDatDom(false), mostDatOrg(false)" class="btn text-success bg-white cardShadow btn-lg" type="button" id="btnMostPer">
							<i class="fas fa-address-card fa-lg icoIni"></i>
							Datos Personales
						</button>
						<br><br>
					</div>
					<div class="col-sm-12 col-lg-4">
						<button onclick="mostDatDom(true), mostDatPer(false), mostDatOrg(false)" class="btn text-success bg-white cardShadow btn-lg" type="button" id="btnMostDom">
							<i class="fas fa-address-card fa-lg icoIni"></i>
							Domicilio Actual
						</button>
						<br><br>
					</div>
					<div class="col-sm-12 col-lg-4">
						<button onclick="mostDatOrg(true), mostDatDom(false), mostDatPer(false)" class="btn text-success bg-white cardShadow btn-lg" type="button" id="btnMostOrg">
							<i class="fas fa-address-card fa-lg icoIni"></i>
							Originario De
						</button>
					</div>
				</div>
				<br>
				<hr style="height: 2px;" class="bg-success rounded cardShadow">
				<br>
				<div id="datMostPer" class="ocult">
					<div class="row">
						<div class="col-sm-12 col-md-6 col-lg-6">
							<div class="form-group bg-white cardShadow text-success pad15 rounded">
								<mark class="lead bg-white text-success hInf">Sexo: <span class="rounded pad10"><?php echo $dat->sexo_al; ?></span></mark>
							</div>
							<div class="form-group bg-white cardShadow text-success pad15 rounded">
								<mark class="lead bg-white text-success hInf">Fecha de nacimiento: <span class="pad10 rounded"><?php echo $dat->fecha_nac_dat; ?></span></mark>
							</div>
							<div class="form-group bg-white cardShadow text-success pad15 rounded">
								<mark class="lead bg-white text-success hInf">Tipo de seguridad social: <span class="text-uppercase pad10 rounded"><?php echo $dat->tipo_segsocial_dat; ?></span></mark>
							</div>
							<div class="form-group bg-white cardShadow text-success pad15 rounded">
								<mark class="lead bg-white text-success hInf">Telefono casa: <span class="pad10 rounded"><?php echo $dat->telefono_casa_dat; ?></span></mark>
							</div>
							<div class="form-group bg-white cardShadow text-success pad15 rounded">
								<mark class="lead bg-white text-success hInf">Facebook: <span class="pad10 rounded"><?php echo $dat->facebook_alm_dat; ?></span></mark>
							</div>
							<br>
						</div>
						<div class="col-sm-12 col-md-6 col-lg-6">
							<div class="form-group bg-white cardShadow text-success pad15 rounded">
								<mark class="lead bg-white text-success hInf">Edad: <span class="rounded text-white pad10"><?php echo $dat->edad_dat; ?> Años</span></mark>
							</div>
							<div class="form-group bg-white cardShadow text-success pad15 rounded">
								<mark class="lead bg-white text-success hInf">Curp: <span class="text-uppercase rounded pad10"><?php echo $dat->curp_dat; ?></span></mark>
							</div>
							<div class="form-group bg-white cardShadow text-success pad15 rounded">
								<mark class="lead bg-white text-success hInf">No. seguridad social: <span class="text-uppercase rounded pad10"><?php echo $dat->num_segsocial_dat; ?></span></mark>
							</div>
							<div class="form-group bg-white cardShadow text-success pad15 rounded">
								<mark class="lead bg-white text-success hInf">Telefono recado: <span class="text-uppercase pad10 rounded"><?php echo $dat->telefono_rec_dat; ?></span></mark>
							</div>
							<div class="form-group bg-white cardShadow text-success pad15 rounded">
								<mark class="lead bg-white text-success hInf">Estado civil: <span class="rounded pad10"><?php echo $dat->estado_civil_dat; ?></span></mark>
							</div>
						</div>
					</div>
				</div>
				<div class="ocult" id="datMostDom">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group bg-white cardShadow text-success rounded pad15">
								<mark class="lead bg-white text-success rounded pad15 hInf">Calle: <span class="rounded pad10"><?php echo $dat->calle_dat_act; ?></span></mark>
								<mark class="lead bg-white text-success rounded pad15 hInf">No: <span class="rounded pad10"><?php echo $dat->num_casa_dat_act; ?></span></mark>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group bg-white cardShadow text-success rounded pad15">
								<mark class="lead bg-white text-success rounded pad15 hInf">Colonia: <span class="rounded pad10"><?php echo $dat->colonia_dat_act; ?></span></mark>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group bg-white cardShadow text-success rounded pad15">
								<mark class="lead bg-white text-success hInf">Localidad: <span class="rounded pad10"><?php echo $dat->localidad_dat_act; ?></span></mark>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group bg-white cardShadow text-success rounded pad15">
								<mark class="lead bg-white text-success rounded pad15 hInf">Municipio: <span class="rounded pad10"><?php echo $dat->municipio_dat_act; ?></span></mark>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group bg-white cardShadow text-success rounded pad15">
								<mark class="lead bg-white text-success hInf">Estado: <span class="rounded pad10"><?php echo $dat->estado_dat_act; ?></span></mark>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group bg-white cardShadow text-success rounded pad15">
								<mark class="lead bg-white text-success hInf">C.P: <span class="rounded pad10"><?php echo $dat->codpostal_dat_act; ?></span></mark>
							</div>
						</div>
					</div>
				</div>
				<div class="ocult" id="datMostOrg">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group bg-white cardShadow text-success rounded pad15">
								<mark class="lead bg-white text-success hInf">Municipio: <span class="rounded pad10"><?php echo $dat->municipio_dat_org; ?></span></mark>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group bg-white cardShadow text-success rounded pad15">
								<mark class="lead bg-white text-success hInf">Estado: <span class="rounded pad10"><?php echo $dat->estado_dat_org; ?></span></mark>
							</div>
						</div>
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