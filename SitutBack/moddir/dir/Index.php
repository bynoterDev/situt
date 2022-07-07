
<div class="container-fluid animated fadeIn mt-4">
	<div class="row">
		
		<div class="col-xl-6 col-md-6 mb-4">
          <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Alumnos totales</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800" id="cantAlmCar">
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-university fa-2x text-gray-300"></i>
                </div>
                <p class="lead mt-2 p-2 text-justify">
                  	Para este numero estadistico se toma en cuenta todos los alumnos que alguna vez pertenecieron a la carrera y los cuales usaron este sistema.
                 </p>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-6 col-md-6 mb-4">
          <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Grupos totales</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800" id="cantGrpCar">
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-users fa-2x text-gray-300"></i>
                </div>
                <p class="lead mt-2 p-2 text-justify">
                  	Para este numero estadistico se toma en cuenta los grupos de la carrera que se encuentran registrados ya esten activos o inactivos.
                 </p>
              </div>
            </div>
          </div>
        </div>

	</div>
	
	<div class="row">
		
		<div class="col-xl-3 col-md-6 mb-4">
			<a href="<?php echo SERVERURLDIR; ?>RegGrupos/" class="">
	          <div class="card border-left-info shadow h-100 py-2 hovAnim">
	            <div class="card-body">
	              <div class="row no-gutters align-items-center">
	                <div class="col mr-2">
	                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Grupos</div>
	                  <div class="h5 mb-0 font-weight-bold text-gray-800">
	                  	<?php echo $datCantGrp->CantidadGrp; ?> registros.
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

		<div class="col-xl-3 col-md-6 mb-4">
			<a href="<?php echo SERVERURLDIR; ?>RegTutores/" class="">
	          <div class="card border-left-info shadow h-100 py-2 hovAnim">
	            <div class="card-body">
	              <div class="row no-gutters align-items-center">
	                <div class="col mr-2">
	                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tutores</div>
	                  <div class="h5 mb-0 font-weight-bold text-gray-800">
	                  	<?php echo $datCantDir->CantidadDir; ?> registros.
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
			<a href="<?php echo SERVERURLDIR; ?>BajCar/" class="">
	          <div class="card border-left-danger shadow h-100 py-2 hovAnim">
	            <div class="card-body">
	              <div class="row no-gutters align-items-center">
	                <div class="col mr-2">
	                  <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Bajas carrera</div>
	                  <div class="h5 mb-0 font-weight-bold text-gray-800">
	                  	<?php echo $cantBaj->CantBaj; ?> registros.
	                  </div>
	                </div>
	                <div class="col-auto">
	                  <i class="fas fa-times-circle fa-2x text-gray-300"></i>
	                </div>
	              </div>
	            </div>
	          </div>
	        </a>
		</div>

		<div class="col-xl-3 col-md-6 mb-4">
			<a href="<?php echo SERVERURLDIR; ?>AlmInact/" class="">
	          <div class="card border-left-danger shadow h-100 py-2 hovAnim">
	            <div class="card-body">
	              <div class="row no-gutters align-items-center">
	                <div class="col mr-2">
	                  <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Alumnos inactivos</div>
	                  <div class="h5 mb-0 font-weight-bold text-gray-800">
	                  	<?php echo $cantInact->CantInact; ?> registros.
	                  </div>
	                </div>
	                <div class="col-auto">
	                  <i class="fas fa-user-times fa-2x text-gray-300"></i>
	                </div>
	              </div>
	            </div>
	          </div>
	        </a>
		</div>

	</div>

	<div class="row">
		<div class="col-sm-12">
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

<script src="<?php echo SERVERURLDIR; ?>dir/js/notifInd.js"></script>
