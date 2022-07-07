<?php 

include 'conexion.php';
include 'conect.php';

/**
 * Docentes (Tutores)
 */
class Docentes 
{
	
	public function userDocDet($id_docente) {
		try {
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc->prepare("SELECT * FROM docentes WHERE id_docente  = :id_docente");
			$stmt -> bindParam("id_docente", $id_docente, PDO::PARAM_INT);
			$stmt -> execute();
			$data = $stmt -> fetch(PDO::FETCH_OBJ);
			return $data;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
		$dbc = null; $stmt = null;
	}
	public function datGrpSel($id_docente, $id_detgrupo){
		try {
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc -> prepare("SELECT * FROM det_grupo det
			INNER JOIN grupos grp ON grp.id_grupo = det.id_grupo
			INNER JOIN docentes doc ON doc.id_docente = det.id_docente
			INNER JOIN carreras car On car.id_carrera = det.id_carrera
			WHERE doc.id_docente = :id_docente && det.id_detgrupo = :id_detgrupo");
			$stmt -> bindParam("id_docente", $id_docente, PDO::PARAM_INT);
			$stmt -> bindParam("id_detgrupo", $id_detgrupo, PDO::PARAM_INT);
			$stmt -> execute();
			$data = $stmt -> fetch(PDO::FETCH_OBJ);
			return $data;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
		$dbc = null; $stmt = null;
	}
	public function activarAlmGrp($id_alumno) {
		$sql = "UPDATE alumnos SET acept_grp = '1' WHERE id_alumno = '$id_alumno'";
		return ejecutarConsulta($sql);
	}
	public function desactivarAlmGrp($id_alumno) {
		$sql = "UPDATE alumnos SET acept_grp = '0' WHERE id_alumno = '$id_alumno'";
		return ejecutarConsulta($sql);
	}
	public function becadoAlm($id_alumno) {
		$sql = "UPDATE alumnos SET becado_alm = '1' WHERE id_alumno = '$id_alumno'";
		return ejecutarConsulta($sql);
	}
	public function becadoRechAlm($id_alumno) {
		$sql = "UPDATE alumnos SET becado_alm = '0' WHERE id_alumno = '$id_alumno'";
		return ejecutarConsulta($sql);
	}
	public function mostrarBec($id_becadoalm)
    {
        $sql="SELECT * FROM becados_alm bec INNER JOIN alumnos alm ON alm.id_alumno = bec.id_alumno WHERE id_becadoalm='$id_becadoalm'";
        return ejecutarConsultaSimpleFila($sql);
    }
	public function datPerfAlm($id_alumno) {
		try {
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc -> prepare("SELECT * FROM alumnos alm
				INNER JOIN det_grupo det ON det.id_detgrupo = alm.id_detgrupo
				INNER JOIN grupos grp ON grp.id_grupo = det.id_grupo
				WHERE id_alumno = :id_alumno");
			$stmt -> bindParam("id_alumno", $id_alumno, PDO::PARAM_INT);
			$stmt -> execute();
			$data = $stmt -> fetch(PDO::FETCH_OBJ);
			return $data;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
		$dbc = null; $stmt = null;
	}
	public function cantJustif($id_alumno) {
		try {
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc -> prepare("SELECT COUNT(id_justificante) AS 'Cantidad' FROM justificantes jus INNER JOIN alumnos alm ON alm.id_alumno = jus.id_alumno WHERE alm.id_alumno = :id_alumno");
			$stmt -> bindParam("id_alumno", $id_alumno, PDO::PARAM_INT);
			$stmt -> execute();
			$data = $stmt -> fetch(PDO::FETCH_OBJ);
			return $data;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
		$dbc = null; $stmt = null;
	}
	public function cantJustifImp($id_alumno) {
		try {
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc -> prepare("SELECT COUNT(id_justificante) AS 'Cantidad' FROM justificantes jus INNER JOIN alumnos alm ON alm.id_alumno = jus.id_alumno WHERE alm.id_alumno = :id_alumno && estado_justif = 1");
			$stmt -> bindParam("id_alumno", $id_alumno, PDO::PARAM_INT);
			$stmt -> execute();
			$data = $stmt -> fetch(PDO::FETCH_OBJ);
			return $data;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
		$dbc = null; $stmt = null;
	}
	public function cantJustifAcept($id_alumno) {
		try {
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc -> prepare("SELECT COUNT(id_justificante) AS 'Cantidad' FROM justificantes jus INNER JOIN alumnos alm ON alm.id_alumno = jus.id_alumno WHERE alm.id_alumno = :id_alumno && estado_justif = 0");
			$stmt -> bindParam("id_alumno", $id_alumno, PDO::PARAM_INT);
			$stmt -> execute();
			$data = $stmt -> fetch(PDO::FETCH_OBJ);
			return $data;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
		$dbc = null; $stmt = null;
	}
	public function aceptJustif($id_justificante) {
		$sql = "UPDATE justificantes SET estado_justif = '1' WHERE id_justificante = '$id_justificante'";
		return ejecutarConsulta($sql);
	}
	public function rechJustif($id_justificante) {
		$sql = "UPDATE justificantes SET estado_justif = '0' WHERE id_justificante = '$id_justificante'";
		return ejecutarConsulta($sql);
	}
	public function notifJustifGrp($id_docente, $id_detgrupo) {
		try {
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc -> prepare("SELECT COUNT(just.id_justificante) AS 'Cantidad' FROM justificantes just 
				INNER JOIN alumnos alm ON alm.id_alumno = just.id_alumno 
				INNER JOIN det_grupo det ON det.id_detgrupo = alm.id_detgrupo 
				INNER JOIN grupos grp ON grp.id_grupo = det.id_grupo
				INNER JOIN docentes doc ON doc.id_docente = det.id_docente 
				WHERE doc.id_docente = :id_docente && just.estado_justif = 0 && det.id_detgrupo = :id_detgrupo && just.cuatrimestre_justif = grp.cuatrimestre_g");
			$stmt -> bindParam("id_docente", $id_docente, PDO::PARAM_INT);
			$stmt -> bindParam("id_detgrupo", $id_detgrupo, PDO::PARAM_INT);
			$stmt -> execute();
			$data = $stmt ->fetch(PDO::FETCH_OBJ);
			return $data;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
		$dbc = null; $stmt = null;
	}
	public function notifJustifAlm($id_docente, $id_detgrupo, $id_alumno) {
		try {
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc -> prepare("SELECT COUNT(just.id_justificante) AS 'Cantidad' FROM justificantes just INNER JOIN alumnos alm ON alm.id_alumno = just.id_alumno INNER JOIN det_grupo det ON det.id_detgrupo = alm.id_detgrupo INNER JOIN docentes doc ON doc.id_docente = det.id_docente WHERE doc.id_docente = :id_docente && det.id_detgrupo = :id_detgrupo && alm.id_alumno = :id_alumno && just.estado_justif = 0");
			$stmt -> bindParam("id_docente", $id_docente, PDO::PARAM_INT);
			$stmt -> bindParam("id_detgrupo", $id_detgrupo, PDO::PARAM_INT);
			$stmt -> bindParam("id_alumno", $id_alumno, PDO::PARAM_INT);
			$stmt -> execute();
			$data = $stmt ->fetch(PDO::FETCH_OBJ);
			return $data;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
		$dbc = null;
	}
	public function cantTutPers($id_alumno) {
		try {
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc -> prepare("SELECT COUNT(id_tutpersonales) AS 'Cantidad' FROM tut_personales tut INNER JOIN alumnos alm ON alm.id_alumno = tut.id_alumno WHERE alm.id_alumno = :id_alumno");
			$stmt -> bindParam("id_alumno", $id_alumno, PDO::PARAM_INT);
			$stmt -> execute();
			$data = $stmt -> fetch(PDO::FETCH_OBJ);
			return $data;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
		$dbc = null; $stmt = null;
	}
	public function cantTutPerAcept($id_alumno) {
		try {
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$valid = 1;
			$stmt = $dbc -> prepare("SELECT COUNT(id_tutpersonales) AS 'Cantidad' FROM tut_personales WHERE id_alumno = :id_alumno && estado_tut = :valid");
			$stmt -> bindParam("id_alumno", $id_alumno, PDO::PARAM_INT);
			$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
			$stmt -> execute();
			$data = $stmt -> fetch(PDO::FETCH_OBJ);
			return $data;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
		$dbc = null; $stmt = null;
	}
	public function cantTutPerSolic($id_alumno) {
		try {
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$inval = 0;
			$stmt = $dbc -> prepare("SELECT COUNT(id_tutpersonales) AS 'Cantidad' FROM tut_personales WHERE id_alumno = :id_alumno && estado_tut = :inval");
			$stmt -> bindParam("id_alumno", $id_alumno, PDO::PARAM_INT);
			$stmt -> bindParam("inval", $inval, PDO::PARAM_INT);
			$stmt -> execute();
			$data = $stmt -> fetch(PDO::FETCH_OBJ);
			return $data;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
		$dbc = null; $stmt = null;
	}
	public function cantMaleAlmGrp($id_detgrupo, $id_docente) {
		try {
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc -> prepare("SELECT COUNT(id_alumno) AS 'CantidadMale' FROM alumnos alm INNER JOIN det_grupo det ON det.id_detgrupo = alm.id_detgrupo INNER JOIN docentes doc ON doc.id_docente = det.id_docente WHERE det.id_detgrupo = :id_detgrupo && doc.id_docente = :id_docente && alm.sexo_al = 'Masculino'");
			$stmt -> bindParam("id_detgrupo", $id_detgrupo, PDO::PARAM_INT);
			$stmt -> bindParam("id_docente", $id_docente, PDO::PARAM_INT);
			$stmt -> execute();
			$data = $stmt -> fetch(PDO::FETCH_OBJ);
			return $data;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
		$dbc = null;
	}
	public function cantFemaleAlmGrp($id_detgrupo, $id_docente) {
		try {
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc -> prepare("SELECT COUNT(id_alumno) AS 'CantidadFemale' FROM alumnos alm INNER JOIN det_grupo det ON det.id_detgrupo = alm.id_detgrupo INNER JOIN docentes doc ON doc.id_docente = det.id_docente WHERE det.id_detgrupo = :id_detgrupo && doc.id_docente = :id_docente && alm.sexo_al = 'Femenino'");
			$stmt -> bindParam("id_detgrupo", $id_detgrupo, PDO::PARAM_INT);
			$stmt -> bindParam("id_docente", $id_docente, PDO::PARAM_INT);
			$stmt -> execute();
			$data = $stmt -> fetch(PDO::FETCH_OBJ);
			return $data;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
		$dbc = null;
	}
	public function cantMaleBecGrp($id_detgrupo, $id_docente) {
		try {
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc -> prepare("SELECT COUNT(bec.id_becadoalm) AS 'CantidadBecMale' FROM becados_alm bec INNER JOIN alumnos alm ON alm.id_alumno = bec.id_alumno INNER JOIN det_grupo det ON det.id_detgrupo = alm.id_detgrupo INNER JOIN docentes doc ON doc.id_docente = det.id_docente WHERE det.id_detgrupo = :id_detgrupo && doc.id_docente = :id_docente && alm.sexo_al = 'Masculino' && alm.becado_alm = 1");
			$stmt -> bindParam("id_detgrupo", $id_detgrupo, PDO::PARAM_INT);
			$stmt -> bindParam("id_docente", $id_docente, PDO::PARAM_INT);
			$stmt -> execute();
			$data = $stmt -> fetch(PDO::FETCH_OBJ);
			return $data;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
		$dbc = null;
	}
	public function cantFemaleBecGrp($id_detgrupo, $id_docente) {
		try {
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc -> prepare("SELECT COUNT(bec.id_becadoalm) AS 'CantidadBecFemale' FROM becados_alm bec INNER JOIN alumnos alm ON alm.id_alumno = bec.id_alumno INNER JOIN det_grupo det ON det.id_detgrupo = alm.id_detgrupo INNER JOIN docentes doc ON doc.id_docente = det.id_docente WHERE det.id_detgrupo = :id_detgrupo && doc.id_docente = :id_docente && alm.sexo_al = 'Femenino' && alm.becado_alm = 1");
			$stmt -> bindParam("id_detgrupo", $id_detgrupo, PDO::PARAM_INT);
			$stmt -> bindParam("id_docente", $id_docente, PDO::PARAM_INT);
			$stmt -> execute();
			$data = $stmt -> fetch(PDO::FETCH_OBJ);
			return $data;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
		$dbc = null;
	}
	public function datHistAlm($id_tutpersonales){
		try {
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc -> prepare("SELECT * from tut_personales WHERE id_tutpersonales = :id_tutpersonales");
			$stmt -> bindParam("id_tutpersonales", $id_tutpersonales, PDO::PARAM_INT);
			$stmt -> execute();
			$data = $stmt -> fetch(PDO::FETCH_OBJ);
			return $data;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
		$dbc = null;
	}
	public function valDatPerAlm($id_alumno) {
		try {
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc -> prepare("SELECT COUNT(id_datpersonalesalm) AS 'Cantidad' FROM datpersonales_alm dat INNER JOIN alumnos alm ON alm.id_alumno = dat.id_alumno WHERE alm.id_alumno = :id_alumno");
			$stmt -> bindParam("id_alumno", $id_alumno, PDO::PARAM_INT);
			$stmt -> execute();
			$data = $stmt -> fetch(PDO::FETCH_OBJ);
			return $data;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
		$dbc = null;
	}

	public function datAlmAll($id_alumno) {
		try {
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc -> prepare("SELECT * FROM datpersonales_alm dat 
				INNER JOIN alumnos alm ON alm.id_alumno = dat.id_alumno 
				INNER JOIN det_grupo det ON det.id_detgrupo = alm.id_detgrupo 
				INNER JOIN docentes doc ON doc.id_docente = det.id_docente 
				INNER JOIN carreras car ON car.id_carrera = det.id_carrera 
				INNER JOIN grupos grp ON grp.id_grupo = det.id_grupo 
				WHERE alm.id_alumno = :id_alumno");
			$stmt -> bindParam("id_alumno", $id_alumno, PDO::PARAM_INT);
			$stmt -> execute();
			$data = $stmt -> fetch(PDO::FETCH_OBJ);
			return $data;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
		$dbc = null;
	}

	public function valDatEnc($id_alumno) {
		try {
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc -> prepare("SELECT enc.id_enctestalm, COUNT(enc.id_enctestalm) AS 'CantEnc', enc.fecha_reg FROM enctes_alm enc INNER JOIN alumnos alm ON alm.id_alumno = enc.id_alumno WHERE enc.id_alumno = :id_alumno");
			$stmt -> bindParam("id_alumno", $id_alumno, PDO::PARAM_INT);
			$stmt -> execute();
			$data = $stmt -> fetch(PDO::FETCH_OBJ);
			return $data;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
		$dbc = null;
	}

	public function valDataEncTest($id_enctestalm, $id_alumno) {
		try {
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc -> prepare("SELECT COUNT(enc.id_enctestalm) AS 'CantVal' FROM enctes_alm enc WHERE enc.id_enctestalm = :id_enctestalm && enc.id_alumno = :id_alumno");
			$stmt -> bindParam("id_enctestalm", $id_enctestalm, PDO::PARAM_INT);
			$stmt -> bindParam("id_alumno", $id_alumno, PDO::PARAM_INT);
			$stmt -> execute();
			$data = $stmt -> fetch(PDO::FETCH_OBJ);
			return $data;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
		$dbc = null;
	}

	public function dataEnctTest($id_enctestalm, $id_alumno) {
		try {
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc -> prepare("SELECT * FROM enctes_alm enc WHERE enc.id_enctestalm = :id_enctestalm && enc.id_alumno = :id_alumno");
			$stmt -> bindParam("id_enctestalm", $id_enctestalm, PDO::PARAM_INT);
			$stmt -> bindParam("id_alumno", $id_alumno, PDO::PARAM_INT);
			$stmt -> execute();
			$data = $stmt -> fetch(PDO::FETCH_OBJ);
			return $data;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
		$dbc = null;
	}

	public function validEvalTest($id_enctestalm) {
		try {
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc -> prepare("SELECT COUNT(id_evaltest) AS 'Cantidad' FROM evaluacion_test evt WHERE id_enctestalm = :id_enctestalm");
			$stmt -> bindParam("id_enctestalm", $id_enctestalm, PDO::PARAM_INT);
			$stmt -> execute();
			$data = $stmt -> fetch(PDO::FETCH_OBJ);
			return $data;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
		$dbc = null;
	}

	public function dataEvalTest($id_enctestalm) {
		try {
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc -> prepare("SELECT * FROM evaluacion_test WHERE id_enctestalm = :id_enctestalm");
			$stmt -> bindParam("id_enctestalm", $id_enctestalm, PDO::PARAM_INT);
			$stmt -> execute();
			$data = $stmt -> fetch(PDO::FETCH_OBJ);
			return $data;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
		$dbc = null;
	}

	public function dataImpTest($id_evaltest) {
		try {
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc -> prepare("SELECT * FROM evaluacion_test ev 
				INNER JOIN enctes_alm enc ON enc.id_enctestalm = ev.id_enctestalm
				INNER JOIN alumnos alm ON alm.id_alumno = enc.id_alumno
				INNER JOIN datpersonales_alm da ON da.id_alumno = alm.id_alumno 
				INNER JOIN det_grupo det ON det.id_detgrupo = alm.id_detgrupo
				INNER JOIN docentes doc ON doc.id_docente = det.id_docente
				INNER JOIN carreras car ON car.id_carrera = det.id_carrera
				INNER JOIN grupos grp ON grp.id_grupo = det.id_grupo
				WHERE ev.id_evaltest = :id_evaltest");
			$stmt -> bindParam("id_evaltest", $id_evaltest, PDO::PARAM_INT);
			$stmt -> execute();
			$data = $stmt -> fetch(PDO::FETCH_OBJ);
			return $data;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
		$dbc = null; $stmt = null;
	}

	public function datBecBaj($id_alumno) {
		try {
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$valid = 1;
			$stmt = $dbc -> prepare("SELECT * FROM becados_alm bec INNER JOIN alumnos alm ON alm.id_alumno = bec.id_alumno WHERE bec.id_alumno = :id_alumno && alm.becado_alm = 1");
			$stmt -> bindParam("id_alumno", $id_alumno, PDO::PARAM_INT);
			//$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
			$stmt -> execute();
			$data = $stmt -> fetch(PDO::FETCH_OBJ);
			return $data;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';								
		}
		$dbc = null; $stmt = null;
	}

	public function datAlumno($id_alumno) {
		try {
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc -> prepare("SELECT * FROM alumnos alm
				WHERE alm.id_alumno = :id_alumno");
			$stmt -> bindParam("id_alumno", $id_alumno, PDO::PARAM_INT);
			$stmt -> execute();
			$data = $stmt -> fetch(PDO::FETCH_OBJ);
			return $data;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
		$dbc = null; $stmt = null;
	}

	public function datEncBaj($id_alumno) {
		try {
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc -> prepare("SELECT * FROM evaluacion_test ev 
				INNER JOIN enctes_alm enc ON enc.id_enctestalm = ev.id_enctestalm
				INNER JOIN alumnos alm ON alm.id_alumno = enc.id_alumno
				WHERE alm.id_alumno = :id_alumno");
			$stmt -> bindParam("id_alumno", $id_alumno, PDO::PARAM_INT);
			$stmt -> execute();
			$data = $stmt -> fetch(PDO::FETCH_OBJ);
			return $data;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
		$dbc = null; $stmt = null;
	}

	public function validBajDat($id_alumno) {
		try {
			$valid = 1;
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc -> prepare("SELECT COUNT(id_bajaalmdat) AS 'CANTIDAD' FROM bajasalm_dat WHERE id_alumno = :id_alumno && estado_baj_alm = :valid");
			$stmt -> bindParam("id_alumno", $id_alumno, PDO::PARAM_INT);
			$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
			$stmt -> execute();
			$data = $stmt -> fetch(PDO::FETCH_OBJ);
			return $data;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';	
		}
	}

	public function keyBajAlm($id_alumno) {
		try {
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc -> prepare("SELECT id_bajaalmdat, fecha_reg_baj FROM bajasalm_dat WHERE id_alumno = :id_alumno");
			$stmt -> bindParam("id_alumno", $id_alumno, PDO::PARAM_INT);
			$stmt -> execute();
			$data = $stmt -> fetch(PDO::FETCH_OBJ);
			return $data;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';	
		}
	}

	public function datBajAlmValid($id_bajaalmdat) {
		try {
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc -> prepare("SELECT COUNT(id_bajaalmdat) AS 'CantVal' FROM bajasalm_dat WHERE id_bajaalmdat = :id_bajaalmdat");
			$stmt -> bindParam("id_bajaalmdat", $id_bajaalmdat, PDO::PARAM_INT);
			$stmt -> execute();
			$data = $stmt -> fetch(PDO::FETCH_OBJ);
			return $data;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';	
		}
	}

	public function datBecAlm($id_alumno) {
		try {
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$valid = 1;
			$stmt = $dbc -> prepare("SELECT * FROM becados_alm bec 
				INNER JOIN alumnos alm ON alm.id_alumno = bec.id_alumno
				WHERE alm.becado_alm = :valid && alm.id_alumno = :id_alumno");
			$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
			$stmt -> bindParam("id_alumno", $id_alumno, PDO::PARAM_INT);
			$stmt -> execute();
			$data = $stmt -> fetch(PDO::FETCH_OBJ);
			return $data;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';	
		}
	}

	public function datBajAlm($id_bajaalmdat) {
		try {
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc -> prepare("SELECT * FROM bajasalm_dat WHERE id_bajaalmdat = :id_bajaalmdat");
			$stmt -> bindParam("id_bajaalmdat", $id_bajaalmdat, PDO::PARAM_INT);
			$stmt -> execute();
			$data = $stmt -> fetch(PDO::FETCH_OBJ);
			return $data;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';	
		}
	}

	public function dirNomb($id_carrera) {
		try {
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$valid = 1;
			$stmt = $dbc -> prepare("SELECT dir.nombre_c_dir FROM directores dir WHERE dir.id_carrera = :id_carrera && dir.estado_dir = :valid");
			$stmt -> bindParam("id_carrera", $id_carrera, PDO::PARAM_INT);
			$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
			$stmt -> execute();
			$data = $stmt -> fetch(PDO::FETCH_OBJ);
			return $data;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';	
		}
	}

	public function validJustif($id_justificante) {
		try {
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc -> prepare("SELECT COUNT(id_justificante) AS 'ValJustif' FROM justificantes
			WHERE id_justificante = :id_justificante");
			$stmt -> bindParam("id_justificante", $id_justificante, PDO::PARAM_INT);
			$stmt -> execute();
			$data = $stmt -> fetch(PDO::FETCH_OBJ);
			return $data;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';	
		}
	}

	public function justifDat($id_justificante) {
		try {
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc -> prepare("SELECT * FROM justificantes jus 
			INNER JOIN alumnos alm ON alm.id_alumno = jus.id_alumno
			INNER JOIN det_grupo det ON det.id_detgrupo = alm.id_detgrupo
			INNER JOIN carreras car ON car.id_carrera = det.id_carrera
			INNER JOIN docentes doc ON doc.id_docente = det.id_docente
			WHERE jus.id_justificante = :id_justificante");
			$stmt -> bindParam("id_justificante", $id_justificante, PDO::PARAM_INT);
			$stmt -> execute();
			$data = $stmt -> fetch(PDO::FETCH_OBJ);
			return $data;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
			
		}
	}

	public function datMyReportEnv($tag, $clv) {
    	try {
    		$dbc = new Connect();
			$dbc = $dbc -> getDB();
    		$stmt = $dbc -> prepare("SELECT * FROM reportsprob WHERE tag_user = :tag AND id_user = :clv");
    		$stmt -> bindParam("tag", $tag, PDO::PARAM_STR);
    		$stmt -> bindParam("clv", $clv, PDO::PARAM_INT);
    		$stmt -> execute();
    		return $stmt;
    	} catch (PDOException $e) {
    		echo '{"error":{"text":'.$e->getMessage().'}}';
    	}
    }

    public function directRegister(){
		try {
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$valid = 1;
			$stmt = $dbc->prepare("SELECT * FROM directores WHERE estado_dir = :valid ORDER BY nombre_c_dir"); 
			$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt;
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
	}

	public function dataDirectSel($clv) {
		try {
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc->prepare("SELECT * FROM directores dir INNER JOIN carreras car ON car.id_carrera = dir.id_carrera WHERE id_director = :clv"); 
			$stmt -> bindParam("clv", $clv, PDO::PARAM_INT);
			$stmt->execute();
			$data = $stmt -> fetch(PDO::FETCH_OBJ);
			return $data;
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
	}

	public function docentRegister($keyDoc, $clv_car){
		try {
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$valid = 1;
			$stmt = $dbc->prepare("SELECT * FROM docentes WHERE condicion_doc = :valid && id_docente != :keyDoc and id_carrera = :car ORDER BY nombre_c_doc"); 
			$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
			$stmt -> bindParam("keyDoc", $keyDoc, PDO::PARAM_INT);
			$stmt -> bindParam("car", $clv_car, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt;
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
	}

	public function dataDocentSel($clv) {
		try {
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc->prepare("SELECT * FROM docentes WHERE id_docente = :clv"); 
			$stmt -> bindParam("clv", $clv, PDO::PARAM_INT);
			$stmt->execute();
			$data = $stmt -> fetch(PDO::FETCH_OBJ);
			return $data;
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
	}

	public function coordiRegister(){
		try {
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$valid = 1;
			$stmt = $dbc->prepare("SELECT * FROM coordinadores WHERE estado_cor = :valid ORDER BY nombre_c_cor"); 
			$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt;
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
	}

	public function dataCoordiSel($clv) {
		try {
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc->prepare("SELECT * FROM coordinadores WHERE id_coordinador = :clv"); 
			$stmt -> bindParam("clv", $clv, PDO::PARAM_INT);
			$stmt->execute();
			$data = $stmt -> fetch(PDO::FETCH_OBJ);
			return $data;
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
	}
}