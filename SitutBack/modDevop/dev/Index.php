<?php 

	$cantRepRes = $devop -> cantReportsRes();
	$cantRepPro = $devop -> cantReportsPro();
	$cantAdmn = $devop -> estadistAdmCant();
	$cantCarr = $devop -> estadistCarCant();
	$cantCord = $devop -> estadistCorCant();
	$cantDire = $devop -> estadistDirCant();
	$cantDoct = $devop -> estadistDocCant();
	$cantAlmn = $devop -> estadistAlmCant();

?>

<div class="container-fluid animated fadeIn delay-1s">
	
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
	    <h1 class="h3 mb-0 text-gray-800">
	    	<i class="fas fa-terminal mr-2"></i>
	    	Panel de control
	    </h1>
	    <!-- <a href="<?php echo SERVERURLDEV; ?>Report/" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm">
	      <i class="fas fa-file fa-sm text-white-50 mr-2"></i> Reportes 
	    </a> -->
	</div>

	<div class="row">
		
		<div class="col-xl-3 col-md-6 mb-4">
      <a href="<?php echo SERVERURLDEV; ?>EstateRep/res/">
        <div class="card border-left-success shadow h-100 py-2 hovAnim">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Rep resueltos.</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                  <?php echo $cantRepRes->Cantidad; ?> registros.
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-check-circle fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </a>
    </div>

        <div class="col-xl-3 col-md-6 mb-4">
          <a href="<?php echo SERVERURLDEV; ?>EstateRep/not/">
            <div class="card border-left-warning shadow h-100 py-2 hovAnim">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Rep proceso.</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                      <?php echo $cantRepPro->Cantidad; ?> registros.
                    </div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-spinner fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
          <a href="<?php echo SERVERURLDEV; ?>ConfigFunc/adm/">
            <div class="card border-left-info shadow h-100 py-2 hovAnim">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Administradores</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                      <?php echo $cantAdmn->Cantidad; ?> registros.
                    </div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-user-shield fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>

		<div class="col-xl-3 col-md-6 mb-4">
          <a href="<?php echo SERVERURLDEV; ?>DetCareer/">
            <div class="card border-left-info shadow h-100 py-2 hovAnim">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Carreras</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                      <?php echo $cantCarr->Cantidad; ?> registros.
                    </div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-university fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
          <a href="<?php echo SERVERURLDEV; ?>ConfigFunc/cor/">
            <div class="card border-left-info shadow h-100 py-2 hovAnim">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Coordinadores</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                      <?php echo $cantCord->Cantidad; ?> registros.
                    </div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-user fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
          <a href="<?php echo SERVERURL ?>ConfigFunc/dir/">
            <div class="card border-left-info shadow h-100 py-2 hovAnim">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Directores</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                      <?php echo $cantDire->Cantidad; ?> registros.
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

        <div class="col-xl-3 col-md-6 mb-4">
          <a href="<?php echo SERVERURLDEV; ?>ConfigFunc/doc/">
            <div class="card border-left-info shadow h-100 py-2 hovAnim">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Docentes</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                      <?php echo $cantDoct->Cantidad; ?> registros.
                    </div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-chalkboard-teacher fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
          <a href="<?php echo SERVERURLDEV; ?>Students/">
            <div class="card border-left-info shadow h-100 py-2 hovAnim">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Alumnos</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                      <?php echo $cantAlmn->Cantidad; ?> registros.
                    </div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-users fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>

        <div class="col-sm-6">
			<div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">
                  	Funciones del desarrollador
                  </h6>
                </div>
                <div class="card-body">
                  <div class="text-center">
                    <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 15rem;" src="<?php echo SERVERURL; ?>assets/img/programming.svg" alt="info site">
                  </div>
                  <p>
                  	Mantener el sistema de tutorías optimizado y seguro para todos los usuarios y sus datos que se encuentren en el sistema, informar de cualquier error a las autoridades correspondientes.
                  </p>
                </div>
            </div>
		</div>
		<div class="col-sm-6">
			<div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">
                  	Versión del sistema
                  </h6>
                </div>
                <div class="card-body">
                  <div class="text-center">
                    <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 15rem;" src="<?php echo SERVERURL; ?>assets/img/gitversion.svg" alt="info site">
                  </div>
                  <p>
                  	El sistema se encuentra en su versión <?php echo $dataSis->version_sistem; ?>, asegurese de mantener actualizado el control de versiones.
                  </p>
                </div>
            </div>
		</div>

	</div>

</div>