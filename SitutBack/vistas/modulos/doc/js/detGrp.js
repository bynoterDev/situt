let tablaalm;
let tablaalmacept;
let tablabecAlm;
function init() {
	setTimeout(function(){
		$("#textLoad").text("Correcto!");
		setTimeout(function(){
			$("#loader").addClass("animated bounceOutUp");
			setTimeout(function(){
				$("#loader").hide();
				setTimeout(function(){
					$("#contend, #loader1").removeClass("ocult");
					$("#contend").addClass("animated bounceInUp");
					$("#loader1").addClass("animated bounceInLeft");
				},500);
			}, 1000);
		},1500);
	},9000);
	limpCamp();
	listarAlumnos();
	listarAlumnosAcept();
	listarAlumnosBec();
	$("#contAl").on("keyup", function() {
		segCont();
		contIgul();
	});
	$("#repContAl").on("keyup", function() {
		contIgul();
	});
	$("#corAl").on("keyup", function() {
		validEmail();
	});
	$("#formRegAlGrp").on("submit", function(e) {
		regAlmGrp(e);
	});
	$("#formEditBec").on("submit", function(e){
		editBecAlm(e);
	});
	setInterval(function(){
		tablaalmacept.ajax.reload();
	},10000);
}

function limpCamp() {
	$("#nomAl").val(""); $("#corAl").val("");
	$("#contAl").val(""); $("#repContAl").val("");
	$("#matAl").val(""); $("#telAl").val("");
	$("#sexAl").val("0");
	$("#estAl").val("1"); $("#aceptGrp").val("1");
	$("#mensaje").text("").hide(); $("#mensaje2").text("").hide();
}

function segCont() {
	let mayus = new RegExp("^(?=.*[A-Z])");
	let lower = new RegExp("^(?=.*[a-z])");
	let len = new RegExp("^(?=.{8,})");
	let numbers = new RegExp("^(?=.*[0-9])");
	let newCont = $("#contAl").val();
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
	let newCont = $("#contAl").val();
	let repCont = $("#repContAl").val();
	if (repCont.length > 0) {
		if (repCont === newCont) {
			$("#mensaje2").text("Las contraseñas coinciden").css({"color":"green"}).show();
			$("#btnGRegAlm").prop("disabled",false);
		} else {
			$("#mensaje2").text("Las contraseñas no coinciden").css({"color":"red"}).show();
			$("#btnGRegAlm").prop("disabled",true);
		}
	} else {
		$("#mensaje2").text("").hide();
		$("#btnGRegAlm").prop("disabled", false);
	}
}

function validEmail() {
	let corAdm = document.getElementById('corAl');
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
		$("#btnGRegAlm").prop("disabled",false);
	} else {
		$(textcorr).text("Formato de correo invalido").show();
		$(textcorr).addClass("invalid-feedback");
		$(corAdm).addClass("is-invalid");
		$("#btnGRegAlm").prop("disabled",true);
	}
	if (corAdm.value.length == 0) {
		$(textcorr).text("");
		$(textcorr).removeClass("invalid-feedback");
		$(corAdm).removeClass("is-invalid");
		$("#btnGRegAlm").prop("disabled",false);
	}
}

function regAlmGrp(e) {
	e.preventDefault();
	let formRegAlGrp = document.getElementById('formRegAlGrp'),
	formDat = new FormData($(formRegAlGrp)[0]);
	let nomAl = $("#nomAl").val(), corAl = $("#corAl").val(), contAl = $("#contAl").val(),
	repContAl = $("#repContAl").val(), matAl = $("#matAl").val(), telAl = $("#telAl").val(),
	sexAl = document.getElementById('sexAl'),
	estAl = document.getElementById('estAl'), aceptGrp = document.getElementById('aceptGrp');
	if (nomAl.length > 0) {
		if (corAl.length > 0) {
			if (contAl.length > 0) {
				if (repContAl.length > 0) {
					if (matAl.length > 0) {
						if (telAl.length > 0) {
							if (sexAl.value != "0") {
								if (estAl.value != "No") {
									if (aceptGrp.value != "No") {
										$.ajax({
											url : "../ajax/doc/tutFunctions.php?oper=regAlmGrp",
											type : "POST", data: formDat,
											contentType : false, processData : false,
											success : function( resp ) {
												if ( resp == "goodIns" ) {
													swal({
														title : "Correcto!...",
														text : "Los datos han sido registrados",
														icon : "success",
														button : "Aceptar"
													}).then( ( acepta ) => {
														limpCamp();
													});
												} else if ( resp == "failIns" ) {
													swal({
														title : "Ocurrio un problema",
														text : "Los datos no han sido registrados",
														icon : "error",
														button : "Aceptar"
													}).then( ( acepta ) => {
														limpCampos();
													});
												} else if ( resp == "nomExt" ) {
													swal({
														text : "Ya existe un alumno con ese nombre",
														icon : "warning",
														button : "Aceptar"
													}).then( ( acepta ) => {
														$("#nomAl").focus();
													});
												} else if ( resp == "corExt" ) {
													swal({
														text : "Ya existe un alumno con ese correo",
														icon : "warning",
														button : "Aceptar"
													}).then( ( acepta ) => {
														$("#corAl").focus();
													});
												} else if ( resp == "matExt" ) {
													swal({
														text : "Ya existe un alumno con esa matricula",
														icon : "warning",
														button : "Aceptar"
													}).then( ( acepta ) => {
														$("#matAl").focus();
													});
												}
											}
										});
									} else {
										swal({
											text : "Seleccione un estado en el grupo para el alumno",
											icon : "warning",
											closeOnClickOutside : false,
											buttons : "Aceptar"
										}).then(( acepta ) => {
											$("#aceptGrp").focus();
										});
									}
							} else {
								swal({
									text : "Seleccione un estado para el alumno",
									icon : "warning",
									closeOnClickOutside : false,
									buttons : "Aceptar"
								}).then(( acepta ) => {
									$("#estAl").focus();
								});
							}
							} else {
								swal({
									text : "Seleccione un sexo para el alumno",
									icon : "warning",
									closeOnClickOutside : false,
									buttons : "Aceptar"
								}).then(( acepta ) => {
									$("#sexAl").focus();
								});
							}
						} else {
							swal({
								text : "Introduce un numero telefonico",
								icon : "warning",
								closeOnClickOutside : false,
								buttons : "Aceptar"
							}).then(( acepta ) => {
								$("#repContAl").focus();
							});
						}
					} else {
						swal({
							text : "Introduce una matricula",
							icon : "warning",
							closeOnClickOutside : false,
							buttons : "Aceptar"
						}).then(( acepta ) => {
							$("#matAl").focus();
						});
					}
				} else {
					swal({
						text : "Repite la contraseña",
						icon : "warning",
						closeOnClickOutside : false,
						buttons : "Aceptar"
					}).then(( acepta ) => {
						$("#repContAl").focus();
					});
				}
			} else {
				swal({
					text : "Introduce una contraseña",
					icon : "warning",
					closeOnClickOutside : false,
					buttons : "Aceptar"
				}).then(( acepta ) => {
					$("#contAl").focus();
				});
			}
		} else {
			swal({
				text : "Introduce un correo",
				icon : "warning",
				closeOnClickOutside : false,
				buttons : "Aceptar"
			}).then(( acepta ) => {
				$("#corAl").focus();
			});
		}
	} else {
		swal({
			text : "Introduce un nombre",
			icon : "warning",
			closeOnClickOutside : false,
			buttons : "Aceptar"
		}).then(( acepta ) => {
			$("#nomAl").focus();
		});
	}
}

function listarAlumnos() {
	tablaalm = $("#tbListadoAlumnos").dataTable({
		"aProcessing" : true,
		"aServerSide" : true,
		dom : 'Bftrip',
		buttons: [
		],
		"ajax" : {
			url : "../ajax/doc/tutFunctions.php?oper=listarAlumnos",
			type : "GET",
			dataType : "json",
			error : function(e) {
				console.log(e.responseText);
			}
		},
		"bDestroy" : true,
		"iDisplayLength" : 5,
		"order" : [[0, "desc"]]
	}).DataTable();
}	

function listarAlumnosAcept() {
	tablaalmacept = $("#tbListadoAlumnosAcept").dataTable({
		"aProcessing" : true,
		"aServerSide" : true,
		dom : 'Bftrip',
		buttons: [
		],
		"ajax" : {
			url : "../ajax/doc/tutFunctions.php?oper=listarAlumnosAcept",
			type : "GET",
			dataType : "json",
			error : function(e) {
				//console.log(e.responseText);
			}
		},
		"bDestroy" : true,
		"iDisplayLength" : 5,
		"order" : [[0, "desc"]]
	}).DataTable();
}

function activarAlmGrp(id_alumno) {
	swal({
		title : "Esta seguro?",
		text : "De aceptar al alumno al grupo?",
		icon : "warning",
		dangerMode : false,
		buttons : true
	}).then( ( acepta ) => {
		if (acepta) {
			$.post("../ajax/doc/tutFunctions.php?oper=activarAlmGrp",
				{id_alumno : id_alumno},
				function( resp ){
					if ( resp == 1) {
						swal({
							title : "Correcto!...",
							text : "Alumno vinculado al grupo",
							icon : "success",
							button : "Aceptar",
							closeOnClickOutside : false
						}).then( ( acepta ) => {
							tablaalm.ajax.reload();
							tablaalmacept.ajax.reload();
						});
					} else if ( resp == 0) {
						swal({
							title : "Ocurrio un problema",
							text : "El alumno no fue vinculado al grupo",
							icon : "error",
							button : "Aceptar",
							closeOnClickOutside : false
						}).then( ( acepta ) => {
							location.reload();
						});
					} else {
						console.log( resp );
					}
					// swal(e);
				});
		} else {
			swal("Bien");
		}
	});
}

function desactivarAlmGrp(id_alumno) {
	swal({
		title : "Esta seguro?",
		text : "De rechazar al alumno al grupo?",
		icon : "warning",
		dangerMode : false,
		buttons : true
	}).then( ( acepta ) => {
		if (acepta) {
			$.post("../ajax/doc/tutFunctions.php?oper=desactivarAlmGrp",
				{id_alumno : id_alumno},
				function(e){
					swal(e);
					tablaalm.ajax.reload();
					tablaalmacept.ajax.reload();
				});
		} else {
			swal("Bien");
		}
	});
}

//Funcion listado alumnos becados

function listarAlumnosBec() {
	tablabecAlm = $("#tbListadoBecadosAlm").dataTable({
		"aProcessing" : true,
		"aServerSide" : true,
		dom : 'Bftrip',
		buttons: [
		],
		"ajax" : {
			url : "../ajax/doc/tutFunctions.php?oper=listarAlumnosBec",
			type : "GET",
			dataType : "json",
			error : function(e) {
				console.log(e.responseText);
			}
		},
		"bDestroy" : true,
		"iDisplayLength" : 5,
		"order" : [[0, "desc"]]
	}).DataTable();
}

//Funcion alumnos becados
function becadoAlm(id_alumno) {
	swal({
		title : "Esta seguro?",
		icon : "warning",
		dangerMode : false,
		buttons : true
	}).then( ( acepta ) => {
		if (acepta) {
			$.post("../ajax/doc/tutFunctions.php?oper=becadoAlm",
				{id_alumno : id_alumno},
				function(e){
					swal(e);
					tablaalm.ajax.reload();
					tablaalmacept.ajax.reload();
					tablabecAlm.ajax.reload();
				});
		} else {
			swal("Bien");
		}
	});
}



function becadoRechAlm(id_alumno) {
	swal({
		title : "Esta seguro?",
		icon : "warning",
		dangerMode : false,
		buttons : true
	}).then( ( acepta ) => {
		if (acepta) {
			$.post("../ajax/doc/tutFunctions.php?oper=becadoRechAlm",
				{id_alumno : id_alumno},
				function(e){
					swal(e);
					tablaalm.ajax.reload();
					tablaalmacept.ajax.reload();
					tablabecAlm.ajax.reload();
				});
		} else {
			swal("Bien");
		}
	});
}

/*----------  Cerrar ventana de alumnos becados  ----------*/

function btnEditBec() {
	$("#becAlm").modal('hide');
}

/*----------  Cerrar ventana de editar beca y abrir ver ventana de becados  ----------*/

$("#btnCloseEditBec").on("click", function(){
	$("#becAlm").modal('show');
});

/*----------  Ver datos del alumno becado seleccionado  ----------*/

function editBec(id_becadoalm) {
	$.post("../ajax/doc/tutFunctions.php?oper=editBec",
		{id_becadoalm : id_becadoalm}, 
		function(data, status){
			data = JSON.parse(data);
			$("#id_becadoalm").val(data.id_becadoalm);
			$("#almBec").val(data.nombre_c_al);
			$("#tipBeca2").val(data.tipo_beca_alm);
		});
}

/*----------  Editar tipo beca del alumno  ----------*/

function editBecAlm(e) {
	e.preventDefault();
	let formEditBec = document.getElementById('formEditBec');
	let formDat = new FormData($(formEditBec)[0]);
	let tipBeca = $("#tipBeca").val();
	if (tipBeca.length > 0) {
		$.ajax({
			url : "../ajax/doc/tutFunctions.php?oper=editBecAlm",
			type : "POST", data : formDat,
			contentType : false, processData : false,
			success : function( resp ) {
				if ( resp === "goodUpd") {
					swal({
						title : "Correcto!...",
						text : "Datos actualizados correctamente",
						icon : "success", 
						button : "Aceptar"
					}).then( ( acepta ) => {
						$("#editBec").modal('hide');
						$("#becAlm").modal('show');
						$("#tipBeca").val("0");
					});
					tablabecAlm.ajax.reload();
				} else if ( resp === "failUpd") {
					swal({
						tittle : "Ocurrio un problema :(",
						text : "Los datos no han sido actualizados",
						icon : "error",
						button : "Aceptar"
					}).then( ( acepta ) => {
						$("#editBec").modal('hide');
						$("#becAlm").modal('show');
					});
				}
			}
		});
	} else {
		swal({
			text : "Introduce el tipo de beca del alumno",
			icon : "warning",
			button : "Aceptar"
		}).then( ( acepta ) => {
			$("#tipBeca").focus();
		});
	}
}

/*setInterval(function () {
	cargarNotif();
},5000);

function cargarNotif () {
	$.ajax({
		url:'../ajax/doc/notifAlm.php?oper=mostNotif.php',
		type:'POST',
		success:function (data) {
			$('.listNot').html(data);
		}
	});
}*/

init();