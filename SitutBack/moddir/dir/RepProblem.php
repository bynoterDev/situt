<style type="text/css">
	.subir{
    padding: 5px 10px;
    background: #4e73df;
    color:#fff;
    border:0px solid #fff;
    border-radius: 4px;
}

.subir:hover{
	cursor: pointer;
    color:#fff;
    background: #36b9cc;
}
</style>

<div class="container-fluid animated fadeIn delay-1s">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 text-center">Reportar un problema.</h1>
        <a href="<?php echo SERVERURLDIR; ?>Home/" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50 mr-2"></i> Regresar 
        </a>
    </div>

    <?php 
    	if ($datDirec -> us_mod_rep == 1) {
    ?>

	    <div class="card shadow mb-4 mt-4">
	        <div class="card-header py-3">
	          <h6 class="m-0 font-weight-bold text-primary">Describe el problema...</h6>
	        </div>
	        <div class="card-body">
	        	<div class="row">
	        		<div class="col-sm-4 mb-3 text-center">
	        			<img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 15rem;" src="<?php echo SERVERURL; ?>assets/img/maintenance.svg" alt="info site">
	        			<div class="mt-4 text-center d-none" id="spinLoad">
			            	<div class="spinner-border text-primary" role="status">
							  <span class="sr-only">Loading...</span>
							</div>
							<h6 class="mt-3">Enviando...</h6>
			            </div>
	        			<div class="card border-left-success shadow py-2 d-none animated" id="cardSus">
			                <div class="card-body">
			                  <div class="row no-gutters align-items-center">
			                    <div class="col mr-2">
			                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
			                      	Solución en proceso... 
			                      </div>
			                      <div class="h5 mb-0 font-weight-bold text-gray-800">Reporte enviado</div>
			                    </div>
			                    <div class="col-auto">
			                      <i class="fas fa-check-circle fa-2x text-gray-300"></i>
			                    </div>
			                  </div>
			                </div>
		              	</div>
		              	<div class="card border-left-danger shadow py-2 d-none animated" id="cardErr">
			                <div class="card-body">
			                  <div class="row no-gutters align-items-center">
			                    <div class="col mr-2">
			                      <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
			                      	Intentelo más tarde
			                      </div>
			                      <div class="h5 mb-0 font-weight-bold text-gray-800">Ocurrio un problema</div>
			                    </div>
			                    <div class="col-auto">
			                      <i class="fas fa-times-circle fa-2x text-gray-300"></i>
			                    </div>
			                  </div>
			                </div>
		              	</div>
		              	<div class="border-left-primary shadow card">
		              		<div class="card-body">
		              			<b class="text-primary">*Nota*</b>
		              			<p class="text-justify m-0">
		              				Cualquier abuso al enviar reportes sera sancionado...
		              			</p>
		              		</div>
		              	</div>
	        		</div>

	        		<div class="col-sm-8 mb-3">
	        			<form class="user" method="POST" id="formEnvReport" enctype="multipart/form-data">
	        				<input type="hidden" value="<?php echo base64_encode($keyDir); ?>" name="clv_us">
			                <div class="form-group">
			                  <textarea name="descProb" id="descProb" class="form-control" id="exampleInputEmail" placeholder="Descripción..." rows="6"></textarea>
			                  <div class="text-right">
			                  	<span class="badge badge-primary" id="cantCar">
			                  		0 / 500
			                  	</span>
			                  </div>
			                  <div class="d-none" id="msjDesc">
			                  	<div class="border-left-danger">
			                  		<h6 class="text-danger ml-3">
			                  			Ingresa una descripción mayor a 50 caracteres.
			                  		</h6>
			                  	</div>
			                  </div>
			                </div>
			                <div class="form-group animated d-none" id="contArch">
		                    	<label for="fileUpload" class="subir">
								    <i class="fas fa-cloud-upload-alt"></i> Subir archivo
								</label>
								<input id="fileUpload" name="fileUpload" type="file" style='display: none;'/>
								<span class="badge badge-pill badge-primary ml-1" id="info"></span>
		                    </div>
		                    <div class="d-none" id="msjImg">
			                  	<div class="border-left-danger">
			                  		<h6 class="text-danger ml-3">
			                  			Selecciona una imagen con la extensión .jpg .png ó .jpeg
			                  		</h6>
			                  	</div>
			                  </div>
			                <div class="custom-control custom-checkbox small">
		                        <input type="checkbox" class="custom-control-input" id="checkCap">
		                        <label class="custom-control-label" for="checkCap">
		                        	Tienes una foto o captura de pantalla del problema?...
		                        </label>
		                    </div>
			                <div class="text-right">
			                	<button class="btn btn-primary shadow-sm btn-sm" id="btnEnvRep">
			                		<i class="fas fa-check-circle mr-2 ml-2"></i>
			                		Enviar
			                	</button>
			                </div>
			            </form>
	        		</div>
	        	</div>
	        </div>
	    </div>

	    <script type="text/javascript">
			document.addEventListener('DOMContentLoaded', () => {

				const formEnvReport = document.getElementById('formEnvReport');
				const btnEnvRep = document.getElementById('btnEnvRep');
				const descProb = document.getElementById('descProb');
				const fileUpload = document.getElementById('fileUpload');
				const contArch = document.getElementById('contArch');
				const checkCap = document.getElementById('checkCap');
				const info = document.getElementById('info');
				const cantCar = document.getElementById('cantCar');
				const msjDesc = document.getElementById('msjDesc');
				const msjImg = document.getElementById('msjImg');
				const cardSus = document.getElementById('cardSus');
				const cardErr = document.getElementById('cardErr');
				const spinLoad = document.getElementById('spinLoad');

				const totalCaract = 500;
				const val = descProb.value.length;

				descProb.addEventListener('keyup', () => {
					const totalCaract = 500;
					const val = descProb.value.length;
					cantCar.textContent = val + ' / ' + (totalCaract - val);
					setTimeout(() => {
						if (val > totalCaract) {
							btnEnvRep.disabled = true;
							cantCar.textContent = 'Has llegado al limite de caracteres permitidos';
						} else {
							btnEnvRep.disabled = false;
						}
					}, 10);
				});

				checkCap.addEventListener('change', () => {
				    if (checkCap.checked) {
				    	contArch.classList.remove('d-none');
				    	contArch.classList.add('fadeIn');
				    } else {
				    	contArch.classList.remove('fadeIn');
				    	contArch.classList.add('fadeOut');
				    	fileUpload.value = '';
				    	info.textContent = '';
				    	setTimeout( () => {
				    		contArch.className = 'form-group animated d-none';
				    	},700);
				    }
				});

				fileUpload.addEventListener('change', () => {
					const pdrs = fileUpload.files[0].name;
				    info.innerHTML = pdrs;
				});

				mostMsj = (param) => {
					param.className = 'animated fadeIn';
					setTimeout(() => {
						param.className = 'animated fadeOut';
						setTimeout(() => {
							param.classList.add('d-none');
						},1200);
					}, 2000);
				}

				limpCamp = () => {
					descProb.value = ''; 
					cantCar.textContent = val + ' / ' + (totalCaract - val);
					checkCap.checked = false;
					fileUpload.value = '';
					info.textContent = '';
					contArch.className = 'form-group animated d-none';
					btnEnvRep.disabled = false;
				}

				envData = () => {
					const formDat = new FormData($(formEnvReport)[0]);
					btnEnvRep.disabled = true;
					spinLoad.classList.remove('d-none');
					setTimeout(() => {
						$.ajax({
							url : "../../ajax/reports/recibData.php?tag=Director",
							type : "POST", data : formDat,
							contentType : false, processData : false,
							success : (resp) => {
								if (resp == 1) {
									cardSus.className = 'card border-left-success shadow py-2 animated fadeIn';
									setTimeout(() => {
										cardSus.className = 'card border-left-success shadow py-2 animated fadeOut';
										setTimeout(() => {
											cardSus.className = 'card border-left-success shadow py-2 d-none animated'
										}, 1200);
									}, 3000);
									limpCamp();
								} else {
									cardErr.className = 'card border-left-success shadow py-2 animated fadeIn';
									setTimeout(() => {
										cardErr.className = 'card border-left-success shadow py-2 animated fadeOut';
										setTimeout(() => {
											cardErr.className = 'card border-left-success shadow py-2 d-none animated'
										}, 1200);
									}, 3000);
									limpCamp();
								}
							}
						});
						spinLoad.classList.add('d-none');
					}, 5000);
				}

				formEnvReport.addEventListener('submit', (e) => {
					const extPerm = /(.jpg)$/i;
					const extPerm1 = /(.jpeg)$/i;
					const extPerm2 = /(.png)$/i;
					e.preventDefault();
					if (descProb.value.length > 50) {
						if (checkCap.checked) {
							if (fileUpload.value != "") {
								if (!extPerm.exec(fileUpload.value) && !extPerm1.exec(fileUpload.value) && !extPerm2.exec(fileUpload.value)) {
									mostMsj(msjImg);
									fileUpload.value = '';
								} else {
									envData();
								}
							} else {
								mostMsj(msjImg);
							}
						} else {
							envData();
						} 
					} else {
						mostMsj(msjDesc);
					}
				});

			});
		</script>

    <?php
    	} else {
    ?>

    	<div class="card shadow mb-4 mt-4">
	        <div class="card-header py-3">
	          <h6 class="m-0 font-weight-bold text-danger">Oppss!</h6>
	        </div>
	        <div class="card-body">
				<div class="text-center">
					<img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 18rem;" src="<?php echo SERVERURL; ?>assets/img/fixing.svg" alt="info site">
					<h5 class="font-weight-bold text-danger">Has sido bloqueado en esta funcionalidad por hacer mal uso de ella, si crees que esto es un error consultalo con el Administrador del sistema o el Programador.</h5>
				</div>
	        </div>
	    </div>

    <?php
    	}
    ?>

</div>