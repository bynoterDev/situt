<!--==============================================
=            Ventana modal info Index            =
===============================================-->

<div class="modal fade bgModal" id="infRegGrupos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-info" id="exampleModalLabel"><i class="fas fa-question-circle fa-lg icoIni"></i> Servicio de Ayuda </h5>
        <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<h4 class="text-center">
      		Asistencia al usuario
      	</h4>
      	<hr>
      	<br>
      	<h5 class="text-left font-weight-bold">En esta pantalla usted puede:</h5>
        <br>
        <div class="form-group">
              <i class="fas fa-circle fa-lg text-success"></i>
              <span class="lead">
                <b class="font-weight-bold">Activar un grupo:</b> 
                al dar click en el botón
                <button class="btn btn-outline-danger" type="button">
                  <i class="fas fa-times icoIni"></i>
                  Grupos inactivos
                </button>
                mostrara una tabla con los grupos en estado inactivo y al dar click en el botón 
                <button class="btn btn-info" type="button">
                  <i class="fas fa-check"></i>
                </button>
                el grupo se activara y aparecera en Grupos Activos
              </span>
            </div>
            <div class="form-group">
              <i class="fas fa-circle fa-lg text-success"></i>
              <span class="lead">
                <b class="font-weight-bold">Desactivar un grupo:</b> 
                al dar click en el botón
                <button class="btn btn-outline-success" type="button">
                  <i class="fas fa-check icoIni"></i>
                  Grupos activos
                </button>
                mostrara una tabla con los grupos en estado activo y al dar click en el botón 
                <button class="btn btn-info" type="button">
                  <i class="fas fa-times"></i>
                </button>
                el grupo se desactivara y aparecera en Grupos Inactivos
              </span>
            </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!--====  End of Ventana modal info Index  ====-->
