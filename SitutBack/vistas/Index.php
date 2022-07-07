
    <div class="bg-primary ncol fixed-top animated fadeIn" id="menu1">
        <nav class="navbar navbar-expand-md ncol navbar-dark bg-primary container" id="menu2">
            <a class="navbar-brand" href="#">
                <b>S I T U T</b>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto mr-5">
                <li class="nav-item active">
                    <a class="nav-link" href="#">
                        <i class="fas fa-home mr-2"></i>
                        Inicio <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-door-open mr-2"></i>
                        Iniciar Sesión 
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a data-backdrop="false" class="dropdown-item" href="#" id="ses1" data-toggle="modal" data-target="#logAdm">
                        <i class="fas fa-user-shield mr-2" id="icoSes1"></i>
                        Administrador
                    </a>
                    <div class="dropdown-divider"></div>
                    <a data-backdrop="false" class="dropdown-item" href="#" id="ses2" data-toggle="modal" data-target="#logCor">
                        <i class="fas fa-user mr-2" id="icoSes2"></i>
                        Coordinador
                    </a>
                    <div class="dropdown-divider"></div>
                    <a data-backdrop="false" class="dropdown-item" href="#" id="ses3" data-toggle="modal" data-target="#logDir">
                        <i class="fas fa-user-tie mr-2" id="icoSes3"></i>
                        Director
                    </a>
                    <div class="dropdown-divider"></div>
                    <a data-backdrop="false" class="dropdown-item" href="#" id="ses4" data-toggle="modal" data-target="#logDoc">
                        <i class="fas fa-chalkboard-teacher mr-2" id="icoSes4"></i>
                        Tutor
                    </a>
                    </div>
                </li>
                </ul>
                <span class="navbar-text text-white">
                    <b>U T S E M</b>
                </span>
            </div>
        </nav>
    </div> 

    <div class="container-fluid">
		
        <div class="row">
		<!--
            <div class="col-lg-6 navbar-dark bg-dark sidebar sidebar-sticky fixed-top navBagImg animated fadeInLeft delay-1s" id="sidebar">
            </div>-->
            <div class="col-lg-12 mt-5">
				<div class="row">

					<div class="col-md-12">
										<br />
										<br />
						 <h1 class="text-center text-primary tit" style="letter-spacing:10px; text-shadow: 4px 4px #ddd;">
                    	<img src="<?php echo SERVERURL; ?>vistas/img/SITUT1.png" style="width:700px"/>
						</h1>
						<p class="lead text-center" style="font-size: 30px;">
							SISTEMA INTEGRAL DE TUTORIAS.
						</p>
				        
					</div>
				</div>
                <!--

                <div class="row mt-4">
                    <div class="col-sm-12 mt-4">
                        <h6 class="text-center text-muted">
                            <i class="fas fa-copyright mr-2"></i>
                            <script>document.write(new Date().getFullYear());</script> 
                            Todos los derechos reservados.
                        </h6>
                    </div>
                </div>-->
            </div>
        </div>
    </div>
<hr class=" mt-5" style="background: #BBBBBB; height: 100px; left:0; right:0; position: absolute; bottom: 0">
    <!--=========================================
    =            Ventana modal admin            =
    ==========================================-->
    
    <div class="modal fade bgModal" id="logAdm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-info" id="exampleModalLabel"><i class="fas fa-user-shield fa-lg mr-2"></i> Administrador</h5>
            <button id="admIcoC" type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body border-top border-info">
            <form id="formAdmin" method="POST" name="login" class="pad10" autocomplete="off">
                <div class="row">
                    <div class="col-sm-0 col-md-2 col-lg-2"></div>
                    <div class="col-sm-12 col-md-8 col-lg-8">
                        <div class="form-group">
                            <label for="correoAdm">Usuario:</label>
                            <div class="row">
                                <div class="col-sm-12">
                                    <input type="text" id="correoAdm" name="correoAdm" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="passAdm">Contraseña:</label>
                            <div class="row">
                                <div class="col-sm-12">
                                    <input type="password" id="passAdm" name="passAdm" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
          </div>
          <div class="modal-footer border-top border-info">
            <button type="button" class="btn btn-md btn-outline-danger" id="admBtnC" data-dismiss="modal">
                <i class="fas fa-times-circle mr-2"></i>
                Cerrar</button>
            <button id="btnLoginAdm" type="submit" name="btnLoginAdm" class="btn-md btn btn-outline-primary">
                <i class="fas fa-sign-in-alt fa-lg mr-2"></i>
                Ingresar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    
    <!--====  End of Ventana modal admin  ====-->
    
    <!--===============================================
    =            Ventana modal coordinador            =
    ================================================-->
    
    <div class="modal fade bgModal" id="logCor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-info" id="exampleModalLabel"><i class="fas fa-user fa-lg mr-2"></i> Coordinador</h5>
            <button id="corIcoC" type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body border-top border-info">
            <form id="formCord" name="formCord" method="POST" class="pad10" autocomplete="off">
                <div class="row">
                    <div class="col-sm-0 col-md-2 col-lg-2"></div>
                    <div class="col-sm-12 col-md-8 col-lg-8">
                        <div class="form-group">
                            <label for="correoCor">Correo electronico:</label>
                            <div class="row">
                                <div class="col-sm-12">
                                    <input type="text" id="correoCor" name="correoCor" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="passCor">Contraseña:</label>
                            <div class="row">
                                <div class="col-sm-12">
                                    <input type="password" id="passCor" name="passCor" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
          </div>
          <div class="modal-footer border-top border-info">
            <button type="button" id="corBtnC" class="btn btn-md btn-outline-danger" data-dismiss="modal">
                <i class="fas fa-times-circle mr-2"></i>
                Cerrar</button>
            <button id="btnLoginCor" type="submit" name="btnLoginCor" class="btn-md btn btn-outline-primary">
                <i class="fas fa-sign-in-alt fa-lg mr-2"></i>
                Ingresar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    
    <!--====  End of Ventana modal coordinador  ====-->
    
    <!--============================================
    =            Ventana modal director            =
    =============================================-->
    
    <div class="modal fade bgModal" id="logDir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-info" id="exampleModalLabel"><i class="fas fa-user-tie fa-lg mr-2"></i> Director</h5>
            <button id="dirIcoC" type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body border-top border-info">
            <form id="formDirec" name="formDirec" method="POST" class="pad10" autocomplete="off">
                <div class="row">
                    <div class="col-sm-0 col-md-2 col-lg-2"></div>
                    <div class="col-sm-12 col-md-8 col-lg-8">
                        <div class="form-group">
                            <label for="correoDir">Correo electronico:</label>
                            <div class="row">
                                <div class="col-sm-12">
                                    <input type="text" id="correoDir" name="correoDir" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="passDir">Contraseña:</label>
                            <div class="row">
                                <div class="col-sm-12">
                                    <input type="password" id="passDir" name="passDir" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
          </div>
          <div class="modal-footer border-top border-info">
            <button type="button" id="dirBtnC" class="btn btn-md btn-outline-danger" data-dismiss="modal">
                <i class="fas fa-times-circle mr-2"></i>
                Cerrar</button>
            <button id="btnLoginDir" type="submit" name="btnLoginDir" class="btn-md btn btn-outline-primary">
                <i class="fas fa-sign-in-alt fa-lg mr-2"></i>
                Ingresar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    
    <!--====  End of Ventana modal director  ====-->
    
    <!--===========================================
    =            Ventana modal docente            =
    ============================================-->
    
    <div class="modal fade bgModal" id="logDoc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-info" id="exampleModalLabel"><i class="fas fa-chalkboard-teacher fa-lg mr-2"></i> Docente</h5>
            <button id="docIcoC" type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body border-top border-info">
            <form id="formDocen" name="formDocen" method="POST" class="pad10" autocomplete="off">
                <div class="row">
                    <div class="col-sm-0 col-md-2 col-lg-2"></div>
                    <div class="col-sm-12 col-md-8 col-lg-8">
                        <div class="form-group">
                            <label for="correoDoc">Correo electronico:</label>
                            <div class="row">
                                <div class="col-sm-12">
                                    <input type="email" id="correoDoc" name="correoDoc" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="passDoc">Contraseña:</label>
                            <div class="row">
                                <div class="col-sm-12">
                                    <input type="password" id="passDoc" name="passDoc" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
          </div>
          <div class="modal-footer border-top border-info">
            <button type="button" id="docBtnC" class="btn btn-md btn-outline-danger" data-dismiss="modal">
                <i class="fas fa-times-circle mr-2"></i>
                Cerrar</button>
            <button id="btnLoginDoc" type="submit" name="btnLoginDoc" class="btn-md btn btn-outline-primary">
                <i class="fas fa-sign-in-alt fa-lg mr-2"></i>
                Ingresar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    
    <!--====  End of Ventana modal docente  ====-->


    <div class="modal fade bgModal" id="devop1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-info animated fadeInDown ml-3">
                Marco Aguilar <i class="fas fa-user-astronaut ml-2"></i> 
            </h5>
            <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body border-top border-info">
            <div class="pad10">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="card shadowCard animated fadeInLeft" style="width: 16rem;">
                            <img class="card-img-top img-thumbnail rounded img-fluid" src="<?php echo SERVERURL; ?>vistas/img/devop1.jpeg" alt="Card image cap">
                        </div>
                    </div>
                    <div class="col-sm-8 animated fadeInRight">
                        <h5 class="text-center mt-2 text-primary font-weight-bold tit">Sobre mí</h5>
                        <p class="lead p-2 text-center">
                            Carismatico y divertido, comprometido con desarrollar de esto un mundo mejor.
                        </p>
                        <h6 class="text-muted text-center mt-3 font-weight-bold">
                            Roles en el proyecto: Programador <i class="fas fa-code ml-1 mr-1"></i> 
                            y Diseñador <i class="fas fa-paint-brush ml-1"></i>.
                        </h6>
                        <h5 class="text-center mt-5 text-primary font-weight-bold tit">
                            Contactame... <i class="fas fa-laptop"></i>
                        </h5>
                        <hr class="ml-2">
                        <div class="ml-2 mt-5 text-center">
                            <a href="https://web.facebook.com/MarcCJm" target="_blank" title="Facebook">
                                <i class="fab fa-lg fa-facebook-square ico-fb ico-tr ico-font"></i>
                            </a>
                            <a href="https://www.linkedin.com/in/marco-antonio-carranza-aguilar-50759a176/" target="_blank" class="ml-5" title="Linkedin">
                                <i class="fab fa-lg fa-linkedin ico-lk ico-tr ico-font"></i>
                            </a>
                            <a href="https://github.com/cjtony" target="_blank" class="ml-5" title="GitHub">
                                <i class="fab fa-lg fa-github ico-gt ico-tr ico-font"></i>
                            </a>
                            <a href="mailto:marcocaaguilar@gmail.com" target="_blank" class="ml-5" title="Gmail">
                                <i class="fas fa-lg fa-envelope ico-gm ico-tr ico-font"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
          </div>
          <div class="modal-footer border-top border-info">
            <button type="button" class="btn btn-md btn-outline-danger" data-dismiss="modal">
                <i class="fas fa-times-circle mr-2"></i>
                Cerrar
            </button>
          </div>
        </div>
      </div>
    </div>





     <div class="modal fade bgModalDevop" id="modDevop" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-dark animated fadeIn font-weight-bold">
                <i class="fas fa-code mr-2"></i> Modo desarrollador 
            </h5>
            <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

            <form class="p-2 animated fadeIn" id="formDevop" name="formDevop" method="POST" autocomplete="off">
                <div class="form-group">
                    <label class="font-weight-bold text-dark" for="usDevop">
                        <i class="fas fa-user-shield mr-2"></i>
                        Usuario
                    </label>
                    <input type="text" class="form-control" name="usDevop" id="usDevop">
                </div>
                <div class="form-group">
                    <label class="font-weight-bold text-dark" for="codDevop">
                        <i class="fas fa-terminal mr-2"></i>
                        Codigo
                    </label>
                    <input type="password" class="form-control" name="codDevop" id="codDevop">
                </div>
            </form>
          </div>
          <div class="modal-footer animated fadeIn">
            <button type="button" class="btn btn-sm btn-outline-dark" id="btnIniDevop">
                <i class="fas fa-check mr-2"></i>
                Entrar
            </button>
            <button type="button" class="btn btn-sm btn-outline-dark" data-dismiss="modal">
                <i class="fas fa-times mr-2"></i>
                Cerrar
            </button>
          </div>
        </div>
      </div>
    </div>