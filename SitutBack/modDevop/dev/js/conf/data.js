document.addEventListener('DOMContentLoaded', () => {

	const formCo = document.getElementById('formCo');
	const btnAct = document.getElementById('btnAct');

	const newPas = document.getElementById('newPas');
	const repPas = document.getElementById('repPas');
	const actPas = document.getElementById('actPas');

	const divErr = document.getElementById('divErr');
	const divGod = document.getElementById('divGod');
	const divFal = document.getElementById('divFal');
	const divPro = document.getElementById('divPro');

	segCont = () => {

		const message = document.getElementById('message');
		const mayus = new RegExp("^(?=.*[A-Z])");
		const lower = new RegExp("^(?=.*[a-z])");
		const len = new RegExp("^(?=.{8,})");
		const numbers = new RegExp("^(?=.*[0-9])");

		if (mayus.test(newPas.value) && lower.test(newPas.value) && numbers.test(newPas.value) && len.test(newPas.value)) {
			message.innerHTML = 'Seguridad Alta <i class="fas fa-check-circle ml-2"></i>';
			message.classList.remove('ocult','text-danger','text-warning');
			message.classList.add('text-success', 'animated', 'fadeIn');
		} else if (mayus.test(newPas.value) && numbers.test(newPas.value) && len.test(newPas.value) 
			|| lower.test(newPas.value) && numbers.test(newPas.value) && len.test(newPas.value)) {
			message.innerHTML = 'Seguridad Media <i class="fas fa-exclamation-circle ml-2"></i>';
			message.classList.remove('ocult','text-success','text-danger');
			message.classList.add('text-warning', 'animated', 'fadeIn');
		} else if (mayus.test(newPas.value) && len.test(newPas.value) || lower.test(newPas.value) && len.test(newPas.value) 
			|| numbers.test(newPas.value) && len.test(newPas.value)
			|| numbers.test(newPas.value)
			|| mayus.test(newPas.value)
			|| lower.test(newPas.value)) {
			message.innerHTML = 'Seguridad Baja <i class="fas fa-times ml-2"></i>';
			message.classList.remove('ocult','text-success','text-warning');
			message.classList.add('text-danger', 'animated', 'fadeIn');
		} else {
			message.textContent = '';
			message.className = 'ocult mt-3';
		}

	}

	newPas.addEventListener('keyup', segCont);

	contIgul = () => {

		const message2 = document.getElementById('message2');

		if (repPas.value.length > 0) {
			if (newPas.value === repPas.value) {
				message2.innerHTML = 'Las contraseñas coinciden <i class="fas fa-check-circle ml-2"></i>';
				message2.classList.remove('ocult','text-danger');
				message2.classList.add('text-success', 'animated', 'fadeIn');
				btnAct.disabled = false;
			} else {
				message2.innerHTML = 'Las contraseñas no coinciden <i class="fas fa-times ml-2"></i>';
				message2.classList.remove('ocult','text-success');
				message2.classList.add('text-danger', 'animated', 'fadeIn');
				btnAct.disabled = true;
			}
		} else {
			message2.textContent = '';
			message2.className = 'ocult mt-3';
			btnAct.disabled = false;
		}

	}

	newPas.addEventListener('keyup', contIgul);
	repPas.addEventListener('keyup', contIgul);

	limpCamp = () => {
		newPas.value = ''; repPas.value = ''; actPas.value = '';
		message.textContent = '';
		message2.textContent = '';
		btnAct.disabled = false;
	}

	mostDivs = (param, time) => {
		param.classList.remove('d-none','fadeOut');
		param.classList.add('fadeIn');
		setTimeout(() => {
			param.classList.remove('fadeIn');
			param.classList.add('fadeOut');
			setTimeout( () => {
				param.classList.add('d-none');
			}, 1000);
		}, time);
	}

	btnAct.addEventListener('click', ( e ) => {

		e.preventDefault();

		const formDa = new FormData($(formCo)[0]);

		if (newPas.value.length > 0 && repPas.value.length > 0 && actPas.value.length > 0) {
			btnAct.disabled = true;
			$.ajax({
				url : "../../ajax/reports/confdata.php?oper=cont",
				type : "POST", data : formDa,
				contentType : false, processData : false,
				success : ( resp ) => {
					if (resp == 1) {
						mostDivs(divGod, 3000);
						limpCamp();
					} else if (resp == 2) {
						mostDivs(divPro, 3000);
						limpCamp();
					} else if (resp == 0) {
						mostDivs(divFal, 3000);
						actPas.value = '';
						btnAct.disabled = false;
					} else {
						limpCamp();
						console.log( resp );
					}
				}
			});
 		} else {
 			mostDivs(divErr, 3000);
 		}

	});

});