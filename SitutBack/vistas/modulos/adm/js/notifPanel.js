function init() {
	setInterval(function(){
		//Carreras//
		cantTotCar();
		cantTotCarAct();
		cantTotCarDes();
		//Docentes//
		cantTotDoc();
		cantTotDocAct();
		cantTotDocDes();
		//Directores//
		cantTotDir();
		cantTotDirAct();
		cantTotDirDes();
		//Alumnos//
		cantTotAlm();
		cantTotAlmAct();
		cantTotAlmDes();
		//Coordinadores//
		cantTotCor();
		cantCorAct();
		cantCorDes();
		//Justificantes//
		cantJusTot();
		cantJusAct();
		cantJusDes();
		//Bajas//
		cantTotBaj();
		//Encuestas//
		cantTotTest();
		//console.log("Hola Mundo!....");
	}, 10000);
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
	/*setInterval(function(){
		animIcons();
	},3000);*/
	/*setInterval(function(){
		$("#infoInd").addClass("animated bounce");
		setTimeout(function(){
			$("#infoInd").removeClass("animated bounce");
		}, 2500);
	},5000);*/
}

/*----------  Animacion iconos  ----------*/
function animIcons() {
	//$("#cantTotCar").addClass("animated bounce");
	$("#icoCar").addClass("animated jackInTheBox");
	$("#icoDoc").addClass("animated jackInTheBox");
	$("#icoDir").addClass("animated jackInTheBox");
	$("#icoAlm").addClass("animated jackInTheBox");
	$("#icoCor").addClass("animated jackInTheBox");
	setTimeout(function() {
		//$("#cantTotCar").removeClass("animated bounce");
		$("#icoCar").removeClass("animated jackInTheBox");
		$("#icoDoc").removeClass("animated jackInTheBox");
		$("#icoDir").removeClass("animated jackInTheBox");
		$("#icoAlm").removeClass("animated jackInTheBox");
		$("#icoCor").removeClass("animated jackInTheBox");
	}, 2000);
}

/*----------  Carreras Cantidades  ----------*/
function cantTotCar() {
    $.ajax({
    	url:'../ajax/adm/notifPanel.php?oper=cantTotCar',
		type : "POST",
		success:function (data) {
			$('#cantTotCar').text(data);
		}
    });
}
function cantTotCarAct() {
	$.ajax({
    	url:'../ajax/adm/notifPanel.php?oper=cantTotCarAct',
		type : "POST",
		success:function (data) {
			$('#cantTotCarAct').text(data);
		}
    });
}
function cantTotCarDes() {
	$.ajax({
    	url:'../ajax/adm/notifPanel.php?oper=cantTotCarDes',
		type : "POST",
		success:function (data) {
			$('#cantTotCarDes').text(data);
		}
    });
}

/*----------  Cantidad Docentes  ----------*/
function cantTotDoc() {
	$.ajax({
    	url:'../ajax/adm/notifPanel.php?oper=cantTotDoc',
		type : "POST",
		success:function (data) {
			$('#cantTotDoc').text(data);
		}
    });
}
function cantTotDocAct() {
	$.ajax({
    	url:'../ajax/adm/notifPanel.php?oper=cantTotDocAct',
		type : "POST",
		success:function (data) {
			$('#cantTotDocAct').text(data);
		}
    });
}
function cantTotDocDes() {
	$.ajax({
    	url:'../ajax/adm/notifPanel.php?oper=cantTotDocDes',
		type : "POST",
		success:function (data) {
			$('#cantTotDocDes').text(data);
		}
    });
}

/*----------  Cantidad Directores  ----------*/
function cantTotDir() {
	$.ajax({
    	url:'../ajax/adm/notifPanel.php?oper=cantTotDir',
		type : "POST",
		success:function (data) {
			$('#cantTotDir').text(data);
		}
    });
}
function cantTotDirAct() {
	$.ajax({
    	url:'../ajax/adm/notifPanel.php?oper=cantTotDirAct',
		type : "POST",
		success:function (data) {
			$('#cantTotDirAct').text(data);
		}
    });
}
function cantTotDirDes() {
	$.ajax({
    	url:'../ajax/adm/notifPanel.php?oper=cantTotDirDes',
		type : "POST",
		success:function (data) {
			$('#cantTotDirDes').text(data);
		}
    });
}
/*----------  Cantidad Alumnos  ----------*/
function cantTotAlm() {
	$.ajax({
    	url:'../ajax/adm/notifPanel.php?oper=cantTotAlm',
		type : "POST",
		success:function (data) {
			$('#cantTotAlm').text(data);
		}
    });
}
function cantTotAlmAct() {
	$.ajax({
    	url:'../ajax/adm/notifPanel.php?oper=cantTotAlmAct',
		type : "POST",
		success:function (data) {
			$('#cantTotAlmAct').text(data);
		}
    });
}
function cantTotAlmDes() {
	$.ajax({
    	url:'../ajax/adm/notifPanel.php?oper=cantTotAlmDes',
		type : "POST",
		success:function (data) {
			$('#cantTotAlmDes').text(data);
		}
    });
}
function cantTotCor() {
	$.ajax({
    	url:'../ajax/adm/notifPanel.php?oper=cantTotCor',
		type : "POST",
		success:function (data) {
			$('#cantTotCor').text(data);
		}
    });
}

function cantCorAct() {
	$.ajax({
    	url:'../ajax/adm/notifPanel.php?oper=cantCorAct',
		type : "POST",
		success:function (data) {
			$('#cantCorAct').text(data);
		}
    });
}

function cantCorDes() {
	$.ajax({
    	url:'../ajax/adm/notifPanel.php?oper=cantCorDes',
		type : "POST",
		success:function (data) {
			$('#cantCorDes').text(data);
		}
    });
}

function cantJusTot() {
	$.ajax({
    	url:'../ajax/adm/notifPanel.php?oper=cantJusTot',
		type : "POST",
		success:function (data) {
			$('#cantJusTot').text(data);
		}
    });
}

function cantJusAct() {
	$.ajax({
    	url:'../ajax/adm/notifPanel.php?oper=cantJusAct',
		type : "POST",
		success:function (data) {
			$('#cantJusAct').text(data);
		}
    });
}

function cantJusDes() {
	$.ajax({
    	url:'../ajax/adm/notifPanel.php?oper=cantJusDes',
		type : "POST",
		success:function (data) {
			$('#cantJusDes').text(data);
		}
    });
}

function cantTotBaj() {
	$.ajax({
    	url:'../ajax/adm/notifPanel.php?oper=cantTotBaj',
		type : "POST",
		success:function (data) {
			$('#cantTotBaj').text(data);
		}
    });
}

function cantTotTest() {
	$.ajax({
    	url:'../ajax/adm/notifPanel.php?oper=cantTotTest',
		type : "POST",
		success:function (data) {
			$('#cantTotTest').text(data);
		}
    });
}
init();