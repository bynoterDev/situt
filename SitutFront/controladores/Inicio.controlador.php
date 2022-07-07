<?php 

class ControladorInicioAlm {
	public function inicioLog() {
		include "vistas/Index3.php";
	}
	public function inicioPerfAlm(){
		include "../vistas/modulos/Index2.php";
	}
	public function testIni(){
		include "../vistas/modulos/TestIni.php";
	}
	public function testIniEdit(){
		include "../vistas/modulos/TestIniEdit.php";
	}
	
	public function DetJustif(){
		include "../vistas/modulos/DetJustif.php";
	}
	
	public function DetTutPer(){
		include "../vistas/modulos/DetTutPer.php";
	}

	public function Develop() {
		include "../vistas/modulos/Develop.php";
	}
}