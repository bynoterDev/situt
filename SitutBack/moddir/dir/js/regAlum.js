function init() {
	$("#passAlm").on("keyup", function() {
		segCont(); contIgul();
	});
	$("#repPass").on("keyup", function() {
		contIgul();
	});
	$("#btnRegAlm").on("click", function(e) {
		envDatAlmArch(e);
	});
}

function segCont() {
	let mayus = new RegExp("^(?=.*[A-Z])");
	let lower = new RegExp("^(?=.*[a-z])");
	let len = new RegExp("^(?=.{8,})");
	let numbers = new RegExp("^(?=.*[0-9])");
	let newCont = $("#passAlm").val();
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
	let passTut = $("#passAlm").val();
	let repPassTut = $("#repPass").val();
	if (repPassTut.length > 0) {
		if (repPassTut === passTut) {
			$("#mensaje2").text("Las contraseñas coinciden").css({"color":"green"}).show();
			$("#btnRegAlm").prop("disabled",false);
		} else {
			$("#mensaje2").text("Las contraseñas no coinciden").css({"color":"red"}).show();
			$("#btnRegAlm").prop("disabled",true);
		}
	} else {
		$("#mensaje2").text("").hide();
	}
}

function envDatAlmArch(e) {
	e.preventDefault();
	let formRegAlmArch = document.getElementById('formRegAlmArch'),
	archAlm = document.getElementById('archAlm').value, passAlm = $("#passAlm").val(), 
	repPass = $("#repPass").val();
	let extPerm = /(.xlsx)$/i;
	if (!archAlm) {
		swal({
			text : "Selecciona un archivo",
			icon : "warning",
			button : "Aceptar",
			closeOnClickOutside : false
		}).then( ( acepta ) => {
			$("#archAlm").val("");
			setTimeout(function(){
				$("#archAlm").focus();
			}, 1000);
		});
	} else {
		if (!extPerm.exec(archAlm)) {
			swal({
				text : "Selecciona un archivo con extensión .xlsx",
				icon : "warning",
				button : "Aceptar",
				closeOnClickOutside : false
			}).then( ( acepta ) => {
				$("#archAlm").val("");
			});
		} else {
			if (passAlm.length > 0) {
				if (repPass.length > 0) {
					formRegAlmArch.submit();
				} else {
					swal({
						text : "Repite la contraseña",
						icon : "warning",
						button : "Aceptar",
						closeOnClickOutside : false
					}).then( ( acepta) => {
						$("#repPass").focus();
					});
				}
			} else {
				swal({
					text : "Introduce una contraseña",
					icon : "warning",
					button : "Aceptar",
					closeOnClickOutside : false
				}).then( ( acepta ) => {
					$("#passAlm").focus();
				});
			}
		}
	}
}

init();