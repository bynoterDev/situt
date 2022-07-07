<?php 

include '../modelos/rutas.php';
$datCor = $cordinador->userCorDet($keyCor);

$urlFront = new Ruta();
$urlFront = $urlFront -> ctrRutaFront();

$codigo = explode("/", $_GET['view']);

$valAlm = $codigo[1];

$clvCar = base64_decode($codigo[2]);

$clvGrp = base64_decode($codigo[3]);

$datValAlm = $cordinador -> datAlmGrpCarSel($clvGrp, $clvCar, base64_decode($valAlm));
$datPer = $cordinador -> datPerAlm(base64_decode($valAlm), $clvCar, $clvGrp);

?>
		
	<div class="container-fluid animated fadeIn delay-1s">
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 text-center">
            	<?php echo $datValAlm -> nombre_car.", ".$datValAlm -> grupo_n; ?>.
            </h1>
            <a href="<?php echo SERVERURLCOR; ?>DetCar/<?php echo base64_encode($clvCar); ?>/" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
              <i class="fas fa-users fa-sm text-white-50 mr-2"></i> Grupos de la carrera 
            </a>
            <a href="<?php echo SERVERURLCOR; ?>DetGrp/<?php echo base64_encode($clvGrp); ?>/<?php echo base64_encode($clvCar); ?>/" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
              <i class="fas fa-arrow-left fa-sm text-white-50 mr-2"></i> Regresar 
            </a>
        </div>
		<div class="row mt-5">
			<div class="col-sm-12">
				<div class="card shadow mb-4">
	                <div class="card-header py-3">
	                  <h5 class="m-0 font-weight-bold text-primary">
	                  	Alumno: <b><?php echo $datValAlm -> nombre_c_al; ?></b>.
	                  </h5>
	                </div>
	                <div class="card-body">
	                  	<div class="text-center">
	                    	<img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 18rem;" src="<?php echo SERVERURL; ?>assets/img/undraw_profile.svg" alt="image profile">
	                  	</div>
	                  	<hr class="sidebar-divider">
	                  	<div class="row mt-5">
	                		<div class="col-sm-6 text-center mb-4">
		                		<?php
									if ($datValAlm -> foto_perf_alm == "" && $datValAlm -> sexo_al == "Masculino") {
										echo "<img src='".SERVERURL."vistas/img/usermal.png' class='img-fluid' width='150'>";
									} else if ($datValAlm -> foto_perf_alm != "" && $datValAlm -> sexo_al == "Masculino") {
								?>
									<img src="<?php echo SERVERURLFRONT; ?>modAlm/Arch/perfil/<?php echo $datValAlm->foto_perf_alm ?>" class="img-fluid rounded" width="150">
								<?php
									} else if ($datValAlm -> foto_perf_alm == "" && $datValAlm -> sexo_al == "Femenino") {
										echo "<img src='".SERVERURL."vistas/img/userfem.png' class='img-fluid' width='150'>";
									} else if ($datValAlm -> foto_perf_alm != "" && $datValAlm -> sexo_al == "Femenino") {
								?>
									<img src="<?php echo SERVERURLFRONT; ?>modAlm/Arch/perfil/<?php echo $datValAlm->foto_perf_alm ?>" class="img-fluid rounded" width="150">
								<?php
									} else {
									echo "<img src='".SERVERURL."vistas/img/icous.png' class='img-fluid' width='150'>";
									}
								?>
								<br><br>
								<span class="h5">
									<?php 
										if ($datValAlm -> acept_grp == 1) {
									?>
										<span class="badge badge-pill badge-primary"> En el grupo: <span class="badge badge-light ml-2">Aceptado</span> </span>
									<?php
										} else {
									?>
										<span class="badge badge-pill badge-danger"> En el grupo: <span class="badge badge-light ml-2">Sin aceptar</span></span>
									<?php
										}
									?>
								</span>
	                		</div>
	                		<div class="col-sm-6 text-center">
	                			<div class="card border-left-info">
									<div class="card-body">
										<div class="card-title text-center">
											<?php
												if ($datValAlm->foto_perf_doc != "") {
											?>
												<img src="../moddoc/perfilFot/<?php echo $datValAlm->foto_perf_doc; ?>" width="150" class="img-fluid img-thumbnail rounded" alt="">
											<?php		
												} else {
											?>
												<h5 class="text-center">
													<i class="fas fa-chalkboard-teacher text-primary fa-2x text-center"></i>
												</h5>
											<?php
												}
											?>
											<br>
											<h4 class="text-center">
												Tutor: <b><?php echo $datValAlm -> nombre_c_doc; ?></b>.
											</h4>
										</div>
									</div>
								</div>
	                		</div>
	                	</div>
	                	<br>
	                	<div class="row mt-2">
	                		<div class="col-sm-12">
	                			<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
									  <li class="nav-item">
									    <a class="nav-link active mb-2 ml-3" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">
									    	<i class="fas fa-file-alt mr-2"></i>
									    	Justificantes
									    </a>
									  </li>
									  <li class="nav-item">
									    <a class="nav-link ml-3 mb-2" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">
									    	<i class="fas fa-book mr-2"></i>
									    	Datos personales
									    </a>
									  </li>
									  <li class="nav-item">
									    <a class="nav-link ml-3 mb-2" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">
									    	<i class="fas fa-book-open mr-2"></i>
									    	Historial
									    </a>
									  </li>
								</ul>
								<hr class="sidebar-divider">
							<div class="tab-content mt-5 mb-4" id="pills-tabContent">
							  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
							  	<?php 
									$dbc = new Connect();
									$dbc = $dbc -> getDB();
									$valAlmDec = base64_decode($valAlm);
									$stmt = $dbc -> prepare("SELECT COUNT(jus.id_justificante) AS 'Solicitados', jus.cuatrimestre_justif AS 'Cuatrimestre' FROM justificantes jus
										INNER JOIN alumnos alm ON alm.id_alumno = jus.id_alumno
										WHERE alm.id_alumno = :valAlm GROUP BY jus.cuatrimestre_justif");
									$stmt -> bindParam("valAlm", $valAlmDec, PDO::PARAM_INT);
									$stmt -> execute();
									$filStmt = $stmt -> rowCount();
									if ($filStmt >= 1) {
										while ($res = $stmt -> fetch(PDO::FETCH_OBJ)) {
								?>
									<div class="col-xl-3 col-md-6 mb-4">
						              <div class="card border-left-info shadow h-100 py-2">
						                <div class="card-body">
						                  <div class="row no-gutters align-items-center">
						                    <div class="col mr-2">
						                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
						                      	Cuat: 
												<?php echo $res->Cuatrimestre; ?>
						                      </div>
						                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $res->Solicitados; ?> registros</div>
						                    </div>
						                    <div class="col-auto">
						                      <i class="fas fa-file-alt fa-2x text-gray-300"></i>
						                    </div>
						                  </div>
						                </div>
						              </div>
						            </div>
								<?php		
									}
								} else {
								?>
									<div class="text-center">
			                    		<img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 15rem;" src="<?php echo SERVERURL; ?>assets/img/notdata.svg" alt="image not register">
			                    		<h1 class="h3 mb-0 mt-2 text-gray-800 text-center">
			                    			Aún no se han generado registros...
							            </h1>
			                  		</div>
								<?php 
									}
								?>
							  </div>
							  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
							  	<?php 
									if ($datPer) {
										include 'archExt/datPerAlm.php';
									} else {
								?>
									<div class="text-center">
			                    		<img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 15rem;" src="<?php echo SERVERURL; ?>assets/img/notdata.svg" alt="image not register">
			                    		<h1 class="h3 mb-0 mt-2 text-gray-800 text-center">
			                    			Aún no se han generado registros...
							            </h1>
			                  		</div>
								<?php		
									}
								?>
							  </div>
							  <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
							  	<?php 
									$dbc = new Connect();
									$dbc = $dbc -> getDB();
									$valid = 1;
									$valAlmDec = base64_decode($valAlm);
									$stmt = $dbc -> prepare("SELECT * FROM historial_academ hist WHERE hist.id_alumno = :valAlmDec && hist.estado_almhist = :valid");
									$stmt -> bindParam("valAlmDec", $valAlmDec, PDO::PARAM_INT);
									$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
									$stmt -> execute();
									$resStmt = $stmt -> rowCount();
									if ($resStmt > 0) {
									 	while ($res = $stmt -> fetch(PDO::FETCH_OBJ)) {
									?>
										<div class="col-xl-4 col-md-6 mb-4">
							              <div class="card border-left-info shadow h-100 py-2">
							                <div class="card-body">
							                  <div class="row no-gutters align-items-center">
							                    <div class="col mr-2">
							                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
							                      	Cuat: 
													<?php echo $res->cuatri_almhist; ?>
							                      </div>
							                      <div class="h5 mb-0 font-weight-bold text-gray-800">
							                      	<?php echo $res->grupo_almhist; ?>, <?php echo $res->periodcuat_almhist; ?>.
							                      </div>
							                      <hr class="sidevar-divider">
							                      <div class="h6 mb-0 font-weight-bold text-gray-800">
							                      	Tutor: <?php echo $res->tutor_almhist; ?>.
							                      </div>
							                    </div>
							                    <div class="col-auto">
							                      <i class="fas fa-users fa-2x text-gray-300"></i>
							                    </div>
							                  </div>
							                </div>
							              </div>
							            </div>

									<?php
									 	}
									} else {
									?>
										<div class="text-center">
				                    		<img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 15rem;" src="<?php echo SERVERURL; ?>assets/img/notdata.svg" alt="image not register">
				                    		<h1 class="h3 mb-0 mt-2 text-gray-800 text-center">
				                    			Aún no se han generado registros...
								            </h1>
				                  		</div>
									<?php
									}
								?>
							  </div>
							</div>
	                		</div>
						</div>
	                </div>
	            </div>
			</div>
		</div>
	</div>

    <script src="<?php echo SERVERURLCOR; ?>cor/js/perfAlmGC.js"></script>