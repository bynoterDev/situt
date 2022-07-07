<?php

/**
 * 
 */
class CoordinadorPag
{
	
	function __construct()
	{

	}

	public function Inicio() {
		include "../vistas/modulos/cor/Index2.php";
	}
	
	public function DetCar() {
		include "../vistas/modulos/cor/DetCar.php";
	}

	public function DetGrp() {
		include "../vistas/modulos/cor/DetGrp.php";
	}
	
	public function DetPerfAlm() {
		include "../vistas/modulos/cor/DetPerfAlm.php";
	}

	public function Reportes() {
		include "../vistas/modulos/cor/Reportes.php";
	}
	
	public function ReportCar() {
		include "../vistas/modulos/cor/ReportCar.php";
	}
	
	public function ImpReport() {
		include "../vistas/modulos/cor/ImpReport.php";
	}
}