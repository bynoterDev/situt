<?php 

session_start();

if ($_SESSION['keyDoc'] == "" || $_SESSION['keyDoc'] == null) {
	header("Location:../Index.php");
} else {
	include '../modelos/docente.modelo.php';
	$docente = new Docentes();
	include '../modelos/rutas.php';
	$urlFront = new Ruta();
	$urlFront = $urlFront -> ctrRutaFront();
	$keyDoc = $_SESSION['keyDoc'];
	$valDatEnc = $_GET['v'];
	$valPerfAlm = $_GET['p'];
	$grp = $_SESSION["clvGrp"];
	$datGrup = $docente->datGrpSel($keyDoc, $grp);
	$valDatEncDec = base64_decode($valDatEnc);
	$datDoce = $docente->userDocDet($keyDoc);
	if ($datDoce) {
		$datEnc = $docente -> valDataEncTest($valDatEncDec, base64_decode($valPerfAlm));
		if ($datEnc->CantVal == 1) {
			$cantEval = $docente -> validEvalTest($valDatEncDec);
			$dataT = $docente -> dataEnctTest($valDatEncDec, base64_decode($valPerfAlm));
			$dataP = $docente -> datAlmAll(base64_decode($valPerfAlm));
?>

	<?php include "header2.php"; ?>
	<style type="text/css">
		.colM {
			color: #28a745;
		}
		.colM:hover {
			color: #fff;
			background: #28a745;
			transition: 1s;
		}
	</style>
	<br><br><br><br>

	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<a class="btn text-primary bg-white cardShadow mr-3 btn-md" href="PerfAlm.php?v=<?php echo $valPerfAlm; ?>">
					<i class="fas fa-arrow-left fa-lg icoIni"></i>
					Regresar
				</a>
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
			<div class="col-md-8 col-lg-9">
				<div class="text-center bg-primary p-1" style="border-radius: 8px;">
					<h4 class="text-center text-white mt-3"> 
						<?php echo "Carrera: ".$datGrup->nombre_car.", Grupo: ".$datGrup->grupo_n."."; ?>
					</h4>
				</div>
				<div class="row mt-4">
					<div class="col-sm-6 mt-5">
						<h5 class="text-center text-info text-capitalize">
							<br>
							<i class="fas fa-user-graduate mr-2"></i>
							Alumno a evaluar:
							<b>
								<?php echo $dataP->nombre_c_al; ?>
							</b>
						</h5>
						<hr style="height: 2px;" class="bg-info rounded">
					</div>
					<div class="col-sm-6 text-center">
						<?php 
							if ($dataP -> foto_perf_alm == "" && $dataP -> sexo_al == "Masculino") {
								echo "<img src='../vistas/img/usermal.png' class='img-fluid' width='200'>";
							} else if ($dataP -> foto_perf_alm != "" && $dataP -> sexo_al == "Masculino") {
						?>
							<img src="<?php echo $urlFront;?>modAlm/Arch/perfil/<?php echo $dataP->foto_perf_alm ?>" class="img-fluid img-thumbnail" width="300">
						<?php
							} else if ($dataP -> foto_perf_alm == "" && $dataP -> sexo_al == "Femenino") {
								echo "<img src='../vistas/img/userfem.png' class='img-fluid' width='200'>";
							} else if ($dataP -> foto_perf_alm != "" && $dataP -> sexo_al == "Femenino") {
						?>
							<img src="<?php echo $urlFront;?>modAlm/Arch/perfil/<?php echo $dataP->foto_perf_alm ?>" class="img-fluid img-thumbnail rounded" width="300">
						<?php
							} else {
								echo "<img src='../vistas/img/icous.png' class='img-fluid' width='200'>";
							}
						?>
					</div>
				</div>
				<div class="row mt-5">
					<form class="col-sm-12" method="POST" id="formEvalTest" name="formEvalTest">
						<ul class="nav nav-pills mb-5 text-center" id="pills-tab" role="tablist">
							<li class="nav-item mr-sm-1 mr-md-3 mr-lg-5">
							   	<a class="nav-link cardShadow active btn" id="pills-datGen-tab" data-toggle="pill" href="#pills-datGen" role="tab" aria-controls="pills-datGen" aria-selected="true">
							   		<h6> 
										<i class="fas fa-address-book fa-lg mr-2"></i>
									   	Generales
									</h6>
								</a>
							</li>
							<li class="nav-item mr-sm-1 mr-md-3 mr-lg-5">
							   	<a class="nav-link cardShadow btn" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"><h6> 
								<i class="fas fa-money-check-alt fa-lg mr-2"></i>
							   	SocioEconomicos</h6></a>
							</li>
							<li class="nav-item mr-sm-1 mr-md-3 mr-lg-5">
							  	<a class="nav-link cardShadow btn" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false"><h6> 
								<i class="fas fa-child fa-lg mr-2"></i>
							  	Personales</h6></a>
							</li>
							<li class="nav-item mr-sm-1 mr-md-3 mr-lg-5">
							    <a class="nav-link cardShadow btn" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false"><h6> 
								<i class="fas fa-graduation-cap fa-lg mr-2"></i>
							    Acedemicos</h6></a>
							</li>
							<li class="nav-item mr-sm-1 mr-md-3">
							    <a class="nav-link cardShadow btn" id="pills-evaluar-tab" data-toggle="pill" href="#pills-evaluar" role="tab" aria-controls="pills-evaluar" aria-selected="false"><h6>
								<i class="fas fa-check-circle mr-2"></i>
							    Evaluar</h6></a>
							</li>
						</ul>
						<hr style="height: 2px;" class="bg-info rounded">
						<br>
						<div class="tab-content" id="pills-tabContent">
							<div class="tab-pane cardShadow bg-white text-info rounded pad30 fade show active" id="pills-datGen" role="tabpanel" aria-labelledby="pills-datGen-tab">
								<?php include "modTest/DatGenerales.php"; ?>
							</div>
							<div class="tab-pane cardShadow bg-white text-info rounded pad30 fade" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
								<?php include "modTest/DatSocioEconomicos.php"; ?>
							</div>
							<div class="tab-pane cardShadow bg-white text-info rounded pad30 fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
								<?php include "modTest/DatPersonales.php"; ?>
							</div>
							<div class="tab-pane cardShadow bg-white text-info rounded pad30 fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
								<?php include "modTest/DatAcademicos.php"; ?>
							</div>
							<div class="tab-pane cardShadow bg-white text-info rounded pad30 fade" id="pills-evaluar" role="tabpanel" aria-labelledby="pills-evaluar-tab">
								<?php 
									if ($cantEval -> Cantidad == 0) {
								?>
									<div class="container-fluid">
										<div class="row">
											<div class="col-sm-12">
												<input type="hidden" value="<?php echo $valDatEnc; ?>" name="id_testalm">
												<div class="form-group">
													<label for="vulnerable" class=" font-weight-bold">
														<b class="lead">1. </b>
														De acuerdo a la información obtenida en los aspectos I, II Y III. ¿Se considera al alumno como elemento de uno o más grupos altamente vulnerables?
													</label>
												</div>
											</div>
											<div class="col-sm-4">
												<div class="form-group">
													<select class="form-control" id="vulnerable" name="vulnerable">
														<option value="0" selected="">Selecciona</option>
														<option value="Si">Si</option>
														<option value="No">No</option>
													</select>
												</div>
											</div>
											<div class="col-sm-12">
												<div class="form-group">
													<label class=" font-weight-bold">
														<b class="lead">2. </b>
														Marque los grupos en los que se considera se incluye al alumno altamente vulnerable.
													</label>
												</div>
											</div>
											<div class="col-sm-4">
												<div class="form-group">
													<div class="form-check">
														<input class="form-check-input" type="checkbox" name="opcion1" id="opcion1" value="Aspectos socioeconomicos">
														<label class="form-check-label " for="opcion1">
														   Aspectos socioeconomicos
														</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" name="opcion2" id="opcion2" value="Aspectos personales">
														<label class="form-check-label " for="opcion2">
														   Aspectos personales
														</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" name="opcion3" id="opcion3" value="Aspectos academicos">
														<label class="form-check-label " for="opcion3">
														   Aspectos academicos
														</label>
													</div>
												</div>
											</div>
											<div class="col-sm-12">
												<div class="form-group">
													<label class="font-weight-bold">
														<b class="lead">3. </b>
														De los siguientes aspectos, seleccione aquellos que usted observa en el alumno de forma evidente
													</label>
												</div>
											</div>
											<div class="col-sm-12">
												<div class="form-group">
													<div class="form-check">
														<input class="form-check-input" type="checkbox" name="obesidad" id="obesidad" value="OBESIDAD">
														<label class="form-check-label " for="obesidad">
														   OBESIDAD
														</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" name="delgadezExt" id="delgadezExt" value="DELGADEZ EXTREMA">
														<label class="form-check-label " for="delgadezExt">
														   DELGADEZ EXTREMA
														</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" name="manchasPiel" id="manchasPiel" value="MANCHAS EN LA PIEL">
														<label class="form-check-label " for="manchasPiel">
														   MANCHAS EN LA PIEL
														</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" name="faltaEnergia" id="faltaEnergia" value="FALTA DE ENERGIA">
														<label class="form-check-label " for="faltaEnergia">
														   FALTA DE ENERGIA
														</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" name="problemDen" id="problemDen" value="PROBLEMAS DE DENTADURA">
														<label class="form-check-label " for="problemDen">
														   PROBLEMAS DE DENTADURA
														</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" name="problemVis" id="problemVis" value="PROBLEMAS VISUALES">
														<label class="form-check-label " for="problemVis">
														   PROBLEMAS VISUALES
														</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" name="problemAud" id="problemAud" value="PROBLEMAS AUDITIVOS">
														<label class="form-check-label " for="problemAud">
														   PROBLEMAS AUDITIVOS
														</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" name="discapacidades" id="discapacidades" value="DISCAPACIDADES">
														<label class="form-check-label" for="discapacidades">
														   DISCAPACIDADES
														</label>
													</div>
												</div>
												<div class="form-group">
													<label for="otro" class="">Otro:</label>
													<input type="text" class="form-control" id="otro" name="otro">
												</div>
											</div>
											<div class="col-sm-12">
												<div class="form-group">
													<label class="font-weight-bold ">
														<b class="lead">4. </b>
														Observaciones del tutor
													</label>
												</div>
											</div>
											<div class="col-sm-12">
												<div class="form-group">
													<textarea id="obseval" name="obseval" class="form-control" rows="6"></textarea>
												</div>
											</div>
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-sm-2"></div>
										<div class="col-sm-8">
											<hr style="height: 2px;" class="bg-info rounded">
											<div class="text-center">
												<button class="btn btn-outline-primary btn-md">
													<i class="fas fa-check-circle mr-2"></i>
													Guardar 
												</button>
											</div>
										</div>
									</div>
								<?php		
									} else {
										$dataEval = $docente -> dataEvalTest($valDatEncDec);
								?>
									<div class="container-fluid">
										<div class="row">
											<div class="col-sm-12">
												<button class="btn btn-primary btn-md" type="button">
													La encuesta ya ha sido evaluada!
												</button>
												<button data-backdrop="false" class="btn btn-outline-primary btn-md" data-target="#editEval" data-toggle="modal" type="button">
														<i class="fas fa-edit fa-lg icoIni"></i>
														Editar evaluación
													</button>
												<a target="_blank" href="ImpTest.php?v=<?php echo base64_encode($dataEval->id_evaltest); ?>" class="btn btn-outline-primary btn-md">
													<i class="fas fa-print fa-lg icoIni"></i>
													Imprimir
												</a>
												<br><br>
												<div class="form-group">
													<label for="vulnerable" class=" font-weight-bold">
														<b class="lead">1. </b>
														De acuerdo a la información obtenida en los aspectos I, II Y III. ¿Se considera al alumno como elemento de uno o más grupos altamente vulnerables?
													</label>
												</div>
												<div class="col-sm-2 form-group">
													<?php 
														if ($dataEval -> vulnerable != "No") {
															echo "<span style='margin-right:5px;' class=' badge badge-danger'>
															".$dataEval->vulnerable."</span>";
														} else {
															echo "<span style='margin-right:5px;' class=' badge badge-primary'>
															".$dataEval->vulnerable."</span>";
														}
													?>
												</div>
												<div class="form-group">
													<label class=" font-weight-bold">
														<b class="lead">2. </b>
														Grupos en los que se considera se incluye al alumno altamente vulnerable.
													</label>
												</div>
												<div class="form-group">
													<?php 
														if ($dataEval->opcion1 == "" && $dataEval->opcion2 == "" && $dataEval->opcion3 == "") {
													?>
														<h6 class="font-weight-bold mb-4">
															Ningun grupo seleccionado
														</h6>
													<?php
														}
													?>
													<?php 
														if ($dataEval->opcion1 != "") {
															echo "<span style=' margin-right:5px;' class=' badge badge-danger'>
															".$dataEval->opcion1."</span>";
														}
														if ($dataEval->opcion2 != "") {
															echo "<span style='margin-right:5px;' class=' icoPri badge badge-danger'>
															".$dataEval->opcion2."</span>";
														}
														if ($dataEval->opcion3 != "") {
															echo "<span style='margin-right:5px;' class=' icoPri badge badge-danger'>
															".$dataEval->opcion3."</span>";
														}
													?>
												</div>
												<div class="form-group">
													<label class=" font-weight-bold">
														<b class="lead">3. </b>
														Aspectos que usted observa en el alumno de forma evidente
													</label>
												</div>
												<div class="form-group">
													<?php 
														if ($dataEval->obesidad != "") {
															echo "<span style='margin-right:5px;' class=' icoPri badge badge-danger'>
															".$dataEval->obesidad."</span>";
														}
														if ($dataEval->delgadezExt != "") {
															echo "<span style='margin-right:5px;' class=' icoPri badge badge-danger'>
															".$dataEval->delgadezExt."</span>";
														}
														if ($dataEval->manchasPiel != "") {
															echo "<span style='margin-right:5px;' class=' icoPri badge badge-danger'>
															".$dataEval->manchasPiel."</span>";
														}
														if ($dataEval->faltaEnergia != "") {
															echo "<span style='margin-right:5px;' class=' icoPri badge badge-danger'>
															".$dataEval->faltaEnergia."</span>";
														}
														if ($dataEval->problemDen != "") {
															echo "<span style='margin-right:5px;' class=' icoPri badge badge-danger'>
															".$dataEval->problemDen."</span>";
														}
														if ($dataEval->problemVis != "") {
															echo "<span style='margin-right:5px;' class=' icoPri badge badge-danger'>
															".$dataEval->problemVis."</span>";
														}
														if ($dataEval->problemAud != "") {
															echo "<span margin-right:5px;' class=' icoPri badge badge-danger'>
															".$dataEval->problemAud."</span>";
														}
														if ($dataEval->discapacidades != "") {
															echo "<span style='margin-right:5px;' class=' icoPri badge badge-danger'>
															".$dataEval->discapacidades."</span>";
														}
														if ($dataEval->otro != "") {
															echo "<span style='margin-right:5px;' class=' icoPri badge badge-danger text-uppercase'>
															".$dataEval->otro."</span>";
														}
													?>
												</div>
												<div class="form-group">
													<label class="font-weight-bold ">
														<b class="lead">4. </b>
														Observaciones del tutor
													</label>
												</div>
												<div class="form-group">
													<textarea class="form-control" readonly="" rows="5"><?php echo $dataEval->obseval; ?></textarea>
												</div>
											</div>
										</div>
									</div>
								<?php	
									}
								?>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<?php include 'modTest/EditEval.php'; ?>

	<br><br><br>
	<?php include 'modalsconf.php'; ?>

	<script src="../vistas/js/jquery-3.1.1.min.js"></script>
	<!-- SweetAlert -->
    <script src="../vistas/node_modules/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vistas/Assets/js/vendor/popper.min.js"></script>
    <script src="../vistas/Js/bootstrap.min.js"></script>
    <script src="../vistas/assets/js/vendor/holder.min.js"></script>
	
	<script src="../vistas/modulos/doc/js/confDatDoc.js"></script>
	<script src="../vistas/modulos/doc/js/envEvalTest.js"></script>
	<?php include 'footer2.php'; ?>

<?php
		} else {
			header("Location:../vistas/modulos/doc/Logout.php");
		}
	} else {
		header("Location:../vistas/modulos/doc/Logout.php");
	}
}