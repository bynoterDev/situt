function init() {
	$("#btnV1").on("click", function() {
		valTestP1();
	});
	$("#btnV2").on("click", function() {
		valTestP2();
	});
	$("#formEditEnc").on("submit", function(e) {
		editTest(e);
	});
}


function valTestP1() {
	if ($("#reside").val() != "0") {
		if ($("#trabajas").val() != "0") {
			if ($("#habitas").val() != "0") {
				$("#valdat").modal("show");
				setTimeout(function() {
					$("#textdat").text("Todo correcto!...");
					$("#pills-profile-tab").focus();
					setTimeout(function() {
						$("#valdat").modal("hide");
						setTimeout(function() {
							$("#contBtn1Val").hide();
							$("#mostDat2").removeClass("ocult");
							$("#mostDat2").slideDown();
						}, 1000);
					}, 1500);
				}, 3000);
			} else {
				swal({
					text : "Por favor seleccione donde habita",
					icon : "warning",
					button : "Aceptar"
				}).then( ( acepta ) => {
					$("#habitas").focus();
				});
			}
		} else {
			swal({
				text : "Por favor seleccione si trabaja",
				icon : "warning",
				button : "Aceptar"
			}).then( ( acepta ) => {
				$("#trabajas").focus();
			});
		}
	} else {
		swal({
			text : "Por favor eliga una opción de donde reside",
			icon : "warning",
			button : "Aceptar"
		}).then( ( acepta ) => {
			$("#reside").focus();
		});
	}
}

function valTestP2() {
	if ($("#padeces").val() != "0") {
		if ($("#frec_enferm").val() != "0") {
			if ($("#medicamento").val() != "0") {
				if ($("#fumas").val() != "0") {
					if ($("#alchol").val() != "0") {
						if ($("#novio").val() != "0") {
							if ($("#planes").val() != "0") {
								$("#valdat").modal("show");
								setTimeout(function() {
									$("#textdat").text("Todo correcto!...");
									$("#pills-contact-tab").focus();
									setTimeout(function() {
										$("#valdat").modal("hide");
										setTimeout(function() {
											$("#contBtn2Val").hide();
											$("#mostDat3").removeClass("ocult");
											$("#mostDat3").show();
										}, 1000);
									}, 1500);
								}, 3000);
							} else {
								swal({
									text : "Por favor eliga una opción",
									icon : "warning",
									button : "Aceptar"
								}).then( ( acepta ) => {
									$("#planes").focus();
								});
							}
						} else {
							swal({
								text : "Por favor eliga una opción",
								icon : "warning",
								button : "Aceptar"
							}).then( ( acepta ) => {
								$("#novio").focus();
							});
						}
					} else {
						swal({
							text : "Por favor eliga una opción",
							icon : "warning",
							button : "Aceptar"
						}).then( ( acepta ) => {
							$("#alchol").focus();
						});
					}
				} else {
					swal({
						text : "Por favor eliga una opción",
						icon : "warning",
						button : "Aceptar"
					}).then( ( acepta ) => {
						$("#fumas").focus();
					});
				}
			} else {
				swal({
					text : "Por favor eliga una opción",
					icon : "warning",
					button : "Aceptar"
				}).then( ( acepta ) => {
					$("#medicamento").focus();
				});
			}
		} else {
			swal({
				text : "Por favor eliga una opción",
				icon : "warning",
				button : "Aceptar"
			}).then( ( acepta ) => {
				$("#frec_enferm").focus();
			});
		}
	} else {
		swal({
			text : "Por favor eliga una opción",
			icon : "warning",
			button : "Aceptar"
		}).then( ( acepta ) => {
			$("#padeces").focus();
		});
	}
}

function editTest(e) {
	e.preventDefault();
	let formEditEnc = document.getElementById('formEditEnc');
	let formDat = new FormData($(formEditEnc)[0]);
	$.ajax({
		url : "../ajax/alm/regTestEnc.php?oper=editTest",
		type : "POST", data : formDat,
		contentType : false, processData : false,
		success : function( resp ) {
			if ( resp == "goodUpd") {
				swal({
					title : "Correcto!...",
					text : "Datos actualizados correctamente",
					icon : "success",
					button : "Aceptar",
					closeOnClickOutside : false,
				}).then( ( acepta ) => {
					location.reload();
				});
			} else if ( resp == "failUpd" ) {
				swal({
					title : "Ocurrio un problema...",
					text : "Los datos no fuerón actualizados",
					icon : "error",
					button : "Aceptar",
					closeOnClickOutside : false
				}).then( ( acepta ) => {
					location.reload();
				});
			} else if ( resp == "malDat" ) {
				location.reload();
			}
		}
	});
}

init();