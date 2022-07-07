<?php

session_start();

if ($_SESSION['keyDir'] == "" || $_SESSION['keyDir'] == null) {
	header("Location:../Index.php");
} else {
	include '../modelos/director.modelo.php';
	$director = new Director();
	$datDirec = $director->userDirDet($_SESSION['keyDir']);
	if ($datDirec) {
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
								if ($datDirec -> foto_perf_dir != "") {
							?>
								<img src="../moddir/perfilFot/<?php echo $datDirec->foto_perf_dir; ?>" class='rounded-circle' width='100px'>
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
                        	<?php echo $datDirec -> nombre_c_dir; ?>
                        </h6>
						<h6 class=" text-left mt-3">
							<i class="fas fa-envelope fa-lg icoIni"></i>
							<?php echo $datDirec -> correo_dir; ?>
						</h6>
						<h6 class=" text-left mt-3">
							<i class="fas fa-phone fa-lg icoIni"></i>
							<?php echo $datDirec -> telefono_dir; ?>
						</h6>
						<hr class="bg-info mt-4" style="height: 2px;">
						<h6 class="text-center text-info">
							<b>Director</b>
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
						<?php echo "Dirección de: ".$datDirec->nombre_car; ?>
					</h4>
				</div>
				<h5 class="text-center mt-4">
					<i class="fas text-info fa-plus icoIni fa-lg"></i>
					Registrar Tutor
				</h5>
				<form class="row" method="POST" id="formRegTutor" name="formRegTutor">
					<div class="col-sm-12 col-md-12 col-lg-1"></div>
					<div class="col-sm-12 col-md-12 col-lg-10">
						<hr style="height: 2px;" class="bg-info rounded">
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label for="nomTut">Nombre completo:</label>
									<input type="text" id="nomTut" name="nomTut" class="form-control text-capitalize">
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label for="corTut">Correo:</label>
									<input onkeyup="validEmail()" type="email" id="corTut" name="corTut" class="form-control">
									<div style="font-size: 16px;" id="textcorr" class="text-center"></div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="dirTut">Dirección:</label>
							<input type="text" id="dirTut" name="dirTut" class="form-control">
						</div>
						<div class="row">
							<div class="col-sm-12 col-md-6 col-lg-6 form-group">
								<label for="passTut">Contraseña:</label>
								<input onkeyup="segCont(), contIgul()" type="password" class="form-control" id="passTut" name="passTut">
								<label id="mensaje" class="ocult"></label>
							</div>
							<div class="col-sm-12 col-md-6 col-lg-6 form-group">
								<label for="repPassTut">Repetir contraseña:</label>
								<input onkeyup="contIgul()" type="password" class="form-control" id="repPassTut" name="repPassTut">
								<label id="mensaje2" class="ocult"></label>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12 col-md-6 col-lg-6 form-group">
								<label for="edaTut">Edad:</label>
								<input type="number" class="form-control" id="edaTut" name="edaTut">
							</div>
							<div class="col-sm-12 col-md-6 col-lg-6 form-group">
								<label for="espTut">Especialidad:</label>
								<input type="text" class="form-control" id="espTut" name="espTut">
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12 col-md-6 col-lg-6 form-group">
								<label for="telTut">Telefono:</label>
								<input type="tel" class="form-control" id="telTut" name="telTut" pattern="[0-9]{10}">
							</div>
							<div class="col-sm-12 col-md-6 col-lg-6 form-group">
								<label for="estTut">Estado docente</label>
								<select class="form-control" name="estTut" id="estTut">
									<option value="No" selected="">Selecciona</option>
									<option value="1">Activo</option>
									<option value="0">Inactivo</option>
								</select>
							</div>
						</div>
						<div class="form-group text-center">
							<hr style="height: 2px;" class="bg-info rounded">
							<button id="btnRegTut" class="btn btn-outline-primary btn-md" type="submit">
								<i class="fas fa-check-circle icoIni"></i>
								Aceptar
							</button>
						</div>
					</div>
				</form>
				<div class="row mt-4">
					<div class="col-sm-12">
						<h4 class="text-center">
							<i class="fas fa-list text-info icoIni fa-lg"></i>
							Listado Docentes
						</h4>
						<br>
						<hr style="height: 2px;" class="bg-info rounded">
						<br>
					</div>
				</div>
				<div class="row text-center">
					<div class="col-sm-6">
						<button id="listTutAct" onclick="mostTutAct(true), mostTutDes(false)" id="listGrpAct" class="btn btn-outline-primary btn-md">
							<i class="fas fa-check icoIni"></i>
							Activos
						</button>
					</div>
					<div class="col-sm-6">
						<button id="listTutDes" onclick="mostTutDes(true), mostTutAct(false)" id="listGrpDes" class="btn btn-outline-danger btn-md">
							<i class="fas fa-times icoIni"></i>
							Inactivos
						</button>
					</div>
				</div>
				<div class="row mt-4">
					<div class="col-sm-12 text-center ocult" id="tbListadoTutoresAct">
						<div class="table-responsive">
							<table class="table bg-white table-hover table-bordered rounded" id="tbListadoTutores">
								<thead class="text-primary">
									<th>Nombre:</th>
									<th>Correo:</th>
									<th>Telefono:</th>
									<th>Acciones:</th>
								</thead>
								<tbody class="text-dark"></tbody>
								<tfoot class="text-primary">
									<th>Nombre:</th>
									<th>Correo:</th>
									<th>Telefono:</th>
									<th>Acciones</th>
								</tfoot>
							</table>
						</div>
					</div>
					<div class="col-sm-12 text-center ocult" id="tbListadoTutoresDes">
						<div class="table-responsive">
							<table class="table bg-white table-hover table-bordered rounded" id="tbListadoTutoresInac">
								<thead class="text-primary">
									<th>Nombre:</th>
									<th>Correo:</th>
									<th>Telefono:</th>
									<th>Registro:</th>
									<th>Acciones:</th>
								</thead>
								<tbody class="text-dark"></tbody>
								<tfoot class="text-primary">
									<th>Nombre:</th>
									<th>Correo:</th>
									<th>Telefono:</th>
									<th>Registro:</th>
									<th>Acciones:</th>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php include 'modalsconf.php'; ?>
	<br><br><br>
	<?php include 'footer2.php'; ?>
    <script src="../vistas/modulos/dir/js/confDatContDir.js"></script>
    <script src="../vistas/modulos/dir/js/regTutores.js"></script>
</body>
</html>
<?php		
	} else {
		header("Location:../vistas/modulos/dir/Logout.php");
	}
}

?>