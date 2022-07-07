 <?php 

ob_start();
session_start();

if ($_SESSION['keyAdm'] == "" || $_SESSION['keyAdm'] == null) {
	header("Location:../../Index.php");
} else {
	require_once '../../modelos/admin.modelo.php';
	$administrador = new Administrador();
	$keyAdm = $_SESSION['keyAdm'];
	$fechAct = date("Y-m-d");
	$dbConexion = new Connect();
	$dbConexion = $dbConexion -> getDB();
	switch ($_GET['oper']) {
		case 'confCont':
			$contAct = isset($_POST['contAct']) ? limpiarDatos($_POST['contAct']) : "";
			$newCont = isset($_POST['newCont']) ? limpiarDatos($_POST['newCont']) : "";
			$repCont = isset($_POST['repCont']) ? limpiarDatos($_POST['repCont']) : "";
			$contEnc = sha1($repCont);
			$contActEnc = sha1($contAct);
			$valid = $dbConexion->prepare("SELECT contrasena, contdesc FROM administradores WHERE id_admin=:keyAdm && contrasena=:contActEnc && contdesc=:contAct");
			$valid -> bindParam("keyAdm", $keyAdm, PDO::PARAM_INT);
			$valid -> bindParam("contActEnc", $contActEnc, PDO::PARAM_STR);
			$valid -> bindParam("contAct", $contAct, PDO::PARAM_STR);
			$valid->execute();
			$data = $valid->rowCount();
			if ($data === 1) {
				$stmt = $dbConexion->prepare("UPDATE administradores SET contrasena=:contEnc, contdesc=:newCont WHERE id_admin=:keyAdm");
				$stmt -> bindParam("contEnc", $contEnc, PDO::PARAM_STR);
				$stmt -> bindParam("newCont", $newCont, PDO::PARAM_STR);
				$stmt -> bindParam("keyAdm", $keyAdm, PDO::PARAM_INT);
				$resstmt = $stmt->execute();
				if ( $resstmt ) { echo "1"; } else { echo "0"; }
			} else {
				echo "2";
			}
			$valid = null; $stmt = null; $dbConexion = null;
		break;
		case 'confDat':
			$nomAdm = isset($_POST['nomAdm']) ? limpiarDatos($_POST['nomAdm']) : "";
			$corAdm = isset($_POST['corAdm']) ? limpiarDatos($_POST['corAdm']) : "";
			$usrAdm = isset($_POST['usrAdm']) ? limpiarDatos($_POST['usrAdm']) : "";
			$passConf = isset($_POST['passConf']) ? limpiarDatos($_POST['passConf']) : "";
			$passConfEnc = sha1($passConf);
			$validPas = $dbConexion->prepare("SELECT * FROM administradores WHERE id_admin=:keyAdm && contrasena=:passConfEnc && contdesc=:passConf");
			$validPas -> bindParam("keyAdm", $keyAdm, PDO::PARAM_INT);
			$validPas -> bindParam("passConfEnc", $passConfEnc, PDO::PARAM_STR);
			$validPas -> bindParam("passConf", $passConf, PDO::PARAM_STR);
			$validPas -> execute();
			$result = $validPas -> rowCount();
			if ($result == 1) {
				$stmt = $dbConexion->prepare("UPDATE administradores SET nombre_c=:nomAdm, correo=:corAdm, usuario=:usrAdm WHERE id_admin=:keyAdm");
				$stmt -> bindParam("nomAdm", $nomAdm, PDO::PARAM_STR);
				$stmt -> bindParam("corAdm", $corAdm, PDO::PARAM_STR);
				$stmt -> bindParam("usrAdm", $usrAdm, PDO::PARAM_STR);
				$stmt -> bindParam("keyAdm", $keyAdm, PDO::PARAM_INT);
				$resstmt = $stmt -> execute();
				if ( $resstmt ) { echo "1"; } else { echo "0"; }
			} else {
				echo "2";
			}
			$validPas = null; $stmt = null; $dbConexion = null;
			break;
		case 'guardarCarr':
			$nomCar = isset($_POST['nomCar']) ? limpiarDatos($_POST['nomCar']) : "";
			$estCar = isset($_POST['estCar']) ? limpiarDatos($_POST['estCar']) : "";
			$valid = $dbConexion->prepare("SELECT * FROM carreras WHERE nombre_car=:nomCar");
			$valid -> bindParam("nomCar", $nomCar, PDO::PARAM_STR);
			$valid -> execute();
			$resvalid = $valid -> rowCount();
			if ($resvalid != 1) {
				$stmt = $dbConexion->prepare("INSERT INTO carreras (nombre_car, estado_car, fecha_reg_car) VALUES (:nomCar, :estCar, :fechAct)");
				$stmt -> bindParam(":nomCar", $nomCar, PDO::PARAM_STR);
				$stmt -> bindParam(":estCar", $estCar, PDO::PARAM_INT);
				$stmt -> bindParam(":fechAct", $fechAct, PDO::PARAM_STR);
				$stmt -> execute();
				$result = $stmt -> rowCount();
				if ($result == 1) {
					echo "1";
				} else {
					echo "0";
				}
			} else {
				echo "2";
			}
			$valid = null; $stmt = null; $dbConexion = null;
			break;	
		case 'listarCarreras':
			$valid = 1;
			$stmt = $dbConexion -> prepare("SELECT * FROM carreras WHERE estado_car = :valid");
			$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
			$stmt -> execute();
			$data = Array();
			while ($reg = $stmt -> fetch(PDO::FETCH_OBJ) ){
            $data[]=array(
                "0"=>$reg->nombre_car,
                "1"=>$reg->fecha_reg_car,
                "2"=>'<button data-toggle="modal" data-backdrop="false" data-target="#editCar" class="btn btn-sm btn-outline-warning" onclick="mostrarCarrera('.$reg->id_carrera.')"><i class="fas fa-edit"></i></button>'.
                    ' <button class="btn btn-sm btn-outline-danger" onclick="desactivarCarrera('.$reg->id_carrera.')"><i class="fa fa-times"></i></button>'
                );
        	}
        	$results = array(
        		"sEcho"=>1,
        		"iTotalRecords"=>count($data),
        		"iTotalDisplayRecords"=>count($data),
        		"aaData"=>$data);
        	echo json_encode($results);
        	$stmt = null;
        	$dbConexion = null;
			break;
		case 'listarCarrerasDes':
			$inval = 0;
			$stmt = $dbConexion -> prepare("SELECT * FROM carreras WHERE estado_car = :inval");
			$stmt -> bindParam("inval", $inval, PDO::PARAM_INT);
			$stmt -> execute();
			$data = Array();
			while ($reg = $stmt -> fetch(PDO::FETCH_OBJ)){
            $data[]=array(
                "0"=>$reg->nombre_car,
                "1"=>$reg->fecha_reg_car,
                "2"=>'<button data-toggle="modal" data-backdrop="false" data-target="#editCar" class="btn btn-outline-warning btn-sm" onclick="mostrarCarrera('.$reg->id_carrera.')"><i class="fa fa-edit"></i></button>'.
                    ' <button class="btn btn-sm btn-outline-primary" onclick="activarCarrera('.$reg->id_carrera.')"><i class="fa fa-check"></i></button>'
                );
        	}
        	$results = array(
        		"sEcho"=>1,
        		"iTotalRecords"=>count($data),
        		"iTotalDisplayRecords"=>count($data),
        		"aaData"=>$data);
        	echo json_encode($results);
        	$stmt = null;
        	$dbConexion = null;
			break;	
		case 'desactivarCarrera':
			$inval = 0;
			$id_carrera = isset($_POST['id_carrera']) ? limpiarDatos($_POST['id_carrera']) : "";
			$stmt = $dbConexion -> prepare("UPDATE carreras SET estado_car = :inval WHERE id_carrera = :id_carrera");
			$stmt -> bindParam("inval", $inval, PDO::PARAM_INT);
			$stmt -> bindParam("id_carrera", $id_carrera, PDO::PARAM_INT);
			$resstmt = $stmt -> execute();
			if ($resstmt) {
				echo 1;
			} else {
				echo 0;
			}
			$stmt = null; $dbConexion = null;
			break;
		case 'activarCarrera':
			$valid = 1;
			$id_carrera = isset($_POST['id_carrera']) ? limpiarDatos($_POST['id_carrera']) : "";
			$stmt = $dbConexion -> prepare("UPDATE carreras SET estado_car = :valid WHERE id_carrera = :id_carrera");
			$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
			$stmt -> bindParam("id_carrera", $id_carrera, PDO::PARAM_INT);
			$resstmt = $stmt -> execute();
			if ($resstmt) {
				echo 1;
			} else {
				echo 0;
			}
			$stmt = null; $dbConexion = null;
			break;	
		case 'mostrarCarrera':
			$id_carrera = isset($_POST['id_carrera']) ? limpiarDatos($_POST['id_carrera']) : "";
			$result = $administrador->mostrarCarrera($id_carrera);
			echo json_encode($result);
			$result = null;
			break;	
		case 'editCar':
			$id_carrera = isset($_POST['id_carrera']) ? limpiarDatos($_POST['id_carrera']) : "";
			$nomCarEdit = isset($_POST['nomCarEdit']) ? limpiarDatos($_POST['nomCarEdit']) : "";
			$stmt = $dbConexion->prepare("UPDATE carreras SET nombre_car=:nomCarEdit WHERE id_carrera=:id_carrera");
			$stmt -> bindParam("nomCarEdit", $nomCarEdit, PDO::PARAM_STR);
			$stmt -> bindParam("id_carrera", $id_carrera, PDO::PARAM_STR);
			$result = $stmt -> execute();
			if ($result == 1) { echo "1"; } else { echo "2"; }
			$result = null;
			$stmt = null;
			$dbConexion = null;
			break;	
		case 'selectCarrera':
			$result = $administrador->selectCarrera();
			while ($select = $result->fetch_object()) {
				echo "<option value='.$select->id_carrera.'>".$select->nombre_car."</option>";
			}
			break;	
		case 'guardarDirect':
			$nomDir = isset($_POST['nomDir']) ? limpiarDatos($_POST['nomDir']) : "";
			$corDir = isset($_POST['corDir']) ? limpiarDatos($_POST['corDir']) : "";
			$contDir = isset($_POST['contDir']) ? limpiarDatos($_POST['contDir']) : "";
			$telDir = isset($_POST['telDir']) ? limpiarDatos($_POST['telDir']) : "";
			$carDir = isset($_POST['carDir']) ? limpiarDatos($_POST['carDir']) : "";
			$estDir = isset($_POST['estDir']) ? limpiarDatos($_POST['estDir']) : "";
			$passEnc = sha1($contDir);
			$nomMayDir = ucfirst($nomDir);
			$valid1 = $dbConexion->prepare("SELECT * FROM directores WHERE correo_dir=:corDir");
			$valid1 -> bindParam("corDir", $corDir, PDO::PARAM_STR);
			$valid1 -> execute(); 
			$resvalid1 = $valid1 -> rowCount();
			if ($resvalid1 == 0) {
				$valid2 = $dbConexion->prepare("SELECT * FROM directores dir INNER JOIN carreras car 
					ON car.id_carrera = dir.id_carrera WHERE car.id_carrera=:carDir");
				$valid2 -> bindParam("carDir", $carDir, PDO::PARAM_INT);
				$valid2 -> execute();
				$resvalid2 = $valid2 -> rowCount();
				if ($resvalid2 == 0) {
					$stmt = $dbConexion->prepare("INSERT INTO directores (nombre_c_dir, correo_dir, contrasena_dir, contdesc_dir, telefono_dir, fecha_reg_dir, estado_dir, id_carrera) VALUES (:nomMayDir, :corDir, :passEnc, :contDir, :telDir, :fechAct, :estDir, :carDir)");
					$stmt -> bindParam(":nomMayDir", $nomMayDir, PDO::PARAM_STR);
					$stmt -> bindParam(":corDir", $corDir, PDO::PARAM_STR);
					$stmt -> bindParam(":passEnc", $passEnc, PDO::PARAM_STR);
					$stmt -> bindParam(":contDir", $contDir, PDO::PARAM_STR);
					$stmt -> bindParam(":telDir", $telDir, PDO::PARAM_STR);
					$stmt -> bindParam(":fechAct", $fechAct, PDO::PARAM_STR);
					$stmt -> bindParam(":estDir", $estDir, PDO::PARAM_INT);
					$stmt -> bindParam(":carDir", $carDir, PDO::PARAM_INT);
					$stmt -> execute();
					$resstmt = $stmt -> rowCount();
					if ($resstmt == 1) {
						echo 1;
					} else {
						echo 0;
					}
				} else {
					echo 11;
				}
			} else {
				echo 00;
			}
			$valid1 = null; $resvalid1 = null; $valid2 = null; $resvalid2 = null; $stmt = null;
			$resstmt = null; $dbConexion = null;
			break;	
		case 'listarDirectores':
			$valid = 1;
			$stmt = $dbConexion -> prepare("SELECT dir.nombre_c_dir, dir.correo_dir, car.nombre_car, dir.estado_dir, dir.id_director FROM directores dir 
				INNER JOIN carreras car ON car.id_carrera = dir.id_carrera 
				WHERE dir.estado_dir = :valid");
			$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
			$stmt -> execute();
			$data = Array();
			while ($reg = $stmt -> fetch(PDO::FETCH_OBJ)){
            $data[]=array(
                "0"=>$reg->nombre_c_dir,
                "1"=>$reg->correo_dir,
                "2"=>$reg->nombre_car,
                "3"=>'<button onclick="newPassDir('.$reg->id_director.')" class="btn btn-sm btn-outline-primary" data-backdrop="false" data-target="#editNewPassDir" data-toggle="modal">
                <i class="fas fa-key"></i>
                </button> '.'<button data-toggle="modal" data-backdrop="false" data-target="#editDirec" class="btn btn-outline-warning btn-sm" onclick="mostrarDirector('.$reg->id_director.')"><i class="fas fa-edit"></i></button>'.
                    ' <button class="btn btn-outline-danger btn-sm" onclick="desactivarDirector('.$reg->id_director.')"><i class="fa fa-times"></i></button>'
                );
        	}
        	$results = array(
        		"sEcho"=>1,
        		"iTotalRecords"=>count($data),
        		"iTotalDisplayRecords"=>count($data),
        		"aaData"=>$data);
        	echo json_encode($results);
        	$stmt = null;
        	$dbConexion = null;
			break;
		case 'listarDirectoresDesc':
			$inval = 0;
			$stmt = $dbConexion -> prepare("SELECT dir.nombre_c_dir, dir.correo_dir, car.nombre_car, dir.estado_dir, dir.id_director FROM directores dir 
				INNER JOIN carreras car ON car.id_carrera = dir.id_carrera 
				WHERE dir.estado_dir = :inval");
			$stmt -> bindParam("inval", $inval, PDO::PARAM_INT);
			$stmt -> execute();
			$data = Array();
			while ($reg = $stmt -> fetch(PDO::FETCH_OBJ)){
            $data[]=array(
                "0"=>$reg->nombre_c_dir,
                "1"=>$reg->correo_dir,
                "2"=>$reg->nombre_car,
                "3"=>'<button onclick="newPassDir('.$reg->id_director.')" class="btn btn-sm btn-outline-primary" data-backdrop="false" data-target="#editNewPassDir" data-toggle="modal">
                <i class="fas fa-key"></i>
                </button> '.'<button data-toggle="modal" data-backdrop="false" data-target="#editDirec" class="btn btn-outline-warning btn-sm" onclick="mostrarDirector('.$reg->id_director.')"><i class="fa fa-edit"></i></button>'.
                    ' <button class="btn btn-outline-primary btn-sm" onclick="activarDirector('.$reg->id_director.')"><i class="fa fa-check"></i></button>'
                );
        	}
        	$results = array(
        		"sEcho"=>1,
        		"iTotalRecords"=>count($data),
        		"iTotalDisplayRecords"=>count($data),
        		"aaData"=>$data);
        	echo json_encode($results);
        	$stmt = null;
        	$dbConexion = null;
			break;		
		case 'desactivarDirector':
			$inval = 0;
			$id_director = isset($_POST['id_director']) ? limpiarDatos($_POST['id_director']) : "";
			$stmt = $dbConexion -> prepare("UPDATE directores SET estado_dir = :inval WHERE id_director = :id_director");
			$stmt -> bindParam("inval", $inval, PDO::PARAM_INT);
			$stmt -> bindParam("id_director", $id_director, PDO::PARAM_INT);
			$resstmt = $stmt -> execute();
			if ($resstmt) {
				echo 1;
			} else {
				echo 0;
			}
			$stmt = null; $dbConexion = null;
			break;
		case 'activarDirector':
			$valid = 1;
			$id_director = isset($_POST['id_director']) ? limpiarDatos($_POST['id_director']) : "";
			$stmt = $dbConexion -> prepare("UPDATE directores SET estado_dir = :valid WHERE id_director = :id_director");
			$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
			$stmt -> bindParam("id_director", $id_director, PDO::PARAM_INT);
			$resstmt = $stmt -> execute();
			if ($resstmt) {
				echo 1;
			} else {
				echo 0;
			}
			$stmt = null; $dbConexion = null;
			break;	
		case 'mostrarDirector':
			$id_director = isset($_POST['id_director']) ? limpiarDatos($_POST['id_director']) : "";
			$result = $administrador->mostrarDirector($id_director);
			echo json_encode($result);
			$result = null;
			break;	
		case 'editDir':
			$id_director = isset($_POST['id_director']) ? limpiarDatos($_POST['id_director']) : "";
			$idcarrera = isset($_POST['idcarrera']) ? limpiarDatos($_POST['idcarrera']) : "";
			$nomDirEdit = isset($_POST['nomDirEdit']) ? limpiarDatos($_POST['nomDirEdit']) : "";
			$corDirEdit = isset($_POST['corDirEdit']) ? limpiarDatos($_POST['corDirEdit']) : "";
			$telDirEdit = isset($_POST['telDirEdit']) ? limpiarDatos($_POST['telDirEdit']) : "";
			$carDirEdit = isset($_POST['carDirEdit']) ? limpiarDatos($_POST['carDirEdit']) : "";
			$contAdmAct = isset($_POST['contAdmAct']) ? limpiarDatos($_POST['contAdmAct']) : "";
			$contAdmActEnc = sha1($contAdmAct);
			$valid = $dbConexion->prepare("SELECT * FROM administradores WHERE contrasena=:contAdmActEnc && id_admin=:keyAdm");
			$valid -> bindParam("contAdmActEnc", $contAdmActEnc, PDO::PARAM_STR);
			$valid -> bindParam("keyAdm", $keyAdm, PDO::PARAM_INT);
			$valid -> execute();
			$resvalid = $valid -> rowCount();
			if ($resvalid === 1) {
				$valid2 = $dbConexion->prepare("SELECT * FROM directores WHERE correo_dir=:corDirEdit && id_director !=:id_director");
				$valid2 -> bindParam("corDirEdit", $corDirEdit, PDO::PARAM_STR);
				$valid2 -> bindParam("id_director", $id_director, PDO::PARAM_INT);
				$valid2 -> execute();
				$resvalid2 = $valid2 -> rowCount();
				if ($resvalid2 === 0) {
					if ($carDirEdit == "0") {
						$stmt1 = $dbConexion->prepare("UPDATE directores SET nombre_c_dir=:nomDirEdit, telefono_dir=:telDirEdit, correo_dir=:corDirEdit WHERE id_director=:id_director");
						$stmt1 -> bindParam("nomDirEdit", $nomDirEdit, PDO::PARAM_STR);
						$stmt1 -> bindParam("corDirEdit", $corDirEdit, PDO::PARAM_STR);
						$stmt1 -> bindParam("telDirEdit", $telDirEdit, PDO::PARAM_STR);
						$stmt1 -> bindParam("id_director", $id_director, PDO::PARAM_INT);
						$resstmt1 = $stmt1 -> execute();
						if ($resstmt1) {
							echo 1;
						} else {
							echo 11;
						}
					} else {
						$stmt2 = $dbConexion->prepare("SELECT * FROM directores WHERE estado_dir = 1 && id_carrera=:carDirEdit");
						$stmt2 -> bindParam("carDirEdit", $carDirEdit, PDO::PARAM_INT);
						$stmt2 -> execute();
						$resstmt2 = $stmt2 -> rowCount();
						if ($resstmt2 === 1) {
							echo 2;
						} else {
							$stmt3 = $dbConexion->prepare("UPDATE directores SET nombre_c_dir=:nomDirEdit, 
							correo_dir=:corDirEdit, telefono_dir=:telDirEdit, id_carrera=:carDirEdit WHERE id_director=:id_director");
							$stmt3 -> bindParam("nomDirEdit", $nomDirEdit, PDO::PARAM_STR);
							$stmt3 -> bindParam("corDirEdit", $corDirEdit, PDO::PARAM_STR);
							$stmt3 -> bindParam("telDirEdit", $telDirEdit, PDO::PARAM_STR);
							$stmt3 -> bindParam("carDirEdit", $carDirEdit, PDO::PARAM_INT);
							$stmt3 -> bindParam("id_director", $id_director, PDO::PARAM_INT);
							$resstmt3 = $stmt3 -> execute();
							if ($resstmt3) {
								echo 3;
							} else {
								echo 33;
							}
						}
					}
				} else {
					echo 5;
				}
			} else {
				echo 4;
			}
			$stmt1 = null; $resstmt1 = null; $stmt2 = null; $resstmt2 = null; $stmt3 = null; $resstmt3 = null;
			$dbConexion = null;
			break;	
		case 'editNewPasDir':
			$id_director = isset($_POST['id_director']) ? limpiarDatos($_POST['id_director']) : "";
			$newContDir = isset($_POST['newContDir']) ? limpiarDatos($_POST['newContDir']) : "";
			$confNewPasDir = isset($_POST['confNewPasDir']) ? limpiarDatos($_POST['confNewPasDir']) : "";
			$newContDirEnc = sha1($newContDir); $confNewPasDirEnc = sha1($confNewPasDir);
			$valid1 = $dbConexion -> prepare("SELECT nombre_c FROM administradores WHERE contrasena = :confNewPasDirEnc && id_admin = :keyAdm");
			$valid1 -> bindParam("confNewPasDirEnc", $confNewPasDirEnc, PDO::PARAM_STR);
			$valid1 -> bindParam("keyAdm", $keyAdm, PDO::PARAM_INT);
			$valid1 -> execute();
			$resValid1 = $valid1 -> rowCount();
			if ($resValid1 === 1) {
				$stmt = $dbConexion -> prepare("UPDATE directores SET contrasena_dir = :newContDirEnc, contdesc_dir = :newContDir WHERE id_director = :id_director");
				$stmt -> bindParam("newContDirEnc", $newContDirEnc, PDO::PARAM_STR);
				$stmt -> bindParam("newContDir", $newContDir, PDO::PARAM_STR);
				$stmt -> bindParam("id_director", $id_director, PDO::PARAM_INT);
				$resstmt = $stmt -> execute();
				if ($resstmt) {
					echo 1;
				} else {
					echo 0;
				}
			} else {
				echo 2;
			}
			break;		
		case 'regAdm':
			$nomAdmin = isset($_POST['nomAdmin']) ? limpiarDatos($_POST['nomAdmin']) : "";
			$corAdmin = isset($_POST['corAdmin']) ? limpiarDatos($_POST['corAdmin']) : "";
			$contAdm = isset($_POST['contAdm']) ? limpiarDatos($_POST['contAdm']) : "";
			$usAdm = isset($_POST['usAdm']) ? limpiarDatos($_POST['usAdm']) : "";
			$estAdm = isset($_POST['estAdm']) ? limpiarDatos($_POST['estAdm']) : "";
			$privAdm = isset($_POST['privAdm']) ? limpiarDatos($_POST['privAdm']) : "";
			$contAdmEnc = sha1($contAdm);
			$nomAdminMay = ucfirst($nomAdmin);
			$stmt1 = $dbConexion->prepare("SELECT * FROM administradores WHERE correo = :corAdmin");
			$stmt1 -> bindParam("corAdmin", $corAdmin, PDO::PARAM_STR);
			$stmt1 -> execute();
			$resstmt1 = $stmt1 -> rowCount();
			if ($resstmt1 === 0) {
				$stmt2 = $dbConexion->prepare("SELECT * FROM administradores WHERE usuario=:usAdm");
				$stmt2 -> bindParam("usAdm", $usAdm, PDO::PARAM_STR);
				$stmt2 -> execute();
				$resstmt2 = $stmt2 -> rowCount();
				if ($resstmt2 === 0) {
					$stmt3 = $dbConexion->prepare("INSERT INTO administradores (nombre_c, correo, contrasena, contdesc, usuario, condicion, privileg, fecha_reg_adm) VALUES (:nomAdminMay, :corAdmin, :contAdmEnc, :contAdm, :usAdm, :estAdm, :privAdm, :fechAct)");
					$stmt3 -> bindParam(":nomAdminMay", $nomAdminMay, PDO::PARAM_STR);
					$stmt3 -> bindParam(":corAdmin", $corAdmin, PDO::PARAM_STR);
					$stmt3 -> bindParam(":contAdmEnc", $contAdmEnc, PDO::PARAM_STR);
					$stmt3 -> bindParam(":contAdm", $contAdm, PDO::PARAM_STR);
					$stmt3 -> bindParam(":usAdm", $usAdm, PDO::PARAM_STR);
					$stmt3 -> bindParam(":estAdm", $estAdm, PDO::PARAM_INT);
					$stmt3 -> bindParam(":privAdm", $privAdm, PDO::PARAM_STR);
					$stmt3 -> bindParam(":fechAct", $fechAct, PDO::PARAM_STR);
					$stmt3 -> execute();
					$resstmt3 = $stmt3 -> rowCount();
					if ($resstmt3 == 1) {
						echo 1;
					} else {
						echo 0;
					}
				} else {
					echo 2;
				}
			} else {
				echo 3;
			}
			$stmt1 = null; $resstmt1 = null; $stmt2 = null; $resstmt2 = null; $stmt3 = null; 
			$resstmt3 = null; $dbConexion = null;
			break;	
		case 'listarAdmin':
			$valid = 1;
			$valSeg = 1;
			$stmt = $dbConexion -> prepare("SELECT * FROM administradores WHERE id_admin != :keyAdm && condicion = :valid && id_admin != :valSeg ORDER BY nombre_c");
			$stmt -> bindParam("keyAdm", $keyAdm, PDO::PARAM_INT);
			$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
			$stmt -> bindParam("valSeg", $valSeg, PDO::PARAM_INT);
			$stmt -> execute();
			$data = Array();
			while ($reg = $stmt -> fetch(PDO::FETCH_OBJ)){
            $data[]=array(
                "0"=>$reg->nombre_c,
                "1"=>$reg->correo,
                "2"=>$reg->usuario,
                "3"=>$reg->privileg,
                "4" => '<button data-toggle="modal" data-backdrop="false" data-target="#editAdm" class="btn btn-outline-warning btn-sm" onclick="mostrarAdm('.$reg->id_admin.')"><i class="fas fa-edit"></i></button>'.
                    ' <button class="btn btn-outline-danger btn-sm" onclick="desactivarAdm('.$reg->id_admin.')"><i class="fa fa-times"></i></button>'
                );
        	}
        	$results = array(
        		"sEcho"=>1,
        		"iTotalRecords"=>count($data),
        		"iTotalDisplayRecords"=>count($data),
        		"aaData"=>$data);
        	echo json_encode($results);
        	$stmt = null;
        	$dbConexion = null;
			break;
		case 'listarAdminDes':
			$inval = 0;
			$valSeg = 1;
			$stmt = $dbConexion -> prepare("SELECT * FROM administradores WHERE id_admin != :keyAdm && condicion = :inval && id_admin != :valSeg ORDER BY nombre_c");
			$stmt -> bindParam("keyAdm", $keyAdm, PDO::PARAM_INT);
			$stmt -> bindParam("inval", $inval, PDO::PARAM_INT);
			$stmt -> bindParam("valSeg", $valSeg, PDO::PARAM_INT);
			$stmt -> execute();
			$data = Array();
			while ($reg = $stmt -> fetch(PDO::FETCH_OBJ)){
            $data[]=array(
                "0"=>$reg->nombre_c,
                "1"=>$reg->correo,
                "2"=>$reg->usuario,
                "3"=>$reg->privileg,
                "4" => '<button data-toggle="modal" data-backdrop="false" data-target="#editAdm" class="btn btn-outline-warning btn-sm" onclick="mostrarAdm('.$reg->id_admin.')"><i class="fa fa-edit"></i></button>'.
                    ' <button class="btn btn-outline-primary btn-sm" onclick="activarAdm('.$reg->id_admin.')"><i class="fa fa-check"></i></button>'
                );
        	}
        	$results = array(
        		"sEcho"=>1,
        		"iTotalRecords"=>count($data),
        		"iTotalDisplayRecords"=>count($data),
        		"aaData"=>$data);
        	echo json_encode($results);
        	$stmt = null;
        	$dbConexion = null;
			break;		
		case 'desactivarAdm':
			$inval = 0;
			$id_admin = isset($_POST['id_admin']) ? limpiarDatos($_POST['id_admin']) : "";
			$stmt = $dbConexion -> prepare("UPDATE administradores SET condicion = :inval WHERE id_admin = :id_admin");
			$stmt -> bindParam("inval", $inval, PDO::PARAM_INT);
			$stmt -> bindParam("id_admin", $id_admin, PDO::PARAM_INT);
			$resstmt = $stmt -> execute();
			if ($resstmt) {
				echo 1;
			} else {
				echo 2;
			}
			$stmt = null; $dbConexion = null;
			break;
		case 'activarAdm':
			$valid = 1;
			$id_admin = isset($_POST['id_admin']) ? limpiarDatos($_POST['id_admin']) : "";
			$stmt = $dbConexion -> prepare("UPDATE administradores SET condicion = :valid WHERE id_admin = :id_admin");
			$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
			$stmt -> bindParam("id_admin", $id_admin, PDO::PARAM_INT);
			$resstmt = $stmt -> execute();
			if ($resstmt) {
				echo 1;
			} else {
				echo 2;
			}
			$stmt = null; $dbConexion = null;
			break;
		case 'mostrarAdm':
			$id_admin = isset($_POST['id_admin']) ? limpiarDatos($_POST['id_admin']) : "";
			$result = $administrador->mostrarAdm($id_admin);
			echo json_encode($result);
			$result = null;
			break;
		case 'editAdm':
			$id_admin = isset($_POST['id_admin']) ? limpiarDatos($_POST['id_admin']) : "";
			$nomAdmEdit = isset($_POST['nomAdmEdit']) ? limpiarDatos($_POST['nomAdmEdit']) : "";
			$corAdmEdit = isset($_POST['corAdmEdit']) ? limpiarDatos($_POST['corAdmEdit']) : "";
			$usAdmEdit = isset($_POST['usAdmEdit']) ? limpiarDatos($_POST['usAdmEdit']) : "";
			$privAct = isset($_POST['privAct']) ? limpiarDatos($_POST['privAct']) : "";
			$privAdmEdit = isset($_POST['privAdmEdit']) ? limpiarDatos($_POST['privAdmEdit']) : "";
			$contAdmAct = isset($_POST['contAdmAct']) ? limpiarDatos($_POST['contAdmAct']) : "";
			$contAdmActEnc = sha1($contAdmAct);
			$valid = $dbConexion->prepare("SELECT * FROM administradores WHERE contrasena=:contAdmActEnc && id_admin=:keyAdm");
			$valid -> bindParam("contAdmActEnc", $contAdmActEnc, PDO::PARAM_STR);
			$valid -> bindParam("keyAdm", $keyAdm, PDO::PARAM_INT);
			$valid -> execute();
			$resvalid = $valid -> rowCount();
			if ($resvalid === 1) {
				$stmt = $dbConexion->prepare("SELECT * FROM administradores WHERE correo=:corAdmEdit && id_admin !=:id_admin");
				$stmt -> bindParam("corAdmEdit", $corAdmEdit, PDO::PARAM_STR);
				$stmt -> bindParam("id_admin", $id_admin, PDO::PARAM_INT);
				$stmt -> execute();
				$resstmt = $stmt -> rowCount();
				if ($resstmt === 0) {
					 $stmt1 = $dbConexion->prepare("SELECT * FROM administradores WHERE usuario=:usAdmEdit && id_admin !=:id_admin");
					$stmt1 -> bindParam("usAdmEdit", $usAdmEdit, PDO::PARAM_STR);
					$stmt1 -> bindParam("id_admin", $id_admin, PDO::PARAM_INT);
					$stmt1 -> execute();
					$resstmt1 = $stmt1 -> rowCount();
					if ($resstmt1 === 0) {
						if ($privAdmEdit == "0") {
							$stmt2 = $dbConexion->prepare("UPDATE administradores SET nombre_c=:nomAdmEdit, correo=:corAdmEdit, usuario=:usAdmEdit WHERE id_admin=:id_admin");
							$stmt2 -> bindParam("nomAdmEdit", $nomAdmEdit, PDO::PARAM_STR);
							$stmt2 -> bindParam("corAdmEdit", $corAdmEdit, PDO::PARAM_STR);
							$stmt2 -> bindParam("usAdmEdit", $usAdmEdit, PDO::PARAM_STR);
							$stmt2 -> bindParam("id_admin", $id_admin, PDO::PARAM_INT);
							$resstmt2 = $stmt2 -> execute();
							if ($resstmt2) {
								echo 1;
							} else {
								echo 0;
							}
						} else {
							$stmt3 = $dbConexion->prepare("UPDATE administradores SET nombre_c=:nomAdmEdit, correo=:corAdmEdit, usuario=:usAdmEdit, privileg=:privAdmEdit WHERE id_admin=:id_admin");
							$stmt3 -> bindParam("nomAdmEdit", $nomAdmEdit, PDO::PARAM_STR);
							$stmt3 -> bindParam("corAdmEdit", $corAdmEdit, PDO::PARAM_STR);
							$stmt3 -> bindParam("usAdmEdit", $usAdmEdit, PDO::PARAM_STR);
							$stmt3 -> bindParam("privAdmEdit", $privAdmEdit, PDO::PARAM_STR);
							$stmt3 -> bindParam("id_admin", $id_admin, PDO::PARAM_INT);
							$resstmt3 = $stmt3 -> execute();
							if ($resstmt3) {
								echo 1;
							} else {
								echo 0;
							}
						}
					} else {
						echo 4;
					}
				} else {
					echo 2;
				}
			} else {
				echo 3;
			}
			$valid = null; $resvalid = null; $stmt = null; $resstmt = null; $stmt1 = null; $resstmt1 = null;
			$stmt2 = null; $resstmt2 = null; $stmt3 = null; $resstmt3 = null; $dbConexion = null;
			break;	
		case 'regCicloEsc':
			$nomCEsc = isset($_POST['nomCEsc']) ? limpiarDatos($_POST['nomCEsc']) : "";
			$estCEsc = isset($_POST['estCEsc']) ? limpiarDatos($_POST['estCEsc']) : "";
			$valid = $dbConexion->prepare("SELECT * FROM ciclo_escolar WHERE n_ciclo_escolar = :nomCEsc");
			$valid -> bindParam("nomCEsc", $nomCEsc, PDO::PARAM_STR);
			$valid -> execute();
			$resvalid = $valid -> rowCount();
			if ($resvalid === 0) {
				$stmt = $dbConexion->prepare("INSERT INTO ciclo_escolar (n_ciclo_escolar, estado_cic_esc, fecha_reg_cic) VALUES (:nomCEsc, :estCEsc, :fechAct)");
				$stmt -> bindParam(":nomCEsc", $nomCEsc, PDO::PARAM_STR);
				$stmt -> bindParam(":estCEsc", $estCEsc, PDO::PARAM_STR);
				$stmt -> bindParam(":fechAct", $fechAct, PDO::PARAM_STR);
				$stmt -> execute();
				$resstmt = $stmt -> rowCount();
				if ($resstmt === 1) {
					echo 1;
				} else {
					echo 0;
				}
			} else {
				echo 2;
			}
			$valid = null; $resvalid = null; $stmt = null; $resstmt = null; $dbConexion = null;
			break;	
		case 'listarCEscolar':
			$valid = 1;
			$stmt = $dbConexion -> prepare("SELECT * FROM ciclo_escolar WHERE estado_cic_esc = :valid");
			$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
			$stmt -> execute();
			$data = Array();
			while ($reg = $stmt -> fetch(PDO::FETCH_OBJ)){
            $data[]=array(
                "0"=>'<button data-toggle="modal" data-target="#editAdm" class="btn btn-success" onclick="mostrarCEsc('.$reg->id_ciclo_escolar.')"><i class="fas fa-edit"></i></button>'.
                    ' <button class="btn btn-danger" onclick="desactivarCEsc('.$reg->id_ciclo_escolar.')"><i class="fa fa-times"></i></button>',
                "1"=>$reg->n_ciclo_escolar,
                "2"=>$reg->fecha_reg_cic
                );
        	}
        	$results = array(
        		"sEcho"=>1,
        		"iTotalRecords"=>count($data),
        		"iTotalDisplayRecords"=>count($data),
        		"aaData"=>$data);
        	echo json_encode($results);
        	$stmt = null;
        	$dbConexion = null;
			break;
		case 'listarCEscolarDes':
			$inval = 0;
			$stmt = $dbConexion -> prepare("SELECT * FROM ciclo_escolar WHERE estado_cic_esc = :inval");
			$stmt -> bindParam("inval", $inval, PDO::PARAM_INT);
			$stmt -> execute();
			$data = Array();
			while ($reg = $stmt -> fetch(PDO::FETCH_OBJ)){
            $data[]=array(
                "0"=>'<button data-toggle="modal" data-target="#editAdm" class="btn btn-success" onclick="mostrarCEsc('.$reg->id_ciclo_escolar.')"><i class="fa fa-edit"></i></button>'.
                    ' <button class="btn btn-primary" onclick="activarCEsc('.$reg->id_ciclo_escolar.')"><i class="fa fa-check"></i></button>',
                "1"=>$reg->n_ciclo_escolar,
                "2"=>$reg->fecha_reg_cic
                );
        	}
        	$results = array(
        		"sEcho"=>1,
        		"iTotalRecords"=>count($data),
        		"iTotalDisplayRecords"=>count($data),
        		"aaData"=>$data);
        	echo json_encode($results);
        	$stmt = null;
        	$dbConexion = null;
			break;		
		case 'desactivarCEsc':
			$id_ciclo_escolar = isset($_POST['id_ciclo_escolar']) ? limpiarDatos($_POST['id_ciclo_escolar']) : "";
			$result = $administrador->desactivarCEsc($id_ciclo_escolar);
			echo $result ? "Ciclo escolar desactivado" : "No se pudo desactivar";
			$result = null;
			break;
		case 'activarCEsc':
			$id_ciclo_escolar = isset($_POST['id_ciclo_escolar']) ? limpiarDatos($_POST['id_ciclo_escolar']) : "";
			$result = $administrador->activarCEsc($id_ciclo_escolar);
			echo $result ? "Ciclo escolar activado" : "No se pudo activar";
			$result = null;
			break;
		case 'regCor':
			$nomCor = isset($_POST['nomCor']) ? limpiarDatos($_POST['nomCor']) : "";
			$corCord = isset($_POST['corCord']) ? limpiarDatos($_POST['corCord']) : "";
			$contCor = isset($_POST['contCor']) ? limpiarDatos($_POST['contCor']) : "";
			$telCor = isset($_POST['telCor']) ? limpiarDatos($_POST['telCor']) : "";
			$sexCor = isset($_POST['sexCor']) ? limpiarDatos($_POST['sexCor']) : "";
			$nomMay = ucfirst($nomCor);
			$contEnc = sha1($contCor);
			$valValid = 1;
			$valid1 = $dbConexion -> prepare("SELECT * FROM coordinadores WHERE correo_cor = :corCord");
			$valid1 -> bindParam("corCord", $corCord, PDO::PARAM_STR);
			$valid1 -> execute();
			$resvalid1 = $valid1 -> rowCount();
			if ($resvalid1 === 1) {
				echo 2;
			} else {
				$stmt = $dbConexion -> prepare("INSERT INTO coordinadores (nombre_c_cor, correo_cor, contrasena_cor, contdesc_cor, telefono_cor, sexo_cor, estado_cor, fecha_reg_cor) VALUES (:nomMay, :corCord, :contEnc, :contCor, :telCor, :sexCor, :valValid, :fechAct)");
				$stmt -> bindParam(":nomMay", $nomMay, PDO::PARAM_STR);
				$stmt -> bindParam(":corCord", $corCord, PDO::PARAM_STR);
				$stmt -> bindParam(":contEnc", $contEnc, PDO::PARAM_STR);
				$stmt -> bindParam(":contCor", $contCor, PDO::PARAM_STR);
				$stmt -> bindParam(":telCor", $telCor, PDO::PARAM_STR);
				$stmt -> bindParam(":sexCor", $sexCor, PDO::PARAM_STR);
				$stmt -> bindParam(":valValid", $valValid, PDO::PARAM_INT);
				$stmt -> bindParam(":fechAct", $fechAct, PDO::PARAM_STR);
				$stmt -> execute();
				$resstmt = $stmt -> rowCount();
				if ($resstmt === 1) {
					echo 1;
				} else {
					echo 0;
				}
			}
			$valid1 = null; $resvalid1 = null; $stmt = null; $resstmt = null; $dbConexion = null;
			break;
		case 'listarCorAct':
				$valid = 1;
				$stmt = $dbConexion -> prepare("SELECT * FROM coordinadores WHERE estado_cor = :valid");
				$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
				$stmt -> execute();
				$data = Array();
				while ($res = $stmt -> fetch(PDO::FETCH_OBJ)) {
					$data[] = array(
						"0" => $res -> nombre_c_cor,
						"1" => $res -> correo_cor,
						"2" => $res -> telefono_cor,
						"3" => '<button data-backdrop="false" data-toggle="modal" data-target="#editNewPasCor" onclick="newPassCor('.$res->id_coordinador.')" class="btn btn-sm btn-outline-primary"> <i class="fas fa-key"></i> </button> '.
						'<button data-toggle="modal" data-backdrop="false" data-target="#editCor" class="btn btn-outline-warning btn-sm" onclick="mostrarCor('.$res->id_coordinador.')"><i class="fas fa-edit"></i></button>'.
                   		' <button class="btn btn-outline-danger btn-sm" onclick="desactivarCor('.$res->id_coordinador.')"><i class="fa fa-times"></i></button>'
					);
				}
				$results = array(
        		"sEcho"=>1,
        		"iTotalRecords"=>count($data),
        		"iTotalDisplayRecords"=>count($data),
        		"aaData"=>$data);
        	echo json_encode($results);
        	$stmt = null;
        	$dbConexion = null;
			break;	
		case 'listarCorInc':
			$inval = 0;
			$stmt = $dbConexion -> prepare("SELECT * FROM coordinadores WHERE estado_cor = :inval");
			$stmt -> bindParam("inval", $inval, PDO::PARAM_INT);
			$stmt -> execute();
			$data = Array();
			while ($res = $stmt -> fetch(PDO::FETCH_OBJ)) {
				$data[] = array(
					"0" => $res -> nombre_c_cor,
					"1" => $res -> correo_cor,
					"2" => $res -> telefono_cor,
					"3" => '<button data-backdrop="false" data-toggle="modal" data-target="#editNewPasCor" onclick="newPassCor('.$res->id_coordinador.')" class="btn btn-sm btn-outline-primary"> <i class="fas fa-key"></i> </button> '.
					'<button data-toggle="modal" data-backdrop="false" data-target="#editCor" class="btn btn-sm btn-outline-warning" onclick="mostrarCor('.$res->id_coordinador.')"><i class="fas fa-edit"></i></button>'.
                   	' <button class="btn btn-outline-primary btn-sm" onclick="activarCor('.$res->id_coordinador.')"><i class="fa fa-check"></i></button>'
				);
			}
			$results = array(
        	"sEcho"=>1,
        	"iTotalRecords"=>count($data),
        	"iTotalDisplayRecords"=>count($data),
        	"aaData"=>$data);
        	echo json_encode($results);
        	$stmt = null;
        	$dbConexion = null;
			break;	
		case 'desactivarCor':
			$id_coordinador = isset($_POST['id_coordinador']) ? limpiarDatos($_POST['id_coordinador']) : "";
			$inval = 0;
			$stmt = $dbConexion -> prepare("UPDATE coordinadores SET estado_cor = :inval WHERE id_coordinador = :id_coordinador");
			$stmt -> bindParam("inval", $inval, PDO::PARAM_INT);
			$stmt -> bindParam("id_coordinador", $id_coordinador, PDO::PARAM_INT);
			$resstmt = $stmt -> execute();
			if ($resstmt) {
				echo 1;
			} else {
				echo 0;
			}
			$stmt = null; $resstmt = null; $dbConexion = null;
			break;	
		case 'activarCor':
			$id_coordinador = isset($_POST['id_coordinador']) ? limpiarDatos($_POST['id_coordinador']) : "";
			$valid = 1;
			$stmt = $dbConexion -> prepare("UPDATE coordinadores SET estado_cor = :valid WHERE id_coordinador = :id_coordinador");
			$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
			$stmt -> bindParam("id_coordinador", $id_coordinador, PDO::PARAM_INT);
			$resstmt = $stmt -> execute();
			if ($resstmt) {
				echo 1;
			} else {
				echo 0;
			}
			$stmt = null; $resstmt = null; $dbConexion = null;
			break;	
		case 'mostrarCor':
			$id_coordinador = isset($_POST['id_coordinador']) ? limpiarDatos($_POST['id_coordinador']) : "";
			$result = $administrador->mostrarCor($id_coordinador);
			echo json_encode($result);
			$result = null;
			break;	
		case 'editCor':
			$id_coordinador = isset($_POST['id_coordinador']) ? limpiarDatos($_POST['id_coordinador']) : "";
			$nomCorEdit = isset($_POST['nomCorEdit']) ? limpiarDatos($_POST['nomCorEdit']) : "";
			$corCorEdit = isset($_POST['corCorEdit']) ? limpiarDatos($_POST['corCorEdit']) : "";
			$telCorEdit = isset($_POST['telCorEdit']) ? limpiarDatos($_POST['telCorEdit']) : "";
			$pasConfAdm = isset($_POST['pasConfAdm']) ? limpiarDatos($_POST['pasConfAdm']) : "";
			$pasConfAdmEnc = sha1($pasConfAdm);
			$valid1 = $dbConexion -> prepare("SELECT nombre_c FROM administradores WHERE contrasena = :pasConfAdmEnc && id_admin = :keyAdm");
			$valid1 -> bindParam("pasConfAdmEnc", $pasConfAdmEnc, PDO::PARAM_STR);
			$valid1 -> bindParam("keyAdm", $keyAdm, PDO::PARAM_INT);
			$valid1 -> execute();
			$resvalid1 = $valid1 -> rowCount();
			if ($resvalid1 === 1) {
				$valid2 = $dbConexion -> prepare("SELECT nombre_c_cor FROM coordinadores WHERE correo_cor = :corCorEdit && id_coordinador != :id_coordinador");
				$valid2 -> bindParam("corCorEdit", $corCorEdit, PDO::PARAM_STR);
				$valid2 -> bindParam("id_coordinador", $id_coordinador, PDO::PARAM_INT);
				$valid2 -> execute();
				$resvalid2 = $valid2 -> rowCount();
				if ($resvalid2 === 0) {
					$valid3 = $dbConexion -> prepare("SELECT nombre_c_cor FROM coordinadores WHERE telefono_cor = :telCorEdit && id_coordinador != :id_coordinador");
					$valid3 -> bindParam("telCorEdit", $telCorEdit, PDO::PARAM_STR);
					$valid3 -> bindParam("id_coordinador", $id_coordinador, PDO::PARAM_INT);
					$valid3 -> execute();
					$resvalid3 = $valid3 -> rowCount();
					if ($resvalid3 === 0) {
						$valid4 = $dbConexion -> prepare("SELECT nombre_c_cor FROM coordinadores WHERE nombre_c_cor = :nomCorEdit && id_coordinador != :id_coordinador");
						$valid4 -> bindParam("nomCorEdit", $nomCorEdit, PDO::PARAM_STR);
						$valid4 -> bindParam("id_coordinador", $id_coordinador, PDO::PARAM_INT);
						$valid4 -> execute();
						$resvalid4 = $valid4 -> rowCount();
						if ($resvalid4 === 0) {
							$upd1 = $dbConexion -> prepare("UPDATE coordinadores SET nombre_c_cor = :nomCorEdit, correo_cor = :corCorEdit, telefono_cor = :telCorEdit WHERE id_coordinador = :id_coordinador");
							$upd1 -> bindParam("nomCorEdit", $nomCorEdit, PDO::PARAM_STR);
							$upd1 -> bindParam("corCorEdit", $corCorEdit, PDO::PARAM_STR);
							$upd1 -> bindParam("telCorEdit", $telCorEdit, PDO::PARAM_STR);
							$upd1 -> bindParam("id_coordinador", $id_coordinador, PDO::PARAM_INT);
							$resupd1 = $upd1 -> execute();
							if ($resupd1) {
								echo 1;
							} else {
								echo 0;
							}
						} else {
							echo 11;
						}
					} else {
						echo 2;
					}
				} else {
					echo 3;
				}
			} else {
				echo 4;
			}
			break;
		case 'editNewPasCor':
			$id_coordinador = isset($_POST['id_coordinador']) ? limpiarDatos($_POST['id_coordinador']) : "";
			$newContCor = isset($_POST['newContCor']) ? limpiarDatos($_POST['newContCor']) : "";
			$confNewPasCor = isset($_POST['confNewPasCor']) ? limpiarDatos($_POST['confNewPasCor']) : "";
			$newContCorEnc = sha1($newContCor); $confNewPasCorEnc = sha1($confNewPasCor);
			$valid1 = $dbConexion -> prepare("SELECT nombre_c FROM administradores WHERE contrasena = :confNewPasCorEnc && id_admin = :keyAdm");
			$valid1 -> bindParam("confNewPasCorEnc", $confNewPasCorEnc, PDO::PARAM_STR);
			$valid1 -> bindParam("keyAdm", $keyAdm, PDO::PARAM_INT);
			$valid1 -> execute();
			$resValid1 = $valid1 -> rowCount();
			if ($resValid1 === 1) {
				$stmt = $dbConexion -> prepare("UPDATE coordinadores SET contrasena_cor = :newContCorEnc, contdesc_cor = :newContCor WHERE id_coordinador = :id_coordinador");
				$stmt -> bindParam("newContCorEnc", $newContCorEnc, PDO::PARAM_STR);
				$stmt -> bindParam("newContCor", $newContCor, PDO::PARAM_STR);
				$stmt -> bindParam("id_coordinador", $id_coordinador, PDO::PARAM_INT);
				$resstmt = $stmt -> execute();
				if ($resstmt) {
					echo 1;
				} else {
					echo 0;
				}
			} else {
				echo 2;
			}
			break;				
		case 'corAct':
			$valid = 1;
			$consult = $dbConexion -> prepare("SELECT COUNT(id_coordinador) AS 'CantVal' FROM coordinadores WHERE estado_cor = :valid");
			$consult -> bindParam("valid", $valid, PDO::PARAM_INT);
			$consult -> execute();
			$salida = "";
			while ( $data = $consult -> fetch(PDO::FETCH_ASSOC) ) {
				$salida .= $data["CantVal"];
			}
			echo $salida;
			$dbConexion = null; $consult = null;
			break;	
		case 'corInc':
			$inval = 0;
			$consult = $dbConexion -> prepare("SELECT COUNT(id_coordinador) AS 'CantVal' FROM coordinadores WHERE estado_cor = :inval");
			$consult -> bindParam("inval", $inval, PDO::PARAM_INT);
			$consult -> execute();
			$salida = "";
			while ( $data = $consult -> fetch(PDO::FETCH_ASSOC) ) {
				$salida .= $data["CantVal"];
			}
			echo $salida;
			$dbConexion = null; $consult = null;
			break;
		case 'carAct':
			$valid = 1;
			$consult = $dbConexion -> prepare("SELECT COUNT(id_carrera) AS 'CantVal' FROM carreras WHERE estado_car = :valid");
			$consult -> bindParam("valid", $valid, PDO::PARAM_INT);
			$consult -> execute();
			$salida = "";
			while ( $data = $consult -> fetch(PDO::FETCH_ASSOC) ) {
				$salida .= $data["CantVal"];
			}
			echo $salida;
			$dbConexion = null; $consult = null;
			break;	
		case 'carInc':
			$inval = 0;
			$consult = $dbConexion -> prepare("SELECT COUNT(id_carrera) AS 'CantVal' FROM carreras WHERE estado_car = :inval");
			$consult -> bindParam("inval", $inval, PDO::PARAM_INT);
			$consult -> execute();
			$salida = "";
			while ( $data = $consult -> fetch(PDO::FETCH_ASSOC) ) {
				$salida .= $data["CantVal"];
			}
			echo $salida;
			$dbConexion = null; $consult = null;
			break;
		case 'dirAct':
			$valid = 1;
			$consult = $dbConexion -> prepare("SELECT COUNT(id_director) AS 'CantVal' FROM directores WHERE estado_dir = :valid");
			$consult -> bindParam("valid", $valid, PDO::PARAM_INT);
			$consult -> execute();
			$salida = "";
			while ( $data = $consult -> fetch(PDO::FETCH_ASSOC) ) {
				$salida .= $data["CantVal"];
			}
			echo $salida;
			$dbConexion = null; $consult = null;
			break;	
		case 'dirInc':
			$inval = 0;
			$consult = $dbConexion -> prepare("SELECT COUNT(id_director) AS 'CantVal' FROM directores WHERE estado_dir = :inval");
			$consult -> bindParam("inval", $inval, PDO::PARAM_INT);
			$consult -> execute();
			$salida = "";
			while ( $data = $consult -> fetch(PDO::FETCH_ASSOC) ) {
				$salida .= $data["CantVal"];
			}
			echo $salida;
			$dbConexion = null; $consult = null;
			break;
		case 'dirTot':
			$inval = 0;
			$consult = $dbConexion -> prepare("SELECT COUNT(id_director) AS 'CantVal' FROM directores");
			$consult -> bindParam("inval", $inval, PDO::PARAM_INT);
			$consult -> execute();
			$salida = "";
			while ( $data = $consult -> fetch(PDO::FETCH_ASSOC) ) {
				$salida .= $data["CantVal"];
			}
			echo $salida;
			$dbConexion = null; $consult = null;
			break;
		case 'admAct':
			$valid = 1;
			$consult = $dbConexion -> prepare("SELECT COUNT(id_admin) AS 'CantVal' FROM administradores WHERE condicion = :valid && id_admin != :keyAdm");
			$consult -> bindParam("valid", $valid, PDO::PARAM_INT);
			$consult -> bindParam("keyAdm", $keyAdm, PDO::PARAM_INT);
			$consult -> execute();
			$salida = "";
			while ( $data = $consult -> fetch(PDO::FETCH_ASSOC) ) {
				$salida .= $data["CantVal"];
			}
			echo $salida;
			$dbConexion = null; $consult = null;
			break;
		case 'admInc':
			$inval = 0;
			$consult = $dbConexion -> prepare("SELECT COUNT(id_admin) AS 'CantVal' FROM administradores WHERE condicion = :inval && id_admin != :keyAdm");
			$consult -> bindParam("inval", $inval, PDO::PARAM_INT);
			$consult -> bindParam("keyAdm", $keyAdm, PDO::PARAM_INT);
			$consult -> execute();
			$salida = "";
			while ( $data = $consult -> fetch(PDO::FETCH_ASSOC) ) {
				$salida .= $data["CantVal"];
			}
			echo $salida;
			$dbConexion = null; $consult = null;
			break;							
	default:
		$dbConexion = null;
		break;
	}
}

ob_end_flush();

?>