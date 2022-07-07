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
	<?php include 'header.php'; ?>
	<br><br>
	<style type="text/css">
		body {
			background-color: #EEEEEE;
			/*background-color: #FAFAFA;*/
			/*background-color: #ECEFF1;*/
		}
		.colLet {
			color : #EEEEEE;
		}
		.bgNav {
			/*1B5E20*/
			background-color: #28a745;
		}
		.ocult {
			display: none;
		}
		.bgSld {
			background: rgba(255, 255, 255, 0.6);
			color:#263238;
			border-radius: 10px;
		}
		.ocult{
			display: none;
		}
		.cardBg {
			background: #67B26F;
			background: -webkit-linear-gradient(left, #4ca2cd, #67B26F);
			background: -o-linear-gradient(left, #4ca2cd, #67B26F);
			background: linear-gradient(to right, #4ca2cd, #67B26F);
		}
	</style>
	<div class="container-fluid">
		<div class="row ocult text-center" id="estadic">
			<div class="col-sm-12">
				<h2 class="text-center text-success text-capitalize">
					<i class="fas fa-chart-bar fa-lg icoIni"></i>
					Estadisticas del sistema
				</h2>
				<br>
				<hr style="height: 2px;" class="bgNav rounded">
				<br>
				<div class="row">
					<div class="col-sm-6 col-md-6 col-lg-3 text-center">
						<div class="card cardShadow rounded">
						  	<div class="card-body text-center">
						    	<h1 class="card-title threeD text-success"> 
						    		<i id="icoCar" class="fas fa-university"></i> 
						    		<span id="cantTotCar"></span>
						    	</h1>
						    	<label class="labEst text-success">Carreras</label>
						    	<hr style="height: 2px;" class="bg-success">
						    	<div class="row bg-success colLet pad10 rounded">
						    		<div class="col-lg-6 border-right border-light">
							    		<h5 class="marg0"> 
							    			<span id="cantTotCarAct"></span> 
							    			Activas
							    		</h5>
							    	</div>
							    	<div class="col-lg-6">
							    		<h5 class="marg0"> 
							    			<span id="cantTotCarDes"></span>
							    			Inactivas
							    		</h5>
							    	</div>
						    	</div>
						  	</div>
						</div>
						<br><br>
					</div>
					<div class="col-sm-6 col-md-6 col-lg-3 text-center">
						<div class="card cardShadow rounded">
						  	<div class="card-body text-center">
						    	<h1 class="card-title threeD text-success"> 
						    		<i id="icoDoc" class="fas fa-chalkboard-teacher"></i> 
						    		<span id="cantTotDoc"></span>
						    	</h1>
						    	<label class="labEst text-success">Docentes </label>
						    	<hr style="height: 2px;" class="bg-success">
						    	<div class="row bg-success colLet pad10 rounded">
						    		<div class="col-lg-6 border-right border-light">
							    		<h5 class="marg0"> 
							    			<span id="cantTotDocAct"></span>
							    			Activos
							    		</h5>
							    	</div>
							    	<div class="col-lg-6">
							    		<h5 class="marg0">
							    			<span id="cantTotDocDes"></span>
							    			Inactivos
							    		</h5>
							    	</div>
						    	</div>
						  	</div>
						</div>
						<br><br>
					</div>
					<div class="col-sm-6 col-md-6 col-lg-3 text-center">
						<div class="card cardShadow rounded">
						  	<div class="card-body text-center">
						    	<h1 class="card-title threeD text-success"> 
						    		<i id="icoDir" class="fas fa-user-tie"></i> 
						    		<span id="cantTotDir"></span>
						    	</h1>
						    	<label class="labEst text-success">Directores</label>
						    	<hr style="height: 2px;" class="bg-success">
						    	<div class="row bg-success colLet pad10 rounded">
						    		<div class="col-lg-6 border-right border-light">
							    		<h5 class="marg0">
							    			<span id="cantTotDirAct"></span>
							    			Activos
							    		</h5>
							    	</div>
							    	<div class="col-lg-6">
							    		<h5 class="marg0">
							    			<span id="cantTotDirDes"></span>
							    			Inactivos
							    		</h5>
							    	</div>
						    	</div>
						  	</div>
						</div>
						<br><br>
					</div>
					<div class="col-sm-6 col-md-6 col-lg-3 text-center">
						<div class="card cardShadow rounded">
						  	<div class="card-body text-center">
						    	<h1 class="card-title threeD text-success"> 
						    		<i id="icoAlm" class="fas fa-users icoIni"></i> 
						    		<span id="cantTotAlm"></span>
						    	</h1>
						    	<label class="labEst text-success">Alumnos</label>
						    	<hr style="height: 2px;" class="bg-success">
						    	<div class="row bg-success colLet pad10 rounded">
						    		<div class="col-lg-6 border-right border-light">
							    		<h5 class="marg0">
							    			<span id="cantTotAlmAct"></span>
							    			Activos
							    		</h5>
							    	</div>
							    	<div class="col-lg-6">
							    		<h5 class="marg0">
							    			<span id="cantTotAlmDes"></span>
							    			Inactivos
							    		</h5>
							    	</div>
						    	</div>
						  	</div>
						</div>
						<br><br>
					</div>
					<div class="col-sm-6 col-md-6 col-lg-3 text-center">
						<div class="card cardShadow rounded">
						  	<div class="card-body text-center">
						    	<h1 class="card-title threeD text-success"> 
						    		<i id="icoCor" class="fas fa-user icoIni"></i> 
						    		<span id="cantTotCor"></span>
						    	</h1>
						    	<label class="labEst text-success">Coordinadores</label>
						    	<hr style="height: 2px;" class="bg-success">
						    	<div class="row bg-success colLet pad10 rounded">
						    		<div class="col-lg-6 border-right border-light">
							    		<h5 class="marg0">
							    			<span id="cantCorAct"></span>
							    			Activos
							    		</h5>
							    	</div>
							    	<div class="col-lg-6">
							    		<h5 class="marg0">
							    			<span id="cantCorDes"></span>
							    			Inactivos
							    		</h5>
							    	</div>
						    	</div>
						  	</div>
						</div>
						<br><br>
					</div>
					<div class="col-sm-6 col-md-6 col-lg-3 text-center">
						<div class="card cardShadow rounded">
						  	<div class="card-body text-center">
						    	<h1 class="card-title threeD text-success"> 
						    		<i id="icoJus" class="fas fa-file-alt icoIni"></i> 
						    		<span id="cantJusTot"></span>
						    	</h1>
						    	<label class="labEst text-success">Justificantes</label>
						    	<hr style="height: 2px;" class="bg-success">
						    	<div class="row bg-success colLet pad10 rounded">
						    		<div class="col-lg-6 border-right border-light">
							    		<h5 class="marg0">
							    			<span id="cantJusAct"></span>
							    			Aceptados
							    		</h5>
							    	</div>
							    	<div class="col-lg-6">
							    		<h5 class="marg0">
							    			<span id="cantJusDes"></span>
							    			Rechazados
							    		</h5>
							    	</div>
						    	</div>
						  	</div>
						</div>
						<br><br>
					</div>
					<div class="col-sm-6 col-md-6 col-lg-3 text-center">
						<div class="card cardShadow rounded">
						  	<div class="card-body text-center">
						    	<h1 class="card-title threeD text-success"> 
						    		<i id="icoJus" class="fas fa-user-times icoIni"></i> 
						    		<span id="cantTotBaj"></span>
						    	</h1>
						    	<label class="labEst text-success">Alumnos Dados De Baja</label>
						    	<hr style="height: 2px;" class="bg-success">
						    	<div class="row bg-success colLet pad10 rounded">
						    		<div class="col-lg-6 border-right border-light">
							    		<h5 class="marg0">
							    			<span id="cantBajAct"></span>
							    			N / A
							    		</h5>
							    	</div>
							    	<div class="col-lg-6">
							    		<h5 class="marg0">
							    			<span id="cantBajDes"></span>
							    			N / A
							    		</h5>
							    	</div>
						    	</div>
						  	</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-6 col-lg-3 text-center">
						<div class="card cardShadow rounded">
						  	<div class="card-body text-center">
						    	<h1 class="card-title threeD text-success"> 
						    		<i id="icoJus" class="fas fa-edit icoIni"></i> 
						    		<span id="cantTotTest"></span>
						    	</h1>
						    	<label class="labEst text-success">Encuestas Realizadas</label>
						    	<hr style="height: 2px;" class="bg-success">
						    	<div class="row bg-success colLet pad10 rounded">
						    		<div class="col-lg-6 border-right border-light">
							    		<h5 class="marg0">
							    			<span id="cantTotAct"></span>
							    			N / A
							    		</h5>
							    	</div>
							    	<div class="col-lg-6">
							    		<h5 class="marg0">
							    			<span id="cantTotDes"></span>
							    			N / A
							    		</h5>
							    	</div>
						    	</div>
						  	</div>
						</div>
					</div>
				</div>
				<!-- <br>
				<hr style="height: 2px;" class="bgNav rounded"> -->
			</div>
		</div>
	</div>
	<br><br><br>
	<div class="container-fluid">	
		<div class="row ocult" id="func">
			<div class="col-sm-12">
				<h2 class="text-center text-success text-capitalize">
					<i class="fas fa-columns fa-lg icoIni"></i>
					Panel de Control
				</h2>
				<br>
				<hr style="height: 2px;" class="bgNav rounded">
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
								<div class="card cardShadow bg-white text-success mb-3 text-center rounded" style="max-width: 18rem;">
							  		<div class="card-header bg-success text-white">
							  			<h4>Administradores</h4> 
							  		</div>
						  			<div class="card-body">
						  				<?php 
						  					if ($datAdmin->privileg == "ALL") {
						  						echo "<a href='Admin.php' class='btn btn-success btn-lg'> <i class='fas fa-plus icoIni'></i> Detalles </a>";
						  					} else if ($datAdmin->privileg == "LIM") {
						  						echo "<a href='#' class='btn btn-success btn-lg disabled'> <i class='fas fa-plus icoIni'></i> Detalles </a>";
						  					}
						  				?>
						  			</div>
								</div>
							</div>
							<div class="col-sm-6 col-md-6 col-lg-6">
								<div class="card cardShadow bg-white text-success mb-3 text-center rounded" style="max-width: 18rem;">
						  			<div class="card-header bg-success text-white">
						  				<h4>Carreras</h4>
						  			</div>
								  	<div class="card-body">
								  		<a href="Carreras.php" class="btn btn-success btn-lg"> <i class="fas fa-plus icoIni"></i> Detalles </a>
								  	</div>
								</div>
							</div>
							<div class="col-sm-6 col-md-6 col-lg-6">
								<div class="card cardShadow bg-white text-success mb-3 text-center rounded" style="max-width: 18rem;">
						  			<div class="card-header bg-success text-white"">
						  				<h4>Directores</h4>
						  			</div>
								  	<div class="card-body">
								  		<a href="Directores.php" class="btn btn-success btn-lg"> <i class="fas fa-plus icoIni"></i> Detalles </a>
								  	</div>
								</div>
							</div>
							<div class="col-sm-6 col-md-6 col-lg-6">
								<div class="card cardShadow bg-white text-success mb-3 text-center rounded" style="max-width: 18rem;">
						  			<div class="card-header bg-success text-white">
						  				<h4>Coordinadores</h4>
									</div>
								  	<div class="card-body">
								  		<a href="DetCoord.php" class="btn btn-success btn-lg"> <i class="fas fa-plus icoIni"></i> Detalles </a>
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
	<?php include 'footer.php'; ?>
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