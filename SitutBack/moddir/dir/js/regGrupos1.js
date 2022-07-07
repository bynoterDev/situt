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
	$("#formRegGrp").on("submit",function(e){
		regGrupo(e);
	});
	$("#formEditGrp").on("submit",function(e){
		editGrupo(e);
	});
	listarGruposAct();
	listarGruposDes();
}

function limpCampos() {
	$("#grpDet").val("No"); $("#docGrp").val("No");
	$("#estGrp").val("1");
}

function regGrupo(e) {
	e.preventDefault();
	let formRegGrp = document.getElementById('formRegGrp');
	let formDat = new FormData($(formRegGrp)[0]);
	let grpDet = document.getElementById('grpDet'),
		docGrp = document.getElementById('docGrp'),
		estGrp = document.getElementById('estGrp');
	if (grpDet.value != "No") {
		if (docGrp.value != "No") {
			if (estGrp.value != "No") {
				
				$.ajax({
					url : "../../ajax/dir/tutoresDat.php?oper=regGrupo",
					type : "POST", data : formDat,
					contentType : false, processData : false,
					success : function(resp) {
						if ( resp == "goodIns" ) {
							swal({
								title : "Correcto!...",
								text : "Datos registrados",
								icon : "success",
								button : "Aceptar",
								closeOnClickOutside : false
							}).then( ( acepta ) => {
								tabla.ajax.reload();
								tabladesc.ajax.reload();
								limpCampos();
							});
						} else if ( resp == "failIns" ) {
							swal({
								title : "Ocurrio un problema",
								text : "Fallo el registro de datos",
								icon : "error",
								button : "Aceptar",
								closeOnClickOutside : false
							}).then( ( acepta ) => {
								limpCampos();
								setTimeout(function(){
									location.reload();
								},1500);
							});
						} else if ( resp == "extDat" ) {
							swal({
								text : "Los datos que intenta registrar ya se encuentran registrados",
								icon : "warning",
								button : "Aceptar",
								closeOnClickOutside : false
							});
						} else if ( resp == "extDatGrp" ) {
							swal({
								text : "El grupo seleccionado ya tiene un tutor asignado",
								icon : "warning",
								button : "Aceptar",
								closeOnClickOutside : false
							});
						} else {
							console.log(resp);
						}
					}
				});
			} else {
				swal({
					text : "Selecciona un estado",
					icon : "warning",
					timer : 2000,
					closeOnClickOutside : false,
					buttons : false
				});
				$("#estGrp").focus();
			}
		} else {
			swal({
				text : "Selecciona un docente",
				icon : "warning",
				timer : 2000,
				closeOnClickOutside : false,
				buttons : false
			});
			$("#docGrp").focus();
		}
	} else {
		swal({
			text : "Selecciona un grupo",
			icon : "warning",
			timer : 2000,
			closeOnClickOutside : false,
			buttons : false
		});
		$("#grpDet").focus();
	}
}

function listarGruposAct() {
	tabla = $("#tbListadoGrpAct").dataTable({
		"aProcessing" : true,
		"aServerSide" : true,
		dom : 'Bftrip',
		buttons: [
		],
		"ajax" : {
			url : "../../ajax/dir/tutoresDat.php?oper=listarGruposAct",
			type : "GET",
			dataType : "json",
			error : function(e) {
				console.log(e.responseText);
			}
		},
		"bDestroy" : true,
		"iDisplayLength" : 5,
		"language" : lenguaje
	}).DataTable();
}

function listarGruposDes() {
	tabladesc = $("#tbListadoGrpDes").dataTable({
		"aProcessing" : true,
		"aServerSide" : true,
		dom : 'Bftrip',
		buttons: [
		],
		"ajax" : {
			url : "../../ajax/dir/tutoresDat.php?oper=listarGruposDes",
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

function desactivarGrp(id_detgrupo) {
	swal({
		title: "Esta seguro?",
		text: "De desactivar el grupo?",
		icon: "warning",
		dangerMode : true,
		buttons: true
	}).then((acepta)=>{
		if (acepta) {
			$.post("../../ajax/dir/tutoresDat.php?oper=desactivarGrp",
				{id_detgrupo : id_detgrupo},
				function( resp ){
					if ( resp == 1) {
						swal({
							title : "Correcto",
							text : "Grupo Desactivado",
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

function activarGrp(id_detgrupo) {
	swal({
		title: "Esta seguro?",
		text: "De desactivar el grupo?",
		icon: "warning",
		dangerMode : true,
		buttons: true
	}).then((acepta)=>{
		if (acepta) {
			$.post("../../ajax/dir/tutoresDat.php?oper=activarGrp",
				{id_detgrupo : id_detgrupo},
				function( resp ){
					if ( resp == 1) {
						swal({
							title : "Correcto",
							text : "Grupo Activado",
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

function mostrarGrp(id_detgrupo) {
	$.post("../../ajax/dir/tutoresDat.php?oper=mostrarGrp",
		{id_detgrupo : id_detgrupo}, 
		function(data, status){
			data = JSON.parse(data);
			$("#id_detgrupo").val(data.id_detgrupo);
			$("#id_grupo").val(data.id_grupo);
			$("#id_docente").val(data.id_docente);
			$("#grpnam").text(data.grupo_n);
			$("#tutAct").val(data.nombre_c_doc);
		});
}

//
function editGrupo(e) {
	e.preventDefault();
	let formEditGrp = document.getElementById('formEditGrp');
	let formDat = new FormData($(formEditGrp)[0]);
	let passConf = $("#tutGrpEdit").val();
	if (passConf != "No") {
		$.ajax({
			url : "../../ajax/dir/tutoresDat.php?oper=editGrupo",
			type : "POST", data : formDat,
			contentType : false, processData : false, 
			success : function(resp) {
				if (resp == 2) {
					swal({
						title : "Ocurrio un problema",
						text : "Los datos no fueron actualizados",
						icon : "error",
						button : "Aceptar"
					});
				} else if (resp == 1) {
					swal({
						title : "Correcto!...",
						text : "Los datos han sido actualizados",
						icon : "success",
						button : "Aceptar",
						closeOnClickOutside : false
					}).then( ( acepta ) => {
						$("#editGrp").modal("hide");
						$("#perGrpEdit").val("No");
						$("#tutGrpEdit").val("No");
						$("#passConf").val("");
						tabla.ajax.reload();
						tabladesc.ajax.reload();
					});
				} else{
					console.log(resp);
				}
			}
		});
	} else {
		swal({
			text : "Selecciona el grupo",
			icon : "warning",
			timer : 2000,
			closeOnClickOutside : false,
			buttons : false
		});
		$("#tutGrpEdit").focus();
	}
}

init();