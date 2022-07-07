<?php 

include 'conexion.php';
include 'conect.php';

class Alumno 
{
	
	function __construct()
	{
		
	}
	
	public function userAlmDet($id_alumno) {
		try {
			//$dbc = Connect::getDB();
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc->prepare("SELECT * FROM alumnos WHERE id_alumno = :id_alumno");
			$stmt -> bindParam("id_alumno", $id_alumno, PDO::PARAM_INT);
			$stmt -> execute();
			$data = $stmt -> fetch(PDO::FETCH_OBJ);
			return $data;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
	}


	public function datGrpAlm($id_alumno) {
		try {
			//$dbc = Connect::getDB();
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc -> prepare("SELECT det.id_detgrupo, grp.period_cuat, grp.grupo_n, grp.cuatrimestre_g, doc.nombre_c_doc, doc.foto_perf_doc, car.nombre_car, alm.acept_grp, car.id_carrera FROM alumnos alm INNER JOIN det_grupo det ON det.id_detgrupo = alm.id_detgrupo INNER JOIN grupos grp ON grp.id_grupo = det.id_grupo INNER JOIN docentes doc ON doc.id_docente = det.id_docente INNER JOIN carreras car ON car.id_carrera = det.id_carrera WHERE alm.id_alumno = :id_alumno");
			$stmt -> bindParam("id_alumno", $id_alumno, PDO::PARAM_INT);
			$stmt -> execute();
			$data = $stmt -> fetch(PDO::FETCH_OBJ);
			return $data;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
	}
	public function cantTotJustif($id_alumno) {
		try {
			//$dbc = Connect::getDB();
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc -> prepare("SELECT COUNT(id_justificante) AS 'Cantidad' FROM justificantes where id_alumno = :id_alumno");
			$stmt -> bindParam("id_alumno", $id_alumno, PDO::PARAM_INT);
			$stmt -> execute();
			$data = $stmt -> fetch(PDO::FETCH_OBJ);
			return $data;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
	}
	public function cantJustifAcept($id_alumno, $cuatri) {
		try {
			//$dbc = Connect::getDB();
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc -> prepare("SELECT COUNT(id_justificante) AS 'Cantidad' FROM justificantes where id_alumno = :id_alumno && estado_justif = 1 && cuatrimestre_justif = :cuatri");
			$stmt -> bindParam("id_alumno", $id_alumno, PDO::PARAM_INT);
			$stmt -> bindParam("cuatri", $cuatri, PDO::PARAM_STR);
			$stmt -> execute();
			$data = $stmt -> fetch(PDO::FETCH_OBJ);
			return $data;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
	}
	public function cantJustifRecha($id_alumno, $cuatri) {
		try {
			//$dbc = Connect::getDB();
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc -> prepare("SELECT COUNT(id_justificante) AS 'Cantidad' FROM justificantes where id_alumno = :id_alumno && estado_justif = 0 && cuatrimestre_justif = :cuatri");
			$stmt -> bindParam("id_alumno", $id_alumno, PDO::PARAM_INT);
			$stmt -> bindParam("cuatri", $cuatri, PDO::PARAM_STR);
			$stmt -> execute();
			$data = $stmt -> fetch(PDO::FETCH_OBJ);
			return $data;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
	}
	public function cantJustifCuat($id_alumno, $cuatri) {
		try {
			//$dbc = Connect::getDB();
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc -> prepare("SELECT COUNT(id_justificante) AS 'Cantidad' FROM justificantes where id_alumno = :id_alumno && cuatrimestre_justif = :cuatri");
			$stmt -> bindParam("id_alumno", $id_alumno, PDO::PARAM_INT);
			$stmt -> bindParam("cuatri", $cuatri, PDO::PARAM_STR);
			$stmt -> execute();
			$data = $stmt -> fetch(PDO::FETCH_OBJ);
			return $data;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
	}

	public function cantDatPerVal($id_alumno) {
		try {
			//$dbc = Connect::getDB();
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc -> prepare("SELECT COUNT(datper.id_datpersonalesalm) AS 'CantDat' FROM datpersonales_alm datper INNER JOIN alumnos alm ON alm.id_alumno = datper.id_alumno WHERE alm.id_alumno = :id_alumno");
			$stmt -> bindParam("id_alumno", $id_alumno, PDO::PARAM_INT);
			$stmt -> execute();
			$data = $stmt -> fetch(PDO::FETCH_OBJ);
			return $data;
		} catch (PDOException $e) {
			echo '{"error":{"text":'.$e->getMessage().'}}';
		}
	}

	public function datPerEditAlm($id_alumno) {
		try {
			//$dbc = Connect::getDB();
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc -> prepare("SELECT * FROM datpersonales_alm datp INNER JOIN alumnos alm ON alm.id_alumno = datp.id_alumno WHERE alm.id_alumno = :id_alumno");
			$stmt -> bindParam("id_alumno", $id_alumno, PDO::PARAM_INT);
			$stmt -> execute();
			$data = $stmt -> fetch(PDO::FETCH_OBJ);
			return $data;
		} catch (PDOException $e) {
			echo '{"error":{"text":'.$e->getMessage().'}}';
		}
	}

	public function valTestIniAlm($id_alumno) {
		try {
			//$dbc = Connect::getDB();
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc -> prepare("SELECT COUNT(id_enctestalm) AS 'CantidadVal' FROM enctes_alm WHERE id_alumno = :id_alumno");
			$stmt -> bindParam("id_alumno", $id_alumno, PDO::PARAM_INT);
			$stmt -> execute();
			$data = $stmt -> fetch(PDO::FETCH_OBJ);
			return $data;
		} catch (PDOException $e) {
			echo '{"error":{"text":'.$e->getMessage().'}}';
		}
	}

	public function valObtEnc($id_alumno) {
		try {
			//$dbc = Connect::getDB();
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc -> prepare("SELECT id_enctestalm FROM enctes_alm WHERE id_alumno = :id_alumno");
			$stmt -> bindParam("id_alumno", $id_alumno, PDO::PARAM_INT);
			$stmt -> execute();
			$data = $stmt -> fetch(PDO::FETCH_OBJ);
			return $data;
		} catch (PDOException $e) {
			echo '{"error":{"text":'.$e->getMessage().'}}';
		}
	}

	public function validDatEnc($id_alumno, $id_enctestalm ) {
		try {
			//$dbc = Connect::getDB();
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc -> prepare("SELECT * FROM enctes_alm WHERE id_alumno = :id_alumno && id_enctestalm  = :id_enctestalm");
			$stmt -> bindParam("id_alumno", $id_alumno, PDO::PARAM_INT);
			$stmt -> bindParam("id_enctestalm", $id_enctestalm, PDO::PARAM_INT);
			$stmt -> execute();
			$data = $stmt -> fetch(PDO::FETCH_OBJ);
			return $data;
		} catch (PDOException $e) {
			echo '{"error":{"text":'.$e->getMessage().'}}';
		}
	}

	public function datHistValid($id_alumno) {
		try {
			//$dbc = Connect::getDB();
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc -> prepare("SELECT doc.nombre_c_doc, grp.grupo_n, grp.cuatrimestre_g, grp.period_cuat FROM alumnos alm 
			INNER JOIN det_grupo det ON det.id_detgrupo = alm.id_detgrupo
			INNER JOIN docentes doc ON doc.id_docente = det.id_docente
			INNER JOIN grupos grp ON grp.id_grupo = det.id_grupo
			WHERE alm.id_alumno = :id_alumno");
			$stmt -> bindParam("id_alumno", $id_alumno, PDO::PARAM_INT);
			$stmt -> execute();
			$data = $stmt -> fetch(PDO::FETCH_OBJ);
			return $data;
		} catch (PDOException $e) {
			echo '{"error":{"text":'.$e->getMessage().'}}';
		}
	}

	public function datValidObtHist($id_detgrupo) {
		try {
			//$dbc = Connect::getDB();
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc -> prepare("SELECT doc.nombre_c_doc, grp.grupo_n, grp.cuatrimestre_g, grp.period_cuat FROM det_grupo det
				INNER JOIN docentes doc ON doc.id_docente = det.id_docente
				INNER JOIN grupos grp ON grp.id_grupo = det.id_grupo
				WHERE det.id_detgrupo = :id_detgrupo");
			$stmt -> bindParam("id_detgrupo", $id_detgrupo, PDO::PARAM_INT);
			$stmt -> execute();
			$data = $stmt -> fetch(PDO::FETCH_OBJ);
			return $data;
		} catch (PDOException $e) {
			echo '{"error":{"text":'.$e->getMessage().'}}';
		}
	}


}

?>