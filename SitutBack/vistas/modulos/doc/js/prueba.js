function init() {
	$("#newContDoc").on("keyup", function(){
		segCont();
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

function segCont() {
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

function contIgul() {
	let newCont = $("#newContDoc").val();
	let repCont = $("#repContDoc").val();
	if (repCont.length > 0) {
		if (repCont === newCont) {
			$("#mensaje2").text("Las contraseñas coinciden").css({"color":"green"}).show();
			$("#btnGConfContDoc").prop("disabled",false);
		} else {
			$("#mensaje2").text("Las contraseñas no coinciden").css({"color":"red"}).show();
			$("#btnGConfContDoc").prop("disabled",true);
		}
	} else {
		$("#mensaje2").text("").hide();
		$("#btnGConfContDoc").prop("disabled", false);
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
		 			url : "../ajax/doc/confDatDoc.php?oper=confContDoc",
		 			type : "POST", data : formDat,
		 			contentType : false, processData : false,
		 			success : function( resp ) {
		 				if (resp === "goodUp") {
							swal({
								title : "Actualización exitosa",
								text : "La contraseña fue cambiada correctamente",
								icon : "success",
								button: false,
							});
							setTimeout(function() {
								location.reload();
							}, 1500);
						} else if (resp === "failUp") {
							swal({
								title : "Ocurrio un problema",
								text : "La contraseña no fue actualizada",
								icon : "error",
								button : "Aceptar"
							});
							limpCamp();
						} else if (resp === "failCont"){
							swal({
								text : "La contraseña actual no es correcta",
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
					text : "Repite tu nueva contraseña",
					icon : "warning",
					timer : 2000,
					button : false,
					closeOnClickOutside: false
				});
				$("#repContDoc").focus();
		 	}
		 } else {
		 	swal({
				text : "Escribe tu nueva contraseña",
				icon : "warning",
				timer : 2000,
				button : false,
				closeOnClickOutside: false
			});
			$("#newContDoc").focus();
		 }
	} else {
		swal({
			text : "Escribe tu contraseña actual",
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
								url : "../ajax/doc/confDatDoc.php?oper=confDatDoc",
								type : "POST", data : formDat,
								contentType : false, processData : false,
								success : function( resp ) {
									if (resp === "goodUp") {
										swal({
											title : "Actualización exitosa",
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
											text : "La contraseña ingresada no es correcta",
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
								text : "Introduce tu contraseña",
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

init();