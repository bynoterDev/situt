function init() {
	$("#formDatPerAlm").on("submit",function(e){
		regDatPerf(e);
	});
}

function curpValida(curp) {
    var re = /^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/,
        validado = curp.match(re);
    if (!validado)  //Coincide con el formato general?
    	return false;
    //Validar que coincida el dígito verificador
    function digitoVerificador(curp17) {
        //Fuente https://consultas.curp.gob.mx/CurpSP/
        var diccionario  = "0123456789ABCDEFGHIJKLMNÑOPQRSTUVWXYZ",
            lngSuma      = 0.0,
            lngDigito    = 0.0;
        for(var i=0; i<17; i++)
            lngSuma = lngSuma + diccionario.indexOf(curp17.charAt(i)) * (18 - i);
        	lngDigito = 10 - lngSuma % 10;
        	if (lngDigito == 10) return 0;
        	return lngDigito;
    }
    if (validado[2] != digitoVerificador(validado[1])) 
    	return false;  
    return true; //Validado
}

//Handler para el evento cuando cambia el input
//Lleva la CURP a mayúsculas para validarlo
function validarInput(input) {
    var curp = input.value.toUpperCase(),
        resultado = document.getElementById("resultado"),
        valido = "No válido";     
    if (curpValida(curp)) { 
    	$("#curpDat").removeClass('is-invalid');
    	$("#btnGDatPer").prop("disabled", false);
    } else {
    	$("#curpDat").addClass("is-invalid");
    	$("#btnGDatPer").prop("disabled",true);
    }
}

function regDatPerf(e) {
	e.preventDefault();
	let formDatPerAlm = document.getElementById('formDatPerAlm');
	let formDat = new FormData($(formDatPerAlm)[0]);
	let estCiv = document.getElementById('estCiv');
	if (estCiv.value != "0") {
		$.ajax({
			url : "../../ajax/alm/almPet.php?oper=regDatPerf",
			type : "POST", data : formDat,
			contentType : false, processData : false,
			success : function( resp ) {
				if ( resp === "goodIns") {
					swal({
						title : "Correcto!...",
						text : "Datos registrados correctamente",
						icon : "success",
						button : "Aceptar"
					}).then(( acepta ) => {
						location.reload();
					});
				} else if ( resp === "failIns" ) {
					swal({
						title : "Ocurrio un problema",
						text : "No se completo el registro",
						icon : "error",
						button : "Aceptar" 
					}).then( ( acepta ) => {
						limpCampos();
					});
				} else if ( resp === "extDat" ) {
					location.reload();
				} else if ( resp === "extCurp" ) {
					swal({
						text : "Ya existe una curp registrada",
						icon : "warning",
						button : "Aceptar"
					}).then( ( acepta ) => {
						$("#curpDat").focus();
						$("#curpDat").val();
					});
				} else if ( resp == "extNumS" ) {
					swal({
						text : "Ya existe una curp registrada",
						icon : "warning",
						button : "Aceptar"
					}).then( ( acepta ) => {
						$("#numSegSocial").focus();
						$("#numSegSocial").val();
					});
				} else {
					console.log(resp);
				}
			}
		});
	} else {
		swal({
			text : "Selecciona tu estado civil",
			icon : "warning",
			button : "Aceptar"
		}).then( ( acepta ) => {
			$("#estCiv").focus();
		});
	}
}

init();