<div class="modal fade" id="reEnc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h6 class="modal-title font-weight-bold mb-0 text-gray-700" id="exampleModalLabel"><i class="fas text-gray-300 fa-address-card fa-lg mr-2"></i> Realizar encuesta</h6>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form class="row" method="POST" id="formRegEnc" name="formRegEnc">
	        	<div class="col-sm-12">
					<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
					  <li class="nav-item">
					    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"><h5>Datos SocioEconomicos</h5></a>
					  </li>
					  <li class="nav-item">
					    <a class="nav-link disabled" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false"><h5>Datos Personales</h5></a>
					  </li>
					  <li class="nav-item">
					    <a class="nav-link disabled" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false"><h5>Datos Acedemicos</h5></a>
					  </li>
					</ul>
					<div class="tab-content" id="pills-tabContent">
					  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
					  	
					  	<button type="button" class="btn btn-outline-success" onclick="valida()">Enviar</button>
					  </div>
					  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">Datos 2</div>
					  <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">Datos 3</div>
					</div>
	        	</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" id="btnCloseEnc" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
	        <button type="submit" class="btn btn-success" id="btnGReEnc">Guardar</button>
	        </form>
	      </div>
	    </div>
	  </div>
	</div>