<?php 


include 'conexion.php';
include 'conect.php';

class Login 
{
	
	function __construct()
	{
		
	}
	public function validaLog($correoAdm, $passAdm) {
		$sql="SELECT * FROM administradores WHERE correo='$correoAdm' OR usuario='$correoAdm' AND contrasena='$passAdm' && condicion = 1"; 
    	return ejecutarConsulta($sql); 
	}	
	public function validaLogCor($correoCor, $passCor) {
		$sql="SELECT * FROM coordinadores WHERE correo_cor='$correoCor' && contrasena_cor='$passCor' && estado_cor = 1"; 
    	return ejecutarConsulta($sql); 
	}	
	public function validaLogDir($correoDir, $passDir) {
		$sql = "SELECT * FROM directores WHERE correo_dir='$correoDir' && contrasena_dir='$passDir' && estado_dir = 1";
		return ejecutarConsulta($sql);
	}
	public function validaLogDoc($correoDoc, $passDoc) {
		$sql = "SELECT * FROM docentes WHERE correo_doc = '$correoDoc' && contrasena_doc = '$passDoc' && condicion_doc = 1";
		return ejecutarConsulta($sql);
	}
}


?>