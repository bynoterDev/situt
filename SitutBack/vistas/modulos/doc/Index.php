<?php 

ob_start();
session_start();

if ($_SESSION['keyDoc'] == "" || $_SESSION['keyDoc'] == null) {
	header("Location:../Index.php");
} else {
	include '../modelos/docente.modelo.php';
	$docente = new Docentes();
	$keyDoc = $_SESSION['keyDoc'];
	$datDoce = $docente->userDocDet($keyDoc);
	if ($datDoce) {
?>

<?php include 'header.php'; ?>
	<br><br><br>

	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12 col-lg-4">
				<div class="cardShadow pad30">
					<?php 
						if ($datDoce -> foto_perf_doc != "") {
					?>
						<div class="text-center">
							<img width="300" src="perfilFot/<?php echo $datDoce->foto_perf_doc; ?>" class="img-fluid img-thumbnail rounded">
						</div>
						<hr style="height: 2px;" class="bg-success rounded">
					<?php
						} else {
					?>
						<h5 class="text-center">
							<i class="fas fa-user fa-5x mb-3"></i>
							<br>
							Sin Foto De Perfil
							<hr style="height: 2px;" class="bg-success rounded">
						</h5>
					<?php
						}
					?>
					<h4 class="text-center">
						<?php echo $datDoce->especialidad_doc; ?> :
						<?php echo $datDoce->nombre_c_doc; ?>
					</h4>
					<br>
					<h5 class="text-left">
						<i class="fas fa-envelope icoIni fa-lg"></i>
						<?php echo $datDoce->correo_doc; ?>
					</h5>
					<br>
					<h5 class="text-left">
						<i class="fas fa-phone icoIni fa-lg"></i>
						<?php echo $datDoce->telefono_doc; ?>
					</h5>
					<br>
					<h5 class="text-left">
						<i class="fas fa-calendar icoIni fa-lg"></i>
						<?php echo $datDoce->fecha_reg_doc; ?>
					</h5>
				</div>
				<br>
			</div>
			<div class="col-md-12 col-lg-8">
				<div class="row">
					<?php 
						$sql = "SELECT det.id_detgrupo, grp.grupo_n, grp.period_cuat, car.nombre_car FROM det_grupo det
						INNER JOIN grupos grp ON grp.id_grupo = det.id_grupo 
						INNER JOIN docentes doc ON doc.id_docente = det.id_docente
						INNER JOIN carreras car On car.id_carrera = det.id_carrera
						WHERE doc.id_docente = '".$keyDoc."' && det.estado_detgrp = 1";
						$result = $conexion->query($sql);
						$imp = "";
						$datAn = date("Y");
						while ($res = $result -> fetch_object()) {
							$notifGrpJustif = $docente->notifJustifGrp($keyDoc, $res->id_detgrupo);
							if ($notifGrpJustif->Cantidad > 0) {
								echo '
									<div class="col-sm-12 col-md-6">
										<div class="card cardShadow">
										  	<div class="card-body">
										  	<div class="text-right">
										  		<span class="badge badge-danger" style="font-size:16px;">
										  		<i class="fas fa-clock icoIni"></i>Pendientes</span>
										  	</div>
										    	<h3 class="card-title text-center">
										    		<i class="fas fa-university icoIni"></i>
										    		'.$res->nombre_car.'
										    	</h3>
										  	</div>
										  	<ul class="list-group list-group-flush text-center">
										    	<h4 class="list-group-item text-success">
										    		<i class="fas fa-users icoIni "></i>
										    		'.$res->grupo_n.'
										    	</h4>
										    	<h4 class="list-group-item text-success">
										    		<i class="fas fa-calendar icoIni "></i>
										    		'.$res->period_cuat.' '.$datAn.'
										    	</h4>
										    </ul>
										  	<div class="card-body text-center">
										    	<a href="DetGrp.php?v='.base64_encode($res->id_detgrupo).'" class="btn btn-outline-success btn-lg">
										    		<i class="fas fa-plus icoIni"></i>
										    		Detalles
										    	</a>
										  	</div>
										</div>
										<br>
									</div>';
							} else {
								echo '
									<div class="col-sm-12 col-md-6">
										<div class="card cardShadow">
										  	<div class="card-body">
										  	<div class="text-right">
										  		<span class="badge badge-success" style="font-size:16px;">
										  		<i class="fas fa-check icoIni"></i>Todo bien</span>
										  	</div>
										    	<h3 class="card-title text-center">
										    		<i class="fas fa-university icoIni"></i>
										    		'.$res->nombre_car.'
										    	</h3>
										  	</div>
										  	<ul class="list-group list-group-flush text-center">
										    	<h4 class="list-group-item text-success">
										    		<i class="fas fa-users icoIni "></i>
										    		'.$res->grupo_n.'
										    	</h4>
										    	<h4 class="list-group-item text-success">
										    		<i class="fas fa-calendar icoIni "></i>
										    		'.$res->period_cuat.' '.$datAn.'
										    	</h4>
										    </ul>
										  	<div class="card-body text-center">
										    	<a href="DetGrp.php?v='.base64_encode($res->id_detgrupo).'" class="btn btn-outline-success btn-lg">
										    		<i class="fas fa-plus icoIni"></i>
										    		Detalles
										    	</a>
										  	</div>
										</div>
										<br>
									</div>';
							}
							
						}
					?>
				</div>
			</div>
		</div>
	</div>

	<br><br><br>
	
	<?php include 'modalsconf.php'; ?>

	<script src="../vistas/js/jquery-3.1.1.min.js"></script>
	<!-- SweetAlert -->
    <script src="../vistas/node_modules/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vistas/Assets/js/vendor/popper.min.js"></script>
    <script src="../vistas/Js/bootstrap.min.js"></script>
    <script src="../vistas/assets/js/vendor/holder.min.js"></script>
    <!--- Personalizados -->
    <script src="../vistas/modulos/doc/js/confDatDoc.js"></script>

<?php include 'footer.php'; ?>

<?php		
	} else {
		header("Location:Logout.php");
	}
}

ob_end_flush();
?>