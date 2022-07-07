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
	$("#vulnerable").on("change", function() {
		validSel1Ins();
	});
	$("#formEvalTest").on("submit", function(e) {
		regEvalTest(e);
	});
	$("#formEditEval").on("submit", function(e) {
		editEvalTest(e);
	});
	$("#vulnerableEdit").on("change", function() {
		validSel1Edt();
	});
}

function validSel1Ins() {
	let vulnerable = document.getElementById('vulnerable');
	if (vulnerable.value == "Si") {
		$("#opcion1").prop("disabled", false);
		$("#opcion2").prop("disabled", false);
		$("#opcion3").prop("disabled", false);
	} else if (vulnerable.value == "No") {
		$("#opcion1").prop("disabled", true);
		$("#opcion2").prop("disabled", true);
		$("#opcion3").prop("disabled", true);
		if ($("#opcion1")[0].checked == true) {
			document.getElementById('opcion1').checked = 0;
		}
		if ($("#opcion2")[0].checked == true) {
			document.getElementById('opcion2').checked = 0;
		}
		if ($("#opcion3")[0].checked == true) {
			document.getElementById('opcion3').checked = 0;
		}
	}
}

function regEvalTest(e) {
	e.preventDefault();
	let formEvalTest = document.getElementById('formEvalTest');
	let formDat = new FormData($(formEvalTest)[0]);
	let vulnerable = document.getElementById('vulnerable');
	if (vulnerable.value != "0") {
		$.ajax({
			url : "../ajax/doc/functGrpAlm.php?oper=regEvalTest",
			type : "POST", data : formDat,
			contentType : false, processData : false,
			success : function( resp ) {
				if ( resp === "goodIns" ) {
					swal({
						title : "Correcto!...",
						text : "Los datos han sido registrados",
						icon : "success",
						button : "Aceptar"
					}).then( ( acepta ) => {
						location.reload();
					});
 				} else if ( resp === "failIns" ) {
 					swal({
						title : "Ocurrio un problema!...",
						text : "Los datos no han sido registrados",
						icon : "error",
						button : "Aceptar"
					}).then( ( acepta ) => {
						location.reload();
					});
 				} else if ( resp === "extDat") {
 					location.reload();
 				}
			}
		});
	} else {
		swal({
			text : "Selecciona una opción",
			icon : "warning",
			button : "Aceptar"
		}).then( ( acepta ) => {
			$("#vulnerable").focus();
		});
	}
}

function editEvalTest(e) {
	e.preventDefault();
	let formEditEval = document.getElementById('formEditEval');
	let formDat = new FormData($(formEditEval)[0]);
	let passEditEval = $("#passEditEval").val();
	if (passEditEval.length > 0) {
		$.ajax({
			url : "../ajax/doc/functGrpAlm.php?oper=editEvalTest",
			type : "POST", data : formDat,
			contentType : false, processData : false,
			success : function( resp ) {
				if ( resp === "goodUpd" ) {
					swal({
						title : "Actualización exitosa",
						text : "Datos cambiados correctamente",
						icon : "success",
						button: false,
					});
					setTimeout(function() {
						location.reload();
					}, 1500);
					// setTimeout(function(){
					// 	$("#pills-contact-tab").tab("show");
					// },5000);
				} else if ( resp === "failUpd" ) {
					swal({
						title : "Ocurrio un problema",
						text : "Los datos no fueron actualizados",
						icon : "error",
						button : "Aceptar"
					});
					$("#passEditEval").val("");
					$("#editEval").modal("hide");
				} else if ( resp === "failCont" ) {
					swal({
						text : "La contraseña ingresada no es correcta",
						icon : "warning",
						button : "Aceptar"
					}).then((acepta) => {
						$("#passEditEval").val("");
						$("#passEditEval").focus();
					});
				} else {
					location.reload();
				}
			}
		});
	} else {
		swal({
			text : "Introduce tu contraseña para actualizar",
			icon : "warning",
			button : "Aceptar"
		}).then( ( acepta ) => {
			$("#passEditEval").focus();
		});
	}
}

function validSel1Edt() {
	let vulnerableEdit = document.getElementById('vulnerableEdit');
	if (vulnerableEdit.value == "Si") {
		$("#opcion1Edit").prop("disabled", false);
		$("#opcion2Edit").prop("disabled", false);
		$("#opcion3Edit").prop("disabled", false);
	} else if (vulnerableEdit.value == "No") {
		$("#opcion1Edit").prop("disabled", true);
		$("#opcion2Edit").prop("disabled", true);
		$("#opcion3Edit").prop("disabled", true);
		if ($("#opcion1Edit")[0].checked == true) {
			document.getElementById('opcion1Edit').checked = 0;
		}
		if ($("#opcion2Edit")[0].checked == true) {
			document.getElementById('opcion2Edit').checked = 0;
		}
		if ($("#opcion3Edit")[0].checked == true) {
			document.getElementById('opcion3Edit').checked = 0;
		}
	}
}

init();