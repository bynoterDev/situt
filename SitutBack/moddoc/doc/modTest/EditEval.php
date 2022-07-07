
<div class="modal fade bgModal" id="editEval" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title h5 mb-0 text-gray-700" id="exampleModalLabel"><i class="fas text-gray-300 fa-edit fa-lg mr-2"></i> Editar evaluación</h5>
        <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-dark">
        <form class="row" method="POST" id="formEditEval" name="formEditEval">
          <div class="col-sm-12">
            <input type="hidden" value="<?php echo $valDatEnc; ?>" name="id_testalm">
            <input type="hidden" value="<?php echo base64_encode($dataEval->id_evaltest); ?>" name="id_enctest">
            <div class="form-group">
              <label for="vulnerableEdit" class=" font-weight-bold">
                <b class="lead font-weight-bold">1. </b>
                De acuerdo a la darkrmación obtenida en los aspectos I, II Y III. ¿Se considera al alumno como elemento de uno o más grupos altamente vulnerables?
              </label>
            </div>
            <div class="form-group">
              <select class="form-control" id="vulnerableEdit" name="vulnerable">
                <option value="0" selected="">Selecciona</option>
                <?php 
                  if ($dataEval->vulnerable == "No") {
                ?>
                <option value="Si">Si</option>
                <option value="No" selected="">No</option>
                <?php    
                  } else {
                ?>
                  <option value="Si" selected="">Si</option>
                  <option value="No">No</option>
                <?php
                  }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label class=" font-weight-bold">
                <b class="lead font-weight-bold">2. </b>
                Marque los grupos en los que se considera se incluye al alumno altamente vulnerable.
              </label>
            </div>
            <div class="form-group">
              <div class="form-check">
                <?php 
                  if ($dataEval->opcion1 != "") {
                ?>
                <input checked class="form-check-input" id="opcion1Edit" type="checkbox" name="opcion1" value="Aspectos socioeconomicos">
                <label class="form-check-label " for="opcion1Edit">
                  Aspectos socioeconomicos
                </label>
                <?php
                  } else {
                ?>
                <input class="form-check-input" id="opcion1Edit" type="checkbox" name="opcion1" value="Aspectos socioeconomicos">
                <label class="form-check-label " for="opcion1Edit">
                  Aspectos socioeconomicos
                </label>
                <?php    
                  }
                ?>
                
              </div>
              <div class="form-check">
                <?php 
                  if ($dataEval->opcion2 != "") {
                ?>
                <input checked class="form-check-input" id="opcion2Edit" type="checkbox" name="opcion2" value="Aspectos personales">
                <label class="form-check-label " for="opcion2Edit">
                  Aspectos personales
                </label>
                <?php    
                  } else {
                ?>
                <input class="form-check-input" id="opcion2Edit" type="checkbox" name="opcion2" value="Aspectos personales">
                <label class="form-check-label " for="opcion2Edit">
                  Aspectos personales
                </label> 
                <?php    
                  }
                ?>
              </div>
              <div class="form-check">
                <?php 
                  if ($dataEval->opcion3 != "") {
                ?>
                <input checked class="form-check-input" id="opcion3Edit" type="checkbox" name="opcion3" value="Aspectos academicos">
                <label class="form-check-label " for="opcion3Edit">
                  Aspectos academicos
                </label>
                <?php    
                  } else {
                ?>
                <input class="form-check-input" id="opcion3Edit" type="checkbox" name="opcion3" value="Aspectos academicos">
                <label class="form-check-label " for="opcion3Edit">
                  Aspectos academicos
                </label>
                <?php    
                  }
                ?>
              </div>
            </div>
            <div class="form-group">
              <label class=" font-weight-bold">
                <b class="lead font-weight-bold">3. </b>
                De los siguientes aspectos, seleccione aquellos que usted observa en el alumno de forma evidente
              </label>
            </div>
            <div class="form-group">
              <div class="form-check">
                <?php 
                  if ($dataEval->obesidad != "") {
                ?>
                <input checked class="form-check-input" type="checkbox" name="obesidad" value="OBESIDAD">
                <label class="form-check-label " for="obesidad">
                  OBESIDAD
                </label>
                <?php    
                  } else {
                ?>
                <input class="form-check-input" type="checkbox" name="obesidad" value="OBESIDAD">
                <label class="form-check-label " for="obesidad">
                  OBESIDAD
                </label>
                <?php    
                  }
                ?>
              </div>
              <div class="form-check">
                <?php 
                  if ($dataEval->delgadezExt != "") {
                ?>
                <input checked class="form-check-input" type="checkbox" name="delgadezExt" value="DELGADEZ EXTREMA">
                <label class="form-check-label " for="delgadezExt">
                  DELGADEZ EXTREMA
                </label>
                <?php    
                  } else {
                ?>
                <input class="form-check-input" type="checkbox" name="delgadezExt" value="DELGADEZ EXTREMA">
                <label class="form-check-label " for="delgadezExt">
                  DELGADEZ EXTREMA
                </label>
                <?php    
                  }
                ?>
              </div>
              <div class="form-check">
                <?php 
                  if ($dataEval->manchasPiel != "") {
                ?>
                <input checked class="form-check-input" type="checkbox" name="manchasPiel" value="MANCHAS EN LA PIEL">
                <label class="form-check-label " for="manchasPiel">
                  MANCHAS EN LA PIEL
                </label>
                <?php    
                  } else {
                ?>
                <input class="form-check-input" type="checkbox" name="manchasPiel" value="MANCHAS EN LA PIEL">
                <label class="form-check-label " for="manchasPiel">
                  MANCHAS EN LA PIEL
                </label>
                <?php    
                  }
                ?>
              </div>
              <div class="form-check">
                <?php 
                  if ($dataEval->faltaEnergia != "") {
                ?>
                <input checked class="form-check-input" type="checkbox" name="faltaEnergia" value="FALTA ENERGÍA">
                <label class="form-check-label " for="faltaEnergia">
                  FALTA ENERGÍA
                </label>
                <?php    
                  } else {
                ?>
                <input class="form-check-input" type="checkbox" name="faltaEnergia" value="FALTA ENERGÍA">
                <label class="form-check-label " for="faltaEnergia">
                  FALTA ENERGÍA
                </label>
                <?php    
                  }
                ?>
              </div>
              <div class="form-check">
                <?php 
                  if ($dataEval->problemDen != "") {
                ?>
                <input checked class="form-check-input" type="checkbox" name="problemDen" value="PROBLEMAS DE DENTADURA">
                <label class="form-check-label " for="problemDen">
                  PROBLEMAS DE DENTADURA
                </label>
                <?php    
                  } else {
                ?>
                <input class="form-check-input" type="checkbox" name="problemDen" value="PROBLEMAS DE DENTADURA">
                <label class="form-check-label " for="problemDen">
                  PROBLEMAS DE DENTADURA
                </label>
                <?php    
                  }
                ?>
              </div>
              <div class="form-check">
                <?php 
                  if ($dataEval->problemVis != "") {
                ?>
                <input checked class="form-check-input" type="checkbox" name="problemVis" value="PROBLEMAS VISUALES">
                <label class="form-check-label " for="problemVis">
                  PROBLEMAS VISUALES
                </label>
                <?php    
                  } else {
                ?>
                <input class="form-check-input" type="checkbox" name="problemVis" value="PROBLEMAS VISUALES">
                <label class="form-check-label " for="problemVis">
                  PROBLEMAS VISUALES
                </label>
                <?php    
                  }
                ?>
              </div>
              <div class="form-check">
                <?php 
                  if ($dataEval->problemAud != "") {
                ?>
                <input checked class="form-check-input" type="checkbox" name="problemAud" value="PROBLEMAS AUDITIVOS">
                <label class="form-check-label " for="problemAud">
                  PROBLEMAS AUDITIVOS
                </label>
                <?php    
                  } else {
                ?>
                <input class="form-check-input" type="checkbox" name="problemAud" value="PROBLEMAS AUDITIVOS">
                <label class="form-check-label " for="problemAud">
                  PROBLEMAS AUDITIVOS
                </label>
                <?php    
                  }
                ?>
              </div>
              <div class="form-check">
                <?php 
                  if ($dataEval->discapacidades != "") {
                ?>
                <input checked class="form-check-input" type="checkbox" name="discapacidades" value="DISCAPACIDADES">
                <label class="form-check-label " for="discapacidades">
                  DISCAPACIDADES
                </label>
                <?php    
                  } else {
                ?>
                <input class="form-check-input" type="checkbox" name="discapacidades" value="DISCAPACIDADES">
                <label class="form-check-label " for="discapacidades">
                  DISCAPACIDADES
                </label>
                <?php    
                  }
                ?>
              </div>
            </div>
            <div class="form-group">
              <label class="">Otro:</label>
              <?php 
                if ($dataEval->otro != "") {
              ?>
              <input type="text" class="form-control" name="otro" value="<?php echo $dataEval->otro; ?>">  
              <?php    
                } else {
              ?>
              <input type="text" class="form-control" name="otro">    
              <?php   
                }
              ?>
            </div>
            <div class="form-group">
              <label class="font-weight-bold ">
                <b class="lead font-weight-bold">4. </b>
                Observaciones del tutor
              </label>
            </div>
            <div class="form-group">
              <textarea style="font-size: 20px;" name="obseval" class="form-control" rows="6">
                <?php echo $dataEval->obseval; ?>
              </textarea>
            </div>
            <div class="form-group">
              <label class="font-weight-bold ">
                Introduzca su contraseña para actualizar:
              </label>
            </div>
            <div class="form-group">
              <input type="password" id="passEditEval" name="passEditEval" class="form-control">
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal">
        <i class="fas fa-times-circle mr-2"></i>
        Cerrar</button>
        <button type="submit" class="btn btn-outline-primary btn-sm" id="btnGEditEval">
        <i class="fas fa-check-circle mr-2"></i>
        Guardar</button>
        </form>
      </div>
    </div>
  </div>
</div>
