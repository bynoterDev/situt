<?php

$codigo = explode("/", $_GET['view']);
$clvTut = $codigo[1];
$dTut = $director -> mostrarDatTut(base64_decode($clvTut));

?>


	<style type="text/css">
		.ocult {
			display: none;
		}
	</style>


<div class="container-fluid mt-4 animated fadeIn delay-1s">
	
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">
		    <i class="fas fa-user mr-2 text-primary"></i>
			<b><?php echo "Dirección de: ".$datDirec->nombre_car; ?>.
		</h1>
		<a href="<?php echo SERVERURLDIR; ?>RegTutores/" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
		   	<i class="fas fa-arrow-left fa-sm text-white-50 mr-2"></i> Tutores 
		</a>
	</div>


	<div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">
          	Perfil del tutor
          </h6>
        </div>
        <div class="card-body">
          <div class="row">
          	<div class="col-sm-6">
          		<h5 class="text-left text-capitalize text-primary">
					<i class="fas fa-user-tie mr-2"></i>
					Docente : 
					<?php echo $dTut->nombre_c_doc; ?>
				</h5>
				<h5 class="text-left text-capitalize text-primary mt-4">
					<i class="fas fa-phone mr-2"></i>
					Telefono : <b><?php echo $dTut->telefono_doc; ?>.</b>
				</h5>
				<h5 class="text-left text-primary mt-4">
					<i class="fas fa-id-badge mr-2"></i>
					Cuenta : 
					<?php 
						if ($dTut -> condicion_doc != 1) {
					?>
						<span class="badge badge-danger">
							<i class="fas fa-times mr-2"></i>
							Inactiva
						</span>
					<?php
						} else {
					?>
						<span class="badge badge-primary">
							<i class="fas fa-check mr-2"></i>
							Activa
						</span>
					<?php
						}
					?>
				</h5>
				<h5 class="text-left text-capitalize text-primary mt-4">
					<i class="fas fa-calendar-check mr-2"></i>
					Registro : <b><?php echo formatFech($dTut->fecha_reg_doc); ?>.</b>
				</h5>
				<h5 class="text-left text-capitalize text-primary mt-4">
					<i class="fas fa-calendar mr-2"></i>
					Ultima sesion : <b><?php echo formatFech($dTut->fecha_ult_ses_doc); ?>.</b>
				</h5>
				<h5 class="text-left text-primary mt-4">
					<a class="text-primary" href="#" data-backdrop="false" data-toggle="modal" data-target="#confContTut">
						<i class="fas fa-key mr-2"></i>
						Cambiar contraseña
					</a>
				</h5>
          	</div>
          	<div class="col-sm-6 mb-4 text-center">
				<?php 
					if ($dTut->foto_perf_doc != "") {
				?>
					<img src="<?php echo SERVERURLDIR; ?>perfilFot/<?php echo $dTut->foto_perf_doc; ?>" width="200" class="img-fluid rounded" alt="">
				<?php		
					} else {
				?>
					<img src="<?php echo SERVERURL; ?>vistas/img/usermal.png" width="200" class="img-fluid rounded" alt="">
				<?php
					}
				?>
				<h5 class="text-center mt-3">
					<?php 
						if ($dTut -> condicion_doc != 1) {
					?>
						<button onclick="activarTut(<?php echo $dTut->id_docente; ?>)" class="btn btn-outline-primary mt-3 btn-sm" type="button">
							<i class="fas fa-check icoIni"></i>
							Activar Cuenta
						</button>
					<?php
						} else {
					?>
						<button onclick="desactivarTut(<?php echo $dTut->id_docente; ?>)" class="btn btn-outline-danger mt-3 btn-sm" type="button">
							<i class="fas fa-times icoIni"></i>
							Desactivar Cuenta
						</button>
					<?php
						}
					?>
				</h5>
			</div>
          </div>          
          <div class="row">
          	<div class="col-sm-12 mb-5 mt-4">
          		<h4 class="text-center">Grupos tutorados:</h4>
          	</div>
				<?php 
					$dbc = new Connect();
					$dbc = $dbc -> getDB();
					$stmt = $dbc -> prepare("SELECT * FROM det_grupo det 
		    			INNER JOIN carreras car ON car.id_carrera = det.id_carrera
		    			INNER JOIN grupos gr ON gr.id_grupo = det.id_grupo
		    			INNER JOIN docentes doc ON doc.id_docente = det.id_docente
		    			WHERE doc.id_docente = :id_docente");
		    		$stmt -> bindParam("id_docente", $dTut->id_docente, PDO::PARAM_INT);
		    		$stmt -> execute();
		    		if ($stmt->rowCount() >= 1) {
			    		while ($res = $stmt -> fetch(PDO::FETCH_OBJ)) {
			   		?>
					<div class="col-sm-4">
						<div class="card pad10 border-left-primary rounded">
							<div class=" card-body" title="<?php echo $res->nombre_car; ?>">
								<div class="card-title mb-4">
									<h5 class="text-left text-truncate font-weight-bold" title="<?php echo $res->nombre_car ?>">
										<?php echo $res->nombre_car; ?>
									</h5>
								</div>
								<hr style="height: 2px;" class="bg-primary rounded">
								<div class="card-text mt-4">
									<h5 class="text-center font-weight-bold">
										<i class="fas fa-users mr-2 icoIni text-primary"></i>
										<?php echo $res->grupo_n; ?>		
									</h5>
								</div>
							</div>
						</div>
					</div>
			   		<?php
			    		}
		    		} else {
		    	?>
		    	<div class="col-sm-12 text-center">
		    		<h4>
		    			<i class="fas fa-users fa-2x icoIni"></i>
		    			Sin grupos asignados
		    		</h4>
		    	</div>
		    	<?php			
		    		}
				?>
			</div>
        </div>
	</div>

			
			
</div>
<?php include 'modalsInfo/modalConfContDoc.php'; ?>
<script src="<?php echo SERVERURLDIR; ?>dir/js/perfDoc.js"></script>
