function init() {
	$("#newContDoc").on("keyup", function(){
		segContAdm();
	});
	$("#btnCloseConfContDoc").on("click", function(){
		limpCamp();
	});
	$("#formConfContDoc").on("submit", function(e){
		confContDoc(e);
	});
	$("#formConfDatDoc").on("submit", function(e) {
		confDatDoc(e);
	});
	$("#formConfFotPerf").on("submit", function(e){
		confFotPerf(e);
	});
	$("#btnClose").on("click", function(){
		$("#passConfDoc").val("");
	});
}

function limpCamp() {
	$("#contActDoc").val("");
	$("#newContDoc").val("");
	$("#repContDoc").val("");
	$("#mensaje").text("");
	$("#mensaje2").text("");
	$("#btnGConfContDoc").prop("disabled", false);
}

function validEmailAdm() {
	let corAdm = document.getElementById('corDoc');
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
		$("#btnGConfDat").prop("disabled",false);
	} else {
		$(textcorr).text("Correo Invalido").show();
		$(textcorr).addClass("invalid-feedback");
		$(corAdm).addClass("is-invalid");
		$("#btnGConfDat").prop("disabled",true);
	}
	if (corAdm.value.length == 0) {
		$(textcorr).text("");
		$(textcorr).removeClass("invalid-feedback");
		$(corAdm).removeClass("is-invalid");
		$("#btnGConfDat").prop("disabled",true);
	}
}

function segContAdm() {
	let mayus = new RegExp("^(?=.*[A-Z])");
	let lower = new RegExp("^(?=.*[a-z])");
	let len = new RegExp("^(?=.{8,})");
	let numbers = new RegExp("^(?=.*[0-9])");
	let newCont = $("#newContDoc").val();
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

function contIgulAdm() {
	let newCont = $("#newContDoc").val();
	let repCont = $("#repContDoc").val();
	if (newCont.length > 0) {
		if (repCont.length > 0) {
			if (repCont === newCont) {
				$("#mensaje2").text("Las contrase??as coinciden").css({"color":"green"}).show();
				$("#btnGConfContDoc").prop("disabled",false);
			} else {
				$("#mensaje2").text("Las contrase??as no coinciden").css({"color":"red"}).show();
				$("#btnGConfContDoc").prop("disabled",true);
			}
		} else {
			$("#mensaje2").text("").hide();
			$("#btnGConfContDoc").prop("disabled", false);
		}
	} else {
		$("#repContDoc").val("");
		$("#mensaje2").text("").hide();
	}
}

function confContDoc(e) {
	e.preventDefault();
	let formConfContDoc = document.getElementById('formConfContDoc');
	let formDat = new FormData($(formConfContDoc)[0]);
	let contActDoc = $("#contActDoc").val(), newContDoc = $("#newContDoc").val(), 
	repContDoc = $("#repContDoc").val();
	if (contActDoc.length > 0) {
		 if (newContDoc.length > 0) {
		 	if (repContDoc.length > 0) {
		 		$.ajax({
		 			url : "../../ajax/doc/confDatDoc.php?oper=confContDoc",
		 			type : "POST", data : formDat,
		 			contentType : false, processData : false,
		 			success : function( resp ) {
		 				if (resp === "goodUp") {
							swal({
								title : "Actualizaci??n exitosa",
								text : "La contrase??a fue cambiada correctamente",
								icon : "success",
								button: false,
							});
							setTimeout(function() {
								location.reload();
							}, 1500);
						} else if (resp === "failUp") {
							swal({
								title : "Ocurrio un problema",
								text : "La contrase??a no fue actualizada",
								icon : "error",
								button : "Aceptar"
							});
							limpCamp();
						} else if (resp === "failCont"){
							swal({
								text : "La contrase??a actual no es correcta",
								icon : "warning",
								button : "Aceptar"
							}).then((acepta) => {
								$("#contActDoc").val("");
								$("#contActDoc").focus();
							});
						}
		 			}
		 		});
		 	} else {
		 		swal({
					text : "Repite tu nueva contrase??a",
					icon : "warning",
					timer : 2000,
					button : false,
					closeOnClickOutside: false
				});
				$("#repContDoc").focus();
		 	}
		 } else {
		 	swal({
				text : "Escribe tu nueva contrase??a",
				icon : "warning",
				timer : 2000,
				button : false,
				closeOnClickOutside: false
			});
			$("#newContDoc").focus();
		 }
	} else {
		swal({
			text : "Escribe tu contrase??a actual",
			icon : "warning",
			timer : 2000,
			button : false,
			closeOnClickOutside: false
		});
		$("#contActDoc").focus();
	}
}

function confDatDoc(e) {
	e.preventDefault();
	let formConfDatDoc = document.getElementById('formConfDatDoc');
	let formDat = new FormData($(formConfDatDoc)[0]);
	let nomDoc = $("#nomDoc").val(), corDoc = $("#corDoc").val(), telDoc = $("#telDoc").val(), 
	dirDoc = $("#dirDoc").val(), espDoc = $("#espDoc").val(), passConfDoc = $("#passConfDoc").val();
	if (nomDoc.length > 0) {
		if (corDoc.length > 0) {
			if (telDoc.length > 0) {
				if (dirDoc.length > 0) {
					if (espDoc.length > 0) {
						if (passConfDoc.length > 0) {
							$.ajax({
								url : "../../ajax/doc/confDatDoc.php?oper=confDatDoc",
								type : "POST", data : formDat,
								contentType : false, processData : false,
								success : function( resp ) {
									if (resp === "goodUp") {
										swal({
											title : "Actualizaci??n exitosa",
											text : "Datos cambiados correctamente",
											icon : "success",
											button: false,
										});
										setTimeout(function() {
											location.reload();
										}, 1500);
									} else if (resp === "failUp") {
										swal({
											title : "Ocurrio un problema",
											text : "Los datos no fueron actualizados",
											icon : "error",
											button : "Aceptar"
										});
										$("#passConfDir").val("");
									} else if (resp === "failCont") {
										swal({
											text : "La contrase??a ingresada no es correcta",
											icon : "warning",
											button : "Aceptar"
										}).then((acepta) => {
											$("#passConfDoc").val("");
											$("#passConfDoc").focus();
										});
									}
								}
							});
						} else {
							swal({
								text : "Introduce tu contrase??a",
								icon : "warning",
								timer : 2000,
								closeOnClickOutside : false,
								buttons : false
							});
							$("#passConfDoc").focus();
						}
					} else {
						swal({
							text : "Introduce tu especialidad",
							icon : "warning",
							timer : 2000,
							closeOnClickOutside : false,
							buttons : false
						});
						$("#espDoc").focus();
					}
				} else {
					swal({
						text : "Introduce una direccion",
						icon : "warning",
						timer : 2000,
						closeOnClickOutside : false,
						buttons : false
					});
					$("#dirDoc").focus();
				}
			} else {
				swal({
					text : "Introduce un numero de telefono",
					icon : "warning",
					timer : 2000,
					closeOnClickOutside : false,
					buttons : false
				});
				$("#telDoc").focus();
			}
		} else {
			swal({
				text : "Introduce un correo",
				icon : "warning",
				timer : 2000,
				closeOnClickOutside : false,
				buttons : false
			});
			$("#corDoc").focus();
		}
	} else {
		swal({
			text : "Introduce un nombre",
			icon : "warning",
			timer : 2000,
			closeOnClickOutside : false,
			buttons : false
		});
		$("#nomDoc").focus();
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
				url : "../../ajax/doc/confDatDoc.php?oper=confFotPerf",
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