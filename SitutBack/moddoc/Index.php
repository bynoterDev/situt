<?php 

ob_start();
session_start();

if ($_SESSION['keyDoc'] == "" || $_SESSION['keyDoc'] == null) {
  header("Location:../");
} else {
  include '../modelos/docente.modelo.php';
  include '../modelos/rutasAmig.php';
  $docente = new Docentes();
  $keyDoc = $_SESSION['keyDoc'];
  $clv_car = $_SESSION['id_carrera'];
  $datDoce = $docente->userDocDet($keyDoc);
  $datDir = $docente -> directRegister();
  $datDoc = $docente -> docentRegister($keyDoc, $clv_car);
  $datCor = $docente -> coordiRegister();
  function formatFech($fechForm) {
    $fechDat = substr($fechForm, 0,4);
    $fechM = substr($fechForm, 5,2);
    $fechD = substr($fechForm, 8,2);
    $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    $Fecha = date($fechD)." de ".$meses[date($fechM)-1]. " del ".date($fechDat);
    return $Fecha;
  }
  if ($datDoce) {
?>
<!DOCTYPE html>
<html lang="es">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SitutBack</title>

  
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

      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo SERVERURLDOC; ?>Home/">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-user-graduate"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SITUT <sup>v.1</div>
      </a>

      <hr class="sidebar-divider my-0">

      <li class="nav-item active text-center">
        <a class="nav-link text-center" href="<?php echo SERVERURLDOC; ?>Home/">
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
            <a class="collapse-item" data-backdrop="false" data-toggle="modal" data-target="#confContDoc" href="#">
              <i class="fas fa-key mr-2 text-primary font-weight-bold"></i> Contraseña
            </a>
            <a class="collapse-item" data-backdrop="false" data-toggle="modal" data-target="#confDatDoc" href="#">
              <i class="fas fa-id-card mr-2 text-primary font-weight-bold"></i> Datos
            </a>
            <a class="collapse-item" data-backdrop="false" data-toggle="modal" data-target="#confFotPerf" href="#">
              <i class="fas fa-image mr-2 text-primary font-weight-bold"></i> Foto
            </a>
          </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Soporte</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Selecciona:</h6>
            <a class="collapse-item" href="<?php echo SERVERURLDOC; ?>RepProblem/">
              <i class="fas fa-file mr-2 text-primary font-weight-bold"></i> Reportar un problema
            </a>
            <a class="collapse-item" href="<?php echo SERVERURLDOC; ?>MyReports/">
              <i class="fas fa-check-circle mr-2 text-primary font-weight-bold"></i> Reportes enviados
            </a>
          </div>
        </div>
      </li>

      <hr class="sidebar-divider">

      <div class="sidebar-heading">
        Directorio
      </div>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#dataCoordinadores" aria-expanded="true" aria-controls="dataCoordinadores">
          <i class="fas fa-fw fa-folder"></i>
          <span>Coordinadores</span>
        </a>
        <div id="dataCoordinadores" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Selecciona</h6>
            <?php 
              while ($dataCor = $datCor -> fetch(PDO::FETCH_OBJ)) {
            ?>
              <a class="collapse-item text-capitalize text-truncate" href="<?php echo SERVERURLDOC ?>ProfileDoc/<?php echo base64_encode($dataCor->id_coordinador); ?>/cor/" title="<?php echo $dataCor->nombre_c_cor; ?>">
                <i class="fas fa-user-tie mr-2 text-primary font-weight-bold"></i> <?php echo $dataCor -> nombre_c_cor; ?>
              </a>
              <div class="collapse-divider"></div>
            <?php
              }
            ?>
          </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#dataDirect" aria-expanded="true" aria-controls="dataDirect">
          <i class="fas fa-fw fa-folder"></i>
          <span>Directores</span>
        </a>
        <div id="dataDirect" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Selecciona</h6>
            <?php 
              while ($dataDir = $datDir -> fetch(PDO::FETCH_OBJ)) {
            ?>
              <a class="collapse-item text-capitalize text-truncate" href="<?php echo SERVERURLDOC ?>ProfileDoc/<?php echo base64_encode($dataDir->id_director); ?>/dir/" title="<?php echo $dataDir->nombre_c_dir; ?>">
                <i class="fas fa-user-tie mr-2 text-primary font-weight-bold"></i> <?php echo $dataDir -> nombre_c_dir; ?>
              </a>
              <div class="collapse-divider"></div>
            <?php
              }
            ?>
          </div>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#dataDocentes" aria-expanded="true" aria-controls="dataDocentes">
          <i class="fas fa-fw fa-folder"></i>
          <span>Tutor</span>
        </a>
        <div id="dataDocentes" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Selecciona</h6>
            <?php 
              while ($dataDoc = $datDoc -> fetch(PDO::FETCH_OBJ)) {
            ?>
              <a class="collapse-item text-capitalize text-truncate" href="<?php echo SERVERURLDOC ?>ProfileDoc/<?php echo base64_encode($dataDoc->id_docente); ?>/doc/" title="<?php echo $dataDoc->nombre_c_doc; ?>">
                <i class="fas fa-user-tie mr-2 text-primary font-weight-bold"></i> <?php echo $dataDoc -> nombre_c_doc; ?>
              </a>
              <div class="collapse-divider"></div>
            <?php
              }
            ?>
          </div>
        </div>
      </li>

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

          <div class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" id="msjbien">
            <h4>
              Bienvenido Tutor.
            </h4>
          </div>

          <ul class="navbar-nav ml-auto">

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
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-file-alt fa-fw"></i>
                <span class="badge badge-danger badge-counter" id="cantNotif"></span>
              </a>
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                  Justificantes
                </h6>
                <div  class="listNot">
                  
                </div>
                <!-- <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-success">
                      <i class="fas fa-donate text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 7, 2019</div>
                    $290.29 has been deposited into your account!
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-warning">
                      <i class="fas fa-exclamation-triangle text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 2, 2019</div>
                    Spending Alert: We've noticed unusually high spending for your account.
                  </div>
                </a> -->
                <a class="dropdown-item text-center small text-gray-500" href="#">
                  
                </a>
              </div>
            </li>

            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="tutorias" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-chalkboard-teacher fa-fw"></i>
                <span class="badge badge-danger badge-counter" id="cantNotifTut"></span>
              </a>
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="tutorias">
                <h6 class="dropdown-header">
                  Tutorias
                </h6>
                <div  class="listTut">
                  
                </div>
                <a class="dropdown-item text-center small text-gray-500" href="#">
                  
                </a>
              </div>
            </li>

            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="tutorias" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <span class="badge badge-danger badge-counter" id="cantNotifRep"></span>
              </a>
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="tutorias">
                <h6 class="dropdown-header">
                  Notificaciones del día de hoy
                </h6>
                <div  class="listNotif">
                  
                </div>
                <a class="dropdown-item text-center small text-gray-500" href="#">
                  
                </a>
              </div>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>

            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                 <?php echo $datDoce->nombre_c_doc; ?>
                </span>
                <?php 
                  if ($datDoce -> foto_perf_doc != "") {
                    $nameImg = $datDirec->foto_perf_doc;
                ?>
                  <img src='<?php echo SERVERURLDOC; ?>perfilFot/<?php echo $nameImg; ?>' class="img-profile rounded-circle">
                <?php
                  } else {
                ?>
                  <img src='http://localhost/situt/SitutBack/assets/img/usermal.png' class="img-profile rounded-circle">
                <?php
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
              if (is_file('doc/'.$views[0].'.php')) { {}
                  include 'doc/'.$views[0].'.php';
              } else {
                  include 'doc/Index.php';
              }
          } else {
              include 'doc/Index.php';
          }
        ?>

      <?php include 'doc/modalsconf.php'; ?>

      </div>

      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span> 
              <i class="fas fa-copyright mr-2"></i>
              Situt -- MA
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
          <a class="btn btn-primary" href="<?php echo SERVERURLDOC; ?>doc/Logout.php">Salir</a>
        </div>
      </div>
    </div>
  </div>

  <script src="<?php echo SERVERURL; ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo SERVERURL; ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo SERVERURL; ?>assets/js/sb-admin-2.min.js"></script>
 <!--  <script src="<?php echo SERVERURLDOC; ?>doc/js/notifGrp.js"></script> -->

  <script type="text/javascript">
    $(document).ready(function(){
      cantAllAlm();
      cantMale();
      cantFemale();
      cantAllBec();
      cantMaleBec();
      cantFemaleBec();
      cantAlmRech(); 
      /*
      setInterval(function () {
        cantAllAlm();
        cantMale();
        cantFemale();
        cantAllBec();
        cantMaleBec();
        cantFemaleBec();
      },10000);
      setInterval(function(){
        cantAlmRech();  
      },10000);*/
      /*setInterval(function () {
        animInf();
      },2500);*/
      cantNotifJust();
        cargarNotif();
        cargarNotifTut();
        cantNotifTut();
      /*
      window.requestAnimationFrame(animInf);
      setInterval(function () {
        cantNotifJust();
        cargarNotif();
        cargarNotifTut();
        cantNotifTut();
      }, 10000);*/
        /*setInterval(function () {
          animNotif();
          animNotifTut();
      },10000);*/

        function animNotif(){
          $.ajax({
          url:'<?php echo SERVERURL; ?>ajax/doc/notifAlm.php?oper=mostNotifCant',
          type : "POST",
          success:function (data) {
            if (data > 0) {
              $("#bell").addClass("animated tada");
              $("#dropdownMenuLink").removeClass("btn-outline-success");
              $("#dropdownMenuLink").addClass("btn-outline-danger");
              setTimeout(function() {
                $("#bell").removeClass("animated tada");
                $("#dropdownMenuLink").removeClass("btn-outline-danger");
                $("#dropdownMenuLink").addClass("btn-outline-success");
              }, 2000);
            }
          }
        });
        }

        function cantNotifJust() {
          $.ajax({
            url:'<?php echo SERVERURL; ?>ajax/doc/notifAlm.php?oper=mostNotifCan',
          type : "POST",
          success:function (data) {
            $('#cantNotif').text(data);
          }
          });
        }
      function cargarNotif () {
        $.ajax({
          url:'<?php echo SERVERURL; ?>ajax/doc/notifAlm.php?oper=mostNotif',
          type : "POST",
          success:function (data) {
            $('.listNot').html(data);
          }
        });
      }
      function cargarNotifTut() {
        $.ajax({
          url : '<?php echo SERVERURL; ?>ajax/doc/notifAlm.php?oper=cargarNotifTut',
          type : "POST",
          success : function( data ) {
            $('.listTut').html(data);
          }
        });
      }
      function animNotifTut(){
          $.ajax({
          url:'<?php echo SERVERURL; ?>ajax/doc/notifAlm.php?oper=cantNotifTut',
          type : "POST",
          success:function (data) {
            if (data > 0) {
              $("#bell2").addClass("animated tada");
              $("#dropdownMenuLink2").removeClass("btn-outline-success");
              $("#dropdownMenuLink2").addClass("btn-outline-danger");
              setTimeout(function() {
                $("#bell2").removeClass("animated tada");
                $("#dropdownMenuLink2").removeClass("btn-outline-danger");
                $("#dropdownMenuLink2").addClass("btn-outline-success");
              }, 2000);
            }
          }
        });
        }
      function cantNotifTut() {
          $.ajax({
            url:'<?php echo SERVERURL; ?>ajax/doc/notifAlm.php?oper=cantNotifTut',
          type : "POST",
          success:function (data) {
            $('#cantNotifTut').text(data);
          }
          });
        }
      function cantAllAlm () {
        $.ajax({
          url:'<?php echo SERVERURL; ?>ajax/doc/notifAlm.php?oper=cantAllAlm',
          type : "POST",
          success:function (data) {
            if (data > 1 || data == 0) {
              $('#cantAllAlm').html(data + " Totales"); 
            } else {
              $('#cantAllAlm').html(data + " Total"); 
            }
          }
        });
      }
      function cantMale () {
        $.ajax({
          url:'<?php echo SERVERURL; ?>ajax/doc/notifAlm.php?oper=cantMale',
          type : "POST",
          success:function (data) {
            if (data > 1 || data == 0) {
              $('#cantMale').html(data + " registros.");  
            } else {
              $('#cantMale').html(data + " registro."); 
            }
          }
        });
      }
      function cantFemale () {
        $.ajax({
          url:'<?php echo SERVERURL; ?>ajax/doc/notifAlm.php?oper=cantFemale',
          type : "POST",
          success:function (data) {
            if (data > 1 || data == 0) {
              $('#cantFemale').html(data + " registros.");  
            } else {
              $('#cantFemale').html(data + " registro."); 
            }
          }
        });
      }
      function cantAllBec () {
        $.ajax({
          url:'<?php echo SERVERURL; ?>ajax/doc/notifAlm.php?oper=cantAllBec',
          type : "POST",
          success:function (data) {
            if (data > 1 || data == 0) {
              $('#cantAllBec').html(data + " registros.");  
            } else {
              $('#cantAllBec').html(data + " registro."); 
            }
          }
        });
      }
      function cantMaleBec () {
        $.ajax({
          url:'<?php echo SERVERURL; ?>ajax/doc/notifAlm.php?oper=cantMaleBec',
          type : "POST",
          success:function (data) {
            if (data > 1 || data == 0) {
              $('#cantMaleBec').html(data + " becados."); 
            } else {
              $('#cantMaleBec').html(data + " becado.");  
            }
          }
        });
      }
      function cantFemaleBec () {
        $.ajax({
          url:'<?php echo SERVERURL; ?>ajax/doc/notifAlm.php?oper=cantFemaleBec',
          type : "POST",
          success:function (data) {
            if (data > 1 || data == 0) {
              $('#cantFemaleBec').html(data + " becadas."); 
            } else {
              $('#cantFemaleBec').html(data + " becada.");  
            }
          }
        });
      }
      function cantAllBec () {
        $.ajax({
          url:'<?php echo SERVERURL; ?>ajax/doc/notifAlm.php?oper=cantAllBec',
          type : "POST",
          success:function (data) {
            if (data > 1 || data == 0) {
              $('#cantAllBec').html(data + " Totales.");  
            } else {
              $('#cantAllBec').html(data + " Total.");  
            }
          }
        });
      }
      function cantAlmRech () {
        $.ajax({
          url:'<?php echo SERVERURL; ?>ajax/doc/notifAlm.php?oper=cantAlmRech',
          type : "POST",
          success:function (data) {
            if (data >= 1) {
              $("#cantAlmRech").show();
              $('#cantAlmRech').html(data); 
              $("#cantAlmRech").addClass("badge badge-danger lead");
              $("#cantAlmRech").addClass("animated fadeOut");
              setTimeout(function(){
                $("#cantAlmRech").removeClass("animated fadeOut");
              }, 1000);
            } else {
              $('#cantAlmRech').hide(); 
              $("#cantAlmRech").removeClass("animated fadeOut");
            }
          }
        });
      }
      function animInf() {
        $("#infoDet").addClass("animated bounce");
        $("#icoHom").addClass("animated jackInTheBox");
        $("#listAsist").addClass("animated jackInTheBox");
        setTimeout(function() {
          $("#infoDet").removeClass("animated bounce");
          $("#icoHom").removeClass("animated jackInTheBox");
          $("#listAsist").removeClass("animated jackInTheBox");
        }, 2000);
      }
    });
  </script>

  <script type="text/javascript">
    document.addEventListener('DOMContentLoaded', () => {

      cargaNotif = () => {
        $.ajax({
          url:'<?php echo SERVERURL; ?>ajax/doc/notifAlm.php?oper=notifRep',
          type : "POST",
          success: ( data ) => {
            $('.listNotif').html(data);
          }
        });
      }

      let reloadNotif = setInterval( cargaNotif, 10000 );

      // cargaNotif();

      cantNotifRep = () => {
        $.ajax({
          url : '<?php echo SERVERURL; ?>ajax/doc/notifAlm.php?oper=cantNotif',
          type : "POST",
          success : ( data ) => {
            $('#cantNotifRep').text(data);
          }
        });
      }

      let reloadCant = setInterval( cantNotifRep, 10000 );

      // cantNotifRep();

    });
  </script>

</body>

</html>

<?php   
  } else {
    header("Location:".SERVERURLDIR."dir/Logout.php");
  }
}

?>
