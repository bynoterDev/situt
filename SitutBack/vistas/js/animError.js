function init() {
	setInterval(function(){
		animLp();
	},2000);
}

function animLp() {
	$("#obtLp").removeClass("text-danger");
	$("#obtLp").addClass("text-info");
	setTimeout(function(){
		$("#obtLp").removeClass("text-info");
		$("#obtLp").addClass("text-danger");
		setTimeout(function(){
			$("#obtLp").hide();
			$("#obtSuc").show(); $("#obtSuc").removeClass("ocult");
			$("#msjAlt").text("Dirección ip obtenida y enviada al Sistema de Seguridad Interno");
			$("#icoUs").addClass("text-danger");
			// setTimeout(function(){
			// 	$(location).attr("href", "http://localhost/TutoriasBack/");
			// }, 5000);
		},10000);
	},1000);
}

init();