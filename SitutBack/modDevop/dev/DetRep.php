<?php 


$cod = explode("/", $_GET['view']);
$param1 = $cod[1];
$param2 = base64_decode($cod[2]);
$datRep = $devop -> dataRepSel($cod[2]);
	
?>

<div class="container-fluid animated fadeIn delay-1s">
		
	<?php 
		if ($datRep->rowCount() === 1) {
			$dr = $datRep -> fetch(PDO::FETCH_OBJ);
			$nomUs = "";
			if ($dr -> tag_user === 'Coordinador') {
				$dUsRep = $devop -> datTagRepCor(base64_encode($dr->id_report),base64_encode($dr->tag_user));
				$nomUs .= $dUsRep -> nombre_c_cor;
			} else if ($dr -> tag_user === 'Administrador') {
				$dUsRep = $devop -> datTagRepAdm(base64_encode($dr->id_report),base64_encode($dr->tag_user));
				$nomUs .= $dUsRep -> nombre_c;
			} else if ($dr -> tag_user === 'Director') {
				$dUsRep = $devop -> datTagRepDir(base64_encode($dr->id_report),base64_encode($dr->tag_user));
				$nomUs .= $dUsRep -> nombre_c_dir;
			} else if ($dr -> tag_user === 'Docente') {
				$dUsRep = $devop -> datTagRepDoc(base64_encode($dr->id_report),base64_encode($dr->tag_user));
				$nomUs .= $dUsRep -> nombre_c_doc;
			} else if ($dr -> tag_user === 'Alumno') {
				$dUsRep = $devop -> datTagRepAlm(base64_encode($dr->id_report),base64_encode($dr->tag_user));
				$nomUs .= $dUsRep -> nombre_c_doc;
			}
	?>
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
		    <h1 class="h3 mb-0 text-gray-800">
		    	<i class="fas fa-file-alt mr-2 text-primary"></i>
		    	Detalle de reporte: <b><?php echo $dr->num_serie_rep; ?></b>
		    </h1>
		    <a href="<?php echo SERVERURLDEV; ?>EstateRep/<?php echo $param1; ?>/" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
		      <i class="fas fa-arrow-left fa-sm text-white-50 mr-2"></i> Regresar 
		    </a>
		</div>

		
		<div class="row">
			
			<div class="col-sm-12">
				<div class="card shadow mb-4">
	                <div class="card-header py-3">
	                  <h6 class="m-0 font-weight-bold text-primary">
	                  	Estado del reporte:
	                  	<?php 
	                  		if ($dr->estado_rep == 1) {
	                  	?>
							<span class="badge badge-warning ml-2">
								<i class="fas fa-spinner mr-2"></i>
								En proceso...
							</span>
	                  	<?php
	                  		} else {
	                  	?>
							<span class="badge badge-success ml-2">
								<i class="fas fa-check-circle mr-2"></i>
								Resuelto...
							</span>
	                  	<?php
	                  		}
	                  	?>
	                  </h6>
	                </div>
	                <div class="card-body">
	                  	<div class="text-center">
	                    	<img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 15rem;" src="<?php echo SERVERURL; ?>assets/img/browstac.svg" alt="info site">
	                  	</div>
	                  	<?php 
	                  		if ($dr->estado_rep == 1) {
	                  	?>
							<div class="text-center mb-3">
	                  			<span class="badge badge-pill badge-primary">
	                    			Solicitud el <?php echo formatFech($dr->fecha_reg_rep); ?>.
	                    		</span>
	                  		</div>
	                  	<?php
	                  		}
	                  	?>		
	                  	<p class="p-2">
	                  		<b class="mr-2">Descripción:</b>
	                  		<?php echo $dr->describ_prob; ?>.
	                  	</p>
	                  	<div class="row mt-4 p-2 text-center">
		                  	<div class="col-sm-4 mb-4">
		                  		<b>Reporto:</b>
		                  		<span class="ml-2 badge badge-primary">
									<i class="fas fa-user mr-2"></i>
									<?php 
										echo $nomUs;
									?>.
								</span>
		                  	</div>
		                  	<div class="col-sm-4 mb-4">
		                  		<b>Tag:</b>
		                  		<span class="ml-2 badge badge-primary">
									<i class="fas fa-tag mr-2"></i>
									<?php echo $dr->tag_user; ?>.
								</span>
		                  	</div>
		                  	<div class="col-sm-4 mb-4">
		                  		<b>Imagen:</b>
		                  		<?php 
		                  			if ($dr->arch_prob != "Sin imagen") {
		                  		?>
									<span class="ml-2 badge badge-success">
										<i class="fas fa-image mr-2"></i>
										Imagen.
									</span>
		                  		<?php
		                  				
		                  			} else {
		                  		?>
									<span class="ml-2 badge badge-warning">
										<i class="fas fa-times mr-2"></i>
										No disponible...
									</span>
		                  		<?php
		                  			}
		                  		?>
		                  	</div>
	                  	</div>
	                  	<?php 
	                  		if ($dr -> estado_rep == 1) {
	                  	?>
							<hr class="sidevar-divider">
		                  	<div class="text-center">
	                  			<h5 class="text-primary">
		                  			<b>Nota: *</b>
		                  			Si el problema esta resuelto completa el siguiente formulario
		                  			<b>*</b>
		                  		</h5>
	                  		</div>
		                  	<form class="row mt-4 p-2 mb-4" id="forRep">
		                  		<input type="hidden" name="clvRep" value="<?php echo $dr->id_report; ?>">
		                  		<div class="col-sm-6 mb-3">
		                  			<div class="form-group">
		                  				<label for="notaAg">Agregar:</label>
		                  				<textarea class="form-control" rows="5" placeholder="Mensaje..." name="notaAg" id="notaAg"></textarea>
		                  			</div>
		                  		</div>
		                  		<div class="col-sm-6 mb-3">
		                  			<div class="form-group">
		                  				<label for="selectEst">Estado:</label>
		                  				<select class="form-control" name="selectEst" id="selectEst">
		                  					<option value="0" selected="">Resuelto</option>
		                  				</select>
		                  			</div>
		                  			<div class="form-group">
		                  				<label for="confirmPs" class="font-weight-bold text-primary">Introduce tu contraseña para confirmar:</label>
		                  				<input type="password" name="confirmPs" id="confirmPs" class="form-control">
		                  			</div>
		                  			<div class="text-center mt-4 border-left-danger animated d-none" id="divErr">
		                  				<span class="font-weight-bold">
		                  					Todos los campos son requeridos...
		                  				</span>
		                  			</div>
		                  			<div class="text-center mt-4 border-left-success animated d-none" id="divGod">
		                  				<span class="font-weight-bold">
		                  					Correcto!, actualizando...
		                  				</span>
		                  			</div>
		                  			<div class="text-center mt-4">
			                  			<button class="btn btn-sm btn-primary" id="btnReg">
			                  				<i class="fas fa-check mr-2"></i> Registrar
			                  			</button>
			                  		</div>
		                  		</div>
		                  	</form>
		                  	<script src="<?php echo SERVERURLDEV; ?>dev/js/conf/modifrep.js"></script>
	                  	<?php
	                  		} else {
	                  			$drRes = $devop -> dataResultRep(base64_encode($dr->id_report));
	                  	?>

	                  		<div class="row">
	                  			<div class="col-sm-6 text-center mb-4">
		                  			<b>Fecha de resolución:</b>
			                  		<span class="ml-2 badge badge-primary">
										<i class="fas fa-calendar mr-2"></i>
										<?php 
											echo formatFech($drRes->fecha_result);
										?>.
									</span>
		                  		</div>
		                  		<div class="col-sm-6 text-center mb-4">
		                  			<b>Fecha de solicitud:</b>
			                  		<span class="ml-2 badge badge-primary">
										<i class="fas fa-calendar mr-2"></i>
										<?php 
											echo formatFech($drRes->fecha_reg_rep);
										?>.
									</span>
		                  		</div>
		                  		<div class="col-sm-12 mt-4 text-center mb-4">
									<p>
										<b class="mr-2"><i class="fas fa-comment mr-2 text-primary"></i>Nota agregada:</b>
										<?php echo $drRes->nota_result; ?>.
									</p>
		                  		</div>
	                  		</div>

	                  	<?php
	                  		}
	                  	?>
	                </div>
	            </div>
			</div>
		</div>
		



	<?php
		} else {
	?>

		<div class="row">
			
			<div class="col-sm-12 mt-5">
		      <div class="text-center">
		        <div class="error mx-auto" data-text="404">404</div>
		        <p class="lead text-gray-800 mb-5">Página no encontrada...</p>
		        <p class="text-gray-500 mb-0">
		          Al parecer hubo un problema al momento de buscar un dato erroneo...
		        </p>
		        <a href="<?php echo SERVERURLDEV; ?>Home/">&larr; Volver al inicio</a>
		      </div>
		    </div>

		</div>
	
	<?php
		}
	?>

</div>