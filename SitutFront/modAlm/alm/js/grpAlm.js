function init() {
	$("#formEditMyGrp").on("submit", function(e){
		editGrp(e);
	});
	$("#formRegGrp").on("submit", function(e) {
		regGrpP(e);
	});
}

function editGrp(e) {
	e.preventDefault();
	let formEditMyGrp = document.getElementById('formEditMyGrp');
	let formDat = new FormData($(formEditMyGrp)[0]);
	let editGrpOpc = document.getElementById('editGrpOpc');
	if (editGrpOpc.value != "No") {
		swal({
			title : "Esta seguro?",
			text : "De actualizar su grupo actual?",
			icon : "warning",
			buttons : true
		}).then( ( acepta ) => {
			if (acepta) {
				$.ajax({
					url : "../../ajax/alm/grpAlm.php?oper=editGrp",
					type : "POST", data : formDat,
					contentType : false, processData : false,
					success : function( resp ) {
						if ( resp === "goodUpd" ) {
							swal({
								title : "Actualización exitosa",
								text : "Datos cambiados correctamente",
								icon : "success",
								button: false,
							});
							setTimeout(function() {
								location.reload();
							}, 1500);
						} else if ( resp === "failUpd" ) {
							swal({
								title : "Ocurrio un problema",
								text : "Los datos no fueron actualizados",
								icon : "error",
								button : "Aceptar"
							});
							$("#editGrpOpc").val("No");
						} else {
							console.log(resp);
						}
					}
				});
			} else {
				swal("Bien...");
			}
		});
	} else {
		swal({
			text : "Selecciona un grupo",
			icon : "warning",
			button : "Aceptar"
		}).then( ( acepta ) => {
			$("#editGrpOpc").focus();
		});
	}
}

function regGrpP(e) {
	e.preventDefault();
	let formRegGrp = document.getElementById('formRegGrp');
	let formDat = new FormData($(formRegGrp)[0]), clvDetGrp = document.getElementById('clvDetGrp');
	if (clvDetGrp.value != "SN") {
		$.ajax({
			url : "../../ajax/alm/grpAlm.php?oper=regGrpP",
			type : "POST", data : formDat, 
			contentType : false, processData : false,
			success : function( resp ) {
				if ( resp == "goodUpd" ) {
					swal({
						title : "Correcto datos registrados",
						text : "Ahora espera que el tutor acepte tu solicitud",
						icon : "success",
						button : "Aceptar",
						closeOnClickOutside : false
					}).then( ( acepta) => {
						location.reload();
					});
				} else if ( resp == "failUpd" ) {
					swal({
						title : "Ocurrio un problema...",
						text : "Los datos no han sido registrados",
						icon : "error",
						button : "Aceptar",
						closeOnClickOutside : false
					}).then( ( acepta ) => {
						$("#clvDetGrp").val("SN");
					});
				} else {
					console.log( resp );
				}
			}
		});
	} else {
		swal({
			text : "Selecciona el grupo al que perteneces",
			icon : "warning",
			button : "Aceptar",
			closeOnClickOutside : false
		}).then( ( acepta ) => {
			$("#clvDetGrp").focus();
		});
	}
}

init();