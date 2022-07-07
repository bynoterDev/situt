let tablaalm;

function init() {
	listadoHistorial();
}

function listadoHistorial() {
	tablaalm = $("#tbListadoHistorial").dataTable({
		"aProcessing" : true,
		"aServerSide" : true,
		dom : 'Bftrip',
		buttons: [
		],
		"ajax" : {
			url : "../ajax/doc/functGrpAlm.php?oper=listadoHistorial",
			type : "GET",
			dataType : "json",
			error : function(e) {
				console.log(e.responseText);
			}
		},
		"bDestroy" : true,
		"iDisplayLength" : 5,
		"order" : [[0, "desc"]]
	}).DataTable();
}

init();