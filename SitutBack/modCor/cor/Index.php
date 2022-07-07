<?php 

  $carreReg = $cordinador -> carreraRegister();
  
  $cantCarr = $cordinador -> estadistCarCant();
  $cantDire = $cordinador -> estadistDirCant();
  $cantDoce = $cordinador -> estadistDocCant();
  $cantAlum = $cordinador -> estadistAlmCant();

  $testPorc = $cordinador -> porcTestComplet();
  $bajaPorc = $cordinador -> porcBajaAlumnos();
  $justPorc = $cordinador -> porcJustAlumnos();

?>

<div class="container-fluid animated fadeIn delay-1s">

          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Panel de control</h1>
            <a href="<?php echo SERVERURLCOR; ?>Report/" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
              <i class="fas fa-file fa-sm text-white-50 mr-2"></i> Reportes 
            </a>
          </div>

          <div class="row">

            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
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
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Directores</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <?php echo $cantDire -> Cantidad ?> registros.
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
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Docentes</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                            <?php echo $cantDoce -> Cantidad; ?> registros
                          </div>
                        </div>
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
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Alumnos</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <?php echo $cantAlum -> Cantidad; ?> registros.
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">

            <div class="col-lg-6 mb-4">

              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Porcentajes</h6>
                </div>
                <div class="card-body">
                  <h4 class="small font-weight-bold">
                    Encuestas completadas 
                    <span class="float-right">
                      <?php echo $testPorc; ?> %
                    </span>
                  </h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $testPorc; ?>%" aria-valuenow="<?php echo $testPorc; ?>" aria-valuemin="0" aria-valuemax="100">
                    </div>
                  </div>
                  <h4 class="small font-weight-bold">
                    Bajas de alumnos 
                    <span class="float-right">
                      <?php echo $bajaPorc; ?>%
                    </span>
                  </h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo $bajaPorc; ?>%" aria-valuenow="<?php echo $bajaPorc; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <h4 class="small font-weight-bold">Justificantes generados 
                    <span class="float-right">
                      <?php echo $justPorc; ?>  %
                    </span>
                  </h4>
                  <div class="progress mb-4">
                    <div class="progress-bar" role="progressbar" style="width: <?php echo $justPorc; ?>%" aria-valuenow="<?php echo $justPorc; ?>" aria-valuemin="0" aria-valuemax=""></div>
                  </div>
                </div>
              </div>
              

              <?php 
                while ($data = $carreReg -> fetch(PDO::FETCH_OBJ)) {
              ?>
                <div class="card shadow mb-4">
                  <a href="#carrSelect<?php echo $data->id_carrera; ?>" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="carrSelect<?php echo $data->id_carrera; ?>">
                    <h6 class="m-0 font-weight-bold text-primary">
                      <?php echo $data->nombre_car; ?>
                    </h6>
                  </a>
                  <div class="collapse show" id="carrSelect<?php echo $data->id_carrera; ?>">
                    <div class="card-body">
                      <?php echo $data->descripcion_car; ?> 
                      <div class="text-right">
                        <a href="<?php echo SERVERURLCOR; ?>DetCar/<?php echo base64_encode($data->id_carrera); ?>/">
                          <i class="fas fa-plus-circle text-primary fa-lg"></i>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              <?php
                }
              ?>

            </div>

            <div class="col-lg-6 mb-4">

              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Información de mi perfil</h6>
                </div>
                <div class="card-body">
                  <div class="text-center">
                    <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="<?php echo SERVERURL; ?>assets/img/undraw_posting_photo.svg" alt="info site">
                  </div>
                  <p>
                    Mentente informado de la situación academica de cada uno de los universitarios desde cualquier dispositivo con una conexión a internet.
                  </p>
                  <a target="_blank" rel="nofollow" href="https://cjtony.github.io/marc.github.io/">
                    Para mas información consulte al programador
                    &rarr;
                  </a>
                </div>
              </div>

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