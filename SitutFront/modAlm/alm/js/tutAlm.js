function init() {
	$("#formSolicTutoria").on("submit", function(e) {
		regTutPer(e);
	});
	cantTutPer();
	// setInterval(function(){
	// 	cantTutPer();
	// },800);
}

function cantTutPer() {
    $.ajax({
    	url:'../../ajax/alm/almPet.php?oper=cantTutPer',
		type : "POST",
		success:function (data) {
			if (data) {
				$('.listTut').html(data);
				$("#bell2").addClass("text-danger");
			} else {
				$("#bell2").removeClass("text-danger");
				$('.listTut').text("");
			}
		}
    });
}

function regTutPer(e) {
	e.preventDefault();
	let formSolicTutoria = document.getElementById('formSolicTutoria'),
	formDat = new FormData($(formSolicTutoria)[0]), razTut = $("#razTut").val(),
	priodTut = document.getElementById('priodTut');
	if (razTut.length > 0) {
		if (priodTut.value != "0") {
			$.ajax({
				url : "../../ajax/alm/almPet.php?oper=regTutPer",
				type : "POST", data : formDat, 
				contentType : false, processData : false,
				success : function( resp ) {
					if ( resp === "goodIns" ) {
						swal({
							title : "Solicitud de tutoría enviada...",
							text : "Ahora espera a que el tutor la acepte",
							icon : "success",
							button : "Aceptar",
							closeOnClickOutside: false
						}).then( ( acepta ) => {
							location.reload();
						});
					} else if ( resp === "failIns" ) {
						swal({
							title : "Ocurrio un problema",
							text : "Solicitud no enviada",
							icon : "error",
							button : "Aceptar"
						});
						$("#razTut").val("");
					} else {
						console.log( resp );
					}
				}
			});
		} else {
			swal({
				text : "Selecciona una prioridad del porque solicita una tutoría",
				icon : "warning",
				button : "Aceptar",
				closeOnClickOutside : false,
			}).then( ( acepta ) => {
				$("#priodTut").focus();
			});
		}
	} else {
		swal({
			text : "Introduzca la razón del porque solicita una tutoría",
			icon : "warning",
			button : "Aceptar",
			closeOnClickOutside : false,
		}).then( ( acepta ) => {
			$("#razTut").focus();
		});
	}
}

init();