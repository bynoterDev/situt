
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="form-group">
                <label for="reside" class="font-weight-bold">1. ¿Resides en esta ciudad?</label>
                <select onchange="habTest1();" name="reside" id="reside" class="form-control">
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
                <label for="tiempo" class="">Tiempo</label>
                <input disabled="" type="text" id="tiempo" name="tiempo" class="form-control">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="especifica" class="">Especifica</label>
                <input disabled="" type="text" id="especifica" name="especifica" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="vives" class=" font-weight-bold">2. ¿Con quién vives actualmente?</label>
                <input type="text" id="vives" name="vives" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="trabajas" class=" font-weight-bold">3. ¿Trabajas?</label>
                <select onchange="habTest2();" name="trabajas" id="trabajas" class="form-control">
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
                <label for="donde_trabajas" class="">¿En dónde?</label>
                <input disabled="" type="text" id="donde_trabajas" name="donde_trabajas" class="form-control">
            </div>
            <div class="form-group">
                <label for="ingreso" class="">Ingreso</label>
                <input disabled="" type="number" id="ingresoTrab" name="ingreso" class="form-control">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="horas_tr" class="">No. de horas trabajadas</label>
                <input disabled="" type="number" id="horas_tr" name="horas_tr" class="form-control">
            </div>
            <div class="form-group">
                <label for="ingrDependes" class="">Ingreso mensual de quien dependes</label>
                <input disabled="" type="number" id="ingrDependes" name="ingrDependes" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="economicamente" class="font-weight-bold ">4. ¿De quién dependes economicamente?</label>
                <input type="text" id="economicamente" name="economicamente" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="papa" class=" font-weight-bold">5. ¿A que se dedica tu papá?</label>
                <input type="text" id="papa" name="papa" class="form-control">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="mama" class=" font-weight-bold">¿A que se dedica tu mamá?</label>
                <input type="text" id="mama" name="mama" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="hermanos" class=" font-weight-bold">6. Si tienes hermanos menciona cuantos son</label>
                <input type="number" id="hermanos" name="hermanos" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label for="actividad_herm" class=" font-weight-bold">Señala la actividad de cada uno de ellos</label>
                <textarea id="actividad_herm" name="actividad_herm" class="form-control" rows="5"></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="habitas" class=" font-weight-bold">7. La casa que habitas es:</label>
                <select name="habitas" id="habitas" class="form-control">
                    <option value="0" selected="">Seleccionar</option>
                    <option value="Propia">Propia</option>
                    <option value="Rentada">Rentada</option>
                    <option value="Prestada">Prestada</option>
                    <option value="Otro">Otros</option>
                </select>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="ingreso_familiar" class=" font-weight-bold">8. Ingreso familiar mensual (Aproximado)</label>
                <input type="text" id="ingreso_familiar" name="ingreso_familiar" class="form-control">
            </div>
        </div>
    </div>
</div>
<br><br>
