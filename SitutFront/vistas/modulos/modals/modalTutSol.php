<div class="modal fade bgModal" id="solTut" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title text-info" id="exampleModalLabel"><i class="fas fa-plus fa-lg icoIni"></i>Solicitar tutoría</h5>
	        <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form class="row" method="POST" id="formSolicTutoria" name="formSolicTutoria">
	        	<div class="col-sm-1"></div>
	        	<div class="col-sm-10">
	        		<div class="form-group">
	        			<label>Cuatrimestre:</label>
	        			<input class="form-control" type="text" readonly="" value="<?php echo $datGrpAlm->cuatrimestre_g ?>" name="cuatrinom">
	        		</div>
	        		<div class="form-group">
	        			<label for="razTut">Razones:</label>
	        			<input type="text" id="razTut" name="razTut" class="form-control">
	        		</div>
	        		<div class="form-group">
	        			<label for="priodTut">Prioridad:</label>
	        			<select class="form-control" name="priodTut" id="priodTut">
	        				<option selected="" value="0">Selecciona</option>
	        				<option value="Alta">Alta</option>
	        				<option value="Media">Media</option>
	        				<option value="Baja">Baja</option>
	        			</select>
	        		</div>
	        	</div>
	        	<div class="col-sm-1"></div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" id="btnCloseTut" class="btn btn-outline-danger" data-dismiss="modal">
	        	<i class="fas fa-times-circle mr-2"></i>
	        	Cerrar</button>
	        <button type="submit" class="btn btn-outline-primary">
	        	<i class="fas fa-check-circle mr-2"></i>
	        	Guardar</button>
	        </form>
	      </div>
	    </div>
	  </div>
	</div>