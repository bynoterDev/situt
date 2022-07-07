function init() {
	$("#regAq").on("click", function(e) {
		mostReg(e);
	});
	$("#logAq").on("click", function(e) {
		mostLog(e);
	});
}

function mostLog(e) {
	e.preventDefault();
	$("#columReg").removeClass("animated bounceInDown");
	$("#columReg").addClass("animated bounceOutUp");
	setTimeout(function(){
		$("#columReg").addClass("ocult");
	},1000);
	setTimeout(function(){
		$("#columIni").removeClass("ocult");
		$("#columIni").removeClass("animated bounceOutUp");
		$("#columIni").addClass("animated bounceInDown").show();
	},1100);
}

function mostReg(e) {
	e.preventDefault();
	$("#columIni").removeClass("animated bounceInDown");
	$("#columIni").addClass("animated bounceOutUp");
	setTimeout(function(){
		$("#columIni").addClass("ocult");
	},1000);
	setTimeout(function() {
		$("#columReg").removeClass("ocult");
		$("#columReg").removeClass("animated bounceOutUp");
		$("#columReg").addClass("animated bounceInDown").show();
	},1100);
}

init();