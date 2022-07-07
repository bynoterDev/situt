<?php 

$dat = $devop -> detCareer();

?>

<div class="container-fluid animated fadeIn delay-1s">
	
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
	    <h1 class="h3 mb-0 text-gray-800">
	    	<i class="fas fa-university mr-2"></i>
	    	Carreras
	    </h1>
	    <a href="<?php echo SERVERURLDEV; ?>Home/" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
	      <i class="fas fa-arrow-left fa-sm text-white-50 mr-2"></i> Regresar 
	    </a>
	</div>

	<div class="row">
		<?php 
			if ($dat->rowCount() > 0) {
				while ( $d = $dat -> fetch(PDO::FETCH_OBJ) ) {
		?>
				<div class="col-sm-6 mb-4">
					<div class="shadow border-left-primary rounded p-3">
						<h4 class="text-center font-weight-bold">
							<?php echo $d->nombre_car; ?>.
						</h4>
						<hr>
						<h5>
							<b>
								<i class="fas fa-user-tie mr-2 text-primary"></i>
								Director: <?php echo $d->nombre_c_dir; ?>.
							</b>
						</h5>
					</div>
				</div>
		<?php
				}
			} else {
		?>
			<div class="col-sm-12">
				<div class="text-center">
            		<img class="img-fluid px-3 px-sm-4 mt-4 mb-4" style="width: 15rem;" src="<?php echo SERVERURL; ?>assets/img/notdata.svg" alt="image not register">
            		<h1 class="h3 mb-0 mt-2 text-gray-800 text-center">
            			Aún no se han generado registros...
		            </h1>
          		</div>
			</div>
		<?php
			}
		?>
	</div>

</div>