function init() {
	$(window).scroll(function() {
	  if ($("#menu1").offset().top > 56) {
	      $("#menu1").addClass("bg-info");
	  } else {
	      $("#menu1").removeClass("bg-info");
	  }
	});
	$(window).scroll(function(){
		if ($("#menu2").offset().top > 56) {
	      $("#menu2").addClass("bg-info");
	      $("#textLog").text("U T S E M");
	  } else {
	      $("#menu2").removeClass("bg-info");
	      $("#textLog").text("S I T U T");
	  }
	});
	$("#difAprendMat").on("click", function() {
		validOpc1A();
	});
	$("#otrosOpcA").on("click", function() {
		validOpc2A();
	});
	$("#otrosOpcC").on("click", function() {
		validOpcC();
	});
	$("#formRegBaja").on("submit", function(e) {
		regBajaAlm(e);
	});
}

// function validOpc1A() {
// 	let otrosOpcA0 = document.getElementById('otrosOpcA0');
// 	if ($("#difAprendMat")[0].checked == true) {
// 		$("#otrosOpcA0").prop("disabled", false);
// 		$("#otrosOpcA0").focus();
// 		otrosOpcA0.setAttribute("required","");
// 	} else {
// 		$("#otrosOpcA0").prop("disabled", true);
// 		$("#otrosOpcA0").val("");
// 		otrosOpcA0.removeAttribute("required");
// 	}
// }

// function validOpc2A() {
// 	let otrosOpcA1 = document.getElementById('otrosOpcA1');
// 	if ($("#otrosOpcA")[0].checked == true) {
// 		$("#otrosOpcA1").prop("disabled", false);
// 		$("#otrosOpcA1").focus();
// 		otrosOpcA1.setAttribute("required","");
// 	} else {
// 		$("#otrosOpcA1").prop("disabled", true);
// 		$("#otrosOpcA1").val("");
// 		otrosOpcA1.removeAttribute("required");
// 	}
// }

// function validOpcC() {
// 	let opcOtrC = document.getElementById('opcOtrC');
// 	if ($("#otrosOpcC")[0].checked == true) {
// 		$("#opcOtrC").prop("disabled", false);
// 		$("#opcOtrC").focus();
// 		opcOtrC.setAttribute("required","");
// 	} else {
// 		$("#opcOtrC").prop("disabled", true);
// 		$("#opcOtrC").val("");
// 		opcOtrC.removeAttribute("required");
// 	}
// }

function regBajaAlm(e) {
	e.preventDefault();
	let formRegBaja = document.getElementById('formRegBaja'),
	formDat = new FormData($(formRegBaja)[0]), 
	tipBaja = document.getElementById('tipBaja'), periodo = document.getElementById('periodo'),
	bajasolicitada = document.getElementById('bajasolicitada'), passConf = $("#passConf").val();
	if (tipBaja.value == "BAJA TEMPORAL" || tipBaja.value == "BAJA DEFINITIVA") {
		if (periodo.value == "ENE-ABR" || periodo.value == "MAY-AGO" || periodo.value == "SEP-DIC") {
			if (bajasolicitada.value == "SI" || bajasolicitada.value == "NO") {
				if (passConf.length > 0) {
					swal({
						title : "Esta seguro de iniciar el proceso?",
						icon : "warning",
						buttons : true,
						closeOnClickOutside : false
					}).then( ( acepta ) => {
						if (acepta) {
							$.ajax({
								url : "../ajax/doc/bajasAlm.php?oper=regBajaAlm", 
								type : "POST", data : formDat, 
								contentType : false, processData : false,
								success : function( resp ) {
									if ( resp == "goodIns" ) {
										swal({
											title : "Correcto!...",
											text : "Los datos han sido registrados",
											icon : "success",
											button : "Aceptar",
											closeOnClickOutside : false
										}).then( ( acepta ) => {
											location.reload();
										});
									} else if ( resp == "failIns" ) {
										swal({
											title : "Ocurrio un problema",
											text : "Los datos no han sido registrados",
											icon : "error",
											button : "Aceptar",
											closeOnClickOutside : false
										}).then( ( acepta ) => {
											location.reload();
										});
									} else if ( resp == "failCont" ) {
										swal({
											text : "La contraseña ingresada es incorrecta",
											icon : "warning",
											button : "Aceptar",
											closeOnClickOutside : false
										}).then( ( acepta ) => {
											$("#passConf").focus();
											$("#passConf").val("");
										});
									} else if ( resp == "extDat" ) {
										swal({
											text : "Ya existe un registro",
											icon : "warning",
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
						} else {
							swal("Bien");
							setTimeout(function(){
								location.reload();
							}, 1500);
						}
					});
				} else {
					swal({
						text : "Introduzca su contraseña para confirmar",
						icon : "warning",
						button : "Aceptar",
						closeOnClickOutside : false
					}).then( ( acepta ) => {
						$("#passConf").focus();
					});
				}
			} else {
				swal({
					text : "Seleccione si la baja fue solicitada por el alumno",
					icon : "warning",
					button : "Aceptar",
					closeOnClickOutside : false
				}).then( ( acepta ) => {
					$("#bajasolicitada").focus();
				});
			}
		} else {
			swal({
				text : "Seleccione el periodo de reincorporación",
				icon : "warning",
				button : "Aceptar",
				closeOnClickOutside : false
			}).then( ( acepta ) => {
				$("#periodo").focus();
			});
		}
	} else {
		swal({
			text : "Seleccione un tipo de baja",
			icon : "warning",
			button : "Aceptar",
			closeOnClickOutside : false
		}).then( ( acepta ) => {
			$("#tipBaja").focus();
		});
	}
}

init();
