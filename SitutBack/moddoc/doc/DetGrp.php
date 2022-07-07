<?php 

	$codigo = explode("/", $_GET['view']);
	$valObt = $codigo[1];
	$datDoce = $docente->userDocDet($keyDoc);
	$valObtDec = base64_decode($valObt);
	$_SESSION["clvGrp"] = $valObtDec;
	$datGrup = $docente -> datGrpSel($keyDoc, $valObtDec);
	$cantMaleGrp = $docente -> cantMaleAlmGrp($valObtDec, $keyDoc);
	$cantFemaGrp = $docente -> cantFemaleAlmGrp($valObtDec, $keyDoc);
	$cantBecMl = $docente -> cantMaleBecGrp($valObtDec, $keyDoc);
	$cantBecFm = $docente -> cantFemaleBecGrp($valObtDec, $keyDoc);

?>

	<style>
		.ocult {
			display: none;
		}
	</style>

	<!-- <div class="container">
		<div class="btn-group">
		  	<button class="btn bg-white text-primary cardShadow btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		    Justificantes <i id="bell" class="fas fa-bell icoPri"></i>
		    	<span class="ml-2 lead icoIni icoPri" id="cantNotsif"></span>
		  	</button>
		  	<div class="dropdown-menu" style="width: 500px;" aria-labelledby="dropdownMenuLink">
		  		<div class="container-fluid listNsot"></div>
			</div>
		</div>
		<div class="btn-group ml-3">
		  	<button class="btn text-primary bg-white cardShadow btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		    Tutorías <i id="bell2" class="fas fa-bell icoPri"></i>
		    	<span class="ml-2 lead icoIni icoPri" id="cantNotifTut"></span>
		  	</button>
		  	<div class="dropdown-menu" style="width: 500px;" aria-labelledby="dropdownMenuLink2">
		  		<div class="container-fluid listTut"></div>
			</div>
		</div>
	</div> -->


<div class="container-fluid mt-4 animated fadeIn">

	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">
		    <i class="fas fa-university mr-2 text-primary"></i>
			<b><?php echo "Carrera: ".$datGrup->nombre_car.", Grupo: ".$datGrup->grupo_n."."; ?></b>
		</h1>
		<a href="<?php echo SERVERURLDOC; ?>Home/" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
		   	<i class="fas fa-home fa-sm text-white-50 mr-2"></i> Inicio 
		</a>
	</div>
	<!--
	<div class="row">
		<div class="col-md-12 col-lg-12" id="loader">
			<div class="text-center mt-5">
				<div class="spinner-grow text-primary mb-3" role="status" style="width: 100px; height: 100px;">
				  <span class="sr-only">Loading...</span>
				</div>
				<b>
					<h3 class="text-primary font-weight-bold" id="textLoad">
						Cargando contenido...
					</h3>
				</b>	
			</div>
		</div>
	</div>-->

	<div class="ocult2
	 row" id="contend">
		<div class="col-xl-4 col-md-4 mb-4">
          <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Hombres</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">
                  	<span id="cantMale" class=""></span>
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-male fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-md-4 mb-4">
          <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Mujeres</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">
                  	<span id="cantFemale" class=""></span>
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-female fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-md-4 mb-4">
          <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">
                  	<span id="cantAllAlm" class=""></span>
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-users fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-md-4 mb-4">
          <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Hombres</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">
                  	<span id="cantMaleBec"></span>
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-money-check-alt fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-md-4 mb-4">
          <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Mujeres</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">
                  	<span id="cantFemaleBec"></span>
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-money-check-alt fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-md-4 mb-4">
          <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">
                  	<span id="cantAllBec"></span>
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-money-check-alt fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-6 col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-2 hovAnim">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Registrar alumno</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">
                  	<button data-backdrop="false" data-toggle="modal" data-target="#regAlm" class="btn cardShadow btn-outline-primary mt-3  btn-sm" type="button">
						<i class="fas fa-plus mr-2"></i>
						Presiona aquí...
					</button>
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-user-plus fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-6 col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-2 hovAnim">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Mis alumnos</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">
                  	<button data-backdrop="false" data-toggle="modal" data-target="#listAlm" class="btn cardShadow btn-outline-primary  btn-sm mt-3" type="button">
						<i class="fas fa-eye mr-2"></i>
						Ver alumnos
					</button>
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-list fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-6 col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-2 hovAnim">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Aceptar Alumnos</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">
                  	<button data-backdrop="false" data-toggle="modal" data-target="#listAlmAcept" class="btn btn-outline-primary cardShadow btn-sm mt-3" type="button">
						<i class="fas fa-check mr-2" id="icoAcept"></i>
						<span id="cantAlmRech" class="icoIni icoPri"></span>
						Alumnos
					</button>
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-user-check fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-6 col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-2 hovAnim">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Alumnos becados</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">
                  	<button data-backdrop="false" data-toggle="modal" data-target="#becAlm" class="btn cardShadow btn-outline-primary  btn-sm mt-3" type="button">
						<i class="fas fa-eye mr-2"></i>
						Ver Becados
					</button>
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-money-check-alt fa-2x text-gray-300"></i>
                </div>
              </div>
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
	      	<h5 class="modal-title h5 mb-0 text-gray-700" id="exampleModalLabel"><i class="fas text-gray-300 fa-plus fa-lg mr-2"></i> Registrar alumno</h5>
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
	        <button type="button" id="btnCloseRegAl" class="btn btn-outline-danger btn-sm" data-dismiss="modal">
	        	<i class="fas fa-times-circle mr-2"></i>
	        	Cerrar</button>
	        <button type="submit" class="btn btn-outline-primary btn-sm" id="btnGRegAlm">
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
	      	<h5 class="modal-title h5 mb-0 text-gray-700" id="exampleModalLabel"><i class="fas text-gray-300 fa-list fa-lg mr-2"></i> Listado de alumnos</h5>
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
	        <button type="button" id="btnCloseAlmList" class="btn btn-outline-danger btn-sm" data-dismiss="modal">
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
	      	<h5 class="modal-title h5 mb-0 text-gray-700" id="exampleModalLabel"><i class="fas text-gray-300 fa-user-check fa-lg icoIni mr-2"></i> Aceptar alumnos </h5>
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
	        <button type="button" id="btnCloseAlmAcept" class="btn btn-outline-danger btn-sm" data-dismiss="modal">
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
	      	<h5 class="modal-title h5 mb-0 text-gray-700" id="exampleModalLabel"><i class="fas text-gray-300 fa-money-check-alt fa-lg icoIni mr-2"></i> Alumnos becados </h5>
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
	        <button type="button" id="btnCloseBecAlm" class="btn btn-outline-danger btn-sm" data-dismiss="modal">
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
	      	<h5 class="modal-title h5 mb-0 text-gray-700" id="exampleModalLabel"><i class="fas text-gray-300 fa-edit fa-lg icoIni mr-2"></i> Editar datos </h5>
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
	        <button type="button" id="btnCloseEditBec" class="btn btn-outline-danger btn-sm" data-dismiss="modal">
	        	<i class="fas fa-times-circle mr-2"></i>
	        	Cerrar</button>
	        <button type="submit" class="btn btn-outline-primary btn-sm" id="btnEditBec">
				<i class="fas fa-check-circle mr-2"></i>
	        	Guardar</button>
	        </form>
	      </div>
	    </div>
	  </div>
	</div>
	
	<!--====  End of Ventana modal Editar beca  ====-->

    <script src="<?php echo SERVERURLDOC; ?>doc/js/detGrp.js"></script>
	<!-- <script src="<?php echo SERVERURLDOC; ?>doc/js/notifGrp.js"></script> -->
