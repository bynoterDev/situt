
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="form-group">
                <label class="font-weight-bold ">1. ¿Resides en esta ciudad?</label>
                <input type="text" readonly value="<?php echo $dataT->reside; ?>" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label class="">Tiempo</label>
                <input type="text" readonly value="<?php echo $dataT->tiempo_Res; ?>" class="form-control">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label class="">Especifica</label>
                <input type="text" readonly value="<?php echo $dataT->especifica_res; ?>" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label class=" font-weight-bold">2. ¿Con quién vives actualmente?</label>
                <input type="text" readonly value="<?php echo $dataT->vives; ?>" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="trabajas" class=" font-weight-bold">3. ¿Trabajas?</label>
                <input type="text" readonly value="<?php echo $dataT->trabajas; ?>" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label class="">¿En dónde?</label>
                <input readonly type="text" value="<?php echo $dataT->donde_trabajas; ?>" class="form-control">
            </div>
            <div class="form-group">
                <label class="">Ingreso</label>
                <input readonly type="text" value="<?php echo $dataT->ingresoTrab; ?>" class="form-control">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label class="">No. de horas trabajadas</label>
                <input readonly type="text" value="<?php echo $dataT->horas_tr; ?>" class="form-control">
            </div>
            <div class="form-group">
                <label class="">Ingreso mensual de quien dependes</label>
                <input readonly type="text" value="<?php echo $dataT->ingrDependes; ?>" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label class="font-weight-bold ">4. ¿De quién dependes economicamente?</label>
                <input type="text" readonly value="<?php echo $dataT->economicamente; ?>" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label class=" font-weight-bold">5. ¿A que se dedica tu papá?</label>
                <input type="text" readonly value="<?php echo $dataT->papa; ?>" class="form-control">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label class=" font-weight-bold">¿A que se dedica tu mamá?</label>
                <input type="text" readonly value="<?php echo $dataT->mama; ?>" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label class=" font-weight-bold">6. Si tienes hermanos menciona cuantos son</label>
                <input type="text" readonly value="<?php echo $dataT->hermanos; ?>" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label class=" font-weight-bold">Señala la actividad de cada uno de ellos</label>
                <textarea class="form-control" rows="5" readonly>
                    <?php echo $dataT->actividad_herm ?>
                </textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label class=" font-weight-bold">7. La casa que habitas es:</label>
                <input type="text" readonly value="<?php echo $dataT->habitas; ?>"  class="form-control">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label class=" font-weight-bold">8. Ingreso familiar mensual (Aproximado)</label>
                <input type="text" readonly value="<?php echo $dataT->ingreso_familiar; ?>" class="form-control">
            </div>
        </div>
    </div>
</div>
<br><br>
