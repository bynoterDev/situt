<?php 

	$keyDoc = $_SESSION['keyDoc'];
	$codigo = explode('/', $_GET['view']);
	$valHistAlm = $codigo[1];
	$valHistAlmDec = base64_decode($valHistAlm);
	$datDoce = $docente->userDocDet($keyDoc);
	$alm = $_SESSION["clvAlm"];
	$datAlm = $docente->datPerfAlm($alm);
	$datHist = $docente -> datHistAlm($valHistAlmDec);
	if ($datDoce) {
?>

<div class="container-fluid mt-4 animated fadeIn delay-1s">

	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">
		    <i class="fas fa-book mr-2 text-primary"></i>
			<b>Tutoría personalizada</b>
		</h1>
		<a data-toggle="modal" data-target="#almHist" class="d-none d-sm-inline-block btn btn-sm btn-primary text-white shadow-sm">
		   	<i class="fas fa-list fa-sm text-white-50 mr-2"></i> Historial 
		</a>
	</div>

	<div class="card shadow mb-4 ocult" id="contend">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">
          	<i class="fas fa-user-graduate mr-2"></i>
          	<a href="<?php echo SERVERURLDOC; ?>PerfAlm/<?php echo base64_encode($alm); ?>/">Alumno: <?php echo $datAlm->nombre_c_al; ?></a>,
          	<span class="ml-2">
          		<i class="fas fa-calendar mr-2"></i>
          		Fecha: <?php echo formatFech($datHist -> fecha_reg_obs); ?></span>
          </h6>
        </div>
        <div class="card-body">
        	<div class="text-center">
                <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 15rem;" src="<?php echo SERVERURL; ?>assets/img/pairprogramming.svg" alt="image profile">
            </div>
        	<h4 class="text-center mt-4 font-weight-bold">
				Prioridad de la tutoría :
				<?php 
					if ($datHist -> prioridad_tut == "Alta") {
						echo "<span class='text-white badge badge-pill font-weight-bold bg-danger text-capitalize'>
						".$datHist -> prioridad_tut."
						</span>";
					} else if ($datHist -> prioridad_tut == "Media") {
						echo "<span class='text-white badge badge-pill font-weight-bold bg-warning text-capitalize'>
						".$datHist -> prioridad_tut."
						</span>";
					} else if ($datHist -> prioridad_tut == "Baja") {
						echo "<span class='text-white badge badge-pill font-weight-bold bg-primary text-capitalize'>
						".$datHist -> prioridad_tut."
						</span>";
					}
				?>
			</h4>
			<div class="row mt-4">
				<div class="col-sm-6 mb-4 p-2">
					<div class="border-left-info rounded shadow p-3">
						<h5 class="text-center font-weight-bold">
							<i class="fas fa-book-open mr-2"></i>
							Razones 
						</h5>
						<hr>
						<p class="bg-white text-primary rounded mt-3">
							<?php echo $datHist -> razones_tut; ?>
						</p>
					</div>
				</div>
				<div class="col-sm-6 mb-4 p-2">
					<div class="border-left-info rounded shadow p-3">
						<h5 class="text-center font-weight-bold">
							<i class="fas fa-search mr-2"></i>
							Observaciones
						</h5>
						<hr>
						<p class="bg-white text-primary rounded mt-3">
							<?php 
								if ($datHist->observaciones_tut == "") {
									echo "Ninguna";
								} else {
									echo $datHist -> observaciones_tut;
								}
							?>
						</p>
					</div>
				</div>
			</div>
        </div>
    </div>

</div>

	<!--=================================================
	=            Ventana modal ver historial            =
	==================================================-->
	
	<div class="modal fade" id="almHist" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	      	<h5 class="modal-title h5 mb-0 text-gray-700" id="exampleModalLabel"><i class="fas text-gray-300 fa-list fa-lg mr-2"></i> Tutorias </h5>
	        <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
			<div class="row">
	          <div class="col-sm-12 table-responsive">
	          	<table width="700" class="table" id="tbListadoHistorial">
	          		<thead>
	          			<th>Cuatrimestre:</th>
	          			<th>Razones:</th>
	          			<th>Prioridad:</th>
	          			<th>Fecha registro:</th>
	          			<th>Acciones:</th>
	          		</thead>
	          		<tbody>
	          		</tbody>
	          		<tfoot>
	          			<th>Cuatrimestre:</th>
	          			<th>Razones:</th>
	          			<th>Prioridad:</th>
	          			<th>Fecha registro:</th>
	          			<th>Acciones:</th>
	          		</tfoot>
	          	</table>
	          </div>
	        </div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" id="btnCloseHist" class="btn btn-outline-danger" data-dismiss="modal">
	        	<i class="fas fa-times-circle mr-2"></i>
	        	Cerrar</button>
	        <button type="submit" class="btn btn-outline-primary">
	        	<i class="fas fa-check-circle mr-2"></i>
	        	Guardar</button>
	      </div>
	    </div>
	  </div>
	</div>
	
	<!--====  End of Ventana modal ver historial  ====-->

	<script src="<?php echo SERVERURLDOC; ?>doc/js/histAlm.js"></script>
<?php		
	} else {
		header("Location:".SERVERURLDOC."doc/Logout.php");
	}