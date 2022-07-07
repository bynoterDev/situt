<?php 

	$alumno = new Alumno();
	$datAlm = $alumno->userAlmDet($_SESSION['keyAlm']);
	if ($datAlm) {
		if ($datAlm->id_detgrupo != "") {
			$datGrpAlm = $alumno->datGrpAlm($_SESSION['keyAlm']);
		}
	function formatFech($fechForm) {
		$fechDat = substr($fechForm, 0,4);
		$fechM = substr($fechForm, 5,2);
		$fechD = substr($fechForm, 8,2);
		$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
		$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
		$Fecha = date($fechD)." de ".$meses[date($fechM)-1]. " del ".date($fechDat);
		return $Fecha;
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
	        <h1 class="h3 mb-0 text-gray-800">Tutorias personales solicitadas</h1>
	    </div>
		<div class="row">
			<div class="col-md-12 col-lg-12">
				<div class="row pad30">
					<?php 
						//$dbc = Connect::getDB();
						$dbc = new Connect();
            $dbc = $dbc -> getDB();

						$stmt = $dbc -> prepare("SELECT * FROM tut_personales tut INNER JOIN 
							alumnos alm ON alm.id_alumno = tut.id_alumno
							WHERE alm.id_alumno = :keyAlm ORDER BY tut.fecha_reg_obs DESC");
						$stmt -> bindParam("keyAlm", $_SESSION['keyAlm'], PDO::PARAM_INT);
						$stmt -> execute();
						$filStmt = $stmt -> rowCount();
						if ($filStmt > 0) {
							while ($res = $stmt -> fetch(PDO::FETCH_OBJ)) {
					?>
							<div class="col-sm-12 col-lg-6">
								<div class="card pad10 shadow rounded border-left-primary">
									<div class=" card-body">
										<div class="card-title mb-4">
											<div class="text-left mb-1">
												<?php 
													if ($res->estado_tut == 1) {
												?>
													<span class="text-right badge-primary badge font-weight-normal p-2">Aceptada</span>
												<?php		
													} else {
												?>		
													<span class="text-right badge-danger badge font-weight-normal">Sin Aceptar</span>
												<?php
													}
												?>
											</div>
											<div class="text-right mb-3">
												<?php 
													if ($res->prioridad_tut == "Alta") {
												?>
													<span class="text-right badge-danger badge font-weight-normal p-1">Prioridad : <?php echo $res->prioridad_tut; ?></span>
												<?php
													}
												?>
												<?php 
													if ($res->prioridad_tut == "Media") {
												?>
													<span class="text-right badge-warning text-white badge font-weight-normal p-1">Prioridad : <?php echo $res->prioridad_tut; ?></span>
												<?php
													}
												?>
												<?php 
													if ($res->prioridad_tut == "Baja") {
												?>
													<span class="text-right badge-primary badge font-weight-normal p-1">Prioridad : <?php echo $res->prioridad_tut; ?></span>
												<?php
													}
												?>
											</div>
											<h5 class="text-center">
												Razones : 
												<?php echo $res->razones_tut; ?>
											</h5>
										</div>
										<div class="card-text mt-2">
											<h6 class="text-center">
												<i class="fas fa-calendar fa-lg icoIni text-primary"></i>
												Fecha de solicitud : 
												<span class="font-weight-normal badge badge-pill badge-primary">
													<?php echo formatFech($res->fecha_reg_obs); ?>	
												</span>	
											</h6>
											<hr style="height: 2px;" class="bg-primary rounded cardShadow">
											<h6 class="text-left mt-3">
												<i class="fas fa-calendar-check fa-lg icoIni text-primary">
												</i>
												Fecha de cita :
												<?php 
													if ($res->fecha_cita_tut != "" && $res->fecha_cita_tut != "0000-00-00") {
												?>
													<span class="font-weight-normal badge badge-pill badge-primary">
														<?php echo formatFech($res->fecha_cita_tut); ?>	
													</span>	
												<?php
													} else {
												?>
													<span class="font-weight-normal badge badge-pill badge-warning text-gray-dark">
														Sin definir	
													</span>	
												<?php		
													}
												?>
											</h6>
											<h6 class="text-left mt-3">
												<i class="fas fa-clock fa-lg icoIni text-primary">
												</i>
												Hora de la cita :
												<?php 
													if ($res->hora_cit_tut != "" && $res->hora_cit_tut != "00:00:00") {
												?>
													<span class="font-weight-normal badge badge-pill badge-primary">
														<?php echo $res->hora_cit_tut; ?>	
													</span>	
												<?php
													} else {
												?>
													<span class="font-weight-normal badge badge-pill badge-warning text-gray-dark">
														Sin definir	
													</span>	
												<?php		
													}
												?>
											</h6>
										</div>
									</div>
								</div>
								<br>
							</div>
					<?php
							}
						} else {
					?>
					
					<?php		
						}
					?>
				</div>
			</div>
		</div>
	</div>
  	<script src="<?php echo SERVERURLALM; ?>alm/js/justif.js"></script>
    <script src="<?php echo SERVERURLALM; ?>alm/js/grpAlm.js"></script>
    <script src="<?php echo SERVERURLALM; ?>alm/js/tutAlm.js"></script>
<?php
	} else {
		header("Location:".SERVERURLALM."alm/Logout.php");
	}
	  