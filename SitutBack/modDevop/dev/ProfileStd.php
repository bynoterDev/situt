<?php 

$cod = explode("/", $_GET['view']);
$val = $cod[1];

$dataStd = $devop -> detailsStd($val);
$dataTes = $devop -> detailTest($val);

?>

<div class="container-fluid animated fadeIn delay-1s">
	
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">
		    <i class="fas fa-user mr-2 text-primary"></i>
			<b><?php echo $dataStd->nombre_c_al; ?></b>.
		</h1>
		<a href="<?php echo SERVERURLDEV; ?>Home/" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
		   	<i class="fas fa-arrow-left fa-sm text-white-50 mr-2"></i> Inicio 
		</a>
	</div>

		
		<div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">
              	Estudiante
              </h6>
            </div>
            <div class="card-body">
              <div class="text-center">
                <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 15rem;" src="<?php echo SERVERURL; ?>assets/img/undraw_profile.svg" alt="info site">
              </div>
              <div class="row mt-4">
              	<div class="col-sm-4 mb-4">
              		<div class="list-group list-unstyled">
              			<li class="list-group-item-heading text-center font-weight-bold h5">
              				Información
              			</li>
              			<li class="list-group-item-primary mt-2 p-2 rounded font-weight-bold">
              				Correo: <a href="mailto:"><?php echo $dataStd->correo_al; ?></a>.
              			</li>
                    <li class="list-group-item-primary mt-2 p-2 rounded font-weight-bold">
                      Carrera: <?php echo $dataStd->nombre_car; ?>.
                    </li>
                    <li class="list-group-item-primary mt-2 p-2 rounded font-weight-bold">
                      Grupo: <?php echo $dataStd->grupo_n; ?>.
                    </li>
                    <li class="list-group-item-primary mt-2 p-2 rounded font-weight-bold">
                      Cuatrimestre: <?php echo $dataStd->cuatrimestre_g; ?>.
                    </li>
              			<li class="list-group-item-primary mt-2 p-2 rounded font-weight-bold">
              				Matricula: <?php echo $dataStd->matricula_al; ?>.
              			</li>
              			<li class="list-group-item-primary mt-2 p-2 rounded font-weight-bold">
              				Telefono: <?php echo $dataStd->telefono_al; ?>.
              			</li>
                    <?php 
                      if ($dataTes->rowCount() > 0) {
                        $dataTes = $dataTes -> fetch(PDO::FETCH_OBJ);
                    ?>
                    <li class="list-group-item-primary mt-2 p-2 rounded font-weight-bold">
                      Facebook: <?php echo $dataTes->facebook_alm_dat; ?>.
                    </li>
                    <?php
                      }
                    ?>
              			<li class="list-group-item-primary mt-2 p-2 rounded font-weight-bold">
              				Sexo: <?php echo $dataStd->sexo_al; ?>.
              			</li>
              		</div>
              	</div>
              	<div class="col-sm-4 mb-4">
              		<div class="list-group list-unstyled">
              			<li class="list-group-item-heading text-center font-weight-bold h5">
              				Sistema
              			</li>
              			<li class="list-group-item-primary mt-2 p-2 rounded font-weight-bold">
              				Cuenta: <?php if ($dataStd->estado_al == 1) {
              			?>
							<span class="badge badge-primary"><i class="fas fa-check mr-2"></i>Habilitada</span>
              			<?php
              				} else {
              			?>
							<span class="badge badge-primary"><i class="fas fa-check mr-2"></i>Inhabilitada</span>
              			<?php
              				} ?>
              			</li>
                    <li class="list-group-item-primary mt-2 p-2 rounded font-weight-bold">
                      Registro: <?php echo formatFech($dataStd->fecha_reg); ?>.
                    </li>
                    <li class="list-group-item-primary mt-2 p-2 rounded font-weight-bold">
                      Ultima sesion: <?php echo formatFech($dataStd->fecha_ult_ses_alm); ?>.
                    </li>
              		</div>
              	</div>
              	<div class="col-sm-4 mb-4">
                  <div class="list-group list-unstyled">
                    <li class="list-group-item-heading text-center font-weight-bold h5">
                      Foto de perfil
                    </li>
                    <li class="mt-2 p-2 rounded font-weight-bold">
                      <?php 
                        if ($dataStd -> foto_perf_alm != "") {
                      ?>
                        <div class="text-center">
                          <img src="<?php echo SERVERURLFRONT; ?>modAlm/Arch/perfil/<?php echo $dataStd->foto_perf_alm; ?>" class="img-fluid rounded" alt="profile" width="150">
                        </div>
                      <?php
                        } else {
                      ?>
                        <div class="text-center">
                          <img src="<?php echo SERVERURL; ?>assets/img/usermal.png" class="img-fluid" alt="profile" width="150">
                        </div>
                      <?php
                        }
                      ?>
                    </li>
                  </div>
              	</div>
              </div>
            </div>
        </div>


</div>