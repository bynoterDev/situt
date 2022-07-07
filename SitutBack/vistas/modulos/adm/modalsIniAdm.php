<!--===================================================
=            Ventana Modal Conf Contraseña            =
====================================================-->

<div class="modal fade" id="confCont" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-key fa-lg text-info"></i> Configurar Contraseña</h5>
        <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="row" method="POST" id="formConfCont" name="formConfCont">
          <div class="col-sm-1"></div>
          <div class="col-sm-10">
            <div class="form-group">
              <label for="conAct">Contraseña actual:</label>
              <input type="password" id="contAct" name="contAct" class="form-control">
            </div>
            <div class="form-group">
              <label for="newCont">Nueva contraseña:</label>
              <input type="password" id="newCont" name="newCont" class="form-control">
              <label id="mensaje" class="ocult"></label>
            </div>
            <div class="form-group">
              <label for="repCont">Repite la nueva contraseña:</label>
              <input onchange="contIgul()" type="password" id="repCont" name="repCont" class="form-control">
              <label id="mensaje2" class="ocult"></label>
            </div>
          </div>
          <div class="col-sm-1"></div>
      </div>
      <div class="modal-footer">
        <button type="button" id="btnCloseConfCont" class="btn btn-outline-danger" data-dismiss="modal">
          <i class="fas fa-times-circle mr-2"></i>
          Cerrar</button>
        <button type="submit" class="btn btn-outline-primary" id="btnGConfCont">
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

<div class="modal fade" id="confDat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-info" id="exampleModalLabel"><i class="fas fa-user-cog fa-lg icoIni"></i> Configurar Datos</h5>
        <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="row" method="POST" id="formConfDat" name="formConfDat">
          <div class="col-sm-1"></div>
          <div class="col-sm-10">
            <div class="form-group">
              <label for="nomAdm">Nombre:</label>
              <input value="<?php echo $datAdmin->nombre_c;?>" type="text" id="nomAdm" name="nomAdm" class="form-control">
            </div>
            <div class="form-group">
              <label for="corAdm">Correo:</label>
              <input onkeyup="validEmail()" value="<?php echo $datAdmin->correo;?>" type="email" id="corAdm" name="corAdm" class="form-control">
              <div style="font-size: 16px;" id="textcorr" class="text-center"></div>
            </div>
            <div class="form-group">
              <label for="usrAdm">Usuario</label>
              <input value="<?php echo $datAdmin->usuario;?>" type="text" id="usrAdm" name="usrAdm" class="form-control">
            </div>
            <div class="form-group">
              <label for="passConf">Contraseña:</label>
              <input type="password" id="passConf" name="passConf" class="form-control">
                <div class="text-center">
                  Introduce tu contraseña para actualizar
                </div>
            </div>
          </div>
          <div class="col-sm-1"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">
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
