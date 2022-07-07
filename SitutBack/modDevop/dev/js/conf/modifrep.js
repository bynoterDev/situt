document.addEventListener('DOMContentLoaded', () => {

	const btnReg = document.getElementById('btnReg');
	const forRep = document.getElementById('forRep');

	const notaAg = document.getElementById('notaAg');
	const selectEst = document.getElementById('selectEst');
	const confirmPs = document.getElementById('confirmPs');

	const divErr = document.getElementById('divErr');
	const divGod = document.getElementById('divGod');

	btnReg.addEventListener('click', ( e ) => {

		e.preventDefault();
		const formDa = new FormData($(forRep)[0]);

		if (notaAg.value.length > 0 && notaAg.value.length > 0 && confirmPs.value.length > 0) {
			btnReg.disabled = true;
			$.ajax({
				url : "../../../../ajax/reports/reports.php?oper=repsol",
				type : "POST", data :formDa,
				contentType : false, processData : false,
				success: ( resp ) => {
					if ( resp == 1 ) {
						divGod.classList.remove('d-none');
						divGod.classList.add('fadeIn');
						setTimeout( () => {
							location.href = '../../../EstateRep/res/';
						}, 3000);
					} else if ( resp == 2 ) {
						location.reload();
					} else if ( resp == 3 ) {
						console.log( 'Fallo' );
						btnReg.disabled = false;
					} else {
						console.log( resp );
						btnReg.disabled = false;
					}
				}
			});
 		} else {
 			divErr.classList.remove('d-none','fadeOut');
 			divErr.classList.add('fadeIn');
 			setTimeout( () => {
 				divErr.classList.remove('fadeIn');
 				divErr.classList.add('fadeOut');
 				setTimeout( () => {
 					divErr.classList.add('d-none');
 				}, 1000);
 			}, 3000);
 		}

	});

});