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
	setTimeout(function(){
		$("#loader").removeClass("ocult");
		$("#loader").addClass("animated rotateIn");
		setTimeout(function(){
			$("#textLoad").text("Correcto!");
			setTimeout(function(){
				$("#loader").removeClass("animated rotateIn");
				$("#loader").addClass("animated bounceOutUp");
				setTimeout(function(){
					$("#loader").hide();
					setTimeout(function(){
						$("#contend").removeClass("ocult");
						$("#contend").addClass("animated rotateInDownRight");
					},300);
				}, 1000);
			},1500);
		},9000);
	}, 2000);
	mostDatPer(true);
	listaAlumnos();
	listarJustif();
	listarJustifAC();
	listadoHistorial();
	listadoHistorialSolic();
	$("#formGenJustif").on("submit", function(e) { 
		regJustif(e); 
	});
	$("#formHistAlm").on("submit", function(e) { 
		regHist(e); 
	});
	$("#btnCloseJustif").on("click",function() { 
		limpCampJustif(); 
	});
	$("#btnCloseHist").on("click", function(e) {
		limpCampHist();
	});
	$("#newContAlm").on("keyup", function(){
		segCont2(); contIgul2();
	});
	$("#repNewContAlm").on("keyup", function(){
		contIgul2();
	});
	$("#formNewContAlm").on("submit", function(e) {
		confContNewAlm(e);
	});
	$("#btnCloseNewContAlm, #btnIcoCloseNCA").on("click", function() {
		limpCampNCA();
	});
	$("#formAceptTut").on("submit", function(e) {
		aceptTutCit(e);
	});
	// $("#btnJustAlmRel, #btnCloseListAlm, #btnJustAlmAceptRel, #btnCloseListAlmAcept").on("click", 
	// 	function(){
	// 		location.reload();
	// 	}
	// );
}

let tablaalm;
let tablajus;
let tablajusAC;
let tablaHist;
let tablaSolicHist;

function mostDatPer(flag) {
	if (flag) {
		$("#datMostPer").removeClass("ocult");
		$("#datMostPer").addClass("animated bounceInRight").show();
		$("#btnMostPer").removeClass("bg-white");
		$("#btnMostPer").removeClass("text-primary");
		$("#btnMostPer").addClass("bg-primary");
		$("#btnMostPer").addClass("text-white");
	} else {
		// $("#datMostPer").hide();
		$("#datMostPer").removeClass("animated bounceInRight").hide();
		$("#datMostPer").addClass("ocult");
		$("#btnMostPer").removeClass("bg-primary");
		$("#btnMostPer").removeClass("text-white");
		$("#btnMostPer").addClass("bg-white");
		$("#btnMostPer").addClass("text-primary");
	}
}

function mostDatDom(flag) {
	if (flag) {
		$("#datMostDom").removeClass("ocult");
		$("#datMostDom").addClass("animated bounceInRight").show();
		$("#btnMostDom").removeClass("bg-white");
		$("#btnMostDom").removeClass("text-primary");
		$("#btnMostDom").addClass("bg-primary");
		$("#btnMostDom").addClass("text-white");
	} else {
		$("#datMostDom").removeClass("animated bounceInRight").hide();
		$("#datMostDom").addClass("ocult");
		$("#btnMostDom").removeClass("bg-primary");
		$("#btnMostDom").removeClass("text-white");
		$("#btnMostDom").addClass("bg-white");
		$("#btnMostDom").addClass("text-primary");
	}
}

function mostDatOrg(flag) {
	if (flag) {
		$("#datMostOrg").removeClass("ocult");
		$("#datMostOrg").addClass("animated bounceInRight").show();
		$("#btnMostOrg").removeClass("bg-white");
		$("#btnMostOrg").removeClass("text-primary");
		$("#btnMostOrg").addClass("bg-primary");
		$("#btnMostOrg").addClass("text-white");
	} else {
		$("#datMostOrg").addClass("animated bounceInRight").hide();
		$("#datMostOrg").addClass("ocult");
		$("#btnMostOrg").removeClass("bg-primary");
		$("#btnMostOrg").removeClass("text-white");
		$("#btnMostOrg").addClass("bg-white");
		$("#btnMostOrg").addClass("text-primary");
	}
}

function mostDatHist(flag) {
	if (flag) {
		$("#datMostHist").removeClass("ocult");
		$("#datMostHist").addClass("animated bounceInRight").show();
		$("#btnMostHist").removeClass("bg-white");
		$("#btnMostHist").removeClass("text-primary");
		$("#btnMostHist").addClass("bg-primary");
		$("#btnMostHist").addClass("text-white");
	} else {
		$("#datMostHist").addClass("animated bounceInRight").hide();
		$("#datMostHist").addClass("ocult");
		$("#btnMostHist").removeClass("bg-primary");
		$("#btnMostHist").removeClass("text-white");
		$("#btnMostHist").addClass("bg-white");
		$("#btnMostHist").addClass("text-primary");
	}
}

setInterval(function(){
	tablaalm.ajax.reload();
	tablajusAC.ajax.reload();
	tablaSolicHist.ajax.reload();
},10000);

function limpCampJustif() {
	$("#sitJustif").val("");  
	$("#fechJustif").val("");
}

function limpCampHist() {
	$("#razHist").val("");
	$("#priHist").val("0")
	$("#obsHist").val("");
}

function regJustif(e) {
	e.preventDefault();
	let formGenJustif = document.getElementById('formGenJustif');
	let formDat = new FormData($(formGenJustif)[0]);
	let sitJustif = $("#sitJustif").val(), fechJustif = document.getElementById('fechJustif');
	if (sitJustif.length > 0) {
		if (fechJustif.value != "") {
			$.ajax({
				url : "../ajax/doc/functGrpAlm.php?oper=regJustif",
				type: "POST", data: formDat,
				contentType : false, processData : false,
				success : function( resp ) {
					if ( resp == "goodIns" ) {
						swal({
							title : "Correcto!...",
							text : "Los datos han sido registrados",
							icon : "success",
							button : "Aceptar"
						}).then( ( acepta ) => {
							limpCampJustif();
							location.reload();
						});
					} else if ( resp == "failIns" ) {
						swal({
							title : "Ocurrio un problema",
							text : "Los datos no han sido registrados",
							icon : "error",
							button : "Aceptar"
						}).then( ( acepta ) => {
							limpCampJustif();
						});
					} else {
						limpCampJustif();
					}
				} 
			});
		} else {
			swal({
				text : "Selecciona una fecha",
				icon : "warning",
				closeOnClickOutside : false,
				buttons : "Aceptar"
			}).then(( acepta ) => {
				$("#fechJustif").focus();
			});
		}
	} else {
		swal({
			text : "Introduce una situacion",
			icon : "warning",
			closeOnClickOutside : false,
			buttons : "Aceptar"
		}).then(( acepta ) => {
			$("#sitJustif").focus();
		});
	}
}

function listaAlumnos() {
	tablaalm = $("#tbListadoAlumnos").dataTable({
		"aProcessing" : true,
		"aServerSide" : true,
		dom : 'Bftrip',
		buttons: [
		],
		"ajax" : {
			url : "../ajax/doc/functGrpAlm.php?oper=listaAlumnos",
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

function listarJustif() {
	tablajus = $("#tbListadoJustificantes").dataTable({
		"aProcessing" : true,
		"aServerSide" : true,
		dom : 'Bftrip',
		buttons: [
		],
		"ajax" : {
			url : "../ajax/doc/functGrpAlm.php?oper=listarJustif",
			type : "GET",
			dataType : "json",
			error : function(e) {
				//console.log(e.responseText);
			}
		},
		"bDestroy" : true,
		"iDisplayLength" : 5
		//"order" : [[0, "desc"]]
	}).DataTable();
}

function listarJustifAC() {
	tablajusAC = $("#tbListadoJustificantesAC").dataTable({
		"aProcessing" : true,
		"aServerSide" : true,
		dom : 'Bftrip',
		buttons: [
		],
		"ajax" : {
			url : "../ajax/doc/functGrpAlm.php?oper=listarJustifAC",
			type : "GET",
			dataType : "json",
			error : function(e) {
				//console.log(e.responseText);
			}
		},
		"bDestroy" : true,
		"iDisplayLength" : 5
		// "order" : [[0, "desc"]]
	}).DataTable();
}

function aceptJustif(id_justificante) {
	swal({
		title : "Esta seguro?",
		text : "De aceptar el justificante?",
		icon : "warning",
		dangerMode : false,
		buttons : true
	}).then( ( acepta ) => {
		if (acepta) {
			$.post("../ajax/doc/functGrpAlm.php?oper=aceptJustif",
				{id_justificante : id_justificante},
				function(resp){
					if ( resp == 1) {
						swal({
							title : "Correcto",
							text : "Justificante Aceptado",
							icon : "success",
							button : "Aceptar",
							closeOnClickOutside : false
						}).then( ( acepta ) => {
							tablajus.ajax.reload();
							tablajusAC.ajax.reload();
							location.reload();
						});
					} else if ( resp == 0 ) {
						swal({
							title : "Ocurrio un problema",
							text : "No se completo la aceptación",
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

function rechJustif(id_justificante) {
	swal({
		title : "Esta seguro?",
		text : "De rechazar el justificante?",
		icon : "warning",
		dangerMode : false,
		buttons : true
	}).then( ( acepta ) => {
		if (acepta) {
			$.post("../ajax/doc/functGrpAlm.php?oper=rechJustif",
				{id_justificante : id_justificante},
				function( resp ){
					if ( resp == 1) {
						swal({
							title : "Correcto",
							text : "Justificante rechazado",
							icon : "success",
							button : "Aceptar",
							closeOnClickOutside : false
						}).then( ( acepta ) => {
							tablajus.ajax.reload();
							tablajusAC.ajax.reload();
							location.reload();
						});
					} else if ( resp == 0 ) {
						swal({
							title : "Ocurrio un problema",
							text : "No se completo la aceptación",
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

function regHist(e) {
	e.preventDefault();
	let formHistAlm = document.getElementById('formHistAlm');
	let formDat = new FormData($(formHistAlm)[0]);
	let razHist = $("#razHist").val(), obsHist = $("#obsHist").val(); 
	let priHist = document.getElementById('priHist');
	if (razHist.length > 0) {
		if (priHist.value != "0") {
			if (obsHist.length > 0) {
				$.ajax({
					url : "../ajax/doc/functGrpAlm.php?oper=regHist",
					type : "POST", data : formDat,
					contentType : false, processData : false,
					success : function( resp ) {
						if ( resp == "goodIns" ) {
							swal({
								title : "Correcto!...",
								text : "Los datos han sido registrados",
								icon : "success",
								button : "Aceptar"
							}).then( ( acepta ) => {
								limpCampHist();
								location.reload();
							});
						} else if ( resp == "failIns" ) {
							swal({
								title : "Ocurrio un problema",
								text : "Los datos no han sido registrados",
								icon : "error",
								button : "Aceptar"
							}).then( ( acepta ) => {
								limpCampHist();
							});
						} else {
							console.log(resp);
						}
					}
				});
			} else {
				swal({
					text : "Introduce tu observación",
					icon : "warning",
					closeOnClickOutside : false,
					buttons : "Aceptar"
				}).then(( acepta ) => {
					$("#obsHist").focus();
				});
			}
		} else {
			swal({
				text : "Selecciona una prioridad",
				icon : "warning",
				closeOnClickOutside : false,
				buttons : "Aceptar"
			}).then(( acepta ) => {
				$("#priHist").focus();
			});
		}
	} else {
		swal({
			text : "Introduce una razon del porque la tutoria personal",
			icon : "warning",
			closeOnClickOutside : false,
			buttons : "Aceptar"
		}).then(( acepta ) => {
			$("#razHist").focus();
		});
	}
}

function listadoHistorial() {
	tablaHist = $("#tbListadoHistorial").dataTable({
		"aProcessing" : true,
		"aServerSide" : true,
		dom : 'Bftrip',
		buttons: [
		],
		"ajax" : {
			url : "../ajax/doc/functGrpAlm.php?oper=listadoHistorial",
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

function listadoHistorialSolic() {
	tablaSolicHist = $("#tbListadoHistorialSolic").dataTable({
		"aProcessing" : true,
		"aServerSide" : true,
		dom : 'Bftrip',
		buttons : [
		],
		"ajax" : {
			url : "../ajax/doc/functGrpAlm.php?oper=listadoHistorialSolic",
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

function aceptHist(id_tutpersonales) {
	swal({
		title: "Esta seguro?",
		text: "De aceptar la tutoría?",
		icon: "warning",
		dangerMode : true,
		buttons: true
	}).then((acepta)=>{
		if (acepta) {
			$.post("../ajax/doc/functGrpAlm.php?oper=aceptHist",
				{id_tutpersonales : id_tutpersonales},
				function( resp ){
					if ( resp == 1) {
						swal({
							title : "Correcto",
							text : "Tutoría aceptada",
							icon : "success",
							button : "Aceptar",
							closeOnClickOutside : false
						}).then( ( acepta ) => {
							tablaSolicHist.ajax.reload();
							tablaHist.ajax.reload();
							location.reload();
						});
					} else if ( resp == 0 ) {
						swal({
							title : "Ocurrio un problema",
							text : "No se completo la aceptación",
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

function segCont2() {
	let mayus = new RegExp("^(?=.*[A-Z])");
	let lower = new RegExp("^(?=.*[a-z])");
	let len = new RegExp("^(?=.{8,})");
	let numbers = new RegExp("^(?=.*[0-9])");
	let newCont = $("#newContAlm").val();
	if (mayus.test(newCont) && lower.test(newCont) && numbers.test(newCont) && len.test(newCont)) {
		$("#mensaje1d").text("Seguridad Alta").css("color","green");
		$("#mensaje1d").show(1000);
	} else if (mayus.test(newCont) && numbers.test(newCont) && len.test(newCont) 
		|| lower.test(newCont) && numbers.test(newCont) && len.test(newCont)) {
		$("#mensaje1d").text("Seguridad Media").css("color","orange");
		$("#mensaje1d").show(1000);
	} else if (mayus.test(newCont) && len.test(newCont) 
		|| lower.test(newCont) && len.test(newCont) 
		|| numbers.test(newCont) && len.test(newCont)
		|| numbers.test(newCont)
		|| mayus.test(newCont)
		|| lower.test(newCont)) {
		$("#mensaje1d").text("Seguridad Baja").css("color","red");
		$("#mensaje1d").show(1000);
	} else {
		$("#mensaje1d").text("");
		$("#mensaje1d").hide(1000);
	}
}

function contIgul2() {
	let newCont = $("#newContAlm").val();
	let repCont = $("#repNewContAlm").val();
	if (repCont.length > 0) {
		if (repCont === newCont) {
			$("#mensaje2d").text("Las contraseñas coinciden").css({"color":"green"}).show();
			$("#btnNewContAlmConf").prop("disabled",false);
		} else {
			$("#mensaje2d").text("Las contraseñas no coinciden").css({"color":"red"}).show();
			$("#btnNewContAlmConf").prop("disabled",true);
		}
	} else {
		$("#mensaje2d").text("").hide();
		$("#btnNewContAlmConf").prop("disabled", false);
	}
}

function limpCampNCA() {
	$("#newContAlm").val("");
	$("#repNewContAlm").val("");
	$("#contConfDoc").val("");
	$("#mensaje1d").hide(); $("#mensaje2d").hide();
	$("#btnNewContAlmConf").prop("disabled", false);
}

function confContNewAlm(e) {
	e.preventDefault();
	let formNewContAlm = document.getElementById('formNewContAlm'),
	formDat = new FormData($(formNewContAlm)[0]), newContAlm = $("#newContAlm").val(),
	repNewContAlm = $("#repNewContAlm").val(), contConfDoc = $("#contConfDoc").val();
	if (newContAlm.length > 0) {
		if (repNewContAlm.length > 0) {
			if (contConfDoc.length > 0) {
				swal({
					title : "Esta seguro?",
					text : "De actualizar la contraseña?",
					icon : "warning",
					button : "Aceptar"
				}).then( ( acepta ) =>{
					if (acepta) {
						$.ajax({
							url : "../ajax/doc/functGrpAlm.php?oper=confContNewAlm",
							type : "POST", data : formDat,
							contentType : false, processData : false,
							success : function( resp ) {
								if ( resp === "goodUpd" ) {
									swal({
										title : "Actualización exitosa",
										text : "La contraseña fue cambiada correctamente",
										icon : "success",
										button: false,
									});
									setTimeout(function() {
										location.reload();
									}, 1500);
								} else if ( resp === "failUpd" ) {
									swal({
										title : "Ocurrio un problema",
										text : "La contraseña no fue actualizada",
										icon : "error",
										button : "Aceptar"
									});
									limpCampNCA();
								} else if ( resp === "failCont" ) {
									swal({
										text : "Su contraseña es incorrecta, intente de nuevo",
										icon : "warning",
										button : "Aceptar"
									}).then((acepta) => {
										$("#contConfDoc").val("");
										$("#contConfDoc").focus();
									});
								} else {
									console.log(resp);
								}
							}
						});
					} else {
						swal("Bien");
					}
				});
			} else {
				swal({
					text : "Introduce tu contraseña para confirmar",
					icon : "warning",
					button : "Aceptar"
				}).then( ( acepta ) =>{
					$("#contConfDoc").focus();
				});
			}
		} else {
			swal({
				text : "Repite la nueva contraseña",
				icon : "warning",
				button : "Aceptar"
			}).then( ( acepta ) =>{
				$("#repNewContAlm").focus();
			});
		}
	} else {
		swal({
			text : "Introduce una nueva contraseña",
			icon : "warning",
			button : "Aceptar"
		}).then( ( acepta ) =>{
			$("#newContAlm").focus();
		});
	}
}

function desactAlm(id_alumno) {
	swal({
		title : "Esta seguro?",
		text : "De desactivar la cuenta del alumno?",
		icon : "warning",
		dangerMode : false,
		buttons : true
	}).then( ( acepta ) => {
		if (acepta) {
			$.post("../ajax/doc/functGrpAlm.php?oper=desactAlm",
				{id_alumno : id_alumno},
				function( resp ){
					if ( resp === "goodUpd" ) {
						swal({
							title : "Correcto",
							text : "Cuenta desactivada",
							icon : "success",
							button : "Aceptar",
							closeOnClickOutside : false
						}).then( ( acepta ) => {
							location.reload();
						});
					} else if ( resp === "failUpd" ) {
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

function activAlm(id_alumno) {
	swal({
		title : "Esta seguro?",
		text : "De activar la cuenta del alumno?",
		icon : "warning",
		dangerMode : false,
		buttons : true
	}).then( ( acepta ) => {
		if (acepta) {
			$.post("../ajax/doc/functGrpAlm.php?oper=activAlm",
				{id_alumno : id_alumno},
				function( resp ){
					if ( resp === "goodUpd" ) {
						swal({
							title : "Correcto",
							text : "Cuenta activada",
							icon : "success",
							button : "Aceptar",
							closeOnClickOutside : false
						}).then( ( acepta ) => {
							location.reload();
						});
					} else if ( resp === "failUpd" ) {
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

function datIdTut(id_tutpersonales) {
	$.post("../ajax/doc/functGrpAlm.php?oper=datIdTut",
		{id_tutpersonales : id_tutpersonales}, 
		function(data, status){
			data = JSON.parse(data);
			$("#id_tutpersonales").val(data.id_tutpersonales);
		});
}

function aceptTutCit(e) {
	e.preventDefault();
	let formAceptTut = document.getElementById('formAceptTut');
	let formDat = new FormData($(formAceptTut)[0]), citFech = $("#citFech").val(),
	timCit = $("#timCit").val();
	if (citFech.length > 0) {
		if (timCit.length > 0) {
			$.ajax({
				url : "../ajax/doc/functGrpAlm.php?oper=aceptTutCit",
				type : "POST", data: formDat, 
				contentType : false, processData : false,
				success : function( resp ) {
					if ( resp == "goodUpd" ) {
						swal({
							title : "Correcto!...",
							text : "Los datos han sido registrados",
							icon : "success",
							button : "Aceptar",
							closeOnClickOutside : false,
						}).then( ( acepta ) => {
							$("#citFech").val(""); 
							$("#timCit").val("");
							$("#citTut").modal("hide");
							tablaSolicHist.ajax.reload();
							tablaHist.ajax.reload();
						});
					} else if ( resp == "failUpd" ) {
						swal({
							title : "Ocurrio un problema",
							text : "Datos no registrados",
							icon : "error",
							button : "Aceptar",
							closeOnClickOutside : false
						}).then( ( acepta ) => {
							location.reload();
						});	
					} else if ( resp == "mal" ) {
						swal({
							text : "Seleccione una fecha mayor o igual a la fecha actual",
							icon : "warning",
							button : "Aceptar",
							closeOnClickOutside : false
						}).then( ( acepta ) => {
							$("#citFech").val("");
							$("#citFech").focus();
						});
					} else {
						console.log(resp);
					}
				}
			});
		} else {
			swal({
				text : "Seleccione una hora",
				icon : "warning",
				button : "Aceptar",
				closeOnClickOutside : false
			}).then( ( acepta ) => {
				$("#timCit").focus();
			});
		}
	} else {
		swal({
			text : "Seleccione una fecha",
			icon : "warning",
			button : "Aceptar",
			closeOnClickOutside : false
		}).then( ( acepta ) => {
			$("#citFech").focus();
		});	
	}
}

init();