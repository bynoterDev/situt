<!--===================================================
=            Ventana Modal Conf Contraseña            =
====================================================-->

<div class="modal fade bgModal" id="confContAlm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
         <h6 class="modal-title font-weight-bold mb-0 text-gray-700" id="exampleModalLabel"><i class="fas text-gray-300 fa-key fa-lg mr-2"></i> Configurar contraseña</h6>
        <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close" id="btnCloseIcoCont">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="row" method="POST" id="formContConfAlm" name="formContConfAlm" autocomplete="off">
          <div class="col-sm-1"></div>
          <div class="col-sm-10">
            <div class="form-group">
              <label for="contActAlm">Contraseña actual:</label>
              <input type="password" id="contActAlm" name="contActAlm" class="form-control">
            </div>
            <div class="form-group">
              <label for="newContAlm">Nueva contraseña:</label>
              <input type="password" id="newContAlm" name="newContAlm" class="form-control">
              <label id="mensaje" class="ocult mt-3 badge p-2 badge-pill" style="font-size: 16px !important;"></label>
            </div>
            <div class="form-group">
              <label for="repContAlm">Repite la nueva contraseña:</label>
              <input type="password" id="repContAlm" name="repContAlm" class="form-control">
              <label id="mensaje2" class="ocult mt-3 badge p-2 badge-pill" style="font-size: 16px !important;"></label>
            </div>
          </div>
          <div class="col-sm-1"></div>
      </div>
      <div class="modal-footer">
        <button type="button" id="btnCloseConfContAlm" class="btn btn-outline-danger btn-sm" data-dismiss="modal">
          <i class="fas fa-times-circle mr-2"></i>
          Cerrar</button>
        <button type="submit" class="btn btn-outline-primary btn-sm" id="btnGConfContAlm">
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

<div class="modal fade bgModal" id="confDatAlm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title font-weight-bold mb-0 text-gray-700" id="exampleModalLabel"><i class="fas text-gray-300 fa-user-cog fa-lg mr-2"></i> Configurar Datos</h6>
        <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="row" method="POST" id="formConfDatAlm" name="formConfDatAlm" autocomplete="off">
          <div class="col-sm-6">
            <div class="form-group">
              <label for="nomAlm">Nombre:</label>
              <input value="<?php echo $datAlm->nombre_c_al;?>" type="text" id="nomAlm" name="nomAlm" class="form-control">
            </div>
            <div class="form-group">
              <label for="corAlm">Correo:</label>
              <input value="<?php echo $datAlm->correo_al;?>" type="email" id="corAlm" name="corAlm" class="form-control">
              <div style="font-size: 16px;" id="textcorr" class="text-center ocult"></div>
            </div>
            <?php 
              if ($datAlm -> sexo_al == "Masculino") {
            ?>
            <div class="form-group">
              <label for="sexAlm">Sexo:</label>
              <select class="form-control" id="sexAlm" name="sexAlm">
                <option class="" value="0">Selecciona</option>
                <option value="Masculino" selected="">Masculino</option>
                <option value="Femenino">Femenino</option>
              </select>
            </div>
            <?php
              } else {
            ?>
            <div class="form-group">
              <label for="sexAlm">Sexo:</label>
              <select class="form-control" id="sexAlm" name="sexAlm">
                <option class="" value="0">Selecciona</option>
                <option value="Masculino">Masculino</option>
                <option value="Femenino" selected="">Femenino</option>
              </select>
            </div>
            <?php    
              }
              
            ?>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label for="telAlm">Telefono:</label>
              <input value="<?php echo $datAlm->telefono_al;?>" type="text" id="telAlm" name="telAlm" class="form-control">
            </div>
            <div class="form-group">
              <label for="matAlm">Matricula:</label>
              <input value="<?php echo $datAlm->matricula_al;?>" type="text" id="matAlm" name="matAlm" class="form-control">
            </div>
            <div class="form-group">
              <label for="passConfAlm">Contraseña:</label>
              <input type="password" id="passConfAlm" name="passConfAlm" class="form-control">
                <div class="text-center mt-3">
                  <span class="badge badge-pill text-info" style="font-size: 16px;">
                    Introduce tu contraseña para actualizar
                  </span>
                </div>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="btnCloseDat" class="btn btn-outline-danger btn-sm" data-dismiss="modal">
          <i class="fas fa-times-circle mr-2"></i>
          Cerrar</button>
        <button type="submit" class="btn btn-outline-primary btn-sm" id="btnGConfDatAlm">
          <i class="fas fa-check-circle mr-2"></i>
          Guardar cambios</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!--====  End of Ventana Modal Conf Datos  ====-->

<!--====================================================
=            Ventana Modal conf foto perfil            =
=====================================================-->

<div class="modal fade bgModal" id="confFotPerf" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title font-weight-bold mb-0 text-gray-700" id="exampleModalLabel"><i class="fas text-gray-300 fa-image fa-lg mr-2"></i>Foto de perfil</h6>
        <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="row" method="POST" id="formConfFotPerf" name="formConfFotPerf" autocomplete="off">
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
        <button type="button" id="btnCloseFotPerf" class="btn btn-outline-danger btn-sm" data-dismiss="modal">
          <i class="fas fa-times-circle mr-2"></i>
          Cerrar</button>
        <button type="submit" class="btn btn-outline-primary btn-sm" id="btnFotPerf">
          <i class="fas fa-check-circle mr-2"></i>
          Guardar cambios</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!--====  End of Ventana Modal conf foto perfil  ====-->

<script src="<?php echo SERVERURLALM; ?>alm/js/confDatAlm.js"></script>