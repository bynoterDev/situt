function init() {
	//Carreras//
	cantTotCar();
	//Docentes//
	cantTotDoc();
	//Directores//
	cantTotDir();
	//Alumnos//
	cantTotAlm();
	//Coordinadores//
	cantTotCor();
	//Justificantes//
	cantJusTot();
	//Bajas//
	cantTotBaj();
	//Encuestas//
	cantTotTest();
}

/*----------  Carreras Cantidades  ----------*/
function cantTotCar() {
    $.ajax({
    	url:'../../ajax/adm/notifPanel.php?oper=cantTotCar',
		type : "POST",
		success:function (data) {
			$('#cantTotCar').text(data);
		}
    });
}
/*function cantTotCarAct() {
	$.ajax({
    	url:'../../ajax/adm/notifPanel.php?oper=cantTotCarAct',
		type : "POST",
		success:function (data) {
			$('#cantTotCarAct').text(data);
		}
    });
}*/
/*function cantTotCarDes() {
	$.ajax({
    	url:'../../ajax/adm/notifPanel.php?oper=cantTotCarDes',
		type : "POST",
		success:function (data) {
			$('#cantTotCarDes').text(data);
		}
    });
}*/

/*----------  Cantidad Docentes  ----------*/
function cantTotDoc() {
	$.ajax({
    	url:'../../ajax/adm/notifPanel.php?oper=cantTotDoc',
		type : "POST",
		success:function (data) {
			$('#cantTotDoc').text(data);
		}
    });
}
/*function cantTotDocAct() {
	$.ajax({
    	url:'../../ajax/adm/notifPanel.php?oper=cantTotDocAct',
		type : "POST",
		success:function (data) {
			$('#cantTotDocAct').text(data);
		}
    });
}*/
/*function cantTotDocDes() {
	$.ajax({
    	url:'../../ajax/adm/notifPanel.php?oper=cantTotDocDes',
		type : "POST",
		success:function (data) {
			$('#cantTotDocDes').text(data);
		}
    });
}*/

/*----------  Cantidad Directores  ----------*/
function cantTotDir() {
	$.ajax({
    	url:'../../ajax/adm/notifPanel.php?oper=cantTotDir',
		type : "POST",
		success:function (data) {
			$('#cantTotDir').text(data);
		}
    });
}
/*function cantTotDirAct() {
	$.ajax({
    	url:'../../ajax/adm/notifPanel.php?oper=cantTotDirAct',
		type : "POST",
		success:function (data) {
			$('#cantTotDirAct').text(data);
		}
    });
}*/
/*function cantTotDirDes() {
	$.ajax({
    	url:'../../ajax/adm/notifPanel.php?oper=cantTotDirDes',
		type : "POST",
		success:function (data) {
			$('#cantTotDirDes').text(data);
		}
    });
}*/
/*----------  Cantidad Alumnos  ----------*/
function cantTotAlm() {
	$.ajax({
    	url:'../../ajax/adm/notifPanel.php?oper=cantTotAlm',
		type : "POST",
		success:function (data) {
			$('#cantTotAlm').text(data);
		}
    });
}
/*function cantTotAlmAct() {
	$.ajax({
    	url:'../../ajax/adm/notifPanel.php?oper=cantTotAlmAct',
		type : "POST",
		success:function (data) {
			$('#cantTotAlmAct').text(data);
		}
    });
}
function cantTotAlmDes() {
	$.ajax({
    	url:'../../ajax/adm/notifPanel.php?oper=cantTotAlmDes',
		type : "POST",
		success:function (data) {
			$('#cantTotAlmDes').text(data);
		}
    });
}*/

function cantTotCor() {
	$.ajax({
    	url:'../../ajax/adm/notifPanel.php?oper=cantTotCor',
		type : "POST",
		success:function (data) {
			$('#cantTotCor').text(data);
		}
    });
}

/*function cantCorAct() {
	$.ajax({
    	url:'../../ajax/adm/notifPanel.php?oper=cantCorAct',
		type : "POST",
		success:function (data) {
			$('#cantCorAct').text(data);
		}
    });
}

function cantCorDes() {
	$.ajax({
    	url:'../../ajax/adm/notifPanel.php?oper=cantCorDes',
		type : "POST",
		success:function (data) {
			$('#cantCorDes').text(data);
		}
    });
}*/

function cantJusTot() {
	$.ajax({
    	url:'../../ajax/adm/notifPanel.php?oper=cantJusTot',
		type : "POST",
		success:function (data) {
			$('#cantJusTot').text(data);
		}
    });
}

/*function cantJusAct() {
	$.ajax({
    	url:'../../ajax/adm/notifPanel.php?oper=cantJusAct',
		type : "POST",
		success:function (data) {
			$('#cantJusAct').text(data);
		}
    });
}

function cantJusDes() {
	$.ajax({
    	url:'../../ajax/adm/notifPanel.php?oper=cantJusDes',
		type : "POST",
		success:function (data) {
			$('#cantJusDes').text(data);
		}
    });
}*/

function cantTotBaj() {
	$.ajax({
    	url:'../../ajax/adm/notifPanel.php?oper=cantTotBaj',
		type : "POST",
		success:function (data) {
			$('#cantTotBaj').text(data);
		}
    });
}

function cantTotTest() {
	$.ajax({
    	url:'../../ajax/adm/notifPanel.php?oper=cantTotTest',
		type : "POST",
		success:function (data) {
			$('#cantTotTest').text(data);
		}
    });
}
init();