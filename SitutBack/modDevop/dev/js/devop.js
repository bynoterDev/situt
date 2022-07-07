document.addEventListener('DOMContentLoaded', () => {
	//77=m 81=q
	const contoc = document.getElementById('cont-oc');
	// const tagDir = document.getElementById('tagDir');
	// const dirAdm = document.getElementById('dirAdm');
	// const dirCor = document.getElementById('dirCor');
	// const dirDir = document.getElementById('dirDir');
	// const dirDoc = document.getElementById('dirDoc');

	document.addEventListener('keydown', (e) => {
		if ( e.altKey && e.which === 77) {
			most(contoc);
		} else if ( e.altKey && e.which === 81) {
			ocul(contoc);
		}
	});

	most = (param) => {
		param.classList.remove('d-none'); 
		param.classList.add('fadeIn');
	}

	ocul = (param) => {
		param.classList.add('d-none'); 
		param.classList.remove('fadeIn');
	}

});