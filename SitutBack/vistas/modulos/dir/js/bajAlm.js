let tablaAlmBaj;
function init() {
	$(window).scroll(function() {
	  if ($("#menu1").offset().top > 56) {
	      $("#menu1").addClass("bg-info");
	  } else {
	      $("#menu1").removeClass("bg-info");
	  }
	});
	$(window).scroll(function(){
		if ($("#menu2").offset().top > 56) {
	      $("#menu2").addClass("bg-info");
	      $("#textLog").text("U T S E M");
	  } else {
	      $("#menu2").removeClass("bg-info");
	      $("#textLog").text("S I T U T");
	  }
	});
	listarAlmBaj();
}

function listarAlmBaj() {
	tablaAlmBaj = $("#tbListadoAlumnosBaj").dataTable({
		"aProcessing" : true,
		"aServerSide" : true,
		dom : 'Bftrip',
		buttons: [
		],
		"ajax" : {
			url : "../ajax/dir/almCarDir.php?oper=listarAlmBaj",
			type : "GET",
			dataType : "json",
			error : function(e) {
				console.log(e.responseText);
			}
		},
		"bDestroy" : true,
		"iDisplayLength" : 5
		// "order" : [[0, "desc"]]
	}).DataTable();
}

init();