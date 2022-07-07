<?php 

ob_start();
session_start();

if ($_SESSION['keyAdm'] == "" || $_SESSION['keyAdm'] == null) {
	header("Location:../");
} else {
	include '../modelos/admin.modelo.php';
	include '../modelos/rutasAmig.php';
	$admin = new Administrador();
	$datAdmin = $admin->userAdminDet($_SESSION['keyAdm']);
	if ($datAdmin) {
		$datCarre = $admin->estadistCarCant();
		$datCarreAct = $admin->estadistCarAct();
		$datCarreDes = $admin->estadistCarDes();
		$datDirec = $admin->estadistDirCant();
		$datDirecAct = $admin->estadistDirAct();
		$datDirecDes = $admin->estadistDirDes();
		$datDocen = $admin->estadistDocCant();
		$datDocenAct = $admin->estadistDocCantAct();
		$datDocenDes = $admin->estadistDocCantDes();
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
    <!-- jQuery -->
    <script src="<?php echo SERVERURL; ?>vistas/js/jquery-3.1.1.min.js"></script>
    <!-- SweetAlert -->
    <script src="<?php echo SERVERURL; ?>vistas/node_modules/sweetalert/dist/sweetalert.min.js"></script>
    <script src="<?php echo SERVERURL; ?>vistas/datatables/jquery.dataTables.min.js"></script>    
    <script src="<?php echo SERVERURL; ?>vistas/datatables/dataTables.buttons.min.js"></script>
    <script src="<?php echo SERVERURL; ?>vistas/datatables/buttons.html5.min.js"></script>
    <script src="<?php echo SERVERURL; ?>vistas/datatables/buttons.colVis.min.js"></script>
    <script src="<?php echo SERVERURL; ?>vistas/datatables/jszip.min.js"></script>
    <script src="<?php echo SERVERURL; ?>vistas/datatables/pdfmake.min.js"></script>
    <script src="<?php echo SERVERURL; ?>vistas/datatables/vfs_fonts.js"></script> 
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
            <a class="navbar-brand" href="<?php echo SERVERURLADM; ?>Inicio/">
                <b id="textLog">S I T U T</b>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto mr-5">
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo SERVERURLADM; ?>Inicio/">
                    	<i class="fas fa-home mr-2"></i>
                    	Inicio <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a data-backdrop="true" data-backdrop="false" data-toggle="modal" data-target="#confCont" class="nav-link" href="#">
		          		<i class="fas fa-key fa-lg icoIni"></i> 
		          		Contraseña
		          	</a>
                </li>
                <li class="nav-item">
                	<a data-backdrop="true" data-toggle="modal" data-target="#confDat" class="nav-link" href="#">
		          		<i class="fas fa-user-cog fa-lg icoIni"></i>
		          		Datos
		          	</a>
                </li>
                <li class="nav-item">
                	<a class="nav-link" href="<?php echo SERVERURLADM; ?>adm/Logout.php">
					    <i class="fas fa-sign-out-alt fa-lg"></i>
					    Salir
					</a>
                </li>
                </ul>
                <span class="navbar-text text-white">
                	<i class="fas fa-user-circle fa-lg icoIni"></i>
		         	<?php echo $datAdmin->nombre_c; ?>
                </span>
            </div>
        </nav>
    </div> <!-- NAVBAR -->
	
	<?php 
		if (isset($_GET['view'])) {
		    $views = explode("/", $_GET['view']);
		    if (is_file('adm/'.$views[0].'.php')) { {}
		      	include 'adm/'.$views[0].'.php';
		    } else {
		      	include 'adm/Index.php';
		    }
		} else {
		    include 'adm/Index.php';
		}
	?>

	<?php include 'adm/modalsIniAdm.php'; ?>

	<div class="container-fluid bg-info">
		<div class="row p-4">
			<div class="col-sm-12">
				<h4 class="text-center text-white">Redes sociales</h4>
			</div>
			<div class="col-sm-4 text-center mt-4">
				<a href="#" class="text-white">
					<i class="fab text-white fa-facebook fa-2x"></i>
					<br>
					Facebook
				</a>
			</div>
			<div class="col-sm-4 text-center mt-4">
				<a href="#" class="text-white">
					<i class="fab text-white fa-instagram fa-2x"></i>
					<br>
					Instagram
				</a>
			</div>
			<div class="col-sm-4 text-center mt-4">
				<a href="#" class="text-white">
					<i class="fab text-white fa-twitter fa-2x"></i>
					<br>
					Twitter
				</a>
			</div>
			<div class="col-sm-12 mt-5">
				<h6 class="text-center text-white">
					<i class="fas fa-copyright"></i> 2018 - 2019 Todos los Derechos Reservados
				</h6>
			</div>
		</div>
	</div>
	
    <script src="<?php echo SERVERURLADM; ?>adm/js/confDatCont.js"></script>
    <script src="<?php echo SERVERURLADM; ?>adm/js/notifPanel.js"></script>

</body>
</html>

<?php		
	} else {
		header("Location:".SERVERURLADM."adm/Logout.php");
	}
	ob_end_flush();	
}
?>