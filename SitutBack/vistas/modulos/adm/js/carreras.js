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
	$("#formGCarr").on("submit",function(e){
		guardarCarr(e);
	});
	$("#formEditCar").on("submit",function(e){
		editCar(e);
	});
	listarCarreras();
	listarCarrerasDes();
	mostListCarAct(true);
	setInterval(function(){
		carAct(); carInc();
	}, 1000);
}

function guardarCarr(e) {
	e.preventDefault();
	let formGCarr = document.getElementById('formGCarr');
	let formDat = new FormData($(formGCarr)[0]);
	let nomCar = $("#nomCar").val();
	let estCar = document.getElementById('estCar');
	if (nomCar.length > 0) {
		if (estCar.value != "No") {
			$.ajax({
				url : "../ajax/adm/functionsAdm.php?oper=guardarCarr",
				type : "POST",
				data : formDat,
				contentType : false,
				processData : false,
				success : function(resp) {
					if (resp == 0) {
						swal({
							title : "Ocurrio un problema",
							text : "Los datos no fuerón registrados",
							icon : "error",
							button : "Aceptar"
						});
						$("#nomCar").val("");
						$("#estCar").val("No");
					} else if (resp == 1) {
						swal({
							title : "Correcto!...",
							text : "Los datos han sido registrados",
							icon : "success",
							button : false
						});
						setTimeout(function() {
							location.reload();
						}, 1500);
					} else if (resp == 2) {
						swal({
							title : "Atención",
							text : "La carrera ya esta registrada",
							icon : "warning",
							button : "Aceptar"
						});
						$("#nomCar").val("");
						$("#estCar").val("No");
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
				$("#estCar").focus();
			});
		}
	} else {
		swal({
			text : "Introduce un nombre de carrera",
			icon : "warning",
			closeOnClickOutside : false,
			button : "Aceptar"
		}).then( ( acepta ) => {
			$("#nomCar").focus();
		});
	}
}

let tabla;
let tabladesc;

function listarCarreras() {
	tabla = $("#tbListadoCarrera").dataTable({
		"aProcessing" : true,
		"aServerSide" : true,
		dom : 'Bftrip',
		buttons: [
		],
		"ajax" : {
			url : "../ajax/adm/functionsAdm.php?oper=listarCarreras",
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

function listarCarrerasDes() {
	tabladesc = $("#tbListadoCarreraDesc").dataTable({
		"aProcessing" : true,
		"aServerSide" : true,
		dom : 'Bftrip',
		buttons: [
		],
		"ajax" : {
			url : "../ajax/adm/functionsAdm.php?oper=listarCarrerasDes",
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

function desactivarCarrera(id_carrera) {
	swal({
		title: "Esta seguro?",
		text: "De desactivar la carrera",
		icon: "warning",
		dangerMode : true,
		buttons: true,
		closeOnClickOutside : false
	}).then((acepta)=>{
		if (acepta) {
			$.post("../ajax/adm/functionsAdm.php?oper=desactivarCarrera",
				{id_carrera : id_carrera},
				function( resp ){
					if ( resp == 1) {
						swal({
							title : "Correcto",
							text : "Carrera Desactivada",
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
			swal("Sin Proceso...");
		}
	});
}

function activarCarrera(id_carrera){
	swal({
		title : "Esta seguro?",
		text : "De activar la carrera",
		icon : "warning",
		dangerMode : false,
		buttons : true,
		closeOnClickOutside : false
	}).then((acepta)=>{
		if (acepta) {
			$.post("../ajax/adm/functionsAdm.php?oper=activarCarrera",
				{id_carrera : id_carrera},
				function( resp ){
					if ( resp == 1) {
						swal({
							title : "Correcto",
							text : "Carrera Activada",
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
			swal("Sin Proceso...");
		}
	});
}

function mostrarCarrera(id_carrera) {
	$.post("../ajax/adm/functionsAdm.php?oper=mostrarCarrera",
		{id_carrera : id_carrera}, 
		function(data, status){
			data = JSON.parse(data);
			$("#id_carrera").val(data.id_carrera);
			$("#nomCarEdit").val(data.nombre_car);
		});
}

function editCar(e) {
	e.preventDefault();
	let formEditCar = document.getElementById('formEditCar');
	let formDat = new FormData($(formEditCar)[0]);
	let nomCarEdit = $("#nomCarEdit").val();
	if (nomCarEdit.length > 0) {
		$.ajax({
			url : "../ajax/adm/functionsAdm.php?oper=editCar",
			type : "POST",
			data : formDat,
			contentType : false,
			processData : false,
			success : function(resp) {
				if (resp == 1) {
					swal({
						title : "Correcto!...",
						text : "Los datos han sido actualizados",
						icon : "success",
						button : "Aceptar",
						closeOnClickOutside : false
					}).then( ( acepta ) => {
						$("#editCar").modal('hide');
						tabla.ajax.reload();
						tabladesc.ajax.reload();
					});
				} else if (resp == 2) {
					swal({
						title : "Ocurrio un problema",
						text : "Los datos no fueron actualizados",
						icon : "error",
						button : "Aceptar",
						closeOnClickOutside : false
					}).then( ( acepta ) => {
						location.reload();
					});
				}
			}
		});
	} else {
		swal({
			text : "Debes de escribir un nombre de carrera",
			icon : "warning",
			timer : 2000,
			closeOnClickOutside : false,
			button : false
		});
		$("#nomCarEdit").focus();
	}
}

function mostListCarAct(flag) {
	if (flag) {
		$("#tbListadoCarAct").fadeIn("2000");
		$("#listCarAct").addClass("active");
	} else {
		$("#tbListadoCarAct").slideUp();
		$("#listCarAct").removeClass("active");
	}
}

function mostListCarDes(flag) {
	if (flag) {
		$("#tbListadoCarDes").fadeIn("2000");
		$("#listCarDes").addClass("active");
	} else {
		$("#tbListadoCarDes").slideUp();
		$("#listCarDes").removeClass("active");
	}
}

function carAct () {
	$.ajax({
		url:'../ajax/adm/functionsAdm.php?oper=carAct',
		type : "POST",
		success:function (data) {
			if (data > 1 || data == 0) {
				$('#carAct').html(data + " Registros");	
			} else {
				$('#carAct').html(data + " Registro");	
			}
		}
	});
}

function carInc () {
	$.ajax({
		url:'../ajax/adm/functionsAdm.php?oper=carInc',
		type : "POST",
		success:function (data) {
			if (data > 1 || data == 0) {
				$('#carInc').html(data + " Registros");	
			} else {
				$('#carInc').html(data + " Registro");	
			}
		}
	});
}

init();