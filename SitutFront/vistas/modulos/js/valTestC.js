function init() {
	$("#btnV1").on("click", function(e) {
		valTestP1(e);
	});
	$("#btnV2").on("click", function(e) {
		valTestP2(e);
	});
	$("#formRegTest").on("submit", function(e) {
		valTestP3F(e);
	});
}

function valTestP1(e) {
	e.preventDefault();
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
							$("#pills-profile-tab").removeClass("disabled");
							$("#pills-profile-tab").tab("show");
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

function valTestP2(e) {
	e.preventDefault();
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
											$("#pills-contact-tab").removeClass("disabled");
											$("#pills-contact-tab").tab("show");
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

function envDatTest(){
	let formRegTest = document.getElementById('formRegTest');
	let formDat = new FormData($(formRegTest)[0]);
	$.ajax({
		url : "../ajax/alm/regTestEnc.php?oper=envDatTest",
		type : "POST", data : formDat,
		contentType : false, processData : false,
		success : function( resp ) {
			if ( resp === "goodIns" ) {
				swal({
					title : "Correcto!...",
					text : "Los datos han sido insertados",
					icon : "success", 
					button : "Aceptar"
				}).then( ( acepta ) => {
					$(location).attr("href","Index.php");
				});
			} else if ( resp === "failIns" ) {
				swal({
					title : "Ocurrio un problema...",
					text : "Datos no insertados",
					icon : "success",
					button : "Aceptar"
				}).then( ( acepta ) => {
					$(location).attr("href","Index.php");
				});
			} else {
				$(location).attr("href","Index.php");
			}
		}
	});
}

function valTestP3F(e) {
	e.preventDefault();
	if ($("#turno").val() != "0") {
		if ($("#opcionUni").val() != "0") {
			if ($("#opcionCar").val() != "0") {
				if ($("#reprobado").val() != "0") {
					if ($("#tecnica").val() != "0") {
						if ($("#libros").val() != "0") {
							if ($("#computadora").val() != "0") {
								$("#valdat").modal("show");
								setTimeout(function() {
									$("#textdat").text("Todo correcto!...");
									setTimeout(function() {
										$("#valdat").modal("hide");
										setTimeout(function() {
											envDatTest();
										}, 1000);
									}, 1500);
								}, 3000);
							} else {
								swal({
									text : "Por favor eliga una opción",
									icon : "warning",
									button : "Aceptar"
								}).then( ( acepta ) => {
									$("#computadora").focus();
								});
							}
						} else {
							swal({
								text : "Por favor eliga una opción",
								icon : "warning",
								button : "Aceptar"
							}).then( ( acepta ) => {
								$("#libros").focus();
							});
						}
					} else {
						swal({
							text : "Por favor eliga una opción",
							icon : "warning",
							button : "Aceptar"
						}).then( ( acepta ) => {
							$("#tecnica").focus();
						});
					}
				} else {
					swal({
						text : "Por favor eliga una opción",
						icon : "warning",
						button : "Aceptar"
					}).then( ( acepta ) => {
						$("#reprobado").focus();
					});
				}
			} else {
				swal({
					text : "Por favor eliga una opción",
					icon : "warning",
					button : "Aceptar"
				}).then( ( acepta ) => {
					$("#opcionCar").focus();
				});
			}
		} else {
			swal({
				text : "Por favor eliga una opción",
				icon : "warning",
				button : "Aceptar"
			}).then( ( acepta ) => {
				$("#opcionUni").focus();
			});
		}
	} else {
		swal({
			text : "Por favor eliga una opción",
			icon : "warning",
			button : "Aceptar"
		}).then( ( acepta ) => {
			$("#turno").focus();
		});
	}
}

init();