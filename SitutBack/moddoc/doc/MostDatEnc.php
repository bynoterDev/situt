<?php 

	include '../modelos/rutas.php';
	$urlFront = new Ruta();
	$urlFront = $urlFront -> ctrRutaFront();
	$keyDoc = $_SESSION['keyDoc'];
	$codigo = explode('/', $_GET['view']);
	$valDatEnc = $codigo[1];
	$valPerfAlm = $codigo[2];
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


	
<div class="container-fluid mt-4 animated fadeIn delay-1s">
	
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">
		    <i class="fas fa-book mr-2 text-primary"></i>
			<b><?php echo "Carrera: ".$datGrup->nombre_car.", Grupo: ".$datGrup->grupo_n."."; ?></b>
		</h1>
		<a href="<?php echo SERVERURLDOC; ?>PerfAlm/<?php echo $valPerfAlm; ?>/" class="d-none d-sm-inline-block btn btn-sm btn-primary text-white shadow-sm">
		   	<i class="fas fa-arrow-left fa-sm text-white-50 mr-2"></i> Regresar 
		</a>
	</div>
	
	<div class="card shadow mb-4 ocult" id="contend">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">
          	Encuesta inicial
          </h6>
        </div>
        <div class="card-body">
        	<div class="row">
        		<div class="col-sm-6 mb-4">
        			<h5 class="text-center text-primary text-capitalize">
						<br>
						<i class="fas fa-user-graduate mr-2"></i>
						Alumno: 
						<b>
							<?php echo $dataP->nombre_c_al; ?>.
						</b>
						<?php 
							if ($cantEval -> Cantidad == 1) {
						?>
							<div class="mt-4 mb-4 text-center">
								<span class="badge badge-primary p-3">
									Ya ha sido evaluado!
								</span>
							</div>
						<?php
							}
						?>
					</h5>
        		</div>
        		<div class="col-sm-6 mb-4 text-center">
        			<?php 
						if ($dataP -> foto_perf_alm == "" && $dataP -> sexo_al == "Masculino") {
							echo "<img src='".SERVERURL."vistas/img/usermal.png' class='img-fluid' width='200'>";
						} else if ($dataP -> foto_perf_alm != "" && $dataP -> sexo_al == "Masculino") {
					?>
						<img src="<?php echo $urlFront;?>modAlm/Arch/perfil/<?php echo $dataP->foto_perf_alm ?>" class="img-fluid rounded" width="200">
					<?php
						} else if ($dataP -> foto_perf_alm == "" && $dataP -> sexo_al == "Femenino") {
							echo "<img src='".SERVERURL."vistas/img/userfem.png' class='img-fluid' width='200'>";
						} else if ($dataP -> foto_perf_alm != "" && $dataP -> sexo_al == "Femenino") {
					?>
						<img src="<?php echo $urlFront;?>modAlm/Arch/perfil/<?php echo $dataP->foto_perf_alm ?>" class="img-fluid rounded rounded" width="200">
					<?php
						} else {
							echo "<img src='".SERVERURL."vistas/img/icous.png' class='img-fluid' width='200'>";
						}
					?>
        		</div>
        	</div>
        	<div class="row">
				<div class="col-md-12 col-lg-12">
					<div class="row mt-5">
						<form class="col-sm-12" method="POST" id="formEvalTest" name="formEvalTest">
							<ul class="nav nav-pills mb-4 text-center" id="pills-tab" role="tablist">
								<li class="nav-item mr-sm-1 mr-md-3 mr-lg-5">
								   	<a class="nav-link cardShadow active btn" id="pills-datGen-tab" data-toggle="pill" href="#pills-datGen" role="tab" aria-controls="pills-datGen" aria-selected="true">
								   		<h6 class="p-0 m-0"> 
											<i class="fas fa-address-book fa-lg mr-2"></i>
										   	Generales
										</h6>
									</a>
								</li>
								<li class="nav-item mr-sm-1 mr-md-3 mr-lg-5">
								   	<a class="nav-link cardShadow btn" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"><h6 class="p-0 m-0"> 
									<i class="fas fa-money-check-alt fa-lg mr-2"></i>
								   	SocioEconomicos</h6></a>
								</li>
								<li class="nav-item mr-sm-1 mr-md-3 mr-lg-5">
								  	<a class="nav-link cardShadow btn" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false"><h6 class="p-0 m-0"> 
									<i class="fas fa-child fa-lg mr-2"></i>
								  	Personales</h6></a>
								</li>
								<li class="nav-item mr-sm-1 mr-md-3 mr-lg-5">
								    <a class="nav-link cardShadow btn" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false"><h6 class="p-0 m-0"> 
									<i class="fas fa-graduation-cap fa-lg mr-2"></i>
								    Acedemicos</h6></a>
								</li>
								<li class="nav-item mr-sm-1 mr-md-3">
								    <a class="nav-link cardShadow btn" id="pills-evaluar-tab" data-toggle="pill" href="#pills-evaluar" role="tab" aria-controls="pills-evaluar" aria-selected="false"><h6 class="p-0 m-0">
									<i class="fas fa-check-circle mr-2"></i>
								    Evaluar</h6></a>
								</li>
							</ul>
							<hr style="height: 2px;" class="bg-primary rounded">
							<br>
							<div class="tab-content" id="pills-tabContent">
								<div class="tab-pane cardShadow bg-white text-dark rounded pad30 fade show active" id="pills-datGen" role="tabpanel" aria-labelledby="pills-datGen-tab">
									<?php include "modTest/DatGenerales.php"; ?>
								</div>
								<div class="tab-pane cardShadow bg-white text-dark rounded pad30 fade" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
									<?php include "modTest/DatSocioEconomicos.php"; ?>
								</div>
								<div class="tab-pane cardShadow bg-white text-dark rounded pad30 fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
									<?php include "modTest/DatPersonales.php"; ?>
								</div>
								<div class="tab-pane cardShadow bg-white text-dark rounded pad30 fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
									<?php include "modTest/DatAcademicos.php"; ?>
								</div>
								<div class="tab-pane cardShadow bg-white text-dark rounded pad30 fade" id="pills-evaluar" role="tabpanel" aria-labelledby="pills-evaluar-tab">
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
															De acuerdo a la darkrmación obtenida en los aspectos I, II Y III. ¿Se considera al alumno como elemento de uno o más grupos altamente vulnerables?
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
												<hr style="height: 2px;" class="bg-dark rounded">
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
													<button class="btn btn-primary btn-sm" type="button">
														La encuesta ya ha sido evaluada!
													</button>
													<button data-backdrop="false" class="btn btn-outline-primary btn-sm" data-target="#editEval" data-toggle="modal" type="button">
															<i class="fas fa-edit mr-2"></i>
															Editar evaluación
														</button>
													<a target="_blank" href="<?php echo SERVERURLDOC; ?>doc/ImpTest.php?v=<?php echo base64_encode($dataEval->id_evaltest); ?>" class="btn btn-outline-primary btn-sm">
														<i class="fas fa-print mr-2"></i>
														Imprimir
													</a>
													<br><br>
													<div class="form-group">
														<label for="vulnerable" class=" font-weight-bold">
															<b class="lead font-weight-bold">1. </b>
															De acuerdo a la darkrmación obtenida en los aspectos I, II Y III. ¿Se considera al alumno como elemento de uno o más grupos altamente vulnerables?
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
															<b class="lead font-weight-bold">2. </b>
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
															<b class="lead font-weight-bold">3. </b>
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
															<b class="lead font-weight-bold">4. </b>
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
    </div>
	
</div>

	<?php include 'modTest/EditEval.php'; ?>

	<script src="<?php echo SERVERURLDOC; ?>doc/js/envEvalTest1.js"></script>
<?php
		} else {
			header("Location:".SERVERURLDOC."doc/Logout.php");
		}
	} else {
		header("Location:".SERVERURLDOC."doc/Logout.php");
	}