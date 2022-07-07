<?php 

require_once '../../modelos/alumno.modelo.php';
$sel = $_POST['sel'];

$dbc = new Connect();
$dbc = $dbc -> getDB();

$consulta = $dbc -> prepare("SELECT * FROM grupos WHERE id_grupo = :sel");
$consulta -> bindParam("sel", $sel, PDO::PARAM_INT);
$consulta -> execute();
$data = Array();
while ($res = $consulta -> fetch(PDO::FETCH_OBJ)) {
	$data[] = array(
		"0" => $res->grupo_n,
		"1" => 'Eliminar'

	);
}
$results = array(
"sEcho"=>1,
"iTotalRecords"=>count($data),
"iTotalDisplayRecords"=>count($data),
"aaData"=>$data);
echo json_encode($results);