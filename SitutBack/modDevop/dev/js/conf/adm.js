document.addEventListener('DOMContentLoaded', () => {

	/*----------  Formulario  ----------*/
	const formAdm = document.getElementById('formAdm');
	const nuevpas = document.getElementById('nuevpas');
	const passact = document.getElementById('passact');
	const messErr = document.getElementById('messErr');
	const messGod = document.getElementById('messGod');

	/*----------  CARGA  ----------*/
	const loadAdm = document.getElementById('loadAdm');

	/*----------  BOTONES  ----------*/
	const btnMost = document.getElementById('btnMost');
	const btnClos = document.getElementById('btnClos');
	const btnEnvi = document.getElementById('btnEnvi');

	btnMost.addEventListener('click', () => {
		formAdm.classList.remove('d-none','fadeOut');
		formAdm.classList.add('fadeIn');
		btnMost.disabled = true;
	});
	
	ocultForm = () => {
		formAdm.className = 'mt-4 mb-4 animated fadeOut';
		setTimeout(() => {
			formAdm.classList.add('d-none');
			btnMost.disabled = false;
		}, 1000);
	}

	btnClos.addEventListener('click', ocultForm);


	btnEnvi.addEventListener('click', (e) => {
		e.preventDefault();
		const formDat = new FormData($(formAdm)[0]);
		if (nuevpas.value.length > 0 && passact.value.length > 0) {
			loadAdm.classList.remove('d-none','fadeOut');
			btnEnvi.disabled = true;
			setTimeout( () => {
				$.ajax({
					url : "../../../../ajax/reports/confFunc.php?oper=contAdm",
					type : "POST", data : formDat,
					contentType : false, processData : false,
					success : (resp) => {
						if (resp == 1) {
							messGod.classList.remove('d-none','fadeOut');
							nuevpas.value = ''; passact.value = '';
							setTimeout(() => {
								messGod.className = 'border-left-primary shadow card p-2 animated fadeOut rounded mt-3 mb-3';
								setTimeout(() => {
									messGod.classList.add('d-none');
								},1000);
							}, 2000);
						} else if (resp == 2) {
							location.reload();
						} else if (resp == 0) {
							alert('ocurrio un problema......');
						} else {
							console.log(resp);
						}
					}
				});
				loadAdm.className = 'text-center animated fadeOut';
				setTimeout( () => {
					loadAdm.classList.add('d-none');
					btnEnvi.disabled = false;
				}, 1000);
			}, 5000);
		} else {
			messErr.classList.remove('d-none','fadeOut');
			messErr.classList.add('fadeIn');
			setTimeout(() => {
				messErr.className = 'border-left-danger p-2 animated fadeOut rounded mt-3 mb-3';
				setTimeout(() => {
					messErr.classList.add('d-none');
					nuevpas.focus();
				}, 1000);
			}, 2000);
		}
	});


	

});