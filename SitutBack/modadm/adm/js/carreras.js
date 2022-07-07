let actRegAct, actRegDes;
let tabla;
let tabladesc;
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
	$("#formGCarr").on("submit",function(e){
		guardarCarr(e);
	});
	$("#formEditCar").on("submit",function(e){
		editCar(e);
	});
	listarCarreras();
	listarCarrerasDes();
	carAct();
	carInc();
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
				url : "../../ajax/adm/functionsAdm.php?oper=guardarCarr",
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

function listarCarreras() {
	tabla = $("#tbListadoCarrera").dataTable({
		"aProcessing" : true,
		"aServerSide" : true,
		dom : 'Bftrip',
		buttons: [
		],
		"ajax" : {
			url : "../../ajax/adm/functionsAdm.php?oper=listarCarreras",
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

function listarCarrerasDes() {
	tabladesc = $("#tbListadoCarreraDesc").dataTable({
		"aProcessing" : true,
		"aServerSide" : true,
		dom : 'Bftrip',
		buttons: [
		],
		"ajax" : {
			url : "../../ajax/adm/functionsAdm.php?oper=listarCarrerasDes",
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
			$.post("../../ajax/adm/functionsAdm.php?oper=desactivarCarrera",
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
							carAct();
							carInc();
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
			$.post("../../ajax/adm/functionsAdm.php?oper=activarCarrera",
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
							carAct();
							carInc();
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
	$.post("../../ajax/adm/functionsAdm.php?oper=mostrarCarrera",
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
			url : "../../ajax/adm/functionsAdm.php?oper=editCar",
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

function carAct () {
	$.ajax({
		url:'../../ajax/adm/functionsAdm.php?oper=carAct',
		type : "POST",
		success:function (data) {
			if (data > 1 || data == 0) {
				$('#carAct').html(data + " registros.");	
			} else {
				$('#carAct').html(data + " registro.");	
			}
		}
	});
}

function carInc () {
	$.ajax({
		url:'../../ajax/adm/functionsAdm.php?oper=carInc',
		type : "POST",
		success:function (data) {
			if (data > 1 || data == 0) {
				$('#carInc').html(data + " registros.");	
			} else {
				$('#carInc').html(data + " registro.");	
			}
		}
	});
}

init();