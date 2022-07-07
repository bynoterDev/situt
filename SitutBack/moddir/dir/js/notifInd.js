function init(){
	cantAlmCar();
	cantGrpCar();
}

cantAlmCar = () => {
	$.ajax({
    	url:'../../ajax/dir/notifInd.php?oper=cantAlmCar',
		type : "POST",
		success:function (data) {
			$('#cantAlmCar').text(data + " registros.");
		}
    });
}

cantGrpCar = () => {
	$.ajax({
    	url:'../../ajax/dir/notifInd.php?oper=cantGrpCar',
		type : "POST",
		success:function (data) {
			$('#cantGrpCar').text(data + " registros.");
		}
    });
}
init();