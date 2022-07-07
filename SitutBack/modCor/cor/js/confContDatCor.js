init = () => {

	$("#formConfContCor").on("submit", (e) => {
		confContCor(e);
	});

	$("#formConfDatCor").on("submit", (e) => {
		confDatCor(e);
	});

	$("#formConfFotPerf").on("submit", (e) => {
		confFotCor(e);
	});

	$("#newContCor").on("keyup", () => {
		segCont(); contIgul();
	});

	$("#repContCor").on('keyup', contIgul); 

	$("#corCor").on('change', validEmail);

	$("#btnCloseConfContCor, #icoCloConfCont").on('click', limpCampCont);

	$("#btnCloseConfFotPerf, #icoCloConfFot").on("click", () => {
		$("#newFotPerf").val("");
	});

	$("#btnCloDatCor, #icoCloDatCor").on("click", () => {
		$("#passConfCor").val("");
	});

}

limpCampCont = () => {
	$("#contActCor").val(""); $("#newContCor").val("");
	$("#repContCor").val(""); $("#mensaje").text("").hide();
	$("#mensaje2").text("").hide();
}

function segCont() {
	let mayus = new RegExp("^(?=.*[A-Z])");
	let lower = new RegExp("^(?=.*[a-z])");
	let len = new RegExp("^(?=.{8,})");
	let numbers = new RegExp("^(?=.*[0-9])");
	let newCont = $("#newContCor").val();
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

	const btnGConfContCor = document.getElementById('btnGConfContCor');

	let newCont = $("#newContCor").val();
	let repCont = $("#repContCor").val();
	if (repCont.length > 0) {
		if (repCont === newCont) {
			$("#mensaje2").text("Las contraseñas coinciden").css({"color":"green"}).show();
			btnGConfContCor.disabled = false;
		} else {
			$("#mensaje2").text("Las contraseñas no coinciden").css({"color":"red"}).show();
			btnGConfContCor.disabled = true;
		}
	} else {
		$("#mensaje2").text("").hide();
		btnGConfContCor.disabled = false;
	}
}

function confContCor(e) {
	e.preventDefault();
	let formConfContCor = document.getElementById('formConfContCor');
	let formDat = new FormData($(formConfContCor)[0]);
	let contActCor = $("#contActCor").val(), newContCor = $("#newContCor").val(), 
	repContCor = $("#repContCor").val();
	if (contActCor.length > 0) {
		if (newContCor.length > 0) {
			if (repContCor.length > 0) {
				$.ajax({
					url : "../../ajax/cor/confDatCor.php?oper=confContCor",
					type : "POST", data : formDat, 
					contentType : false, processData : false,
					success : function( resp ) {
						if ( resp == "goodUpd" ) {
							swal({
								title : "Correcto...",
								text : "Contraseña actualizada",
								icon : "success",
								button : "Aceptar",
								closeOnClickOutside : false
							}).then( ( acepta ) => {
								limpCampCont();
								$("#confContCor").modal("hide");
							});
						} else if ( resp == "failUpd" ) {
							swal({
								title : "Ocurrio un problema",
								text : "Fallo la actualización",
								icon : "error",
								button : "Aceptar",
								closeOnClickOutside : false
							}).then( ( acepta ) => {
								limpCampCont();
							});
						} else if ( resp == "failCont" ) {
							swal({
								text : "Contraseña actual incorrecta",
								icon : "warning",
								button : "Aceptar",
								closeOnClickOutside : false
							}).then( ( acepta ) => {
								$("#contActCor").val("");
								$("#contActCor").focus();
							});
						} else {
							console.log( resp );
						}
					}
				});
			} else {
				swal({
					text : "Repite tu nueva contraseña",
					icon : "warning",
					button : "Aceptar"
				}).then( ( acepta ) => {
					$("#repContCor").focus();
				});
			}
		} else {
			swal({
				text : "Introduce tu nueva contraseña",
				icon : "warning",
				button : "Aceptar"
			}).then( ( acepta ) => {
				$("#newContCor").focus();
			});
		}
	} else {
		swal({
			text : "Introduce tu contraseña actual",
			icon : "warning",
			button : "Aceptar"
		}).then( ( acepta ) => {
			$("#contActCor").focus();
		});
	}
}

function validEmail() {
	let corAdm = document.getElementById('corCor');
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
		$("#btnGDatCor").prop("disabled",false);
	} else {
		$(textcorr).text("Correo Invalido").show();
		$(textcorr).addClass("invalid-feedback");
		$(corAdm).addClass("is-invalid");
		$("#btnGDatCor").prop("disabled",true);
	}
	if (corAdm.value.length == 0) {
		$(textcorr).text("");
		$(textcorr).removeClass("invalid-feedback");
		$(corAdm).removeClass("is-invalid");
		$("#btnGDatCor").prop("disabled",false);
	}
}

function confDatCor(e) {
	e.preventDefault();
	let formConfDatCor = document.getElementById('formConfDatCor');
	let formDat = new FormData($(formConfDatCor)[0]);
	let nomCor = $("#nomCor").val(), corCor = $("#corCor").val(), telCor = $("#telCor").val(), 
	sexCor = document.getElementById('sexCor'), passConfCor = $("#passConfCor").val();
	if (nomCor.length > 0) {
		if (corCor.length > 0) {
			if (sexCor.value != "0") {
				if (passConfCor.length > 0) {
					$.ajax({
						url : "../../ajax/cor/confDatCor.php?oper=confDatCor",
						type : "POST", data : formDat, 
						contentType : false, processData : false,
						success : function( resp ) {
							if ( resp == "goodUpd" ) {
								swal({
									title : "Correcto...",
									text : "Datos Actualizados",
									icon : "success",
									button : "Aceptar",
									closeOnClickOutside : false
								}).then( ( acepta ) => {
									location.reload();
								});
							} else if ( resp == "failUpd" ) {
								swal({
									title : "Ocurrio un problema",
									text : "Fallo la actualización",
									icon : "error",
									button : "Aceptar",
									closeOnClickOutside : false
								}).then( ( acepta ) => {
									location.reload();
								});
							} else if ( resp == "failCont" ) {
								swal({
									text : "Contraseña actual incorrecta",
									icon : "warning",
									button : "Aceptar",
									closeOnClickOutside : false
								}).then( ( acepta ) => {
									$("#passConfCor").val("");
									$("#passConfCor").focus();
								});
							} else {
								console.log( resp );
							}
						}
					});
				} else {
					swal({
						text : "Introduce tu contraseña para actualizar",
						icon : "warning",
						button : "Aceptar"
					}).then( ( acepta ) => {
						$("#passConfCor").focus();
					});
				}
			} else {
				swal({
					text : "Selecciona tu sexo",
					icon : "warning",
					button : "Aceptar"
				}).then( ( acepta ) => {
					$("#sexCor").focus();
				});
			}
		} else {
			swal({
				text : "Introduce tu correo electronico",
				icon : "warning",
				button : "Aceptar"
			}).then( ( acepta ) => {
				$("#corCor").focus();
			});
		}
	} else {
		swal({
			text : "Introduce tu nombre",
			icon : "warning",
			button : "Aceptar"
		}).then( ( acepta ) => {
			$("#nomCor").focus();
		});
	}
}

function confFotCor(e) {
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
				url : "../../ajax/cor/confDatCor.php?oper=confFotCor",
				type : "POST", data : formDat, 
				contentType : false, processData : false, 
				success : function( resp ) {
					if ( resp == "goodUpd" ) {
						swal({
							title : "Correcto...",
							text : "Foto de perfil actualizada",
							icon : "success",
							button : "Aceptar",
							closeOnClickOutside : false
						}).then( ( acepta ) => {
							location.reload();
						});
					} else if ( resp == "failUpd" ) {
						swal({
							title : "Ocurrio un problema",
							text : "Fallo la actualización de la foto de perfil",
							icon : "error",
							button : "Aceptar",
							closeOnClickOutside : false
						}).then( ( acepta ) => {
							location.reload();
						});
					} else {
						console.log( resp );
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