<?php 

ob_start(); 
session_start();
if ($_SESSION['keyAlm'] == "" || $_SESSION['keyAlm'] == null) {
	header("Location:../Index.php");
} else {
	include '../modelos/alumno.modelo.php';
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
	<?php include 'header2.php'; ?>

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
	<div class="container">
		<div class="row">
			<div class="col-sm-12 text-right">
				<?php 
					if ($datAlm -> id_detgrupo != "" && $datAlm -> acept_grp == 1) {
				?>
					<button class="btn bg-white text-primary cardShadow btn-md dropdown-toggle mr-3" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				    Justificantes <i id="bell" class="fas fa-bell fa-lg icoPri"></i>
				    	<span class="lead icoIni icoPri" id="cantNotifNum"></span>
				  	</button>
				  	<div class="dropdown-menu" style="width: 500px;" aria-labelledby="dropdownMenuLink">
				  		<div class="container-fluid listNot">
				  		</div>
					</div>
					<div class="btn-group mr-3">
					  	<button class="btn text-primary bg-white cardShadow btn-md dropdown-toggle" href="#" role="button" id="dropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					    Tutorías <i id="bell" class="fas fa-bell fa-lg icoPri"></i>
					    	<span class="lead icoIni icoPri" id="cantNotifTut"></span>
					  	</button>
					  	<div class="dropdown-menu" style="width: 500px;" aria-labelledby="dropdownMenuLink2">
					  		<div class="container-fluid listTut">
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
    <?php 
        if ($datAlm -> id_detgrupo != "") {
            if ($datGrpAlm -> acept_grp == 0) {
    ?>
        <div class="container">
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-10">
                    <div class="alert alert-danger" role="alert">
                        Aún no has sido aceptado en el grupo, algunas funciones estarán desactivadas hasta que seas aceptado.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="col-sm-1"></div>
            </div>
        </div>
    <?php
            }
        }
    ?>
	<div class="container-fluid mt-4">
		<div class="row">
			<div class="col-md-4 col-lg-3">
				<!-- SobreMi -->
                <div class="container py-5">
                    <div class="card shDC">
                        <img class="card-img-top" src="../vistas/img/iceland.jpg" alt="Card image cap">
                        <div class="text-center margen-avatar">
                        	<?php 
								if ($datAlm -> foto_perf_alm == "" && $datAlm -> sexo_al == "Masculino") {
									echo "<img src='../vistas/img/usermal.png' class='rounded-circle' width='100px'>";
								} else if ($datAlm -> foto_perf_alm != "" && $datAlm -> sexo_al == "Masculino") {
							?>
								<img src="Arch/perfil/<?php echo $datAlm->foto_perf_alm ?>" class="rounded-circle" width="100px">
							<?php
								} else if ($datAlm -> foto_perf_alm == "" && $datAlm -> sexo_al == "Femenino") {
									echo "<img src='../vistas/img/userfem.png' class='rounded-circle' width='100px'>";
								} else if ($datAlm -> foto_perf_alm != "" && $datAlm -> sexo_al == "Femenino") {
							?>
								<img src="Arch/perfil/<?php echo $datAlm->foto_perf_alm ?>" class="rounded-circle" width="100px"">
							<?php
								} else {
									echo "<img src='../vistas/img/icous.png' class='rounded-circle' width='100px'>";
								}
							?>
                        </div>
                        <div class="card-body text-center">
                        <h6 class="card-title font-weight-bold">
                        	<?php echo $datAlm -> nombre_c_al; ?>
                        </h6>
                        <h6 class=" text-left mt-4">
							<i class="fas fa-id-card-alt fa-lg icoIni"></i>
							<?php echo $datAlm -> matricula_al; ?>
						</h6>
						<h6 class=" text-left mt-3">
							<i class="fas fa-envelope fa-lg icoIni"></i>
							<?php echo $datAlm -> correo_al; ?>
						</h6>
						<h6 class=" text-left mt-3">
							<i class="fas fa-phone fa-lg icoIni"></i>
							<?php echo $datAlm -> telefono_al; ?>
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
				<?php 
					if ($datAlm -> id_detgrupo != "") {
				?>
				<div class="text-center bg-primary p-1" style="border-radius: 8px;">
					<h4 class="text-center text-white mt-3">Tablero</h4>
				</div>
				<div class="row">
					<div class="col-md-4 mt-4">
		                <div class="card text-center shDC">
		                    <div class="card-header text-left">
		                    	<a href="Develop.php" class="btn btn-sm btn-info">
                        			<i class="fas fa-info mr-2"></i>
                        			Info
                        		</a>
		                    </div>
		                    <div class="card-body">
		                        <h4 class="card-title"><b>Acerca de</b></h4>
		                        <p class="card-text text-info">
		                           	Desarrolladores involucrados en la realización del proyecto.
		                        </p>
		                        <a href="#" class="btn btn-primary">Detalles</a>
		                    </div>
		                    <div class="card-footer text-muted">
		                        <i class="fas text-info fa-flag fa-lg"></i>
		                    </div>
		                </div>   
		            </div>
            		<div class="col-md-4 mt-4">
                    	<div class="card text-center shDC">
                        	<div class="card-header text-left">
                        		<?php 
                        			if ($datGrpAlm -> acept_grp == 1) {
                        		?>
									<a href="DetJustif.php" class="btn btn-sm btn-info">
	                        			<i class="fas fa-info mr-2"></i>
	                        			Info
	                        		</a>
                        		<?php
                        			} else {
                        		?>
								<a href="#" class="btn btn-sm btn-info disabled">
                        			<i class="fas fa-info mr-2"></i>
                        			Info
                        		</a>
                        		<?php
                        			}
                        		?>
                        	</div>
                        	<div class="card-body">
                            	<h4 class="card-title"><b>Justificantes</b></h4>
                            	<p class="card-text text-info">
                            		Enviar solicitud de justificante al tutor.
                            	</p>
                            	<?php 
                            		if ($datGrpAlm -> acept_grp == 1) {
                            			if ($valTest -> CantidadVal == 1) {
                            	?>
										<a data-backdrop="false" href="#" data-target="#solJustif"
				      					data-toggle="modal" class="btn btn-outline-primary">
				      						Solicitar
				      					</a>
                            	<?php
                            		} else {
                            	?>
									<div class="bg-danger rounded">
										<p class="text-white">
											Completa la entrevista inicial
										</p>
									</div>
                            	<?php
                            		}
                            		} else {
                            	?>
									<a href="#" class="btn btn-outline-primary disabled">Solicitar</a>
                            	<?php
                            		}
                            	?>
                        	</div>
                        	<div class="card-footer text-muted">
                        		<i class="fas text-info fa-file-medical fa-lg"></i>
                        	</div>
                    	</div>   
            		</div>
            		<div class="col-md-4 mt-4">
                    	<div class="card text-center shDC">
                        	<div class="card-header text-left">
                        		<?php 
                        			if ($datGrpAlm -> acept_grp == 1) {
                        		?>
									<a href="#" class="btn btn-sm btn-info">
	                        			<i class="fas fa-info mr-2"></i>
	                        			Info
	                        		</a>
                        		<?php
                        			} else {
                        		?>
								<a href="#" class="btn btn-sm btn-info disabled">
                        			<i class="fas fa-info mr-2"></i>
                        			Info
                        		</a>
                        		<?php
                        			}
                        		?>
                        	</div>
                        	<div class="card-body">
                            	<h4 class="card-title"><b>Encuesta</b></h4>
                            	<p class="card-text text-info">
                            		Realizar entrevista inicial para tutorías
                            	</p>
                            	<?php 
                            		if ($datGrpAlm -> acept_grp == 1) {
                            			if ($valDatPer -> CantDat == 1) {
                            				if ($valTest -> CantidadVal == 1) {
                            					$idEnc = $alumno -> valObtEnc($_SESSION['keyAlm']);
                            	?>
									<a href="TestIniEdit.php?v=<?php echo base64_encode($idEnc->id_enctestalm); ?>" class="btn btn-outline-primary">
						      			Editar
						      		</a>		
                            	<?php
                            				} else {
                            	?>
									<a href="TestIni.php" class="btn btn-outline-primary">Realizar</a>
                            	<?php
                            				}
                            		} else {
                            	?>
									<div class="bg-danger rounded">
										<p class="text-white">
											Completa tus datos personales
										</p>
									</div>
                            	<?php
                            		}
                            		} else {
                            	?>
									<a href="#" class="btn btn-outline-primary disabled">Solicitar</a>
                            	<?php
                            		}
                            	?>
                        	</div>
                        	<div class="card-footer text-muted">
                        		<i class="fas fa-book text-info fa-lg"></i>
                        	</div>
                    	</div>   
            		</div>
            		<div class="col-md-4 mt-4">
                    	<div class="card text-center shDC">
                        	<div class="card-header text-left">
                        		<?php 
                        			if ($datGrpAlm -> acept_grp == 1) {
                        		?>
									<a href="DetTutPer.php" class="btn btn-sm btn-info">
	                        			<i class="fas fa-info mr-2"></i>
	                        			Info
	                        		</a>
                        		<?php
                        			} else {
                        		?>
								<a href="#" class="btn btn-sm btn-info disabled">
                        			<i class="fas fa-info mr-2"></i>
                        			Info
                        		</a>
                        		<?php
                        			}
                        		?>
                        	</div>	
                        	<div class="card-body">
                            	<h4 class="card-title"><b>Tutoría</b></h4>
                            	<p class="card-text">Enviar solicitud de tutoría personal al tutor.</p>
                            	<?php 
                            		if ($datGrpAlm -> acept_grp == 1) {
                            			if ($valTest -> CantidadVal == 1) {
                            	?>
                            		<a data-backdrop="false" data-target="#solTut" data-toggle="modal" href="#" class="btn btn-outline-primary">Solicitar</a>
                            	<?php
                            		} else {
                            	?>
									<div class="bg-danger rounded">
										<p class="text-white">
											Completa la entrevista inicial
										</p>
									</div>
                            	<?php
                            		}
                            		} else {
                            	?>
									<a href="#" class="btn btn-outline-primary disabled">Solicitar</a>
                            	<?php
                            		}
                            	?>
                        	</div>
                        	<div class="card-footer text-muted">
                            	<i class="fas text-info fa-chalkboard-teacher fa-lg"></i>
                        	</div>
                    	</div>   
            		</div>
            		<div class="col-md-4 mt-4">
                    	<div class="card text-center shDC">
                        	<div class="card-header text-left">
                        		<?php 
                        			if ($datGrpAlm -> acept_grp == 1) {
                        		?>
									<a href="#" class="btn btn-sm btn-info">
	                        			<i class="fas fa-info mr-2"></i>
	                        			Info
	                        		</a>
                        		<?php
                        			} else {
                        		?>
								<a href="#" class="btn btn-sm btn-info disabled">
                        			<i class="fas fa-info mr-2"></i>
                        			Info
                        		</a>
                        		<?php
                        			}
                        		?>
                        	</div>	
                        	<div class="card-body">
                            	<h4 class="card-title"><b>Datos Personales</b></h4>
                            	<p class="card-text">
                            		Agregar ó editar sus datos personales
                            	</p>
                            	<?php 
                            		if ($datGrpAlm -> acept_grp == 1) {
                            			if ($valDatPer -> CantDat == 1) {
                            	?>
									<a href="#" data-backdrop="false" data-target="#datPerAlmEdit" data-toggle="modal" class="btn btn-outline-primary">Editar</a>
                            	<?php
                            			} else {
                            	?>
                            		<a href="#" class="btn btn-outline-primary" data-target="#datPerAlm" data-toggle="modal">Completar</a>
                            	<?php
                            		}
                            		} else {
                            	?>
									<a href="#" class="btn btn-outline-primary disabled">Completar</a>
                            	<?php
                            		}
                            	?>
                        	</div>
                        	<div class="card-footer text-muted">
                            	<i class="fas text-info fa-address-book fa-lg"></i>
                        	</div>
                    	</div>   
            		</div>
            		<div class="col-md-4 mt-4">
                    	<div class="card text-center shDC">
                        	<div class="card-header text-left">
                        		<a href="#" class="btn btn-sm btn-info">
                        			<i class="fas fa-info mr-2"></i>
                        			Info
                        		</a>
                        	</div>
                        	<div class="card-body">
                            	<h4 class="card-title"><b>Mi Grupo</b></h4>
                            	<p class="card-text">
                            		Agregar ó actualizar su grupo actual cada cuatrimestre.
                            	</p>
                            	<a href="#" class="btn btn-outline-primary" data-target="#editMyGrp" data-toggle="modal">Editar</a>
                        	</div>
                        	<div class="card-footer text-muted">
                            	<i class="fas text-info fa-users fa-lg"></i>
                        	</div>
                    	</div>   
            		</div>
				</div>
				<?php		
					} else {
				?>
				<br><br>
				<div class="jumbotron jumbotron-fluid rounded mt-5">
				  	<div class="container">
				    	<h1 class="display-4 text-center">Escoje un grupo</h1>
				    	<form class="mt-5" name="formRegGrp" id="formRegGrp" method="POST">
							<div class="row">
								<div class="col-sm-3"></div>
								<div class="col-sm-6 text-primary">
									<div class="form-group">
										<select class="form-control" name="clvDetGrp" id="clvDetGrp">
											<option selected="" value="SN">Selecciona</option>
										<?php 
											try {
												$valid = 1;
												$clvCar = $datAlm -> id_carrera;
												//$dbc = Connect::getDB();
												$dbc = new Connect();
												$dbc = $dbc -> getDB();
												$stmt = $dbc -> prepare("SELECT det.id_detgrupo, grp.grupo_n, doc.nombre_c_doc FROM det_grupo det
													INNER JOIN grupos grp ON grp.id_grupo = det.id_grupo
													INNER JOIN docentes doc ON doc.id_docente = det.id_docente
													INNER JOIN carreras car ON car.id_carrera = det.id_carrera
													WHERE det.estado_detgrp = :valid && det.id_carrera = :clvCar");
												$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
												$stmt -> bindParam("clvCar", $clvCar, PDO::PARAM_INT);
												$stmt -> execute();
												while ($res = $stmt -> fetch(PDO::FETCH_OBJ)) {
										?>
												<option value="<?php echo $res->id_detgrupo; ?>">
													<?php echo $res->grupo_n.", ".$res->nombre_c_doc;?>
												</option>
										<?php
												}
										?>
												
										<?php
											} catch (PDOException $e) {
												echo '{"error":{"text":'. $e->getMessage() .'}}';	
											}
										?>
									</select>
								</div>
							</div>
							<div class="col-sm-3"></div>
						</div>
						<br>
						<div class="text-center">
							<button class="btn btn-md btn-primary">
								Registrar
								<i class="fas fa-check fa-lg icoPri"></i>
							</button>
						</div>
					</form>
				  	</div>
				</div>
				<?php
					}
				?>
			</div>
		</div>
	</div>

	<?php include 'modals/modalJustifSol.php'; ?>
	
	<?php include 'modals/modalDatPerAlm.php'; ?>

	<?php include 'modals/modalEditDatPerAlm.php'; ?>

	<?php include 'modals/EncuestaAlm.php'; ?>

	<?php include 'modals/modalEditGrp.php'; ?>

	<?php include 'modals/modalTutSol.php'; ?>

	<br><br><br>
	<?php include 'modals/modalsconfalm.php'; ?>
	<script src="../vistas/js/jquery-3.1.1.min.js"></script>
	<!-- SweetAlert -->
    <script src="../vistas/node_modules/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vistas/Assets/js/vendor/popper.min.js"></script>
    <script src="../vistas/Js/bootstrap.min.js"></script>
    <script src="../vistas/assets/js/vendor/holder.min.js"></script>
    <!--- Personalizados -->
    <script src="../vistas/modulos/js/confDatAlm.js"></script>
    <script src="../vistas/modulos/js/justif.js"></script>
    <script src="../vistas/modulos/js/datPerAlm.js"></script>
    <script src="../vistas/modulos/js/editDatPerAlm.js"></script>
    <script src="../vistas/modulos/js/grpAlm.js"></script>
    <script src="../vistas/modulos/js/tutAlm.js"></script>
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
    
	<?php include 'footer2.php'; ?>
<?php
	} else {
		header("Location:../vistas/modulos/Logout.php");
	}
	  
}

