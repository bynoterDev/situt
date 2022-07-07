function init(){
	setInterval(function(){
		cantAlmCar();
		cantGrpCar();
	},2000);
}

function cantAlmCar() {
	$.ajax({
    	url:'../ajax/dir/notifInd.php?oper=cantAlmCar',
		type : "POST",
		success:function (data) {
			$('#cantAlmCar').text(data);
		}
    });
}
function cantGrpCar() {
	$.ajax({
    	url:'../ajax/dir/notifInd.php?oper=cantGrpCar',
		type : "POST",
		success:function (data) {
			$('#cantGrpCar').text(data);
		}
    });
}
init();