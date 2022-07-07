let tabla;
let tabladesc;

let actRegAct, actRegDes;

const lenguaje = {
    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar:",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
    },
    "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }
};

function init() {
	$("#contDir, #repContDir").on("keyup", function(){
		contIgul();
	});
	$("#contDir").on("keyup",function(){
		segCont();
	});
	$("#formGDirector").on("submit",function(e){
		guardarDirect(e);
	});
	$("#formEditDirec").on("submit",function(e){
		editDir(e);
	});
	$("#formNewPasDir").on("submit", function(e) {
		editNewPasDir(e);
	});
	$("#newContDir").on("keyup", function() {
		segContNewPasDir();
	});
	$("#newContDir, #repContNewDir").on("keyup", function() {
		contIgulNewPasDir();
	});
	listarDirectores();
	listarDirectoresDesc();

	dirAct();
	dirInc();

	$("#btnClosePasNewDir, #btnCloseIcoPasDir").on("click", function() {
		limpCamposNewContDir();
	});
}

function limpCamposNewContDir() {
	$("#newContDir").val("");
	$("#repContNewDir").val("");
	$("#confNewPasDir").val("");
	$("#validPasNewDir1").hide();
	$("#validPasNewDir2").hide();
}

function validEmail() {
	let emailCont = document.getElementById('corDir');
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
		$("#btnGDirector").prop("disabled",false);
	} else {
		$(textcorr).text("Correo Invalido").show();
		$(textcorr).addClass("invalid-feedback");
		$(emailCont).addClass("is-invalid");
		$("#btnGDirector").prop("disabled",true);
	}
	if (emailCont.value.length == 0) {
		$(textcorr).text("");
		$(textcorr).removeClass("invalid-feedback");
		$(emailCont).removeClass("is-invalid");
		$("#btnGDirector").prop("disabled",false);
	}
}

function segCont() {
	let mayus = new RegExp("^(?=.*[A-Z])");
	let lower = new RegExp("^(?=.*[a-z])");
	let len = new RegExp("^(?=.{8,})");
	let numbers = new RegExp("^(?=.*[0-9])");
	let newCont = $("#contDir").val();
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
	let newCont = $("#contDir").val();
	let repCont = $("#repContDir").val();
	if (repCont.length > 0) {
		if (repCont === newCont) {
			$("#mensaje2").text("Las contraseñas coinciden").css({"color":"green"}).show();
			$("#btnGDirector").prop("disabled",false);
		} else {
			$("#mensaje2").text("Las contraseñas no coinciden").css({"color":"red"}).show();
			$("#btnGDirector").prop("disabled",true);
		}
	} else {
		$("#mensaje2").text("").hide();
	}
}

function segContNewPasDir() {
	let mayus = new RegExp("^(?=.*[A-Z])");
	let lower = new RegExp("^(?=.*[a-z])");
	let len = new RegExp("^(?=.{8,})");
	let numbers = new RegExp("^(?=.*[0-9])");
	let newCont = $("#newContDir").val();
	if (mayus.test(newCont) && lower.test(newCont) && numbers.test(newCont) && len.test(newCont)) {
		$("#validPasNewDir1").text("Seguridad Alta").css("color","green");
		$("#validPasNewDir1").show(1000);
	} else if (mayus.test(newCont) && numbers.test(newCont) && len.test(newCont) 
		|| lower.test(newCont) && numbers.test(newCont) && len.test(newCont)) {
		$("#validPasNewDir1").text("Seguridad Media").css("color","orange");
		$("#validPasNewDir1").show(1000);
	} else if (mayus.test(newCont) && len.test(newCont) 
		|| lower.test(newCont) && len.test(newCont) 
		|| numbers.test(newCont) && len.test(newCont)
		|| numbers.test(newCont)
		|| mayus.test(newCont)
		|| lower.test(newCont)) {
		$("#validPasNewDir1").text("Seguridad Baja").css("color","red");
		$("#validPasNewDir1").show(1000);
	} else {
		$("#validPasNewDir1").text("");
		$("#validPasNewDir1").hide(1000);
	}
}

function contIgulNewPasDir() {
	let newCont = $("#newContDir").val();
	let repCont = $("#repContNewDir").val();
	if (repCont.length > 0) {
		if (repCont === newCont) {
			$("#validPasNewDir2").text("Las contraseñas coinciden").css({"color":"green"}).show();
			$("#btnGNewPasDir").prop("disabled",false);
		} else {
			$("#validPasNewDir2").text("Las contraseñas no coinciden").css({"color":"red"}).show();
			$("#btnGNewPasDir").prop("disabled",true);
		}
	} else {
		$("#validPasNewDir2").text("").hide();
	}
}

function limpCampos(){
	$("#nomDir").val("");
	$("#corDir").val("");
	$("#contDir").val("");
	$("#repContDir").val("");
	$("#telDir").val("");
	$("#carDir").val("0");
	$("#estDir").val("No");
	$("#mensaje").text("");
	$("#mensaje2").text("");
}

function guardarDirect(e){
	e.preventDefault();
	let formGDirector = document.getElementById('formGDirector');
	let formDat = new FormData($(formGDirector)[0]);
	let nomDir = $("#nomDir").val(), corDir = $("#corDir").val(), contDir = $("#contDir").val(),
	repContDir = $("#repContDir").val(),telDir = $("#telDir").val();
	let carDir = document.getElementById('carDir');
	let estDir = document.getElementById('estDir');
	if (nomDir.length > 0) {
		if (corDir.length > 0) {
			if (contDir.length > 0) {
				if (repContDir.length > 0) {
					if (telDir.length > 0) {
						if (carDir.value != "0") {
							if (estDir.value != "No") {
								$.ajax({
									url : "../../ajax/adm/functionsAdm.php?oper=guardarDirect",
									type : "POST",
									data : formDat,
									contentType : false,
									processData : false,
									success : function(resp) {
										if (resp == 1) {
											swal({
												title : "Correcto!...",
												text : "Los datos han sido registrados",
												icon : "success",
												button : "Aceptar",
												closeOnClickOutside : false
											}).then( ( acepta ) => {
												tabla.ajax.reload();
												tabladesc.ajax.reload();
												limpCampos();
											});
										} else if (resp == 0) {
											swal({
												title : "Ocurrio un problema",
												text : "Los datos no han sido registrados",
												icon : "error",
												button : "Aceptar",
												closeOnClickOutside : false
											}).then( ( acepta ) => {
												limpCampos();
											});
										} else if (resp == 11) {
											swal({
												text : "La carrera ya se encuentra asignada a un director",
												icon : "warning",
												button : "Aceptar",
												closeOnClickOutside : false
											}).then( ( acepta ) => {
												$("#carDir").val("0");
												$("#carDir").focus();
											});
										} else if (resp == 00) {
											swal({
												text : "El correo ya se encuentra registrado",
												icon : "warning",
												button : "Aceptar",
												closeOnClickOutside : false
											}).then( ( acepta ) => {
												$("#corDir").val("");
												$("#corDir").focus();
											});
										} else {
											console.log( resp );
										}
									}
								});
							} else {
								swal({
									text : "Selecciona un estado",
									icon : "warning",
									closeOnClickOutside : false,
									button : "Aceptar"
								}).then( ( acepta ) => {
									$("#estDir").focus();
								});
							}
						} else {	
							swal({
								text : "Selecciona una carrera",
								icon : "warning",
								timer : 2000,
								closeOnClickOutside : false,
								buttons: false
							}).then( ( acepta ) =>{
								$("#carDir").focus();
							});
						}
					} else {
						swal({
							text : "Introduce un telefono",
							icon : "warning",
							closeOnClickOutside : false,
							button : "Aceptar"
						}).then( ( acepta ) => {
							$("#telDir").focus();
						});
					}
				} else {
					swal({
						text : "Repite tu contraseña",
						icon : "warning",
						timer : 2000,
						closeOnClickOutside : false,
						buttons: false
					}).then( ( acepta ) => {
						$("#repContDir").focus();
					});
				}
			} else {
				swal({
					text : "Introduce una contraseña",
					icon : "warning",
					closeOnClickOutside : false,
					button : "Aceptar"
				}).then( ( acepta ) => {
					$("#contDir").focus();
				});
			}
		} else {
			swal({
				text : "Introduce un correo",
				icon : "warning",
				closeOnClickOutside : false,
				button : "Aceptar"
			}).then( ( acepta ) => {
				$("#corDir").focus();
			});
		}
	} else {
		swal({
			text : "Introduce un nombre",
			icon : "warning",
			closeOnClickOutside : false,
			button : "Aceptar"
		}).then( ( acepta ) => {
			$("#nomDir").focus();
		});
	}
}

function listarDirectores(){
	tabla = $("#tbListadoDirector").dataTable({
		"aProcessing" : true,
		"aServerSide" : true,
		dom : 'Bftrip',
		buttons: [
		],
		"ajax" : {
			url : "../../ajax/adm/functionsAdm.php?oper=listarDirectores",
			type : "GET",
			dataType : "json",
			error : function(e) {
				console.log(e.responseText);
			}
		},
		"bDestroy" : true,
		"iDisplayLength" : 5,
		"order" : [[0, "desc"]],
		"language" : lenguaje
	}).DataTable();
}

function listarDirectoresDesc() {
	tabladesc = $("#tbListadoDirectorDesc").dataTable({
		"aProcessing" : true,
		"aServerSide" : true,
		dom : 'Bftrip',
		buttons: [
		],
		"ajax" : {
			url : "../../ajax/adm/functionsAdm.php?oper=listarDirectoresDesc",
			type : "GET",
			dataType : "json",
			error : function(e) {
				console.log(e.responseText);
			}
		},
		"bDestroy" : true,
		"iDisplayLength" : 5,
		"order" : [[0, "desc"]],
		"language" : lenguaje
	}).DataTable();
}	

function desactivarDirector(id_director){
	swal({
		title: "Esta seguro?",
		text: "De desactivar al director",
		icon: "warning",
		dangerMode : true,
		buttons: true
	}).then((acepta) =>{
		if (acepta) {
			$.post("../../ajax/adm/functionsAdm.php?oper=desactivarDirector",
				{id_director : id_director},
				function( resp ){
					if ( resp == 1) {
						swal({
							title : "Correcto",
							text : "Director Desactivado",
							icon : "success",
							button : "Aceptar",
							closeOnClickOutside : false
						}).then( ( acepta ) => {
							tabla.ajax.reload();
							tabladesc.ajax.reload();
							dirAct();
							dirInc();
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
			swal("Bien");
		}
	});
}

function activarDirector(id_director) {
	swal({
		title : "Esta seguro?",
		text : "De activar al director?",
		icon : "warning",
		dangerMode : false,
		buttons : true
	}).then((acepta)=>{
		if (acepta) {
			$.post("../../ajax/adm/functionsAdm.php?oper=activarDirector",
				{id_director : id_director},
				function( resp ){
					if ( resp == 1) {
						swal({
							title : "Correcto",
							text : "Director Activado",
							icon : "success",
							button : "Aceptar",
							closeOnClickOutside : false
						}).then( ( acepta ) => {
							tabla.ajax.reload();
							tabladesc.ajax.reload();
							dirAct();
							dirInc();
						});
					} else if ( resp == 0 ) {
						swal({
							title : "Ocurrio un problema",
							text : "No se completo la activación",
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
			swal("Bien");
		}
	});
}

function mostrarDirector(id_director) {
	$.post("../../ajax/adm/functionsAdm.php?oper=mostrarDirector",
		{id_director : id_director},
		function(data, status){
			data = JSON.parse(data);
			$("#id_director").val(data.id_director);
			$("#nomDirEdit").val(data.nombre_c_dir);
			$("#corDirEdit").val(data.correo_dir);
			$("#telDirEdit").val(data.telefono_dir);
			//$("#carDirEdit").val(data.id_carrera);
			$("#carrAct").val(data.nombre_car);
			$("#idcarrera").val(data.id_carrera);
			$("#fechReg").val(data.fecha_reg_dir);
		});
}

function editDir(e){
	e.preventDefault();
	let formEditDirec = document.getElementById('formEditDirec');
	let formDat = new FormData($(formEditDirec)[0]);
	let corDirEdit = $("#corDirEdit").val(), nomDirEdit = $("#nomDirEdit").val(), 
	telDirEdit =$("#telDirEdit").val(), contAdmAct = $("#contAdmAct").val();
	if (nomDirEdit.length > 0) {
		if (corDirEdit.length > 0) {
			if (telDirEdit.length > 0) {
				if (contAdmAct.length > 0) {
					$.ajax({
						url : "../../ajax/adm/functionsAdm.php?oper=editDir",
						type : "POST",
						data : formDat,
						contentType : false,
						processData : false,
						success : function(resp) {
							if (resp == 1) {
								swal({
									title : "Correcto!...",
									text : "Datos actualizados",
									icon : "success",
									button : "Aceptar",
									closeOnClickOutside : false
								}).then( ( acepta ) => {
									$("#editDirec").modal("hide");
									tabla.ajax.reload();
									tabladesc.ajax.reload();
									$("#contAdmAct").val("");
								});
							} else if (resp == 11) {
								swal({
									title : "Ocurrio un problema",
									text : "Datos no actualizados",
									icon : "warning",
									button : "Aceptar",
									closeOnClickOutside : false
								}).then( ( acepta ) => {
									$("#contAdmAct").val();
								});
							} else if (resp == 3) {
								swal({
									title : "Correcto!...",
									text : "Datos actualizados",
									icon : "success",
									button : "Aceptar",
									closeOnClickOutside : false
								}).then( ( acepta ) => {
									$("#editDirec").modal("hide");
									tabla.ajax.reload();
									$("#contAdmAct").val("");
									$("#carDirEdit").val("0");
								});
							} else if (resp == 33) {
								swal({
									title : "Ocurrio un problema",
									text : "Datos no actualizados",
									icon : "warning",
									buttons : "Aceptar",
									closeOnClickOutside : false
								}).then( ( acepta ) => {
									$("#contAdmAct").val("");
									$("#editDirec").modal("hide");
								});
							} else if (resp == 2) {
								swal({
									title : "Ocurrio un problema",
									text : "Existe un director activo para la carrera seleccionada",
									icon : "warning",
									button : "Aceptar",
									closeOnClickOutside : false
								}).then( ( acepta ) => {
									$("#contAdmAct").val("");
								});
							} else if (resp == 4) {
								swal({
									text : "Contraseña incorrecta",
									icon : "warning",
									button : "Aceptar",
									closeOnClickOutside : false
								}).then( ( acepta ) => {
									$("#contAdmAct").val("");
									$("#contAdmAct").focus();
								});
							} else if (resp == 5) {
								swal({
									text : "El correo ya se encuentra registrado",
									icon : "warning",
									button : "Aceptar",
									closeOnClickOutside : false
								}).then( ( acepta ) => {
									$("#corDirEdit").focus();
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
						timer : 2000,
						closeOnClickOutside : false,
						buttons : false
					});
					$("#contAdmAct").focus();
				}
			} else {
				swal({
					text : "Introduce un telefono",
					icon : "warning",
					timer : 2000,
					closeOnClickOutside : false,
					buttons : false
				});
				$("#telDirEdit").focus();
			}
		} else {
			swal({
				text : "Introduce un correo",
				icon : "warning",
				timer : 2000,
				closeOnClickOutside : false,
				buttons: false
			});
			$("#corDirEdit").focus();
		}
	} else {
		swal({
			text : "Introduce un nombre",
			icon : "warning",
			timer : 2000,
			closeOnClickOutside : false,
			buttons : false
		});
		$("#nomDirEdit").focus();
	}
}

function newPassDir(id_director) {
	$("#idDirNewCont").val(id_director);
}

function editNewPasDir(e) {
	e.preventDefault();
	let formNewPasDir = document.getElementById('formNewPasDir');
	let formDat = new FormData($(formNewPasDir)[0]), newContDir = $("#newContDir").val(), 
	repContNewDir = $("#repContNewDir").val(), confNewPasDir = $("#confNewPasDir").val();
	if (newContDir.length > 0) {
		if (repContNewDir.length > 0) {
			if (confNewPasDir.length > 0) {
				$.ajax({
					url : "../../ajax/adm/functionsAdm.php?oper=editNewPasDir",
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
								limpCamposNewContDir();
								$("#editNewPassDir").modal("hide");
							});
						} else if (resp == 0) {
							swal({
								title : "Ocurrio un problema",
								text : "No se puede actualizar la contraseña",
								icon : "error",
								button : "Aceptar",
								closeOnClickOutside : false
							}).then( ( acepta ) => {
								limpCamposNewContDir();
							});
						} else if (resp == 2) {
							swal({
								text : "Contraseña para confirmación incorrecta",
								icon : "warning",
								button : "Aceptar",
								closeOnClickOutside : false
							}).then( ( acepta ) => {
								$("#confNewPasDir").val("");
								setTimeout(function(){
									$("#confNewPasDir").focus();
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
					$("#confNewPasDir").focus();
				});
			}
		} else {
			swal({
				text : "Repite la nueva contraseña",
				icon : "warning",
				button : "Aceptar",
				closeOnClickOutside : false
			}).then( ( acepta ) => {
				$("#repContNewDir").focus();
			});
		}
	} else {
		swal({
			text : "Introduce una contraseña",
			icon : "warning",
			button : "Aceptar",
			closeOnClickOutside : false
		}).then( ( acepta ) => {
			$("#newContDir").focus();
		});
	}
}


function dirAct () {
	$.ajax({
		url:'../../ajax/adm/functionsAdm.php?oper=dirAct',
		type : "POST",
		success:function (data) {
			if (data > 1 || data == 0) {
				$('#dirAct').html(data + " Registros");	
			} else {
				$('#dirAct').html(data + " Registro");	
			}
		}
	});
}

function dirInc () {
	$.ajax({
		url:'../../ajax/adm/functionsAdm.php?oper=dirInc',
		type : "POST",
		success:function (data) {
			if (data > 1 || data == 0) {
				$('#dirInc').html(data + " registros.");	
			} else {
				$('#dirInc').html(data + " registro.");	
			}
		}
	});
}

/*function dirTot () {
	$.ajax({
		url:'../../ajax/adm/functionsAdm.php?oper=dirTot',
		type : "POST",
		success:function (data) {
			if (data > 1 || data == 0) {
				$('#dirTot').html(data + " Registros");	
			} else {
				$('#dirTot').html(data + " Registro");	
			}
		}
	});
}*/

init();