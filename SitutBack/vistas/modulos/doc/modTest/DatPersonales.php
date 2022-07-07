<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label class=" font-weight-bold">1. ¿Padeces alguna enfermedad o alergia?</label>
                <input type="text" readonly value="<?php echo $dataT->padeces; ?>" class="form-control">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label class="">Especifica</label> 
                <input type="text" readonly value="<?php echo $dataT->especificaEnf; ?>" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label for="frec_enferm" class=" font-weight-bold">2. ¿Con qué frecuencia presentas enfermedades menores como gripe, infecciones estomacales, dolores de cabeza etc?(Especifica enfermedad y frecuencia).</label>
                <input type="text" readonly value="<?php echo $dataT->frec_enferm; ?>" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-8">
            <div class="form-group">
                <label class="">Especifica enfermedad</label>
                <input type="text" readonly="" value="<?php echo $dataT->espEnf; ?>" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label class=" font-weight-bold">3. ¿Tomas algún medicamento periodicamente?</label>
                <input type="text" readonly value="<?php echo $dataT->medicamento; ?>" class="form-control">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label class="">¿Cúal?</label>
                <input type="text" readonly value="<?php echo $dataT->cualMed; ?>" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="fumas" class=" font-weight-bold">4. ¿Fumas?</label>
                <input type="text" readonly value="<?php echo $dataT->fumas; ?>" class="form-control">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label class="">Especifica cantidad y frecuencia</label>
                <input readonly type="text" value="<?php echo $dataT->cantidadFum; ?>" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label class=" font-weight-bold">5. ¿Ingieres bebidas alcholicas?</label>
                <input type="text" readonly value="<?php echo $dataT->alchol; ?>" class="form-control">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label class="">Especifica cantidad y frecuencia</label>
                <input readonly value="<?php echo $dataT->cantidadBeb; ?>" type="text" class="form-control">  
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label class=" font-weight-bold">6. ¿Cuáles consideras que son tus principales cualidades?</label>
                <input type="text" readonly="" value="<?php echo $dataT->cualidades; ?>" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label class=" font-weight-bold">7. ¿Cuáles consideras que son tus principales defectos?</label>
                <input type="text" readonly="" value="<?php echo $dataT->defectos; ?>" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label class=" font-weight-bold">8. ¿Qué valores aprecias más en la gente?</label>
                <input type="text" readonly="" value="<?php echo $dataT->aprecias; ?>" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label class=" font-weight-bold">9. ¿Qué es lo que más te disgusta de la gente?</label>
                <input type="text" readonly="" value="<?php echo $dataT->disgusta; ?>" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label class=" font-weight-bold">10. Menciona tres situaciones o aspectos que te causen temor:</label>
                <textarea readonly="" class="form-control" rows="5">
                    <?php echo $dataT->temor; ?>
                </textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label class=" font-weight-bold">11. ¿Actualmente tienes novio(a)?</label>
                <input type="text" readonly value="<?php echo $dataT->novio; ?>" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label class=" font-weight-bold">12. ¿Tienes planes de matrimonio a corto plazo?</label>
                <input type="text" readonly="" value="<?php echo $dataT->planes; ?>" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label class=" font-weight-bold">13. ¿Qué planes tienes para tú futuro personal?</label>
                <textarea readonly="" class="form-control">
                    <?php echo $dataT->f_personal; ?>
                </textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label class=" font-weight-bold">14. ¿Qué planes tienes para tú futuro academico?</label>
                <textarea readonly="" class="form-control">
                    <?php echo $dataT->f_academico; ?>
                </textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label class=" font-weight-bold">15. ¿Qué planes tienes para tú futuro profesional?</label>
                <textarea readonly="" class="form-control">
                    <?php echo $dataT->f_profesional; ?>
                </textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label class=" font-weight-bold">16. ¿A que te dedicas en tú tiempo libre?</label>
                <textarea class="form-control" readonly="">
                    <?php echo $dataT->t_libre; ?>
                </textarea>
            </div>
        </div>
    </div>
</div>
<br><br>