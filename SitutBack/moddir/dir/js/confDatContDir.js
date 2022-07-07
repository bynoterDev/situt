function init(){
	$("#btnCloseConfContDir").on("click", function(){
		limpCamp();
	});
	$("#newContDir").on("keyup", function(){
		segContDir();
	});
	$("#formConfContDir").on("submit", function(e){
		confContDir(e);
	});
	$("#formConfDatDir").on("submit", function(e){
		confDatDir(e);
	});	
	$("#confFotPerf").on("submit", function(e){
		confFotPerf(e);
	});
}

function limpCamp() {
	$("#contActDir").val("");
	$("#newContDir").val("");
	$("#repContDir").val("");
	$("#mensaje").text("");
	$("#mensaje2").text("");
}

function segContDir() {
	let mayus = new RegExp("^(?=.*[A-Z])");
	let lower = new RegExp("^(?=.*[a-z])");
	let len = new RegExp("^(?=.{8,})");
	let numbers = new RegExp("^(?=.*[0-9])");
	let newCont = $("#newContDir").val();
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

function contIgulDir() {
	let newCont = $("#newContDir").val();
	let repCont = $("#repContDir").val();
	if (repCont.length > 0) {
		if (repCont === newCont) {
			$("#mensaje2").text("Las contraseñas coinciden").css({"color":"green"}).show();
			$("#btnGConfContDir").prop("disabled",false);
		} else {
			$("#mensaje2").text("Las contraseñas no coinciden").css({"color":"red"}).show();
			$("#btnGConfContDir").prop("disabled",true);
		}
	} else {
		$("#mensaje2").text("").hide();
	}
}

function confContDir(e) {
	e.preventDefault();
	let formConfContDir = document.getElementById('formConfContDir');
	let formDat = new FormData($(formConfContDir)[0]);
	let contActDir = $("#contActDir").val();
	let newContDir = $("#newContDir").val();
	let repContDir = $("#repContDir").val();
	if (contActDir.length > 0) {
		if (newContDir.length > 0) {
			if (repContDir.length > 0) {
				$.ajax({
					url : "../../ajax/dir/confDatDir.php?oper=confContDir",
					type : "POST",
					data : formDat,
					contentType : false,
					processData : false,
					success : function(resp) {
						if (resp === "goodup") {
							swal({
								title : "Actualización exitosa",
								text : "La contraseña fue cambiada correctamente",
								icon : "success",
								button: false,
							});
							setTimeout(function() {
								location.reload();
							}, 1500);
						} else if (resp === "failup") {
							swal({
								title : "Ocurrio un problema",
								text : "La contraseña no fue actualizada",
								icon : "error",
								button : "Aceptar"
							});
							limpCamp();
						} else if (resp === "failcont"){
							swal({
								text : "La contraseña actual no es correcta",
								icon : "warning",
								button : "Aceptar"
							});
							$("#contActDir").val("");
							$("#contActDir").focus();
						}
					}
				});
			} else {
				swal({
					text : "Repite tu nueva contraseña",
					icon : "warning",
					timer : 2000,
					button : false,
					closeOnClickOutside: false
				});
				$("#repContDir").focus();
			}
		} else {
			swal({
				text : "Escribe tu nueva contraseña",
				icon : "warning",
				timer : 2000,
				button : false,
				closeOnClickOutside: false
			});
			$("#newContDir").focus();
		}
	} else {
		swal({
			text : "Escribe tu contraseña actual",
			icon : "warning",
			timer : 2000,
			button : false,
			closeOnClickOutside: false
		});
		$("#contActDir").focus();
	}
}

function validEmailDir() {
	let corAdm = document.getElementById('corDir');
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

function confDatDir(e) {
	e.preventDefault();
	let formConfDatDir = document.getElementById('formConfDatDir');
	let formDat = new FormData($(formConfDatDir)[0]);
	let nomDir = $("#nomDir").val(), corDir = $("#corDir").val(), telDir = $("#telDir").val(),
	passConfDir = $("#passConfDir").val();
	if (nomDir.length > 0) {
		if (corDir.length > 0) {
			if (telDir.length > 0) {
				if (passConfDir.length > 0) {
					$.ajax({
						url : "../../ajax/dir/confDatDir.php?oper=confDatDir",
						type : "POST",
						data : formDat,
						contentType : false,
						processData : false,
						success : function(resp) {
							if (resp === "goodup") {
								swal({
									title : "Actualización exitosa",
									text : "Datos cambiados correctamente",
									icon : "success",
									button: false,
								});
								setTimeout(function() {
									location.reload();
								}, 1500);
							} else if (resp === "failup") {
								swal({
									title : "Ocurrio un problema",
									text : "Los datos no fueron actualizados",
									icon : "error",
									button : "Aceptar"
								});
								$("#passConfDir").val("");
							} else if (resp === "failcont") {
								swal({
									text : "La contraseña ingresada no es correcta",
									icon : "warning",
									button : "Aceptar"
								});
								$("#passConfDir").val("");
								$("#passConfDir").focus();
							}
						}
					});
				} else {
					swal({
						text : "Introduce tu contraseña",
						icon : "warning",
						timer : 2000,
						closeOnClickOutside : false,
						buttons : false
					});
					$("#passConfDir").focus();
				}
			} else {
				swal({
					text : "Introduce un numero de telefono",
					icon : "warning",
					timer : 2000,
					closeOnClickOutside : false,
					buttons : false
				});
				$("#telDir").focus();
			}
		} else {
			swal({
				text : "Introduce un correo",
				icon : "warning",
				timer : 2000,
				closeOnClickOutside : false,
				buttons : false
			});
			$("#corDir").focus();
		}
	} else {
		swal({
			text : "Introduce un nombre",
			icon : "warning",
			timer : 2000,
			closeOnClickOutside : false,
			buttons : false
		});
		$("#nomDir").focus();
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
				url : "../../ajax/dir/confDatDir.php?oper=confFotPerf",
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