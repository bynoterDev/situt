<!--===================================================
=            Ventana Modal Conf Contraseña            =
====================================================-->

<div class="modal fade bgModal" id="confContDir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-info" id="exampleModalLabel"><i class="fas fa-key fa-lg icoIni"></i> Configurar Contraseña</h5>
        <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="row" method="POST" id="formConfContDir" name="formConfContDir">
          <div class="col-sm-1"></div>
          <div class="col-sm-10">
            <div class="form-group">
              <label for="conActDir">Contraseña actual:</label>
              <input type="password" id="contActDir" name="contActDir" class="form-control">
            </div>
            <div class="form-group">
              <label for="newContDir">Nueva contraseña:</label>
              <input onkeyup="contIgul()" type="password" id="newContDir" name="newContDir" class="form-control">
              <label id="mensaje" class="ocult"></label>
            </div>
            <div class="form-group">
              <label for="repContDir">Repite la nueva contraseña:</label>
              <input onkeyup="contIgul()" type="password" id="repContDir" name="repContDir" class="form-control">
              <label id="mensaje2" class="ocult"></label>
            </div>
          </div>
          <div class="col-sm-1"></div>
      </div>
      <div class="modal-footer">
        <button type="button" id="btnCloseConfContDir" class="btn btn-md btn-outline-danger" data-dismiss="modal">
          <i class="fas fa-times-circle mr-2"></i>  
          Cerrar
        </button>
        <button type="submit" class="btn btn-outline-primary" id="btnGConfContDir">
          <i class="fas fa-check-circle mr-2"></i>
          Guardar cambios
        </button>
        </form>
      </div>
    </div>
  </div>
</div>

<!--====  End of Ventana Modal Conf Contraseña  ====-->

<!--==============================================
=            Ventana Modal Conf Datos            =
===============================================-->

<div class="modal fade bgModal" id="confDatDir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-info" id="exampleModalLabel"><i class="fas fa-user-cog fa-lg icoIni"></i> Configurar Datos</h5>
        <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="row" method="POST" id="formConfDatDir" name="formConfDatDir">
          <div class="col-sm-1"></div>
          <div class="col-sm-10">
            <div class="form-group">
              <label for="nomDir">Nombre:</label>
              <input value="<?php echo $datDirec->nombre_c_dir;?>" type="text" id="nomDir" name="nomDir" class="form-control">
            </div>
            <div class="form-group">
              <label for="corDir">Correo:</label>
              <input onchange="validEmail()" value="<?php echo $datDirec->correo_dir;?>" type="email" id="corDir" name="corDir" class="form-control">
              <div style="font-size: 16px;" id="textcorr" class="text-center"></div>
            </div>
            <div class="form-group">
              <label for="telDir">Telefono:</label>
              <input value="<?php echo $datDirec->telefono_dir;?>" type="text" id="telDir" name="telDir" class="form-control">
            </div>
            <div class="form-group">
              <label for="passConfDir">Contraseña:</label>
              <input type="password" id="passConfDir" name="passConfDir" class="form-control">
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
          Cerrar
        </button>
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