
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="form-group">
                <label for="reside" class="font-weight-bold">1. ¿Resides en esta ciudad?</label>
                <?php 
                    if ($testVal->reside == "Si") {
                ?> 
                    <select onchange="habTest1();" name="reside" id="reside" class="form-control">
                    <option value="0">Seleccionar</option>
                    <option value="Si" selected="">Si</option>
                    <option value="No">No</option>
                </select>
                <?php
                    } else {
                ?>
                    <select onchange="habTest1();" name="reside" id="reside" class="form-control">
                        <option value="0">Seleccionar</option>
                        <option value="Si">Si</option>
                        <option value="No" selected>No</option>
                    </select>
                <?php
                    }
                ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="tiempo" class="">Tiempo</label>
                <?php 
                    if ($testVal -> reside == "Si") {
                ?>
                    <input value="<?php echo $testVal->tiempo_Res; ?>" type="text" id="tiempo" name="tiempo" class="form-control">
                <?php
                    } else {
                ?>
                    <input disabled="" type="text" id="tiempo" name="tiempo" class="form-control">
                <?php        
                    }
                ?>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="especifica" class="">Especifica</label>
                <?php 
                    if ($testVal -> reside == "No") {
                ?>
                    <input value="<?php echo $testVal->especifica_res; ?>" type="text" id="especifica" name="especifica" class="form-control">
                <?php
                    } else {
                ?>
                    <input disabled="" type="text" id="especifica" name="especifica" class="form-control">
                <?php
                    }
                ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="vives" class="font-weight-bold">2. ¿Con quién vives actualmente?</label>
                <input value="<?php echo $testVal->vives; ?>" type="text" id="vives" name="vives" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="trabajas" class="font-weight-bold">3. ¿Trabajas?</label>
                <?php 
                    if ($testVal -> trabajas == "Si") {
                ?>
                    <select onchange="habTest2();" name="trabajas" id="trabajas" class="form-control">
                        <option value="0">Seleccionar</option>
                        <option value="Si" selected="">Si</option>
                        <option value="No">No</option>
                    </select>
                <?php
                    } else {
                ?>
                    <select onchange="habTest2();" name="trabajas" id="trabajas" class="form-control">
                        <option value="0">Seleccionar</option>
                        <option value="Si">Si</option>
                        <option value="No" selected>No</option>
                    </select>
                <?php        
                    }
                ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="donde_trabajas" class="">¿En dónde?</label>
                <?php 
                    if ($testVal -> trabajas == "Si") {
                ?>
                    <input value="<?php echo $testVal->donde_trabajas; ?>" type="text" id="donde_trabajas" name="donde_trabajas" class="form-control">
                <?php
                    } else {
                ?>
                    <input disabled="" type="text" id="donde_trabajas" name="donde_trabajas" class="form-control">
                <?php        
                    }
                ?>
            </div>
            <div class="form-group">
                <label for="ingresoTrab" class="lead">Ingreso</label>
                <?php 
                    if ($testVal -> trabajas == "Si") {
                ?>
                    <input value="<?php echo $testVal->ingresoTrab ?>" type="number" id="ingresoTrab" name="ingresoTrab" class="form-control">
                <?php
                    } else {
                ?>
                    <input disabled="" type="number" id="ingresoTrab" name="ingresoTrab" class="form-control">
                <?php        
                    }
                ?>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="horas_tr" class="">No. de horas trabajadas</label>
                <?php 
                    if ($testVal -> trabajas == "Si") {
                ?>
                    <input value="<?php echo $testVal->horas_tr ?>" type="number" id="horas_tr" name="horas_tr" class="form-control">
                <?php   
                    } else {
                ?>
                    <input disabled="" type="number" id="horas_tr" name="horas_tr" class="form-control">
                <?php        
                    }
                ?>
            </div>
            <div class="form-group">
                <label for="ingrDependes" class="">Ingreso mensual de quien dependes</label>
                <?php 
                    if ($testVal -> trabajas == "No") {
                ?>
                    <input value="<?php echo $testVal->ingrDependes; ?>" type="number" id="ingrDependes" name="ingrDependes" class="form-control">
                <?php
                    } else {
                ?>
                    <input disabled="" type="number" id="ingrDependes" name="ingrDependes" class="form-control">
                <?php        
                    }
                ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="economicamente" class="font-weight-bold">4. ¿De quién dependes economicamente?</label>
                <input value="<?php echo $testVal->economicamente; ?>" type="text" id="economicamente" name="economicamente" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="papa" class="font-weight-bold">5. ¿A que se dedica tu papá?</label>
                <input value="<?php echo $testVal->papa; ?>" type="text" id="papa" name="papa" class="form-control">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="mama" class="font-weight-bold">¿A que se dedica tu mamá?</label>
                <input value="<?php echo $testVal->mama; ?>" type="text" id="mama" name="mama" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="hermanos" class="font-weight-bold">6. Si tienes hermanos menciona cuantos son</label>
                <input value="<?php echo $testVal->hermanos; ?>" type="number" id="hermanos" name="hermanos" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label for="actividad_herm" class="font-weight-bold">Señala la actividad de cada uno de ellos</label>
                <textarea id="actividad_herm" name="actividad_herm" class="form-control" rows="5">
                    <?php echo $testVal->actividad_herm; ?>
                </textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="habitas" class="font-weight-bold">7. La casa que habitas es:</label>
                <select name="habitas" id="habitas" class="form-control">
                    <?php 
                        if ($testVal->habitas == "Propia") {
                    ?>  
                        <option value="0">Seleccionar</option>
                        <option value="Propia" selected>Propia</option>
                        <option value="Rentada">Rentada</option>
                        <option value="Prestada">Prestada</option>
                        <option value="Otro">Otros</option>
                    <?php
                        }
                    ?>
                    <?php 
                        if ($testVal->habitas == "Rentada") {
                    ?>  
                        <option value="0">Seleccionar</option>
                        <option value="Propia">Propia</option>
                        <option value="Rentada" selected>Rentada</option>
                        <option value="Prestada">Prestada</option>
                        <option value="Otro">Otros</option>
                    <?php
                        }
                    ?>
                    <?php 
                        if ($testVal->habitas == "Prestada") {
                    ?>  
                        <option value="0">Seleccionar</option>
                        <option value="Propia">Propia</option>
                        <option value="Rentada">Rentada</option>
                        <option value="Prestada" selected>Prestada</option>
                        <option value="Otro">Otros</option>
                    <?php
                        }
                    ?>
                    <?php 
                        if ($testVal->habitas == "Otro") {
                    ?>  
                        <option value="0">Seleccionar</option>
                        <option value="Propia">Propia</option>
                        <option value="Rentada">Rentada</option>
                        <option value="Prestada">Prestada</option>
                        <option value="Otro" selected>Otros</option>
                    <?php
                        }
                    ?>
                </select>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="ingreso_familiar" class="font-weight-bold">8. Ingreso familiar mensual (Aproximado)</label>
                <input value="<?php echo $testVal->ingreso_familiar; ?>" type="text" id="ingreso_familiar" name="ingreso_familiar" class="form-control">
            </div>
        </div>
    </div>
</div>
<br><br>
