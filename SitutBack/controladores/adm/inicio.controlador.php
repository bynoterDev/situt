<?php

/**
 *  Clase inicio pagina principal
 */
class ControladorInicio {

	public function inicio() {
		include "vistas/Index3.php";
	}

	public function principal() {
		include "../vistas/modulos/adm/Index2.php";
	}

	public function carreras(){
		include "../vistas/modulos/adm/DetCarreras.php";
	}

	public function directores(){
		include "../vistas/modulos/adm/DetDirectores.php";
	}

	public function administradores(){
		include "../vistas/modulos/adm/DetAdmin.php";
	}
	
	public function cicloEscolar() {
		include "../vistas/modulos/adm/DetCEscolar.php";
	}
	
	public function DetCoord() {
		include "../vistas/modulos/adm/DetCoord.php";
	}
}