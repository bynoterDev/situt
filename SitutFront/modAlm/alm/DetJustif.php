<?php 

	$alumno = new Alumno();
	$datAlm = $alumno->userAlmDet($_SESSION['keyAlm']);
	if ($datAlm) {
		if ($datAlm->id_detgrupo != "") {
		$datGrpAlm = $alumno->datGrpAlm($_SESSION['keyAlm']);
		}
?>
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
		.margen-avatar{
        	margin-top:-50px;
    	}
    	.shDC {
    		-webkit-box-shadow: 0px 0px 2px 0px rgba(0,0,0,0.75);
			-moz-box-shadow: 0px 0px 2px 0px rgba(0,0,0,0.75);
			box-shadow: 0px 0px 2px 0px rgba(0,0,0,0.75);
    	}
	</style>

	<div class="container-fluid animated fadeIn delay-1s mt-4">
		
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
	        <h1 class="h3 mb-0 text-gray-800">Justificantes solicitados</h1>
	    </div>

		<div class="row mt-5">
			<div class="col-sm-1"></div>
			<div class="col-sm-12 col-md-12 col-lg-10">
				<div class="row">
		      		<div class="col-sm-12 col-md-12 col-lg-6 text-center">
		      			<ul class="list-group shadow rounded border-left-primary">
						  <li class="list-group-item d-flex justify-content-between align-items-center">
						    Totales
						    <span class="badge badge-dark badge-pill" id="justCantTot">
						    </span>
						  </li>
						  <li class="list-group-item d-flex justify-content-between align-items-center">
						    En este cuatrimestre
						    <span class="badge badge-pill badge-info" id="justCantCut">
						    </span>
						  </li>
						</ul>
		      		</div>
		      		<div class="col-sm-12 col-md-12 col-lg-6 text-center">
		      			<ul class="list-group shadow rounded border-left-primary">
						  <li class="list-group-item d-flex justify-content-between align-items-center">
						    Aceptados
						    <span class="badge badge-primary badge-pill" id="justCantAcept">
						    </span>
						  </li>
						  <li class="list-group-item d-flex justify-content-between align-items-center">
						    No aceptados
						    <span class="badge badge-danger badge-pill" id="justCantRech">
						    </span>
						  </li>
						</ul>
		      		</div>
		      	</div>
				
				<div class="row mt-4">
					<?php 
						//$dbc = Connect::getDB();
						$dbc = new Connect();
						$dbc = $dbc -> getDB();
			
						$stmt = $dbc -> prepare("SELECT COUNT(jus.id_justificante) AS 'CantJus', jus.cuatrimestre_justif FROM 
							justificantes jus INNER JOIN alumnos alm ON alm.id_alumno = jus.id_alumno
							WHERE alm.id_alumno = :keyAlm GROUP BY jus.cuatrimestre_justif ORDER BY jus.cuatrimestre_justif");
						$stmt -> bindParam("keyAlm", $_SESSION['keyAlm'], PDO::PARAM_INT);
						$stmt -> execute();
						$filStmt = $stmt -> rowCount();
						if ($filStmt >= 1) {
							while ($res = $stmt -> fetch(PDO::FETCH_OBJ)) {
								if ($res->cuatrimestre_justif == $datGrpAlm->cuatrimestre_g) {
						?>
							<div class="col-sm-12 col-md-6 col-lg-4">
								<div class="card shadow rounded" style="">
									<div class=" card-body">
										<div class="card-title mb-4">
											<div class="text-right mb-3">
												<span class="text-right badge-primary badge font-weight-normal" >Actual</span>
											</div>
											<h6 class="text-center font-weight-bold">
												Cuatrimestre : 
												<?php echo $res->cuatrimestre_justif; ?>
											</h6>
										</div>
										<hr style="height: 2px;" class="bg-primary rounded">
										<div class="card-text mt-4">
											<h6 class="text-center">
												<i class="fas fa-file-alt mr-2 text-primary"></i>
												Justificantes : 
												<span style="font-size: 12px;" class="font-weight-normal badge badge-pill badge-primary">
													<?php echo $res->CantJus; ?>	
												</span>	
											</h6>
										</div>
									</div>
								</div>
							</div>
						<?php
								} else {
						?>
							<div class="col-sm-12 col-md-6 col-lg-4">
								<div class="card shadow rounded" style="">
									<div class=" card-body">
										<div class="card-title mb-4">
											<h6 class="text-center font-weight-bold">
												Cuatrimestre : 
												<?php echo $res->cuatrimestre_justif; ?>
											</h6>
										</div>
										<hr style="height: 2px;" class="bg-primary rounded">
										<div class="card-text mt-4">
											<h6 class="text-center">
												<i class="fas fa-file-alt mr-2 text-primary"></i>
												Justificantes : 
												<span style="font-size: 12px;" class="font-weight-normal badge badge-pill badge-primary">
													<?php echo $res->CantJus; ?>	
												</span>	
											</h6>
										</div>
									</div>
								</div>
							</div>
						<?php
								}
							}
						} else {
						?>
							<div class="col-sm-12">
								<h2 class="text-center font-weight-bold text-danger mt-5">
									<i class="fas fa-times-circle mr-2"></i> Aún no se han generado registros...
								</h2>
							</div>
						<?php
						}
					?>	
				</div>
			</div>
		</div>

	</div>

    <script src="<?php echo SERVERURLALM; ?>alm/js/tutAlm.js"></script>
  <script src="<?php echo SERVERURLALM; ?>alm/js/justif.js"></script>
    
<?php
	} else {
		header("Location:".SERVERURLALM."alm/Logout.php");
	}
	  

