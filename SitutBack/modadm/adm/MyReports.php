<?php 
	$tag = 'Administrador';
	$datRep = $admin -> datMyReportEnv($tag, $keyAdm);
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
<div class="container-fluid animated fadeIn delay-1s">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 text-center">Reportes enviados.</h1>
        <a href="<?php echo SERVERURLADM; ?>Home/" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50 mr-2"></i> Regresar 
        </a>
    </div>
	
	<div class="row mt-4">

		<?php 
			$cant = $datRep -> rowCount();
			if ($cant > 0) {
				while ($datMR = $datRep -> fetch(PDO::FETCH_OBJ)) {
		?>
				<div class="col-sm-6">
					<div class="card shadow mb-4">
		                <!-- Card Header - Accordion -->
		                <a href="#collapseCardExample<?php echo $datMR->id_report; ?>" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample<?php echo $datMR->id_report; ?>">
		                  <h6 class="m-0 font-weight-bold text-primary">Codigo de serie: <b><?php echo $datMR->num_serie_rep; ?></b></h6>
		                </a>
		                <!-- Card Content - Collapse -->
		                <div class="collapse show" id="collapseCardExample<?php echo $datMR->id_report; ?>">
		                  <div class="card-body">
		                  	<b>Descripcion: </b>
		                  	<?php echo $datMR->describ_prob; ?>
		                  	<hr class="sidevar-divider">
		                  	<b>Fecha de envío: </b> <?php echo formatFech($datMR->fecha_reg_rep); ?>
		                  	<hr class="sidevar-divider">
		                  	<div class="row">
		                  		<div class="col-sm-6 mb-3">
		                  			<b>Estado: </b>
				                  	<?php 
				                  		if ($datMR->estado_rep == 1) {
				                  	?>
				                  		<span class="badge badge-pill badge-warning ml-3">
				                  			En proceso...
				                  		</span>
				                  	<?php
				                  		} else {
				                  	?>
										<span class="badge badge-pill badge-primary ml-3">
				                  			Resuelto <i class="fas fa-check ml-2"></i>
				                  		</span>
				                  	<?php
				                  		}
				                  	?>
		                  		</div>
		                  		<div class="col-sm-6">
		                  			<b>Imagen: </b>
				                  	<?php 
				                  		if ($datMR->arch_prob == 'Sin imagen') {
				                  	?>
				                  		<span class="badge badge-pill badge-warning ml-3">
				                  			No proporcionada...
				                  		</span>
				                  	<?php
				                  		} else {
				                  	?>
										<span class="badge badge-pill badge-primary ml-3">
				                  			Proporcionada <i class="fas fa-check ml-2"></i>
				                  		</span>
				                  	<?php
				                  		}
				                  	?>
		                  		</div>
		                  	</div>
		                  </div>
		                </div>
		              </div>
				</div>
		<?php
				}
			} else {
		?>
			<div class="col-sm-12 text-center mt-5">
				<img class="img-fluid px-3 px-sm-4 mb-4" style="width: 13rem;" src="<?php echo SERVERURL; ?>assets/img/notdata.svg" alt="info site">
				<h3 class="text-center text-danger">
					<b>
						Aún no se han generado registros...
					</b>
				</h3>
			</div>
		<?php
			}
		?>

		
	</div>

</div>