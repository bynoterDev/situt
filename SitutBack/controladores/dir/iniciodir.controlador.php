<?php

/**
 * 
 */
class ControladorInicioDir
{
	public function inicio(){
		include "../vistas/modulos/dir/Index2.php";
	}

	public function regtutor() {
		include "../vistas/modulos/dir/RegTutores.php";
	}

	public function reggrupo() {
		include "../vistas/modulos/dir/RegGrupos.php";
	}

	public function perfDoc(){
		include "../vistas/modulos/dir/PerfDoc.php";
	}

	public function AlmInact() {
		include "../vistas/modulos/dir/AlmInact.php";
	}

	public function PerfAlmInact() {
		include "../vistas/modulos/dir/PerfAlmInact.php";
	}

	public function DetGrp() {
		include '../vistas/modulos/dir/DetGrp.php';
	}

	public function perfAlm(){
		include '../vistas/modulos/dir/PerfAlm.php';
	}

	public function BajCar(){
		include '../vistas/modulos/dir/BajCar.php';
	}

	public function DocBajAlm() {
		include '../vistas/modulos/dir/DocBajAlm.php';
	}

	public function RegAlumnos() {
		include '../vistas/modulos/dir/RegAlumnos.php';
	}

}