<!--===================================================
=            Ventana Modal Conf Contraseña            =
====================================================-->

<div class="modal fade bgModal" id="confContCor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-info" id="exampleModalLabel"><i class="fas fa-key fa-lg icoIni"></i> Configurar Contraseña</h5>
        <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="row" method="POST" id="formConfContCor" name="formConfContCor">
          <div class="col-sm-1"></div>
          <div class="col-sm-10">
            <div class="form-group">
              <label for="contActCor">Contraseña actual:</label>
              <input type="password" id="contActCor" name="contActCor" class="form-control">
            </div>
            <div class="form-group">
              <label for="newContCor">Nueva contraseña:</label>
              <input onkeyup="contIgul()" type="password" id="newContCor" name="newContCor" class="form-control">
              <label id="mensaje" class="ocult"></label>
            </div>
            <div class="form-group">
              <label for="repContCor">Repite la nueva contraseña:</label>
              <input onkeyup="contIgul()" type="password" id="repContCor" name="repContCor" class="form-control">
              <label id="mensaje2" class="ocult"></label>
            </div>
          </div>
          <div class="col-sm-1"></div>
      </div>
      <div class="modal-footer">
        <button type="button" id="btnCloseConfContCor" class="btn btn-outline-danger" data-dismiss="modal">
          <i class="fas fa-times-circle mr-2"></i>
          Cerrar</button>
        <button type="submit" class="btn btn-outline-primary" id="btnGConfContCor">
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

<div class="modal fade bgModal" id="confDatCor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-info" id="exampleModalLabel"><i class="fas fa-user-cog fa-lg icoIni"></i> Configurar Datos</h5>
        <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="row" method="POST" id="formConfDatCor" name="formConfDatCor">
          <div class="col-sm-1"></div>
          <div class="col-sm-10">
            <div class="form-group">
              <label for="nomCor">Nombre:</label>
              <input value="<?php echo $datCor->nombre_c_cor;?>" type="text" id="nomCor" name="nomCor" class="form-control">
            </div>
            <div class="form-group">
              <label for="corCor">Correo:</label>
              <input onchange="validEmail()" value="<?php echo $datCor->correo_cor;?>" type="email" id="corCor" name="corCor" class="form-control">
              <div style="font-size: 16px;" id="textcorr" class="text-center"></div>
            </div>
            <div class="form-group">
              <label for="telCor">Telefono:</label>
              <input value="<?php echo $datCor->telefono_cor;?>" type="text" id="telCor" name="telCor" class="form-control">
            </div>
            <div class="form-group">
              <label for="sexCor">Sexo:</label>
              <select class="form-control" name="sexCor" id="sexCor">
                <?php 
                  if ($datCor -> sexo_cor == "Masculino") {
                ?>
                  <option value="0">Selecciona</option>
                  <option value="Masculino" selected>Masculino</option>
                  <option value="Femenino">Femenino</option>
                <?php
                  } else if ($datCor -> sexo_cor == "Femenino") {
                ?>
                  <option value="0">Selecciona</option>
                  <option value="Masculino">Masculino</option>
                  <option value="Femenino" selected>Femenino</option>
                <?php
                  }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label for="passConfCor">Contraseña:</label>
              <input type="password" id="passConfCor" name="passConfCor" class="form-control">
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
        <button type="submit" class="btn btn-outline-primary" id="btnGDatCor">
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