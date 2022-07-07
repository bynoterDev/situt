<!--===================================================
=            Ventana Modal Conf Contraseña            =
====================================================-->

<div class="modal fade bgModal" id="confContDoc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title h5 mb-0 text-gray-700" id="exampleModalLabel"><i class="fas text-gray-300 fa-key fa-lg mr-2"></i> Configurar contraseña </h5>
        <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="row" method="POST" id="formConfContDoc" name="formConfContDoc">
          <div class="col-sm-1"></div>
          <div class="col-sm-10">
            <div class="form-group">
              <label for="conActDoc">Contraseña actual:</label>
              <input type="password" id="contActDoc" name="contActDoc" class="form-control">
            </div>
            <div class="form-group">
              <label for="newContDoc">Nueva contraseña:</label>
              <input onkeyup="contIgulAdm()" type="password" id="newContDoc" name="newContDoc" class="form-control">
              <label id="mensaje" class="ocult"></label>
            </div>
            <div class="form-group">
              <label for="repContDoc">Repite la nueva contraseña:</label>
              <input onkeyup="contIgulAdm()" type="password" id="repContDoc" name="repContDoc" class="form-control">
              <label id="mensaje2" class="ocult"></label>
            </div>
          </div>
          <div class="col-sm-1"></div>
      </div>
      <div class="modal-footer">
        <button type="button" id="btnCloseConfContDoc" class="btn btn-outline-danger btn-sm" data-dismiss="modal">
        <i class="fas fa-times-circle mr-2"></i>
        Cerrar</button>
        <button type="submit" class="btn btn-outline-primary btn-sm" id="btnGConfContDoc">
          <i class="fas fa-check-circle mr-2"></i>
          Guardar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!--====  End of Ventana Modal Conf Contraseña  ====-->

<!--==============================================
=            Ventana Modal Conf Datos            =
===============================================-->

<div class="modal fade bgModal" id="confDatDoc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title h5 mb-0 text-gray-700" id="exampleModalLabel"><i class="fas text-gray-300 fa-user-cog fa-lg mr-2"></i> Configurar datos </h5>
        <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="row" method="POST" id="formConfDatDoc" name="formConfDatDoc">
          <div class="col-sm-1"></div>
          <div class="col-sm-10">
            <div class="form-group">
              <label for="nomDoc">Nombre:</label>
              <input value="<?php echo $datDoce->nombre_c_doc;?>" type="text" id="nomDoc" name="nomDoc" class="form-control">
            </div>
            <div class="form-group">
              <label for="corDoc">Correo:</label>
              <input onkeyup="validEmailAdm()" value="<?php echo $datDoce->correo_doc;?>" type="email" id="corDoc" name="corDoc" class="form-control">
              <div style="font-size: 16px;" id="textcorr" class="text-center"></div>
            </div>
            <div class="form-group">
              <label for="telDoc">Telefono:</label>
              <input value="<?php echo $datDoce->telefono_doc;?>" type="text" id="telDoc" name="telDoc" class="form-control">
            </div>
            <div class="form-group">
              <label for="dirDoc">Direccion:</label>
              <input value="<?php echo $datDoce->direccion_doc;?>" type="text" id="dirDoc" name="dirDoc" class="form-control">
            </div>
            <div class="form-group">
              <label for="espDoc">Especialidad:</label>
              <input value="<?php echo $datDoce->especialidad_doc;?>" type="text" id="espDoc" name="espDoc" class="form-control">
            </div>
            <div class="form-group">
              <label for="passConfDoc">Contraseña:</label>
              <input type="password" id="passConfDoc" name="passConfDoc" class="form-control">
                <div class="text-center">
                  Introduce tu contraseña para actualizar
                </div>
            </div>
          </div>
          <div class="col-sm-1"></div>
      </div>
      <div class="modal-footer">
        <button type="button" id="btnClose" class="btn btn-outline-danger btn-sm" data-dismiss="modal">
        <i class="fas fa-times-circle mr-2"></i>
        Cerrar</button>
        <button type="submit" class="btn btn-outline-primary btn-sm" id="btnGConfDat">
          <i class="fas fa-check-circle mr-2"></i>
          Guardar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!--====  End of Ventana Modal Conf Datos  ====-->

<!--====================================================
=            Ventana Modal Conf Foto Perfil            =
=====================================================-->

<div class="modal fade bgModal" id="confFotPerf" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title h5 mb-0 text-gray-700" id="exampleModalLabel"><i class="fas text-gray-300 fa-image fa-lg mr-2"></i> Cambiar foto </h5>
        <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="row" method="POST" id="formConfFotPerf" name="formConfFotPerf">
          <div class="col-sm-1"></div>
          <div class="col-sm-10">
            <div class="form-group">
              <label for="newFotPerf">Nueva foto de perfil</label>
              <input type="file" class="form-control" id="newFotPerf" name="newFotPerf">
            </div>
          </div>
          <div class="col-sm-1"></div>
      </div>
      <div class="modal-footer">
        <button type="button" id="btnCloseConfFotPerf" class="btn btn-outline-danger btn-sm" data-dismiss="modal">
        <i class="fas fa-times-circle mr-2"></i>
        Cerrar</button>
        <button type="submit" class="btn btn-outline-primary btn-sm" id="btnFotPerf">
          <i class="fas fa-check-circle mr-2"></i>
          Guardar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!--====  End of Ventana Modal Conf Foto Perfil  ====-->

 <script src="<?php echo SERVERURLDOC; ?>doc/js/confDatDoc.js"></script>