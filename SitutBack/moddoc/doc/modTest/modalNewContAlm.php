
<div class="modal fade bgModal" id="newContAlmEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title h5 mb-0 text-gray-700" id="exampleModalLabel"><i class="fas text-gray-300 fa-key fa-lg icoIni mr-2"></i> Nueva contraseña</h5>
        <button id="btnIcoCloseNCA" type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="row" method="POST" id="formNewContAlm" name="formNewContAlm">
          <div class="col-sm-1"></div>
          <div class="col-sm-10">
            <div class="form-group">
              <input type="hidden" value="<?php echo base64_encode($datAlm->id_alumno); ?>" name="id_alumno">
              <label for="newContAlm">Nueva contraseña:</label>
              <input type="password" id="newContAlm" name="newContAlm" class="form-control">
              <label id="mensaje1d" class="ocult"></label>
            </div>
            <div class="form-group">
              <label for="repNewContAlm">Repite la nueva contraseña:</label>
              <input type="password" id="repNewContAlm" name="repNewContAlm" class="form-control">
              <label id="mensaje2d" class="ocult"></label>
            </div>
            <div class="form-group">
              <label for="contConfDoc">Introduce tu contraseña para confirmar:</label>
              <input type="password" id="contConfDoc" name="contConfDoc" class="form-control">
            </div>
          </div>
          <div class="col-sm-1"></div>
      </div>
      <div class="modal-footer">
        <button type="button" id="btnCloseNewContAlm" class="btn btn-outline-danger btn-sm" data-dismiss="modal">
        <i class="fas fa-times-circle mr-2"></i>
        Cerrar</button>
        <button type="submit" class="btn btn-outline-primary btn-sm" id="btnNewContAlmConf">
        <i class="fas fa-check-circle mr-2"></i>
        Guardar</button>
        </form>
      </div>
    </div>
  </div>
</div>