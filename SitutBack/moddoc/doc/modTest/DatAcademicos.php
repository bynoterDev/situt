<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label class=" font-weight-bold">Bachillerato</label>
                <input type="text" readonly value="<?php echo $dataT->bachillerato; ?>" class="form-control">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label class=" font-weight-bold">Turno</label>
                <input type="text" readonly value="<?php echo $dataT->turno; ?>" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="localidadBach" class=" font-weight-bold">Localidad</label>
                <input type="text" readonly="" value="<?php echo $dataT->localidadBach; ?>" class="form-control">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label class=" font-weight-bold">Entidad</label>
                <input type="text" readonly="" value="<?php echo $dataT->entidadBach; ?>" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label class=" font-weight-bold">Especialidad</label>
                <input type="text" readonly value="<?php echo $dataT->especialidadBach; ?>" class="form-control">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label class=" font-weight-bold">Promedio</label>
                <input type="text" class="form-control" readonly="" value="<?php echo $dataT->promedioBach; ?>">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label class=" font-weight-bold">1. Puntaje examen CENEVAL</label>
                <input type="text" readonly="" value="<?php echo $dataT->ceneval; ?>" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label class=" font-weight-bold">2. ??Por qu?? elegiste estudiar en una Universidad T??cnologica?</label>
                <textarea class="form-control" readonly="">
                    <?php echo $dataT->estudiar; ?>
                </textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label class=" font-weight-bold">3. ??Esta universidad era tu primera opcion?</label>
                <input type="text" readonly="" value="<?php echo $dataT->opcionUni; ?>" class="form-control">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label class=" font-weight-bold">4. ??Esta carrera era tu primera opci??n?</label>
                <input type="text" readonly="" value="<?php echo $dataT->opcionCar; ?>" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label class=" font-weight-bold">5. ??Qu?? esperas de esta carrera?</label>
                <textarea class="form-control" readonly="">
                    <?php echo $dataT->carreraEsp; ?>
                </textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label class=" font-weight-bold">6. ??Tienes planeado presentar examen de admisi??n para ingresar a otra escuela o carrera?</label>
                <input type="text" readonly="" value="<?php echo $dataT->planExm; ?>" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label class=" font-weight-bold">7. ??Qu?? materias se te dificultan m??s?</label>
                <input type="text" readonly="" value="<?php echo $dataT->dificultMat; ?>" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-8">
            <div class="form-group">
                <label class=" font-weight-bold">8. ??Has reprobado alguna materia o aprobado algun examen estraordinario?</label>
                <input type="text" readonly="" value="<?php echo $dataT->reprobado; ?>" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label class="">??Qu?? materias?</label>
                <input readonly="" type="text" value="<?php echo $dataT->materiasRep; ?>" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-8">
            <div class="form-group">
                <label class=" font-weight-bold">9. ??Utilizas alguna manera o t??cnica de estudio?</label>
                <input type="text" readonly="" value="<?php echo $dataT->tecnica; ?>" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label class="">??Cu??l?</label>
                <input readonly type="text" value="<?php echo $dataT->cualTec; ?>" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-8">
            <div class="form-group">
                <label class=" font-weight-bold">10. ??Cuentas en tu cassa con algunos libros que apoyan tus estudios?</label>
                <input type="text" readonly="" value="<?php echo $dataT->libros; ?>" class="form-control">
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label class="">??Cuantos aproximadamente?</label>
                <input type="text" readonly="" value="<?php echo $dataT->cantLib; ?>" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label class=" font-weight-bold">11. ??Tienes computadora en tu casa como apoyo para tus trabajos y tareas escolares?</label>
                <input type="text" readonly value="<?php echo $dataT->computadora; ?>" class="form-control">
            </div>
        </div>
    </div>
</div>
<br><br>