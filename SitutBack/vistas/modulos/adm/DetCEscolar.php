<?php

ob_start();
session_start();

if ($_SESSION['keyAdm'] == "" || $_SESSION['keyAdm'] == null) {
	header("Location:../Index.php");
} else {
	include '../modelos/admin.modelo.php';
	$admin = new Administrador();
	$datAdmin = $admin->userAdminDet($_SESSION['keyAdm']);
?>
<?php 
	if ($datAdmin) {
?>
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
	<link href="https://fonts.googleapis.com/css?family=Bitter|PT+Sans" rel="stylesheet">
	<!-- Iconos FontAwesome -->
	<!-- <script defer src="vistas/icons/svg-with-js/js/fontawesome-all.js"></script> -->
	<link rel="stylesheet" type="text/css" href="../vistas/css/fontawesome-all.css">
	<link rel="stylesheet" type="text/css" href="../vistas/datatables/jquery.dataTables.min.css">    
    <link href="../vistas/datatables/buttons.dataTables.min.css" rel="stylesheet"/>
    <link href="../vistas/datatables/responsive.dataTables.min.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="../vistas/css/bootstrap-select.min.css">
</head>
<body>

	<nav class="navbar navbar-expand-lg navbar-white bg-white border-bottom">
		<a class="navbar-brand">
	  			<img src="../vistas/img/situt1.png" width="300" alt="">
	  		</a>
  <!-- <a class="navbar-brand" style="font-size: 60px; font-family: sans-serif;" href="Index.php">SITUT</a> -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
    	<div class="" id="navbarNavDropdown">
   					<ul class="navbar-nav">
   						<br>
      					<li class="nav-item dropdown text-center border rounded" style="margin-right: 5px;">
		        			<a style="font-size: 18px; padding: 10px;" class="hovLinkNav nav-link dropdown-toggle btn-outline-success rounded" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		        				<i class="fas fa-user-circle fa-lg icoIni"></i>
		         				<?php echo $datAdmin->nombre_c; ?>
		        			</a>
		        			<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
		          				<a data-toggle="modal" data-target="#confCont" class="dropdown-item aNav" href="#"> 
		          					<i class="fas fa-key fa-lg icoIni"></i> 
		          					Cambiar contraseña
		          				</a>
		          				<div class="dropdown-divider"></div>
		          				<a data-toggle="modal" data-target="#confDat" class="dropdown-item aNav" href="#">
		          					<i class="fas fa-user-cog fa-lg icoIni"></i>
		          					Cambiar datos
		          				</a>
		        			</div>
		      			</li>
		      			<br>
		      			<li class="nav-item text-center border rounded" style="margin-right: 5px;">
					        <a style="font-size: 18px; padding: 10px;" class="hovLinkNav nav-link btn-outline-danger rounded" href="../vistas/modulos/adm/Logout.php">
					        	Salir
					        	<i class="fas fa-sign-out-alt fa-lg"></i>
					        </a>
					    </li>
		    		</ul>
		  		</div>
    </form>
  </div>
</nav>
	<style type="text/css">
		.ocult{
			display: none;
		}
		tr {
			font-size: 18px;
		}
		tr:hover {
			color: white !important;
			font-weight: bolder;
			transition: 0.5s;
		}
	</style>
	<br><br>
	<div class="container">
		<div class="row">
			<a href="Index.php" class="btn btn-outline-success btn-lg">
				<i class="fas fa-home icoIni"></i> Inicio
			</a>
		</div>
	</div>
	<br><br>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<h2 class="text-center">
					<i class="fas fa-calendar fa-lg icoIni"></i>
					Apartado Ciclo Escolar
				</h2>
			</div>
		</div>
		<br><br>
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-6">
				<h4 class="text-center"> <i class="fas fa-plus icoIni"></i> Registrar Ciclo</h4>
				<div class="row">
					<div class="col-sm-2"></div>
					<form class="col-sm-8" method="POST" id="formGCEsc" name="formGCEsc">
						<hr class="my-2">
						<br>
						<div class="form-group">
							<label for="nomCEsc">Ciclo escolar:</label>
							<input type="text" id="nomCEsc" name="nomCEsc" class="form-control">
						</div>
						<div class="form-group">
							<label for="estCEsc">Estado:</label>
							<select id="estCEsc" name="estCEsc" class="form-control">
								<option selected="" disabled="" value="No">Selecciona</option>
								<option value="1">Activo</option>
								<option value="0">Inactivo</option>
							</select>
						</div>
						<br>
						<hr>
						<div class="form-group text-center">
							<button class="btn btn-outline-success btn-lg" type="submit"> <i class="fas fa-check-circle icoIni"></i> Aceptar</button>
						</div>
					</form>
					<div class="col-sm-2"></div>
				</div>
			</div>
			<div class="col-sm-12 col-md-12 col-lg-6">
				<h4 class="text-center"> <i class="fas fa-list icoIni"></i> Listado Ciclo Escolar</h4>
				<br><br>
				<div class="row">
					<div class="col-sm-12">
						<h5 class="text-left text-success"><b>Activos</b></h5>
						<div class="table-responsive">
							<table class="table bg-dark rounded table-bordered table-hover" id="tbListadoCEscolar">
								<thead class="text-white">
									<th>Acciones:</th>
									<th>Ciclo escolar:</th>
									<th>Fecha:</th>
								</thead>
								<tbody class="text-dark"></tbody>
								<tfoot class="text-white">
									<th>Acciones:</th>
									<th>Ciclo escolar:</th>
									<th>Fecha:</th>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
				<br><br>
				<div class="row">
					<div class="col-sm-12">
						<h5 class="text-left text-danger"><b>Inactivos</b></h5>
						<div class="table-responsive">
							<table class="table bg-dark rounded table-bordered table-hover" id="tbListadoCEscolarDesc">
								<thead class="text-white">
									<th>Acciones:</th>
									<th>Carrera:</th>
									<th>Fecha:</th>
								</thead>
								<tbody class="text-dark"></tbody>
								<tfoot class="text-white">
									<th>Acciones:</th>
									<th>Carrera:</th>
									<th>Fecha:</th>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="modal fade" id="editCEsc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  	<div class="modal-dialog modal-dialog-centered" role="document">
	    	<div class="modal-content">
	      		<div class="modal-header">
	        		<h5 class="modal-title" id="exampleModalLabel"> <i class="fas fa-edit icoNav"></i> Editar ciclo escolar</h5>
	        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          		<span aria-hidden="true">&times;</span>
	        		</button>
	      		</div>
		      	<div class="modal-body">
		       		<form class="row" name="formEditCEsc" id="formEditCEsc" method="POST">
		       			<div class="col-sm-1"></div>
		       			<div class="col-sm-10">
		       				<input type="hidden" id="id_ciclo_escolar" name="id_ciclo_escolar">
		       				<div class="form-group">
		       					<label for="nomCEsEdit">Ciclo escolar:</label>
		       					<input type="text" id="nomCEsEdit" name="nomCEsEdit" class="form-control">
		       				</div>
		       			</div>
		       			<div class="col-sm-1"></div>
		      	</div>
		      	<div class="modal-footer">
		        	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        	<button type="submit" class="btn btn-primary">Guardar cambios</button>
		        	</form>
		      	</div>
	    	</div>
	  	</div>
	</div>
	<br><br><br>

	<?php include 'modalsIniAdm.php'; ?>
	<?php include 'footer.php'; ?>
    <!--- Personalizados -->
    <script src="../vistas/modulos/adm/js/confDatCont.js"></script>
	<script src="../vistas/modulos/adm/js/cicloesc.js"></script>
</body>
</html>

<?php		
	} else {
		header("Location:Logout.php");
	}
?>	
<?php	
	ob_end_flush();
}

?>