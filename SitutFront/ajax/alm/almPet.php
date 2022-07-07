<?php

ob_start();
session_start();

if ($_SESSION['keyAlm'] == "" || $_SESSION['keyAlm'] == null) {
	header("Location:../../Index.php");
} else {
	require_once '../../modelos/alumno.modelo.php';
	$alumno = new Alumno();
	$keyAlm = $_SESSION['keyAlm'];
	$fechAct = date("Y-m-d");
	$datGrpAlm = $alumno->datGrpAlm($_SESSION['keyAlm']);
	//$dbConexion = Connect::getDB();
	
	$dbConexion = new Connect();
	$dbConexion = $dbConexion -> getDB();
	switch ($_GET['oper']) {
		case 'regJustif':
			$sitJustif = isset($_POST['sitJustif']) ? limpiarDatos($_POST['sitJustif']) : "";
			$cuatJustif = isset($_POST['cuatJustif']) ? limpiarDatos($_POST['cuatJustif']) : "";
			$archJustif = isset($_POST['archJustif']) ? limpiarDatos($_POST['archJustif']) : "";
			$fechJustif = isset($_POST['fechJustif']) ? limpiarDatos($_POST['fechJustif']) : "";
			$archJustif = $_FILES['archJustif']['name'];
			if (!empty($archJustif)) {
				$tipoArch = $_FILES['archJustif']['type'];
				if (($tipoArch == !NULL)) {
					if ($tipoArch == "image/jpeg" || $tipoArch == "image/jpg" || $tipoArch == "image/png" || $tipoArch == "application/pdf") {
						$directorioG = "../../modAlm/Arch/justificantes/";
						move_uploaded_file($_FILES['archJustif']['tmp_name'], $directorioG.$archJustif);
					}
				}
			}
			$stmt = $dbConexion -> prepare("INSERT INTO justificantes (situacion_justif, cuatrimestre_justif, fecha_justif, fecha_reg_justif, estado_justif, archivo_justif, id_alumno) VALUES (:sitJustif, :cuatJustif, :fechJustif, :fechAct, 0, :archJustif, :keyAlm)");
			$stmt -> bindParam(":sitJustif", $sitJustif, PDO::PARAM_STR);
			$stmt -> bindParam(":cuatJustif", $cuatJustif, PDO::PARAM_STR);
			$stmt -> bindParam(":fechJustif", $fechJustif, PDO::PARAM_STR);
			$stmt -> bindParam(":fechAct", $fechAct, PDO::PARAM_STR);
			$stmt -> bindParam(":archJustif", $archJustif, PDO::PARAM_STR);
			$stmt -> bindParam(":keyAlm", $keyAlm, PDO::PARAM_INT);
			$stmt -> execute();
			$resstmt = $stmt -> rowCount();
			if ($resstmt === 1) {
				echo "goodIns";
			} else {
				echo "failIns";
			}
			$stmt = null; $resstmt = null; $dbConexion = null;
			break;
		case 'regDatPerf':
			$curpDat = isset($_POST['curpDat']) ? limpiarDatos($_POST['curpDat']) : "";
			$fechNac = isset($_POST['fechNac']) ? limpiarDatos($_POST['fechNac']) : "";
			$eddAlm = isset($_POST['eddAlm']) ? limpiarDatos($_POST['eddAlm']) : "";
			$estCiv = isset($_POST['estCiv']) ? limpiarDatos($_POST['estCiv']) : "";
			$faceAlm = isset($_POST['faceAlm']) ? limpiarDatos($_POST['faceAlm']) : "";
			$tipSegSocial = isset($_POST['tipSegSocial']) ? limpiarDatos($_POST['tipSegSocial']) : "";
			$numSegSocial = isset($_POST['numSegSocial']) ? limpiarDatos($_POST['numSegSocial']) : "";
			$telCas = isset($_POST['telCas']) ? limpiarDatos($_POST['telCas']) : "";
			$telRec = isset($_POST['telRec']) ? limpiarDatos($_POST['telRec']) : "";
			$callDomAlm = isset($_POST['callDomAlm']) ? limpiarDatos($_POST['callDomAlm']) : "";
			$numDomAlm = isset($_POST['numDomAlm']) ? limpiarDatos($_POST['numDomAlm']) : "";
			$colDomAlm = isset($_POST['colDomAlm']) ? limpiarDatos($_POST['colDomAlm']) : "";
			$locDomAlm = isset($_POST['locDomAlm']) ? limpiarDatos($_POST['locDomAlm']) : "";
			$munDomAlm = isset($_POST['munDomAlm']) ? limpiarDatos($_POST['munDomAlm']) : "";
			$estDomAlm = isset($_POST['estDomAlm']) ? limpiarDatos($_POST['estDomAlm']) : "";
			$codPostDomAlm = isset($_POST['codPostDomAlm']) ? limpiarDatos($_POST['codPostDomAlm']) : "";
			$munOrgAlm = isset($_POST['munOrgAlm']) ? limpiarDatos($_POST['munOrgAlm']) : "";
			$estOrgAlm = isset($_POST['estOrgAlm']) ? limpiarDatos($_POST['estOrgAlm']) : "";
			$valid = $dbConexion -> prepare("SELECT * FROM datpersonales_alm WHERE id_alumno = :keyAlm");
			$valid -> bindParam("keyAlm", $keyAlm, PDO::PARAM_INT);
			$valid -> execute();
			$resvalid = $valid -> rowCount();
			if ($resvalid === 0) {
				$valid1 = $dbConexion -> prepare("SELECT * FROM datpersonales_alm WHERE curp_dat = :curpDat");
				$valid1 -> bindParam("curpDat", $curpDat, PDO::PARAM_STR);
				$valid1 -> execute();
				$resvalid1 = $valid1 -> rowCount();
				if ($resvalid1 === 0) {
					if (!empty($numSegSocial)) {
						$valid2 = $dbConexion -> prepare("SELECT * FROM datpersonales_alm WHERE num_segsocial_dat = :numSegSocial");
						$valid2 -> bindParam("numSegSocial", $numSegSocial, PDO::PARAM_STR);
						$valid2 -> execute();
						$resvalid2 = $valid2 -> rowCount();
						if ($resvalid2 === 0) {
							$stmt = $dbConexion -> prepare("INSERT INTO datpersonales_alm (id_alumno, curp_dat, fecha_nac_dat, edad_dat, estado_civil_dat, tipo_segsocial_dat, num_segsocial_dat, telefono_casa_dat, telefono_rec_dat, facebook_alm_dat, calle_dat_act, num_casa_dat_act, colonia_dat_act, localidad_dat_act, municipio_dat_act, estado_dat_act, codpostal_dat_act, municipio_dat_org, estado_dat_org) VALUES (:keyAlm, :curpDat, :fechNac, :eddAlm, :estCiv, :tipSegSocial, :numSegSocial, :telCas, :telRec, :faceAlm, :callDomAlm, :numDomAlm, :colDomAlm, :locDomAlm, :munDomAlm, :estDomAlm, :codPostDomAlm, :munOrgAlm, :estOrgAlm)");
							$stmt -> bindParam(":keyAlm", $keyAlm, PDO::PARAM_INT);
							$stmt -> bindParam(":curpDat", $curpDat, PDO::PARAM_STR);
							$stmt -> bindParam(":fechNac", $fechNac, PDO::PARAM_STR);
							$stmt -> bindParam(":eddAlm", $eddAlm, PDO::PARAM_INT);
							$stmt -> bindParam(":estCiv", $estCiv, PDO::PARAM_STR);
							$stmt -> bindParam(":tipSegSocial", $tipSegSocial, PDO::PARAM_STR);
							$stmt -> bindParam(":numSegSocial", $numSegSocial, PDO::PARAM_STR);
							$stmt -> bindParam(":telCas", $telCas, PDO::PARAM_STR);
							$stmt -> bindParam(":telRec", $telRec, PDO::PARAM_STR);
							$stmt -> bindParam(":faceAlm", $faceAlm, PDO::PARAM_STR);
							$stmt -> bindParam(":callDomAlm", $callDomAlm, PDO::PARAM_STR);
							$stmt -> bindParam(":numDomAlm", $numDomAlm, PDO::PARAM_STR);
							$stmt -> bindParam(":colDomAlm", $colDomAlm, PDO::PARAM_STR);
							$stmt -> bindParam(":locDomAlm", $locDomAlm, PDO::PARAM_STR);
							$stmt -> bindParam(":munDomAlm", $munDomAlm, PDO::PARAM_STR);
							$stmt -> bindParam(":estDomAlm", $estDomAlm, PDO::PARAM_STR);
							$stmt -> bindParam(":codPostDomAlm", $codPostDomAlm, PDO::PARAM_STR);
							$stmt -> bindParam(":munOrgAlm", $munOrgAlm, PDO::PARAM_STR);
							$stmt -> bindParam(":estOrgAlm", $estOrgAlm, PDO::PARAM_STR);
							$stmt -> execute();
							$resstmt = $stmt -> rowCount();
							if ($resstmt === 1) {
								echo "goodIns";
							} else {
								echo "failIns";
							}
						} else {
							echo "extNumS";
						}
					} else {
						$stmt = $dbConexion -> prepare("INSERT INTO datpersonales_alm (id_alumno, curp_dat, fecha_nac_dat, edad_dat, estado_civil_dat, tipo_segsocial_dat, num_segsocial_dat, telefono_casa_dat, telefono_rec_dat, facebook_alm_dat, calle_dat_act, num_casa_dat_act, colonia_dat_act, localidad_dat_act, municipio_dat_act, estado_dat_act, codpostal_dat_act, municipio_dat_org, estado_dat_org) VALUES (:keyAlm, :curpDat, :fechNac, :eddAlm, :estCiv, :tipSegSocial, :numSegSocial, :telCas, :telRec, :faceAlm, :callDomAlm, :numDomAlm, :colDomAlm, :locDomAlm, :munDomAlm, :estDomAlm, :codPostDomAlm, :munOrgAlm, :estOrgAlm)");
						$stmt -> bindParam(":keyAlm", $keyAlm, PDO::PARAM_INT);
						$stmt -> bindParam(":curpDat", $curpDat, PDO::PARAM_STR);
						$stmt -> bindParam(":fechNac", $fechNac, PDO::PARAM_STR);
						$stmt -> bindParam(":eddAlm", $eddAlm, PDO::PARAM_INT);
						$stmt -> bindParam(":estCiv", $estCiv, PDO::PARAM_STR);
						$stmt -> bindParam(":tipSegSocial", $tipSegSocial, PDO::PARAM_STR);
						$stmt -> bindParam(":numSegSocial", $numSegSocial, PDO::PARAM_STR);
						$stmt -> bindParam(":telCas", $telCas, PDO::PARAM_STR);
						$stmt -> bindParam(":telRec", $telRec, PDO::PARAM_STR);
						$stmt -> bindParam(":faceAlm", $faceAlm, PDO::PARAM_STR);
						$stmt -> bindParam(":callDomAlm", $callDomAlm, PDO::PARAM_STR);
						$stmt -> bindParam(":numDomAlm", $numDomAlm, PDO::PARAM_STR);
						$stmt -> bindParam(":colDomAlm", $colDomAlm, PDO::PARAM_STR);
						$stmt -> bindParam(":locDomAlm", $locDomAlm, PDO::PARAM_STR);
						$stmt -> bindParam(":munDomAlm", $munDomAlm, PDO::PARAM_STR);
						$stmt -> bindParam(":estDomAlm", $estDomAlm, PDO::PARAM_STR);
						$stmt -> bindParam(":codPostDomAlm", $codPostDomAlm, PDO::PARAM_STR);
						$stmt -> bindParam(":munOrgAlm", $munOrgAlm, PDO::PARAM_STR);
						$stmt -> bindParam(":estOrgAlm", $estOrgAlm, PDO::PARAM_STR);
						$stmt -> execute();
						$resstmt = $stmt -> rowCount();
						if ($resstmt === 1) {
							echo "goodIns";
						} else {
							echo "failIns";
						}
					}
				} else {
					echo "extCurp";
				}
			} else {
				echo "extDat";
			}
			$valid = null; $resvalid = null; $valid1 = null; $resvalid1 = null; $valid2 = null; 
			$resvalid2 = null; $stmt = null; $resstmt = null; $dbConexion = null;
			break;	
		case 'editDatPer':
			$curpDatEdit = isset($_POST['curpDatEdit']) ? limpiarDatos($_POST['curpDatEdit']) : "";
			$fechNacEdit = isset($_POST['fechNacEdit']) ? limpiarDatos($_POST['fechNacEdit']) : "";
			$eddAlmEdit = isset($_POST['eddAlmEdit']) ? limpiarDatos($_POST['eddAlmEdit']) : "";
			$estCivEdit = isset($_POST['estCivEdit']) ? limpiarDatos($_POST['estCivEdit']) : "";
			$faceAlmEdit = isset($_POST['faceAlmEdit']) ? limpiarDatos($_POST['faceAlmEdit']) : "";
			$tipSegSocialEdit = isset($_POST['tipSegSocialEdit']) ? limpiarDatos($_POST['tipSegSocialEdit']) : "";
			$numSegSocialEdit = isset($_POST['numSegSocialEdit']) ? limpiarDatos($_POST['numSegSocialEdit']) : "";
			$telCasEdit = isset($_POST['telCasEdit']) ? limpiarDatos($_POST['telCasEdit']) : "";
			$telRecEdit = isset($_POST['telRecEdit']) ? limpiarDatos($_POST['telRecEdit']) : "";
			$callDomAlmEdit = isset($_POST['callDomAlmEdit']) ? limpiarDatos($_POST['callDomAlmEdit']) : "";
			$numDomAlmEdit = isset($_POST['numDomAlmEdit']) ? limpiarDatos($_POST['numDomAlmEdit']) : "";
			$colDomAlmEdit = isset($_POST['colDomAlmEdit']) ? limpiarDatos($_POST['colDomAlmEdit']) : "";
			$locDomAlmEdit = isset($_POST['locDomAlmEdit']) ? limpiarDatos($_POST['locDomAlmEdit']) : "";
			$munDomAlmEdit = isset($_POST['munDomAlmEdit']) ? limpiarDatos($_POST['munDomAlmEdit']) : "";
			$estDomAlmEdit = isset($_POST['estDomAlmEdit']) ? limpiarDatos($_POST['estDomAlmEdit']) : "";
			$codPostDomAlmEdit = isset($_POST['codPostDomAlmEdit']) ? limpiarDatos($_POST['codPostDomAlmEdit']) : "";
			$munOrgAlmEdit = isset($_POST['munOrgAlmEdit']) ? limpiarDatos($_POST['munOrgAlmEdit']) : "";
			$estOrgAlmEdit = isset($_POST['estOrgAlmEdit']) ? limpiarDatos($_POST['estOrgAlmEdit']) : "";
			$valid1 = $dbConexion -> prepare("SELECT * FROM datpersonales_alm WHERE curp_dat = :curpDatEdit && id_alumno != :keyAlm");
			$valid1 -> bindParam("curpDatEdit", $curpDatEdit, PDO::PARAM_STR);
			$valid1 -> bindParam("keyAlm", $keyAlm, PDO::PARAM_INT);
			$valid1 -> execute();
			$resvalid1 = $valid1 -> rowCount();
			if ($resvalid1 === 0) {
				if (!empty($numSegSocialEdit)) {
					$valid2 = $dbConexion -> prepare("SELECT * FROM datpersonales_alm WHERE num_segsocial_dat = :numSegSocialEdit && id_alumno != :keyAlm");
					$valid2 -> bindParam("numSegSocialEdit", $numSegSocialEdit, PDO::PARAM_STR);
					$valid2 -> bindParam("keyAlm", $keyAlm, PDO::PARAM_INT);
					$valid2 -> execute();
					$resvalid2 = $valid2 -> rowCount();
					if ($resvalid2 === 0) {
						if (!empty($estCivEdit)) {
							//existe dato civil actualiza numero seguro social y estado civil
							$stmt = $dbConexion -> prepare("UPDATE datpersonales_alm SET curp_dat = :curpDatEdit, fecha_nac_dat = :fechNacEdit, edad_dat = :eddAlmEdit , estado_civil_dat = :estCivEdit , tipo_segsocial_dat = :tipSegSocialEdit , num_segsocial_dat = :numSegSocialEdit , telefono_casa_dat = :telCasEdit , telefono_rec_dat = :telRecEdit , facebook_alm_dat = :faceAlmEdit , calle_dat_act = :callDomAlmEdit , num_casa_dat_act = :numDomAlmEdit , colonia_dat_act = :colDomAlmEdit , localidad_dat_act = :locDomAlmEdit , municipio_dat_act = :munDomAlmEdit , estado_dat_act = :estDomAlmEdit , codpostal_dat_act = :codPostDomAlmEdit , municipio_dat_org = :munOrgAlmEdit , estado_dat_org = :estOrgAlmEdit WHERE id_alumno = :keyAlm");
							$stmt -> bindParam(":curpDatEdit", $curpDatEdit, PDO::PARAM_STR);
							$stmt -> bindParam(":fechNacEdit", $fechNacEdit, PDO::PARAM_STR);
							$stmt -> bindParam(":eddAlmEdit", $eddAlmEdit, PDO::PARAM_INT);
							$stmt -> bindParam(":estCivEdit", $estCivEdit, PDO::PARAM_STR);
							$stmt -> bindParam(":tipSegSocialEdit", $tipSegSocialEdit, PDO::PARAM_STR);
							$stmt -> bindParam(":numSegSocialEdit", $numSegSocialEdit, PDO::PARAM_STR);
							$stmt -> bindParam(":telCasEdit", $telCasEdit, PDO::PARAM_STR);
							$stmt -> bindParam(":telRecEdit", $telRecEdit, PDO::PARAM_STR);
							$stmt -> bindParam(":faceAlmEdit", $faceAlmEdit, PDO::PARAM_STR);
							$stmt -> bindParam(":callDomAlmEdit", $callDomAlmEdit, PDO::PARAM_STR);
							$stmt -> bindParam(":numDomAlmEdit", $numDomAlmEdit, PDO::PARAM_STR);
							$stmt -> bindParam(":colDomAlmEdit", $colDomAlmEdit, PDO::PARAM_STR);
							$stmt -> bindParam(":locDomAlmEdit", $locDomAlmEdit, PDO::PARAM_STR);
							$stmt -> bindParam(":munDomAlmEdit", $munDomAlmEdit, PDO::PARAM_STR);
							$stmt -> bindParam(":estDomAlmEdit", $estDomAlmEdit, PDO::PARAM_STR);
							$stmt -> bindParam(":codPostDomAlmEdit", $codPostDomAlmEdit, PDO::PARAM_STR);
							$stmt -> bindParam(":munOrgAlmEdit", $munOrgAlmEdit, PDO::PARAM_STR);
							$stmt -> bindParam(":estOrgAlmEdit", $estOrgAlmEdit, PDO::PARAM_STR);
							$stmt -> bindParam(":keyAlm", $keyAlm, PDO::PARAM_INT);
							$resstmt = $stmt -> execute();
							if ($resstmt) {
								echo "goodUpd";
							} else {
								echo "failUpd";
							}
						} else {
							//no existe dato civil no actualiza estado civil solo numero seguro social
							$stmt = $dbConexion -> prepare("UPDATE datpersonales_alm SET curp_dat = :curpDatEdit, fecha_nac_dat = :fechNacEdit, edad_dat = :eddAlmEdit , tipo_segsocial_dat = :tipSegSocialEdit , num_segsocial_dat = :numSegSocialEdit , telefono_casa_dat = :telCasEdit , telefono_rec_dat = :telRecEdit , facebook_alm_dat = :faceAlmEdit , calle_dat_act = :callDomAlmEdit , num_casa_dat_act = :numDomAlmEdit , colonia_dat_act = :colDomAlmEdit , localidad_dat_act = :locDomAlmEdit , municipio_dat_act = :munDomAlmEdit , estado_dat_act = :estDomAlmEdit , codpostal_dat_act = :codPostDomAlmEdit , municipio_dat_org = :munOrgAlmEdit , estado_dat_org = :estOrgAlmEdit WHERE id_alumno = :keyAlm");
							$stmt -> bindParam(":curpDatEdit", $curpDatEdit, PDO::PARAM_STR);
							$stmt -> bindParam(":fechNacEdit", $fechNacEdit, PDO::PARAM_STR);
							$stmt -> bindParam(":eddAlmEdit", $eddAlmEdit, PDO::PARAM_INT);
							$stmt -> bindParam(":tipSegSocialEdit", $tipSegSocialEdit, PDO::PARAM_STR);
							$stmt -> bindParam(":numSegSocialEdit", $numSegSocialEdit, PDO::PARAM_STR);
							$stmt -> bindParam(":telCasEdit", $telCasEdit, PDO::PARAM_STR);
							$stmt -> bindParam(":telRecEdit", $telRecEdit, PDO::PARAM_STR);
							$stmt -> bindParam(":faceAlmEdit", $faceAlmEdit, PDO::PARAM_STR);
							$stmt -> bindParam(":callDomAlmEdit", $callDomAlmEdit, PDO::PARAM_STR);
							$stmt -> bindParam(":numDomAlmEdit", $numDomAlmEdit, PDO::PARAM_STR);
							$stmt -> bindParam(":colDomAlmEdit", $colDomAlmEdit, PDO::PARAM_STR);
							$stmt -> bindParam(":locDomAlmEdit", $locDomAlmEdit, PDO::PARAM_STR);
							$stmt -> bindParam(":munDomAlmEdit", $munDomAlmEdit, PDO::PARAM_STR);
							$stmt -> bindParam(":estDomAlmEdit", $estDomAlmEdit, PDO::PARAM_STR);
							$stmt -> bindParam(":codPostDomAlmEdit", $codPostDomAlmEdit, PDO::PARAM_STR);
							$stmt -> bindParam(":munOrgAlmEdit", $munOrgAlmEdit, PDO::PARAM_STR);
							$stmt -> bindParam(":estOrgAlmEdit", $estOrgAlmEdit, PDO::PARAM_STR);
							$stmt -> bindParam(":keyAlm", $keyAlm, PDO::PARAM_INT);
							$resstmt = $stmt -> execute();
							if ($resstmt) {
								echo "goodUpd";
							} else {
								echo "failUpd";
							}
						}
					} else {
						echo "ext";
					}
				} else {
					if (!empty($estCivEdit)) {
						//existe dato civil no actualiza numero seguro social solo estado civil
						$stmt = $dbConexion -> prepare("UPDATE datpersonales_alm SET curp_dat = :curpDatEdit, fecha_nac_dat = :fechNacEdit, edad_dat = :eddAlmEdit , estado_civil_dat = :estCivEdit , tipo_segsocial_dat = :tipSegSocialEdit , telefono_casa_dat = :telCasEdit , telefono_rec_dat = :telRecEdit , facebook_alm_dat = :faceAlmEdit , calle_dat_act = :callDomAlmEdit , num_casa_dat_act = :numDomAlmEdit , colonia_dat_act = :colDomAlmEdit , localidad_dat_act = :locDomAlmEdit , municipio_dat_act = :munDomAlmEdit , estado_dat_act = :estDomAlmEdit , codpostal_dat_act = :codPostDomAlmEdit , municipio_dat_org = :munOrgAlmEdit , estado_dat_org = :estOrgAlmEdit WHERE id_alumno = :keyAlm");
						$stmt -> bindParam(":curpDatEdit", $curpDatEdit, PDO::PARAM_STR);
						$stmt -> bindParam(":fechNacEdit", $fechNacEdit, PDO::PARAM_STR);
						$stmt -> bindParam(":eddAlmEdit", $eddAlmEdit, PDO::PARAM_INT);
						$stmt -> bindParam(":estCivEdit", $estCivEdit, PDO::PARAM_STR);
						$stmt -> bindParam(":tipSegSocialEdit", $tipSegSocialEdit, PDO::PARAM_STR);
						$stmt -> bindParam(":telCasEdit", $telCasEdit, PDO::PARAM_STR);
						$stmt -> bindParam(":telRecEdit", $telRecEdit, PDO::PARAM_STR);
						$stmt -> bindParam(":faceAlmEdit", $faceAlmEdit, PDO::PARAM_STR);
						$stmt -> bindParam(":callDomAlmEdit", $callDomAlmEdit, PDO::PARAM_STR);
						$stmt -> bindParam(":numDomAlmEdit", $numDomAlmEdit, PDO::PARAM_STR);
						$stmt -> bindParam(":colDomAlmEdit", $colDomAlmEdit, PDO::PARAM_STR);
						$stmt -> bindParam(":locDomAlmEdit", $locDomAlmEdit, PDO::PARAM_STR);
						$stmt -> bindParam(":munDomAlmEdit", $munDomAlmEdit, PDO::PARAM_STR);
						$stmt -> bindParam(":estDomAlmEdit", $estDomAlmEdit, PDO::PARAM_STR);
						$stmt -> bindParam(":codPostDomAlmEdit", $codPostDomAlmEdit, PDO::PARAM_STR);
						$stmt -> bindParam(":munOrgAlmEdit", $munOrgAlmEdit, PDO::PARAM_STR);
						$stmt -> bindParam(":estOrgAlmEdit", $estOrgAlmEdit, PDO::PARAM_STR);
						$stmt -> bindParam(":keyAlm", $keyAlm, PDO::PARAM_INT);
						$resstmt = $stmt -> execute();
						if ($resstmt) {
							echo "goodUpd";
						} else {
							echo "failUpd";
						}
					} else {
						$stmt = $dbConexion -> prepare("UPDATE datpersonales_alm SET curp_dat = :curpDatEdit, fecha_nac_dat = :fechNacEdit, edad_dat = :eddAlmEdit , tipo_segsocial_dat = :tipSegSocialEdit , telefono_casa_dat = :telCasEdit , telefono_rec_dat = :telRecEdit , facebook_alm_dat = :faceAlmEdit , calle_dat_act = :callDomAlmEdit , num_casa_dat_act = :numDomAlmEdit , colonia_dat_act = :colDomAlmEdit , localidad_dat_act = :locDomAlmEdit , municipio_dat_act = :munDomAlmEdit , estado_dat_act = :estDomAlmEdit , codpostal_dat_act = :codPostDomAlmEdit , municipio_dat_org = :munOrgAlmEdit , estado_dat_org = :estOrgAlmEdit WHERE id_alumno = :keyAlm");
						$stmt -> bindParam(":curpDatEdit", $curpDatEdit, PDO::PARAM_STR);
						$stmt -> bindParam(":fechNacEdit", $fechNacEdit, PDO::PARAM_STR);
						$stmt -> bindParam(":eddAlmEdit", $eddAlmEdit, PDO::PARAM_INT);
						$stmt -> bindParam(":tipSegSocialEdit", $tipSegSocialEdit, PDO::PARAM_STR);
						$stmt -> bindParam(":telCasEdit", $telCasEdit, PDO::PARAM_STR);
						$stmt -> bindParam(":telRecEdit", $telRecEdit, PDO::PARAM_STR);
						$stmt -> bindParam(":faceAlmEdit", $faceAlmEdit, PDO::PARAM_STR);
						$stmt -> bindParam(":callDomAlmEdit", $callDomAlmEdit, PDO::PARAM_STR);
						$stmt -> bindParam(":numDomAlmEdit", $numDomAlmEdit, PDO::PARAM_STR);
						$stmt -> bindParam(":colDomAlmEdit", $colDomAlmEdit, PDO::PARAM_STR);
						$stmt -> bindParam(":locDomAlmEdit", $locDomAlmEdit, PDO::PARAM_STR);
						$stmt -> bindParam(":munDomAlmEdit", $munDomAlmEdit, PDO::PARAM_STR);
						$stmt -> bindParam(":estDomAlmEdit", $estDomAlmEdit, PDO::PARAM_STR);
						$stmt -> bindParam(":codPostDomAlmEdit", $codPostDomAlmEdit, PDO::PARAM_STR);
						$stmt -> bindParam(":munOrgAlmEdit", $munOrgAlmEdit, PDO::PARAM_STR);
						$stmt -> bindParam(":estOrgAlmEdit", $estOrgAlmEdit, PDO::PARAM_STR);
						$stmt -> bindParam(":keyAlm", $keyAlm, PDO::PARAM_INT);
						$resstmt = $stmt -> execute();
						if ($resstmt) {
							echo "goodUpd";
						} else {
							echo "failUpd";
						}
					}
				}

			} else {
				echo "curpExt";
			}
			$valid = null; $resvalid = null; $valid1 = null; $resvalid1 = null; $valid2 = null; 
			$resvalid2 = null; $stmt = null; $resstmt = null; $dbConexion = null;
			break;
		case 'regTutPer':
			$cuatrinom = isset($_POST['cuatrinom']) ? limpiarDatos($_POST['cuatrinom']) : "";
			$razTut = isset($_POST['razTut']) ? limpiarDatos($_POST['razTut']) : "";
			$priodTut = isset($_POST['priodTut']) ? limpiarDatos($_POST['priodTut']) : "";
			$inval = 0;
			$stmt = $dbConexion -> prepare("INSERT INTO tut_personales (razones_tut, prioridad_tut, cuatrimestre_tut, fecha_reg_obs, id_alumno, estado_tut) VALUES (:razTut, :priodTut, :cuatrinom, :fechAct, :id_alumno, :inval)");
			$stmt -> bindParam(":razTut", $razTut, PDO::PARAM_STR);
			$stmt -> bindParam(":priodTut", $priodTut, PDO::PARAM_STR);
			$stmt -> bindParam(":cuatrinom", $cuatrinom, PDO::PARAM_STR);
			$stmt -> bindParam(":fechAct", $fechAct, PDO::PARAM_STR);
			$stmt -> bindParam(":id_alumno", $keyAlm, PDO::PARAM_INT);
			$stmt -> bindParam(":inval", $inval, PDO::PARAM_INT);
			$stmt -> execute();
			$resstmt = $stmt -> rowCount();
			if ($resstmt === 1) {
				echo "goodIns";
			} else {
				echo "failIns";
			}
			$stmt = null; $resstmt = null; $dbConexion = null;
			break;
		case 'cantNotifJust':
			$valid = 1;
			$stmt = $dbConexion -> prepare("SELECT doc.nombre_c_doc, just.fecha_acept_justif, just.fecha_justif FROM justificantes just 
					INNER JOIN alumnos alm ON alm.id_alumno = just.id_alumno 
					INNER JOIN det_grupo det ON det.id_detgrupo = alm.id_detgrupo 
					INNER JOIN docentes doc ON doc.id_docente = det.id_docente 
					INNER JOIN grupos grp ON grp.id_grupo = det.id_grupo
					WHERE just.estado_justif = :valid && alm.id_alumno = :keyAlm && just.cuatrimestre_justif = grp.cuatrimestre_g");
			$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
			$stmt -> bindParam("keyAlm", $keyAlm, PDO::PARAM_INT);
			$stmt -> execute();
			while ($data = $stmt -> fetch(PDO::FETCH_OBJ)) {
				$fechDat = substr($data->fecha_justif, 0,4);
				$fechM = substr($data->fecha_justif, 5,2);
				$fechD = substr($data->fecha_justif, 8,2);
				$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
				$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
				$Fecha = date($fechD)." de ".$meses[date($fechM)-1]. " del ".date($fechDat);
		   		//$Fecha = $dias[date('w')]." ".date($fechD)." de ".$meses[date($fechM)-1]. " del ".date($fechDat);
				if ($data->fecha_acept_justif != "0000-00-00") {
					$fechact = date($data->fecha_acept_justif);
					$fecha = date_create($fechact);
					date_add($fecha, date_interval_create_from_date_string('1 days'));
					$fechaLim =  date_format($fecha, 'Y-m-d');
					if ($fechAct < $fechaLim) {
						echo '<a class="dropdown-item d-flex align-items-center" href="#">
	                    <div class="mr-3">
	                      <div class="icon-circle bg-primary">
	                        <i class="fas fa-file-alt text-white"></i>
	                      </div>
	                    </div>
	                    <div>
	                      <span class="font-weight-bold">
	                      	El tutor '.$data->nombre_c_doc.' acepto tu justificante con fecha del = '.$Fecha.' 
	                      </span>
	                    </div>
	                  </a>';
					} else {
						echo null;
					}
				} else {
					echo null;
				}
			}
			$stmt = null; $dbConexion = null;
			break;
		case 'cantTutPer':
			$valid = 1;
			$stmt = $dbConexion -> prepare("SELECT * FROM tut_personales tut 
				INNER JOIN alumnos alm ON alm.id_alumno = tut.id_alumno
				INNER JOIN det_grupo det ON det.id_detgrupo = alm.id_detgrupo
				INNER JOIN grupos grp ON grp.id_grupo = det.id_grupo
				WHERE alm.id_alumno = :keyAlm && estado_tut = :valid && grp.cuatrimestre_g = tut.cuatrimestre_tut ORDER BY tut.fecha_cita_tut DESC");
			$stmt -> bindParam("keyAlm", $keyAlm, PDO::PARAM_INT);
			$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
			$stmt -> execute();
			$salida = "";
			while ($data = $stmt -> fetch(PDO::FETCH_OBJ)) {
				$fechDat = substr($data->fecha_cita_tut, 0,4);
				$fechM = substr($data->fecha_cita_tut, 5,2);
				$fechD = substr($data->fecha_cita_tut, 8,2);
				$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
				$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
				$Fecha = date($fechD)." de ".$meses[date($fechM)-1]. " del ".date($fechDat);
		   		//$Fecha = $dias[date('w')]." ".date($fechD)." de ".$meses[date($fechM)-1]. " del ".date($fechDat);
				if ($fechAct <= $data->fecha_cita_tut) {
					echo '<a class="dropdown-item d-flex align-items-center" href="#">
	                    <div class="mr-3">
	                      <div class="icon-circle bg-primary">
	                        <i class="fas fa-check-circle text-white"></i>
	                      </div>
	                    </div>
	                    <div>
	                      <span class="font-weight-bold">
	                      	'.$Fecha.' / '.$data->hora_cit_tut.' 
	                      </span>
	                      <div class="small text-gray-500">Solicitud de tutoría personal aceptada</div>
	                    </div>
	                  </a>';
				} else {
					echo null;
				}
			}
			break;
		case 'justCantTot':
			$stmt = $dbConexion -> prepare("SELECT COUNT(id_justificante) AS 'justCantTot' FROM justificantes where id_alumno = :keyAlm");
			$stmt -> bindParam("keyAlm", $keyAlm, PDO::PARAM_INT);
			$stmt -> execute();
			$salida = "";
			while ($res = $stmt -> fetch(PDO::FETCH_ASSOC)) {
				$salida .= $res["justCantTot"];
			}
			echo $salida;
			break;	
		case 'justCantCut':
			$stmt = $dbConexion -> prepare("SELECT COUNT(id_justificante) AS 'justCantCut' FROM justificantes where id_alumno = :keyAlm && cuatrimestre_justif = :cuatri");
			$stmt -> bindParam("keyAlm", $keyAlm, PDO::PARAM_INT);
			$stmt -> bindParam("cuatri", $datGrpAlm->cuatrimestre_g, PDO::PARAM_STR);
			$stmt -> execute();
			$salida = "";
			while ($res = $stmt -> fetch(PDO::FETCH_ASSOC)) {
				$salida .= $res["justCantCut"];
			}
			echo $salida;
			break;
		case 'justCantAcept':
			$valid = 1;
			$stmt = $dbConexion -> prepare("SELECT COUNT(id_justificante) AS 'justCantAcept' FROM justificantes where id_alumno = :keyAlm && estado_justif = :valid && cuatrimestre_justif = :cuatri");
			$stmt -> bindParam("keyAlm", $keyAlm, PDO::PARAM_INT);
			$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
			$stmt -> bindParam("cuatri", $datGrpAlm->cuatrimestre_g, PDO::PARAM_STR);
			$stmt -> execute();
			$salida = "";
			while ($res = $stmt -> fetch(PDO::FETCH_ASSOC)) {
				$salida .= $res["justCantAcept"];
			} 
			echo $salida;
			break;
		case 'justCantRech':
			$inval = 0;
			$stmt = $dbConexion -> prepare("SELECT COUNT(id_justificante) AS 'justCantRech' FROM justificantes where id_alumno = :keyAlm && estado_justif = :inval && cuatrimestre_justif = :cuatri");
			$stmt -> bindParam("keyAlm", $keyAlm, PDO::PARAM_INT);
			$stmt -> bindParam("inval", $inval, PDO::PARAM_INT);
			$stmt -> bindParam("cuatri", $datGrpAlm->cuatrimestre_g, PDO::PARAM_STR);
			$stmt -> execute();
			$salida = "";
			while ($res = $stmt -> fetch(PDO::FETCH_ASSOC)) {
				$salida .= $res["justCantRech"];
			} 
			echo $salida;
			break;							
		default:
			$dbConexion = null;
			break;
	}
}
