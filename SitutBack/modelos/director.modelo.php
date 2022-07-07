<?php 


include 'conexion.php';
include 'conect.php';

class Director 
{
	
	function __construct()
	{
		
	}
	public function userDirDet($id_director) {
		try {
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc->prepare("SELECT * FROM directores dir INNER JOIN carreras car ON car.id_carrera = dir.id_carrera WHERE dir.id_director = :id_director");
			$stmt -> bindParam("id_director", $id_director, PDO::PARAM_INT);
			$stmt -> execute();
			$data = $stmt -> fetch(PDO::FETCH_OBJ);
			return $data;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
	}

	
	public function cantDir($car) {
		try {
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc->prepare("SELECT COUNT(id_docente) AS 'CantidadDir' FROM docentes WHERE id_carrera = :car");
			$stmt -> bindParam("car", $car, PDO::PARAM_INT);
			$stmt -> execute();
			$data = $stmt -> fetch(PDO::FETCH_OBJ);
			return $data;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
	}

	public function cantGrp($id_carrera) {
		try {
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc->prepare("SELECT COUNT(id_detgrupo) AS 'CantidadGrp' FROM det_grupo WHERE id_carrera = '$id_carrera'");
			$stmt -> execute();
			$data = $stmt -> fetch(PDO::FETCH_OBJ);
			return $data;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
	}
	
    public function mostrarGrp($id_detgrupo){
    	$sql = "SELECT * FROM det_grupo dgr 
			INNER JOIN grupos gr ON gr.id_grupo = dgr.id_grupo
			INNER JOIN docentes doc ON doc.id_docente = dgr.id_docente
			INNER JOIN carreras car ON car.id_carrera = dgr.id_carrera
			WHERE dgr.id_detgrupo = '$id_detgrupo'";
    	return ejecutarConsultaSimpleFila($sql);
    }

    public function mostrarDatTut($id_docente) {
    	try {
    		$dbc = new Connect();
			$dbc = $dbc -> getDB();
    		$stmt = $dbc -> prepare("SELECT * FROM docentes doc
    			WHERE doc.id_docente = :id_docente");
    		$stmt -> bindParam("id_docente", $id_docente, PDO::PARAM_INT);
    		$stmt -> execute();
    		$data = $stmt -> fetch(PDO::FETCH_OBJ);
    		return $data;
    	} catch (PDOException $e) {
    		echo '{"error":{"text":'. $e->getMessage() .'}}';
    	}
    }

    public function mostrarDatTutAll($id_docente) {
    	try {
    		$dbc = new Connect();
			$dbc = $dbc -> getDB();
    		$stmt = $dbc -> prepare("SELECT * FROM det_grupo det 
    			INNER JOIN carreras car ON car.id_carrera = det.id_carrera
    			INNER JOIN grupos gr ON gr.id_grupo = det.id_grupo
    			INNER JOIN docentes doc ON doc.id_docente = det.id_docente
    			WHERE doc.id_docente = :id_docente");
    		$stmt -> bindParam("id_docente", $id_docente, PDO::PARAM_INT);
    		$stmt -> execute();
    		$data = $stmt -> fetch(PDO::FETCH_OBJ);
    		return $data;
    	} catch (PDOException $e) {
    		echo '{"error":{"text":'. $e->getMessage() .'}}';
    	}
    }

    public function mostDatAlmPerf($id_alumno, $id_carrera) {
    	try {
    		$dbc = new Connect();
			$dbc = $dbc -> getDB();
    		$stmt = $dbc -> prepare("SELECT * FROM alumnos alm 
				INNER JOIN det_grupo det ON det.id_detgrupo = alm.id_detgrupo
				INNER JOIN carreras car ON det.id_carrera = car.id_carrera
				INNER JOIN grupos grp ON grp.id_grupo = det.id_grupo
				INNER JOIN docentes doc ON doc.id_docente = det.id_docente
				WHERE alm.id_alumno = :id_alumno && car.id_carrera = :id_carrera
				");
    		$stmt -> bindParam("id_alumno", $id_alumno, PDO::PARAM_INT);
    		$stmt -> bindParam("id_carrera", $id_carrera, PDO::PARAM_INT);
    		$stmt -> execute();
    		$data = $stmt -> fetch(PDO::FETCH_OBJ);
    		return $data;
    	} catch (PDOException $e) {
    		echo '{"error":{"text":'.$e->getMessage().'}}';
    	}
    }

    public function validDatPerAlm($id_alumno, $id_carrera) {
    	try {
    		$dbc = new Connect();
			$dbc = $dbc -> getDB();
    		$stmt = $dbc -> prepare("SELECT COUNT(alm.id_alumno) AS 'CantidadVal' FROM alumnos alm 
				INNER JOIN det_grupo det ON det.id_detgrupo = alm.id_detgrupo
				INNER JOIN carreras car ON det.id_carrera = car.id_carrera
				INNER JOIN datpersonales_alm dat ON dat.id_alumno = alm.id_alumno
				WHERE alm.id_alumno = :id_alumno && car.id_carrera = :id_carrera
				");
    		$stmt -> bindParam("id_alumno", $id_alumno, PDO::PARAM_INT);
    		$stmt -> bindParam("id_carrera", $id_carrera, PDO::PARAM_INT);
    		$stmt -> execute();
    		$data = $stmt -> fetch(PDO::FETCH_OBJ);
    		return $data;
    	} catch (PDOException $e) {
    		echo '{"error":{"text":'.$e->getMessage().'}}';
    	}
    }

    public function datPerAlm($id_alumno, $id_carrera) {
    	try {
    		$dbc = new Connect();
			$dbc = $dbc -> getDB();
    		$stmt = $dbc -> prepare("SELECT * FROM alumnos alm 
				INNER JOIN det_grupo det ON det.id_detgrupo = alm.id_detgrupo
				INNER JOIN carreras car ON det.id_carrera = car.id_carrera
				INNER JOIN datpersonales_alm dat ON dat.id_alumno = alm.id_alumno
				WHERE alm.id_alumno = :id_alumno && car.id_carrera = :id_carrera
				");
    		$stmt -> bindParam("id_alumno", $id_alumno, PDO::PARAM_INT);
    		$stmt -> bindParam("id_carrera", $id_carrera, PDO::PARAM_INT);
    		$stmt -> execute();
    		$data = $stmt -> fetch(PDO::FETCH_OBJ);
    		return $data;
    	} catch (PDOException $e) {
    		echo '{"error":{"text":'.$e->getMessage().'}}';
    	}
    }

    public function cantAlmGrp($id_detgrupo) {
    	try {
    		$dbc = new Connect();
			$dbc = $dbc -> getDB();
    		$valid = 1;
    		$stmt = $dbc -> prepare("SELECT COUNT(alm.id_alumno) AS 'CantAlm' FROM alumnos alm 
				INNER JOIN det_grupo det ON det.id_detgrupo = alm.id_detgrupo
				WHERE det.id_detgrupo = :id_detgrupo && alm.acept_grp = :valid");
    		$stmt -> bindParam("id_detgrupo", $id_detgrupo, PDO::PARAM_INT);
    		$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
    		$stmt -> execute();
    		$data = $stmt -> fetch(PDO::FETCH_OBJ);
    		return $data;
    	} catch (PDOException $e) {
    		echo '{"error":{"text":'.$e->getMessage().'}}';
    	}
    }

	public function valCarGrp($id_detgrupo, $id_carrera) {
    	try {
    		$dbc = new Connect();
			$dbc = $dbc -> getDB();
    		$stmt = $dbc -> prepare("SELECT COUNT(det.id_detgrupo) AS 'CantVal' FROM det_grupo det 
				INNER JOIN carreras car ON car.id_carrera = det.id_carrera
				WHERE det.id_detgrupo = :id_detgrupo && car.id_carrera = :id_carrera");
    		$stmt -> bindParam("id_detgrupo", $id_detgrupo, PDO::PARAM_INT);
    		$stmt -> bindParam("id_carrera", $id_carrera, PDO::PARAM_INT);
    		$stmt -> execute();
    		$data = $stmt -> fetch(PDO::FETCH_OBJ);
    		return $data;
    	} catch (PDOException $e) {
    		echo '{"error":{"text":'.$e->getMessage().'}}';
    	}
    }

    public function datGrpSel($id_detgrupo) {
    	try {
    		$dbc = new Connect();
			$dbc = $dbc -> getDB();
    		/* $stmt = $dbc -> prepare("SELECT doc.id_docente, grp.grupo_n, grp.estado_g, doc.nombre_c_doc, doc.foto_perf_doc FROM det_grupo det INNER JOIN docentes doc ON doc.id_docente = det.id_docente INNER JOIN grupos grp ON grp.id_grupo = det.id_detgrupo WHERE det.id_detgrupo = :id_detgrupo"); */
			$stmt = $dbc -> prepare("SELECT doc.id_docente,grp.grupo_n, grp.estado_g,doc.nombre_c_doc,doc.foto_perf_doc FROM det_grupo dgrupo INNER JOIN docentes doc ON doc.id_docente=dgrupo.id_docente INNER JOIN grupos grp ON dgrupo.id_grupo= grp.id_grupo WHERE dgrupo.id_detgrupo = :id_detgrupo");
    		$stmt -> bindParam("id_detgrupo", $id_detgrupo, PDO::PARAM_INT);
    		$stmt -> execute();
    		$data = $stmt -> fetch(PDO::FETCH_OBJ);
    		return $data;
    	} catch (PDOException $e) {
    		echo '{"error":{"text":'.$e->getMessage().'}}';
    	}
    }

    public function valDatBaj($id_carrera, $id_alumno) {
    	try {
    		$dbc = new Connect();
			$dbc = $dbc -> getDB();
    		$valid = 1;
    		$stmt = $dbc -> prepare("SELECT COUNT(baj.id_bajaalmdat) AS 'CantVal' FROM bajasalm_dat baj
				INNER JOIN alumnos alm ON alm.id_alumno = baj.id_alumno 
				INNER JOIN det_grupo det ON det.id_detgrupo = alm.id_detgrupo
				INNER JOIN carreras car ON car.id_carrera = det.id_carrera
				WHERE car.id_carrera = :id_carrera && alm.id_alumno = :id_alumno && baj.estado_baj_alm = :valid");
    		$stmt -> bindParam("id_carrera", $id_carrera, PDO::PARAM_INT);
    		$stmt -> bindParam("id_alumno", $id_alumno, PDO::PARAM_INT);
    		$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
    		$stmt -> execute();
    		$data = $stmt -> fetch(PDO::FETCH_OBJ);
    		return $data;
    	} catch (PDOException $e) {
    		echo '{"error":{"text":'.$e->getMessage().'}}';
    	}
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

	public function cantBajCar($id_carrera) {
		try {
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$valid = 1;
			$stmt = $dbc -> prepare("SELECT COUNT(baj.id_bajaalmdat) AS 'CantBaj' FROM bajasalm_dat baj 
				INNER JOIN alumnos alm ON alm.id_alumno = baj.id_alumno
				INNER JOIN det_grupo det ON det.id_detgrupo = alm.id_detgrupo
				INNER JOIN carreras car ON car.id_carrera = det.id_carrera
				WHERE car.id_carrera = :id_carrera && baj.estado_baj_alm = :valid");
			$stmt -> bindParam("id_carrera", $id_carrera, PDO::PARAM_INT);
			$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
			$stmt -> execute();
			$data = $stmt -> fetch(PDO::FETCH_OBJ);
			return $data;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
	}

	public function catnInactAlm($id_carrera) {
		try {
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$inval = 0;
			$valid = 1;
			$stmt = $dbc -> prepare("SELECT COUNT(alm.id_alumno) AS 'CantInact' FROM alumnos alm 
				INNER JOIN det_grupo det ON det.id_detgrupo = alm.id_detgrupo
				INNER JOIN carreras car ON car.id_carrera = det.id_carrera
				WHERE NOT id_alumno In (SELECT id_alumno FROM bajasalm_dat dat 
					WHERE dat.id_alumno = alm.id_alumno && dat.estado_baj_alm = :valid) &&
				car.id_carrera = :id_carrera && alm.estado_al = :inval");
			$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
			$stmt -> bindParam("id_carrera", $id_carrera, PDO::PARAM_INT);
			$stmt -> bindParam("inval", $inval, PDO::PARAM_INT);
			$stmt -> execute();
			$data = $stmt -> fetch(PDO::FETCH_OBJ);
			return $data;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
	}

	public function bajAlmDatPerf($id_alumno, $id_carrera) {
		try {
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$valid = 1;
			$stmt = $dbc -> prepare("SELECT * FROM bajasalm_dat baj
				INNER JOIN alumnos alm ON alm.id_alumno = baj.id_alumno 
				INNER JOIN det_grupo det ON det.id_detgrupo = alm.id_detgrupo
				INNER JOIN carreras car ON car.id_carrera = det.id_carrera
				WHERE car.id_carrera = :id_carrera && alm.id_alumno = :id_alumno && baj.estado_baj_alm = :valid");
			$stmt -> bindParam("id_carrera", $id_carrera, PDO::PARAM_INT);
			$stmt -> bindParam("id_alumno", $id_alumno, PDO::PARAM_INT);
			$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
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

    public function docentRegister($car){
		try {
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc->prepare("SELECT * FROM docentes WHERE condicion_doc = 1 and id_carrera = :car ORDER BY nombre_c_doc"); 
			$stmt -> bindParam("car", $car, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt;
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
	}

	public function directRegister($clv){
		try {
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc->prepare("SELECT * FROM directores WHERE id_director != :clv && estado_dir = 1 ORDER BY nombre_c_dir");
			$stmt -> bindParam("clv", $clv, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt;
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
	}

	public function coordiRegister(){
		try {
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc->prepare("SELECT * FROM coordinadores WHERE estado_cor = 1 ORDER BY nombre_c_cor");
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

	public function dataCordinSel($clv) {
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
//SELECT * FROM grupos WHERE NOT id_grupo In (SELECT id_grupo FROM det_grupo det WHERE det.id_carrera = 4);


?>