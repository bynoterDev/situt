<?php 

ob_start(); 
session_start();
if ($_SESSION['keyAlm'] == "" || $_SESSION['keyAlm'] == null) {
  header("Location:../");
} else {
  include '../modelos/alumno.modelo.php';
    include '../modelos/rutasAmig.php';
  $alumno = new Alumno();
  $datAlm = $alumno->userAlmDet($_SESSION['keyAlm']);
  if ($datAlm) {
        if ($datAlm->id_detgrupo != "") {
    $datGrpAlm = $alumno->datGrpAlm($_SESSION['keyAlm']);
    $cantJustTot = $alumno->cantTotJustif($_SESSION['keyAlm']);
    $cantAcJust = $alumno -> cantJustifAcept($_SESSION['keyAlm'], $datGrpAlm->cuatrimestre_g);
    $cantReJust = $alumno -> cantJustifRecha($_SESSION['keyAlm'], $datGrpAlm->cuatrimestre_g);
    $cantTotCut = $alumno -> cantJustifCuat($_SESSION['keyAlm'], $datGrpAlm->cuatrimestre_g);
    } 
  $valDatPer = $alumno -> cantDatPerVal($_SESSION['keyAlm']);
  $datEPer = $alumno -> datPerEditAlm($_SESSION['keyAlm']);
  $valTest = $alumno -> valTestIniAlm($_SESSION['keyAlm']);

?>
<!DOCTYPE html>
<html lang="es">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SitutFront</title>

  
  <link href="<?php echo SERVERURL; ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  
  <link href="<?php echo SERVERURL; ?>assets/css/sb-admin-2.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="<?php echo SERVERURL; ?>vistas/css/animate.css">
  <link href="<?php echo SERVERURL; ?>assets/css/styles.css" rel="stylesheet">
  <link href="<?php echo SERVERURL; ?>assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
 
  <script src="<?php echo SERVERURL; ?>assets/vendor/jquery/jquery.min.js"></script>

  <script src="<?php echo SERVERURL; ?>assets/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo SERVERURL; ?>vistas/node_modules/sweetalert/dist/sweetalert.min.js"></script>
  <script src="<?php echo SERVERURL; ?>assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

</head>

<body id="page-top">

  <div id="wrapper">

    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo SERVERURLALM; ?>Home/">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-user-graduate"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SITUT <sup>v.1</div>
      </a>

      <hr class="sidebar-divider my-0">

      <li class="nav-item active text-center">
        <a class="nav-link text-center" href="<?php echo SERVERURLALM; ?>Home/">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Panel de control</span></a>
      </li>

      <hr class="sidebar-divider">

      <div class="sidebar-heading">
        Opciones
      </div>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cogs"></i>
          <span>Ajustes</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Selecciona:</h6>
            <a class="collapse-item font-weight-bold text-primary" href="#" data-backdrop="false" data-toggle="modal" data-target="#confContAlm">
              <i class="fas fa-key mr-2"></i>Contraseña
            </a>
            <a class="collapse-item font-weight-bold text-primary" href="#" data-backdrop="false" data-toggle="modal" data-target="#confDatAlm">
              <i class="fas fa-user-cog mr-2"></i>Datos
            </a>
            <a class="collapse-item font-weight-bold text-primary" href="#" data-backdrop="false" data-toggle="modal" data-target="#confFotPerf">
              <i class="fas fa-image mr-2"></i>Foto de perfil
            </a>
          </div>
        </div>
      </li>
      
      <?php 
        if ($datAlm -> id_detgrupo != "") {
      ?>
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-file-medical"></i>
            <span>Justificantes</span>
          </a>
          <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Selecciona:</h6>
              <?php 
                if ($datGrpAlm -> acept_grp == 1) {
                  if ($valTest -> CantidadVal == 1) {
              ?>
                <a data-backdrop="false" href="#" data-target="#solJustif"
                    data-toggle="modal" class="collapse-item font-weight-bold text-primary">
                    <i class="fas fa-plus mr-2"></i>
                      Solicitar
                    </a>
                    <a href="<?php echo SERVERURLALM; ?>DetJustif/" class="collapse-item font-weight-bold text-primary">
                      <i class="fas fa-info mr-2"></i>
                      Detalles
                    </a>
              <?php
                } else {
              ?>
                <div class="bg-danger rounded ml-1 mr-1">
                  <p class="text-white text-center p-1">
                    Completa la entrevista inicial
                  </p>
                </div>
              <?php
                }
                } else {
              ?>
                  <a href="#" class="collapse-item disabled  text-danger" >
                    <i class="fas fa-plus mr-2"></i>
                    Solicitar
                  </a>
              <?php
                }
              ?>
            </div>
          </div>
        </li>

        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilitiesEnc" aria-expanded="true" aria-controls="collapseUtilitiesEnc">
            <i class="fas fa-fw fa-book-open"></i>
            <span>Encuesta</span>
          </a>
          <div id="collapseUtilitiesEnc" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Selecciona:</h6>
              <?php 
                if ($datGrpAlm -> acept_grp == 1) {
                  if ($valDatPer -> CantDat == 1) {
                    if ($valTest -> CantidadVal == 1) {
                      $idEnc = $alumno -> valObtEnc($_SESSION['keyAlm']);
              ?>
                <a href="<?php echo SERVERURLALM; ?>TestIniEdit/<?php echo base64_encode($idEnc->id_enctestalm); ?>/" class="collapse-item disabled font-weight-bold text-primary">
                      <i class="fas fa-edit mr-2"></i> Editar
                    </a>    
              <?php
                    } else {
              ?>
                <a href="<?php echo SERVERURLALM; ?>TestIni/" class="collapse-item disabled font-weight-bold text-primary">
                  <i class="fas fa-check mr-2"></i> Realizar
                </a>
              <?php
                    }
                } else {
              ?>
                <div class="bg-danger rounded ml-1 mr-1">
                  <p class="text-white text-center p-1">
                    Completa tus datos personales.
                  </p>
                </div>
              <?php
                }
                } else {
              ?>
                <a href="#" class="collapse-item disabled text-danger">
                  <i class="fas fa-plus mr-2"></i> Solicitar
                </a>
              <?php
                }
              ?>
            </div>
          </div>
        </li>

        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilitiesTut" aria-expanded="true" aria-controls="collapseUtilitiesTut">
            <i class="fas fa-fw fa-chalkboard-teacher"></i>
            <span>Tutoría</span>
          </a>
          <div id="collapseUtilitiesTut" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Selecciona:</h6>
              <?php 
                if ($datGrpAlm -> acept_grp == 1) {
                  if ($valTest -> CantidadVal == 1) {
              ?>
                  <a data-backdrop="false" data-target="#solTut" data-toggle="modal" href="#" class="collapse-item text-primary font-weight-bold">
                    <i class="fas fa-plus mr-2"></i>
                    Solicitar
                  </a>
                  <a href="<?php echo SERVERURLALM; ?>DetTutPer/" class="collapse-item text-primary font-weight-bold">
                    <i class="fas fa-info mr-2"></i>
                    Detalles
                  </a>
              <?php
                } else {
              ?>
                <div class="bg-danger rounded ml-1 mr-1">
                  <p class="text-white text-center p-1">
                    Completa la entrevista inicial.
                  </p>
                </div>
              <?php
                }
                } else {
              ?>
                <a href="#" class="collapse-item disabled text-danger">
                    <i class="fas fa-plus mr-2"></i>
                    Solicitar
                </a>
              <?php
                }
              ?>
            </div>
          </div>
        </li>

        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilitiesDat" aria-expanded="true" aria-controls="collapseUtilitiesDat">
            <i class="fas fa-fw fa-address-book"></i>
            <span>Datos personales</span>
          </a>
          <div id="collapseUtilitiesDat" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Selecciona:</h6>

              <?php 
                if ($datGrpAlm -> acept_grp == 1) {
                  if ($valDatPer -> CantDat == 1) {
              ?>
                  <a href="#" data-backdrop="false" data-target="#datPerAlmEdit" data-toggle="modal" class="collapse-item text-primary font-weight-bold">
                    <i class="fas fa-edit mr-2"></i>
                    Editar
                  </a>
              <?php
                  } else {
              ?>
                  <a href="#" class="collapse-item text-primary font-weight-bold" data-target="#datPerAlm" data-toggle="modal">
                    <i class="fas fa-check mr-2"></i>
                    Completar
                  </a>
              <?php
                }
                } else {
              ?>
                  <a href="#" class="collapse-item disabled text-danger">
                    <i class="fas fa-plus mr-2"></i>
                    Completar
                  </a>
              <?php
                }
              ?>
            </div>
          </div>
        </li>

        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilitiesGrp" aria-expanded="true" aria-controls="collapseUtilitiesGrp">
            <i class="fas fa-fw fa-users"></i>
            <span>Mi grupo <?php echo $datGrpAlm->grupo_n; ?></span>
          </a>
          <div id="collapseUtilitiesGrp" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Selecciona:</h6>
                <a href="#" class="collapse-item text-primary font-weight-bold" data-target="#editMyGrp" data-toggle="modal">
                  <i class="fas fa-edit mr-2"></i>Editar
                </a>
            </div>
          </div>
        </li>

      <?php
        }
      ?>

      <!-- <li class="nav-item">
        <a class="nav-link" href="charts.html">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Charts</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="tables.html">
          <i class="fas fa-fw fa-table"></i>
          <span>Tables</span></a>
      </li>
 -->
      <hr class="sidebar-divider d-none d-md-block">

      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>

    <div id="content-wrapper" class="d-flex flex-column">

      <div id="content">

        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <div class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <h4>
              <?= $_SESSION['nombre_car'] ?>
            </h4>
          </div>

          <ul class="navbar-nav ml-auto">

            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Buscar reporte..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

            <li class="nav-item dropdown no-arrow d-sm-none">
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

            

            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-file-medical fa-fw" id="bell"></i>
                <!-- <span class="badge badge-danger badge-counter">7</span> -->
              </a>
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">
                  Justificantes
                </h6>
                <div  class="listNot">
                  
                </div>
              </div>
            </li>

            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-chalkboard-teacher fa-fw" id="bell2"></i>
                <!-- <span class="badge badge-danger badge-counter">7</span> -->
              </a>
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">
                  Tutorias
                </h6>
                <div  class="listTut">
                  
                </div>
              </div>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>

            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small text-capitalize font-weight-bold">
                  <?php echo $datAlm->nombre_c_al; ?>
                </span>
                <?php 
                if ($datAlm -> foto_perf_alm == "" && $datAlm -> sexo_al == "Masculino") {
                  echo "<img src='".SERVERURL."vistas/img/usermal.png' class='img-profile rounded-circle'>";
                } else if ($datAlm -> foto_perf_alm != "" && $datAlm -> sexo_al == "Masculino") {
              ?>
                <img src="<?php echo SERVERURLALM; ?>Arch/perfil/<?php echo $datAlm->foto_perf_alm ?>" class="img-profile rounded-circle">
              <?php
                } else if ($datAlm -> foto_perf_alm == "" && $datAlm -> sexo_al == "Femenino") {
                  echo "<img src='".SERVERURL."vistas/img/userfem.png' class='img-profile rounded-circle'>";
                } else if ($datAlm -> foto_perf_alm != "" && $datAlm -> sexo_al == "Femenino") {
              ?>
                <img src="<?php echo SERVERURLALM ?>Arch/perfil/<?php echo $datAlm->foto_perf_alm ?>" class="img-profile rounded-circle">
              <?php
                } else {
                  echo "<img src='".SERVERURL."vistas/img/icous.png' class=' img-profile rounded-circle'>";
                }
              ?>
              </a>
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <!-- <a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Perfil
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Mi actividad
                </a> -->
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Salir
                </a>
              </div>
            </li>

          </ul>

        </nav>


        <?php 
          if (isset($_GET['view'])) {
            $views = explode("/", $_GET['view']);
            if (is_file('alm/'.$views[0].'.php')) {
              include 'alm/'.$views[0].'.php';
            } else {
              include 'alm/Index.php';
            }
          } else {
            include 'alm/Index.php';
          }
        ?>
      
  <?php include 'alm/modals/modalJustifSol.php'; ?>
  
  <?php include 'alm/modals/modalDatPerAlm.php'; ?>

  <?php include 'alm/modals/modalEditDatPerAlm.php'; ?>

  <?php include 'alm/modals/EncuestaAlm.php'; ?>

  <?php include 'alm/modals/modalEditGrp.php'; ?>

  <?php include 'alm/modals/modalTutSol.php'; ?>

  <?php include 'alm/modals/modalsconfalm.php'; ?>
        

      </div>

      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span> 
              <i class="fas fa-copyright mr-2"></i>
              Situt <b>v3.4</b> -- MA 
              <script type="text/javascript">
                document.write(new Date().getFullYear());
              </script>
            </span>
          </div>
        </div>
      </footer>

    </div>

  </div>

  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-danger font-weight-bold text-center" id="exampleModalLabel">¿ Esta seguro de cerrar sesion ?</h5>
          <button class="close text-danger" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body text-center">
          Seleccione salir para continuar...
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancelar</button>
          <a class="btn btn-danger btn-sm" href="<?php echo SERVERURLALM; ?>alm/Logout.php">Salir</a>
        </div>
      </div>
    </div>
  </div>

  <script src="<?php echo SERVERURL; ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo SERVERURL; ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo SERVERURL; ?>assets/js/sb-admin-2.min.js"></script>


  <script type="text/javascript">
    function init() {
      $("#formSolicTutoria").on("submit", function(e) {
        regTutPer(e);
      });
      cantTutPer();
      $("#formSolicJustif").on("submit", function(e){
        regJustif(e);
      });
      justCantTot();
      justCantCut();
      justCantAcept();
      justCantRech();
      cantNotifJust();
      // setInterval(function(){
      //  cantTutPer();
      // },800);
    }

    function cantTutPer() {
        $.ajax({
          url:'<?php echo SERVERURL; ?>ajax/alm/almPet.php?oper=cantTutPer',
        type : "POST",
        success:function (data) {
          if (data) {
            $('.listTut').html(data);
            $("#bell2").addClass("text-danger");
          } else {
            $("#bell2").removeClass("text-danger");
            $('.listTut').text("");
          }
        }
        });
    }

    function regTutPer(e) {
      e.preventDefault();
      let formSolicTutoria = document.getElementById('formSolicTutoria'),
      formDat = new FormData($(formSolicTutoria)[0]), razTut = $("#razTut").val(),
      priodTut = document.getElementById('priodTut');
      if (razTut.length > 0) {
        if (priodTut.value != "0") {
          $.ajax({
            url : "<?php echo SERVERURL; ?>ajax/alm/almPet.php?oper=regTutPer",
            type : "POST", data : formDat, 
            contentType : false, processData : false,
            success : function( resp ) {
              if ( resp === "goodIns" ) {
                swal({
                  title : "Solicitud de tutoría enviada...",
                  text : "Ahora espera a que el tutor la acepte",
                  icon : "success",
                  button : "Aceptar",
                  closeOnClickOutside: false
                }).then( ( acepta ) => {
                  location.reload();
                });
              } else if ( resp === "failIns" ) {
                swal({
                  title : "Ocurrio un problema",
                  text : "Solicitud no enviada",
                  icon : "error",
                  button : "Aceptar"
                });
                $("#razTut").val("");
              } else {
                console.log( resp );
              }
            }
          });
        } else {
          swal({
            text : "Selecciona una prioridad del porque solicita una tutoría",
            icon : "warning",
            button : "Aceptar",
            closeOnClickOutside : false,
          }).then( ( acepta ) => {
            $("#priodTut").focus();
          });
        }
      } else {
        swal({
          text : "Introduzca la razón del porque solicita una tutoría",
          icon : "warning",
          button : "Aceptar",
          closeOnClickOutside : false,
        }).then( ( acepta ) => {
          $("#razTut").focus();
        });
      }
    }

    function justCantTot() {
      $.ajax({
          url:'<?php echo SERVERURL; ?>ajax/alm/almPet.php?oper=justCantTot',
        type : "POST",
        success:function (data) {
          $("#justCantTot").text(data);
        }
        });
        //requestAnimationFrame(justCantTot);
    }

    function justCantCut() {
      $.ajax({
          url:'<?php echo SERVERURL; ?>ajax/alm/almPet.php?oper=justCantCut',
        type : "POST",
        success:function (data) {
          $("#justCantCut").text(data);
        }
        });
        //requestAnimationFrame(justCantCut);
    }

    function justCantAcept() {
      $.ajax({
          url:'<?php echo SERVERURL; ?>ajax/alm/almPet.php?oper=justCantAcept',
        type : "POST",
        success:function (data) {
          $("#justCantAcept").text(data);
        }
        });
        //requestAnimationFrame(justCantAcept);
    }

    function justCantRech() {
      $.ajax({
          url:'<?php echo SERVERURL; ?>ajax/alm/almPet.php?oper=justCantRech',
        type : "POST",
        success:function (data) {
          $("#justCantRech").text(data);
        }
        });
        //requestAnimationFrame(justCantRech);
    }

    function cantNotifJust() {
        $.ajax({
          url:'<?php echo SERVERURL; ?>ajax/alm/almPet.php?oper=cantNotifJust',
        type : "POST",
        success:function (data) {
          if (data) {
            $('.listNot').html(data);
            $("#bell").addClass("text-danger");
          } else {
            $("#bell").removeClass("text-danger");
            $('.listNot').text("");
          }
        }
        });
        //requestAnimationFrame(cantNotifJust);
    }

    function regJustif(e) {
      e.preventDefault();
      let formSolicJustif = document.getElementById('formSolicJustif');
      let formDat = new FormData($(formSolicJustif)[0]);
      let extPerm = /(.jpg)$/i, extPerm1 = /(.jpeg)$/i, extPerm2 = /(.png)$/i, extPerm3 = /(.pdf)$/i;
      let sitJustif = $("#sitJustif").val(), archJustif = document.getElementById('archJustif').value,
      fechJustif = $("#fechJustif").val();
      if (sitJustif.length > 0) {
        if (archJustif.length > 0) {
          if (!extPerm.exec(archJustif) && !extPerm1.exec(archJustif) && !extPerm2.exec(archJustif) 
            && !extPerm3.exec(archJustif)) {
            //console.log('Archivo incorrecto');
            $("#archJustif").val("");
          }
        } 
        if (fechJustif.length > 0) {
          $.ajax({
            url : "<?php echo SERVERURL; ?>ajax/alm/almPet.php?oper=regJustif",
            type : "POST", data : formDat, 
            contentType : false, processData : false,
            success : function( resp ) {
              if ( resp === "goodIns" ) {
                swal({
                  title : "Correcto...!",
                  text : "La solicitud de justificante ah sido enviada",
                  icon : "success",
                  button : false
                });
                setTimeout(function() {
                  location.reload();
                }, 2000);
              } else if ( resp === "failIns" ) {
                swal({
                  title : "Ocurrio un problema :(",
                  text : "No se pudo enviar la solicitud",
                  icon : "error",
                  button : "Aceptar"
                }).then( ( acepta ) => {
                  $("#sitJustif").val("");
                  $("#archJustif").val("");
                  $("#fechJustifh").val("");
                });
              }
            }
          });
        } else {
          swal({
            text : "Selecciona la fecha que faltaste",
            icon : "warning",
            button : "Aceptar"
          }).then( ( acepta ) => {
            $("#fechJustif").focus();
          });
        }
      } else {
        swal({
          text : "Introduce la situación del porque faltaste",
          icon : "warning",
          button : "Aceptar"
        }).then( ( acepta ) => {
          $("#sitJustif").focus();
        });
      }
    }

    init();
  </script>
  
</body>

</html>


<?php
  } else {
    header("Location:".SERVERURLALM."alm/Logout.php");
  }
    
}
