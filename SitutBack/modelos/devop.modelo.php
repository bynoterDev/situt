<?php

include 'conexion.php';
include 'conect.php';
class Developer {

	public function __construct()
	{

	}

	public function devDet($clv){
		try {
			$clv = base64_decode($clv);
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc->prepare("SELECT * FROM devop WHERE id_devop=:clv"); 
			$stmt->bindParam("clv", $clv,PDO::PARAM_INT);
			$stmt->execute();
			$data = $stmt->fetch(PDO::FETCH_OBJ); //User data
			return $data;
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		} finally {
			$dbc = null; $stmt = null; $data = null;
		}
	}

	public function datSistem(){
		try {
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc->prepare("SELECT * FROM datsistem");
			$stmt->execute();
			$data = $stmt->fetch(PDO::FETCH_OBJ);
			return $data;
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		} finally {
			$dbc = null; $stmt = null; $data = null;
		}
	}

	public function cantReportsRes() {
		try {
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc->prepare("SELECT COUNT(id_report) AS 'Cantidad' FROM reportsprob WHERE estado_rep = 0"); 
			$stmt->execute();
			$data = $stmt->fetch(PDO::FETCH_OBJ);
			return $data;
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		} finally {
			$dbc = null; $stmt = null; $data = null;
		}
	}

	public function cantReportsPro() {
		try {
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc->prepare("SELECT COUNT(id_report) AS 'Cantidad' FROM reportsprob WHERE estado_rep = 1"); 
			$stmt->execute();
			$data = $stmt->fetch(PDO::FETCH_OBJ);
			return $data;
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		} finally {
			$dbc = null; $stmt = null; $data = null;
		}
	}

	public function estadistAdmCant() {
		try {
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc->prepare("SELECT COUNT(id_admin) AS 'Cantidad' FROM administradores");
			$stmt -> execute();
			$data = $stmt->fetch(PDO::FETCH_OBJ);
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

	public function estadistCorCant(){
		try {
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc->prepare("SELECT count(id_coordinador) AS 'Cantidad' FROM coordinadores");
			$stmt -> execute();
			$data = $stmt->fetch(PDO::FETCH_OBJ);
			return $data;
		} catch (PDOException $e) {
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

	public function adminsRegister(){
		try {
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc->prepare("SELECT * FROM administradores ORDER BY nombre_c"); 
			$stmt->execute();
			return $stmt;
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
	}

	public function cordinRegister(){
		try {
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc->prepare("SELECT * FROM coordinadores ORDER BY nombre_c_cor"); 
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
			$stmt = $dbc->prepare("SELECT * FROM directores ORDER BY nombre_c_dir"); 
			$stmt->execute();
			return $stmt;
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		} finally {
			$dbc = null; $stmt = null;
		}
	}

	public function docentRegister(){
		try {
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc->prepare("SELECT * FROM docentes ORDER BY nombre_c_doc"); 
			$stmt->execute();
			return $stmt;
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		} finally {
			$dbc = null; $stmt = null;
		}
	}

	/*----------  Notificaciones  ----------*/
	
	public function cantRepNotif() {
		try {
			$pending = 1;
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc->prepare("SELECT COUNT(id_report) AS 'CantidadRep' FROM reportsprob WHERE estado_rep = :pending"); 
			$stmt -> bindParam("pending", $pending, PDO::PARAM_INT);
			$stmt->execute();
			$data = $stmt -> fetch(PDO::FETCH_OBJ);
			return $data;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		} finally {
			$dbc = null; $stmt = null; $data = null;
		}
	}

	public function dataNotifRep() {
		try {
			$pending = 1;
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc->prepare("SELECT * FROM reportsprob WHERE estado_rep = :pending ORDER BY fecha_reg_rep DESC LIMIT 5"); 
			$stmt -> bindParam("pending", $pending, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		} finally {
			$dbc = null; $stmt = null;
		}
	}

	public function dataRepOpc($param) {
		try {
			$param = base64_decode($param);
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc -> prepare("SELECT * FROM reportsprob WHERE estado_rep = :param ORDER BY fecha_reg_rep");
			$stmt -> bindParam("param", $param, PDO::PARAM_INT);
			$stmt -> execute();
			return $stmt;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		} finally {
			$dbc = null; $stmt = null;
		}
	}

	public function dataRepSel($param) {
		try {
			$param = base64_decode($param);
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc -> prepare("SELECT * FROM reportsprob WHERE id_report = :param");
			$stmt -> bindParam("param", $param, PDO::PARAM_INT);
			$stmt -> execute();
			return $stmt;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		} finally {
			$dbc = null; $stmt = null; $data = null;
		}
	}

	public function datTagRepCor($clv, $tag) {
		try {
			$clv = base64_decode($clv);
			$tag = base64_decode($tag);
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc -> prepare("SELECT * FROM reportsprob rep INNER JOIN coordinadores dat ON dat.id_coordinador = rep.id_user WHERE id_report = :clv && tag_user = :tag");
			$stmt -> bindParam("clv", $clv, PDO::PARAM_INT);
			$stmt -> bindParam("tag", $tag, PDO::PARAM_STR);
			$stmt -> execute();
			$data = $stmt -> fetch(PDO::FETCH_OBJ);
			return $data;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		} finally {
			$dbc = null; $stmt = null; $data = null;
		}
	}

	public function datTagRepAdm($clv, $tag) {
		try {
			$clv = base64_decode($clv);
			$tag = base64_decode($tag);
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc -> prepare("SELECT * FROM reportsprob rep INNER JOIN administradores dat ON dat.id_admin = rep.id_user WHERE id_report = :clv && tag_user = :tag");
			$stmt -> bindParam("clv", $clv, PDO::PARAM_INT);
			$stmt -> bindParam("tag", $tag, PDO::PARAM_STR);
			$stmt -> execute();
			$data = $stmt -> fetch(PDO::FETCH_OBJ);
			return $data;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		} finally {
			$dbc = null; $stmt = null; $data = null;
		}
	}

	public function datTagRepDir($clv, $tag) {
		try {
			$clv = base64_decode($clv);
			$tag = base64_decode($tag);
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc -> prepare("SELECT * FROM reportsprob rep INNER JOIN directores dat ON dat.id_director = rep.id_user WHERE id_report = :clv && tag_user = :tag");
			$stmt -> bindParam("clv", $clv, PDO::PARAM_INT);
			$stmt -> bindParam("tag", $tag, PDO::PARAM_STR);
			$stmt -> execute();
			$data = $stmt -> fetch(PDO::FETCH_OBJ);
			return $data;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		} finally {
			$dbc = null; $stmt = null; $data = null;
		}
	}

	public function datTagRepDoc($clv, $tag) {
		try {
			$clv = base64_decode($clv);
			$tag = base64_decode($tag);
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc -> prepare("SELECT * FROM reportsprob rep INNER JOIN docentes dat ON dat.id_docente = rep.id_user WHERE id_report = :clv && tag_user = :tag");
			$stmt -> bindParam("clv", $clv, PDO::PARAM_INT);
			$stmt -> bindParam("tag", $tag, PDO::PARAM_STR);
			$stmt -> execute();
			$data = $stmt -> fetch(PDO::FETCH_OBJ);
			return $data;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		} finally {
			$dbc = null; $stmt = null; $data = null;
		}
	}

	public function datTagRepAlm($clv, $tag) {
		try {
			$clv = base64_decode($clv);
			$tag = base64_decode($tag);
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc -> prepare("SELECT * FROM reportsprob rep INNER JOIN alumnos dat ON dat.id_alumno = rep.id_user WHERE id_report = :clv && tag_user = :tag");
			$stmt -> bindParam("clv", $clv, PDO::PARAM_INT);
			$stmt -> bindParam("tag", $tag, PDO::PARAM_STR);
			$stmt -> execute();
			$data = $stmt -> fetch(PDO::FETCH_OBJ);
			return $data;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		} finally {
			$dbc = null; $stmt = null; $data = null;
		}
	}

	public function dataResultRep($clv) {
		try {
			$clv = base64_decode($clv);
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc -> prepare("SELECT * FROM represult rp INNER JOIN reportsprob re ON re.id_report = rp.id_reportprob WHERE rp.id_reportprob = :clv");
			$stmt -> bindParam("clv", $clv, PDO::PARAM_INT);
			$stmt -> execute();
			$data = $stmt -> fetch(PDO::FETCH_OBJ);
			return $data;
		} catch (Exception $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		} finally {
			$dbc = null; $stmt = null; $data = null;
		}
	}

	public function obtDataAdm($param) {
		try {
			$param = base64_decode($param);
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc -> prepare("SELECT * FROM administradores WHERE id_admin = :param");
			$stmt -> bindParam("param", $param, PDO::PARAM_INT);
			$stmt -> execute();
			$data = $stmt -> fetch(PDO::FETCH_OBJ);
			return $data;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		} finally {
			$dbc = null; $stmt = null; $data = null;
		}
	}

	public function obtDataCor($param) {
		try {
			$param = base64_decode($param);
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc -> prepare("SELECT * FROM coordinadores WHERE id_coordinador = :param");
			$stmt -> bindParam("param", $param, PDO::PARAM_INT);
			$stmt -> execute();
			$data = $stmt -> fetch(PDO::FETCH_OBJ);
			return $data;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		} finally {
			$dbc = null; $stmt = null; $data = null;
		}
	}

	public function obtDataDir($param) {
		try {
			$param = base64_decode($param);
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc -> prepare("SELECT * FROM directores dir INNER JOIN carreras car ON car.id_carrera = dir.id_carrera WHERE dir.id_director = :param");
			$stmt -> bindParam("param", $param, PDO::PARAM_INT);
			$stmt -> execute();
			$data = $stmt -> fetch(PDO::FETCH_OBJ);
			return $data;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		} finally {
			$dbc = null; $stmt = null; $data = null;
		}
	}

	public function obtDataDoc($param) {
		try {
			$param = base64_decode($param);
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc -> prepare("SELECT * FROM docentes WHERE id_docente = :param");
			$stmt -> bindParam("param", $param, PDO::PARAM_INT);
			$stmt -> execute();
			$data = $stmt -> fetch(PDO::FETCH_OBJ);
			return $data;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		} finally {
			$dbc = null; $stmt = null; $data = null;
		}
	}

	public function detCareer() {
		try {
			$valid = 1;
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc -> prepare("SELECT * FROM carreras car INNER JOIN directores dir ON dir.id_carrera = car.id_carrera WHERE dir.estado_dir = :valid");
			$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
			$stmt -> execute();
			return $stmt;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		} finally {
			$dbc = null; $stmt = null; 
		}
	}

	public function detailsStd($param) {
		try {
			$param = base64_decode($param);
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc -> prepare("SELECT * FROM alumnos al INNER JOIN det_grupo dt ON dt.id_detgrupo = al.id_detgrupo INNER JOIN grupos gr ON gr.id_grupo = dt.id_grupo INNER JOIN carreras car ON car.id_carrera = dt.id_carrera WHERE al.id_alumno = :param");
			$stmt -> bindParam("param", $param, PDO::PARAM_INT);
			$stmt -> execute();
			$data = $stmt -> fetch(PDO::FETCH_OBJ);
			return $data;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		} finally {
			$dbc = null; $stmt = null; $data = null; 
		}	
	}

	public function detailTest($param) {
		try {
			$param = base64_decode($param);
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
				WHERE alm.id_alumno = :param");
			$stmt -> bindParam("param", $param, PDO::PARAM_INT);
			$stmt -> execute();
			return $stmt;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		} finally {
			$dbc = null; $stmt = null; $data = null; 
		}	
	}

}