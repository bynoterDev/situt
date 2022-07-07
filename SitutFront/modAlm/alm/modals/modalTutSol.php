<div class="modal fade bgModal" id="solTut" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	      	<h6 class="modal-title font-weight-bold mb-0 text-gray-700" id="exampleModalLabel"><i class="fas text-gray-300 fa-plus fa-lg mr-2"></i> Solicitar tutoría</h6>
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
	        <button type="button" id="btnCloseTut" class="btn btn-outline-danger btn-sm" data-dismiss="modal">
	        	<i class="fas fa-times-circle mr-2"></i>
	        	Cerrar</button>
	        <button type="submit" id="btnpr" class="btn btn-outline-primary btn-sm">
	        	<i class="fas fa-check-circle mr-2"></i>
	        	Guardar</button>
	        </form>
	      </div>
	    </div>
	  </div>
	</div>