<?php 
	$cod = explode("/", $_GET['view']);
	$valDat = base64_decode($cod[1]);
  $valTip = $cod[2];
	$datDirect = $admin -> dataDirectSel($valDat);
  $datCoordi = $admin -> dataCoordiSel($valDat);
?>

<div class="container-fluid">
	<div class="row">
		<?php 
      if ($valTip == 'dir') {
    ?>
    <div class="col-sm-12">
      <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h4 class="m-0 font-weight-bold text-primary">
                    Datos del director: <b><?php echo $datDirect->nombre_c_dir; ?></b>.
                  </h4>
                </div>
                <div class="card-body">
                  <div class="text-center">
                    <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="<?php echo SERVERURL; ?>assets/img/undraw_profile.svg" alt="image profile">
                  </div>
                  <div class="row text-center mt-3">
                    <div class="col-sm-4 text-truncate" title="<?php echo $datDirect->nombre_car; ?>">
                      <i class="fas fa-university mr-1"></i>
                      <?php echo $datDirect->nombre_car; ?>
                    </div>
                    <div class="col-sm-4">
                      <i class="fas fa-envelope mr-1"></i>
                      <?php echo $datDirect->correo_dir; ?>
                    </div>
                    <div class="col-sm-4">
                      <i class="fas fa-phone mr-1"></i>
                      <?php echo $datDirect->telefono_dir; ?>
                    </div>
                  </div>
                </div>
              </div>
    </div>
    <?php
      } else if ($valTip == 'cor') {
    ?>
       <div class="col-sm-12">
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h4 class="m-0 font-weight-bold text-primary">
                Datos del coordinador: <b><?php echo $datCoordi->nombre_c_cor; ?></b>.
              </h4>
            </div>
            <div class="card-body">
              <div class="text-center">
                <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="<?php echo SERVERURL; ?>assets/img/undraw_profile.svg" alt="image profile">
              </div>
              <div class="row text-center mt-3">
                <div class="col-sm-6">
                  <i class="fas fa-envelope mr-1"></i>
                  <?php echo $datCoordi->correo_cor; ?>
                </div>
                <div class="col-sm-6">
                  <i class="fas fa-phone mr-1"></i>
                  <?php echo $datCoordi->telefono_cor; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
    <?php 
      } else {
    ?>
    <div class="col-sm-12 mt-5">
      <div class="text-center">
        <div class="error mx-auto" data-text="404">404</div>
        <p class="lead text-gray-800 mb-5">Registro no encontrado...</p>
        <p class="text-gray-500 mb-0">
          Al parecer hubo un problema al momento de buscar un dato erroneo...
        </p>
        <a href="<?php echo SERVERURLCOR; ?>Home/">&larr; Volver al inicio</a>
      </div>
    </div>
    <?php
      }
    ?>
	</div>
</div>