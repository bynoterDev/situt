function init() {
	$("#formSolicTutoria").on("submit", function(e) {
		regTutPer(e);
	});
	setInterval(function(){
		cantTutPer();
	},800);
}

function cantTutPer() {
    $.ajax({
    	url:'../ajax/alm/almPet.php?oper=cantTutPer',
		type : "POST",
		success:function (data) {
			if (data) {
				$('.listTut').html(data);
				$("#bell").addClass("animated tada");
				$("#dropdownMenuLink2").addClass("text-danger");
				$("#cls2").removeClass("ocult");
				$("#cls2").show();
			} else {
				$("#dropdownMenuLink2").removeClass("text-danger");
				$("#dropdownMenuLink2").addClass("text-primary");
				$("#cls2").hide();
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
				url : "../ajax/alm/almPet.php?oper=regTutPer",
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