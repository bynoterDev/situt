<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="padeces" class=" font-weight-bold">1. ¿Padeces alguna enfermedad o alergia?</label>
                <select onchange="habTest3();" name="padeces" id="padeces" class="form-control">
                    <option value="0" selected="">Selecciona</option>
                    <option value="Si">Si</option>
                    <option value="No">No</option>
                </select>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="especificaEnf" class="">Especifica</label> 
                <input type="text" disabled="" id="especificaEnf" name="especificaEnf" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label for="frec_enferm" class=" font-weight-bold">2. ¿Con qué frecuencia presentas enfermedades menores como gripe, infecciones estomacales, dolores de cabeza etc?(Especifica enfermedad y frecuencia).</label>
                <select onchange="habTestP3();" id="frec_enferm" name="frec_enferm" class="form-control">
                    <option selected="" value="0">Selecciona</option>
                    <option value="Mucha">Mucha</option>
                    <option value="Regular">Regular</option>
                    <option value="Poca">Poca</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-8">
            <div class="form-group">
                <label for="espEnf" class="">Especifica enfermedad</label>
                <input type="text" disabled="" id="espEnf" name="espEnf" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="medicamento" class=" font-weight-bold">3. ¿Tomas algún medicamento periodicamente?</label>
                <select onchange="habTest4();" name="medicamento" id="medicamento" class="form-control">
                    <option value="0" selected="">Seleccionar</option>
                    <option value="Si">Si</option>
                    <option value="No">No</option>
                </select>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="cualMed" class="">¿Cúal?</label>
                <input disabled="" type="text" id="cualMed" name="cualMed" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="fumas" class=" font-weight-bold">4. ¿Fumas?</label>
                <select onchange="habTest5();" name="fumas" id="fumas" class="form-control">
                    <option value="0" selected="">Seleccionar</option>
                    <option value="Si">Si</option>
                    <option value="No">No</option>
                </select>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="cantidadFum" class="">Especifica cantidad y frecuencia</label>
                <input disabled="" type="text" id="cantidadFum" name="cantidadFum" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="alchol" class=" font-weight-bold">5. ¿Ingieres bebidas alcholicas?</label>
                <select onchange="habTest6();" name="alchol" id="alchol" class="form-control">
                    <option value="0" selected="">Seleccionar</option>
                    <option value="Si">Si</option>
                    <option value="No">No</option>
                </select>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="cantidadBeb" class="">Especifica cantidad y frecuencia</label>
                <input disabled="" type="text" id="cantidadBeb" name="cantidadBeb" class="form-control">  
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label for="cualidades" class=" font-weight-bold">6. ¿Cuáles consideras que son tus principales cualidades?</label>
                <input type="text" id="cualidades" name="cualidades" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label for="defectos" class=" font-weight-bold">7. ¿Cuáles consideras que son tus principales defectos?</label>
                <input type="text" name="defectos" id="defectos" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label for="aprecias" class=" font-weight-bold">8. ¿Qué valores aprecias más en la gente?</label>
                <input type="text" id="aprecias" name="aprecias" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label for="disgusta" class=" font-weight-bold">9. ¿Qué es lo que más te disgusta de la gente?</label>
                <input type="text" id="disgusta" name="disgusta" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label for="temor" class=" font-weight-bold">10. Menciona tres situaciones o aspectos que te causen temor:</label>
                <textarea class="form-control" name="temor" id="temor" rows="5"></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="novio" class=" font-weight-bold">11. ¿Actualmente tienes novio(a)?</label>
                <select name="novio" id="novio" class="form-control">
                    <option value="0" selected="">Seleccionar</option>
                    <option value="Si">Si</option>
                    <option value="No">No</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="planes" class=" font-weight-bold">12. ¿Tienes planes de matrimonio a corto plazo?</label>
                <select name="planes" id="planes" class="form-control">
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
                <label for="f_personal" class=" font-weight-bold">13. ¿Qué planes tienes para tú futuro personal?</label>
                <textarea name="f_personal" id="f_personal" class="form-control"></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label for="f_academico" class=" font-weight-bold">14. ¿Qué planes tienes para tú futuro academico?</label>
                <textarea name="f_academico" id="f_academico" class="form-control"></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label for="f_profesional" class=" font-weight-bold">15. ¿Qué planes tienes para tú futuro profesional?</label>
                <textarea name="f_profesional" id="f_profesional" class="form-control"></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label for="t_libre" class=" font-weight-bold">16. ¿A que te dedicas en tú tiempo libre?</label>
                <textarea name="t_libre" id="t_libre" class="form-control"></textarea>
            </div>
        </div>
    </div>
</div>
<br><br>