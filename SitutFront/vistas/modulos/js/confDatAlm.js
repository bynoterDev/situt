function init() {
	$("#btnCloseConfContAlm").on("click", function(){
		limpCamp();
	});
	$("#newContAlm").on("keyup", function(){
		segCont(); 
		contIgul();
	});
	$("#repContAlm").on("keyup", function(){
		contIgul();
	});
	$("#formContConfAlm").on("submit", function(e){
		confContAlm(e);
	});
	$("#formConfDatAlm").on("submit", function(e) {
		confDataAlm(e);
	});
	$("#formConfFotPerf").on("submit", function(e) {
		confFotPerf(e);
	});
	$("#btnCloseDat").on("click", function(){
		$("#passConfAlm").val("");
	});
	$("#dev1").mouseover(function(){
		$("#dev1").addClass("animated pulse");
	});
	$("#dev1").mouseleave(function(){
		$("#dev1").removeClass("animated pulse");
	});
}

function limpCamp(){
	$("#contActAlm").val("");
	$("#newContAlm").val("");
	$("#repContAlm").val("");
	$("#mensaje").hide();
	$("#mensaje2").hide();
}

function segCont() {
	let mayus = new RegExp("^(?=.*[A-Z])");
	let lower = new RegExp("^(?=.*[a-z])");
	let len = new RegExp("^(?=.{8,})");
	let numbers = new RegExp("^(?=.*[0-9])");
	let newCont = $("#newContAlm").val();
	if (mayus.test(newCont) && lower.test(newCont) && numbers.test(newCont) && len.test(newCont)) {
		$("#mensaje").text("Seguridad Alta").css("color","green");
		$("#mensaje").show(1000);
	} else if (mayus.test(newCont) && numbers.test(newCont) && len.test(newCont) 
		|| lower.test(newCont) && numbers.test(newCont) && len.test(newCont)) {
		$("#mensaje").text("Seguridad Media").css("color","orange");
		$("#mensaje").show(1000);
	} else if (mayus.test(newCont) && len.test(newCont) 
		|| lower.test(newCont) && len.test(newCont) 
		|| numbers.test(newCont) && len.test(newCont)
		|| numbers.test(newCont)
		|| mayus.test(newCont)
		|| lower.test(newCont)) {
		$("#mensaje").text("Seguridad Baja").css("color","red");
		$("#mensaje").show(1000);
	} else {
		$("#mensaje").text("");
		$("#mensaje").hide(1000);
	}
}

function contIgul() {
	let newCont = $("#newContAlm").val();
	let repCont = $("#repContAlm").val();
	if (repCont.length > 0) {
		if (repCont === newCont) {
			$("#mensaje2").text("Las contraseñas coinciden").css({"color":"green"}).show();
			$("#btnGConfContAlm").prop("disabled",false);
		} else {
			$("#mensaje2").text("Las contraseñas no coinciden").css({"color":"red"}).show();
			$("#btnGConfContAlm").prop("disabled",true);
		}
	} else {
		$("#mensaje2").text("").hide();
		$("#btnGConfContAlm").prop("disabled",false);
	}
}

function validEmail() {
	let corAdm = document.getElementById('corAlm');
	let textcorr = document.getElementById('textcorr');
	let emailValid = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
	if (emailValid.test(corAdm.value)) {
		$(textcorr).text("Correcto!").show().fadeOut(2000);
		$(textcorr).addClass("valid-feedback");
		$(textcorr).removeClass("invalid-feedback");
		$(corAdm).addClass("is-valid");
		setTimeout(function() {
			$(corAdm).removeClass("is-valid");
		}, 2000);
		$(corAdm).removeClass("is-invalid");
		$("#btnGConfDatAlm").prop("disabled",false);
	} else {
		$(textcorr).text("Correo Invalido").show();
		$(textcorr).addClass("invalid-feedback");
		$(corAdm).addClass("is-invalid");
		$("#btnGConfDatAlm").prop("disabled",true);
	}
	if (corAdm.value.length == 0) {
		$(textcorr).text("");
		$(textcorr).removeClass("invalid-feedback");
		$(corAdm).removeClass("is-invalid");
		$("#btnGConfDatAlm").prop("disabled",true);
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
					url : "../ajax/alm/confDatAlm.php?oper=confContAlm",
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
										url : "../ajax/alm/confDatAlm.php?oper=confDataAlm",
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
				url : "../ajax/alm/confDatAlm.php?oper=confFotPerf",
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
