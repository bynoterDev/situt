<?php 

session_start();

if ($_SESSION['keyCor'] == "" || $_SESSION['keyCor'] == null) {
	header("Location:../");
} else {
	include '../../modelos/coordinador.modelo.php';
	$cordinador = new Coordinador();
	$dbc = new Connect();
	$dbc = $dbc -> getDB();
	$valCar = $_GET['v'];
	$valCarDec = base64_decode($valCar);
	$datCarSel = $cordinador -> datCarSel($valCarDec);
	$keyCor = $_SESSION['keyCor'];
	$datCor = $cordinador->userCorDet($keyCor);
	include 'PlantillaReports.php';

	switch (base64_decode($_GET['vr'])) {
		case 'MasculinoALL':
			$valor = "Masculino";
			$valid =1;

			//Cantidad de registros//
			$cantDat = $dbc -> prepare("SELECT COUNT(alm.id_alumno) AS 'Cantidad' FROM alumnos alm INNER JOIN carreras car ON car.id_carrera = alm.id_carrera WHERE alm.estado_al = :valid && alm.sexo_al = :valor");
			$cantDat -> bindParam("valid", $valid, PDO::PARAM_INT);
			$cantDat -> bindParam("valor", $valor, PDO::PARAM_STR);
			$cantDat -> execute();
			$datCant = $cantDat -> fetch(PDO::FETCH_OBJ);

			//Datos para la tabla//
			$stmt = $dbc -> prepare("SELECT alm.nombre_c_al, alm.correo_al, alm.telefono_al FROM alumnos alm INNER JOIN carreras car ON car.id_carrera = alm.id_carrera WHERE alm.estado_al = :valid && alm.sexo_al = :valor");
			$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
			$stmt -> bindParam("valor", $valor, PDO::PARAM_STR);
			$stmt -> execute();

			//Iniciamos el PDF//
			$pdf = new PDF();
            $pdf->AliasNbPages();
            $pdf->AddPage();
            $pdf->Ln(10);
            $pdf -> Cell(100, 10, utf8_decode('Alumnos Masculinos General'), 0, 0, 'C');

            //Validacion total registros//
            if ($datCant->Cantidad > 1 || $datCant->Cantidad == 0) {
                $pdf -> Cell(100, 10, utf8_decode('Total: '.$datCant->Cantidad.' registros.'), 0, 0, 'C');   
            } else {
                $pdf -> Cell(100, 10, utf8_decode('Total: '.$datCant->Cantidad.' registro.'), 0, 0, 'C');
            }

            //Continua el pdf//
            $pdf->Ln(12);
            $pdf->SetFillColor(232,232,232);
            $pdf->SetFont('Arial','B',12);
            $pdf->SetX(7);
            $pdf->Cell(65,6,'Nombre',1,0,'C',1);
            $pdf->Cell(65,6,'Correo',1,0,'C',1);
            $pdf->Cell(65,6,'Telefono',1,1,'C',1);
            $pdf->SetFont('Arial','',9);

			//LLenamos la tabla con los datos//
            while ($row = $stmt -> fetch(PDO::FETCH_OBJ)) {
                $pdf->SetX(7);
                $pdf->Cell(65,6,utf8_decode($row->nombre_c_al),1,0,'C');
                $pdf->Cell(65,6,utf8_decode($row->correo_al),1,0,'C');
                $pdf->Cell(65,6,utf8_decode($row->telefono_al),1,1,'C');
            }            

            //Nombre de salida del PDF//
            $pdf -> Output('I','AlumnosMasculinosGeneral.pdf');
            $stmt = null; $cantDat = null; $dbc = null;
			break;
		case 'FemeninoALL':
			$valor = "Femenino";
			$valid = 1;

			//Cantidad de registros//
			$cantDat = $dbc -> prepare("SELECT COUNT(alm.id_alumno) AS 'Cantidad' FROM alumnos alm INNER JOIN carreras car ON car.id_carrera = alm.id_carrera WHERE alm.estado_al = :valid && alm.sexo_al = :valor");
			$cantDat -> bindParam("valid", $valid, PDO::PARAM_INT);
			$cantDat -> bindParam("valor", $valor, PDO::PARAM_STR);
			$cantDat -> execute();
			$datCant = $cantDat -> fetch(PDO::FETCH_OBJ);

			//Datos para la tabla//
			$stmt = $dbc -> prepare("SELECT alm.nombre_c_al, alm.correo_al, alm.telefono_al FROM alumnos alm INNER JOIN carreras car ON car.id_carrera = alm.id_carrera WHERE alm.estado_al = :valid && alm.sexo_al = :valor");
			$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
			$stmt -> bindParam("valor", $valor, PDO::PARAM_STR);
			$stmt -> execute();

			//Iniciamos el PDF//
			$pdf = new PDF();
            $pdf->AliasNbPages();
            $pdf->AddPage();
            $pdf->Ln(10);
            $pdf -> Cell(100, 10, utf8_decode('Alumnos Masculinos General'), 0, 0, 'C');

            //Validacion total registros//
            if ($datCant->Cantidad > 1 || $datCant->Cantidad == 0) {
                $pdf -> Cell(100, 10, utf8_decode('Total: '.$datCant->Cantidad.' registros.'), 0, 0, 'C');   
            } else {
                $pdf -> Cell(100, 10, utf8_decode('Total: '.$datCant->Cantidad.' registro.'), 0, 0, 'C');
            }

            //Continua el pdf//
            $pdf->Ln(12);
            $pdf->SetFillColor(232,232,232);
            $pdf->SetFont('Arial','B',12);
            $pdf->SetX(7);
            $pdf->Cell(65,6,'Nombre',1,0,'C',1);
            $pdf->Cell(65,6,'Correo',1,0,'C',1);
            $pdf->Cell(65,6,'Telefono',1,1,'C',1);
            $pdf->SetFont('Arial','',9);

			//LLenamos la tabla con los datos//
            while ($row = $stmt -> fetch(PDO::FETCH_OBJ)) {
                $pdf->SetX(7);
                $pdf->Cell(65,6,utf8_decode($row->nombre_c_al),1,0,'C');
                $pdf->Cell(65,6,utf8_decode($row->correo_al),1,0,'C');
                $pdf->Cell(65,6,utf8_decode($row->telefono_al),1,1,'C');
            }            

            //Nombre de salida del PDF//
            $pdf -> Output('I','AlumnosFemeninosGeneral.pdf');
            $stmt = null; $cantDat = null; $dbc = null;
			break;		
		case 'Masculino':
			$valor = "Masculino";
			$valid = 1;

			//Cantidad de registros//
			$cantDat = $dbc -> prepare("SELECT COUNT(alm.id_alumno) AS 'Cantidad'
				FROM alumnos alm INNER JOIN carreras car ON car.id_carrera = alm.id_carrera
				WHERE car.id_carrera = :valCarDec && alm.estado_al = :valid && alm.sexo_al = :valor");
			$cantDat -> bindParam("valCarDec", $valCarDec, PDO::PARAM_INT);
			$cantDat -> bindParam("valid", $valid, PDO::PARAM_INT);
			$cantDat -> bindParam("valor", $valor, PDO::PARAM_STR);
			$cantDat -> execute();
			$datCant = $cantDat -> fetch(PDO::FETCH_OBJ);

			//Datos para la tabla//
			$stmt = $dbc -> prepare("SELECT alm.nombre_c_al, alm.correo_al, alm.telefono_al
				FROM alumnos alm INNER JOIN carreras car ON car.id_carrera = alm.id_carrera
				WHERE car.id_carrera = :valCarDec && alm.estado_al = :valid && alm.sexo_al = :valor");
			$stmt -> bindParam("valCarDec", $valCarDec, PDO::PARAM_INT);
			$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
			$stmt -> bindParam("valor", $valor, PDO::PARAM_STR);
			$stmt -> execute();

			//Iniciamos nuestro PDF//
            $pdf = new PDF();
            $pdf->AliasNbPages();
            $pdf->AddPage();
            $pdf->Ln(10);
            $pdf -> Cell(100, 10, utf8_decode('Alumnos Masculinos'), 0, 0, 'C');
          
            //Validacion total registros//
            if ($datCant->Cantidad > 1 || $datCant->Cantidad == 0) {
                $pdf -> Cell(100, 10, utf8_decode('Total: '.$datCant->Cantidad.' registros.'), 0, 0, 'C');   
            } else {
                $pdf -> Cell(100, 10, utf8_decode('Total: '.$datCant->Cantidad.' registro.'), 0, 0, 'C');
            }

            //Continua el pdf//
            $pdf->Ln(12);
            $pdf->SetFillColor(232,232,232);
            $pdf->SetFont('Arial','B',12);
            $pdf->SetX(7);
            $pdf->Cell(65,6,'Nombre',1,0,'C',1);
            $pdf->Cell(65,6,'Correo',1,0,'C',1);
            $pdf->Cell(65,6,'Telefono',1,1,'C',1);
            $pdf->SetFont('Arial','',9);

            //LLenamos la tabla con los datos//
            while ($row = $stmt -> fetch(PDO::FETCH_OBJ)) {
                $pdf->SetX(7);
                $pdf->Cell(65,6,utf8_decode($row->nombre_c_al),1,0,'C');
                $pdf->Cell(65,6,utf8_decode($row->correo_al),1,0,'C');
                $pdf->Cell(65,6,utf8_decode($row->telefono_al),1,1,'C');
            }

            //Nombre de salida del PDF//
            $pdf -> Output('I','AlumnosMasculinos'.$datCarSel->nombre_car.'.pdf');
			break;
		case 'Femenino':
			$valor = "Femenino";
			$valid = 1;

			//Cantidad de registros//
			$cantDat = $dbc -> prepare("SELECT COUNT(alm.id_alumno) AS 'Cantidad'
				FROM alumnos alm INNER JOIN carreras car ON car.id_carrera = alm.id_carrera
				WHERE car.id_carrera = :valCarDec && alm.estado_al = :valid && alm.sexo_al = :valor");
			$cantDat -> bindParam("valCarDec", $valCarDec, PDO::PARAM_INT);
			$cantDat -> bindParam("valid", $valid, PDO::PARAM_INT);
			$cantDat -> bindParam("valor", $valor, PDO::PARAM_STR);
			$cantDat -> execute();
			$datCant = $cantDat -> fetch(PDO::FETCH_OBJ);

			//Datos para la tabla//
			$stmt = $dbc -> prepare("SELECT alm.nombre_c_al, alm.correo_al, alm.telefono_al
				FROM alumnos alm INNER JOIN carreras car ON car.id_carrera = alm.id_carrera
				WHERE car.id_carrera = :valCarDec && alm.estado_al = :valid && alm.sexo_al = :valor");
			$stmt -> bindParam("valCarDec", $valCarDec, PDO::PARAM_INT);
			$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
			$stmt -> bindParam("valor", $valor, PDO::PARAM_STR);
			$stmt -> execute();

			//Iniciamos nuestro PDF//
            $pdf = new PDF();
            $pdf->AliasNbPages();
            $pdf->AddPage();
            $pdf->Ln(10);
            $pdf -> Cell(100, 10, utf8_decode('Alumnas Femeninas'), 0, 0, 'C');
          
            //Validacion total registros//
            if ($datCant->Cantidad > 1 || $datCant->Cantidad == 0) {
                $pdf -> Cell(100, 10, utf8_decode('Total: '.$datCant->Cantidad.' registros.'), 0, 0, 'C');   
            } else {
                $pdf -> Cell(100, 10, utf8_decode('Total: '.$datCant->Cantidad.' registro.'), 0, 0, 'C');
            }

            //Continua el pdf//
            $pdf->Ln(12);
            $pdf->SetFillColor(232,232,232);
            $pdf->SetFont('Arial','B',12);
            $pdf->SetX(7);
            $pdf->Cell(65,6,'Nombre',1,0,'C',1);
            $pdf->Cell(65,6,'Correo',1,0,'C',1);
            $pdf->Cell(65,6,'Telefono',1,1,'C',1);
            $pdf->SetFont('Arial','',9);

            //LLenamos la tabla con los datos//
            while ($row = $stmt -> fetch(PDO::FETCH_OBJ)) {
                $pdf->SetX(7);
                $pdf->Cell(65,6,utf8_decode($row->nombre_c_al),1,0,'C');
                $pdf->Cell(65,6,utf8_decode($row->correo_al),1,0,'C');
                $pdf->Cell(65,6,utf8_decode($row->telefono_al),1,1,'C');
            }

            //Nombre de salida del PDF//
            $pdf -> Output('I','AlumnasFemeninos'.$datCarSel->nombre_car.'.pdf');
			break;
		default:
			# code...
			break;
	}
}

?>