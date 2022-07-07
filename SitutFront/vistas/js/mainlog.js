function init() {
	$("#formLogAlm").on("submit", function(e) {
		validLogAlm(e);
	});
	$("#formRegAlm").on("submit", function(e) {
		regAlm(e);
	});
	$("#btnIcoClose, #btnCloseReg").on("click", function() {
		limpCampReg();
	});	
	$("#corAlm").on("change", function(){
		validEmail();
	});
	$("#contAlm").on("keyup", function(){
		segCont();
	});
	$("#contAlm, #repCont").on("keyup", function(){
		contIgul();
	});
	$("#regAq").on("click", function(e) {
		mostReg(e);
	});
	$("#logAq").on("click", function(e) {
		mostLog(e);
	});
}

function mostLog(e) {
	e.preventDefault();
	$("#columReg").removeClass("animated bounceInDown");
	$("#columReg").addClass("animated bounceOutUp");
	setTimeout(function(){
		$("#columReg").addClass("ocult");
	},1000);
	setTimeout(function(){
		$("#columIni").removeClass("ocult");
		$("#columIni").removeClass("animated bounceOutUp");
		$("#columIni").addClass("animated bounceInDown").show();
		limpCampReg();
	},1100);
}

function mostReg(e) {
	e.preventDefault();
	$("#columIni").removeClass("animated bounceInDown");
	$("#columIni").addClass("animated bounceOutUp");
	setTimeout(function(){
		$("#columIni").addClass("ocult");
	},1000);
	setTimeout(function() {
		$("#columReg").removeClass("ocult");
		$("#columReg").removeClass("animated bounceOutUp");
		$("#columReg").addClass("animated bounceInDown").show();
		limpCampLog();
	},1100);
}

function limpCampLog() {
	$("#cormatAlm").val(""); passAlm = $("#passAlm").val("");
}

function validLogAlm(e) {
	e.preventDefault();
	let formLogAlm = document.getElementById('formLogAlm');
	let formDat = new FormData($(formLogAlm)[0]);
	let cormatAlm = $("#cormatAlm").val(), passAlm = $("#passAlm").val();
	if (cormatAlm.length > 0) {
		if (passAlm.length > 0) {
			$.ajax({
				url : "ajax/valDatAlm.php?oper=logAlm", 
				type : "POST", data : formDat,
				contentType : false, processData : false,
				success : function(resp) {
					if (resp == 1) {
						swal({
							title: "Correcto!...",
							text: "Sesión Iniciada",
							icon: "success",
							button: false
						});
						setTimeout(function() {
							$(location).attr("href","modAlm/Home/");
						}, 1000);
					} else if (resp == "mal") {
						swal({
							text : "Datos incorrectos",
							icon : "warning",
							button : "Aceptar",
							closeOnClickOutside : false,
						});
					} else {
						console.log(resp);
					}
				}
			});
		} else {
			swal({
				text : "Introduce tu contraseña",
				icon : "warning",
				button : "Aceptar"
			}).then( ( acepta ) => {
				$("#passAlm").focus();
			});
		}
	} else {
		swal({
			text : "Introduce tu correo ó tu matricula",
			icon : "warning",
			button : "Aceptar"
		}).then( ( acepta ) => {
			$("#cormatAlm").focus();
		});
	}
}

function segCont() {
	let mayus = new RegExp("^(?=.*[A-Z])");
	let lower = new RegExp("^(?=.*[a-z])");
	let len = new RegExp("^(?=.{8,})");
	let numbers = new RegExp("^(?=.*[0-9])");
	let newCont = $("#contAlm").val();
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
	let newCont = $("#contAlm").val();
	let repCont = $("#repCont").val();
	if (newCont.length  == 0) {
		$("#repCont").val("");
		$("#mensaje2").text("").hide();
	} else {
		if (repCont.length > 0) {
			if (repCont === newCont) {
				$("#mensaje2").text("Las contraseñas coinciden").css({"color":"green"}).show();
				$("#btnRegAlm").prop("disabled",false);
			} else {
				$("#mensaje2").text("Las contraseñas no coinciden").css({"color":"red"}).show();
				$("#btnRegAlm").prop("disabled",true);
			}
		} else {
			$("#mensaje2").text("").hide();
			$("#btnRegAlm").prop("disabled",false);
		}
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
		$("#btnRegAlm").prop("disabled",false);
	} else {
		$(textcorr).text("Correo Invalido").show();
		$(textcorr).addClass("invalid-feedback");
		$(corAdm).addClass("is-invalid");
		$("#btnRegAlm").prop("disabled",true);
	}
	if (corAdm.value.length == 0) {
		$(textcorr).text("");
		$(textcorr).removeClass("invalid-feedback");
		$(corAdm).removeClass("is-invalid");
		$("#btnRegAlm").prop("disabled",true);
	}
}

function limpCampReg() {
	$("#nomAlm").val(""); $("#matAlm").val("");
	$("#corAlm").val(""); $("#contAlm").val("");
	$("#repCont").val(""); $("#telAlm").val("");
	$("#sexAlm").val("0"); $("#carAlm").val("SN");
	$("#mensaje").hide(); $("#mensaje2").hide();
}

function regAlm(e) {
	e.preventDefault();
	let formRegAlm = document.getElementById('formRegAlm');
	let formDat = new FormData($(formRegAlm)[0]), sexAlm = document.getElementById('sexAlm'),
	carAlm = document.getElementById('carAlm');
	if (sexAlm.value != "0") {
		if (carAlm.value != "SN") {
			$.ajax({
				url : "ajax/valDatAlm.php?oper=regAlm",
				type : "POST", data : formDat,
				contentType : false, processData : false,
				success : function( resp ) {
					if ( resp == "extDatMat" ) {
						swal({
							text : "La matricula ingresada ya existe",
							icon : "warning",
							button : "Aceptar",
							closeOnClickOutside : false
						}).then( ( acepta ) => {
							$("#matAlm").focus();
							$("#matAlm").val("");
						});
					} else if ( resp == "extDatCor" ) {
						swal({
							text : "El correo ingresado ya existe",
							icon : "warning",
							button : "Aceptar",
							closeOnClickOutside : false
						}).then( ( acepta ) => {
							$("#corAlm").focus();
							$("#corAlm").val("");
						});
					} else if ( resp == "goodIns" ) {
						swal({
							title : "Correcto!...",
							text : "Datos registrados exitosamente",
							icon : "success",
							buttons : "Aceptar",
							closeOnClickOutside : false
						}).then( ( acepta ) => {
							limpCampReg();
							$("#regAlm").modal("hide");
						});	
					} else if ( resp == "failIns" ) {
						swal({
							title : "Ocurrio un problema!....",
							text : "Los datos no han sido registrados",
							icon : "error",
							button : "Aceptar",
							closeOnClickOutside : false
						}).then( ( acepta ) => {
							limpCampReg();
							$("#regAlm").modal("hide");
						});
					} else {
						console.log( resp );
					}
				}
			});
		} else {
			swal({
				text : "Selecciona tu carrera",
				icon : "warning",
				button : "Aceptar",
				closeOnClickOutside : false
			}).then( ( acepta ) => {
				$("#carAlm").focus();
			});
		}
	} else {
		swal({
			text : "Selecciona tu sexo",
			icon : "warning",
			button : "Aceptar",
			closeOnClickOutside : false,
		}).then( ( acepta ) => {
			$("#sexAlm").focus();
		});
	}
}

init();