let tablaAlmInact;
function init() {
	mostDatGrp(true);
}

function activarAlm(id_alumno) {
	swal({
		title : "Esta seguro?",
		text : "De activar la cuenta del alumno?",
		icon : "warning",
		buttons : true,
		closeOnClickOutside : false
	}).then( ( acepta ) => {
		if (acepta) {
			$.post("../../../ajax/dir/almCarDir.php?oper=activarAlm",
				{id_alumno : id_alumno},
				function(e) {
					swal({
						text : e,
						buttons : false,
						closeOnClickOutside : false
					});
					setTimeout(function(){
						location.reload();
					}, 1500);
				});
		} else {
			swal("Proceso cancelado");
		}
	});
}

function desactivarAlm(id_alumno) {
	swal({
		title : "Esta seguro?",
		text : "De desactivar la cuenta del alumno?",
		icon : "warning",
		buttons : true,
		closeOnClickOutside : false
	}).then( ( acepta ) => {
		if (acepta) {
			$.post("../../../ajax/dir/almCarDir.php?oper=desactivarAlm",
				{id_alumno : id_alumno},
				function(e) {
					swal({
						text : e,
						buttons : false,
						closeOnClickOutside : false
					});
						setTimeout(function(){
							location.reload();
						}, 1500);
				});
		} else {
			swal("Proceso cancelado");
		}
	});
}

function mostDatGrp(flag) {
	if (flag) {
		$("#mostDatGrp").removeClass("ocult");
		$("#mostDatGrp").fadeIn();
		$("#btnDatGrp").removeClass("bg-white");
		$("#btnDatGrp").removeClass("text-primary");
		$("#btnDatGrp").addClass("bg-primary");
		$("#btnDatGrp").addClass("text-white");
	} else {
		$("#mostDatGrp").addClass("ocult");
		$("#mostDatGrp").fadeOut();
		$("#btnDatGrp").removeClass("bg-primary");
		$("#btnDatGrp").removeClass("text-white");
		$("#btnDatGrp").addClass("bg-white");
		$("#btnDatGrp").addClass("text-primary");
	}
}

function mostJustif(flag) {
	if (flag) {
		$("#mostJustif").removeClass("ocult");
		$("#mostJustif").fadeIn();
		$("#btnJustif").removeClass("bg-white");
		$("#btnJustif").removeClass("text-primary");
		$("#btnJustif").addClass("bg-primary");
		$("#btnJustif").addClass("text-white");
	} else {
		$("#mostJustif").addClass("ocult");
		$("#mostJustif").fadeOut();
		$("#btnJustif").removeClass("bg-primary");
		$("#btnJustif").removeClass("text-white");
		$("#btnJustif").addClass("bg-white");
		$("#btnJustif").addClass("text-primary");
	}
}

function mostDatPer(flag) {
	if (flag) {
		$("#mostDatPer").removeClass("ocult");
		$("#mostDatPer").fadeIn();
		$("#btnDatPer").removeClass("bg-white");
		$("#btnDatPer").removeClass("text-primary");
		$("#btnDatPer").addClass("bg-primary");
		$("#btnDatPer").addClass("text-white");
	} else {
		$("#mostDatPer").addClass("ocult");
		$("#mostDatPer").fadeOut();
		$("#btnDatPer").removeClass("bg-primary");
		$("#btnDatPer").removeClass("text-white");
		$("#btnDatPer").addClass("bg-white");
		$("#btnDatPer").addClass("text-primary");
	}
}

function mostDatHist(flag) {
	if (flag) {
		$("#mostDatHist").removeClass("ocult");
		$("#mostDatHist").fadeIn();
		$("#btnDatHist").removeClass("bg-white");
		$("#btnDatHist").removeClass("text-primary");
		$("#btnDatHist").addClass("bg-primary");
		$("#btnDatHist").addClass("text-white");
	} else {
		$("#mostDatHist").addClass("ocult");
		$("#mostDatHist").fadeOut();
		$("#btnDatHist").removeClass("bg-primary");
		$("#btnDatHist").removeClass("text-white");
		$("#btnDatHist").addClass("bg-white");
		$("#btnDatHist").addClass("text-primary");
	}
}

init();