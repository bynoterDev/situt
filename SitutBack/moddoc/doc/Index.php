<style type="text/css">
	.ocult {
		display: none;
	}
</style>

<div class="container-fluid animated fadeIn mt-4">
	<!--
	<div class="row mt-5">
		<div class="col-md-12 col-lg-12" id="loader">
			<div class="text-center mt-5">
				<div class="spinner-grow text-primary mb-3" role="status" style="width: 100px; height: 100px;">
				  <span class="sr-only">Loading...</span>
				</div>
				<b>
					<h3 class="text-primary font-weight-bold mt-5" id="textLoad">
						Cargando contenido...
					</h3>
				</b>	
			</div>
		</div>
	</div>-->

	<div class="row mt-4 ocult2 align-items-center" id="contend"><!--QUITAR OCULT-->
		<?php 
			$sql = "SELECT det.id_detgrupo, grp.grupo_n, grp.period_cuat, car.nombre_car FROM det_grupo det
			INNER JOIN grupos grp ON grp.id_grupo = det.id_grupo 
			INNER JOIN docentes doc ON doc.id_docente = det.id_docente
			INNER JOIN carreras car On car.id_carrera = det.id_carrera
			WHERE doc.id_docente = '".$keyDoc."' && det.estado_detgrp = 1";
			$result = $conexion->query($sql);
			$cantResult = mysqli_num_rows($result);
			$imp = "";
			$datAn = date("Y");
			if ($cantResult > 0) {
				?>
				<div class="text-center col-sm-12 mb-4 text-primary">
					<h4 class="font-weight-bold">Mis grupos asignados</h4>
				</div>
				<?php
				while ($res = $result -> fetch_object()) {
					$notifGrpJustif = $docente->notifJustifGrp($keyDoc, $res->id_detgrupo);
					if ($notifGrpJustif->Cantidad > 0) {
						echo '
							<div class="col-sm-12 col-md-4">
								<div class="card shadow border-left-danger hovAnim">
								  	<div class="card-body">
								  	<div class="text-right">
								  		<span class="badge badge-danger" style="font-size:12px;">
								  		<i class="fas fa-clock mr-2"></i>Pendientes</span>
								  	</div>
								    	<h5 title="'.$res->nombre_car.'" class="card-title text-center text-truncate mt-3">
								    		'.$res->nombre_car.'
								    	</h5>
								  	</div>
								  	<ul class="list-group list-group-flush text-center">
								    	<h6 class="list-group-item text-primary">
								    		<i class="fas fa-users mr-2 "></i>
								    		'.$res->grupo_n.'
								    	</h6>
								    	<h6 class="list-group-item text-primary">
								    		<i class="fas fa-calendar mr-2 "></i>
								    		'.$res->period_cuat.' '.$datAn.'
								    	</h6>
								    </ul>
								  	<div class="card-body text-center">
								    	<a href="'.SERVERURLDOC.'DetGrp/'.base64_encode($res->id_detgrupo).'/" class="btn btn-outline-primary btn-md">
								    		<i class="fas fa-plus mr-2"></i>
								    		Detalles
								    	</a>
								  	</div>
								</div>
								<br>
							</div>';
					} else {
						echo '
							<div class="col-sm-12 col-md-4">
								<div class="card shadow border-left-primary hovAnim">
								  	<div class="card-body">
								  	<div class="text-right">
								  		<span class="badge badge-primary" style="font-size:12px;">
								  		<i class="fas fa-check mr-2"></i>Todo bien</span>
								  	</div>
								    	<h5 title="'.$res->nombre_car.'" class="card-title text-center text-truncate mt-3">
								    		'.$res->nombre_car.'
								    	</h5>
								  	</div>
								  	<ul class="list-group list-group-flush text-center">
								    	<h6 class="list-group-item text-primary">
								    		<i class="fas fa-users mr-2 "></i>
								    		'.$res->grupo_n.'
								    	</h6>
								    	<h6 class="list-group-item text-primary">
								    		<i class="fas fa-calendar mr-2 "></i>
								    		'.$res->period_cuat.' '.$datAn.'
								    	</h6>
								    </ul>
								  	<div class="card-body text-center">
								    	<a href="'.SERVERURLDOC.'DetGrp/'.base64_encode($res->id_detgrupo).'/" class="btn btn-outline-primary btn-sm">
								    		<i class="fas fa-plus mr-2"></i>
								    		Detalles
								    	</a>
								  	</div>
								</div>
								<br>
							</div>';
					}
					
				}
			} else {
		?>
			<div class="col-sm-12 mt-4">
				<div class="text-center mt-4 mb-4">
					<img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 15rem;" src="<?php echo SERVERURL; ?>assets/img/notdata.svg" alt="info site">
				</div>
				<h4 class="text-center bg-white text-primary font-weight-bold p-3 border-left-primary shadow rounded">
					No cuentas con ningun grupo asignado, consulta con tu director si crees que esto es un error...
				</h4>
			</div>
		<?php
			}
		?>
	</div>
</div>

<script type="text/javascript">
	/*
	document.addEventListener('DOMContentLoaded', () => {
		setTimeout(function(){
			$("#textLoad").html("<i class='fas fa-thumbs-up mr-2'></i> Todo correcto!");
			setTimeout(function(){
				$("#loader").addClass("animated fadeOut");
				setTimeout(function(){
					$("#loader").hide();
					setTimeout(function(){
						$("#contend").removeClass("ocult");
						$("#contend").addClass("animated fadeIn");
					},500);
				}, 1000);
			},1500);
		},9000);
	});
*/
</script>
