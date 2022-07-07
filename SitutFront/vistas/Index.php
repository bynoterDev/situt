<div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 navbar-dark bg-dark sidebar sidebar-sticky fixed-top navBagImg" id="sidebar">
            </div>
            
            <div class="col-lg-6">
                <div id="columIni" class="">
                    <h1 class="text-center mt-5 py-5 text-primary iniSes" style="letter-spacing: 5px; text-shadow: 4px 4px #eee;">
                        Inicio de sesión
                    </h1>
                    <form autocomplete="off" class="mt-3 row" method="POST" id="formLogAlm" name="formLogAmd">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-8">
                            <div class="form-group">
                                <label for="cormatAlm" class="text-primary font-weight-bold">
                                    <i class="fas fa-id-card mr-2"></i>
                                    Matricula:</label>
                                <input placeholder="Eje. UTS15S-000101" type="text" id="cormatAlm" name="cormatAlm" class="form-control text-uppercase mt-2">
                            </div>
                            <div class="form-group">
                                <label for="passAlm" class="text-primary font-weight-bold">
                                    <i class="fas fa-key mr-2"></i>
                                    Contraseña:</label>
                                <input placeholder="********" type="password" id="passAlm" name="passAlm" class="form-control mt-2">
                            </div>
                            <div class="form-group mt-5 text-center">
                                <button class="btn active btn-primary">
                                    Ingresar
                                    <i class="fas fa-sign-in-alt ml-2"></i>
                                </button>
                            </div>
                            <div class="text-center mt-5">
                                <b>
                                    No tienes una cuenta?
                                    <a href="#" id="regAq" class="text-info"> Registrate aquí...</a>
                                </b>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row ocult" id="columReg">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-10">
                        <h1 class="text-center iniSes text-primary mt-2" style="letter-spacing: 5px; text-shadow: 4px 4px #eee;">Registro</h1>
                        <form autocomplete="off" class="mt-4" method="POST" id="formRegAlm" name="formRegAlm">
                            <div class="form-group">
                                <label for="nomAlm" class="text-primary font-weight-bold">
                                    <i class="fas fa-user mr-2"></i>
                                    Nombre completo:</label>
                                <input required type="text" id="nomAlm" name="nomAlm" class="form-control text-capitalize">
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="matAlm" class="text-primary font-weight-bold">
                                        <i class="fas fa-id-card mr-2"></i>
                                        Matricula:</label>
                                    <input required type="text" id="matAlm" name="matAlm" class="form-control text-uppercase">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="telAlm" class="text-primary font-weight-bold">
                                        <i class="fas fa-phone mr-2"></i>
                                        Telefono:</label>
                                    <input pattern="[0-9]{10}" required type="tel" id="telAlm" name="telAlm" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="corAlm" class="text-primary font-weight-bold">
                                    <i class="fas fa-envelope mr-2"></i>
                                    Correo electronico:</label>
                                <input required type="email" id="corAlm" name="corAlm" class="form-control">
                                <div style="font-size: 16px;" id="textcorr" class="text-center"></div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="contAlm" class="text-primary font-weight-bold">
                                        <i class="fas fa-key mr-2"></i>
                                        Contraseña:</label>
                                    <input required type="password" id="contAlm" name="contAlm" class="form-control">
                                    <div id="mensaje"></div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="repCont" class="text-primary font-weight-bold">
                                        <i class="fas fa-key mr-2"></i>
                                        Repite la contraseña:</label>
                                    <input required type="password" id="repCont" name="repCont" class="form-control">
                                    <div id="mensaje2"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="sexAlm" class="text-primary font-weight-bold">
                                        <i class="fas fa-user-friends mr-2"></i>
                                        Sexo:</label>
                                    <select class="form-control" name="sexAlm" id="sexAlm">
                                        <option value="0" selected="">Selecciona</option>
                                        <option value="Femenino">Femenino</option>
                                        <option value="Masculino">Masculino</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="carAlm" class="text-primary font-weight-bold">
                                        <i class="fas fa-book mr-2"></i>
                                        Carrera</label>
                                    <select class="form-control" name="carAlm" id="carAlm">
                                        <option value="SN" selected="">Selecciona</option>
                                        <?php 
                                            require 'modelos/conect.php';
                                          //  $dbc = Connect::getDB();
                                            $dbc = new Connect();
						                    $dbc = $dbc -> getDB();
                                            $valid = 1;
                                            $stmt = $dbc -> prepare("SELECT * FROM carreras car
                                                INNER JOIN directores dir ON dir.id_carrera = car.id_carrera
                                             WHERE car.estado_car = :valid");
                                            $stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
                                            $stmt -> execute();
                                            while ($res = $stmt -> fetch(PDO::FETCH_OBJ)) {
                                        ?>
                                            <option value="<?php echo $res->id_carrera; ?>">
                                                <?php echo $res->nombre_car; ?>     
                                            </option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group mt-3 text-center">
                                <button id="btnRegAlm" type="submit" class="btn btn-primary active">
                                    Aceptar
                                    <i class="fas fa-check-circle ml-2"></i>
                                </button>
                            </div>
                            <div class="text-center mt-4 mb-3">
                                <b>Ya tienes una cuenta? <a href="#" id="logAq" class="text-info"> Inicia sesión...</a> </b>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>