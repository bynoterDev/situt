<?php

ob_start();
session_start();

if ($_SESSION['keyDir'] == "" || $_SESSION['keyDir'] == null) {
	header("Location:../../Index.php");
} else {
	include '../../modelos/rutasAmig.php';
	require_once '../../modelos/director.modelo.php';
	$director = new Director();
	$keyDir = $_SESSION['keyDir'];
	$datDirec = $director->userDirDet($_SESSION['keyDir']);
	$id_car = $datDirec->id_carrera;
	$fechAct = date("Y-m-d");
	$dbConexion = new Connect();
	$dbConexion = $dbConexion -> getDB();
	switch ($_GET['oper']) {
		case 'regTut':
			$nomTut = isset($_POST['nomTut']) ? limpiarDatos($_POST['nomTut']) : "";
			$corTut = isset($_POST['corTut']) ? limpiarDatos($_POST['corTut']) : "";
			$dirTut = isset($_POST['dirTut']) ? limpiarDatos($_POST['dirTut']) : "";
			$passTut = isset($_POST['passTut']) ? limpiarDatos($_POST['passTut']) : "";
			$edaTut = isset($_POST['edaTut']) ? limpiarDatos($_POST['edaTut']) : "";
			$espTut = isset($_POST['espTut']) ? limpiarDatos($_POST['espTut']) : "";
			$telTut = isset($_POST['telTut']) ? limpiarDatos($_POST['telTut']) : "";
			$estTut = isset($_POST['estTut']) ? limpiarDatos($_POST['estTut']) : "";
			$carrera = isset($_POST['clv_carr']) ? limpiarDatos($_POST['clv_carr']) : "";

			$passTutEnc = sha1($passTut);
			$nomTutMayPL = ucwords($nomTut);
			$valid = $dbConexion->prepare("SELECT * FROM docentes WHERE nombre_c_doc = :nomTutMayPL");
			$valid -> bindParam("nomTutMayPL", $nomTutMayPL, PDO::PARAM_STR);
			$valid -> execute();
			$resvalid = $valid -> rowCount();
			if ($resvalid === 0) {
				$valid1 = $dbConexion->prepare("SELECT * FROM docentes WHERE correo_doc = :corTut");
				$valid1 -> bindParam("corTut", $corTut, PDO::PARAM_STR);
				$valid1 -> execute();
				$resvalid1 = $valid1 -> rowCount();
				if ($resvalid1 === 0) {
					$stmt = $dbConexion->prepare("INSERT INTO docentes (nombre_c_doc, correo_doc, direccion_doc, contrasena_doc, contdesc_doc, edad_doc, especialidad_doc, telefono_doc, condicion_doc, fecha_reg_doc, id_carrera) VALUES (:nomTutMayPL, :corTut, :dirTut, :passTutEnc, :passTut, :edaTut, :espTut, :telTut, :estTut, :fechAct, :carrera)");
					$stmt -> bindParam(":nomTutMayPL", $nomTutMayPL, PDO::PARAM_STR);
					$stmt -> bindParam(":corTut", $corTut, PDO::PARAM_STR);
					$stmt -> bindParam(":dirTut", $dirTut, PDO::PARAM_STR);
					$stmt -> bindParam(":passTutEnc", $passTutEnc, PDO::PARAM_STR);
					$stmt -> bindParam(":passTut", $passTut, PDO::PARAM_STR);
					$stmt -> bindParam(":edaTut", $edaTut, PDO::PARAM_STR);
					$stmt -> bindParam(":espTut", $espTut, PDO::PARAM_STR);
					$stmt -> bindParam(":telTut", $telTut, PDO::PARAM_STR);
					$stmt -> bindParam(":estTut", $estTut, PDO::PARAM_INT);
					$stmt -> bindParam(":fechAct", $fechAct, PDO::PARAM_STR);
					$stmt -> bindParam(":carrera", $carrera, PDO::PARAM_STR);
					
					$stmt -> execute();
					$resstmt = $stmt -> rowCount();
					if ($resstmt === 1) { echo "goodIns"; } else { echo "failIns"; }
				} else {
					echo "extCor";
				}
			} else {
				echo "extTut";
			}
			$valid = null; $resvalid = null; $valid1 = null; $resvalid1 = null; $stmt = null; 
			$resstmt = null; $dbConexion = null;
			break;
		case 'listarTutores':
			$valid = 1;
			$car = $_SESSION['id_carrera'];
			$stmt = $dbConexion -> prepare("SELECT * FROM docentes WHERE condicion_doc = :valid && id_carrera = :car ORDER BY nombre_c_doc");
			$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
			$stmt -> bindParam("car", $car, PDO::PARAM_INT);
			$stmt -> execute();
			$data = Array();
			while ($reg = $stmt -> fetch(PDO::FETCH_OBJ)){
            $data[]=array(
                "0" => $reg -> nombre_c_doc,
                "1" => $reg -> correo_doc,
                "2" => $reg -> telefono_doc,
                "3" => '<a class="btn btn-outline-primary btn-sm" href="'.SERVERURLDIR.'PerfDoc/'.base64_encode($reg->id_docente).'/"> <i class="fas fa-eye mr-2"></i> Perfil</a> 
	            	<button class="btn btn-outline-danger btn-sm" type="button" onclick="desactivarTut('.$reg->id_docente.')">
	            		<i class="fas fa-times"></i>
	            	</button>'
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
		case 'listarTutoresDes':
			$inval = 0;
			$car = $_SESSION['id_carrera'];
			$stmt = $dbConexion -> prepare("SELECT * FROM docentes WHERE condicion_doc = :inval && id_carrera = :car ORDER BY nombre_c_doc");
			$stmt -> bindParam("inval", $inval, PDO::PARAM_INT);
			$stmt -> bindParam("car", $car, PDO::PARAM_INT);
			$stmt -> execute();
			$data = Array();
			while ($reg = $stmt -> fetch(PDO::FETCH_OBJ)){
            $data[]=array(
                "0" => $reg -> nombre_c_doc,
                "1" => $reg -> correo_doc,
                "2" => $reg -> telefono_doc,
                "3" => '<a class="btn btn-sm btn-outline-primary" href="'.SERVERURLDIR.'PerfDoc/'.base64_encode($reg->id_docente).'/"> <i class="fas fa-eye mr-2"></i> Perfil</a> 
            	<button class="btn btn-outline-primary btn-sm" type="button" onclick="activarTut('.$reg->id_docente.')">
            		<i class="fas fa-check"></i>
            	</button>'
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
		case 'activarTut':
			$valid = 1;
			$id_docente = isset($_POST['id_docente']) ? limpiarDatos($_POST['id_docente']) : "";
			$stmt = $dbConexion -> prepare("UPDATE docentes SET condicion_doc = :valid WHERE id_docente = :id_docente");
			$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
			$stmt -> bindParam("id_docente", $id_docente, PDO::PARAM_INT);
			$resstmt = $stmt -> execute();
			if ($resstmt) {
				echo 1;
			} else {
				echo 0;
			}
			$stmt = null; $dbConexion = null;
			break;
		case 'desactivarTut':
			$inval = 0;
			$id_docente = isset($_POST['id_docente']) ? limpiarDatos($_POST['id_docente']) : "";
			$stmt = $dbConexion -> prepare("UPDATE docentes SET condicion_doc = :inval WHERE id_docente = :id_docente");
			$stmt -> bindParam("inval", $inval, PDO::PARAM_INT);
			$stmt -> bindParam("id_docente", $id_docente, PDO::PARAM_INT);
			$resstmt = $stmt -> execute();
			if ($resstmt) {
				echo 1;
			} else {
				echo 0;
			}
			$stmt = null; $dbConexion = null;
			break;		
		case 'regGrupo':
			$id_carrera = isset($_POST['id_carrera']) ? limpiarDatos($_POST['id_carrera']) : "";
			//$perGrp = isset($_POST['perGrp']) ? limpiarDatos($_POST['perGrp']) : "";
			$grpDet = isset($_POST['grpDet']) ? limpiarDatos($_POST['grpDet']) : "";
			$docGrp = isset($_POST['docGrp']) ? limpiarDatos($_POST['docGrp']) : "";
			$estGrp = isset($_POST['estGrp']) ? limpiarDatos($_POST['estGrp']) : "";
			$valid = $dbConexion->prepare("SELECT * FROM det_grupo WHERE id_docente = :docGrp && id_carrera = :id_carrera && id_grupo = :id_grupo");
			$valid -> bindParam("docGrp", $docGrp, PDO::PARAM_INT);
			$valid -> bindParam("id_carrera", $id_carrera, PDO::PARAM_INT);
			$valid -> bindParam("id_grupo", $grpDet, PDO::PARAM_INT);
			$valid -> execute();
			$resvalid = $valid -> rowCount();
			if ($resvalid === 0) {
				/*
				$valid1 = $dbConexion -> prepare("SELECT * FROM det_grupo WHERE id_grupo = :grpDet");
				$valid1 -> bindParam("grpDet", $grpDet, PDO::PARAM_INT);
				$valid1 -> execute();
				$resvalid1 = $valid1 -> rowCount();
				if ($resvalid1 === 0) {*/
					$stmt = $dbConexion->prepare("INSERT INTO det_grupo (id_grupo, id_docente, id_carrera, estado_detgrp) VALUES (:grpDet, :docGrp, :id_carrera, :estGrp)");
					$stmt -> bindParam(":grpDet", $grpDet, PDO::PARAM_INT);
					$stmt -> bindParam(":docGrp", $docGrp, PDO::PARAM_INT);
					$stmt -> bindParam(":id_carrera", $id_carrera, PDO::PARAM_INT);
					$stmt -> bindParam(":estGrp", $estGrp, PDO::PARAM_INT);
					$stmt -> execute();
					$resstmt = $stmt -> rowCount();
					if ($resstmt === 1) {
						echo "goodIns";
					} else {
						echo "failIns";
					}
				/*} else {
					echo "extDatGrp";
				}*/
			} else {
				echo "extDat";
			}
			$valid = null; $resvalid = null; $stmt = null; $resstmt = null; $dbConexion = null;
			break;	
		case 'listarGruposAct':
			$valid = 1;
			$stmt = $dbConexion -> prepare("SELECT * FROM det_grupo dgr 
				INNER JOIN grupos gr ON gr.id_grupo = dgr.id_grupo
				INNER JOIN docentes doc ON doc.id_docente = dgr.id_docente
				INNER JOIN carreras car ON car.id_carrera = dgr.id_carrera
				WHERE dgr.id_carrera = :id_car && dgr.estado_detgrp = :valid ORDER BY gr.grupo_n");
			$stmt -> bindParam("id_car", $id_car, PDO::PARAM_INT);
			$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
			$stmt -> execute();
			$data = Array();
			while ($reg = $stmt -> fetch(PDO::FETCH_OBJ)){
	            $data[]=array(
	                "0"=>$reg->grupo_n,
	                "1"=>$reg->nombre_c_doc,
	                "2" => '<button data-toggle="modal" data-backdrop="false" data-target="#editGrp" class="btn btn-outline-warning btn-sm" onclick="mostrarGrp('.$reg->id_detgrupo.')"><i class="fas fa-edit"></i></button>'.
	                    ' <button class="btn btn-outline-danger btn-sm" onclick="desactivarGrp('.$reg->id_detgrupo.')"><i class="fa fa-times"></i></button> '.'<a class="btn btn-outline-primary btn-sm" href="'.SERVERURLDIR.'DetGrp/'.base64_encode($reg->id_detgrupo).'/"><i class="fa fa-info mr-2"></i>Info</a>'
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
		case 'listarGruposDes':
			$inval = 0;
			$stmt = $dbConexion -> prepare("SELECT * FROM det_grupo dgr 
				INNER JOIN grupos gr ON gr.id_grupo = dgr.id_grupo
				INNER JOIN docentes doc ON doc.id_docente = dgr.id_docente
				INNER JOIN carreras car ON car.id_carrera = dgr.id_carrera
				WHERE dgr.id_carrera = :id_car && dgr.estado_detgrp = :inval ORDER BY gr.grupo_n");
			$stmt -> bindParam("id_car", $id_car, PDO::PARAM_INT);
			$stmt -> bindParam("inval", $inval, PDO::PARAM_INT);
			$stmt -> execute();
			$data = Array();
			while ($reg = $stmt -> fetch(PDO::FETCH_OBJ)){
	            $data[]=array(
	                "0"=>$reg->grupo_n,
	                "1"=>$reg->nombre_c_doc,
	                "2"=>'<button data-toggle="modal" data-backdrop="false" data-target="#editGrp" class="btn btn-outline-warning btn-sm" onclick="mostrarGrp('.$reg->id_detgrupo.')"><i class="fa fa-edit"></i></button>'.
                    ' <button class="btn btn-sm btn-outline-primary" onclick="activarGrp('.$reg->id_detgrupo.')"><i class="fa fa-check"></i></button>'
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
		case 'desactivarGrp':
			$inval = 0;
			$id_detgrupo = isset($_POST['id_detgrupo']) ? limpiarDatos($_POST['id_detgrupo']) : "";
			$stmt = $dbConexion -> prepare("UPDATE det_grupo SET estado_detgrp = :inval WHERE id_detgrupo = :id_detgrupo");
			$stmt -> bindParam("inval", $inval, PDO::PARAM_INT);
			$stmt -> bindParam("id_detgrupo", $id_detgrupo, PDO::PARAM_INT);
			$resstmt = $stmt -> execute();
			if ($resstmt) {
				echo 1;
			} else {
				echo 2;
			}
			$stmt = null; $dbConexion = null;
			break;
		case 'activarGrp':
			$valid = 1;
			$id_detgrupo = isset($_POST['id_detgrupo']) ? limpiarDatos($_POST['id_detgrupo']) : "";
			$stmt = $dbConexion -> prepare("UPDATE det_grupo SET estado_detgrp = :valid WHERE id_detgrupo = :id_detgrupo");
			$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
			$stmt -> bindParam("id_detgrupo", $id_detgrupo, PDO::PARAM_INT);
			$resstmt = $stmt -> execute();
			if ($resstmt) {
				echo 1;
			} else {
				echo 2;
			}
			$stmt = null; $dbConexion = null;
			break;	
		case 'mostrarGrp':
			$id_detgrupo = isset($_POST['id_detgrupo']) ? limpiarDatos($_POST['id_detgrupo']) : "";
			$result = $director->mostrarGrp($id_detgrupo);
			echo json_encode($result);
			$result = null;
			break;	
		case 'editGrupo':
			$car = $_SESSION['id_carrera'];
			$id_detgrupo = isset($_POST['id_detgrupo']) ? limpiarDatos($_POST['id_detgrupo']) : "";
			$id_periodo = isset($_POST['id_periodo']) ? limpiarDatos($_POST['id_periodo']) : "";
			$id_docente = isset($_POST['id_docente']) ? limpiarDatos($_POST['id_docente']) : "";
			$perGrpEdit = isset($_POST['perGrpEdit']) ? limpiarDatos($_POST['perGrpEdit']) : "";
			$tutGrpEdit = isset($_POST['tutGrpEdit']) ? limpiarDatos($_POST['tutGrpEdit']) : "";
			$nuevoTutor = isset($_POST['nuevoTutor']) ? limpiarDatos($_POST['nuevoTutor']) : "";
			$passConf = isset($_POST['passConf']) ? limpiarDatos($_POST['passConf']) : "";

			$grup = isset($_POST['id_grupo']) ? limpiarDatos($_POST['id_grupo']) : "";
			$doc = isset($_POST['tutAct']) ? limpiarDatos($_POST['tutAct']) : "";

			$passConfEnc = sha1($passConf);

			$valid = $dbConexion->prepare(" SELECT * FROM det_grupo WHERE id_grupo = :gru AND id_docente = :doc AND id_carrera = :car;");
			$valid -> bindParam("gru", $tutGrpEdit, PDO::PARAM_INT);
			$valid -> bindParam("doc", $id_docente, PDO::PARAM_STR);
			$valid -> bindParam("car", $car, PDO::PARAM_STR);
			$valid -> execute();
			$resvalid = $valid -> rowCount();
			if ($resvalid >= 1) {
				/*
				if ($perGrpEdit != "No" && $tutGrpEdit != "No") {
					$upd1 = $dbConexion->prepare("UPDATE det_grupo SET id_periodo = :perGrpEdit, id_docente = :tutGrpEdit WHERE id_detgrupo = :id_detgrupo");
					$upd1 -> bindParam("perGrpEdit", $perGrpEdit, PDO::PARAM_INT);
					$upd1 -> bindParam("tutGrpEdit", $tutGrpEdit, PDO::PARAM_INT);
					$upd1 -> bindParam("id_detgrupo", $id_detgrupo, PDO::PARAM_INT);
					$resupd1 = $upd1 -> execute();
					if ($resupd1) {
						echo 1;
					} else {
						echo 0;
					}
				} else if ($perGrpEdit != "No") {
					$upd2 = $dbConexion->prepare("UPDATE det_grupo SET id_periodo = :perGrpEdit WHERE id_detgrupo = :id_detgrupo");
					$upd2 -> bindParam("perGrpEdit", $perGrpEdit, PDO::PARAM_INT);
					$upd2 -> bindParam("id_detgrupo", $id_detgrupo, PDO::PARAM_INT);
					$resupd2 = $upd2 -> execute();
					if ($resupd2) {
						echo 1;
					} else {
						echo 0;
					}
				} else if ($tutGrpEdit != "No") {
					$upd3 = $dbConexion->prepare("UPDATE det_grupo SET id_docente = :tutGrpEdit WHERE id_detgrupo = :id_detgrupo");
					$upd3 -> bindParam("tutGrpEdit", $tutGrpEdit, PDO::PARAM_INT);
					$upd3 -> bindParam("id_detgrupo", $id_detgrupo, PDO::PARAM_INT);
					$resupd3 = $upd3 -> execute();
					if ($resupd3) {
						echo 1;
					} else {
						echo 0;
					}
				} else {
					echo 3;
				}*/
				echo 2;
			} else {
				

				$upd2 = $dbConexion->prepare("UPDATE det_grupo SET id_grupo = :grup, id_docente=:newTutor WHERE id_detgrupo = :id_detgrupo");
				$upd2 -> bindParam("grup", $tutGrpEdit, PDO::PARAM_INT);
				$upd2 -> bindParam("id_detgrupo", $id_detgrupo, PDO::PARAM_INT);
				$upd2 -> bindParam("newTutor", $nuevoTutor, PDO::PARAM_INT);
				$resupd2 = $upd2 -> execute();
				if ($resupd2) {
					echo 1;
				} else {
					echo 2;
				}
				
			}
			$valid = null; $resvalid = null; $upd1 = null; $resupd1 = null; 
			$upd2 = null; $resupd2 = null; $upd3 = null; $resupd3 = null;
			$dbConexion = null;
			break;	
		case 'confNCDoc':
			$id_docente = isset($_POST['id_docente']) ? limpiarDatos($_POST['id_docente']) : "";
			$id_docente = base64_decode($id_docente);
			$newContDoc = isset($_POST['newContDoc']) ? limpiarDatos($_POST['newContDoc']) : "";
			$newContDocEnc = sha1($newContDoc);
			$contDirConf = isset($_POST['contDirConf']) ? limpiarDatos($_POST['contDirConf']) : "";
			$contDirConfEnc = sha1($contDirConf);
			$valid = $dbConexion -> prepare("SELECT nombre_c_dir FROM directores WHERE contrasena_dir = :contDirConfEnc && id_director = :keyDir");
			$valid -> bindParam("contDirConfEnc", $contDirConfEnc, PDO::PARAM_INT);
			$valid -> bindParam("keyDir", $keyDir, PDO::PARAM_STR);
			$valid -> execute();
			$resvalid = $valid -> rowCount();
			if ($resvalid == 1) {
				$stmt = $dbConexion -> prepare("UPDATE docentes SET contrasena_doc = :newContDocEnc, contdesc_doc = :newContDoc WHERE id_docente = :id_docente");
				$stmt -> bindParam("newContDocEnc", $newContDocEnc, PDO::PARAM_STR);
				$stmt -> bindParam("newContDoc", $newContDoc, PDO::PARAM_STR);
				$stmt -> bindParam("id_docente", $id_docente, PDO::PARAM_INT);
				$resstmt = $stmt -> execute();
				if ($resstmt) {
					echo "goodUpd";
				} else {
					echo "failUpd";
				}
			} else {
				echo "failCont";
			}
			$valid = null; $resvalid = null; $stmt = null; $resstmt = null; $dbConexion = null;
 			break;
 		case 'docAct':
			$valid = 1;
			$consult = $dbConexion -> prepare("SELECT COUNT(doc.id_docente) AS 'ValDoc' FROM docentes doc WHERE doc.condicion_doc = :valid");
			$consult -> bindParam("valid", $valid, PDO::PARAM_INT);
			$consult -> execute();
			$salida = "";
			while ( $data = $consult -> fetch(PDO::FETCH_ASSOC) ) {
				$salida .= $data["ValDoc"];
			}
			echo $salida;
			$dbConexion = null; $consult = null;
			break;
		case 'docInc':
			$inval = 0;
			$consult = $dbConexion -> prepare("SELECT COUNT(doc.id_docente) AS 'ValDoc' FROM docentes doc WHERE doc.condicion_doc = :inval");
			$consult -> bindParam("inval", $inval, PDO::PARAM_INT);
			$consult -> execute();
			$salida = "";
			while ( $data = $consult -> fetch(PDO::FETCH_ASSOC) ) {
				$salida .= $data["ValDoc"];
			}
			echo $salida;
			$dbConexion = null; $consult = null;
			break;			
		default:
			break;
	}
}

ob_end_flush();