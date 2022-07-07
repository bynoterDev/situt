$(document).ready(function(){
	setInterval(function () {
		cantAllAlm();
		cantMale();
		cantFemale();
		cantAllBec();
		cantMaleBec();
		cantFemaleBec();
	},10000);
	setInterval(function(){
		cantAlmRech();	
	},10000);
	/*setInterval(function () {
		animInf();
	},2500);*/
	window.requestAnimationFrame(animInf);
	setInterval(function () {
		cantNotifJust();
		cargarNotif();
		cargarNotifTut();
		cantNotifTut();
	}, 10000);
    /*setInterval(function () {
    	animNotif();
    	animNotifTut();
	},10000);*/

    function animNotif(){
    	$.ajax({
			url:'../../../ajax/doc/notifAlm.php?oper=mostNotifCant',
			type : "POST",
			success:function (data) {
				if (data > 0) {
					$("#bell").addClass("animated tada");
					$("#dropdownMenuLink").removeClass("btn-outline-success");
					$("#dropdownMenuLink").addClass("btn-outline-danger");
					setTimeout(function() {
						$("#bell").removeClass("animated tada");
						$("#dropdownMenuLink").removeClass("btn-outline-danger");
						$("#dropdownMenuLink").addClass("btn-outline-success");
					}, 2000);
				}
			}
		});
    }

    function cantNotifJust() {
    	$.ajax({
    		url:'../../../ajax/doc/notifAlm.php?oper=mostNotifCan',
			type : "POST",
			success:function (data) {
				$('#cantNotif').text(data);
			}
    	});
    }
	function cargarNotif () {
		$.ajax({
			url:'../../../ajax/doc/notifAlm.php?oper=mostNotif',
			type : "POST",
			success:function (data) {
				$('.listNot').html(data);
			}
		});
	}
	function cargarNotifTut() {
		$.ajax({
			url : '../../../ajax/doc/notifAlm.php?oper=cargarNotifTut',
			type : "POST",
			success : function( data ) {
				$('.listTut').html(data);
			}
		});
	}
	function animNotifTut(){
    	$.ajax({
			url:'../../../ajax/doc/notifAlm.php?oper=cantNotifTut',
			type : "POST",
			success:function (data) {
				if (data > 0) {
					$("#bell2").addClass("animated tada");
					$("#dropdownMenuLink2").removeClass("btn-outline-success");
					$("#dropdownMenuLink2").addClass("btn-outline-danger");
					setTimeout(function() {
						$("#bell2").removeClass("animated tada");
						$("#dropdownMenuLink2").removeClass("btn-outline-danger");
						$("#dropdownMenuLink2").addClass("btn-outline-success");
					}, 2000);
				}
			}
		});
    }
	function cantNotifTut() {
    	$.ajax({
    		url:'../../../ajax/doc/notifAlm.php?oper=cantNotifTut',
			type : "POST",
			success:function (data) {
				$('#cantNotifTut').text(data);
			}
    	});
    }
	function cantAllAlm () {
		$.ajax({
			url:'../../../ajax/doc/notifAlm.php?oper=cantAllAlm',
			type : "POST",
			success:function (data) {
				if (data > 1 || data == 0) {
					$('#cantAllAlm').html(data + " Totales");	
				} else {
					$('#cantAllAlm').html(data + " Total");	
				}
			}
		});
	}
	function cantMale () {
		$.ajax({
			url:'../../../ajax/doc/notifAlm.php?oper=cantMale',
			type : "POST",
			success:function (data) {
				if (data > 1 || data == 0) {
					$('#cantMale').html(data + " registros.");	
				} else {
					$('#cantMale').html(data + " registro.");	
				}
			}
		});
	}
	function cantFemale () {
		$.ajax({
			url:'../../../ajax/doc/notifAlm.php?oper=cantFemale',
			type : "POST",
			success:function (data) {
				if (data > 1 || data == 0) {
					$('#cantFemale').html(data + " registros.");	
				} else {
					$('#cantFemale').html(data + " registro.");	
				}
			}
		});
	}
	function cantAllBec () {
		$.ajax({
			url:'../../../ajax/doc/notifAlm.php?oper=cantAllBec',
			type : "POST",
			success:function (data) {
				if (data > 1 || data == 0) {
					$('#cantAllBec').html(data + " registros.");	
				} else {
					$('#cantAllBec').html(data + " registro.");	
				}
			}
		});
	}
	function cantMaleBec () {
		$.ajax({
			url:'../../../ajax/doc/notifAlm.php?oper=cantMaleBec',
			type : "POST",
			success:function (data) {
				if (data > 1 || data == 0) {
					$('#cantMaleBec').html(data + " becados.");	
				} else {
					$('#cantMaleBec').html(data + " becado.");	
				}
			}
		});
	}
	function cantFemaleBec () {
		$.ajax({
			url:'../../../ajax/doc/notifAlm.php?oper=cantFemaleBec',
			type : "POST",
			success:function (data) {
				if (data > 1 || data == 0) {
					$('#cantFemaleBec').html(data + " becadas.");	
				} else {
					$('#cantFemaleBec').html(data + " becada.");	
				}
			}
		});
	}
	function cantAllBec () {
		$.ajax({
			url:'../../../ajax/doc/notifAlm.php?oper=cantAllBec',
			type : "POST",
			success:function (data) {
				if (data > 1 || data == 0) {
					$('#cantAllBec').html(data + " Totales.");	
				} else {
					$('#cantAllBec').html(data + " Total.");	
				}
			}
		});
	}
	function cantAlmRech () {
		$.ajax({
			url:'../../../ajax/doc/notifAlm.php?oper=cantAlmRech',
			type : "POST",
			success:function (data) {
				if (data >= 1) {
					$("#cantAlmRech").show();
					$('#cantAlmRech').html(data);	
					$("#cantAlmRech").addClass("badge badge-danger lead");
					$("#cantAlmRech").addClass("animated fadeOut");
					setTimeout(function(){
						$("#cantAlmRech").removeClass("animated fadeOut");
					}, 1000);
				} else {
					$('#cantAlmRech').hide();	
					$("#cantAlmRech").removeClass("animated fadeOut");
				}
			}
		});
	}
	function animInf() {
		$("#infoDet").addClass("animated bounce");
		$("#icoHom").addClass("animated jackInTheBox");
		$("#listAsist").addClass("animated jackInTheBox");
		setTimeout(function() {
			$("#infoDet").removeClass("animated bounce");
			$("#icoHom").removeClass("animated jackInTheBox");
			$("#listAsist").removeClass("animated jackInTheBox");
		}, 2000);
	}
});