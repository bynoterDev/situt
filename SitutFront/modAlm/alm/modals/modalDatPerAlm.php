<div class="modal fade" id="datPerAlm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h6 class="modal-title font-weight-bold mb-0 text-gray-700" id="exampleModalLabel"><i class="fas text-gray-300 fa-address-card fa-lg mr-2"></i> Completar datos personales</h6>
	        <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form class="row" method="POST" id="formDatPerAlm" name="formDatPerAlm" autocomplete="off">
	        	<div class="col-sm-1"></div>
	        	<div class="col-sm-10">
	        		<div class="form-group">
	        			<label for="curpDat">Curp:</label>
	        			<input type="text" id="curpDat" onchange="validarInput(this)" name="curpDat" class="form-control">
	        		</div>
	        		<div class="row">
	        			<div class="col-sm-6">
	        				<div class="form-group">
			        			<label for="fechNac">Fecha de nacimiento:</label>
			        			<input required="" type="date" id="fechNac" name="fechNac" class="form-control">
			        		</div>
	        			</div>
	        			<div class="col-sm-6">
	        				<div class="form-group">
			        			<label for="eddAlm">Edad:</label>
			        			<input required="" type="number" id="eddAlm" name="eddAlm" class="form-control">
			        		</div>
	        			</div>
	        		</div>
	        		<div class="row">
	        			<div class="col-sm-6">
	        				<div class="form-group">
			        			<label for="estCiv">Estado civil:</label>
			        			<select type="date" id="estCiv" name="estCiv" class="form-control">
									<option selected="" value="0">Selecciona</option>
									<option value="Casado">Casado</option>
									<option value="Divorciado">Divorciado</option>
									<option value="Viudo">Viudo</option>
									<option value="Soltero">Soltero</option>
			        			</select>
			        		</div>
	        			</div>
	        			<div class="col-sm-6">
	        				<div class="form-group">
					        	<label for="faceAlm">Facebook:</label>
					        	<input required="" type="text" id="faceAlm" name="faceAlm" class="form-control">
					        </div>
	        			</div>
	        		</div>
	        		<div class="row">
	        			<div class="col-sm-6">
	        				<div class="form-group">
			        			<label for="tipSegSocial">Tipo de seguridad social:</label>
			        			<input type="text" id="tipSegSocial" name="tipSegSocial" class="form-control">
			        		</div>
	        			</div>
	        			<div class="col-sm-6">
	        				<div class="form-group">
			        			<label for="numSegSocial">No. de seguridad social:</label>
			        			<input type="number" id="numSegSocial" name="numSegSocial" class="form-control">
			        		</div>
	        			</div>
	        		</div>
	        		<div class="row">
	        			<div class="col-sm-6">
	        				<div class="form-group">
			        			<label for="telCas">Telefono casa:</label>
			        			<input pattern="[0-9]{10}" type="tel" id="telCas" name="telCas" class="form-control">
			        		</div>
	        			</div>
	        			<div class="col-sm-6">
	        				<div class="form-group">
			        			<label for="telRec">Telefono recado:</label>
			        			<input pattern="[0-9]{10}" type="tel" id="telRec" name="telRec" class="form-control">
			        		</div>
	        			</div>
	        		</div>
	        		<div class="form-group">
	        			<span class="lead">Domicilio actual</span>
	        		</div>
	        		<div class="row">
	        			<div class="col-sm-6">
	        				<div class="form-group">
					        	<label for="callDomAlm">Calle:</label>
					        	<input required="" type="text" id="callDomAlm" name="callDomAlm" class="form-control text-capitalize">
					        </div>
	        			</div>
	        			<div class="col-sm-6">
	        				<div class="form-group">
					        	<label for="numDomAlm">Numero:</label>
					        	<input type="text" id="numDomAlm" name="numDomAlm" class="form-control">
					        </div>
	        			</div>
	        		</div>
	        		<div class="row">
	        			<div class="col-sm-6">
	        				<div class="form-group">
					        	<label for="colDomAlm">Colonia:</label>
					        	<input required="" type="text" id="colDomAlm" name="colDomAlm" class="form-control text-capitalize">
					        </div>
	        			</div>
	        			<div class="col-sm-6">
	        				<div class="form-group">
					        	<label for="locDomAlm">Localidad:</label>
					        	<input required="" type="text" id="locDomAlm" name="locDomAlm" class="form-control text-capitalize">
					        </div>
	        			</div>
	        		</div>
	        		<div class="row">
	        			<div class="col-sm-6">
	        				<div class="form-group">
					        	<label for="munDomAlm">Municipio:</label>
					        	<input required="" type="text" id="munDomAlm" name="munDomAlm" class="form-control text-capitalize">
					        </div>
	        			</div>
	        			<div class="col-sm-6">
	        				<div class="form-group">
					        	<label for="estDomAlm">Estado:</label>
					        	<input required="" type="text" id="estDomAlm" name="estDomAlm" class="form-control text-capitalize">
					        </div>
	        			</div>
	        		</div>
	        		<div class="row">
	        			<div class="col-sm-6">
	        				<div class="form-group">
					        	<label for="codPostDomAlm">Codigo postal:</label>
					        	<input required="" type="number" id="codPostDomAlm" name="codPostDomAlm" class="form-control">
					        </div>
	        			</div>
	        		</div>
	        		<div class="form-group">
	        			<span class="lead">Originario de</span>
	        		</div>
	        		<div class="row">
	        			<div class="col-sm-6">
	        				<div class="form-group">
					        	<label for="munOrgAlm">Municipio:</label>
					        	<input required="" type="text" id="munOrgAlm" name="munOrgAlm" class="form-control">
					        </div>
	        			</div>
	        			<div class="col-sm-6">
	        				<div class="form-group">
					        	<label for="estOrgAlm">Estado:</label>
					        	<input required="" type="text" id="estOrgAlm" name="estOrgAlm" class="form-control">
					        </div>
	        			</div>
	        		</div>
	        	</div>
	        	<div class="col-sm-1"></div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" id="btnCloseDatPer" class="btn btn-outline-danger btn-sm" data-dismiss="modal">
	        	<i class="fas fa-times-circle mr-2"></i>
	        	Cerrar
	        </button>
	        <button type="submit" class="btn btn-outline-primary btn-sm" id="btnGDatPer">
	        	<i class="fas fa-check-circle mr-2"></i>
	        	Guardar cambios
	        </button>
	        </form>
	      </div>
	    </div>
	  </div>
	</div>

	<script src="<?php echo SERVERURLALM; ?>alm/js/datPerAlm.js"></script>