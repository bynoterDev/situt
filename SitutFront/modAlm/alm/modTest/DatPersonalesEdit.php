<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="padeces" class="font-weight-bold">1. ¿Padeces alguna enfermedad o alergia?</label>
                <select onchange="habTest3();" name="padeces" id="padeces" class="form-control">
                    <?php 
                        if ($testVal -> padeces == "Si") {
                    ?>
                        <option value="0">Selecciona</option>
                        <option value="Si" selected>Si</option>
                        <option value="No">No</option>
                    <?php
                        } else {
                    ?>
                        <option value="0">Selecciona</option>
                        <option value="Si">Si</option>
                        <option value="No" selected>No</option>
                    <?php
                        }
                    ?>
                </select>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="especificaEnf" class="">Especifica</label> 
                <?php 
                    if ($testVal -> padeces == "Si") {
                ?>
                    <input type="text" value="<?php echo $testVal->especificaEnf; ?>" id="especificaEnf" name="especificaEnf" class="form-control">
                <?php
                    } else {
                ?>
                    <input type="text" disabled="" id="especificaEnf" name="especificaEnf" class="form-control">
                <?php        
                    }
                ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label for="frec_enferm" class="font-weight-bold">2. ¿Con qué frecuencia presentas enfermedades menores como gripe, infecciones estomacales, dolores de cabeza etc?(Especifica enfermedad y frecuencia).</label>
                <select onchange="habTestP3();" id="frec_enferm" name="frec_enferm" class="form-control">
                    <?php 
                        if ($testVal -> frec_enferm == "Mucha") {
                    ?>
                        <option value="0">Selecciona</option>
                        <option selected value="Mucha">Mucha</option>
                        <option value="Regular">Regular</option>
                        <option value="Poca">Poca</option>
                    <?php        
                        }
                    ?>
                    <?php 
                        if ($testVal -> frec_enferm == "Regular") {
                    ?>
                        <option value="0">Selecciona</option>
                        <option value="Mucha">Mucha</option>
                        <option selected value="Regular">Regular</option>
                        <option value="Poca">Poca</option>
                    <?php        
                        }
                    ?>
                    <?php 
                        if ($testVal -> frec_enferm == "Poca") {
                    ?>
                        <option value="0">Selecciona</option>
                        <option value="Mucha">Mucha</option>
                        <option value="Regular">Regular</option>
                        <option selected value="Poca">Poca</option>
                    <?php        
                        }
                    ?>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-8">
            <div class="form-group">
                <label for="espEnf" class="">Especifica enfermedad</label>
                <input type="text" value="<?php echo $testVal->espEnf; ?>" id="espEnf" name="espEnf" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="medicamento" class="font-weight-bold">3. ¿Tomas algún medicamento periodicamente?</label>
                <select onchange="habTest4();" name="medicamento" id="medicamento" class="form-control">
                    <?php 
                        if ($testVal -> medicamento == "Si") {
                    ?>
                        <option value="0">Seleccionar</option>
                        <option value="Si" selected>Si</option>
                        <option value="No">No</option>
                    <?php
                        }
                    ?>
                    <?php 
                        if ($testVal -> medicamento == "No") {
                    ?>
                        <option value="0">Seleccionar</option>
                        <option value="Si">Si</option>
                        <option value="No" selected>No</option>
                    <?php
                        }
                    ?>
                </select>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="cualMed" class="">¿Cúal?</label>
                <?php 
                    if ($testVal -> medicamento == "Si") {
                ?>
                    <input value="<?php echo $testVal->cualMed; ?>" type="text" id="cualMed" name="cualMed" class="form-control">
                <?php
                    } else {
                ?>
                    <input disabled="" type="text" id="cualMed" name="cualMed" class="form-control">
                <?php        
                    }
                ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="fumas" class="font-weight-bold">4. ¿Fumas?</label>
                <select onchange="habTest5();" name="fumas" id="fumas" class="form-control">
                    <?php 
                        if ($testVal -> fumas == "Si") {
                    ?>
                        <option value="0">Seleccionar</option>
                        <option value="Si" selected>Si</option>
                        <option value="No">No</option>
                    <?php
                        }
                    ?>
                    <?php 
                        if ($testVal -> fumas == "No") {
                    ?>
                        <option value="0">Seleccionar</option>
                        <option value="Si">Si</option>
                        <option value="No" selected>No</option>
                    <?php
                        }
                    ?>
                </select>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="cantidadFum" class="">Especifica cantidad y frecuencia</label>
                <?php 
                    if ($testVal -> fumas == "Si") {
                ?>
                    <input value="<?php echo $testVal->cantidadFum ?>" type="text" id="cantidadFum" name="cantidadFum" class="form-control">
                <?php
                    } else {
                ?>
                    <input disabled="" type="text" id="cantidadFum" name="cantidadFum" class="form-control">
                <?php
                    }
                ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="alchol" class=" font-weight-bold">5. ¿Ingieres bebidas alcholicas?</label>
                <select onchange="habTest6();" name="alchol" id="alchol" class="form-control">
                    <?php 
                        if ($testVal -> alchol == "Si") {
                    ?>
                        <option value="0">Seleccionar</option>
                        <option value="Si" selected>Si</option>
                        <option value="No">No</option>
                    <?php
                        }
                    ?>
                    <?php 
                        if ($testVal -> alchol == "No") {
                    ?>
                        <option value="0">Seleccionar</option>
                        <option value="Si">Si</option>
                        <option value="No" selected>No</option>
                    <?php
                        }
                    ?>
                </select>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="cantidadBeb" class="">Especifica cantidad y frecuencia</label>
                <?php 
                    if ($testVal -> alchol == "Si") {
                ?>
                    <input value="<?php echo $testVal->cantidadBeb; ?>" type="text" id="cantidadBeb" name="cantidadBeb" class="form-control">
                <?php
                    } else {
                ?>
                    <input disabled="" type="text" id="cantidadBeb" name="cantidadBeb" class="form-control">
                <?php        
                    }
                ?>  
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label for="cualidades" class="font-weight-bold">6. ¿Cuáles consideras que son tus principales cualidades?</label>
                <input value="<?php echo $testVal->cualidades; ?>" type="text" id="cualidades" name="cualidades" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label for="defectos" class="font-weight-bold">7. ¿Cuáles consideras que son tus principales defectos?</label>
                <input value="<?php echo $testVal->defectos; ?>" type="text" name="defectos" id="defectos" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label for="aprecias" class="font-weight-bold">8. ¿Qué valores aprecias más en la gente?</label>
                <input type="text" value="<?php echo $testVal->aprecias; ?>" id="aprecias" name="aprecias" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label for="disgusta" class="font-weight-bold">9. ¿Qué es lo que más te disgusta de la gente?</label>
                <input type="text" value="<?php echo $testVal->disgusta; ?>" id="disgusta" name="disgusta" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label for="temor" class="font-weight-bold">10. Menciona tres situaciones o aspectos que te causen temor:</label>
                <textarea class="form-control" name="temor" id="temor" rows="5">
                    <?php echo $testVal->temor; ?>
                </textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="novio" class="font-weight-bold">11. ¿Actualmente tienes novio(a)?</label>
                <select name="novio" id="novio" class="form-control">
                    <?php 
                        if ($testVal -> novio == "Si") {
                    ?>
                        <option value="0">Seleccionar</option>
                        <option value="Si" selected>Si</option>
                        <option value="No">No</option>
                    <?php  
                        }
                    ?>
                    <?php 
                        if ($testVal -> novio == "No") {
                    ?>
                        <option value="0">Seleccionar</option>
                        <option value="Si">Si</option>
                        <option value="No" selected>No</option>
                    <?php  
                        }
                    ?>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="planes" class="font-weight-bold">12. ¿Tienes planes de matrimonio a corto plazo?</label>
                <select name="planes" id="planes" class="form-control">
                    <?php 
                        if ($testVal -> planes == "Si") {
                    ?>
                        <option value="0">Seleccionar</option>
                        <option value="Si" selected>Si</option>
                        <option value="No">No</option>
                    <?php
                        }
                    ?>
                    <?php 
                        if ($testVal -> planes == "No") {
                    ?>
                        <option value="0">Seleccionar</option>
                        <option value="Si">Si</option>
                        <option value="No" selected>No</option>
                    <?php
                        }
                    ?>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label for="f_personal" class="font-weight-bold">13. ¿Qué planes tienes para tú futuro personal?</label>
                <textarea name="f_personal" id="f_personal" class="form-control">
                    <?php echo $testVal->f_personal; ?>
                </textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label for="f_academico" class="font-weight-bold">14. ¿Qué planes tienes para tú futuro academico?</label>
                <textarea name="f_academico" id="f_academico" class="form-control">
                    <?php echo $testVal->f_academico; ?>
                </textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label for="f_profesional" class="font-weight-bold">15. ¿Qué planes tienes para tú futuro profesional?</label>
                <textarea name="f_profesional" id="f_profesional" class="form-control">
                    <?php echo $testVal->f_profesional; ?>
                </textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label for="t_libre" class="font-weight-bold">16. ¿A que te dedicas en tú tiempo libre?</label>
                <textarea name="t_libre" id="t_libre" class="form-control">
                    <?php echo $testVal->t_libre; ?>
                </textarea>
            </div>
        </div>
    </div>
</div>
<br><br>