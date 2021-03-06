<?php 

session_start();

if ($_SESSION['keyCor'] == "" || $_SESSION['keyCor'] == null) {
	header("Location:../Index.php");
} else {
	include '../modelos/coordinador.modelo.php';
	$cordinador = new Coordinador();
	$dbc = new Connect();
	$dbc = $dbc -> getDB();
	$keyCor = $_SESSION['keyCor'];
	$datCor = $cordinador->userCorDet($keyCor);
	if ($datCor) {
		$maleAll = "MasculinoALL";
		$femaAll = "FemeninoALL";
		$NA = "NA";
		
?>

	<?php include 'header2.php'; ?>
	<br><br><br><br>
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
                            	<b>"</b> Todo el mundo tiene talento, solo es cuesti??n de moverse hasta descubrirlo. <b>"</b>
                            </p>
                            <footer class="blockquote-footer"><cite title="Source Title">George Lucas</cite></footer>
                            </blockquote>
                        </div>
                    </div><!-- Comentarios -->
                </div>
			</div>
			<div class="col-md-8 col-lg-9">
				<div class="text-center bg-primary p-1" style="border-radius: 8px;">
					<h4 class="text-center text-white mt-3">Reportes</h4>
				</div>
				<div class="row mt-5">
					<div class="col-sm-12">
						<h3 class="text-center">
							Reportes general de todas las carreras de la universidad por sexo:
						</h3>
						<div class="mt-5 text-center">
							<a target="_blank" href="ImpReport.php?v=<?php echo base64_encode($NA);?>&&vr=<?php echo base64_encode($maleAll);?>" class="btn btn-primary mr-2">
								<i class="fas fa-male mr-2"></i>
								Masculinos
							</a>
							<a target="_blank" href="ImpReport.php?v=<?php echo base64_encode($NA);?>&&vr=<?php echo base64_encode($femaAll);?>" class="btn btn-primary">
								<i class="fas fa-female mr-2"></i>
								Femeninos
							</a>
						</div>
					</div>
				</div>
				<div class="row mt-5">
					<div class="col-sm-12">
						<h3 class="text-center">
							Selecciona la carrera para ver las opciones de generar reportes.
						</h3>
					</div>
					<div class="card-columns col-sm-12 mt-5">
						<?php 
							$valid = 1;
							$stmt = $dbc -> prepare("SELECT * FROM carreras WHERE estado_car = :valid");
							$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
							$stmt -> execute();
							while ($res = $stmt -> fetch(PDO::FETCH_OBJ)) {
						?>
							<div class="card">
								<div class="cardShadow p-3">
									<h5 class="card-title text-center text-info">
										<?php echo $res->nombre_car; ?>
									</h5>
									<div class="text-center">
										<a href="ReportCar.php?v=<?php echo base64_encode($res->id_carrera); ?>" class="btn btn-primary badge-pill">
											<i class="fas fa-plus"></i>
										</a>
									</div>
								</div>
							</div>
						<?php
							}
						?>	
					</div>
					
				</div>
			</div>
		</div>
	</div>

	<br><br><br>
	<?php include 'modalsconfdat.php'; ?>
	<?php include 'footer2.php'; ?>

    <!--- Personalizados -->
    <script src="../vistas/modulos/cor/js/confContDatCor.js"></script>
    <script type="text/javascript">
    	$(function(){
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
    	});
    </script>
</body>
</html>

<?php		
	} else {
		header("Location:../vistas/modulos/cor/Logout.php");
	}
}

?>