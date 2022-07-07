<div class="modal fade bgModal" id="editMyGrp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	      	<h6 class="modal-title font-weight-bold mb-0 text-gray-700" id="exampleModalLabel"><i class="fas text-gray-300 fa-edit fa-lg mr-2"></i> Mi grupo </h6>
	        <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form class="row" method="POST" id="formEditMyGrp" name="formEditMyGrp" autocomplete="off">
	        	<div class="col-sm-1"></div>
	        	<div class="col-sm-10">
					<div class="form-group">
						<label class="lead">Cambiar grupo:</label>
						<select class="form-control" name="editGrpOpc" id="editGrpOpc">
							<option selected="" value="No">Selecciona</option>
							<?php 
							//	$dbc = Connect::getDB();
								$dbc = new Connect();
								$dbc = $dbc -> getDB();
								$stmt = $dbc -> prepare("SELECT det.id_detgrupo, doc.nombre_c_doc, grp.grupo_n, car.nombre_car, car.id_carrera FROM det_grupo det 
									INNER JOIN docentes doc ON doc.id_docente = det.id_docente
									INNER JOIN grupos grp ON grp.id_grupo = det.id_grupo
									INNER JOIN carreras car ON car.id_carrera = det.id_carrera
									WHERE car.id_carrera = :id_carrera && det.id_detgrupo != :id_detgrupo");
								$stmt -> bindParam("id_carrera", $datGrpAlm->id_carrera, PDO::PARAM_INT);
								$stmt -> bindParam("id_detgrupo", $datGrpAlm->id_detgrupo, PDO::PARAM_INT);
								// $stmt -> bindParam("grupo_n", $datGrpAlm->grupo_n, PDO::PARAM_STR);
								$stmt -> execute();
								while ($res = $stmt -> fetch(PDO::FETCH_OBJ)) {
							?>
							<option value="<?php echo $res->id_detgrupo; ?>">
								<?php echo "Grupo: ".$res->grupo_n.", Tutor: ".$res->nombre_c_doc;?>
							</option>
							<?php
								}
							?>
						</select>
					</div>
	        	</div>
	        	<div class="col-sm-1"></div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" id="btnCloseEditMyGrp" class="btn btn-outline-danger btn-sm" data-dismiss="modal">
	        	<i class="fas fa-times-circle mr-2"></i>
	        	Cerrar</button>
	        <button type="submit" class="btn btn-outline-primary btn-sm">
	        	<i class="fas fa-check-circle mr-2"></i>
	        	Guardar</button>
	        </form>
	      </div>
	    </div>
	  </div>
	</div>

	 <script src="<?php echo SERVERURLALM; ?>alm/js/grpAlm.js"></script>