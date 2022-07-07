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
	listAlmGraduate();
}

function listAlmGraduate() {
	tabla = $("#tbListadoGraduate").dataTable({
		"aProcessing" : true,
		"aServerSide" : true,
		"ajax" : {
			url : "../../ajax/dir/almCarDir.php?oper=listAlmGraduate",
			type : "GET",
			dataType : "json",
			error : function(e) {
				console.log(e.responseText);
			}
		},
		"bDestroy" : true,
		"language" : lenguaje,
		"order" : [[0, "ASC"]]
	}).DataTable();
}

function desactAlm(idalumno) {
	swal({
		title: "Esta seguro?",
		text: "Presione aceptar para continuar...",
		icon: "warning",
		dangerMode : true,
		buttons: true
	}).then((acepta)=>{
		if (acepta) {
			$.post("../../ajax/dir/almCarDir.php?oper=desactAlm",
				{idalumno : idalumno},
				function( resp ){
					if ( resp == 1) {
						swal({
							title : "Correcto",
							text : "Confirmación aceptada",
							icon : "success",
							button : "Aceptar",
							closeOnClickOutside : false
						}).then( ( acepta ) => {
							tabla.ajax.reload();
						});
					} else if ( resp == 0 ) {
						swal({
							title : "Ocurrio un problema",
							text : "No se completo la confirmacion",
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

init();