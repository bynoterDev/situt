/*----------  VARIABLES  ----------*/
const admIcoC = document.querySelector('#admIcoC');
const admBtnC = document.querySelector('#admBtnC');
const correoAdm = document.querySelector('#correoAdm');
const passAdm =  document.querySelector('#passAdm');

const corIcoC = document.querySelector('#corIcoC');
const corBtnC = document.querySelector('#corBtnC');
const correoCor = document.querySelector('#correoCor');
const passCor = document.querySelector('#passCor');

const dirIcoC = document.querySelector('#dirIcoC');
const dirBtnC = document.querySelector('#dirBtnC');
const correoDir = document.querySelector('#correoDir');
const passDir = document.querySelector('#passDir');

const docIcoC = document.querySelector('#docIcoC');
const docBtnC = document.querySelector('#docBtnC');
const correoDoc = document.querySelector('#correoDoc');
const passDoc = document.querySelector('#passDoc');

/*----------  LISTENERS  ----------*/

eventListeners();

function eventListeners () {
	document.addEventListener('DOMContentLoaded', init);
}

/*----------  FUNCIONES  ----------*/

function init () {
	admIcoC.addEventListener('click', function() { limpCamp(correoAdm, passAdm); });
	admBtnC.addEventListener('click', function() { limpCamp(correoAdm, passAdm); });
	corIcoC.addEventListener('click', function() { limpCamp(correoCor, passCor); });
	corBtnC.addEventListener('click', function() { limpCamp(correoCor, passCor); });
	dirIcoC.addEventListener('click', function() { limpCamp(correoDir, passDir); });
	dirBtnC.addEventListener('click', function() { limpCamp(correoDir, passDir); });
	docIcoC.addEventListener('click', function() { limpCamp(correoDoc, passDoc); });
	docBtnC.addEventListener('click', function() { limpCamp(correoDoc, passDoc); });
}

function limpCamp (element1, element2) {
	element1.value = "";
	element2.value = "";
}
