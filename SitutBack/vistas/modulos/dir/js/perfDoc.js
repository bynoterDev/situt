function init() {
	$("#newContDoc").on("keyup", function(){
		segCont2();
		contIgul2();
	});
	$("#repContNewDoc").on("keyup", function(){
		contIgul2();
	});
	$("#formNewContDoc").on("submit", function(e){
		confNCDoc(e);
	});
	$("#btnCloseNewContDoc").on("click", function(){
		limpCampNC();
	});
}

function segCont2() {
	let mayus = new RegExp("^(?=.*[A-Z])");
	let lower = new RegExp("^(?=.*[a-z])");
	let len = new RegExp("^(?=.{8,})");
	let numbers = new RegExp("^(?=.*[0-9])");
	let newCont = $("#newContDoc").val();
	if (mayus.test(newCont) && lower.test(newCont) && numbers.test(newCont) && len.test(newCont)) {
		$("#mensajed1").text("Seguridad Alta").css("color","green");
		$("#mensajed1").show(1000);
	} else if (mayus.test(newCont) && numbers.test(newCont) && len.test(newCont) 
		|| lower.test(newCont) && numbers.test(newCont) && len.test(newCont)) {
		$("#mensajed1").text("Seguridad Media").css("color","orange");
		$("#mensajed1").show(1000);
	} else if (mayus.test(newCont) && len.test(newCont) 
		|| lower.test(newCont) && len.test(newCont) 
		|| numbers.test(newCont) && len.test(newCont)
		|| numbers.test(newCont)
		|| mayus.test(newCont)
		|| lower.test(newCont)) {
		$("#mensajed1").text("Seguridad Baja").css("color","red");
		$("#mensajed1").show(1000);
	} else {
		$("#mensajed1").text("");
		$("#mensajed1").hide(1000);
	}
}

function contIgul2() {
	let newCont = $("#newContDoc").val();
	let repCont = $("#repContNewDoc").val();
	if (repCont.length > 0) {
		if (repCont === newCont) {
			$("#mensajed2").text("Las contraseñas coinciden").css({"color":"green"}).show();
			$("#btnNewContDoc").prop("disabled",false);
		} else {
			$("#mensajed2").text("Las contraseñas no coinciden").css({"color":"red"}).show();
			$("#btnNewContDoc").prop("disabled",true);
		}
	} else {
		$("#mensajed2").text("").hide();
	}
}

function activarTut(id_docente) {
	swal({
		title: "Esta seguro?",
		text: "De activar al tutor?",
		icon: "warning",
		dangerMode : true,
		buttons: true
	}).then((acepta)=>{
		if (acepta) {
			$.post("../ajax/dir/tutoresDat.php?oper=activarTut",
				{id_docente : id_docente},
				function(resp){
					if ( resp == 1) {
						swal({
							title : "Correcto",
							text : "Cuenta Activada",
							icon : "success",
							button : "Aceptar",
							closeOnClickOutside : false
						}).then( ( acepta ) => {
							location.reload();
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

function desactivarTut(id_docente) {
	swal({
		title: "Esta seguro?",
		text: "De desactivar al tutor?",
		icon: "warning",
		dangerMode : true,
		buttons: true
	}).then((acepta)=>{
		if (acepta) {
			$.post("../ajax/dir/tutoresDat.php?oper=desactivarTut",
				{id_docente : id_docente},
				function(resp){
					if ( resp == 1) {
						swal({
							title : "Correcto",
							text : "Cuenta Desactivada",
							icon : "success",
							button : "Aceptar",
							closeOnClickOutside : false
						}).then( ( acepta ) => {
							location.reload();
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

function limpCampNC() {
	$("#newContDoc").val("");
	$("#repContNewDoc").val("");
	$("#contDirConf").val("");
	$("#mensajed1").hide();
	$("#mensajed2").hide();
}

function confNCDoc(e) {
	e.preventDefault();
	let formNewContDoc = document.getElementById('formNewContDoc'), 
	formDat = new FormData($(formNewContDoc)[0]), newContDoc = $("#newContDoc").val(),
	repContNewDoc = $("#repContNewDoc").val(), contDirConf = $("#contDirConf").val();
	if (newContDoc.length > 0) {
		if (repContNewDoc.length > 0) {
			if (contDirConf.length > 0) {
				swal({
					title : "Esta seguro?",
					text : "De cambiar la contraseña?",
					icon : "warning",
					buttons : true
				}).then( ( acepta ) => {
					if (acepta) {
						$.ajax({
							url : "../ajax/dir/tutoresDat.php?oper=confNCDoc",
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
									limpCamp();
								} else if ( resp === "failCont" ) {
									swal({
										text : "La contraseña actual no es correcta",
										icon : "warning",
										button : "Aceptar"
									});
									$("#contDirConf").val("");
									$("#contDirConf").focus();
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
					$("#contDirConf").focus();
				});
			}
		} else {
			swal({
				text : "Repite la nueva contraseña",
				icon : "warning",
				button : "Aceptar"
			}).then( ( acepta ) =>{
				$("#repContNewDoc").focus();
			});
		}
	} else {
		swal({
			text : "Introduce la nueva contraseña",
			icon : "warning",
			button : "Aceptar"
		}).then( ( acepta ) =>{
			$("#newContDoc").focus();
		});
	}
}

init();