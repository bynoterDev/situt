function init() {
	$("#formGCEsc").on("submit",function(e){
		regCicloEsc(e);
	});
	listarCEscolar();
	listarCEscolarDes();
}

let tabla; 
let tablades;

function listarCEscolar() {
	tabla = $("#tbListadoCEscolar").dataTable({
		"aProcessing" : true,
		"aServerSide" : true,
		dom : 'Bftrip',
		buttons: [
		],
		"ajax" : {
			url : "../ajax/adm/functionsAdm.php?oper=listarCEscolar",
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

function listarCEscolarDes() {
	tablades = $("#tbListadoCEscolarDesc").dataTable({
		"aProcessing" : true,
		"aServerSide" : true,
		dom : 'Bftrip',
		buttons: [
		],
		"ajax" : {
			url : "../ajax/adm/functionsAdm.php?oper=listarCEscolarDes",
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

function desactivarCEsc(id_ciclo_escolar) {
	swal({
		title: "Esta seguro?",
		text: "De desactivar el ciclo escolar",
		icon: "warning",
		dangerMode : true,
		buttons: true
	}).then((acepta)=>{
		if (acepta) {
			$.post("../ajax/adm/functionsAdm.php?oper=desactivarCEsc",
				{id_ciclo_escolar : id_ciclo_escolar},
				function(e){
					swal(e);
					tabla.ajax.reload();
					tablades.ajax.reload();
				});
		} else {
			swal("Bien");
		}
	});
}

function activarCEsc(id_ciclo_escolar) {
	swal({
		title: "Esta seguro?",
		text: "De activar el ciclo escolar",
		icon: "warning",
		dangerMode : true,
		buttons: true
	}).then((acepta)=>{
		if (acepta) {
			$.post("../ajax/adm/functionsAdm.php?oper=activarCEsc",
				{id_ciclo_escolar : id_ciclo_escolar},
				function(e){
					swal(e);
					tabla.ajax.reload();
					tablades.ajax.reload();
				});
		} else {
			swal("Bien");
		}
	});
}


function regCicloEsc(e){
	e.preventDefault();
	let formGCEsc = document.getElementById('formGCEsc');
	let formDat = new FormData($(formGCEsc)[0]);
	let nomCEsc = $("#nomCEsc").val();
	let estCEsc = document.getElementById('estCEsc');
	if (nomCEsc.length > 0) {
		if (estCEsc.value != "No") {
			$.ajax({
				url : "../ajax/adm/functionsAdm.php?oper=regCicloEsc",
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
							button : false
						});
						setTimeout(function() {
							location.reload();
						}, 1500);
					} else if (resp == 0) {
						swal({
							title : "Ocurrio un problema",
							text : "Los datos no fuerón registrados",
							icon : "error",
							button : "Aceptar"
						});
						$("#nomCEsc").val("");
						$("#estCEsc").val("No");
					} else if (resp == 2) {
						swal({
							title : "Atención",
							text : "Ya se encuentra registrado un ciclo escolar parecido",
							icon : "warning",
							button : "Aceptar"
						});
						$("#nomCEsc").val("");
						$("#estCEsc").val("No");
					} else {
						console.log(resp);
					}
				//swal(resp);
				}
			});
		} else {
			swal({
				text : "Selecciona un estado para el ciclo escolar",
				icon : "warning",
				timer : 2000,
				closeOnClickOutside : false,
				button : false
			});
			$("#estCEsc").focus();
		}
	} else {
		swal({
			text : "Introduce un ciclo escolar",
			icon : "warning",
			timer : 2000,
			closeOnClickOutside : false,
			button : false
		});
		$("#nomCEsc").focus();
	}
}

init();