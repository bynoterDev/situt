function init(){
	$("#formSolicJustif").on("submit", function(e){
		regJustif(e);
	});
	justCantTot();
	justCantCut();
	justCantAcept();
	justCantRech();
	cantNotifJust();
	/*setInterval(function(){
		cantNotifJust();
		justCantTot();
		justCantCut();
		justCantAcept();
		justCantRech();
	},800);*/
}

function justCantTot() {
	$.ajax({
    	url:'../../ajax/alm/almPet.php?oper=justCantTot',
		type : "POST",
		success:function (data) {
			$("#justCantTot").text(data);
		}
    });
    //requestAnimationFrame(justCantTot);
}

function justCantCut() {
	$.ajax({
    	url:'../../ajax/alm/almPet.php?oper=justCantCut',
		type : "POST",
		success:function (data) {
			$("#justCantCut").text(data);
		}
    });
    //requestAnimationFrame(justCantCut);
}

function justCantAcept() {
	$.ajax({
    	url:'../../ajax/alm/almPet.php?oper=justCantAcept',
		type : "POST",
		success:function (data) {
			$("#justCantAcept").text(data);
		}
    });
    //requestAnimationFrame(justCantAcept);
}

function justCantRech() {
	$.ajax({
    	url:'../../ajax/alm/almPet.php?oper=justCantRech',
		type : "POST",
		success:function (data) {
			$("#justCantRech").text(data);
		}
    });
    //requestAnimationFrame(justCantRech);
}

function cantNotifJust() {
    $.ajax({
    	url:'../../ajax/alm/almPet.php?oper=cantNotifJust',
		type : "POST",
		success:function (data) {
			if (data) {
				$('.listNot').html(data);
				$("#bell").addClass("text-danger");
			} else {
				$("#bell").removeClass("text-danger");
				$('.listNot').text("");
			}
		}
    });
    //requestAnimationFrame(cantNotifJust);
}

function regJustif(e) {
	e.preventDefault();
	let formSolicJustif = document.getElementById('formSolicJustif');
	let formDat = new FormData($(formSolicJustif)[0]);
	let extPerm = /(.jpg)$/i, extPerm1 = /(.jpeg)$/i, extPerm2 = /(.png)$/i, extPerm3 = /(.pdf)$/i;
	let sitJustif = $("#sitJustif").val(), archJustif = document.getElementById('archJustif').value,
	fechJustif = $("#fechJustif").val();
	if (sitJustif.length > 0) {
		if (archJustif.length > 0) {
			if (!extPerm.exec(archJustif) && !extPerm1.exec(archJustif) && !extPerm2.exec(archJustif) 
				&& !extPerm3.exec(archJustif)) {
				//console.log('Archivo incorrecto');
				$("#archJustif").val("");
			}
		} 
		if (fechJustif.length > 0) {
			$.ajax({
				url : "../../ajax/alm/almPet.php?oper=regJustif",
				type : "POST", data : formDat, 
				contentType : false, processData : false,
				success : function( resp ) {
					if ( resp === "goodIns" ) {
						swal({
							title : "Correcto...!",
							text : "La solicitud de justificante ah sido enviada",
							icon : "success",
							button : false
						});
						setTimeout(function() {
							location.reload();
						}, 2000);
					} else if ( resp === "failIns" ) {
						swal({
							title : "Ocurrio un problema :(",
							text : "No se pudo enviar la solicitud",
							icon : "error",
							button : "Aceptar"
						}).then( ( acepta ) => {
							$("#sitJustif").val("");
							$("#archJustif").val("");
							$("#fechJustifh").val("");
						});
					}
				}
			});
		} else {
			swal({
				text : "Selecciona la fecha que faltaste",
				icon : "warning",
				button : "Aceptar"
			}).then( ( acepta ) => {
				$("#fechJustif").focus();
			});
		}
	} else {
		swal({
			text : "Introduce la situación del porque faltaste",
			icon : "warning",
			button : "Aceptar"
		}).then( ( acepta ) => {
			$("#sitJustif").focus();
		});
	}
}

init();