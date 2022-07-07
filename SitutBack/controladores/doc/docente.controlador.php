<?php

/**
 * 
 */
class Docente
{
	
	function __construct()
	{

	}

	public function Inicio() {
		include "../vistas/modulos/doc/Index2.php";
	}

	public function detGrp() {
		include "../vistas/modulos/doc/DetGrp.php";
	}

	public function PerfAlm(){
		include "../vistas/modulos/doc/PerfAlm.php";
	}

	public function ImprmJustif() {
		include "../vistas/modulos/doc/ImprmJustif.php";
	}

	public function HistAlm(){
		include "../vistas/modulos/doc/HistAlm.php";
	}

	public function MostDatEnc() {
		include "../vistas/modulos/doc/MostDatEnc.php";
	}

	public function impTest() {
		include "../vistas/modulos/doc/ImpTest.php";
	}

	public function RegBajaAlm() {
		include "../vistas/modulos/doc/RegBajaAlm.php";
	}

	public function ImpBaja() {
		include "../vistas/modulos/doc/ImpBaja.php";
	}

	public function JustifAlm() {
		include "../vistas/modulos/doc/JustifAlm.php";
	}
	
	public function ListAsist() {
		include "../vistas/modulos/doc/ListAsist.php";
	}
}	