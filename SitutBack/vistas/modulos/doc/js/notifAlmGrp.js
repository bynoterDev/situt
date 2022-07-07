$(document).ready(function(){
	setInterval(function(){
		cantTutPer();
		cantTutPerSol();
		cantTutPerAll();
		cantJustAll();
		cantJustAcept();
		cantJustSinAcept();
	},10000);
	function cantTutPer() {
		$.ajax({
    		url:'../ajax/doc/notifGrpAlm.php?oper=cantTutPer',
			type : "POST",
			success:function (data) {
				$('#cantTut').text(data);
			}
    	});
	}
	function cantTutPerSol() {
		$.ajax({
    		url:'../ajax/doc/notifGrpAlm.php?oper=cantTutPerSol',
			type : "POST",
			success:function (data) {
				$('#cantTutPerSol').text(data);
			}
    	});
	}
	function cantTutPerAll() {
		$.ajax({
    		url:'../ajax/doc/notifGrpAlm.php?oper=cantTutPerAll',
			type : "POST",
			success:function (data) {
				$('#cantTutPerAll').text(data);
			}
    	});
	}
	function cantJustAll() {
		$.ajax({
    		url:'../ajax/doc/notifGrpAlm.php?oper=cantJustAll',
			type : "POST",
			success:function (data) {
				$('#cantJustAll').text(data);
			}
    	});
	}
	function cantJustAcept() {
		$.ajax({
    		url:'../ajax/doc/notifGrpAlm.php?oper=cantJustAcept',
			type : "POST",
			success:function (data) {
				$('#cantJustAcept').text(data);
			}
    	});
	}
	function cantJustSinAcept() {
		$.ajax({
    		url:'../ajax/doc/notifGrpAlm.php?oper=cantJustSinAcept',
			type : "POST",
			success:function (data) {
				$('#cantJustSinAcept').text(data);
			}
    	});
	}
});