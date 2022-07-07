document.addEventListener('DOMContentLoaded', () => {

	let tableDoc;
	
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

	datatableDoc = () => {
		tableDoc = $("#tbListDoc").dataTable({
			"aProcessing" : true,
			"aServerSide" : true,
			dom : 'Bftrip',
			buttons: [
			],
			"ajax" : {
				url : "../../../ajax/reports/dataUsSel.php?oper=listDoc",
				type : "GET",
				dataType : "json",
				error : function(e) {
					console.log(e.responseText);
				}
			},
			"bDestroy" : true,
			"iDisplayLength" : 10,
			"language" : lenguaje
		}).DataTable();
	}

	desactCuent = (param) => {
		const opc = 'desc';
		swal({
			title: "!Alerta!",
			text: "Esta seguro de deshabilitar la cuenta?",
			icon: "warning",
			dangerMode : true,
			buttons: true,
			closeOnClickOutside : false
		}).then((acepta)=>{
			if (acepta) {
				$.post("../../../ajax/reports/confFunc.php?oper=cuentDoc",
					{param : param, opc : opc},
					( resp ) => {
						if ( resp == 1) {
							swal({
								text : "Cuenta deshabilitada",
								icon : "success",
								button : "Aceptar",
								closeOnClickOutside : false
							}).then( ( acepta ) => {
								tableDoc.ajax.reload();
							});
						} else if ( resp == 0 ) {
							swal({
								text : "Ocurrio un problema",
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
			}
		});
	}

	activaCuent = (param) => {
		const opc = 'acti';
		swal({
			title: "!Alerta!",
			text: "Esta seguro de habilitar la cuenta?",
			icon: "warning",
			dangerMode : true,
			buttons: true,
			closeOnClickOutside : false
		}).then((acepta)=>{
			if (acepta) {
				$.post("../../../ajax/reports/confFunc.php?oper=cuentDoc",
					{param : param, opc : opc},
					( resp ) => {
						if ( resp == 1) {
							swal({
								text : "Cuenta habilitada",
								icon : "success",
								button : "Aceptar",
								closeOnClickOutside : false
							}).then( ( acepta ) => {
								tableDoc.ajax.reload();
							});
						} else if ( resp == 0 ) {
							swal({
								text : "Ocurrio un problema",
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
			}
		});
	}

	desactRep = (param) => {
		const opc = 'desc';
		swal({
			title: "!Alerta!",
			text: "Esta seguro de deshabilitar los reportes?",
			icon: "warning",
			dangerMode : true,
			buttons: true,
			closeOnClickOutside : false
		}).then((acepta)=>{
			if (acepta) {
				$.post("../../../ajax/reports/confFunc.php?oper=reporDoc",
					{param : param, opc : opc},
					( resp ) => {
						if ( resp == 1) {
							swal({
								text : "Reportes deshabilitados",
								icon : "success",
								button : "Aceptar",
								closeOnClickOutside : false
							}).then( ( acepta ) => {
								tableDoc.ajax.reload();
							});
						} else if ( resp == 0 ) {
							swal({
								text : "Ocurrio un problema",
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
			}
		});
	}

	activaRep = (param) => {
		const opc = 'acti';
		swal({
			title: "!Alerta!",
			text: "Esta seguro de habilitar los reportes?",
			icon: "warning",
			dangerMode : true,
			buttons: true,
			closeOnClickOutside : false
		}).then((acepta)=>{
			if (acepta) {
				$.post("../../../ajax/reports/confFunc.php?oper=reporDoc",
					{param : param, opc : opc},
					( resp ) => {
						if ( resp == 1) {
							swal({
								text : "Reportes habilitados",
								icon : "success",
								button : "Aceptar",
								closeOnClickOutside : false
							}).then( ( acepta ) => {
								tableDoc.ajax.reload();
							});
						} else if ( resp == 0 ) {
							swal({
								text : "Ocurrio un problema",
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
			}
		});
	}

	datatableDoc();

});