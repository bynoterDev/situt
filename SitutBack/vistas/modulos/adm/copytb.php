<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<h2 class="text-center">
					<i class="fas fa-users"></i>
					Apartado Administradores
				</h2>
			</div>
		</div>
		<br><br>
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-6">
				<h4 class="text-center"> <i class="fas fa-plus icoIni"></i> Registrar Administrador</h4>
				<div class="row">
					<div class="col-sm-2"></div>
					<form class="col-sm-8" method="POST" id="formGAdmin" name="formGAdmin">
						<hr class="my-2">
						<br>
						<div class="form-group">
							<label for="nomAdmin">Nombre completo:</label>
							<input type="text" id="nomAdmin" name="nomAdmin" class="form-control">
						</div>
						<div class="form-group">
							<label for="corAdmin">Correo:</label>
							<input onkeyup="validEmail()" type="text" id="corAdmin" name="corAdmin" class="form-control">
							<div style="font-size: 16px;" id="textcorr" class="text-center"></div>
						</div>
						<div class="form-group">
							<label for="contAdm">Contraseña:</label>
							<input onkeyup="contIgul()" type="text" id="contAdm" name="contAdm" class="form-control">
							<label id="mensaje" class="ocult"></label>
						</div>
						<div class="form-group">
							<label for="repContAdm">Repite la contraseña:</label>
							<input onkeyup="contIgul()" type="text" id="repContAdm" name="repContAdm" class="form-control">
							<label id="mensaje2" class="ocult"></label>
						</div>
						<div class="form-group">
							<label for="usAdm">Usuario:</label>
							<input type="text" id="usAdm" name="usAdm" class="form-control">
						</div>
						<div class="form-group">
							<label for="estAdm">Estado administrador:</label>
							<select id="estAdm" name="estAdm" class="form-control">
								<option selected="" disabled="" value="No">Selecciona</option>
								<option value="1">Activo</option>
								<option value="0">Inactivo</option>
							</select>
						</div>
						<div class="form-group">
							<label for="privAdm">Privilegios administrador:</label>
							<select id="privAdm" name="privAdm" class="form-control">
								<option selected="" disabled="" value="0">Selecciona</option>
								<option value="ALL">Todos</option>
								<option value="LIM">Limitados</option>
							</select>
						</div>
						<br>
						<hr>
						<div class="form-group text-center">
							<button id="btnGAdmin" class="btn btn-outline-success btn-lg" type="submit"> <i class="fas fa-check-circle icoIni"></i> Aceptar</button>
						</div>
					</form>
					<div class="col-sm-2"></div>
				</div>
			</div>
			<div class="col-sm-12 col-md-12 col-lg-6">
				<h4 class="text-center"> <i class="fas fa-list icoIni"></i> Listado Administradores</h4>
				<br><br>
				<div class="row">
					<div class="col-sm-12">
						<h5 class="text-left text-success"><b>Activos</b></h5>
						<div class="table-responsive">
							<!-- <table class="table bg-dark table-bordered table-hover" id="tbListadoAdmin">
								<thead class="text-white">
									<th>Acciones:</th>
									<th>Nombre:</th>
									<th>Correo:</th>
									<th>Usuario:</th>
									<th>Privilegio:</th>
								</thead>
								<tbody class="text-dark"></tbody>
								<tfoot class="text-white">
									<th>Acciones:</th>
									<th>Nombre:</th>
									<th>Correo:</th>
									<th>Usuario:</th>
									<th>Privilegio:</th>
								</tfoot>
							</table> -->
						</div>
					</div>
				</div>
				<br><br>
				<div class="row">
					<div class="col-sm-12">
						<h5 class="text-left text-danger"><b>Inactivos</b></h5>
						<div class="table-responsive">
							<!-- <table class="table bg-dark table-bordered table-hover" id="tbListadoAdminDesc">
								<thead class="text-white">
									<th>Acciones:</th>
									<th>Nombre:</th>
									<th>Correo:</th>
									<th>Usuario:</th>
									<th>Privilegio:</th>
								</thead>
								<tbody class="text-dark"></tbody>
								<tfoot class="text-white">
									<th>Acciones:</th>
									<th>Nombre:</th>
									<th>Correo:</th>
									<th>Usuario:</th>
									<th>Privilegio:</th>
								</tfoot>
							</table> -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>