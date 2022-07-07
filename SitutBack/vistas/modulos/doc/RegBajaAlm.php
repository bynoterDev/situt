<?php 

ob_start();
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
	$valPerfAlm = $_GET['v'];
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
		input[type=checkbox] {
		  transform: scale(1.5);
		}
		input[type=radio] {
			transform: scale(1.5);
		}
	</style>
	<br><br><br><br>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-2"></div>
			<div class="col-sm-12 col-md-12 col-lg-8">
				<a href="PerfAlm.php?v=<?php echo $valPerfAlm; ?>" class="btn bg-white cardShadow rounded mr-3 text-primary btn-md">
					<i class="fas fa-arrow-left icoIni"></i>
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
				<?php 
					if ($datEnc) {
						if ($datBaj -> CANTIDAD == 0 ) {
				?>
					<h5 class="text-center text-uppercase text-info font-weight-bold mt-4">
					Registro de baja del alumno
					</h5>
					<div class="container-fluid mt-4">
						<div class="row">
							<div class="col-sm-12 bg-white text-info cardShadow pad30">
								<form method="POST" id="formRegBaja" name="formRegBaja">
									<input type="hidden" value="<?php echo base64_encode($datAlm->id_alumno); ?>" name="id_alumno">
									<div class="form-group row">
										<label class="">
											Fecha de solictud de la baja:
										</label>
										<div class="col-sm-6">
											<input type="date" value="<?php echo date("Y-m-d"); ?>" class="form-control" name="">
										</div>
									</div>
									<br><br>
									<div class="row">
										<div class="col-sm-12">
											<h5 class="text-left text-uppercase">
												I. Datos generales del alumno
											</h5>
											<hr style="height: 2px !important;" class="bg-info rounded">
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
											<h5 class="text-left text-uppercase">
												II. Información sobre la baja
											</h5>
											<hr style="height: 2px !important;" class="bg-info rounded">
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
										<label class=" col-sm-6 text-center">Introduzca su contraseña para confirmar:</label>
										<div class="col-sm-6">
											<input type="password" class="form-control" id="passConf" name="passConf">
										</div>
									</div>
									<div class="form-group row mt-5">
										<div class="text-center col-sm-12">
											<button class="btn btn-outline-primary btn-md">
												<i class="fas fa-check fa-lg mr-2"></i>
												Guardar
											</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				<?php
						} else {
							$keyBaj = $docente -> keyBajAlm($valPerfAlmDec);
				?>	
				<br>
					<div class="container-fluid mt-5">
						<div class="row">
							<div class="col-sm-6 mt-4">
								<h5 class="text-center text-info">Ya existe un registro de baja</h5>
								<h5 class="text-center text-capitalize text-info mt-4">
									<i class="fas fa-user-graduate mr-2"></i>
									Alumno : 
									<b><?php echo $datAlm->nombre_c_al; ?></b>
								</h5>
								<div class="text-center mt-4">
									<a target="_blank" href="ImpBaja.php?v=<?php echo base64_encode($keyBaj->id_bajaalmdat); ?>&&p=<?php echo base64_encode($datAlm->id_alumno); ?>" class="btn btn-outline-primary btn-md mr-4">
										<i class="fas fa-print fa-lg mr-2"></i>
										Imprimir
									</a>
									<button class="btn btn-outline-primary btn-md ml-4">
										<i class="fas fa-eye fa-lg mr-2"></i>
										Ver datos
									</button>
								</div>
								<hr style="height: 2px;" class="bg-info rounded">
							</div>
							<div class="col-sm-6 text-center">
								<?php 
									if ($datAlm -> foto_perf_alm == "" && $datAlm -> sexo_al == "Masculino") {
										echo "<img src='../vistas/img/usermal.png' class='img-fluid ' width='200'>";
									} else if ($datAlm -> foto_perf_alm != "" && $datAlm -> sexo_al == "Masculino") {
								?>
									<img src="<?php echo $urlFront;?>modAlm/Arch/perfil/<?php echo $datAlm->foto_perf_alm ?>" class="img-fluid img-thumbnail rounded " width="300">
								<?php
									} else if ($datAlm -> foto_perf_alm == "" && $datAlm -> sexo_al == "Femenino") {
										echo "<img src='../vistas/img/userfem.png' class='img-fluid ' width='200'>";
									} else if ($datAlm -> foto_perf_alm != "" && $datAlm -> sexo_al == "Femenino") {
								?>
									<img src="<?php echo $urlFront;?>modAlm/Arch/perfil/<?php echo $datAlm->foto_perf_alm ?>" class="img-fluid img-thumbnail rounded " width="300">
								<?php
									} else {
										echo "<img src='../vistas/img/icous.png' class='img-fluid ' width='200'>";
									}
								?>
							</div>
						</div>
					</div>
					<br><br><br>
				<?php			
						}
				?>
				
				<?php
					} else {
				?>
				<br>
				<div class="container-fluid mt-5">
					<div class="row">
						<div class="col-sm-6 mt-5">
							<h5 class="text-justify text-info">
								No ha completado la entrevista inicial, no se puede proceder a realizar la baja.
							</h5>
							<h5 class="text-center text-info mt-4">
								<i class="fas fa-user-graduate mr-2"></i>
								Alumno:
								<b><?php echo $datAlumno->nombre_c_al; ?></b>
							</h5>
							<hr style="height: 2px;" class="bg-info rounded">
						</div>
						<div class="col-sm-6 text-center">
							<?php 
								if ($datAlumno -> foto_perf_alm == "" && $datAlumno -> sexo_al == "Masculino") {
									echo "<img src='../vistas/img/usermal.png' class='img-fluid ' width='200'>";
								} else if ($datAlumno -> foto_perf_alm != "" && $datAlumno -> sexo_al == "Masculino") {
							?>
								<img src="<?php echo $urlFront;?>modAlm/Arch/perfil/<?php echo $datAlumno->foto_perf_alm ?>" class="img-fluid img-thumbnail rounded " width="300">
							<?php
								} else if ($datAlumno -> foto_perf_alm == "" && $datAlumno -> sexo_al == "Femenino") {
									echo "<img src='../vistas/img/userfem.png' class='img-fluid ' width='200'>";
								} else if ($datAlumno -> foto_perf_alm != "" && $datAlumno -> sexo_al == "Femenino") {
							?>
								<img src="<?php echo $urlFront;?>modAlm/Arch/perfil/<?php echo $datAlumno->foto_perf_alm ?>" class="img-fluid img-thumbnail rounded " width="300">
							<?php
								} else {
									echo "<img src='../vistas/img/icous.png' class='img-fluid ' width='200'>";
								}
							?>
						</div>
					</div>
				</div>
				<?php
					}
				?>
			</div>
		</div>
	</div>


	<br><br><br>
	<?php include 'modalsconf.php'; ?>

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
	<script src="../vistas/modulos/doc/js/regBaj.js"></script>
	<?php include 'footer2.php'; ?>

<?php		
	} else {
		header("Location:Logout.php");
	}
}

ob_end_flush();
?>