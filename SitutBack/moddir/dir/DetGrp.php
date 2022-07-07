<?php 


	$datDirec = $director->userDirDet($keyDir);
	$codigo = explode("/", $_GET['view']);
	
	$valGrp = $codigo[1];
	$grpClv = base64_decode($valGrp);
	
	$car_Dir = $datDirec->id_carrera;
	$valCarGrp = $director -> valCarGrp($grpClv, $car_Dir);
	if ($valCarGrp -> CantVal == 1) {
		$datGrp = $director -> datGrpSel($grpClv);
		$cantAlm = $director -> cantAlmGrp($grpClv);
?>

<div class="container-fluid mt-4 animated fadeIn delay-1s">

	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">
		    <i class="fas fa-user mr-2 text-primary"></i>
			<b><?php echo "Dirección de: ".$datDirec->nombre_car; ?>.</b>
		</h1>
		<a href="<?php echo SERVERURLDIR; ?>RegGrupos/" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
		   	<i class="fas fa-arrow-left fa-sm text-white-50 mr-2"></i> Regresar 
		</a>
	</div>

	<div class="row">
		
		<div class="col-xl-4 col-md-6 mb-4">
          <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Grupo</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">
                  	<?php echo $datGrp->grupo_n; ?>.
					  
					 
					  
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-users fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
          <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Alumnos</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">
                  	<?php echo $cantAlm->CantAlm; ?> registros.
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-user fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
          <a href="<?php echo SERVERURLDIR; ?>PerfDoc/<?php echo base64_encode($datGrp->id_docente); ?>/">
          	<div class="card border-left-info shadow h-100 py-2 hovAnim">
	            <div class="card-body">
	              <div class="row no-gutters align-items-center">
	                <div class="col mr-2">
	                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tutor</div>
	                  <div class="h5 mb-0 font-weight-bold text-gray-800">
	                  	<?php echo $datGrp -> nombre_c_doc; ?>.
	                  </div>
	                </div>
	                <div class="col-auto">
	                  <i class="fas fa-user-tie fa-2x text-gray-300"></i>
	                </div>
	              </div>
	            </div>
	          </div>
          </a>
        </div>

	</div>

	<div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">
              	Alumnos en el grupo
              </h6>
            </div>
            <div class="card-body">
              <div class="row">
              	<div class="col-sm-12 mt-4">
              		<div class="table-responsive">
		                <table class="table table-bordered table-hover" id="tableAlm" width="100%" cellspacing="0">
		                  <thead>
		                    <tr>
		                      	<th>Nombre:</th>
								<th>Accion:</th>
		                    </tr>
		                  </thead>
		                  <tbody class="text-dark">
							<?php 
								$dbc = new Connect();
								$dbc = $dbc -> getDB();
								$valid = 1;
								$stmt = $dbc -> prepare("SELECT * FROM alumnos alm 
								INNER JOIN det_grupo det ON det.id_detgrupo = alm.id_detgrupo
								INNER JOIN carreras car ON car.id_carrera = det.id_carrera
								WHERE alm.acept_grp = :valid && alm.estado_al = :valid && det.id_detgrupo = :grpClv && car.id_carrera = :car_Dir");
								$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
								$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
								$stmt -> bindParam("grpClv", $grpClv, PDO::PARAM_INT);
								$stmt -> bindParam("car_Dir", $car_Dir, PDO::PARAM_INT);
								$stmt -> execute();
								while ($res = $stmt -> fetch(PDO::FETCH_OBJ)) {
							?>
								<tr>
									<td><?php echo $res->nombre_c_al; ?></td>
									<td>
										<a class="btn btn-outline-primary btn-sm" href="<?php echo SERVERURLDIR; ?>PerfAlm/<?php echo base64_encode($res->id_alumno); ?>/">
											<i class="fas fa-eye mr-2"></i>
											Perfil
										</a>
									</td>
								</tr>
							<?php
								}
								$dbc = null; $stmt = null;
							?>
						  </tbody>
		                  <tfoot>
		                    <tr>
		                     	<th>Nombre:</th>
								<th>Accion:</th>
		                    </tr>
		                  </tfoot>
		                </table>
		            </div>
	            </div>
              </div>
            </div>
    </div>

</div>

    <script src="<?php echo SERVERURLDIR; ?>dir/js/almInact.js"></script>
    <script type="text/javascript">
		$(document).ready(function(){
			const lenguaje = {
			    "sProcessing":     "Procesando...",
			    "sLengthMenu":     "Mostrar _MENU_ registros",
			    "sZeroRecords":    "No se encontraron resultados",
			    "sEmptyTable":     "Ningún dato disponible en esta tabla",
			    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
			    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
			    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			    "sInfoPostFix":    "",
			    "sSearch":         "Buscar:",
			    "sUrl":            "",
			    "sInfoThousands":  ",",
			    "sLoadingRecords": "Cargando...",
			    "oPaginate": {
			        "sFirst":    "Primero",
			        "sLast":     "Último",
			        "sNext":     "Siguiente",
			        "sPrevious": "Anterior"
			    },
			    "oAria": {
			        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
			        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
			    }
			};
			$('#tableAlm').DataTable({
				"language" : lenguaje
			});
		});
	</script>

<?php
	} else {
		header("Location:".SERVERURLDIR."dir/Logout.php");
	}	

?>