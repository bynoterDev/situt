function init() {

	/*----------  ConfContraseña  ----------*/
	$("#btnCloseConfCont").on("click",function(){
		limpCamp();
	});
	$("#newCont").on("keyup",function(){
		segCont();
	});
	$("#formConfCont").on("submit",function(e){
		confCont(e);
	});	

	/*----------  ConfDatos  ----------*/
	$("#formConfDat").on("submit",function(e){
		confDat(e);
	});
}

/*================================================
=            Functions ConfContraseña            =
================================================*/

function limpCamp() {
	$("#contAct").val("");
	$("#newCont").val("");
	$("#repCont").val("");
	$("#mensaje").text("");
	$("#mensaje2").text("");
}

function segCont() {
	let mayus = new RegExp("^(?=.*[A-Z])");
	let lower = new RegExp("^(?=.*[a-z])");
	let len = new RegExp("^(?=.{8,})");
	let numbers = new RegExp("^(?=.*[0-9])");
	let newCont = $("#newCont").val();
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
	let newCont = $("#newCont").val();
	let repCont = $("#repCont").val();
	if (repCont === newCont) {
		$("#mensaje2").text("Las contraseñas coinciden").css({"color":"green"}).show();
		$("#btnGConfCont").prop("disabled",false);
	} else {
		$("#mensaje2").text("Las contraseñas no coinciden").css({"color":"red"}).show();
		$("#btnGConfCont").prop("disabled",true);
	}
}

function confCont(e) {
	e.preventDefault();
	let formConfCont = document.getElementById('formConfCont');
	let formDat = new FormData($(formConfCont)[0]);
	let contAct = $("#contAct").val();
	let newCont = $("#newCont").val();
	let repCont = $("#repCont").val();
	if (contAct.length > 0) {
		if (newCont.length > 0) {
			if (repCont.length > 0) {
				$.ajax({
					url : "../ajax/adm/functionsAdm.php?oper=confCont",
					type : "POST",
					data : formDat,
					contentType : false,
					processData : false,
					success : function(resp) {
						if (resp == 0) {
							swal({
								title : "Ocurrio un problema",
								text : "La contraseña no fue actualizada",
								icon : "error",
								button : "Aceptar"
							});
							limpCamp();
						} else if (resp == 1) {
							swal({
								title : "Actualización exitosa",
								text : "La contraseña fue cambiada correctamente",
								icon : "success",
								button: false,
							});
							setTimeout(function() {
								location.reload();
							}, 1500);
						} else if (resp == 2) {
							swal({
								text : "La contraseña actual no es correcta",
								icon : "warning",
								button : "Aceptar"
							});
							$("#contAct").val("");
							$("#contAct").focus();
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
				$("#repCont").focus();
			}
		} else {
			swal({
				text : "Escribe tu nueva contraseña",
				icon : "warning",
				timer : 2000,
				button : false,
				closeOnClickOutside: false
			});
			$("#newCont").focus();
		}
	} else {
		swal({
			text : "Escribe tu contraseña actual",
			icon : "warning",
			timer : 2000,
			button : false,
			closeOnClickOutside: false
		});
		$("#contAct").focus();
	}

}

/*=====  End of Functions ConfContraseña  ======*/

/*===========================================
=            Functions ConfDatos            =
===========================================*/

function validEmail() {
	let corAdm = document.getElementById('corAdm');
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

function confDat(e) {
	e.preventDefault();
	let formConfDat = document.getElementById('formConfDat');
	let formDat = new FormData($(formConfDat)[0]);
	let passConf = $("#passConf").val(), nomAdm = $("#nomAdm").val(), corAdm = $("#corAdm").val(),
	usrAdm = $("#usrAdm").val();
	if (nomAdm.length > 0) {
		if (corAdm.length > 0) {
			if (usrAdm.length > 0) {
				if (passConf.length > 0) {
					$.ajax({
						url : "../ajax/adm/functionsAdm.php?oper=confDat",
						type : "POST",
						data : formDat,
						contentType : false,
						processData : false,
						success : function(resp) {
							if (resp == 0) {
								swal({
									title : "Ocurrio un problema",
									text : "La contraseña no fue actualizada",
									icon : "error",
									button : "Aceptar"
								});
								$("#passConf").val("");
							} else if (resp == 1) {
								swal({
									title : "Actualización exitosa",
									text : "Los datos fuerón cambiados correctamente",
									icon : "success",
									button: false,
								});
								setTimeout(function() {
									location.reload();
								}, 1500);
							} else if (resp == 2) {
								swal({
									text : "La contraseña actual no es correcta",
									icon : "warning",
									button : "Aceptar"
								});
								$("#passConf").val("");
								$("#passConf").focus();
							}
						}
					});
				} else {
					swal({
						text : "Introduce tu contraseña",
						icon : "warning",
						timer : 2000,
						button : false,
						closeOnClickOutside : false
					});
					$("#passConf").focus();
				}
			} else {
				swal({
					text : "Introduce un usuario",
					icon : "warning",
					timer : 2000,
					button : false,
					closeOnClickOutside : false
				});
				$("#usrAdm").focus();
			}
		} else {
			swal({
				text : "Introduce un correo",
				icon : "warning",
				timer : 2000,
				button : false,
				closeOnClickOutside : false
			});
			$("#corAdm").focus();
		}
	} else {
		swal({
			text : "Introduce un nombre",
			icon : "warning",
			timer : 2000,
			button : false,
			closeOnClickOutside : false
		});
		$("#nomAdm").focus();
	}
}

/*=====  End of Functions ConfDatos  ======*/


init();