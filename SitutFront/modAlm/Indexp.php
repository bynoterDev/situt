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
<html>
<head>
    <title>Tutorías</title>
    <!-- Estilos Bootstrap -->
    <link rel="stylesheet" type="text/css" href="<?php echo SERVERURL; ?>vistas/css/bootstrap.min.css">
    <!-- Estilos Animate -->
    <link rel="stylesheet" type="text/css" href="<?php echo SERVERURL; ?>vistas/css/animate.css">
    <!-- Estilos Personalizados -->
    <link rel="stylesheet" type="text/css" href="<?php echo SERVERURL; ?>vistas/css/estilos.css">
    <!-- Fuente de letra Google -->
    <link href="https://fonts.googleapis.com/css?family=Arimo" rel="stylesheet">
    <!-- Iconos FontAwesome -->
    <!-- <script defer src="vistas/icons/svg-with-js/js/fontawesome-all.js"></script> -->
    <link rel="stylesheet" type="text/css" href="<?php echo SERVERURL; ?>vistas/css/fontawesome-all.css">
    <link rel="stylesheet" type="text/css" href="<?php echo SERVERURL; ?>vistas/datatables/jquery.dataTables.min.css">    
    <link href="<?php echo SERVERURL; ?>vistas/datatables/buttons.dataTables.min.css" rel="stylesheet"/>
    <link href="<?php echo SERVERURL; ?>vistas/datatables/responsive.dataTables.min.css" rel="stylesheet"/>
    <script src="<?php echo SERVERURL; ?>vistas/js/jquery-3.1.1.min.js"></script>
    <!-- SweetAlert -->
    <script src="<?php echo SERVERURL; ?>vistas/node_modules/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo SERVERURL; ?>vistas/Assets/js/vendor/popper.min.js"></script>
    <script src="<?php echo SERVERURL; ?>vistas/Js/bootstrap.min.js"></script>
    <script src="<?php echo SERVERURL; ?>vistas/assets/js/vendor/holder.min.js"></script>
    
</head>
<body>
    <style type="text/css">
        body {
            /*background-color: #EEEEEE;*/
            /*background-color: #FAFAFA;*/
            /*background-color: #ECEFF1;*/
        }
        .colLet {
            color : #EEEEEE;
        }
        .ncol {
            background-color: #007bff;
            transition: all 1s ease;
        }
        .bgNav {
            /*1B5E20*/
            background-color: #007bff;
            transition: all 1s ease;
        }
    </style>
    <div class="navbar-dark bg-primary ncol fixed-top" id="menu1">
        <nav class="navbar navbar-expand-md ncol navbar-dark bg-primary container" id="menu2">
            <a class="navbar-brand" href="<?php echo SERVERURLALM; ?>Home/">
                <b id="textLog">S I T U T</b>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto mr-5">
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo SERVERURLALM; ?>Home/">
                        <i class="fas fa-home mr-2"></i>
                        Inicio <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a data-backdrop="false" data-toggle="modal" data-target="#confContAlm" class="nav-link" href="#">
                        <i class="fas fa-key fa-lg icoIni"></i> 
                        Contraseña
                    </a>
                </li>
                <li class="nav-item">
                    <a data-backdrop="false" data-toggle="modal" data-target="#confDatAlm" class="nav-link" href="#">
                        <i class="fas fa-user-cog fa-lg icoIni"></i>
                        Datos
                    </a>
                </li>
                <li class="nav-item">
                    <a data-backdrop="false" data-toggle="modal" data-target="#confFotPerf" class="nav-link" href="#">
                        <i class="fas fa-image fa-lg icoIni"></i>
                        Foto
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo SERVERURLALM; ?>alm/Logout.php">
                        <i class="fas fa-sign-out-alt fa-lg"></i>
                        Salir
                    </a>
                </li>
                </ul>
                <span class="navbar-text text-white">
                    <i class="fas fa-user-circle fa-lg icoIni"></i>
                    <?php echo $datAlm->nombre_c_al; ?>
                </span>
            </div>
        </nav>
    </div> <!-- NAVBAR -->

	<br><br><br><br>
	<style type="text/css">
		div .list-group .active {
			background:#fff!important;
			color: black;
			outline: none;
			list-style: none;
			text-decoration: none;
			border-color: #28a745!important;
		}
		.ocult {
			display: none;
		}
		.margen-avatar{
        	margin-top:-50px;
    	}
    	.shDC {
    		-webkit-box-shadow: 0px 0px 2px 0px rgba(0,0,0,0.75);
			-moz-box-shadow: 0px 0px 2px 0px rgba(0,0,0,0.75);
			box-shadow: 0px 0px 2px 0px rgba(0,0,0,0.75);
    	}
	</style>
	
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
    
    <br><br><br>
	
    <script type="text/javascript">
            $(window).scroll(function() {
              if ($("#menu1").offset().top > 56) {
                  $("#menu1").addClass("bg-info");
              } else {
                  $("#menu1").removeClass("bg-info");
              }
            });
            $(window).scroll(function(){
            	if ($("#menu2").offset().top > 56) {
                  $("#menu2").addClass("bg-info");
                  $("#textLog").text("U T S E M");
              } else {
                  $("#menu2").removeClass("bg-info");
                  $("#textLog").text("S I T U T");
              }
            });
    </script>
    
    <div class="container-fluid bg-info">
    <div class="row p-3">
        <div class="col-sm-12">
            <h6 class="text-left text-white">
                S I T U T
                <span class="badge badge-pill badge-light ml-3">
                    Versión 1.0.
                </span>
            </h6>
        </div>
        <div class="col-sm-12 mt-4 mb-2">
            <h6 class="text-center text-white">
                <i class="fas fa-copyright"></i>
                <script type="text/javascript">
                    const d = new Date();
                    document.write(d.getFullYear());
                </script>
                Todos los Derechos Reservados
                <a href="https://cjtony.github.io/marc.github.io/" class="text-white font-weight-bold ml-1">
                    M A.
                </a>
            </h6>
        </div>
    </div>
</div>

<?php
	} else {
		header("Location:".SERVERURLALM."alm/Logout.php");
	}
	  
}

