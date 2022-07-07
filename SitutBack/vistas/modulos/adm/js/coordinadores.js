let tablaCorAct;
let tablaCorInc;
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
	mostListCorActiv(true);
	$("#formGCord").on("submit", function(e) {
		regCor(e);
	});
	$("#contCor").on("keyup", function() {
		segContCor(); contIgulCor();
	});
	$("#repContCor").on("keyup", function() {
		contIgulCor();
	});
	$("#corCord").on("change", function() {
		validEmailCor();
	});
	$("#corCorEdit").on("change", function() {
		validEmailCorEdit();
	});
	$("#formEditCor").on("submit", function(e) {
		editCor(e);
	});
	$("#btnClosIco, #closIco").on("click", function() {
		$("#pasConfAdm").val("");
	});
	listarCorAct(); listarCorInc();
	setInterval(function(){
		corAct(); corInc();
	},1000);
	$("#btnClosePasNewCor, #btnCloseIcoPasCor").on("click", function() {
		limpCamposNewContCor();
	});
	$("#newContCor").on("keyup", function() {
		segContNewPasCor();
	});
	$("#newContCor, #repContNewCor").on("keyup", function() {
		contIgulNewPasCor();
	});
	$("#formNewPasCor").on("submit", function(e) {
		editNewPasCor(e);
	});
}

function validEmailCor() {
	let emailCont = document.getElementById('corCord');
	let textcorr = document.getElementById('textcorr');
	let emailValid = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
	if (emailValid.test(emailCont.value)) {
		$(textcorr).text("Correcto!").show().fadeOut(2000);
		$(textcorr).addClass("valid-feedback");
		$(textcorr).removeClass("invalid-feedback");
		$(emailCont).addClass("is-valid");
		setTimeout(function() {
			$(emailCont).removeClass("is-valid");
		}, 2000);
		$(emailCont).removeClass("is-invalid");
		$("#btnGCor").prop("disabled",false);
		//$("#btnAdmEdit").addClass("bg-success");
	} else {
		$(textcorr).text("Correo Invalido").show();
		$(textcorr).addClass("invalid-feedback");
		$(emailCont).addClass("is-invalid");
		$("#btnGCor").prop("disabled",true);
	}
	if (emailCont.value.length == 0) {
		$(textcorr).text("");
		$(textcorr).removeClass("invalid-feedback");
		$(emailCont).removeClass("is-invalid");
		$("#btnGCor").prop("disabled",false);
	}
}

function segContCor() {
	let mayus = new RegExp("^(?=.*[A-Z])");
	let lower = new RegExp("^(?=.*[a-z])");
	let len = new RegExp("^(?=.{8,})");
	let numbers = new RegExp("^(?=.*[0-9])");
	let newCont = $("#contCor").val();
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

function contIgulCor() {
	let newCont = $("#contCor").val();
	let repCont = $("#repContCor").val();
	if (repCont.length > 0) {
		if (repCont === newCont) {
			$("#mensaje2").text("Las contraseñas coinciden").css({"color":"green"}).show();
			$("#btnGCor").prop("disabled",false);
		} else {
			$("#mensaje2").text("Las contraseñas no coinciden").css({"color":"red"}).show();
			$("#btnGCor").prop("disabled",true);
		}
	} else {
		$("#mensaje2").text("").hide();
	}
}

function regCor(e) {
	e.preventDefault();
	let formGCord = document.getElementById('formGCord');
	let formDat = new FormData($(formGCord)[0]);
	let nomCor = $("#nomCor").val(), corCord = $("#corCord").val(), contCor = $("#contCor").val(),
	repContCor = $("#repContCor").val(), telCor = $("#telCor").val(), 
	sexCor = document.getElementById('sexCor');
	if (nomCor.length > 0) {
		if (corCord.length > 0) {
			if (contCor.length > 0) {
				if (repContCor.length > 0) {
					if (sexCor.value != "0") {
						$.ajax({
							url : "../ajax/adm/functionsAdm.php?oper=regCor",
							type : "POST", data : formDat,
							contentType : false, processData : false,
							success : function( resp ) {
								if ( resp == 2) {
									swal({
										text : "El correo introducido ya se encuentra registrado",
										icon : "warning",
										button : "Aceptar",
										closeOnClickOutside : false
									}).then( ( acepta ) => {
										$("#corCord").val("");
										$("#corCord").focus();
									});	
								} else if ( resp == 1) {	
									swal({
										title : "Correcto!...",
										text : "Datos registrados exitosamente",
										icon : "success",
										button : "Aceptar",
										closeOnClickOutside : false
									}).then( ( acepta ) => {
										$("#nomCor").val(""); $("#corCord").val("");
										$("#contCor").val(""); $("#repContCor").val("");
										$("#telCor").val(""); $("#sexCor").val("0");
										$("#mensaje").text(""); $("#mensaje2").text(""); 
										$("#mensaje").hide(); $("#mensaje2").hide(); 
										$("#textcorr").hide();
										tablaCorAct.ajax.reload();
										tablaCorInc.ajax.reload();
									});
								} else if ( resp == 0) {
									swal({
										title : "Ocurrio un problema",
										text : "Datos no registrados",
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
					} else {
						swal({
							text : "Selecciona el sexo",
							icon : "warning",
							button : "Aceptar",
							closeOnClickOutside : false
						}).then( ( acepta ) => {
							$("#sexCor").focus();
						});
					}
				} else {
					swal({
						text : "Repite tu contraseña",
						icon : "warning",
						button : "Aceptar",
						closeOnClickOutside : false
					}).then( ( acepta ) => {
						$("#repContCor").focus();
					});

				}
			} else {
				swal({
					text : "Introduce una contraseña",
					icon : "warning",
					button : "Aceptar",
					closeOnClickOutside : false
				}).then( ( acepta ) => {
					$("#contCor").focus();
				});
			}
		} else {
			swal({
				text : "Introduce un correo",
				icon : "warning",
				button : "Aceptar",
				closeOnClickOutside : false
			}).then( ( acepta ) => {
				$("#corCord").focus();
			});
		}
	} else {
		swal({
			text : "Introduce un nombre",
			icon : "warning",
			button : "Aceptar",
			closeOnClickOutside : false
		}).then( ( acepta ) => {
			$("#nomCor").focus();
		});
	}
}

function listarCorAct() {
	tablaCorAct = $("#tbListadoCorAct").dataTable({
		"aProcessing" : true,
		"aServerSide" : true,
		dom : 'Bftrip',
		buttons: [
		],
		"ajax" : {
			url : "../ajax/adm/functionsAdm.php?oper=listarCorAct",
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

function listarCorInc() {
	tablaCorInc = $("#tbListadoCorInc").dataTable({
		"aProcessing" : true,
		"aServerSide" : true,
		dom : 'Bftrip',
		buttons: [
		],
		"ajax" : {
			url : "../ajax/adm/functionsAdm.php?oper=listarCorInc",
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

function mostListCorActiv(flag) {
	if (flag) {
		$("#tablaCorAct").fadeIn("2000");
		$("#listCorAct").addClass("active");
	} else {
		$("#tablaCorAct").slideUp();
		$("#listCorAct").removeClass("active");
	}
}

function mostListCorInact(flag) {
	if (flag) {
		$("#tablaCorInc").fadeIn("2000");
		$("#listCorInc").addClass("active");
	} else {
		$("#tablaCorInc").slideUp();
		$("#listCorInc").removeClass("active");
	}
}

function mostrarCor(id_coordinador) {
	$.post("../ajax/adm/functionsAdm.php?oper=mostrarCor",
		{id_coordinador : id_coordinador}, 
		function(data, status){
			data = JSON.parse(data);
			$("#id_coordinador").val(data.id_coordinador);
			$("#nomCorEdit").val(data.nombre_c_cor);
			$("#corCorEdit").val(data.correo_cor);
			$("#telCorEdit").val(data.telefono_cor);
		});
}

function validEmailCorEdit() {
	let emailCont = document.getElementById('corCorEdit');
	let textcorr = document.getElementById('textcorredit');
	let emailValid = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
	if (emailValid.test(emailCont.value)) {
		$(textcorr).text("Correcto!").show().fadeOut(2000);
		$(textcorr).addClass("valid-feedback");
		$(textcorr).removeClass("invalid-feedback");
		$(emailCont).addClass("is-valid");
		setTimeout(function() {
			$(emailCont).removeClass("is-valid");
		}, 2000);
		$(emailCont).removeClass("is-invalid");
		$("#btnEditCor").prop("disabled",false);
		//$("#btnAdmEdit").addClass("bg-success");
	} else {
		$(textcorr).text("Correo Invalido").show();
		$(textcorr).addClass("invalid-feedback");
		$(emailCont).addClass("is-invalid");
		$("#btnEditCor").prop("disabled",true);
	}
	if (emailCont.value.length == 0) {
		$(textcorr).text("");
		$(textcorr).removeClass("invalid-feedback");
		$(emailCont).removeClass("is-invalid");
		$("#btnEditCor").prop("disabled",false);
	}
}

function editCor(e) {
	e.preventDefault();
	let formEditCor = document.getElementById('formEditCor'),
	formDat = new FormData($(formEditCor)[0]),
	nomCorEdit = $("#nomCorEdit").val(), corCorEdit = $("#corCorEdit").val(),
	telCorEdit = $("#telCorEdit").val(), pasConfAdm = $("#pasConfAdm").val();
	if (nomCorEdit.length > 0) {
		if (corCorEdit.length > 0) {
			if (telCorEdit.length > 0) { 
				if (pasConfAdm.length > 0) {
					$.ajax({
						url : "../ajax/adm/functionsAdm.php?oper=editCor",
						type : "POST", data : formDat,
						contentType : false, processData : false,
						success : function( resp ) {
							if ( resp == 1) {
								swal({
									title : "Correcto!...",
									text : "Datos actualizados",
									icon : "success",
									button : "Aceptar",
									closeOnClickOutside : false
								}).then( ( acepta ) => {
									$("#editCor").modal("hide");
									$("#pasConfAdm").val();
									tablaCorInc.ajax.reload();
									tablaCorAct.ajax.reload();
								});
							} else if ( resp == 0 ) {
								swal({
									title : "Ocurrio un problema",
									text : "Datos no actualizados",
									icon : "error",
									button : "Aceptar",
									closeOnClickOutside : false
								}).then( ( acepta ) => {
									$("#editCor").modal("hide");
									$("#pasConfAdm").val();
								});
							} else if ( resp == 11) {
								swal({
									text : "Ya existe un nombre registrado al que intenta registrar",
									icon : "warning",
									button : "Aceptar",
									closeOnClickOutside : false
								}).then( ( acepta ) => {
									$("#nomCorEdit").focus();
								});
							} else if ( resp == 2 ) {
								swal({
									text : "Ya existe un telefono registrado al que intenta registrar",
									icon : "warning",
									button : "Aceptar",
									closeOnClickOutside : false
								}).then( ( acepta ) => {
									$("#telCorEdit").focus();
								});
							} else if ( resp == 3 ) {
								swal({
									text : "Ya existe un correo registrado al que intenta registrar",
									icon : "warning",
									button : "Aceptar",
									closeOnClickOutside : false
								}).then( ( acepta ) => {
									$("#corCorEdit").focus();
								});
							} else if ( resp == 4 ) {
								swal({
									text : "La contraseña es incorrecta",
									icon : "warning",
									button : "Aceptar",
									closeOnClickOutside : false
								}).then( ( acepta ) => {
									$("#pasConfAdm").val("");
									setTimeout(function(){
										$("#pasConfAdm").focus();
									}, 1000);
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
						closeOnClickOutside : false,
						button : "Aceptar"
					}).then( ( acepta ) => {
						$("#pasConfAdm").focus();
					});
				}
			} else {
				swal({
					text : "Introduce un numero telefonico",
					icon : "warning",
					closeOnClickOutside : false,
					button : "Aceptar"
				}).then( ( acepta ) => {
					$("#telCorEdit").focus();
				});
			}
		} else {
			swal({
				text : "Introduce un correo",
				icon : "warning",
				closeOnClickOutside : false,
				button : "Aceptar"
			}).then( ( acepta ) => {
				$("#corCorEdit").focus();
			});
		}
	} else {
		swal({
			text : "Introduce un nombre",
			icon : "warning",
			closeOnClickOutside : false,
			button : "Aceptar"
		}).then( ( acepta ) => {
			$("#nomCorEdit").focus();
		});
	}
}

function newPassCor(id_coordinador) {
	$("#idCorNewCont").val(id_coordinador);
}

function segContNewPasCor() {
	let mayus = new RegExp("^(?=.*[A-Z])");
	let lower = new RegExp("^(?=.*[a-z])");
	let len = new RegExp("^(?=.{8,})");
	let numbers = new RegExp("^(?=.*[0-9])");
	let newCont = $("#newContCor").val();
	if (mayus.test(newCont) && lower.test(newCont) && numbers.test(newCont) && len.test(newCont)) {
		$("#validPasNewCor1").text("Seguridad Alta").css("color","green");
		$("#validPasNewCor1").show(1000);
	} else if (mayus.test(newCont) && numbers.test(newCont) && len.test(newCont) 
		|| lower.test(newCont) && numbers.test(newCont) && len.test(newCont)) {
		$("#validPasNewCor1").text("Seguridad Media").css("color","orange");
		$("#validPasNewCor1").show(1000);
	} else if (mayus.test(newCont) && len.test(newCont) 
		|| lower.test(newCont) && len.test(newCont) 
		|| numbers.test(newCont) && len.test(newCont)
		|| numbers.test(newCont)
		|| mayus.test(newCont)
		|| lower.test(newCont)) {
		$("#validPasNewCor1").text("Seguridad Baja").css("color","red");
		$("#validPasNewCor1").show(1000);
	} else {
		$("#validPasNewCor1").text("");
		$("#validPasNewCor1").hide(1000);
	}
}

function contIgulNewPasCor() {
	let newCont = $("#newContCor").val();
	let repCont = $("#repContNewCor").val();
	if (repCont.length > 0) {
		if (repCont === newCont) {
			$("#validPasNewCor2").text("Las contraseñas coinciden").css({"color":"green"}).show();
			$("#btnGNewPasCor").prop("disabled",false);
		} else {
			$("#validPasNewCor2").text("Las contraseñas no coinciden").css({"color":"red"}).show();
			$("#btnGNewPasCor").prop("disabled",true);
		}
	} else {
		$("#validPasNewCor2").text("").hide();
	}
}

function limpCamposNewContCor() {
	$("#newContCor").val("");
	$("#repContNewCor").val("");
	$("#confNewPasCor").val("");
	$("#validPasNewCor1").hide();
	$("#validPasNewCor2").hide();
}

function editNewPasCor(e) {
	e.preventDefault();
	let formNewPasDir = document.getElementById('formNewPasCor');
	let formDat = new FormData($(formNewPasDir)[0]), newContCor = $("#newContCor").val(), 
	repContNewCor = $("#repContNewCor").val(), confNewPasCor = $("#confNewPasCor").val();
	if (newContCor.length > 0) {
		if (repContNewCor.length > 0) {
			if (confNewPasCor.length > 0) {
				$.ajax({
					url : "../ajax/adm/functionsAdm.php?oper=editNewPasCor",
					type : "POST", data : formDat, 
					contentType : false, processData : false,
					success : function(resp) {
						if (resp == 1) {
							swal({
								title : "Correcto!...",
								text : "Contraseña actualizada exitosamente",
								icon : "success", 
								button : "Aceptar", 
								closeOnClickOutside : false
							}).then( ( acepta ) => {
								limpCamposNewContCor();
								$("#editNewPasCor").modal("hide");
							});
						} else if (resp == 0) {
							swal({
								title : "Ocurrio un problema",
								text : "No se puede actualizar la contraseña",
								icon : "error",
								button : "Aceptar",
								closeOnClickOutside : false
							}).then( ( acepta ) => {
								limpCamposNewContCor();
							});
						} else if (resp == 2) {
							swal({
								text : "Contraseña para confirmación incorrecta",
								icon : "warning",
								button : "Aceptar",
								closeOnClickOutside : false
							}).then( ( acepta ) => {
								$("#confNewPasCor").val("");
								setTimeout(function(){
									$("#confNewPasCor").focus();
								},1000);
							});
						} else {
							console.log(resp);
						}
					}
				});
			} else {
				swal({
					text : "Introduce tu contraseña para confirmar",
					icon : "warning",
					button : "Aceptar",
					closeOnClickOutside : false
				}).then( ( acepta ) => {
					$("#confNewPasCor").focus();
				});
			}
		} else {
			swal({
				text : "Repite la nueva contraseña",
				icon : "warning",
				button : "Aceptar",
				closeOnClickOutside : false
			}).then( ( acepta ) => {
				$("#repContNewCor").focus();
			});
		}
	} else {
		swal({
			text : "Introduce una contraseña",
			icon : "warning",
			button : "Aceptar",
			closeOnClickOutside : false
		}).then( ( acepta ) => {
			$("#newContCor").focus();
		});
	}
}

function desactivarCor(id_coordinador) {
	swal({
		title: "Esta seguro?",
		text: "De desactivar al coordinador?",
		icon: "warning",
		dangerMode : true,
		buttons: true
	}).then((acepta)=>{
		if (acepta) {
			$.post("../ajax/adm/functionsAdm.php?oper=desactivarCor",
				{id_coordinador : id_coordinador},
				function( resp ){
					if ( resp == 1) {
						swal({
							title : "Correcto",
							text : "Coordinador Desactivado",
							icon : "success",
							button : "Aceptar",
							closeOnClickOutside : false
						}).then( ( acepta ) => {
							tablaCorAct.ajax.reload();
							tablaCorInc.ajax.reload();
						});
					} else if ( resp == 0 ) {
						swal({
							title : "Ocurrio un problema",
							text : "No se completo la desactivación",
							icon : "error",
							button : "Aceptar",
							closeOnClickOutside : false
						}).then( ( acepta ) => {
							location.reload();
						});
					} else {
						console.log(resp);
					}
				});
		} else {
			swal("Sin proceso");
		}
	});
}

function activarCor(id_coordinador) {
	swal({
		title: "Esta seguro?",
		text: "De activar la cuenta del coordinador?",
		icon: "warning",
		dangerMode : true,
		buttons: true
	}).then((acepta)=>{
		if (acepta) {
			$.post("../ajax/adm/functionsAdm.php?oper=activarCor",
				{id_coordinador : id_coordinador},
				function( resp ){
					if ( resp == 1) {
						swal({
							title : "Correcto",
							text : "Cuenta del Coordinador Activada",
							icon : "success",
							button : "Aceptar",
							closeOnClickOutside : false
						}).then( ( acepta ) => {
							tablaCorAct.ajax.reload();
							tablaCorInc.ajax.reload();
						});
					} else if ( resp == 0 ) {
						swal({
							title : "Ocurrio un problema",
							text : "No se completo la activación de la cuenta",
							icon : "error",
							button : "Aceptar",
							closeOnClickOutside : false
						}).then( ( acepta ) => {
							location.reload();
						});
					} else {
						console.log(resp);
					}
				});
		} else {
			swal("Sin proceso");
		}
	});
}

function corAct () {
	$.ajax({
		url:'../ajax/adm/functionsAdm.php?oper=corAct',
		type : "POST",
		success:function (data) {
			if (data > 1 || data == 0) {
				$('#corAct').html(data + " Registros");	
			} else {
				$('#corAct').html(data + " Registro");	
			}
		}
	});
}

function corInc () {
	$.ajax({
		url:'../ajax/adm/functionsAdm.php?oper=corInc',
		type : "POST",
		success:function (data) {
			if (data > 1 || data == 0) {
				$('#corInc').html(data + " Registros");	
			} else {
				$('#corInc').html(data + " Registro");	
			}
		}
	});
}

init();