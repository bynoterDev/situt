<?php 

ob_start();
session_start();

if ($_SESSION['keyAdm'] == "" || $_SESSION['keyAdm'] == null) {
	header("Location:../Index.php");
} else {
	include '../modelos/admin.modelo.php';
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
	<?php include 'header2.php'; ?>
	<style type="text/css">
		body{
			background: white !important;
		}
	</style>
	<br><br><br><br>
	<div class="container-fluid">
		<div class="row ocult text-center" id="estadic">
			<div class="col-sm-12">
				<h2 class="text-center text-info text-capitalize animated fadeInDown">
					<i class="fas fa-chart-bar fa-lg icoIni"></i>
					Estadisticas del sistema
				</h2>
				<hr style="height: 2px;" class="bg-info rounded animated fadeIn delay-1s">
				<br>
				<div class="row animated fadeInUp delay-2s">
					<div class="col-sm-6 col-md-6 col-lg-3 text-center">
						<div class="card cardShadow rounded">
						  	<div class="card-body text-center">
						    	<h4 class="card-title text-info"> 
						    		<i id="icoCar" class="fas fa-university"></i> 
						    		<span id="cantTotCar">
						    			<b>Cargando...</b>
						    		</span>
						    	</h4>
						    	<label class="labEst text-primary">Carreras</label>
						    	<hr style="height: 2px;" class="bg-info">
						    	<div class="row bg-info colLet pad10 rounded">
						    		<div class="col-lg-6 border-right border-white">
							    		<h6 class="marg0 text-white"> 
							    			<span id="cantTotCarAct"></span> 
							    			Activas
							    		</h6>
							    	</div>
							    	<div class="col-lg-6">
							    		<h6 class="marg0 text-white"> 
							    			<span id="cantTotCarDes"></span>
							    			Inactivas
							    		</h6>
							    	</div>
						    	</div>
						  	</div>
						</div>
						<br><br>
					</div>
					<div class="col-sm-6 col-md-6 col-lg-3 text-center">
						<div class="card cardShadow rounded">
						  	<div class="card-body text-center">
						    	<h4 class="card-title text-info"> 
						    		<i id="icoDoc" class="fas fa-chalkboard-teacher"></i> 
						    		<span id="cantTotDoc">
						    			<b>Cargando...</b>
						    		</span>
						    	</h4>
						    	<label class="labEst text-primary">Docentes </label>
						    	<hr style="height: 2px;" class="bg-info">
						    	<div class="row bg-info pad10 rounded">
						    		<div class="col-lg-6 border-right border-white">
							    		<h6 class="marg0 text-white"> 
							    			<span id="cantTotDocAct"></span>
							    			Activos
							    		</h6>
							    	</div>
							    	<div class="col-lg-6">
							    		<h6 class="marg0 text-white">
							    			<span id="cantTotDocDes"></span>
							    			Inactivos
							    		</h6>
							    	</div>
						    	</div>
						  	</div>
						</div>
						<br><br>
					</div>
					<div class="col-sm-6 col-md-6 col-lg-3 text-center">
						<div class="card cardShadow rounded">
						  	<div class="card-body text-center">
						    	<h4 class="card-title text-info"> 
						    		<i id="icoDir" class="fas fa-user-tie"></i> 
						    		<span id="cantTotDir">
						    			<b>Cargando...</b>
						    		</span>
						    	</h4>
						    	<label class="labEst text-primary">Directores</label>
						    	<hr style="height: 2px;" class="bg-info">
						    	<div class="row bg-info colLet pad10 rounded">
						    		<div class="col-lg-6 border-right border-white">
							    		<h6 class="marg0 text-white">
							    			<span id="cantTotDirAct"></span>
							    			Activos
							    		</h6>
							    	</div>
							    	<div class="col-lg-6">
							    		<h6 class="marg0 text-white">
							    			<span id="cantTotDirDes"></span>
							    			Inactivos
							    		</h6>
							    	</div>
						    	</div>
						  	</div>
						</div>
						<br><br>
					</div>
					<div class="col-sm-6 col-md-6 col-lg-3 text-center">
						<div class="card cardShadow rounded">
						  	<div class="card-body text-center">
						    	<h4 class="card-title text-info"> 
						    		<i id="icoAlm" class="fas fa-users icoIni"></i> 
						    		<span id="cantTotAlm">
						    			<b>Cargando...</b>
						    		</span>
						    	</h4>
						    	<label class="labEst text-primary">Alumnos</label>
						    	<hr style="height: 2px;" class="bg-info">
						    	<div class="row bg-info colLet pad10 rounded">
						    		<div class="col-lg-6 border-right border-white">
							    		<h6 class="marg0 text-white">
							    			<span id="cantTotAlmAct"></span>
							    			Activos
							    		</h6>
							    	</div>
							    	<div class="col-lg-6">
							    		<h6 class="marg0 text-white">
							    			<span id="cantTotAlmDes"></span>
							    			Inactivos
							    		</h6>
							    	</div>
						    	</div>
						  	</div>
						</div>
						<br><br>
					</div>
					<div class="col-sm-6 col-md-6 col-lg-3 text-center">
						<div class="card cardShadow rounded">
						  	<div class="card-body text-center">
						    	<h4 class="card-title text-primary"> 
						    		<i id="icoCor" class="fas fa-user icoIni"></i> 
						    		<span id="cantTotCor">
						    			<b>Cargando...</b>
						    		</span>
						    	</h4>
						    	<label class="labEst text-primary">Coordinadores</label>
						    	<hr style="height: 2px;" class="bg-info">
						    	<div class="row bg-info colLet pad10 rounded">
						    		<div class="col-lg-6 border-right border-light">
							    		<h6 class="marg0 text-white">
							    			<span id="cantCorAct"></span>
							    			Activos
							    		</h6>
							    	</div>
							    	<div class="col-lg-6">
							    		<h6 class="marg0 text-white">
							    			<span id="cantCorDes"></span>
							    			Inactivos
							    		</h6>
							    	</div>
						    	</div>
						  	</div>
						</div>
						<br><br>
					</div>
					<div class="col-sm-6 col-md-6 col-lg-3 text-center">
						<div class="card cardShadow rounded">
						  	<div class="card-body text-center">
						    	<h4 class="card-title text-info"> 
						    		<i id="icoJus" class="fas fa-file-alt icoIni"></i> 
						    		<span id="cantJusTot">
						    			<b>Cargando...</b>
						    		</span>
						    	</h4>
						    	<label class="labEst text-primary">Justificantes</label>
						    	<hr style="height: 2px;" class="bg-info">
						    	<div class="row bg-info colLet pad10 rounded">
						    		<div class="col-lg-6 border-right border-white">
							    		<h6 class="marg0 text-white">
							    			<span id="cantJusAct"></span>
							    			Aceptados
							    		</h6>
							    	</div>
							    	<div class="col-lg-6">
							    		<h6 class="marg0 text-white">
							    			<span id="cantJusDes"></span>
							    			Rechazados
							    		</h6>
							    	</div>
						    	</div>
						  	</div>
						</div>
						<br><br>
					</div>
					<div class="col-sm-6 col-md-6 col-lg-3 text-center">
						<div class="card cardShadow rounded">
						  	<div class="card-body text-center">
						    	<h4 class="card-title text-info"> 
						    		<i id="icoJus" class="fas fa-user-times icoIni"></i> 
						    		<span id="cantTotBaj">
						    			<b>Cargando...</b>
						    		</span>
						    	</h4>
						    	<label class="labEst text-primary">Alumnos Dados De Baja</label>
						    	<hr style="height: 2px;" class="bg-info">
						    	<div class="row bg-info colLet pad10 rounded">
						    		<div class="col-lg-6 border-right border-white">
							    		<h6 class="marg0 text-white">
							    			<span id="cantBajAct"></span>
							    			N / A
							    		</h6>
							    	</div>
							    	<div class="col-lg-6">
							    		<h6 class="marg0 text-white">
							    			<span id="cantBajDes"></span>
							    			N / A
							    		</h6>
							    	</div>
						    	</div>
						  	</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-6 col-lg-3 text-center">
						<div class="card cardShadow rounded">
						  	<div class="card-body text-center">
						    	<h4 class="card-title text-info"> 
						    		<i id="icoJus" class="fas fa-edit icoIni"></i> 
						    		<span id="cantTotTest">
						    			<b>Cargando...</b>
						    		</span>
						    	</h4>
						    	<label class="labEst text-primary">Encuestas Realizadas</label>
						    	<hr style="height: 2px;" class="bg-info">
						    	<div class="row bg-info colLet pad10 rounded">
						    		<div class="col-lg-6 border-right border-light">
							    		<h6 class="marg0 text-white">
							    			<span id="cantTotAct"></span>
							    			N / A
							    		</h6>
							    	</div>
							    	<div class="col-lg-6">
							    		<h6 class="marg0 text-white">
							    			<span id="cantTotDes"></span>
							    			N / A
							    		</h6>
							    	</div>
						    	</div>
						  	</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<br><br><br>
	<div class="container-fluid">	
		<div class="row ocult" id="func">
			<div class="col-sm-12">
				<h2 class="text-center text-info text-capitalize">
					<i class="fas fa-columns fa-lg icoIni"></i>
					Panel de Control
				</h2>
				<hr style="height: 2px;" class="bg-info rounded">
				<br>
				<div class="row">
					<div class="col-sm-12 col-md-12 col-lg-5 text-center">
						<br>
						<img src="../vistas/img/icous.png" width="300" alt="" class="img-fluid">
					</div>
					<div class="col-sm-12 col-md-12 col-lg-1"></div>
					<div class="col-sm-12 col-md-12 col-lg-6">
						<br>
						<div class="row">
							<div class="col-sm-6 col-md-6 col-lg-6">
								<div class="card cardShadow bg-white text-primary mb-3 text-center rounded" style="max-width: 18rem;">
							  		<div class="card-header bg-info text-white">
							  			<h4>Administradores</h4> 
							  		</div>
						  			<div class="card-body">
						  				<?php 
						  					if ($datAdmin->privileg == "ALL") {
						  						echo "<a href='Admin.php' class='btn btn-outline-primary btn-md'> <i class='fas fa-plus icoIni'></i> Detalles </a>";
						  					} else if ($datAdmin->privileg == "LIM") {
						  						echo "<a href='#' class='btn btn-outline-primary btn-md disabled'> <i class='fas fa-plus icoIni'></i> Detalles </a>";
						  					}
						  				?>
						  			</div>
								</div>
							</div>
							<div class="col-sm-6 col-md-6 col-lg-6">
								<div class="card cardShadow bg-white text-primary mb-3 text-center rounded" style="max-width: 18rem;">
						  			<div class="card-header bg-info text-white">
						  				<h4>Carreras</h4>
						  			</div>
								  	<div class="card-body">
								  		<a href="Carreras.php" class="btn btn-outline-primary btn-md"> <i class="fas fa-plus icoIni"></i> Detalles </a>
								  	</div>
								</div>
							</div>
							<div class="col-sm-6 col-md-6 col-lg-6">
								<div class="card cardShadow bg-white text-primary mb-3 text-center rounded" style="max-width: 18rem;">
						  			<div class="card-header bg-info text-white"">
						  				<h4>Directores</h4>
						  			</div>
								  	<div class="card-body">
								  		<a href="Directores.php" class="btn btn-outline-primary btn-md"> <i class="fas fa-plus icoIni"></i> Detalles </a>
								  	</div>
								</div>
							</div>
							<div class="col-sm-6 col-md-6 col-lg-6">
								<div class="card cardShadow bg-white text-primary mb-3 text-center rounded" style="max-width: 18rem;">
						  			<div class="card-header bg-info text-white">
						  				<h4>Coordinadores</h4>
									</div>
								  	<div class="card-body">
								  		<a href="DetCoord.php" class="btn btn-outline-primary btn-md"> <i class="fas fa-plus icoIni"></i> Detalles </a>
								  	</div>
								</div>
							</div>
						</div>	
					</div>
				</div>
			</div>
		</div>
	</div>
	<br><br><br>

	<?php include 'modalsIniAdm.php'; ?>
	<?php include 'footer2.php'; ?>
    <script src="../vistas/modulos/adm/js/confDatCont.js"></script>
    <script src="../vistas/modulos/adm/js/notifPanel.js"></script>
    <!--- Personalizados -->
    <script type="text/javascript">
    	$(document).ready(function(){
    		$("#estadic").fadeIn(2500).show();
    		$("#estadic").removeClass("ocult");
    		setTimeout(function() {
    			$("#func").fadeIn(2500).show();
    			$("#func").removeClass("ocult");
    		}, 1000);
    	});
    </script>
</body>
</html>

<?php		
	} else {
		header("Location:../Logout.php");
	}
	ob_end_flush();	
}
?>