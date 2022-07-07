<!--===================================================
=            Ventana Modal Conf Contraseña            =
====================================================-->

<div class="modal fade bgModal" id="confContDoc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-info" id="exampleModalLabel"><i class="fas fa-key fa-lg icoIni"></i> Configurar Contraseña</h5>
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
              <input onkeyup="contIgul()" type="password" id="newContDoc" name="newContDoc" class="form-control">
              <label id="mensaje" class="ocult"></label>
            </div>
            <div class="form-group">
              <label for="repContDoc">Repite la nueva contraseña:</label>
              <input onkeyup="contIgul()" type="password" id="repContDoc" name="repContDoc" class="form-control">
              <label id="mensaje2" class="ocult"></label>
            </div>
          </div>
          <div class="col-sm-1"></div>
      </div>
      <div class="modal-footer">
        <button type="button" id="btnCloseConfContDoc" class="btn btn-outline-danger" data-dismiss="modal">
        <i class="fas fa-times-circle mr-2"></i>
        Cerrar</button>
        <button type="submit" class="btn btn-outline-primary" id="btnGConfContDoc">
          <i class="fas fa-check-circle mr-2"></i>
          Guardar cambios</button>
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
        <h5 class="modal-title text-info" id="exampleModalLabel"><i class="fas fa-user-cog fa-lg icoIni"></i> Configurar Datos</h5>
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
              <input onchange="validEmail()" value="<?php echo $datDoce->correo_doc;?>" type="email" id="corDoc" name="corDoc" class="form-control">
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
        <button type="button" id="btnClose" class="btn btn-outline-danger" data-dismiss="modal">
        <i class="fas fa-times-circle mr-2"></i>
        Cerrar</button>
        <button type="submit" class="btn btn-outline-primary" id="btnGConfDat">
          <i class="fas fa-check-circle mr-2"></i>
          Guardar cambios</button>
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
        <h5 class="modal-title text-info" id="exampleModalLabel"><i class="fas fa-image fa-lg icoIni"></i> Foto de perfil</h5>
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
        <button type="button" id="btnCloseConfFotPerf" class="btn btn-outline-danger" data-dismiss="modal">
        <i class="fas fa-times-circle mr-2"></i>
        Cerrar</button>
        <button type="submit" class="btn btn-outline-primary" id="btnFotPerf">
          <i class="fas fa-check-circle mr-2"></i>
          Guardar cambios</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!--====  End of Ventana Modal Conf Foto Perfil  ====-->

