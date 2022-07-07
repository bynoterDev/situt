let tabla;
let tablades;
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
	$("#formRegTutor").on("submit",function(e){
		regTut(e);
	});
	listarTutores();
	listarTutoresDes();
	mostTutAct(true);
	setInterval(function(){
		docAct(); docInc();
	}, 1000);
}

function segCont() {
	let mayus = new RegExp("^(?=.*[A-Z])");
	let lower = new RegExp("^(?=.*[a-z])");
	let len = new RegExp("^(?=.{8,})");
	let numbers = new RegExp("^(?=.*[0-9])");
	let newCont = $("#passTut").val();
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
	let passTut = $("#passTut").val();
	let repPassTut = $("#repPassTut").val();
	if (repPassTut.length > 0) {
		if (repPassTut === passTut) {
			$("#mensaje2").text("Las contraseñas coinciden").css({"color":"green"}).show();
			$("#btnRegTut").prop("disabled",false);
		} else {
			$("#mensaje2").text("Las contraseñas no coinciden").css({"color":"red"}).show();
			$("#btnRegTut").prop("disabled",true);
		}
	} else {
		$("#mensaje2").text("").hide();
	}
}

function validEmail() {
	let corAdm = document.getElementById('corTut');
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
		$("#btnRegTut").prop("disabled",false);
	} else {
		$(textcorr).text("Correo Invalido").show();
		$(textcorr).addClass("invalid-feedback");
		$(corAdm).addClass("is-invalid");
		$("#btnRegTut").prop("disabled",true);
	}
	if (corAdm.value.length == 0) {
		$(textcorr).text("");
		$(textcorr).removeClass("invalid-feedback");
		$(corAdm).removeClass("is-invalid");
		$("#btnRegTut").prop("disabled",false);
	}
}

function limpCamp() {
	$("#nomTut").val("");
	$("#corTut").val("");
	$("#dirTut").val("");
	$("#passTut").val("");
	$("#repPassTut").val("");
	$("#edaTut").val("");
	$("#espTut").val("");
	$("#telTut").val("");
	$("#estTut").val("No");
}

function regTut(e) {
	e.preventDefault();
	let formRegTutor = document.getElementById('formRegTutor');
	let formDat = new FormData($(formRegTutor)[0]);
	let nomTut = $("#nomTut").val(), corTut = $("#corTut").val(), dirTut = $("#dirTut").val(), 
	passTut = $("#passTut").val(), repPassTut = $("#repPassTut").val(), edaTut = $("#edaTut").val(),
	espTut = $("#espTut").val(), telTut = $("#telTut").val();
	let estTut = document.getElementById('estTut');
	if (nomTut.length > 0) {
		if (corTut.length > 0) {
			if (dirTut.length > 0) {
				if (passTut.length > 0) {
					if (repPassTut.length > 0) {
						if (edaTut.length > 0) {
							if (espTut.length > 0) {
								if (telTut.length > 0) {
									if (estTut.value != "No") {
										$.ajax({
											url : "../ajax/dir/tutoresDat.php?oper=regTut",
											type : "POST",
											data : formDat,
											contentType : false,
											processData : false,
											success : function(resp) {
												if (resp === "goodIns") {
													swal({
														title : "Correcto!...",
														text : "Los datos han sido registrados",
														icon : "success",
														button : false
													});
													setTimeout(function() {
														location.reload();
													}, 1500);
												} else if (resp === "failIns") {
													swal({
														title : "Ocurrio un problema",
														text : "Los datos no han sido registrados",
														icon : "error",
														button : "Aceptar"
													});
													limpCampos();
												} else if (resp === "extCor") {
													swal({
														text : "El correo ingresado ya esta registrado",
														icon : "warning",
														button : "Aceptar"
													});
													$("#corTut").val("");
												} else if (resp === "extTut") {
													swal({
														text : "El nombre asignado al tutor ya existe",
														icon : "warning",
														button : "Aceptar"
													});
													$("#nomTut").val("");
												}
											}
										});
									} else {
										swal({
											text : "Selecciona un estado para el tutor",
											icon : "warning",
											timer : 2000,
											closeOnClickOutside : false,
											buttons : false
										});
										$("#estTut").focus();
									}
								} else {
									swal({
										text : "Introduce un numero telefonico",
										icon : "warning",
										timer : 2000,
										closeOnClickOutside : false,
										buttons : false
									});
									$("#telTut").focus();
								}
							} else {
								swal({
									text : "Introduce una especialidad",
									icon : "warning",
									timer : 2000,
									closeOnClickOutside : false,
									buttons : false
								});
								$("#espTut").focus();
							}
						} else {
							swal({
								text : "Introduce una edad",
								icon : "warning",
								timer : 2000,
								closeOnClickOutside : false,
								buttons : false
							});
							$("#nomDirEdit").focus();
						}
					} else {
						swal({
							text : "Repite tu contraseña",
							icon : "warning",
							timer : 2000,
							closeOnClickOutside : false,
							buttons : false
						});
						$("#repPassTut").focus();
					}
				} else {
					swal({
						text : "Introduce una contraseña",
						icon : "warning",
						timer : 2000,
						closeOnClickOutside : false,
						buttons : false
					});
					$("#passTut").focus();
				}
			} else {
				swal({
					text : "Introduce una dirección",
					icon : "warning",
					timer : 2000,
					closeOnClickOutside : false,
					buttons : false
				});
				$("#dirTut").focus();
			}
		} else {
			swal({
				text : "Introduce un correo",
				icon : "warning",
				timer : 2000,
				closeOnClickOutside : false,
				buttons : false
			});
			$("#corTut").focus();
		}
	} else {
		swal({
			text : "Introduce un nombre",
			icon : "warning",
			timer : 2000,
			closeOnClickOutside : false,
			buttons : false
		});
		$("#nomTut").focus();
	}

}

function listarTutores(){
	tabla = $("#tbListadoTutores").dataTable({
		"aProcessing" : true,
		"aServerSide" : true,
		dom : 'Bftrip',
		buttons: [
		],
		"ajax" : {
			url : "../ajax/dir/tutoresDat.php?oper=listarTutores",
			type : "GET",
			dataType : "json",
			error : function(e) {
				console.log(e.responseText);
			}
		},
		"bDestroy" : true,
		"iDisplayLength" : 5
		// "order" : [[0, "desc"]]
	}).DataTable();
}

function listarTutoresDes(){
	tablades = $("#tbListadoTutoresInac").dataTable({
		"aProcessing" : true,
		"aServerSide" : true,
		dom : 'Bftrip',
		buttons: [
		],
		"ajax" : {
			url : "../ajax/dir/tutoresDat.php?oper=listarTutoresDes",
			type : "GET",
			dataType : "json",
			error : function(e) {
				console.log(e.responseText);
			}
		},
		"bDestroy" : true,
		"iDisplayLength" : 5
		// "order" : [[0, "desc"]]
	}).DataTable();
}

function mostTutAct(flag) {
	if (flag) {
		$("#tbListadoTutoresAct").slideDown("2000");
		$("#listTutAct").addClass("active");
	} else {
		$("#tbListadoTutoresAct").slideUp();
		$("#listTutAct").removeClass("active");
	}
}

function mostTutDes(flag) {
	if (flag) {
		$("#tbListadoTutoresDes").slideDown("2000");
		$("#listTutDes").addClass("active");
	} else {
		$("#tbListadoTutoresDes").slideUp();
		$("#listTutDes").removeClass("active");
	}
}

function activarTut(id_docente) {
	swal({
		title: "Esta seguro?",
		text: "De activar al tutor?",
		icon: "warning",
		dangerMode : true,
		buttons: true
	}).then((acepta)=>{
		if (acepta) {
			$.post("../ajax/dir/tutoresDat.php?oper=activarTut",
				{id_docente : id_docente},
				function( resp ){
					if ( resp == 1) {
						swal({
							title : "Correcto",
							text : "Tutor Activado",
							icon : "success",
							button : "Aceptar",
							closeOnClickOutside : false
						}).then( ( acepta ) => {
							tabla.ajax.reload();
							tablades.ajax.reload();
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

function desactivarTut(id_docente) {
	swal({
		title: "Esta seguro?",
		text: "De desactivar al tutor?",
		icon: "warning",
		dangerMode : true,
		buttons: true
	}).then((acepta)=>{
		if (acepta) {
			$.post("../ajax/dir/tutoresDat.php?oper=desactivarTut",
				{id_docente : id_docente},
				function( resp ){
					if ( resp == 1) {
						swal({
							title : "Correcto",
							text : "Tutor Desactivado",
							icon : "success",
							button : "Aceptar",
							closeOnClickOutside : false
						}).then( ( acepta ) => {
							tabla.ajax.reload();
							tablades.ajax.reload();
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

function docAct () {
	$.ajax({
		url:'../ajax/dir/tutoresDat.php?oper=docAct',
		type : "POST",
		success:function (data) {
			if (data > 1 || data == 0) {
				$('#docAct').html(data + " Registros");	
			} else {
				$('#docAct').html(data + " Registro");	
			}
		}
	});
}

function docInc () {
	$.ajax({
		url:'../ajax/dir/tutoresDat.php?oper=docInc',
		type : "POST",
		success:function (data) {
			if (data > 1 || data == 0) {
				$('#docInc').html(data + " Registros");	
			} else {
				$('#docInc').html(data + " Registro");	
			}
		}
	});
}

init();