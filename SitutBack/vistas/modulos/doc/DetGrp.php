<?php 

ob_start();
session_start();

if ($_SESSION['keyDoc'] == "" || $_SESSION['keyDoc'] == null) {
	header("Location:../Index.php");
} else {
	include '../modelos/docente.modelo.php';
	$docente = new Docentes();
	$keyDoc = $_SESSION['keyDoc'];
	$valObt = $_GET['v'];
	$datDoce = $docente->userDocDet($keyDoc);
	if ($datDoce) {
		$valObtDec = base64_decode($valObt);
		$_SESSION["clvGrp"] = $valObtDec;
		$datGrup = $docente -> datGrpSel($keyDoc, $valObtDec);
		$cantMaleGrp = $docente -> cantMaleAlmGrp($valObtDec, $keyDoc);
		$cantFemaGrp = $docente -> cantFemaleAlmGrp($valObtDec, $keyDoc);
		$cantBecMl = $docente -> cantMaleBecGrp($valObtDec, $keyDoc);
		$cantBecFm = $docente -> cantFemaleBecGrp($valObtDec, $keyDoc);
?>
	
	<?php include 'header2.php'; ?>
	<style type="text/css">
		.ocult { display: none; }
	</style>
	<br><br><br><br>

	<div class="container-fluid">
		<div class="row ocult" id="loader1">
			<div class="col-sm-12 col-lg-6 text-center">
				<div class="btn-group">
				  	<button class="btn bg-white text-primary cardShadow btn-md dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				    Justificantes <i id="bell" class="fas fa-bell icoPri"></i>
				    	<span class="ml-2 lead icoIni icoPri" id="cantNotif"></span>
				  	</button>
				  	<div class="dropdown-menu" style="width: 500px;" aria-labelledby="dropdownMenuLink">
				  		<div class="container-fluid listNot"></div>
					</div>
				</div>
				<div class="btn-group">
				  	<button class="btn text-primary bg-white cardShadow btn-md dropdown-toggle" href="#" role="button" id="dropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				    Tutorías <i id="bell2" class="fas fa-bell icoPri"></i>
				    	<span class="ml-2 lead icoIni icoPri" id="cantNotifTut"></span>
				  	</button>
				  	<div class="dropdown-menu" style="width: 500px;" aria-labelledby="dropdownMenuLink2">
				  		<div class="container-fluid listTut"></div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="container-fluid mt-4">
		<div class="row">
			<div class="col-md-4 col-lg-3">
				<!-- SobreMi -->
                <div class="container py-5">
                    <div class="card shDC">
                        <img class="card-img-top" src="../vistas/img/iceland.jpg" alt="Card image cap">

                        <div class="text-center margen-avatar">
                        	<?php 
								if ($datDoce -> foto_perf_doc != "") {
							?>
								<div class="text-center">
									<img src="perfilFot/<?php echo $datDoce->foto_perf_doc; ?>" class="rounded-circle" width="100px" >
								</div>
								<hr style="height: 2px;" class="bg-success rounded">
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
                        	<?php echo $datDoce->nombre_c_doc; ?>
                        </h6>
                        <h6 class="text-left mt-3">
                        	<i class="fas fa-certificate fa-lg icoIni"></i>
                        	<?php echo $datDoce->especialidad_doc; ?>
                        </h6>
						<h6 class=" text-left mt-3 text-truncate" title="<?php echo $datDoce->correo_doc; ?>">
							<i class="fas fa-envelope fa-lg icoIni"></i>
							<?php echo $datDoce -> correo_doc; ?>
						</h6>
						<h6 class=" text-left mt-3">
							<i class="fas fa-phone fa-lg icoIni"></i>
							<?php echo $datDoce -> telefono_doc; ?>
						</h6>
						<hr class="bg-info mt-4" style="height: 2px;">
						<h6 class="text-center text-info">
							<b>Docente</b>
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
			<div class="col-md-8 col-lg-9" id="loader">
				<div class="text-center mt-5">
					<img src="../vistas/img/load2.gif" width="200" alt="">
					<h1 class="text-info" id="textLoad">
						Cargando contenido... <b>Grupo: <?php echo $datGrup->grupo_n; ?></b>
						<b class="text-truncate"><?php echo $datGrup->nombre_car; ?></b>
					</h1>
				</div>
			</div>
			<div class="col-md-8 col-lg-9 ocult" id="contend">
				<div class="text-center bg-primary p-1" style="border-radius: 8px;">
					<h4 class="text-center text-white mt-3"> 
						<?php echo "Carrera: ".$datGrup->nombre_car.", Grupo: ".$datGrup->grupo_n."."; ?>
					</h4>
				</div>
				<br>
				<div class="row mt-5">
					<div class="col-sm-12 col-lg-4 text-center border-right border-info">
						<h6 class="bg-white pad10 rounded cardShadow">
							<i class="fas fa-male icoIni fa-lg text-info"></i>
							<span id="cantMale"></span>
							<br>
							<hr style="height: 2px;" class="bg-info rounded">
							<i class="fas fa-money-bill-wave icoIni fa-lg text-info"></i>
							<span id="cantMaleBec"></span>
						</h6>
					</div>
					<div class="col-sm-12 col-lg-4 text-center">
						<h6 class="bg-white pad10 rounded cardShadow">
							<i class="fas fa-female icoIni fa-lg text-info"></i>
							<span id="cantFemale"></span>
							<br>
							<hr style="height: 2px;" class="bg-info rounded">
							<i class="fas fa-money-bill-wave icoIni fa-lg text-info"></i>
							<span id="cantFemaleBec"></span>
						</h6>
					</div>
					<div class="col-sm-12 col-lg-4 text-center border-left border-info">
						<h6 class="bg-white pad10 rounded cardShadow">
							<i class="fas fa-users icoIni fa-lg text-info"></i>
							<span id="cantAllAlm"></span>
							<br>
							<hr style="height: 2px;" class="bg-info rounded">
							<i class="fas fa-money-bill icoIni fa-lg text-info"></i>
							<span id="cantAllBec"></span>
						</h6>
					</div>
				</div>
				<br>
				<div class="row text-center mt-5">
					<div class="col-sm-6 border-right border-info">
						<button data-backdrop="false" data-toggle="modal" data-target="#regAlm" class="btn cardShadow btn-outline-primary  btn-md" type="button">
							<i class="fas fa-plus icoIni"></i>
							Registrar Alumno
						</button>

					</div>
					<div class="col-sm-6">
						<button data-backdrop="false" data-toggle="modal" data-target="#listAlm" class="btn cardShadow btn-outline-primary  btn-md" type="button">
							<i class="fas fa-list icoIni"></i>
							Mis Alumnos
						</button>
						<br><br>
					</div>
					<div class="col-sm-6 border-right border-info">
						<button data-backdrop="false" data-toggle="modal" data-target="#listAlmAcept" class="btn btn-outline-primary cardShadow btn-md" type="button">
							<i class="fas fa-check icoIni" id="icoAcept"></i>
							<span id="cantAlmRech" class="icoIni icoPri"></span>
							Aceptar Alumnos
						</button>
					</div>
					<div class="col-sm-6">
						<button data-backdrop="false" data-toggle="modal" data-target="#becAlm" class="btn cardShadow btn-outline-primary  btn-md" type="button">
							<i class="fas fa-money-check-alt icoIni"></i>
							Ver Becados
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!--====================================================
	=            Ventana modal registrar alumno            =
	=====================================================-->
	
	<div class="modal fade bgModal" id="regAlm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title text-info" id="exampleModalLabel"><i class="fas fa-plus fa-lg icoIni"></i> Registrar Alumno</h5>
	        <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form class="row" method="POST" id="formRegAlGrp" name="formRegAlGrp">
	          	<div class="col-sm-1"></div>
				<div class="col-sm-10">
					<div class="form-group">
						<label for="nomAl">Nombre completo:</label>
						<input type="text" id="nomAl" name="nomAl" class="form-control text-capitalize">
					</div>
					<div class="form-group">
						<label for="corAl">Correo electronico:</label>
						<input type="email" id="corAl" name="corAl" class="form-control">
						<div style="font-size: 16px;" id="textcorr" class="text-center"></div>
					</div>
					<div class="row">
						<div class="form-group col-sm-6">
							<label for="contAl">Contraseña:</label>
							<input type="password" id="contAl" name="contAl" class="form-control">
							<label id="mensaje" class="ocult"></label>
						</div>
						<div class="form-group col-sm-6">
							<label for="repContAl">Repetir Contraseña:</label>
							<input type="password" id="repContAl" name="repContAl" class="form-control">
							<label id="mensaje2" class="ocult"></label>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-6">
							<label for="matAl">Matricula:</label>
							<input type="text" id="matAl" name="matAl" class="form-control text-uppercase">
						</div>
						<div class="form-group col-sm-6">
							<label for="telAl">Telefono:</label>
							<input type="tel" id="telAl" name="telAl" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label for="sexAl">Sexo:</label>
						<select class="form-control" id="sexAl" name="sexAl">
							<option selected="" value="0">Selecciona</option>
							<option value="Masculino">Masculino</option>
							<option value="Femenino">Femenino</option>
						</select>
					</div>
					<div class="row">
						<div class="form-group col-sm-6">
							<label for="estAl">Estado alumno:</label>
							<select class="form-control" id="estAl" name="estAl">
								<option value="No">Selecciona</option>
								<option value="1" selected="">Activo</option>
								<option value="0">Inactivo</option>
							</select>
						</div>
						<div class="form-group col-sm-6">
							<label for="aceptGrp">En el grupo:</label>
							<select class="form-control" id="aceptGrp" name="aceptGrp">
								<option value="No">Selecciona</option>
								<option value="1" selected="">Aceptado</option>
								<option value="0">Rechazado</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label>Grupo a registrar:</label>
						<input type="hidden" value="<?php echo $datGrup->id_detgrupo; ?>" name="idgrp" class="form-control">
						<select class="form-control disabled">
							<option selected="" disabled=""><?php echo $datGrup->grupo_n.", ".$datGrup->nombre_car; ?></option>
						</select>
					</div>
				</div>
	          	<div class="col-sm-1"></div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" id="btnCloseRegAl" class="btn btn-outline-danger" data-dismiss="modal">
	        	<i class="fas fa-times-circle mr-2"></i>
	        	Cerrar</button>
	        <button type="submit" class="btn btn-outline-primary" id="btnGRegAlm">
	        	<i class="fas fa-check-circle mr-2"></i>
	        	Guardar</button>
	        </form>
	      </div>
	    </div>
	  </div>
	</div>
	
	<!--====  End of Ventana modal registrar alumno  ====-->
	
	<!--===========================================
	=            Ventana modal alumnos            =
	============================================-->
	
	<div class="modal fade bgModal" id="listAlm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title text-info" id="exampleModalLabel"><i class="fas fa-list fa-lg icoIni"></i>Listado alumnos</h5>
	        <button type="button" id="closeIconListAlm" class="close text-danger" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <div class="row">
	          <div class="col-sm-12 table-responsive">
	          	<table width="700" class="table" id="tbListadoAlumnos">
	          		<thead>
	          			<th>Nombre:</th>
	          			<th>Matricula:</th>
	          			<th>Acciones:</th>
	          			<th>Becado:</th>
	          		</thead>
	          		<tbody>
	          		</tbody>
	          		<tfoot>
	          			<th>Nombre:</th>
	          			<th>Matricula:</th>
	          			<th>Acciones:</th>
	          			<th>Becado:</th>
	          		</tfoot>
	          	</table>
	          </div>
	        </div>  
	      </div>
	      <div class="modal-footer">
	        <button type="button" id="btnCloseAlmList" class="btn btn-outline-danger" data-dismiss="modal">
	        	<i class="fas fa-times-circle mr-2"></i>
	        	Cerrar</button>
	      </div>
	    </div>
	  </div>
	</div>
	
	<!--====  End of Ventana modal alumnos  ====-->
	
	<!--===================================================
	=            Ventana modal aceptar alumnos            =
	====================================================-->
	
	<div class="modal fade bgModal" id="listAlmAcept" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title text-info" id="exampleModalLabel"><i class="fas fa-list fa-lg icoIni"></i>Aceptar alumnos</h5>
	        <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <div class="row">
	          <div class="col-sm-12 table-responsive">
	          	<table width="700" class="table" id="tbListadoAlumnosAcept">
	          		<thead>
	          			<th>Foto:</th>
	          			<th>Nombre:</th>
	          			<th>Matricula:</th>
	          			<th>Acciones:</th>
	          		</thead>
	          		<tbody>
	          		</tbody>
	          		<tfoot>
	          			<th>Foto:</th>
	          			<th>Nombre:</th>
	          			<th>Matricula:</th>
	          			<th>Acciones:</th>
	          		</tfoot>
	          	</table>
	          </div>
	        </div>  
	      </div>
	      <div class="modal-footer">
	        <button type="button" id="btnCloseAlmAcept" class="btn btn-outline-danger" data-dismiss="modal">
	        	<i class="fas fa-times-circle mr-2"></i>
	        	Cerrar</button>
	      </div>
	    </div>
	  </div>
	</div>
	
	<!--====  End of Ventana modal aceptar alumnos  ====-->
	
	<!--===========================================
	=            Ventana modal becados            =
	============================================-->
	
	<div class="modal fade bgModal" id="becAlm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title text-info" id="exampleModalLabel"><i class="fas fa-list fa-lg icoIni"></i>Alumnos Becados</h5>
	        <button type="button" id="closeIconAlmBec" class="close text-danger" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <div class="row">
	          <div class="col-sm-12 table-responsive">
	          	<table width="700" class="table" id="tbListadoBecadosAlm">
	          		<thead>
	          			<th>Nombre:</th>
	          			<th>Matricula:</th>
	          			<th>Beca:</th>
	          			<th>Acciones:</th>
	          		</thead>
	          		<tbody>
	          		</tbody>
	          		<tfoot>
	          			<th>Nombre:</th>
	          			<th>Matricula:</th>
	          			<th>Beca:</th>
	          			<th>Acciones:</th>
	          		</tfoot>
	          	</table>
	          </div>
	        </div>  
	      </div>
	      <div class="modal-footer">
	        <button type="button" id="btnCloseBecAlm" class="btn btn-outline-danger" data-dismiss="modal">
	        	<i class="fas fa-times-circle mr-2"></i>
	        	Cerrar</button>
	      </div>
	    </div>
	  </div>
	</div>
	
	<!--====  End of Ventana modal becados  ====-->
	
	<!--===============================================
	=            Ventana modal Editar beca            =
	================================================-->
	
	<div class="modal fade bgModal" id="editBec" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title text-info" id="exampleModalLabel"><i class="fas fa-edit fa-lg icoIni"></i> Editar datos</h5>
	        <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form class="row" method="POST" id="formEditBec" name="formEditBec">
	          	<div class="col-sm-2"></div>
				<div class="col-sm-8">
					<div class="form-group">
						<input type="hidden" readonly="" name="id_becadoalm" id="id_becadoalm" class="form-control">
						<label for="almBec">Alumno:</label>
						<input type="text" id="almBec" readonly="" class="form-control">
					</div>
					<div class="form-group">
						<label for="tipBeca2">Beca actual:</label>
						<input type="text" readonly="" id="tipBeca2" class="form-control">
					</div>
					<div class="form-group">
						<label for="tipBeca">Nueva beca</label>
						<select id="tipBeca" name="tipBeca" class="form-control">
							<option selected="" value="0">Selecciona</option>
							<?php 
								$dbc = new Connect();
								$dbc = $dbc -> getDB();
								$stmt = $dbc -> prepare("SELECT * FROM becas_alm");
								$stmt -> execute();
								while ($res = $stmt -> fetch(PDO::FETCH_OBJ)) {
									echo "<option value=".$res->beca_nombre.">".$res->beca_nombre."</option>";
								}
								$dbc = null; $stmt = null;
							?>
						</select>
					</div>
				</div>
	          	<div class="col-sm-2"></div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" id="btnCloseEditBec" class="btn btn-outline-danger" data-dismiss="modal">
	        	<i class="fas fa-times-circle mr-2"></i>
	        	Cerrar</button>
	        <button type="submit" class="btn btn-outline-primary" id="btnEditBec">
				<i class="fas fa-check-circle mr-2"></i>
	        	Guardar</button>
	        </form>
	      </div>
	    </div>
	  </div>
	</div>
	
	<!--====  End of Ventana modal Editar beca  ====-->
	

	<br><br><br>
	<?php include 'modalsconf.php'; ?>

	<script src="../vistas/js/jquery-3.1.1.min.js"></script>
	<!-- SweetAlert -->
    <script src="../vistas/node_modules/sweetalert/dist/sweetalert.min.js"></script>
    <script src="../vistas/datatables/jquery.dataTables.min.js"></script>    
    <script src="../vistas/datatables/dataTables.buttons.min.js"></script>
    <script src="../vistas/datatables/buttons.html5.min.js"></script>
    <script src="../vistas/datatables/buttons.colVis.min.js"></script>
    <script src="../vistas/datatables/jszip.min.js"></script>
    <script src="../vistas/datatables/pdfmake.min.js"></script>
    <script src="../vistas/datatables/vfs_fonts.js"></script> 
    <!-- Bootstrap -->
    <script src="../vistas/Assets/js/vendor/popper.min.js"></script>
    <script src="../vistas/Js/bootstrap.min.js"></script>
    <script src="../vistas/assets/js/vendor/holder.min.js"></script>
    <!--- Personalizados -->
    <script src="../vistas/modulos/doc/js/confDatDoc.js"></script>
    <script src="../vistas/modulos/doc/js/detGrp.js"></script>
	<script src="../vistas/modulos/doc/js/notifGrp.js"></script>
	<?php include 'footer2.php'; ?>

<?php		
	} else {
		header("Location:Logout.php");
	}
}

ob_end_flush();
?>