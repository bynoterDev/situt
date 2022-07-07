<?php

session_start();

if ($_SESSION['keyDir'] == "" || $_SESSION['keyDir'] == null) {
	header("Location:../Index.php");
} else {
	include '../modelos/director.modelo.php';
	$director = new Director();
	$keyDir = $_SESSION['keyDir'];
	$datDirec = $director->userDirDet($keyDir);
	$car_Dir = $datDirec->id_carrera;
	if ($datDirec) {
?>

	<?php include 'header2.php'; ?>
	<br><br><br><br>
	<div class="container-fluid mt-4">
		<div class="row">
			<div class="col-md-4 col-lg-3">
				<!-- SobreMi -->
                <div class="container py-5">
                    <div class="card shDC">
                        <img class="card-img-top" src="../vistas/img/iceland.jpg" alt="Card image cap">

                        <div class="text-center margen-avatar">
                        	<?php
								if ($datDirec -> foto_perf_dir != "") {
							?>
								<img src="../moddir/perfilFot/<?php echo $datDirec->foto_perf_dir; ?>" class='rounded-circle' width='100px'>
							<?php
								} else {
							?>
								<img src='../vistas/img/usermal.png' class='rounded-circle' width='100px'>
							<?php
								}
							?>
                        </div>
                        <div class="card-body text-center">
                        <h6 class="card-title font-weight-bold">
                        	<?php echo $datDirec -> nombre_c_dir; ?>
                        </h6>
						<h6 class=" text-left mt-3">
							<i class="fas fa-envelope fa-lg icoIni"></i>
							<?php echo $datDirec -> correo_dir; ?>
						</h6>
						<h6 class=" text-left mt-3">
							<i class="fas fa-phone fa-lg icoIni"></i>
							<?php echo $datDirec -> telefono_dir; ?>
						</h6>
						<hr class="bg-info mt-4" style="height: 2px;">
						<h6 class="text-center text-info">
							<b>Director</b>
						</h6>
                        </div>
                    </div>
                </div><!-- SobreMi -->
                <div class="container">
                    <!-- Comentarios -->
                    <div class="card">
                        <div class="card-header text-center">
                            Frase Celebre
                        </div>
                        <div class="card-body">
                            <blockquote class="blockquote mb-0">
                            <p class="font-italic text-info">
                            	<b>"</b> Todo el mundo tiene talento, solo es cuestión de moverse hasta descubrirlo. <b>"</b>
                            </p>
                            <footer class="blockquote-footer"><cite title="Source Title">George Lucas</cite></footer>
                            </blockquote>
                        </div>
                    </div><!-- Comentarios -->
                </div>
			</div>
			<div class="col-md-8 col-lg-9">
				<div class="text-center bg-primary p-1" style="border-radius: 8px;">
					<h4 class="text-center text-white mt-3"> 
						<?php echo "Dirección de: ".$datDirec->nombre_car; ?>
					</h4>
				</div>
				<h5 class="text-center mt-4">
					<i class="fas text-info fa-plus icoIni fa-lg"></i>
					Registrar Grupo
				</h5>
				<form class="row" method="POST" id="formRegGrp" name="formRegGrp">
					<div class="col-sm-12 col-md-12 col-lg-3"></div>
					<div class="col-sm-12 col-md-12 col-lg-6">
						<hr style="height: 2px;" class="bg-info rounded">
						<div class="form-group">
							<input readonly="" type="hidden" class="form-control" value="<?php echo $datDirec->id_carrera; ?>" name="id_carrera">
						</div>
						<div class="form-group">
							<label for="grpDet">Grupo:</label>
							<select name="grpDet" id="grpDet" class="form-control">
								<option selected="" value="No">Selecciona</option>
								<?php 
									$sql = "SELECT * FROM grupos";
									$result = $conexion->query($sql);
									while ($res = $result->fetch_object()) {
										echo "<option value=".$res->id_grupo.">".$res->grupo_n."</option>";
									}
								?>
							</select>
						</div>
						<div class="form-group">
							<label for="docGrp">Docente:</label>
							<select class="form-control" id="docGrp" name="docGrp">
								<option selected="" value="No">Selecciona</option>
								<?php 
									$sql = "SELECT * FROM docentes";
									$result = $conexion->query($sql);
									while ($res = $result->fetch_object()) {
										echo "<option value=".$res->id_docente.">"
												.$res->nombre_c_doc.
											"</option>";
									}
								?>
							</select>
						</div>
						<div class="form-group">
							<label for="estGrp">Estado:</label>
							<select class="form-control" name="estGrp" id="estGrp">
								<option value="No">Selecciona</option>
								<option value="1" selected="">Activo</option>
								<option value="0">Inactivo</option>
							</select>
						</div>
						<div class="form-group text-center">
							<hr style="height: 2px;" class="bg-info rounded">
							<button type="submit" class="btn btn-outline-primary btn-md">
								<i class="fas fa-check-circle icoIni fa-lg"></i>
								Aceptar
							</button>
						</div>
					</div>
					<div class="col-sm-12 col-md-12 col-lg-3"></div>
				</form>
				<div class="row mt-4">
					<div class="col-sm-12">
						<h4 class="text-center">
							<i class="fas text-info fa-list icoIni fa-lg"></i>
							Listado Grupos
						</h4>
						<hr style="height: 2px;" class="bg-info rounded">
						<br>
					</div>
				</div>
				<div class="row text-center">
					<div class="col-sm-6">
						<button onclick="mostGrpAct(true), mostGrpDes(false)" id="listGrpAct" class="btn btn-outline-primary btn-md">
							<i class="fas fa-check icoIni"></i>
							Activos
						</button>
					</div>
					<div class="col-sm-6">
						<button onclick="mostGrpDes(true), mostGrpAct(false)" id="listGrpDes" class="btn btn-outline-danger btn-md">
							<i class="fas fa-times icoIni"></i>
							Inactivos
						</button>
					</div>
				</div>
				<div class="row mt-4">
					<div class="col-sm-12 table-responsive text-center ocult" id="tbListadoGruposAct">
						<div class="table-responsive">
							<table class="table bg-white table-hover table-bordered rounded" id="tbListadoGrpAct">
								<thead class="text-primary">
									<th>Grupo:</th>
									<th>Docente:</th>
									<th>Acciones:</th>
								</thead>
								<tbody class="text-dark"></tbody>
								<tfoot class="text-primary">
									<th>Grupo:</th>
									<th>Docente:</th>
									<th>Acciones:</th>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
				<div class="row mt-4">
					<div class="col-sm-12 table-responsive text-center ocult" id="tbListadoGruposDes">
						<div class="table-responsive">
							<table class="table bg-white table-hover table-bordered rounded" id="tbListadoGrpDes">
								<thead class="text-primary">
									<th>Grupo:</th>
									<th>Docente:</th>
									<th>Acciones:</th>
								</thead>
								<tbody class="text-dark"></tbody>
								<tfoot class="text-primary">
									<th>Grupo:</th>
									<th>Docente:</th>
									<th>Acciones:</th>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<div class="modal fade bgModal" id="editGrp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  	<div class="modal-dialog modal-dialog-centered" role="document">
	    	<div class="modal-content">
	      		<div class="modal-header">
	        		<h5 class="modal-title" id="exampleModalLabel"> <i class="fas fa-edit icoNav"></i> Editar grupo
	        			<span id="grpnam" class="badge badge-pill bg-success text-white" style="font-size: 20px; padding: 10px;">
	        				
	        			</span>
	        		</h5>
	        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          		<span aria-hidden="true">&times;</span>
	        		</button>
	      		</div>
		      	<div class="modal-body">
		       		<form class="row" name="formEditGrp" id="formEditGrp" method="POST">
		       			<div class="col-sm-1"></div>
		       			<div class="col-sm-10">
		       				<input type="hidden" class="form-control" id="id_detgrupo" name="id_detgrupo">
		       				<input type="hidden" class="form-control" id="id_grupo" name="id_grupo">
		       				<input type="hidden" class="form-control" id="id_docente" name="id_docente">
		       				<div class="form-group">
		       					<label>Tutor actual:</label>
		       					<input type="text" class="form-control text-uppercase" readonly="" id="tutAct">
		       				</div>
		       				<div class="form-group">
		       					<label for="tutGrpEdit">Nuevo tutor:</label>
								<select name="tutGrpEdit" id="tutGrpEdit" class="form-control">
									<option selected="" value="No">Selecciona</option>
									<?php 
										$sql = "SELECT * FROM docentes WHERE condicion_doc = 1";
										$result = $conexion->query($sql);
										$year = date("Y");
										while ($res = $result->fetch_object()) {
											echo "<option class='' value=".$res->id_docente.">
													".$res->nombre_c_doc."
												</option>";
										}
									?>
								</select>
		       				</div>
		       				<div class="form-group">
		       					<label for="passConf">Introduce tu contraseña para actualizar:</label>
		       					<input type="password" id="passConf" name="passConf" class="form-control">
		       				</div>
		       			</div>
		       			<div class="col-sm-1"></div>
		      	</div>
		      	<div class="modal-footer">
		        	<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
		        	<button type="submit" class="btn btn-success">Guardar cambios</button>
		        	</form>
		      	</div>
	    	</div>
	  	</div>
	</div>

	<br><br><br>
	<?php include 'modalsconf.php'; ?>

	<?php include 'footer2.php'; ?>
    <!--- Personalizados -->
    <script src="../vistas/modulos/dir/js/confDatContDir.js"></script>
    <script src="../vistas/modulos/dir/js/regGrupos.js"></script>
</body>
</html>
<?php		
	} else {
		header("Location:../vistas/modulos/dir/Logout.php");
	}
}

?>