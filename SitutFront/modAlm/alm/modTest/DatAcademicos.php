<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="bachillerato" class=" font-weight-bold">Bachillerato</label>
                <input type="text" id="bachillerato" name="bachillerato" class="form-control">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="turno" class=" font-weight-bold">Turno</label>
                <select class="form-control" id="turno" name="turno">
                    <option value="0" selected="">Selecciona</option>
                    <option value="Matutino">Matutino</option>
                    <option value="Vespertino">Vespertino</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="localidadBach" class=" font-weight-bold">Localidad</label>
                <input type="text" id="localidadBach" name="localidadBach" class="form-control">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="entidadBach" class=" font-weight-bold">Entidad</label>
                <input type="text" id="entidadBach" name="entidadBach" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="especialidadBach" class=" font-weight-bold">Especialidad</label>
                <input type="text" id="especialidadBach" name="especialidadBach" class="form-control">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="promedioBach" class=" font-weight-bold">Promedio</label>
                <input type="number" id="promedioBach" name="promedioBach" class="form-control" step="any">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="ceneval" class=" font-weight-bold">1. Puntaje examen CENEVAL</label>
                <input type="number" name="ceneval" id="ceneval" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label for="estudiar" class=" font-weight-bold">2. ¿Por qué elegiste estudiar en una Universidad Técnologica?</label>
                <textarea name="estudiar" id="estudiar" class="form-control"></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="opcionUni" class=" font-weight-bold">3. ¿Esta universidad era tu primera opcion?</label>
                <select name="opcionUni" id="opcionUni" class="form-control">
                    <option disabled="" selected="" value="0">Seleccionar</option>
                    <option value="Si">Si</option>
                    <option value="No">No</option>
                </select>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="opcionCar" class=" font-weight-bold">4. ¿Esta carrera era tu primera opción?</label>
                <select name="opcionCar" id="opcionCar" class="form-control">
                    <option value="0" selected="" disabled="">Selecionar</option>
                    <option value="Si">Si</option>
                    <option value="No">No</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label for="carreraEsp" class=" font-weight-bold">5. ¿Qué esperas de esta carrera?</label>
                <textarea name="carreraEsp" id="carreraEsp" class="form-control"></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label for="planExm" class=" font-weight-bold">6. ¿Tienes planeado presentar examen de admisión para ingresar a otra escuela o carrera?</label>
                <input type="text" name="planExm" id="planExm" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label for="dificultMat" class=" font-weight-bold">7. ¿Qué materias se te dificultan más?</label>
                <input type="text" name="dificultMat" id="dificultMat" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-8">
            <div class="form-group">
                <label for="reprobado" class=" font-weight-bold">8. ¿Has reprobado alguna materia o aprobado algun examen estraordinario?</label>
                <select onchange="habTest7();" name="reprobado" id="reprobado" class="form-control">
                    <option value="0" selected="">Seleccionar</option>
                    <option value="Si">Si</option>
                    <option value="No">No</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label for="materiasRep" class="">¿Qué materias?</label>
                <input disabled="" type="text" name="materiasRep" id="materiasRep" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-8">
            <div class="form-group">
                <label for="tecnica" class=" font-weight-bold">9. ¿Utilizas alguna manera o técnica de estudio?</label>
                <select onchange="habTest8();" name="tecnica" id="tecnica" class="form-control">
                    <option value="0" selected="">Seleccionar</option>
                    <option value="Si">Si</option>
                    <option value="No">No</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label for="cualTec" class="">¿Cuál?</label>
                <input disabled="" type="text" name="cualTec" id="cualTec" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-8">
            <div class="form-group">
                <label for="libros" class=" font-weight-bold">10. ¿Cuentas en tu cassa con algunos libros que apoyan tus estudios?</label>
                <select onchange="habTest9();" name="libros" id="libros" class="form-control">
                    <option value="0" selected="">Seleccionar</option>
                    <option value="Si">Si</option>
                    <option value="No">No</option>
                </select>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="cantLib" class="">¿Cuantos aproximadamente?</label>
                <input type="text" disabled="" name="cantLib" id="cantLib" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label for="computadora" class=" font-weight-bold">11. ¿Tienes computadora en tu casa como apoyo para tus trabajos y tareas escolares?</label>
                <select name="computadora" id="computadora" class="form-control">
                    <option value="0" selected="">Seleccionar</option>
                    <option value="Si">Si</option>
                    <option value="No">No</option>
                </select>
            </div>
        </div>
    </div>
</div>
<br><br>