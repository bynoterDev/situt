document.addEventListener('DOMContentLoaded', () => {
	// 88 = x 79 == o
	document.addEventListener("keydown", (e) => {
		if (e.altKey && e.which === 79) {
			$("#modDevop").modal('toggle');
			setTimeout( () => {
				$("#usDevop").focus();
			}, 1000 );
		} else if (e.altKey && e.which === 88) {
			$("#modDevop").modal('hide');
		}
	});

	const formDevop = document.getElementById('formDevop');
	const usDevop = document.getElementById('usDevop');
	const codDevop = document.getElementById('codDevop');
	const btnIniDevop = document.getElementById('btnIniDevop');

	btnIniDevop.addEventListener('click', (e) => {
		const formDat = new FormData($(formDevop)[0]);
		if (usDevop.value.length > 0) {
			if (codDevop.value.length > 0) {
				$.ajax({
					url : "ajax/valDatUsers.php?oper=verificarLogDevop",
					type : "POST", data : formDat,
					contentType : false, processData : false,
					success : (resp) => {
						if (resp == 1) {
							swal({
								title: "Correcto!...",
								text: "Bienvenido desarrollador",
								button: false
							});
							setTimeout(function() {
								$(location).attr("href","modDevop/Home/");
							}, 1000);
						} else {
							location.reload();
						}
					}
				})
			} else {
				location.reload();
			}
		} else {
			location.reload();
		}
	});

});