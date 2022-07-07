<div class="container-fluid animated fadeIn delay-1s">
	
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Panel de control</h1>
	</div>

	<div class="row">
		<div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Carreras</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">
                  	<span id="cantTotCar"></span> registros.
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-university fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Docentes</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">
                  	<span id="cantTotDoc"></span> registros.
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-chalkboard-teacher fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Directores</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">
                  	<span id="cantTotDir"></span> registros.
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-user-tie fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Alumnos</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">
                  	<span id="cantTotAlm"></span> registros.
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-users fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Coordinadores</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">
                  	<span id="cantTotCor"></span> registros.
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-user fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Justificantes</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">
                  	<span id="cantJusTot"></span> registros.
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Bajas de alumnos</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">
                  	<span id="cantTotBaj"></span> registros.
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-user-times fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Encuestas realizadas</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">
                  	<span id="cantTotTest"></span> registros.
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-edit fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
		
		<div class="col-sm-6">
			<div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Información de mi perfil</h6>
                </div>
                <div class="card-body">
                  <div class="text-center">
                    <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="<?php echo SERVERURL; ?>assets/img/undraw_posting_photo.svg" alt="info site">
                  </div>
                  <p>
                  	Actualiza, registra y mantente informado de las estadisticas que te proporciona el sistema, de esta manera podras aportar nuevas ideas para agregar al sistema.
                  </p>
                  <a target="_blank" rel="nofollow" href="https://cjtony.github.io/marc.github.io/">
                    Para mas información consulte al programador
                    &rarr;
                  </a>
                </div>
            </div>
		</div>

		<div class="col-sm-6">
			<div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Enfoque del desarrollo</h6>
                </div>
                <div class="card-body">
                  <div class="text-center">
                    <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="<?php echo SERVERURL; ?>assets/img/pairprogramming.svg" alt="pair programming">
                  </div>
                  <p>
                    SitutBack hace un uso extensivo de las clases de utilidad Bootstrap 4 para reducir la expansión de CSS y el bajo rendimiento de la página.
                  </p>
                  <p class="mb-0">
                    Combinado con librerias como jquery, animate.css, sweetalert, fontawesome, imagenes cortesía de <b>undraw</b>.
                  </p>
                </div>
            </div>
		</div>

	</div>

</div>


<script src="<?php echo SERVERURLADM; ?>adm/js/notifPanel.js"></script>