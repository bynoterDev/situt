<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label class="font-weight-bold">Nombre:</label>
                <input readonly type="text" value="<?php echo $dataP->nombre_c_al; ?>" class="form-control">
            </div>
            <div class="form-group">
                <label class=" font-weight-bold">Matricula:</label>
                <input type="text" readonly value="<?php echo $dataP->matricula_al; ?>" class="form-control">
            </div>
            <div class="form-group">
                <label class=" font-weight-bold">Carrera:</label>
                <input readonly type="text" value="<?php echo $dataP->nombre_car; ?>" class="form-control">
            </div>
            <div class="form-group">
                <label class=" font-weight-bold">Grupo escolar:</label>
                <input type="text" readonly value="<?php echo $dataP->grupo_n; ?>" class="form-control">
            </div>
            <div class="form-group">
                <label class=" font-weight-bold">Nombre del tutor:</label>
                <input type="text" readonly value="<?php echo $dataP->nombre_c_doc; ?>" class="form-control">
            </div>
            <div class="form-group">
                <label class=" font-weight-bold">CURP:</label>
                <input type="text" readonly value="<?php echo $dataP->curp_dat; ?>" class="form-control">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label class=" font-weight-bold">Direccion:</label>
                <input type="text" readonly value="<?php echo $dataP->calle_dat_act.", ".$dataP->colonia_dat_act; ?>" class="form-control">
            </div>
            <div class="form-group">
                <label class=" font-weight-bold">Telefono:</label>
                <input type="text" readonly value="<?php echo $dataP->telefono_casa_dat; ?>" class="form-control">
            </div>
            <div class="form-group">
                <label class=" font-weight-bold">Celular:</label>
                <input type="text" readonly value="<?php echo $dataP->telefono_al; ?>" class="form-control">
            </div>
            <div class="form-group">
                <label class=" font-weight-bold">Estado civil:</label>
                <input type="text" readonly value="<?php echo $dataP->estado_civil_dat; ?>" class="form-control">
            </div>
            <div class="form-group">
                <label class=" font-weight-bold">Edad:</label>
                <input type="text" readonly value="<?php echo $dataP->edad_dat; ?>" class="form-control">
            </div>
        </div>
    </div>  
</div>
<br><br>