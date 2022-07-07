 <?php 

ob_start();
session_start();

if ($_SESSION['keyDevop'] == "" || $_SESSION['keyDevop'] == null) {
	header("Location:../../");
} else {
	require_once '../../modelos/devop.modelo.php';
	include '../../modelos/rutasAmig.php';
	$devop = new Developer();
	$keyDevop = $_SESSION['keyDevop'];
	$fechAct = date("Y-m-d");
	$dbConexion = new Connect();
	$dbConexion = $dbConexion -> getDB();
	switch ($_GET['oper']) {
		case 'listCor':
			$stmt = $dbConexion -> prepare("SELECT * FROM coordinadores ORDER BY nombre_c_cor");
			$stmt -> execute();
			$data = Array();
			while ($res = $stmt -> fetch(PDO::FETCH_OBJ)) {
				$data[] = array(
					"0" => '<a href="'.SERVERURLDEV.'ProfileUsr/'.base64_encode($res->id_coordinador).'/cor/">'.$res -> nombre_c_cor.'</a>',
					"1" => ($res->estado_cor)?'<span class="badge badge-primary mr-3 badge-pill">Habilitada</span>'.'<button class="btn btn-sm btn-outline-danger" onclick="desactCuent('.$res->id_coordinador.')"><i class="fas fa-times mr-2"></i>Deshabilitar</button>':
                    '<span class="badge badge-danger mr-3 badge-pill">Deshabilitada</span>'.'<button class="btn btn-sm btn-outline-primary" onclick="activaCuent('.$res->id_coordinador.')"><i class="fas fa-check mr-2"></i>Habilitar</button>',
					"2" => ($res->us_mod_rep)?'<span class="badge badge-primary mr-3 badge-pill">Habilitados</span>'.'<button class="btn btn-sm btn-outline-danger" onclick="desactRep('.$res->id_coordinador.')"><i class="fas fa-times mr-2"></i>Deshabilitar</button>':
                    '<span class="badge badge-danger mr-3 badge-pill">Deshabilitados</span>'.'<button class="btn btn-sm btn-outline-primary" onclick="activaRep('.$res->id_coordinador.')"><i class="fas fa-check mr-2"></i>Habilitar</button>',

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
		case 'listAdm':
			$stmt = $dbConexion -> prepare("SELECT * FROM administradores ORDER BY nombre_c");
			$stmt -> execute();
			$data = Array();
			while ($res = $stmt -> fetch(PDO::FETCH_OBJ)) {
				$data[] = array(
					"0" => '<a href="'.SERVERURLDEV.'ProfileUsr/'.base64_encode($res->id_admin).'/adm/">'.$res -> nombre_c.'</a>',
					"1" => $res -> privileg,
					"2" => ($res->condicion)?'<span class="badge badge-primary mr-3 badge-pill">Habilitada</span>'.'<button class="btn btn-sm btn-outline-danger" onclick="desactCuent('.$res->id_admin.')"><i class="fas fa-times mr-2"></i>Deshabilitar</button>':
                    '<span class="badge badge-danger mr-3 badge-pill">Deshabilitada</span>'.'<button class="btn btn-sm btn-outline-primary" onclick="activaCuent('.$res->id_admin.')"><i class="fas fa-check mr-2"></i>Habilitar</button>',
					"3" => ($res->us_mod_rep)?'<span class="badge badge-primary mr-3 badge-pill">Habilitados</span>'.'<button class="btn btn-sm btn-outline-danger" onclick="desactRep('.$res->id_admin.')"><i class="fas fa-times mr-2"></i>Deshabilitar</button>':
                    '<span class="badge badge-danger mr-3 badge-pill">Deshabilitados</span>'.'<button class="btn btn-sm btn-outline-primary" onclick="activaRep('.$res->id_admin.')"><i class="fas fa-check mr-2"></i>Habilitar</button>',

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
		case 'listDir':
			$stmt = $dbConexion -> prepare("SELECT * FROM directores dir INNER JOIN carreras car ON car.id_carrera = dir.id_carrera ORDER BY dir.nombre_c_dir");
			$stmt -> execute();
			$data = Array();
			while ($res = $stmt -> fetch(PDO::FETCH_OBJ)) {
				$data[] = array(
					"0" => '<a href="'.SERVERURLDEV.'ProfileUsr/'.base64_encode($res->id_director).'/dir/">'.$res -> nombre_c_dir.'</a>',
					"1" => $res -> nombre_car,
					"2" => ($res->estado_dir)?'<span class="badge badge-primary mr-3 badge-pill">Habilitada</span>'.'<button class="btn btn-sm btn-outline-danger" onclick="desactCuent('.$res->id_director.')"><i class="fas fa-times mr-2"></i>Deshabilitar</button>':
                    '<span class="badge badge-danger mr-3 badge-pill">Deshabilitada</span>'.'<button class="btn btn-sm btn-outline-primary" onclick="activaCuent('.$res->id_director.')"><i class="fas fa-check mr-2"></i>Habilitar</button>',
					"3" => ($res->us_mod_rep)?'<span class="badge badge-primary mr-3 badge-pill">Habilitados</span>'.'<button class="btn btn-sm btn-outline-danger" onclick="desactRep('.$res->id_director.')"><i class="fas fa-times mr-2"></i>Deshabilitar</button>':
                    '<span class="badge badge-danger mr-3 badge-pill">Deshabilitados</span>'.'<button class="btn btn-sm btn-outline-primary" onclick="activaRep('.$res->id_director.')"><i class="fas fa-check mr-2"></i>Habilitar</button>',

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
        case 'listDoc':
			$stmt = $dbConexion -> prepare("SELECT * FROM docentes ORDER BY nombre_c_doc");
			$stmt -> execute();
			$data = Array();
			while ($res = $stmt -> fetch(PDO::FETCH_OBJ)) {
				$data[] = array(
					"0" => '<a href="'.SERVERURLDEV.'ProfileUsr/'.base64_encode($res->id_docente).'/doc/">'.$res -> nombre_c_doc.'</a>',
					"1" => $res -> especialidad_doc,
					"2" => ($res->condicion_doc)?'<span class="badge badge-primary mr-3 badge-pill">Habilitada</span>'.'<button class="btn btn-sm btn-outline-danger" onclick="desactCuent('.$res->id_docente.')"><i class="fas fa-times mr-2"></i>Deshabilitar</button>':
                    '<span class="badge badge-danger mr-3 badge-pill">Deshabilitada</span>'.'<button class="btn btn-sm btn-outline-primary" onclick="activaCuent('.$res->id_docente.')"><i class="fas fa-check mr-2"></i>Habilitar</button>',
					"3" => ($res->us_mod_rep)?'<span class="badge badge-primary mr-3 badge-pill">Habilitados</span>'.'<button class="btn btn-sm btn-outline-danger" onclick="desactRep('.$res->id_docente.')"><i class="fas fa-times mr-2"></i>Deshabilitar</button>':
                    '<span class="badge badge-danger mr-3 badge-pill">Deshabilitados</span>'.'<button class="btn btn-sm btn-outline-primary" onclick="activaRep('.$res->id_docente.')"><i class="fas fa-check mr-2"></i>Habilitar</button>',

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

        case 'listStd':
        	$stmt = $dbConexion -> prepare("SELECT * FROM alumnos al INNER JOIN det_grupo dt ON dt.id_detgrupo = al.id_detgrupo INNER JOIN grupos gr ON gr.id_grupo = dt.id_grupo INNER JOIN carreras car ON car.id_carrera = dt.id_carrera ORDER BY car.nombre_car");
			$stmt -> execute();
			$data = Array();
			while ($res = $stmt -> fetch(PDO::FETCH_OBJ)) {
				$data[] = array(
					"0" => '<a target="_blank" href="'.SERVERURLDEV.'ProfileStd/'.base64_encode($res->id_alumno).'/">'.$res -> nombre_c_al.'</a>',
					"1" => $res -> nombre_car,
					"2" => $res -> matricula_al,
					"3" => $res -> sexo_al

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
        	
	default:
		$dbConexion = null;
		break;
	}
}

ob_end_flush();

?>