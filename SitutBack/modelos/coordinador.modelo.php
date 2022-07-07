<?php

include 'conexion.php';
include 'conect.php';
class Coordinador
{
	public function __construct()
	{

	}

	public function userCorDet($id_coordinador){
		try {
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc->prepare("SELECT * FROM coordinadores WHERE id_coordinador=:id_coordinador"); 
			$stmt->bindParam("id_coordinador", $id_coordinador,PDO::PARAM_INT);
			$stmt->execute();
			$data = $stmt->fetch(PDO::FETCH_OBJ); //User data
			return $data;
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
	}

	public function carreraRegister(){
		try {
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc->prepare("SELECT * FROM carreras ORDER BY nombre_car"); 
			$stmt->execute();
			return $stmt;
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
	}

	public function directRegister(){
		try {
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc->prepare("SELECT * FROM directores WHERE estado_dir = 1 ORDER BY nombre_c_dir"); 
			$stmt->execute();
			return $stmt;
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
	}

	public function docentRegister(){
		try {
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc->prepare("SELECT * FROM docentes WHERE condicion_doc = 1 ORDER BY nombre_c_doc"); 
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

	public function estadistCarCant(){
		try {
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc->prepare("SELECT count(id_carrera) AS 'Cantidad' FROM carreras");
			$stmt -> execute();
			$data = $stmt->fetch(PDO::FETCH_OBJ);
			return $data;
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
	}

	public function estadistDirCant(){
		try {
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc->prepare("SELECT count(id_director) AS 'Cantidad' FROM directores");
			$stmt -> execute();
			$data = $stmt->fetch(PDO::FETCH_OBJ);
			return $data;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
	}

	public function estadistDocCant(){
		try {
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc->prepare("SELECT count(id_docente) AS 'Cantidad' FROM docentes");
			$stmt -> execute();
			$data = $stmt -> fetch(PDO::FETCH_OBJ);
			return $data;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
	}

	public function estadistAlmCant(){
		try {
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc->prepare("SELECT COUNT(id_alumno) AS 'Cantidad' FROM alumnos");
			$stmt -> execute();
			$data = $stmt -> fetch(PDO::FETCH_OBJ);
			return $data;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
	}

	public function porcTestComplet() {
		try {
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc -> prepare("SELECT COUNT(id_alumno) AS 'CantidadAlm' FROM alumnos");
			$stmt -> execute();
			$data = $stmt -> fetch(PDO::FETCH_OBJ);
			$stmt1 = $dbc -> prepare("SELECT COUNT(id_enctestalm) AS 'CantidadTest' FROM enctes_alm");
			$stmt1 -> execute();
			$data1 = $stmt1 -> fetch(PDO::FETCH_OBJ);
			$oper1 = $data1 -> CantidadTest * 100;
			$oper2 = $oper1 / $data -> CantidadAlm;
			return number_format($oper2, 0, ".", ".");;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
	}

	public function porcBajaAlumnos() {
		try {
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc -> prepare("SELECT COUNT(id_alumno) AS 'CantidadAlm' FROM alumnos");
			$stmt -> execute();
			$data = $stmt -> fetch(PDO::FETCH_OBJ);
			$stmt1 = $dbc -> prepare("SELECT COUNT(baj.id_bajaalmdat) AS 'cantTotBaj' FROM bajasalm_dat baj WHERE baj.estado_baj_alm = 1");
			$stmt1 -> execute();
			$data1 = $stmt1 -> fetch(PDO::FETCH_OBJ);
			$oper1 = $data1 -> cantTotBaj * 100;
			$oper2 = $oper1 / $data -> CantidadAlm;
			return number_format($oper2, 0, ".", ".");;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
	}

	public function porcJustAlumnos() {
		try {
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc -> prepare("SELECT COUNT(id_alumno) AS 'CantidadAlm' FROM alumnos");
			$stmt -> execute();
			$data = $stmt -> fetch(PDO::FETCH_OBJ);
			$stmt1 = $dbc -> prepare("SELECT COUNT(id_justificante) AS 'cantJusAct' FROM justificantes WHERE estado_justif = 1");
			$stmt1 -> execute();
			$data1 = $stmt1 -> fetch(PDO::FETCH_OBJ);
			$oper1 = $data1 -> cantJusAct * 100;
			$oper2 = $oper1 / $data -> CantidadAlm;
			return number_format($oper2, 0, ".", ".");;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
	}

	public function datDirCar($id_carrera){
		try {
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$valid = 1;
			$stmt = $dbc->prepare("SELECT * FROM directores dir 
				INNER JOIN carreras car ON car.id_carrera = dir.id_carrera
				WHERE car.id_carrera = :id_carrera");
			$stmt -> bindParam("id_carrera", $id_carrera,PDO::PARAM_INT);
			$stmt -> execute();
			$data = $stmt->fetch(PDO::FETCH_OBJ);
			return $data;
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
	}

	public function cantAlmCar($id_carrera){
		try {
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$valid = 1;
			$stmt = $dbc->prepare("SELECT COUNT(alm.id_alumno) AS 'CantAlm' FROM alumnos alm 
					INNER JOIN det_grupo det ON det.id_detgrupo = alm.id_detgrupo
					INNER JOIN carreras car ON car.id_carrera = det.id_carrera
					WHERE alm.estado_al = :valid && alm.acept_grp = :valid && car.id_carrera = :id_carrera"); 
			$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
			$stmt -> bindParam("id_carrera", $id_carrera,PDO::PARAM_INT);
			$stmt -> execute();
			$data = $stmt->fetch(PDO::FETCH_OBJ);
			return $data;
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
	}

	public function cantAlmInact($id_carrera){
		try {
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$inval = 0;
			$valid = 1;
			$stmt = $dbc->prepare("SELECT COUNT(alm.id_alumno) AS 'CantAlm' FROM alumnos alm 
					INNER JOIN det_grupo det ON det.id_detgrupo = alm.id_detgrupo
					INNER JOIN carreras car ON car.id_carrera = det.id_carrera
					INNER JOIN bajasalm_dat baj ON baj.id_alumno = alm.id_alumno
					WHERE NOT alm.id_alumno IN (SELECT id_alumno from bajasalm_dat baj WHERE baj.id_alumno = alm.id_alumno && baj.estado_baj_alm = 0) 
					&& car.id_carrera = :id_carrera && alm.acept_grp = :inval && alm.estado_al = :inval"); 
			//$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
			$stmt -> bindParam("id_carrera", $id_carrera,PDO::PARAM_INT);
			$stmt -> bindParam("inval", $inval, PDO::PARAM_INT);
			$stmt -> bindParam("inval", $inval, PDO::PARAM_INT);
			$stmt -> execute();
			$data = $stmt->fetch(PDO::FETCH_OBJ);
			return $data;
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
	}

	public function cantAlmAcept($id_carrera){
		try {
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$inval = 0;
			$valid = 1;
			$stmt = $dbc->prepare("SELECT COUNT(alm.id_alumno) AS 'CantAlm' FROM alumnos alm 
					INNER JOIN det_grupo det ON det.id_detgrupo = alm.id_detgrupo
					INNER JOIN carreras car ON car.id_carrera = det.id_carrera
					WHERE alm.acept_grp = :inval && alm.estado_al = :valid && car.id_carrera = :id_carrera"); 
			$stmt -> bindParam("inval", $inval, PDO::PARAM_INT);
			$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
			$stmt -> bindParam("id_carrera", $id_carrera,PDO::PARAM_INT);
			$stmt -> execute();
			$data = $stmt->fetch(PDO::FETCH_OBJ);
			return $data;
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
	}

	public function cantBajCar($id_carrera){
		try {
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$valid = 1;
			$stmt = $dbc->prepare("SELECT COUNT(alm.id_alumno) AS 'CantAlm' FROM alumnos alm
				INNER JOIN det_grupo det ON det.id_detgrupo = alm.id_detgrupo
				INNER JOIN carreras car ON car.id_carrera = det.id_carrera
				INNER JOIN bajasalm_dat baj ON baj.id_alumno = alm.id_alumno
				WHERE car.id_carrera = :id_carrera && baj.estado_baj_alm = :valid");
			$stmt -> bindParam("id_carrera", $id_carrera,PDO::PARAM_INT);
			$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
			$stmt -> execute();
			$data = $stmt->fetch(PDO::FETCH_OBJ);
			return $data;
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
	}

	public function datGrpCarSel($id_grupo, $id_carrera) {
		try {
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$valid = 1;
			$stmt = $dbc -> prepare("SELECT * FROM alumnos alm 
				INNER JOIN det_grupo det ON det.id_detgrupo = alm.id_detgrupo
				INNER JOIN grupos grp ON grp.id_grupo = det.id_grupo
				INNER JOIN carreras car ON car.id_carrera = det.id_carrera
				INNER JOIN docentes doc ON doc.id_docente = det.id_docente
				WHERE grp.id_grupo = :id_grupo && car.id_carrera = :id_carrera && alm.estado_al = :valid && alm.acept_grp = :valid");
			$stmt -> bindParam("id_grupo", $id_grupo, PDO::PARAM_INT);
			$stmt -> bindParam("id_carrera", $id_carrera, PDO::PARAM_INT);
			$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
			$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
			$stmt -> execute();
			$data = $stmt -> fetch(PDO::FETCH_OBJ);
			return $data;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
	}

	public function datAlmGrpCarSel($id_grupo, $id_carrera, $id_alumno) {
		try {
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$valid = 1;
			$stmt = $dbc -> prepare("SELECT * FROM alumnos alm 
				INNER JOIN det_grupo det ON det.id_detgrupo = alm.id_detgrupo
				INNER JOIN grupos grp ON grp.id_grupo = det.id_grupo
				INNER JOIN carreras car ON car.id_carrera = det.id_carrera
				INNER JOIN docentes doc ON doc.id_docente = det.id_docente
				WHERE grp.id_grupo = :id_grupo && car.id_carrera = :id_carrera && alm.estado_al = :valid && alm.acept_grp = :valid && alm.id_alumno = :id_alumno");
			$stmt -> bindParam("id_grupo", $id_grupo, PDO::PARAM_INT);
			$stmt -> bindParam("id_carrera", $id_carrera, PDO::PARAM_INT);
			$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
			$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
			$stmt -> bindParam("id_alumno", $id_alumno, PDO::PARAM_INT);
			$stmt -> execute();
			$data = $stmt -> fetch(PDO::FETCH_OBJ);
			return $data;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
	}

	public function datPerAlm($id_alumno, $id_carrera, $id_grupo) {
    	try {
    		$dbc = new Connect();
			$dbc = $dbc -> getDB();
    		$stmt = $dbc -> prepare("SELECT * FROM alumnos alm 
				INNER JOIN det_grupo det ON det.id_detgrupo = alm.id_detgrupo
				INNER JOIN grupos grp ON grp.id_grupo = det.id_grupo
				INNER JOIN carreras car ON det.id_carrera = car.id_carrera
				INNER JOIN datpersonales_alm dat ON dat.id_alumno = alm.id_alumno
				WHERE alm.id_alumno = :id_alumno && car.id_carrera = :id_carrera &&
				grp.id_grupo = :id_grupo
				");
    		$stmt -> bindParam("id_alumno", $id_alumno, PDO::PARAM_INT);
    		$stmt -> bindParam("id_carrera", $id_carrera, PDO::PARAM_INT);
    		$stmt -> bindParam("id_grupo", $id_grupo, PDO::PARAM_INT);
    		$stmt -> execute();
    		$data = $stmt -> fetch(PDO::FETCH_OBJ);
    		return $data;
    	} catch (PDOException $e) {
    		echo '{"error":{"text":'.$e->getMessage().'}}';
    	}
    }

    public function datCarSel($id_carrera) {
    	try {
    		$dbc = new Connect();
			$dbc = $dbc -> getDB();
    		$stmt = $dbc -> prepare("SELECT * FROM carreras WHERE id_carrera = :id_carrera");
    		$stmt -> bindParam("id_carrera", $id_carrera, PDO::PARAM_INT);
    		$stmt -> execute();
    		$data = $stmt -> fetch(PDO::FETCH_OBJ);
    		return $data;
    	} catch (PDOException $e) {
    		echo '{"error":{"text":'.$e->getMessage().'}}';
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



}