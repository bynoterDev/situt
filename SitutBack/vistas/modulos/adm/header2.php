<!DOCTYPE html>
<html>
<head>
	<title>Tutorías</title>
	<!-- Estilos Bootstrap -->
	<link rel="stylesheet" type="text/css" href="../vistas/css/bootstrap.min.css">
	<!-- Estilos Animate -->
	<link rel="stylesheet" type="text/css" href="../vistas/css/animate.css">
	<!-- Estilos Personalizados -->
	<link rel="stylesheet" type="text/css" href="../vistas/css/estilos.css">
	<!-- Fuente de letra Google -->
	<link href="https://fonts.googleapis.com/css?family=Arimo" rel="stylesheet">
	<!-- Iconos FontAwesome -->
	<!-- <script defer src="vistas/icons/svg-with-js/js/fontawesome-all.js"></script> -->
	<link rel="stylesheet" type="text/css" href="../vistas/css/fontawesome-all.css">
	<link rel="stylesheet" type="text/css" href="../vistas/datatables/jquery.dataTables.min.css">    
    <link href="../vistas/datatables/buttons.dataTables.min.css" rel="stylesheet"/>
    <link href="../vistas/datatables/responsive.dataTables.min.css" rel="stylesheet"/>
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
            <a class="navbar-brand" href="Index.php">
                <b id="textLog">S I T U T</b>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto mr-5">
                <li class="nav-item active">
                    <a class="nav-link" href="Index.php">
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
                	<a class="nav-link" href="../vistas/modulos/adm/Logout.php">
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