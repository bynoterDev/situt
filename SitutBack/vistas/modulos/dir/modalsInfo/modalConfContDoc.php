<div class="modal fade bgModal" id="confContTut" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-key fa-lg icoIni"></i> Nueva Contraseña</h5>
        <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="row" method="POST" id="formNewContDoc" name="formNewContDoc">
          <div class="col-sm-1"></div>
          <div class="col-sm-10">
            <div class="form-group">
              <input type="hidden" value="<?php echo base64_encode($dTut->id_docente); ?>" name="id_docente">
              <label for="newContDoc">Nueva contraseña:</label>
              <input type="password" id="newContDoc" name="newContDoc" class="form-control">
              <label id="mensajed1" class="ocult"></label>
            </div>
            <div class="form-group">
              <label for="repContNewDoc">Repite la nueva contraseña:</label>
              <input type="password" id="repContNewDoc" name="repContNewDoc" class="form-control">
              <label id="mensajed2" class="ocult"></label>
            </div>
            <div class="form-group">
              <label for="contDirConf">Introduce tu contraseña para confirmar:</label>
              <input type="password" id="contDirConf" name="contDirConf" class="form-control">
            </div>
          </div>
          <div class="col-sm-1"></div>
      </div>
      <div class="modal-footer">
        <button type="button" id="btnCloseNewContDoc" class="btn btn-outline-danger" data-dismiss="modal">
          <i class="fas fa-times-circle mr-2 ml-2"></i>
          Cerrar</button>
        <button type="submit" class="btn btn-outline-primary" id="btnNewContDoc">
          <i class="fas fa-check-circle mr-2 ml-2"></i>
          Guardar cambios</button>
        </form>
      </div>
    </div>
  </div>
</div>