document.addEventListener('DOMContentLoaded', () => {

	/*----------  Formularios y botones de cierre  ----------*/
	
	const btnCloseConfContAlm = document.getElementById('btnCloseConfContAlm');
	const btnCloseIcoCont = document.getElementById('btnCloseIcoCont');
	const formContConfAlm = document.getElementById('formContConfAlm');
	const formConfDatAlm = document.getElementById('formConfDatAlm');
	const formConfFotPerf = document.getElementById('formConfFotPerf');
	const btnCloseDat = document.getElementById('btnCloseDat');

	/*----------  Modal Contraseña  ----------*/
	
	const contAct = document.getElementById('contActAlm');
	const newCont = document.getElementById('newContAlm');
	const repCont = document.getElementById('repContAlm');
	const mensaje = document.getElementById('mensaje');
	const mensaje2 = document.getElementById('mensaje2');

	/*----------  Modal Datos Personales  ----------*/
	
	const corAlm = document.getElementById('corAlm');
	const textcorr = document.getElementById('textcorr');

	function init() {

		newCont.addEventListener("keyup", () => { 
			segCont(); 
			contIgul(); 
		});

		repCont.addEventListener("keyup", contIgul);

		formContConfAlm.addEventListener("submit", confContAlm);

		btnCloseConfContAlm.addEventListener('click', limpCamp);

		btnCloseIcoCont.addEventListener('click', limpCamp);

		corAlm.addEventListener('keyup', validEmail);

		formConfDatAlm.addEventListener("submit", confDataAlm);

		btnCloseDat.addEventListener("click", () => {
			document.getElementById('passConfAlm').value = '';
		});

		formConfFotPerf.addEventListener("submit", confFotPerf);

	}

	limpCamp = () => {

		contAct.value = '';
		newCont.value = '';
		repCont.value = '';
		mensaje.className = 'ocult mt-3 badge p-2 badge-pill';
		mensaje2.className = 'ocult mt-3 badge p-2 badge-pill';

	}

	segCont = () => {

		const mayus = new RegExp("^(?=.*[A-Z])");
		const lower = new RegExp("^(?=.*[a-z])");
		const len = new RegExp("^(?=.{8,})");
		const numbers = new RegExp("^(?=.*[0-9])");

		if (mayus.test(newCont.value) && lower.test(newCont.value) && numbers.test(newCont.value) && len.test(newCont.value)) {
			mensaje.innerHTML = 'Seguridad Alta <i class="fas fa-check-circle ml-2"></i>';
			mensaje.classList.remove('ocult','badPass','medPass');
			mensaje.classList.add('goodPass', 'animated', 'fadeIn');
		} else if (mayus.test(newCont.value) && numbers.test(newCont.value) && len.test(newCont.value) 
			|| lower.test(newCont.value) && numbers.test(newCont.value) && len.test(newCont.value)) {
			mensaje.innerHTML = 'Seguridad Media <i class="fas fa-exclamation-circle ml-2"></i>';
			mensaje.classList.remove('ocult','goodPass','badPass');
			mensaje.classList.add('medPass', 'animated', 'fadeIn');
		} else if (mayus.test(newCont.value) && len.test(newCont.value) || lower.test(newCont.value) && len.test(newCont.value) 
			|| numbers.test(newCont.value) && len.test(newCont.value)
			|| numbers.test(newCont.value)
			|| mayus.test(newCont.value)
			|| lower.test(newCont.value)) {
			mensaje.innerHTML = 'Seguridad Baja <i class="fas fa-times ml-2"></i>';
			mensaje.classList.remove('ocult','goodPass','medPass');
			mensaje.classList.add('badPass', 'animated', 'fadeIn');
		} else {
			mensaje.textContent = '';
			mensaje.className = 'ocult mt-3 badge p-2 badge-pill';
		}

	}

	contIgul = () => {

		const btnGConfContAlm = document.getElementById('btnGConfContAlm');

		if (repCont.value.length > 0) {
			if (repCont.value === newCont.value) {
				mensaje2.innerHTML = 'Las contraseñas coinciden <i class="fas fa-check-circle ml-2"></i>';
				mensaje2.classList.remove('ocult','badPass');
				mensaje2.classList.add('goodPass', 'animated', 'fadeIn');
				btnGConfContAlm.disabled = false;
			} else {
				mensaje2.innerHTML = 'Las contraseñas no coinciden <i class="fas fa-times ml-2"></i>';
				mensaje2.classList.remove('ocult','goodPass');
				mensaje2.classList.add('badPass', 'animated', 'fadeIn');
				btnGConfContAlm.disabled = true;
			}
		} else {
			mensaje2.textContent = '';
			mensaje2.className = 'ocult mt-3 badge p-2 badge-pill';
			btnGConfContAlm.disabled = false;
		}

	}

	validEmail = () => {

		const btnGConfDatAlm = document.getElementById('btnGConfDatAlm');
		const emailValid = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;

		if (emailValid.test(corAlm.value)) {
			textcorr.classList.remove('ocult');
			textcorr.textContent = 'Formato correcto!';
			textcorr.classList.add('valid-feedback','animated','fadeIn');
			textcorr.classList.remove('invalid-feedback');
			corAlm.classList.add('is-valid');
			setTimeout(function() {
				corAlm.classList.remove('is-valid');
			}, 2000);
			corAlm.classList.remove('is-invalid');
			btnGConfDatAlm.disabled = false;
		} else {
			textcorr.classList.remove('ocult');
			textcorr.textContent = 'Formato de correo invalido';
			textcorr.classList.add('invalid-feedback','animated','fadeIn');
			corAlm.classList.add('is-invalid');
			btnGConfDatAlm.disabled = true;
		}
		if (corAlm.value.length == 0) {
			textcorr.textContent = '';
			textcorr.className = 'text-center ocult';
			corAlm.className = 'form-control';
			btnGConfDatAlm.disabled = true;
		}

	}

	function confContAlm(e) {
		e.preventDefault();
		let formContConfAlm = document.getElementById('formContConfAlm');
		let formDat = new FormData($(formContConfAlm)[0]);
		let contActAlm = $("#contActAlm").val(), newContAlm = $("#newContAlm").val(),
		repContAlm = $("#repContAlm").val();
		if (contActAlm.length > 0) {
			if (newContAlm.length > 0) {
				if (repContAlm.length > 0) {
					$.ajax({
						url : "../../ajax/alm/confDatAlm.php?oper=confContAlm",
						type : "POST", data : formDat,
						contentType : false, processData : false,
						success : function( resp ) {
							if (resp === "goodUpd") {
								swal({
									title : "Actualización exitosa",
									text : "Datos cambiados correctamente",
									icon : "success",
									button: false,
								});
								setTimeout(function() {
									location.reload();
								}, 1500);
							} else if (resp === "failUpd") {
								swal({
									title : "Ocurrio un problema",
									text : "Los datos no fueron actualizados",
									icon : "error",
									button : "Aceptar"
								}).then( ( acepta ) => {
									limpCamp();
									$("#confContAlm").hide();
								});
							} else if (resp === "failCont") {
								swal({
									text : "La contraseña ingresada no es correcta",
									icon : "warning",
									button : "Aceptar"
								}).then( ( acepta ) => {
									$("#contActAlm").val("");
									$("#contActAlm").focus();
								});
							} else {
								location.reload();
							}
						}
					});
				} else {
					swal({
						text : "Introduce una contraseña",
						icon : "warning",
						button : "Aceptar"
					}).then( ( acepta ) => {
						$("#repContAlm").focus();
					});
				}
			} else {
				swal({
					text : "Introduce tu nueva contraseña",
					icon : "warning",
					button : "Aceptar"
				}).then( ( acepta ) => {
					$("#newContAlm").focus();
				});
			}
		} else {
			swal({
				text : "Introduce tu contraseña actual",
				icon : "warning",
				button : "Aceptar"
			}).then( ( acepta ) => {
				$("#contActAlm").focus();
			});
		}
	}

	function confDataAlm(e) {
		e.preventDefault();
		let formConfDatAlm = document.getElementById('formConfDatAlm');
		let formDat = new FormData($(formConfDatAlm)[0]);
		let nomAlm = $("#nomAlm").val(), corAlm = $("#corAlm").val(), telAlm = $("#telAlm").val(), 
		matAlm = $("#matAlm").val(), sexAlm = document.getElementById('sexAlm'),
		passConfAlm = $("#passConfAlm").val();
		if (nomAlm.length > 0) {
			if (corAlm.length > 0) {
				if (telAlm.length > 0) {
					if (matAlm.length > 0) {
						if (sexAlm.value != "0") {
							if (passConfAlm.length > 0) {
								swal({
									title: "Esta seguro?",
									text: "De actualizar sus datos?",
									icon: "warning",
									buttons: true
								}).then( ( acepta ) => {
									if (acepta) {
										$.ajax({
											url : "../../ajax/alm/confDatAlm.php?oper=confDataAlm",
											type : "POST", data : formDat,
											contentType : false, processData : false,
											success : function( resp ) {
												if (resp === "goodUpd") {
													swal({
														title : "Actualización exitosa",
														text : "Datos cambiados correctamente",
														icon : "success",
														button: false,
													});
													setTimeout(function() {
														location.reload();
													}, 1500);
												} else if (resp === "failUpd") {
													swal({
														title : "Ocurrio un problema",
														text : "Los datos no fueron actualizados",
														icon : "error",
														button : "Aceptar"
													});
													$("#passConfAlm").val("");
												} else if (resp === "failCont") {
													swal({
														text : "La contraseña ingresada no es correcta",
														icon : "warning",
														button : "Aceptar"
													}).then( ( acepta ) => {
													$("#passConfAlm").val("");
													$("#passConfAlm").focus();
													});
												} else if (resp === "matExt") {
													swal({
														text : "La matricula ingresada ya existe",
														icon : "warning",
														button : "Aceptar"
													}).then( ( acepta ) => {
														$("#matAlm").focus();
													});
												} else if (resp === "corExt") {
													swal({
														text : "El correo ingresado ya existe",
														icon : "warning",
														button : "Aceptar"
													}).then( ( acepta ) => {
														$("#corAlm").focus();
													});
												}
											} 
										});
									} else {
										swal("Bien");
										$("#passConfAlm").val("");
									}
								});
							} else {
								swal({
									text : "Introduce tu contraseña para actualizar",
									icon : "warning",
									button : "Aceptar"
								}).then( ( acepta ) => {
									$("#passConfAlm").focus();
								});
							}
						} else {
							swal({
								text : "Selecciona tu sexo",
								icon : "warning",
								button : "Aceptar"
							}).then( ( acepta ) => {
								$("#sexAlm").focus();
							});
						}
					} else {
						swal({
							text : "Introduce tu matricula",
							icon : "warning",
							button : "Aceptar"
						}).then( ( acepta ) => {
							$("#matAlm").focus();
						});
					}
				} else {
					swal({
						text : "Introduce tu numero telefonico",
						icon : "warning",
						button : "Aceptar"
					}).then( ( acepta ) => {
						$("#telAlm").focus();
					});
				}
			} else {
				swal({
					text : "Introduce tu correo",
					icon : "warning",
					button : "Aceptar"
				}).then( ( acepta ) => {
					$("#corAlm").focus();
				});
			}
		} else {
			swal({
				text : "Introduce tu nombre",
				icon : "warning",
				button : "Aceptar"
			}).then( ( acepta ) => {
				$("#nomAlm").focus();
			});
		}
	}

	function confFotPerf(e) {
		e.preventDefault();
		let formConfFotPerf = document.getElementById('formConfFotPerf');
		let formDat = new FormData($(formConfFotPerf)[0]);
		var extPerm = /(.jpg)$/i;
		var extPerm1 = /(.jpeg)$/i;
		var extPerm2 = /(.png)$/i;
		var newFotPerf = document.getElementById('newFotPerf').value;
		if (newFotPerf.length > 0) {
			if (!extPerm.exec(newFotPerf) && !extPerm1.exec(newFotPerf) && !extPerm2.exec(newFotPerf)) {
				swal({
					text: "Selecciona una imagen .jpeg, .jpg, .png",
					button: "Aceptar"
				});
				$("#newFotPerf").val("");
			} else {
				$.ajax({
					url : "../../ajax/alm/confDatAlm.php?oper=confFotPerf",
					type : "POST", data : formDat, 
					contentType : false, processData : false,
					success : function( resp ) {
						if ( resp === "goodUpd") {
							swal({
								title : "Correcto...!",
								text : "Foto de perfil actualizada",
								icon : "success",
								button : false
							});
							setTimeout(function() {
								location.reload();
							}, 1500);
						} else if ( resp === "failUpd" ) {
							swal({
								title : "Ocurrio un problema :(",
								text : "No se pudo actualizar la foto de perfil",
								icon : "error",
								button : "Aceptar"
							}).then( ( acepta ) => {
								$("#newFotPerf").val("");
								$("#newFotPerf").focus();
							});
						}
					}
				});
			}
		} else {
			swal({
				text : "Elige una foto de perfil con formato .jpeg, .jpg, .png",
				icon : "warning",
				button : "Aceptar"
			}).then( ( acepta ) => {
				$("#newFotPerf").focus();
			});
		}
	}

	init();

});