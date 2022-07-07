let tabla;
let tabladesc;
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
	$("#contAdm").on("keyup",function(){
		segCont();
	});
	$("#formGAdmin").on("submit",function(e){
		regAdm(e);
	});
	$("#formEditAdm").on("submit",function(e){
		editAdm(e);
	});
	listarAdmin();
	listarAdminDes();
	mostListAdmAct(true);
	setInterval(function(){
		admAct(); admInc();
	},1000);
}

function limpCampos() {
	$("#nomAdmin").val(""); 
 	$("#corAdmin").val(""); 
 	$("#contAdm").val("");
	$("#repContAdm").val(""); 
	$("#usAdm").val("");
	$("#estAdm").val("No");
	$("#privAdm").val("0");
	$("#textcorr").text("");
	$("#mensaje").text("");
	$("#mensaje2").text("");
}

function validEmail() {
	let emailCont = document.getElementById('corAdmin');
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
		$("#btnGAdmin").prop("disabled",false);
	} else {
		$(textcorr).text("Correo Invalido").show();
		$(textcorr).addClass("invalid-feedback");
		$(emailCont).addClass("is-invalid");
		$("#btnGAdmin").prop("disabled",true);
	}
	if (emailCont.value.length == 0) {
		$(textcorr).text("");
		$(textcorr).removeClass("invalid-feedback");
		$(emailCont).removeClass("is-invalid");
		$("#btnGAdmin").prop("disabled",false);
	}
}

function validEmailEdit() {
	let emailCont = document.getElementById('corAdmEdit');
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
		$("#btnAdmEdit").prop("disabled",false);
		//$("#btnAdmEdit").addClass("bg-success");
	} else {
		$(textcorr).text("Correo Invalido").show();
		$(textcorr).addClass("invalid-feedback");
		$(emailCont).addClass("is-invalid");
		$("#btnAdmEdit").prop("disabled",true);
	}
	if (emailCont.value.length == 0) {
		$(textcorr).text("");
		$(textcorr).removeClass("invalid-feedback");
		$(emailCont).removeClass("is-invalid");
		$("#btnAdmEdit").prop("disabled",false);
	}
}

function segCont() {
	let mayus = new RegExp("^(?=.*[A-Z])");
	let lower = new RegExp("^(?=.*[a-z])");
	let len = new RegExp("^(?=.{8,})");
	let numbers = new RegExp("^(?=.*[0-9])");
	let newCont = $("#contAdm").val();
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
	let newCont = $("#contAdm").val();
	let repCont = $("#repContAdm").val();
	if (repCont.length > 0) {
		if (repCont === newCont) {
			$("#mensaje2").text("Las contraseñas coinciden").css({"color":"green"}).show();
			$("#btnGAdmin").prop("disabled",false);
		} else {
			$("#mensaje2").text("Las contraseñas no coinciden").css({"color":"red"}).show();
			$("#btnGAdmin").prop("disabled",true);
		}
	} else {
		$("#mensaje2").text("").hide();
	}
}

function regAdm(e) {
	e.preventDefault();
	let formGAdmin = document.getElementById('formGAdmin');
	let formDat = new FormData($(formGAdmin)[0]);
	let nomAdmin = $("#nomAdmin").val(), corAdmin = $("#corAdmin").val(), contAdm = $("#contAdm").val(),
	repContAdm = $("#repContAdm").val(), usAdm = $("#usAdm").val();
	let estAdm = document.getElementById('estAdm');
	let privAdm = document.getElementById('privAdm');
	if (nomAdmin.length > 0) {
		if (corAdmin.length > 0) {
			if (contAdm.length > 0) {
				if (repContAdm.length > 0) {
					if (usAdm.length > 0) {
						if (estAdm.value != "No") {
							if (privAdm.value != "0") {
								$.ajax({
									url : "../ajax/adm/functionsAdm.php?oper=regAdm",
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
										} else if (resp == 2) {
											swal({
												text : "El usuario ingresado ya existe",
												icon : "warning",
												button : "Aceptar"
											});
											$("#usAdm").val("");
											$("#usAdm").focus();
										} else if (resp == 3) {
											swal({
												text : "El correo ingresado ya existe",
												icon : "warning",
												button : "Aceptar"
											});
											$("#corAdmin").val("");
											$("#corAdmin").focus();
										} else {
											console.log(resp);
										}
									}
								});
							} else {
								swal({
									text : "Introduce un correo",
									icon : "warning",
									timer : 2000,
									closeOnClickOutside : false,
									buttons : false
								});
								$("#privAdm").focus();
							}
						} else {
							swal({
								text : "Introduce un correo",
								icon : "warning",
								timer : 2000,
								closeOnClickOutside : false,
								buttons : false
							});
							$("#estAdm").focus();
						}
					} else {
						swal({
							text : "Introduce un nombre de usuario",
							icon : "warning",
							timer : 2000,
							closeOnClickOutside : false,
							buttons : false
						});
						$("#corAdmin").focus();
					}
				} else {
					swal({
						text : "Repite la contraseña",
						icon : "warning",
						timer : 2000,
						closeOnClickOutside : false,
						buttons : false
					});
					$("#repContAdm").focus();
				}
			} else {
				swal({
					text : "Introduce una contraseña",
					icon : "warning",
					timer : 2000,
					closeOnClickOutside : false,
					buttons : false
				});
				$("#contAdm").focus();
			}
		} else {
			swal({
				text : "Introduce un correo",
				icon : "warning",
				timer : 2000,
				closeOnClickOutside : false,
				buttons : false
			});
			$("#corAdmin").focus();
		}
	} else {
		swal({
			text : "Introduce un nombre",
			icon : "warning",
			timer : 2000,
			closeOnClickOutside : false,
			buttons : false
		});
		$("#nomAdmin").focus();
	}
}

function listarAdmin(){
	tabla = $("#tbListadoAdmin").dataTable({
		"aProcessing" : true,
		"aServerSide" : true,
		dom : 'Bftrip',
		buttons: [
		],
		"ajax" : {
			url : "../ajax/adm/functionsAdm.php?oper=listarAdmin",
			type : "GET",
			dataType : "json",
			error : function(e) {
				console.log(e.responseText);
			}
		},
		"bDestroy" : true,
		"iDisplayLength" : 5,
		//"order" : [[0, "asc"]]
	}).DataTable();
}

function listarAdminDes() {
	tabladesc = $("#tbListadoAdminDesc").dataTable({
		"aProcessing" : true,
		"aServerSide" : true,
		dom : 'Bftrip',
		buttons: [
		],
		"ajax" : {
			url : "../ajax/adm/functionsAdm.php?oper=listarAdminDes",
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

function desactivarAdm(id_admin){
	swal({
		title: "Esta seguro?",
		text: "De desactivar al administrador?",
		icon: "warning",
		dangerMode : true,
		buttons: true
	}).then((acepta) =>{
		if (acepta) {
			$.post("../ajax/adm/functionsAdm.php?oper=desactivarAdm",
				{id_admin : id_admin},
				function( resp ){
					if ( resp == 1) {
						swal({
							title : "Correcto",
							text : "Administrador Desactivado",
							icon : "success",
							button : "Aceptar",
							closeOnClickOutside : false
						}).then( ( acepta ) => {
							tabla.ajax.reload();
							tabladesc.ajax.reload();
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

function activarAdm(id_admin) {
	swal({
		title : "Esta seguro?",
		text : "De activar al administrador?",
		icon : "warning",
		dangerMode : false,
		buttons : true
	}).then((acepta)=>{
		if (acepta) {
			$.post("../ajax/adm/functionsAdm.php?oper=activarAdm",
				{id_admin : id_admin},
				function( resp ){
					if ( resp == 1) {
						swal({
							title : "Correcto",
							text : "Administrador Activado",
							icon : "success",
							button : "Aceptar",
							closeOnClickOutside : false
						}).then( ( acepta ) => {
							tabla.ajax.reload();
							tabladesc.ajax.reload();
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

function mostrarAdm(id_admin){
	$.post("../ajax/adm/functionsAdm.php?oper=mostrarAdm",
		{id_admin : id_admin},
		function(data, status){
			data = JSON.parse(data);
			$("#id_admin").val(data.id_admin);
			$("#nomAdmEdit").val(data.nombre_c);
			$("#corAdmEdit").val(data.correo);
			$("#usAdmEdit").val(data.usuario);
			$("#fechRegAdm").val(data.fecha_reg_adm);
			$("#privAct").val(data.privileg);
		});
}

function editAdm(e) {
	e.preventDefault();
	let formEditAdm = document.getElementById('formEditAdm');
	let formDat = new FormData($(formEditAdm)[0]);
	let nomAdmEdit = $("#nomAdmEdit").val(), corAdmEdit = $("#corAdmEdit").val(),
	usAdmEdit = $("#usAdmEdit").val(), contAdmAct = $("#contAdmAct").val();
	if (nomAdmEdit.length > 0) {
		if (corAdmEdit.length > 0) {
			if (usAdmEdit.length > 0) {
				if (contAdmAct.length > 0) {
					$.ajax({
						url : "../ajax/adm/functionsAdm.php?oper=editAdm",
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
									button : "Aceptar"
								});
								$("#editAdm").modal("hide");
								tabla.ajax.reload();
								tabladesc.ajax.reload();
								$("#contAdmAct").val("");
							} else if (resp == 0) {
								swal({
									title : "Ocurrio un problema",
									text : "Datos no actualizados",
									icon : "warning",
									button : "Aceptar"
								}).then( ( acepta ) => {
									$("#editAdm").modal("hide");
									$("#contAdmAct").val("");
								});
							} else if (resp == 3) {
								swal({
									text : "Contraseña incorrecta",
									icon : "warning",
									button : "Aceptar",
									closeOnClickOutside : false
								}).then( ( acepta ) => {
									$("#contAdmAct").val("");
									$("#contAdmAct").focus();
								});
							} else if (resp == 2) {
								swal({
									text : "El correo ya se encuentra registrado",
									icon : "warning",
									button : "Aceptar",
									closeOnClickOutside : false
								}).then( ( acepta ) => {
									$("#corAdmEdit").val("");
									$("#corAdmEdit").focus();
								});
							} else if (resp == 4) {
								swal({
									text : "El usuario ya se encuentra registrado",
									icon : "warning",
									button : "Aceptar",
									closeOnClickOutside : false
								}).then( ( acepta ) => {
									$("#usAdmEdit").val("");
									$("#usAdmEdit").focus();
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
					text : "Introduce un nombre",
					icon : "warning",
					timer : 2000,
					closeOnClickOutside : false,
					buttons : false
				});
				$("#usAdmEdit").focus();
			}
		} else {
			swal({
				text : "Introduce un correo",
				icon : "warning",
				timer : 2000,
				closeOnClickOutside : false,
				buttons : false
			});
			$("#corAdmEdit").focus();
		}
	} else {
		swal({
			text : "Introduce un nombre",
			icon : "warning",
			timer : 2000,
			closeOnClickOutside : false,
			buttons : false
		});
		$("#nomAdmEdit").focus();
	}

}

function mostListAdmAct(flag) {
	if (flag) {
		$("#tbListadoAdmAct").fadeIn("2000");
		$("#listAdmAct").addClass("active");
	} else {
		$("#tbListadoAdmAct").slideUp();
		$("#listAdmAct").removeClass("active");
	}
}

function mostListAdmDes(flag) {
	if (flag) {
		$("#tbListadoAdmDes").fadeIn("2000");
		$("#listAdmDes").addClass("active");
	} else {
		$("#tbListadoAdmDes").slideUp();
		$("#listAdmDes").removeClass("active")
	}
}

function admAct () {
	$.ajax({
		url:'../ajax/adm/functionsAdm.php?oper=admAct',
		type : "POST",
		success:function (data) {
			if (data > 1 || data == 0) {
				$('#admAct').html(data + " Registros");	
			} else {
				$('#admAct').html(data + " Registro");	
			}
		}
	});
}

function admInc () {
	$.ajax({
		url:'../ajax/adm/functionsAdm.php?oper=admInc',
		type : "POST",
		success:function (data) {
			if (data > 1 || data == 0) {
				$('#admInc').html(data + " Registros");	
			} else {
				$('#admInc').html(data + " Registro");	
			}
		}
	});
}

init();