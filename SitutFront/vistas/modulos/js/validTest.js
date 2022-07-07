//DS = Datos SocioEconomicos
//DP = Datos Personales
//DA = Datos Academicos
/*----------  Funcion select1 DS  ----------*/
function habTest1() {
	let temp = document.getElementById('tiempo');
	let espc = document.getElementById('especifica');
    if ($("#reside").val() == "Si") {
        $("#tiempo").prop("disabled", false);
        $("#tiempo").focus();
        $("#tiempo").addClass("is-valid");
        temp.setAttribute("required","");
        espc.removeAttribute("required");
        $("#tiempo").addClass("is-valid");
        $("#especifica").prop("disabled",true);
        $("#especifica").val("");
        $("#especifica").removeClass("is-valid");
    } else if ($("#reside").val() == "No") {
        $("#especifica").prop("disabled",false);
        $("#especifica").focus();
        $("#especifica").addClass("is-valid");
        espc.setAttribute("required","");
        temp.removeAttribute("required");
        $("#tiempo").prop("disabled", true);
        $("#tiempo").removeClass("is-valid");
        $("#tiempo").val("");
    } else {
    	$("#especifica").prop("disabled",true);
        $("#especifica").val("");
        $("#especifica").removeClass("is-valid");
        $("#tiempo").prop("disabled", true);
        $("#tiempo").removeClass("is-valid");
        $("#tiempo").val("");
        temp.removeAttribute("required");
        espc.removeAttribute("required");
    }
}

/*----------  Funcion select2 DS  ----------*/
function habTest2() {
	let dtrab = document.getElementById('donde_trabajas');
	let itrab = document.getElementById('ingresoTrab');
	let htrab = document.getElementById('horas_tr');
	let idepn = document.getElementById('ingrDependes');
	if ($("#trabajas").val() == "Si") {
		$("#donde_trabajas").prop("disabled", false);
		$("#donde_trabajas").focus();
		$("#donde_trabajas").addClass("is-valid");
		dtrab.setAttribute("required","");
		$("#ingresoTrab").prop("disabled", false);
		$("#ingresoTrab").focus(); 
		$("#ingresoTrab").addClass("is-valid");
		itrab.setAttribute("required","");
		$("#horas_tr").prop("disabled", false);
		$("#horas_tr").focus();
		$("#horas_tr").addClass("is-valid");
		htrab.setAttribute("required", "");
		$("#ingrDependes").prop("disabled", true);
		$("#ingrDependes").val(""); 
		$("#ingrDependes").removeClass("is-valid");
		idepn.removeAttribute("required");
	} else if ($("#trabajas").val() == "No") {
		$("#ingrDependes").prop("disabled", false);
		$("#ingrDependes").focus(); 
		$("#ingrDependes").addClass("is-valid");
		idepn.setAttribute("required", "");
		$("#donde_trabajas").prop("disabled", true); 
		$("#donde_trabajas").val("");
		$("#donde_trabajas").removeClass("is-valid");
		dtrab.removeAttribute("required");
		$("#ingresoTrab").prop("disabled", true); 
		$("#ingresoTrab").val("");
		$("#ingresoTrab").removeClass("is-valid");
		itrab.removeAttribute("required");
		$("#horas_tr").prop("disabled", true);
		$("#horas_tr").val(""); 
		$("#horas_tr").removeClass("is-valid");
		htrab.removeAttribute("required");
	} else {
		$("#ingrDependes").prop("disabled", true);
		$("#ingrDependes").val(""); 
		$("#ingrDependes").removeClass("is-valid");
		idepn.removeAttribute("required");
		$("#donde_trabajas").prop("disabled", true); 
		$("#donde_trabajas").val("");
		$("#donde_trabajas").removeClass("is-valid");
		dtrab.removeAttribute("required");
		$("#ingresoTrab").prop("disabled", true); 
		$("#ingresoTrab").val("");
		$("#ingresoTrab").removeClass("is-valid");
		itrab.removeAttribute("required");
		$("#horas_tr").prop("disabled", true);
		$("#horas_tr").val(""); 
		$("#horas_tr").removeClass("is-valid");
		htrab.removeAttribute("required");
	}
}

/*----------  Funcion select3.0 DP  ----------*/
function habTestP3() {
	let eEnf = document.getElementById('espEnf');
	if ($("#frec_enferm").val() != "0") {
		$("#espEnf").prop("disabled", false);
		$("#espEnf").focus();
		$("#espEnf").addClass("is-valid");
		eEnf.setAttribute("required", "");
	} else {
		$("#espEnf").val("");
		$("#espEnf").prop("disabled", true);
		$("#espEnf").removeClass("is-valid");
		eEnf.removeAttribute("required");
	}
}

/*----------  Funcion select3 DP  ----------*/
function habTest3() {
	let pEnf = document.getElementById('especificaEnf');
	if ($("#padeces").val() == "Si") {
		$("#especificaEnf").prop("disabled", false);
		$("#especificaEnf").focus();
		$("#especificaEnf").addClass("is-valid");
		pEnf.setAttribute("required","");
	} else {
		$("#especificaEnf").val("");
		$("#especificaEnf").prop("disabled", true);
		$("#especificaEnf").removeClass("is-valid");
		pEnf.removeAttribute("required");
	}
}

/*----------  Funcion select4 DP  ----------*/
function habTest4() {
	let cMed = document.getElementById('cualMed');
	if ($("#medicamento").val() == "Si") {
		$("#cualMed").prop("disabled", false);
		$("#cualMed").addClass("is-valid");
		$("#cualMed").focus();
		cMed.setAttribute("required", "");
	} else {
		$("#cualMed").prop("disabled", true);
		$("#cualMed").removeClass("is-valid");
		$("#cualMed").val("");
		cMed.removeAttribute("required");
	}
}

/*----------  Funcion select5 DP  ----------*/
function habTest5() {
	let cFum = document.getElementById('cantidadFum');
	if ($("#fumas").val() == "Si") {
		$("#cantidadFum").prop("disabled", false);
		$("#cantidadFum").addClass("is-valid");
		$("#cantidadFum").focus();
		cFum.setAttribute("required", "");
	} else {
		$("#cantidadFum").prop("disabled", true);
		$("#cantidadFum").removeClass("is-valid");
		$("#cantidadFum").val("");
		cFum.removeAttribute("required");
	}
}

/*----------  Funcion select6 DP  ----------*/
function habTest6() {
	let cBeb = document.getElementById('cantidadBeb');
	if ($("#alchol").val() == "Si") {
		$("#cantidadBeb").prop("disabled", false);
		$("#cantidadBeb").addClass("is-valid");
		$("#cantidadBeb").focus();
		cBeb.setAttribute("required", "");
	} else {
		$("#cantidadBeb").prop("disabled", true);
		$("#cantidadBeb").removeClass("is-valid");
		$("#cantidadBeb").val("");
		cBeb.removeAttribute("required");
	}
}

/*----------  Funcion select7 DA  ----------*/
function habTest7() {
	let mRep = document.getElementById('materiasRep');
	if ($("#reprobado").val() == "Si") {
		$("#materiasRep").prop("disabled", false);
		$("#materiasRep").addClass("is-valid");
		$("#materiasRep").focus();
		mRep.setAttribute("required", "");
	} else {
		$("#materiasRep").prop("disabled", true);
		$("#materiasRep").removeClass("is-valid");
		$("#materiasRep").val("");
		mRep.removeAttribute("required");
	}
}

/*----------  Funcion select8 DA  ----------*/
function habTest8() {
	let cTec = document.getElementById('cualTec');
	if ($("#tecnica").val() == "Si") {
		$("#cualTec").prop("disabled", false);
		$("#cualTec").addClass("is-valid");
		$("#cualTec").focus();
		cTec.setAttribute("required", "");
	} else {
		$("#cualTec").prop("disabled", true);
		$("#cualTec").removeClass("is-valid");
		$("#cualTec").val("");
		cTec.removeAttribute("required");
	}
}

/*----------  Funcion select9 DA  ----------*/
function habTest9() {
	let cLib = document.getElementById('cantLib');
	if ($("#libros").val() == "Si") {
		$("#cantLib").prop("disabled", false);
		$("#cantLib").addClass("is-valid");
		$("#cantLib").focus();
		cLib.setAttribute("required", "");
	} else {
		$("#cantLib").prop("disabled", true);
		$("#cantLib").removeClass("is-valid");
		$("#cantLib").val("");
		cLib.removeAttribute("required");
	}
}




