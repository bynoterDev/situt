function init() {
	$("#formEditDarPer").on("submit", function(e){
		editDatPer(e);
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

function editDatPer(e) {
	e.preventDefault();
	let formEditDarPer = document.getElementById('formEditDarPer');
	let formDat = new FormData($(formEditDarPer)[0]);
	$.ajax({
		url : "../../ajax/alm/almPet.php?oper=editDatPer",
		type : "POST", data : formDat,
		contentType : false, processData : false,
		success : function( resp ) {
			if ( resp === "goodUpd") {
				swal({
					title : "Correcto!...",
					text : "Los datos han sido actualizados",
					icon : "success",
					button : "Aceptar"
				}).then( ( acepta ) => {
					location.reload();
				});
			} else if ( resp === "failUpd") {
				swal({
					title : "Ocurrio un problema",
					text : "No se completo la actualización, reporte el problema a su docente",
					icon : "error",
					button : "Aceptar"
				}).then( ( acepta ) => {
					$("#datPerAlmEdit").modal('hide');
				});
			} else {
				location.reload();
			}
		}
	});
}

init();