<?php 

session_start();

if ($_SESSION['keyCor'] == "" || $_SESSION['keyCor'] == null) {
	header("Location:../Index.php");
} else {
	include '../modelos/coordinador.modelo.php';
	$cordinador = new Coordinador();
	$keyCor = $_SESSION['keyCor'];
	$datCor = $cordinador->userCorDet($keyCor);
	$clvCar = base64_decode($_SESSION['clvCar']);
	$valGrp = $_GET['v'];
	$_SESSION['clvGrp'] = $valGrp;
	if ($datCor) {
		$datValGC = $cordinador -> datGrpCarSel(base64_decode($valGrp),$clvCar);
		if ($datValGC) {
			include 'header2.php';
?>
	<br><br><br><br>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<a href="DetCar.php?v=<?php echo base64_encode($clvCar); ?>" class="btn bg-white cardShadow text-primary btn-md">
					<i class="fas fa-arrow-left fa-lg icoIni"></i>
					Regresar
				</a>
			</div>
		</div>
	</div>
	
	<div class="container-fluid mt-4">
		<div class="row">
			<div class="col-md-4 col-lg-3">
				<!-- SobreMi -->
                <div class="container py-5">
                    <div class="card shDC">
                        <img class="card-img-top" src="../vistas/img/iceland.jpg" alt="Card image cap">
                        <div class="text-center margen-avatar">
                        	<?php 
								if ($datCor -> foto_perf_cor == "") {
							?>
								<img src='perfilFot/<?php echo $datCor->foto_perf_cor; ?>"' class='rounded-circle' width='100px'>
							<?php
								} else {
							?>
								<img src='../vistas/img/usermal.png' class='rounded-circle' width='100px'>
							<?php
								}
							?>
                        </div>
                        <div class="card-body text-center">
                        <h6 class="card-title font-weight-bold">
                        	<?php echo $datCor -> nombre_c_cor; ?>
                        </h6>
						<h6 class=" text-left mt-3">
							<i class="fas fa-envelope fa-lg icoIni"></i>
							<?php echo $datCor -> correo_cor; ?>
						</h6>
						<h6 class=" text-left mt-3">
							<i class="fas fa-phone fa-lg icoIni"></i>
							<?php echo $datCor -> telefono_cor; ?>
						</h6>
						<hr class="bg-info mt-4" style="height: 2px;">
						<h6 class="text-center text-info">
							<b>Coordinador</b>
						</h6>
                        </div>
                    </div>
                </div><!-- SobreMi -->
                <div class="container">
                    <!-- Comentarios -->
                    <div class="card">
                        <div class="card-header text-center">
                            Frase Celebre
                        </div>
                        <div class="card-body">
                            <blockquote class="blockquote mb-0">
                            <p class="font-italic text-info">
                            	<b>"</b> Todo el mundo tiene talento, solo es cuestión de moverse hasta descubrirlo. <b>"</b>
                            </p>
                            <footer class="blockquote-footer"><cite title="Source Title">George Lucas</cite></footer>
                            </blockquote>
                        </div>
                    </div><!-- Comentarios -->
                </div>
			</div>
			<div class="col-md-8 col-lg-9">
				<div class="text-center bg-primary p-1" style="border-radius: 8px;">
					<h4 class="text-center text-white mt-3">
						<?php echo $datValGC->nombre_car; ?>, Grupo : <b><?php echo $datValGC->grupo_n; ?></b>
					</h4>
				</div>
				<div class="row mt-5">
					<div class="col-sm-12">
						<div class="table-responsive">
							<table class="table bg-white rounded table-bordered table-hover" id="tbListadoAlmGrpCar">
								<thead class="text-primary">
									<th>Nombre:</th>
									<th>Matricula:</th>
									<th>Correo:</th>
									<th>Acciones:</th>
								</thead>
								<tbody class="text-info"></tbody>
								<tfoot class="text-primary">
									<th>Nombre:</th>
									<th>Matricula:</th>
									<th>Correo:</th>
									<th>Acciones:</th>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<br><br><br>
	<?php include 'footer2.php'; ?>
    <!--- Personalizados -->
    <script src="../vistas/modulos/cor/js/listGrpCar.js"></script>
</body>
</html>

<?php
		} else {
			header("Location:../vistas/modulos/cor/Logout.php");
		}		
	} else {
		header("Location:../vistas/modulos/cor/Logout.php");
	}
}

?>