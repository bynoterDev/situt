<div class="modal fade bgModal" id="solJustif" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title text-info" id="exampleModalLabel"><i class="fas fa-plus text-info fa-lg icoIni"></i>Solicitar justificante</h5>
	        <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form class="row" method="POST" id="formSolicJustif" name="formSolicJustif" autocomplete="off">
	        	<div class="col-sm-1"></div>
	        	<div class="col-sm-10">
	        		<div class="form-group">
	        			<label for="sitJustif">Situación:</label>
	        			<textarea id="sitJustif" name="sitJustif" class="form-control"></textarea>
	        		</div>
	        		<div class="form-group">
	        			<label for="cuatJustif">Cuatrimestre:</label>
	        			<input type="text" readonly="" value="<?php echo $datGrpAlm->cuatrimestre_g ?>" id="cuatJustif" name="cuatJustif" class="form-control">
	        		</div>
	        		<div class="form-group">
	        			<label for="archJustif">Archivo:</label>
	        			<input type="file" id="archJustif" name="archJustif" class="form-control">
	        			<span class="text-center text-muted">Formato de archivo ó imagen .pdf, .png, .jpeg y .jpg</span>
	        		</div>
	        		<div class="form-group">
	        			<label for="fechJustif">Fecha:</label>
	        			<input type="date" id="fechJustif" name="fechJustif" class="form-control">
	        		</div>
	        	</div>
	        	<div class="col-sm-1"></div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" id="btnCloseJustif" class="btn btn-outline-danger" data-dismiss="modal">
	        	<i class="fas fa-times-circle mr-2"></i>
	        	Cerrar</button>
	        <button type="submit" class="btn btn-outline-primary">
	        	<i class="fas fa-check-circle mr-2"></i>
	        	Guardar
	        </button>
	        </form>
	      </div>
	    </div>
	  </div>
	</div>