<?php 
include '../../modelos/conect.php';
$fechAct = date("Y-m-d");
$dbc = new Connect();
$dbc = $dbc -> getDB();
function generarCodigo($longitud) {
	$key = '';
	$pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
	$max = strlen($pattern)-1;
	for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
	return 'COD'.$key;
}
function insertCamp($num_ser, $clv_us, $tag, $desc, $file) {
}
$num_ser = generarCodigo(9);
$clv_us = isset($_POST['clv_us']) ? trim($_POST['clv_us']) : "";
$clv_us = base64_decode($clv_us);
$descProb = isset($_POST['descProb']) ? trim($_POST['descProb']) : "";
$file = $_FILES['fileUpload']['name'];
$tag = $_GET['tag'];
$estado = 1;
if ($file) {
	$fileUpload = $_FILES['fileUpload']['name'];
	$tipoImg = $_FILES['fileUpload']['type'];
	if (($fileUpload == !NULL)) {
		if ($tipoImg == "image/jpeg" || $tipoImg == "image/jpg" || $tipoImg == "image/png") {
			$directorioG = "../../modDevop/reports/";
			move_uploaded_file($_FILES['fileUpload']['tmp_name'], $directorioG.$fileUpload);
		}
	}
	try {
		$stmt = $dbc -> prepare("INSERT INTO reportsprob (num_serie_rep, fecha_reg_rep, estado_rep, id_user, tag_user, describ_prob, arch_prob) VALUES (:num_ser, :fechAct, :estado, :clv_us, :tag, :descProb, :fileUpload)");
 		$stmt -> bindParam(":num_ser", $num_ser, PDO::PARAM_STR);
 		$stmt -> bindParam(":fechAct", $fechAct, PDO::PARAM_STR);
 		$stmt -> bindParam(":estado", $estado, PDO::PARAM_INT);
 		$stmt -> bindParam(":clv_us", $clv_us, PDO::PARAM_INT);
 		$stmt -> bindParam(":tag", $tag, PDO::PARAM_STR);
 		$stmt -> bindParam(":descProb", $descProb, PDO::PARAM_STR);
 		$stmt -> bindParam(":fileUpload", $fileUpload, PDO::PARAM_STR);
 		$resStmt = $stmt -> execute();
 		if ($resStmt) {
 			echo "1";
 		} else {
 			echo "2";
 		}
	} catch (PDOException $e) {
		echo $e->getMessage();
	} finally {
		$dbc = null; $stmt = null;
		unset($num_ser,$fechAct,$estado,$clv_us,$tag,$descProb,$fileUpload);
	}
} else {
	try {
		$noImg = "Sin imagen";
		$stmt = $dbc -> prepare("INSERT INTO reportsprob (num_serie_rep, fecha_reg_rep, estado_rep, id_user, tag_user, describ_prob, arch_prob) VALUES (:num_ser, :fechAct, :estado, :clv_us, :tag, :descProb, :noImg)");
 		$stmt -> bindParam(":num_ser", $num_ser, PDO::PARAM_STR);
 		$stmt -> bindParam(":fechAct", $fechAct, PDO::PARAM_STR);
 		$stmt -> bindParam(":estado", $estado, PDO::PARAM_INT);
 		$stmt -> bindParam(":clv_us", $clv_us, PDO::PARAM_INT);
 		$stmt -> bindParam(":tag", $tag, PDO::PARAM_STR);
 		$stmt -> bindParam(":descProb", $descProb, PDO::PARAM_STR);
 		$stmt -> bindParam(":noImg", $noImg, PDO::PARAM_STR);
 		$resStmt = $stmt -> execute();
 		if ($resStmt) {
 			echo "1";
 		} else {
 			echo "2";
 		}
	} catch (PDOException $e) {
		echo $e->getMessage();
	} finally {
		$dbc = null; $stmt = null;
		unset($num_ser,$fechAct,$estado,$clv_us,$tag,$descProb,$noImg);
	}
}