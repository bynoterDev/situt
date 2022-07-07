/*----------  VARIABLES  ----------*/

let formAdmin = document.getElementById('formAdmin');
let btnAdm = document.getElementById('btnAdm');
let btnCor = document.getElementById('btnCor');
let btnDir = document.getElementById('btnDir');
let btnDoc = document.getElementById('btnDoc');

const 
	classSha = "cardShadow",
	card1 = document.querySelector("#cardSh"), 
	card2 = document.querySelector("#cardSh1"),
	card3 = document.querySelector("#cardSh2"), 
	card4 = document.querySelector("#cardSh3"),
	card5 = document.querySelector("#cardSh4");

const 
	txtInfo = "text-info", 
	anim = "animated", 
	animElig = "jackInTheBox",
	ses1 = document.querySelector("#ses1"), 
	icoSes1 = document.querySelector("#icoSes1"),
	ses2 = document.querySelector("#ses2"), 
	icoSes2 = document.querySelector("#icoSes2"),
	ses3 = document.querySelector("#ses3"), 
	icoSes3 = document.querySelector("#icoSes3"),
	ses4 = document.querySelector("#ses4"), 
	icoSes4 = document.querySelector("#icoSes4");

function init() {
	$("#t1, #t2, #t3, #t4, #t5").tooltip();
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
        } else {
            $("#menu2").removeClass("bg-info");
        }
    });
    formAdmin.addEventListener('submit', function(e) {
    	validLoginAdm(e);
    });
	formDirec.addEventListener('submit', function(e) {
		validLoginDirec(e);
	});
	formDocen.addEventListener('submit', function(e) {
		validLoginDoc(e);
	});
	formCord.addEventListener('submit', function(e) {
		validLoginCor(e);
	});
	mostPerf(true);
}

ses1.addEventListener("mouseover", function(){
	icoSes1.classList.add(txtInfo);
	icoSes1.classList.add(anim);
	icoSes1.classList.add(animElig);
});
ses1.addEventListener("mouseleave", function(){
	icoSes1.classList.remove(txtInfo);
	icoSes1.classList.remove(anim);
	icoSes1.classList.remove(animElig);
});

ses2.addEventListener("mouseover", function(){
	icoSes2.classList.add(txtInfo);
	icoSes2.classList.add(anim);
	icoSes2.classList.add(animElig);
});
ses2.addEventListener("mouseleave", function(){
	icoSes2.classList.remove(txtInfo);
	icoSes2.classList.remove(anim);
	icoSes2.classList.remove(animElig);
});

ses3.addEventListener("mouseover", function(){
	icoSes3.classList.add(txtInfo);
	icoSes3.classList.add(anim);
	icoSes3.classList.add(animElig);
});
ses3.addEventListener("mouseleave", function(){
	icoSes3.classList.remove(txtInfo);
	icoSes3.classList.remove(anim);
	icoSes3.classList.remove(animElig);
});

ses4.addEventListener("mouseover", function(){
	icoSes4.classList.add(txtInfo);
	icoSes4.classList.add(anim);
	icoSes4.classList.add(animElig);
});
ses4.addEventListener("mouseleave", function(){
	icoSes4.classList.remove(txtInfo);
	icoSes4.classList.remove(anim);
	icoSes4.classList.remove(animElig);
});

function mostSlidPrin(flag) {
	if (flag) {
		$("#carouselExampleIndicators").show();
	} else {
		$("#carouselExampleIndicators").hide();
	}
}

function mostFormAdm(flag) {
	if (flag) {
		$("#formAdmin").fadeIn(1200);
		$(btnAdm).addClass("active");
		$("#infoIni").hide(1000);
		$("#btnInicio").removeClass("active");
	} else {
		$("#formAdmin").slideUp(100);
		$(btnAdm).removeClass("active");
	}
}

function mostFormCor(flag){
	if (flag) {
		$("#formCord").fadeIn(1200);
		$(btnCor).addClass("active");
		$("#infoIni").hide(1000);
		$("#btnInicio").removeClass("active");
	} else {
		$("#formCord").slideUp(100);
		$(btnCor).removeClass("active");
	}
}

function mostFormDir(flag){
	if (flag) {
		$("#formDirec").fadeIn(1200);
		$(btnDir).addClass("active");
		$("#infoIni").hide(1000);
		$("#btnInicio").removeClass("active");
	} else {
		$("#formDirec").slideUp(100);
		$(btnDir).removeClass("active");
	}
}

function mostFormDoc(flag) {
	if (flag) {
		$("#formDocen").fadeIn(1200);
		$(btnDoc).addClass("active");
		$("#infoIni").hide(1000);
		$("#btnInicio").removeClass("active");
	} else {
		$("#formDocen").slideUp(100);
		$(btnDoc).removeClass("active");
	}
}


function validLoginAdm(e) {
	e.preventDefault();
	let formDatAdm = new FormData($(formAdmin)[0]);
	let correoAdm = document.getElementById('correoAdm');
	let passAdm = document.getElementById('passAdm');
	let textcorr = document.getElementById('textcorr');
	let emailValid = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
	if (correoAdm.value.length > 0) {
		if (passAdm.value.length > 0) {
			if (correoAdm) {
				$.ajax({
					url : "ajax/valDatUsers.php?oper=verificarLog",
					type : "POST", data : formDatAdm,
					contentType : false, processData : false,
					success : function( resp ) {
						if (resp == 1) {
							swal({
								title: "Correcto!...",
								text: "Sesión Iniciada",
								icon: "success",
								button: false
							});
							setTimeout(function() {
								$(location).attr("href","modadm/Inicio/");
							}, 1000);
						} else if (resp == "mal") {
							swal({
								text : "Datos incorrectos",
								icon : "warning",
								button : "Aceptar",
								closeOnClickOutside : false,
							});
							passAdm.value = '';
						} else {
							console.log(resp);
						}
					}
				});
			} else {
				swal("Introduzca un correo con formato valido");
			}
		} else {
			swal({
				text: "Introduzca una contraseña",
				icon: "warning",
				button: "Aceptar",	
			}).then((acepta) => {
				$(passAdm).focus();
			});
			e.preventDefault();
		}
	} else {
		swal({
			text: "Introduzca un correo",
			icon: "warning",
			button: "Aceptar",
		}).then((acepta) =>  {
			$(correoAdm).focus();
		});
		e.preventDefault();
	}
}

function validLoginCor(e) {
	e.preventDefault();
	let formCord = document.getElementById('formCord');
	let formDat = new FormData($(formCord)[0]);
	let correoCor = $("#correoCor").val(), passCor = $("#passCor").val();
	if (correoCor.length > 0) {
		if (passCor.length > 0) {
			$.ajax({
				url : "ajax/valDatUsers.php?oper=verificarLogCor",
				type : "POST", data : formDat,
				contentType : false, processData : false,
				success : function( resp ) {
					if (resp == 1) {
						swal({
							title: "Correcto!...",
							text: "Sesión Iniciada",
							icon: "success",
							button: false
						});
						setTimeout(function() {
							$(location).attr("href","modCor/Inicio/");
						}, 1000);
					} else if (resp == "mal") {
						swal({
							text : "Datos incorrectos",
							icon : "warning",
							button : "Aceptar",
							closeOnClickOutside : false,
						});
						$("#passCor").val("");
					} else {
						console.log(resp);
					}
				}
			});
		} else {
			swal({
				text : "Introduzca una contraseña",
				icon : "warning",
				button : "Aceptar",
			}).then((acepta) => {
				$("#passCor").focus();
			});
			e.preventDefault();
		}
	} else {
		swal({
			text : "Introduzca un correo",
			icon : "warning",
			button : "Aceptar",
		}).then((acepta) => {
			$("#correoCor").focus();
		});	
		e.preventDefault();
	}
}

function validLoginDirec(e){
	e.preventDefault();
	let formDirec = document.getElementById('formDirec');
	let formDat = new FormData($(formDirec)[0]);
	let correoDir = $("#correoDir").val(), passDir = $("#passDir").val();
	if (correoDir.length > 0) {
		if (passDir.length > 0) {
			$.ajax({
				url : "ajax/valDatUsers.php?oper=verificarLogDir",
				type : "POST", data : formDat,
				contentType : false, processData : false,
				success : function( resp ) {
					if (resp == 1) {
						swal({
							title: "Correcto!...",
							text: "Sesión Iniciada",
							icon: "success",
							button: false
						});
						setTimeout(function() {
							$(location).attr("href","modDir/Inicio/");
						}, 1000);
					} else if (resp == "mal") {
						swal({
							text : "Datos incorrectos",
							icon : "warning",
							button : "Aceptar",
							closeOnClickOutside : false,
						});
						$("#passDir").val("");
					} else {
						console.log(resp);
					}
				}
			});
		} else {
			swal({
				text : "Introduzca una contraseña",
				icon : "warning",
				button : "Aceptar",
			}).then((acepta) => {
				$("#passDir").focus();
			});
			e.preventDefault();
		}
	} else {
		swal({
			text : "Introduzca un correo",
			icon : "warning",
			button : "Aceptar",
		}).then((acepta) => {
			$("#correoDir").focus();
		});	
		e.preventDefault();
	}
}

function validLoginDoc(e) {
	e.preventDefault();
	let formDocen = document.getElementById('formDocen');
	let formDat = new FormData($(formDocen)[0]);
	let correoDoc = $("#correoDoc").val(), passDoc = $("#passDoc").val();
	if (correoDoc.length > 0) {
		if (passDoc.length > 0) {
			$.ajax({
				url : "ajax/valDatUsers.php?oper=verificarLogDoc",
				type : "POST", data : formDat,
				contentType : false, processData : false,
				success : function( resp ) {
					if (resp == 1) {
						swal({
							title: "Correcto!...",
							text: "Sesión Iniciada",
							icon: "success",
							button: false
						});
						setTimeout(function() {
							$(location).attr("href","moddoc/Inicio/");
						}, 1000);
					} else if (resp == "mal") {
						swal({
							text : "Datos incorrectos",
							icon : "warning",
							button : "Aceptar",
							closeOnClickOutside : false,
						});
						$("#passDoc").val("");
					} else {
						console.log(resp);
					}
				} 
			});
		} else {
			swal({
				text : "Introduzca una contraseña",
				icon : "warning",
				button : "Aceptar",
			}).then((acepta) => {
				$("#passDoc").focus();
			});
			e.preventDefault();
		}
	} else {
		swal({
			text : "Introduzca un correo",
			icon : "warning",
			button : "Aceptar",
		}).then((acepta) => {
			$("#correoDoc").focus();
		});	
		e.preventDefault();	
	}
}

function mostPerf(flag) {
	if (flag) {
		$("#mostPerf").slideDown();
		$("#btnMostPerf").addClass("active");
	} else {
		$("#mostPerf").slideUp();
		$("#btnMostPerf").removeClass("active");
	}
}

init();