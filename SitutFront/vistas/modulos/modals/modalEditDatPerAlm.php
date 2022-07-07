<div class="modal fade bgModal" id="datPerAlmEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title text-info" id="exampleModalLabel"><i class="fas fa-edit fa-lg icoIni"></i>Editar datos personales</h5>
	        <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form class="row" method="POST" id="formEditDarPer" name="formEditDarPer" autocomplete="off">
	        	<div class="col-sm-1"></div>
	        	<div class="col-sm-10">
	        		<div class="form-group">
	        			<label for="curpDatEdit">Curp:</label>
	        			<input type="text" id="curpDatEdit" value="<?php echo $datEPer->curp_dat; ?>" onchange="validarInput(this)" name="curpDatEdit" class="form-control">
	        		</div>
	        		<div class="row">
	        			<div class="col-sm-6">
	        				<div class="form-group">
			        			<label for="fechNacEdit">Fecha de nacimiento:</label>
			        			<input required="" value="<?php echo $datEPer->fecha_nac_dat; ?>" type="date" id="fechNacEdit" name="fechNacEdit" class="form-control">
			        		</div>
	        			</div>
	        			<div class="col-sm-6">
	        				<div class="form-group">
			        			<label for="eddAlmEdit">Edad:</label>
			        			<input required="" type="number" id="eddAlmEdit" value="<?php echo $datEPer->edad_dat; ?>" name="eddAlmEdit" class="form-control">
			        		</div>
	        			</div>
	        		</div>
	        		<div class="row">
	        			<div class="col-sm-6">
	        				<div class="form-group">
			        			<label for="estCivEdit">Estado civil: <mark><?php echo $datEPer->estado_civil_dat; ?></mark></label>
			        			<select type="date" id="estCivEdit" name="estCivEdit"  class="form-control">
									<option selected="" value="0">Seleccionar nuevo</option>
									<option value="Casado">Casado</option>
									<option value="Divorciado">Divorciado</option>
									<option value="Viudo">Viudo</option>
									<option value="Soltero">Soltero</option>
			        			</select>
			        		</div>
	        			</div>
	        			<div class="col-sm-6">
	        				<div class="form-group">
					        	<label for="faceAlmEdit">Facebook:</label>
					        	<input required="" type="text" value="<?php echo $datEPer->facebook_alm_dat; ?>" id="faceAlmEdit" name="faceAlmEdit" class="form-control">
					        </div>
	        			</div>
	        		</div>
	        		<div class="row">
	        			<div class="col-sm-6">
	        				<div class="form-group">
			        			<label for="tipSegSocialEdit">Tipo de seguridad social:</label>
			        			<input type="text" id="tipSegSocialEdit" value="<?php echo $datEPer->tipo_segsocial_dat; ?>" name="tipSegSocialEdit" class="form-control">
			        		</div>
	        			</div>
	        			<div class="col-sm-6">
	        				<div class="form-group">
			        			<label for="numSegSocialEdit">No. de seguridad social:</label>
			        			<input type="number" id="numSegSocialEdit" value="<?php echo $datEPer->num_segsocial_dat; ?>" name="numSegSocialEdit" class="form-control">
			        		</div>
	        			</div>
	        		</div>
	        		<div class="row">
	        			<div class="col-sm-6">
	        				<div class="form-group">
			        			<label for="telCasEdit">Telefono casa:</label>
			        			<input type="tel" id="telCasEdit" value="<?php echo $datEPer->telefono_casa_dat; ?>" name="telCasEdit" class="form-control">
			        		</div>
	        			</div>
	        			<div class="col-sm-6">
	        				<div class="form-group">
			        			<label for="telRecEdit">Telefono recado:</label>
			        			<input type="tel" id="telRecEdit" value="<?php echo $datEPer->telefono_rec_dat; ?>" name="telRecEdit" class="form-control">
			        		</div>
	        			</div>
	        		</div>
	        		<div class="form-group">
	        			<span class="lead">Domicilio actual</span>
	        		</div>
	        		<div class="row">
	        			<div class="col-sm-6">
	        				<div class="form-group">
					        	<label for="callDomAlmEdit">Calle:</label>
					        	<input required="" value="<?php echo $datEPer->calle_dat_act; ?>" type="text" id="callDomAlmEdit" name="callDomAlmEdit" class="form-control">
					        </div>
	        			</div>
	        			<div class="col-sm-6">
	        				<div class="form-group">
					        	<label for="numDomAlmEdit">Numero:</label>
					        	<input type="text" id="numDomAlmEdit" value="<?php echo $datEPer->num_casa_dat_act; ?>" name="numDomAlmEdit" class="form-control">
					        </div>
	        			</div>
	        		</div>
	        		<div class="row">
	        			<div class="col-sm-6">
	        				<div class="form-group">
					        	<label for="colDomAlmEdit">Colonia:</label>
					        	<input required="" type="text" value="<?php echo $datEPer->colonia_dat_act; ?>" id="colDomAlmEdit" name="colDomAlmEdit" class="form-control">
					        </div>
	        			</div>
	        			<div class="col-sm-6">
	        				<div class="form-group">
					        	<label for="locDomAlmEdit">Localidad:</label>
					        	<input required="" type="text" value="<?php echo $datEPer->localidad_dat_act; ?>" id="locDomAlmEdit" name="locDomAlmEdit" class="form-control">
					        </div>
	        			</div>
	        		</div>
	        		<div class="row">
	        			<div class="col-sm-6">
	        				<div class="form-group">
					        	<label for="munDomAlmEdit">Municipio:</label>
					        	<input required="" type="text" id="munDomAlmEdit" value="<?php echo $datEPer->municipio_dat_act; ?>" name="munDomAlmEdit" class="form-control">
					        </div>
	        			</div>
	        			<div class="col-sm-6">
	        				<div class="form-group">
					        	<label for="estDomAlmEdit">Estado:</label>
					        	<input required="" type="text" value="<?php echo $datEPer->estado_dat_act; ?>" id="estDomAlmEdit" name="estDomAlmEdit" class="form-control">
					        </div>
	        			</div>
	        		</div>
	        		<div class="row">
	        			<div class="col-sm-6">
	        				<div class="form-group">
					        	<label for="codPostDomAlmEdit">Codigo postal:</label>
					        	<input required="" type="text" value="<?php echo $datEPer->codpostal_dat_act; ?>" id="codPostDomAlmEdit" name="codPostDomAlmEdit" class="form-control">
					        </div>
	        			</div>
	        		</div>
	        		<div class="form-group">
	        			<span class="lead">Originario de</span>
	        		</div>
	        		<div class="row">
	        			<div class="col-sm-6">
	        				<div class="form-group">
					        	<label for="munOrgAlmEdit">Municipio:</label>
					        	<input required="" type="text" value="<?php echo $datEPer->municipio_dat_org; ?>" id="munOrgAlmEdit" name="munOrgAlmEdit" class="form-control">
					        </div>
	        			</div>
	        			<div class="col-sm-6">
	        				<div class="form-group">
					        	<label for="estOrgAlmEdit">Estado:</label>
					        	<input required="" type="text" value="<?php echo $datEPer->estado_dat_org; ?>" id="estOrgAlmEdit" name="estOrgAlmEdit" class="form-control">
					        </div>
	        			</div>
	        		</div>
	        	</div>
	        	<div class="col-sm-1"></div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" id="btnCloseDatPerEdit" class="btn btn-outline-danger" data-dismiss="modal">
	        	<i class="fas fa-times-circle mr-2"></i>
	        	Cerrar</button>
	        <button type="submit" class="btn btn-outline-primary" id="btnGDatPerEdit">
	        	<i class="fas fa-check-circle"></i>
	        	Guardar</button>
	        </form>
	      </div>
	    </div>
	  </div>
	</div>