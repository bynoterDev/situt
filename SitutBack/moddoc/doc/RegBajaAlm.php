<?php 
	$docente = new Docentes();
	include '../modelos/rutas.php';
	$urlFront = new Ruta();
	$urlFront = $urlFront -> ctrRutaFront();
	$keyDoc = $_SESSION['keyDoc'];
	$codigo = explode('/', $_GET['view']);
	$valPerfAlm = $codigo[1];
	$valPerfAlmDec = base64_decode($valPerfAlm);
	$datDoce = $docente->userDocDet($keyDoc);
	$grp = $_SESSION["clvGrp"];
	// $_SESSION["clvAlm"] = $valPerfAlmDec;
	$datGrup = $docente->datGrpSel($keyDoc, $grp);
	// $datAlm = $docente->datPerfAlm($valPerfAlmDec);
	$datBec = $docente->datBecBaj($valPerfAlmDec);
	$datAlm = $docente -> datAlmAll($valPerfAlmDec);
	$datAlumno = $docente->datAlumno($valPerfAlmDec);
	$datEnc = $docente -> datEncBaj($valPerfAlmDec);
	$datBaj = $docente -> validBajDat($valPerfAlmDec); 
	// $valDPAlm = $docente -> valDatPerAlm($valPerfAlmDec);
	// $valEnc = $docente -> valDatEnc($valPerfAlmDec);
	if ($datDoce) {
?>
	
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
		input[type=checkbox] {
		  transform: scale(1.5);
		}
		input[type=radio] {
			transform: scale(1.5);
		}
	</style>


<div class="container-fluid mt-4 animated fadeIn delay-1s">
	
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">
		    <i class="fas fa-university mr-2 text-dark "></i>
			<b><?php echo "Carrera: ".$datGrup->nombre_car.", Grupo: ".$datGrup->grupo_n."."; ?></b>
		</h1>
		<a href="<?php echo SERVERURLDOC; ?>PerfAlm/<?php echo $valPerfAlm; ?>/" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
		   	<i class="fas fa-arrow-left fa-sm text-white-50 mr-2"></i> Regresar 
		</a>
	</div>

	
			<?php 
				if ($datEnc) {
					if ($datBaj -> CANTIDAD == 0 ) {
			?>
				<div class="card shadow mb-4" id="contend">
			        <div class="card-header py-3">
			          <h6 class="m-0 font-weight-bold text-primary ">
			          	<i class="fas fa-user-graduate mr-2"></i> <?php echo $datAlumno->nombre_c_al; ?>
			          </h6>
			        </div>
			        <div class="card-body">
						<h5 class="text-center text-uppercase text-primary  font-weight-bold mt-4">
							Registro de baja del alumno
						</h5>
						<div class="row mt-5">
							<div class="col-sm-12 bg-white text-dark p-4">
								<form method="POST" id="formRegBaja" name="formRegBaja">
									<input type="hidden" value="<?php echo base64_encode($datAlm->id_alumno); ?>" name="id_alumno">
									<div class="form-group row text-center">
										<label class=" text-center mt-2 font-weight-bold">
											Fecha de solictud de la baja:
										</label>
										<div class="col-sm-3">
											<input type="date" value="<?php echo date("Y-m-d"); ?>" class="form-control" name="">
										</div>
									</div>
									<br><br>
									<div class="row">
										<div class="col-sm-12">
											<h5 class="text-left text-uppercase font-weight-bold">
												I. Datos generales del alumno
											</h5>
											<hr style="height: 2px !important;" class="bg-primary rounded">
											<br>
										</div>
									</div>
									<div class="form-group row">
										<label class=" col-sm-4">Nombre:</label>
										<div class="col-sm-8">
											<input readonly type="text" value="<?php echo $datAlm->nombre_c_al; ?>" class="form-control">
										</div>
									</div>
									<div class="form-group row">
										<label class=" col-sm-4">Matricula:</label>
										<div class="col-sm-8">
											<input readonly type="text" value="<?php echo $datAlm->matricula_al; ?>" class="form-control">
										</div>
									</div>
									<div class="form-group row">
										<label class=" col-sm-4">Carrera:</label>
										<div class="col-sm-8">
											<input readonly type="text" value="<?php echo $datAlm->nombre_car; ?>" class="form-control">
										</div>
									</div>
									<div class="form-group row">
										<label class=" col-sm-4">Grupo Escolar:</label>
										<div class="col-sm-8">
											<input readonly type="text" value="<?php echo $datAlm->grupo_n; ?>" class="form-control">
										</div>
									</div>
									<div class="form-group row">
										<label class=" col-sm-4">Nombre del Tutor:</label>
										<div class="col-sm-8">
											<input readonly type="text" value="<?php echo $datAlm->nombre_c_doc; ?>" class="form-control">
										</div>
									</div>
									<br>
									<?php 
										if ($datEnc) {
									?>
									<div class="form-group row">
										<label class=" col-sm-7">¿Pertenecía el alumno a algún grupo altamente vulnerable?</label>
										<div class="col-sm-5">
											<?php 
												if ($datEnc->opcion1 != "" || $datEnc->opcion2 != "" || $datEnc->opcion3 != "") {
										?>
											<div class="form-check">
													<input class="form-check-input" type="checkbox" checked="" value=""  id="siVul" disabled>
													<label class="" for="siVul">
													 	Si
													</label>
											</div>
											<div class="form-check">
													<input class="form-check-input" type="checkbox" value="" id="noVul" disabled>
													<label class="" for="noVul">
													  No
													</label>
											</div>
										<?php
												} else {
										?>
											<div class="form-check">
													<input class="form-check-input" type="checkbox" value=""  id="siVul" disabled>
													<label class="" for="siVul">
													 	Si
													</label>
											</div>
											<div class="form-check">
												<input class="form-check-input" type="checkbox" checked="" value="" id="noVul" disabled>
												<label class="" for="noVul">
													No
												</label>
											</div>
										<?php
												}
											?>
										</div>
									</div>
									<div class="form-group">
										<label class="">Si la respuesta es afirmativa, marque en los paréntesis correspondientes en que grupos altamente vulnerables estuvo resgistrado</label>
										<?php 
											if ($datEnc->opcion1 != "") {
										?>
											<div class="form-check">
												<input class="form-check-input" type="checkbox" checked="" value="" id="probEcn" disabled>
												<label class=" text-uppercase" for="probEcn">
													Por problemas Economicos
												</label>
											</div>
										<?php
											} else {
										?>		
										<div class="form-check">
												<input class="form-check-input" type="checkbox" value="" id="probEcn" disabled>
												<label class=" text-uppercase" for="probEcn">
													Por problemas Economicos
												</label>
											</div>
										<?php 		
											}
										?>
										<?php 
											if ($datEnc->opcion2 != "") {
										?>
											<div class="form-check">
												<input class="form-check-input" type="checkbox" checked="" value="" id="probPer" disabled>
												<label class=" text-uppercase" for="probPer">
													Por problemas personales
												</label>
											</div>
										<?php
											} else {
										?>		
										<div class="form-check">
												<input class="form-check-input" type="checkbox" value="" id="probPer" disabled>
												<label class=" text-uppercase" for="probPer">
													Por problemas personales
												</label>
											</div>
										<?php 		
											}
										?>
										<?php 
											if ($datEnc->opcion3 != "") {
										?>
											<div class="form-check">
												<input class="form-check-input" type="checkbox" checked="" value="" id="probAcd" disabled>
												<label class=" text-uppercase" for="probAcd">
													Por problemas Académicos
												</label>
											</div>
										<?php
											} else {
										?>		
										<div class="form-check">
											<input class="form-check-input" type="checkbox" value="" id="probAcd" disabled>
											<label class=" text-uppercase" for="probAcd">
												Por problemas Académicos
											</label>
										</div>
										<?php 		
											}
										?>
									</div>
									<?php
										} else {
											//echo "mal no ah realizado la encuesta";
										}
									?>
									<br><br>
									<div class="row">
										<div class="col-sm-12">
											<h5 class="text-left text-uppercase font-weight-bold">
												II. Información sobre la baja
											</h5>
											<hr style="height: 2px !important;" class="bg-primary rounded">
										</div>
									</div>
									<div class="form-group row">
										<div class="col-sm-6">
											<label class="" for="tipBaja">1. Indique el tipo de baja que se solicita:</label>
											<select class="form-control" id="tipBaja" name="tipobaja">
												<option value="0" selected="">Selecciona</option>
												<option value="BAJA TEMPORAL">BAJA TEMPORAL</option>
												<option value="BAJA DEFINITIVA">BAJA DEFINTIVA</option>
											</select>
										</div>
										<div class="col-sm-6">
											<label class="" for="periodo">
												Periodo de reincorporación:
											</label>	
											<select class="form-control" id="periodo" name="periodo">
												<option selected="" value="0">Selecciona</option>
												<option value="ENE-ABR">ENE-ABR</option>
												<option value="MAY-AGO">MAY-SEP</option>
												<option value="SEP-DIC">SEP-DIC</option>
											</select>
										</div>
									</div>
									<br>
									<div class="form-group row">
										<label class=" col-sm-6 " for="bajasolicitada">
											¿La baja fue solicitada por el alumno?
										</label>
										<div class="col-sm-6">
											<select class="form-control" id="bajasolicitada" name="bajasolicitada">
												<option selected="" value="0">Selecciona</option>
												<option value="SI">SI</option>
												<option value="NO">NO</option>
											</select>
										</div>
									</div>
									<br>
									<div class="form-group">
										<label class="" for="motivBaja">2. Indique el motivo de la baja:</label>
										<br><br>
										<textarea rows="5" class="form-control" id="motivBaja" name="motivBaja"></textarea>
									</div>	
									<br><br>
									<div class="form-group row">
										<label class=" col-sm-6 text-center font-weight-bold">Introduzca su contraseña para confirmar:</label>
										<div class="col-sm-6">
											<input type="password" class="form-control" id="passConf" name="passConf">
										</div>
									</div>
									<div class="form-group row mt-5">
										<div class="text-center col-sm-12">
											<button class="btn btn-outline-primary btn-sm">
												<i class="fas fa-check mr-2"></i>
												Guardar
											</button>
										</div>
									</div>
								</form>
							</div>
						</div>
			        </div>
			    </div>
			<?php
					} else {
						$keyBaj = $docente -> keyBajAlm($valPerfAlmDec);
			?>	
			<div class="card shadow mb-4" id="contend">
		        <div class="card-header py-3">
		          <h6 class="m-0 font-weight-bold text-dark ">
		          	<i class="fas fa-user-graduate mr-2"></i> <?php echo $datAlm->nombre_c_al; ?>
		          </h6>
		        </div>
		        <div class="card-body">

		        	<div class="row text-center">
		        		<div class="col-sm-6 mb-4">
		        			<div class="border-left-primary rounded shadow p-2">
		        				<h5 class="text-center text-dark  font-weight-bold mt-4">
									<i class="fas fa-info-circle mr-2"></i>
									Ya existe un registro de baja.
									<div class="mt-4 text-center">
										<span class="badge badge-primary p-3">
											Fecha de realización: <?php echo formatFech($keyBaj->fecha_reg_baj);  ?>
										</span>
									</div>
									<div class="mt-4 mb-4">
										<a target="_blank" href="<?php echo SERVERURLDOC ?>doc/ImpBaja.php?v=<?php echo base64_encode($keyBaj->id_bajaalmdat); ?>&&p=<?php echo base64_encode($datAlm->id_alumno); ?>" class="btn btn-outline-primary btn-sm">
											<i class="fas fa-print mr-2"></i>
											Imprimir
										</a>
									</div>
								</h5>
		        			</div>
		        		</div>
		        		<div class="col-sm-6 mb-4 mt-2">
		        			<?php 
								if ($datAlm -> foto_perf_alm == "" && $datAlm -> sexo_al == "Masculino") {
									echo "<img src='../vistas/img/usermal.png' class='img-fluid ' width='200'>";
								} else if ($datAlm -> foto_perf_alm != "" && $datAlm -> sexo_al == "Masculino") {
							?>
								<img src="<?php echo $urlFront;?>modAlm/Arch/perfil/<?php echo $datAlm->foto_perf_alm ?>" class="img-fluid rounded " width="200">
							<?php
								} else if ($datAlm -> foto_perf_alm == "" && $datAlm -> sexo_al == "Femenino") {
									echo "<img src='../vistas/img/userfem.png' class='img-fluid ' width='200'>";
								} else if ($datAlm -> foto_perf_alm != "" && $datAlm -> sexo_al == "Femenino") {
							?>
								<img src="<?php echo $urlFront;?>modAlm/Arch/perfil/<?php echo $datAlm->foto_perf_alm ?>" class="img-fluid rounded " width="200">
							<?php
								} else {
									echo "<img src='../vistas/img/icous.png' class='img-fluid ' width='200'>";
								}
							?>
		        		</div>
		        	</div>

		        </div>
		    </div>
			<?php			
					}
			?>
			
			<?php
				} else {
			?>
			<div class="card shadow mb-4" id="contend">
		        <div class="card-header py-3">
		          <h6 class="m-0 font-weight-bold text-dark ">
		          	<i class="fas fa-user-graduate mr-2"></i> <?php echo $datAlumno->nombre_c_al; ?>
		          </h6>
		        </div>
		        <div class="card-body">

		        	<div class="row text-center">
		        		<div class="col-sm-6 mb-4">
		        			<p class="text-justify text-dark">
		        				El alumno
								no ha completado la entrevista inicial, mediante el sistema no se puede proceder a 	realizar la baja.
		        			</p>
		        			<h5 class="font-weight-bold mt-4">
		        				<i class="fas fa-arrow-down text-dark  mr-2"></i>
								Más información
		        			</h5>
		        			<p class="text-justify text-dark mt-4">
		        				<i class="fas fa-circle text-dark  mr-2"></i>
								Es necesaria la información de la encuesta para un llenado correcto del formato de baja.
		        			</p>
		        			<p class="text-justify text-dark mt-4">
		        				<i class="fas fa-circle text-dark  mr-2"></i>
								Pida al alumno que conteste la encuesta para despues proceder a solicitar el formato de baja.
		        			</p>
		        		</div>
		        		<div class="col-sm-6 mb-4 mt-2">
		        			<?php 
								if ($datAlumno -> foto_perf_alm == "" && $datAlumno -> sexo_al == "Masculino") {
									echo "<img src='".SERVERURL."vistas/img/usermal.png' class='img-fluid ' width='200'>";
								} else if ($datAlumno -> foto_perf_alm != "" && $datAlumno -> sexo_al == "Masculino") {
							?>
								<img src="<?php echo $urlFront;?>modAlm/Arch/perfil/<?php echo $datAlumno->foto_perf_alm ?>" class="img-fluid rounded " width="200">
							<?php
								} else if ($datAlumno -> foto_perf_alm == "" && $datAlumno -> sexo_al == "Femenino") {
									echo "<img src='".SERVERURL."vistas/img/userfem.png' class='img-fluid ' width='200'>";
								} else if ($datAlumno -> foto_perf_alm != "" && $datAlumno -> sexo_al == "Femenino") {
							?>
								<img src="<?php echo $urlFront;?>modAlm/Arch/perfil/<?php echo $datAlumno->foto_perf_alm ?>" class="img-fluid rounded " width="200">
							<?php
								} else {
									echo "<img src='".SERVERURL."vistas/img/icous.png' class='img-fluid ' width='200'>";
								}
							?>
		        		</div>
		        	</div>

		        </div>
		    </div>
			<?php
				}
			?>
		
</div>

	<script src="<?php echo SERVERURLDOC; ?>doc/js/regBaj.js"></script>

<?php		
	} else {
		header("Location:".SERVERURLDOC."doc/Logout.php");
	}
?>
