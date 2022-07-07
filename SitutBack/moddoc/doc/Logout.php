<?php 
session_start();
require '../../modelos/rutasAmig.php';
unset($_SESSION['keyDoc']);
unset($_SESSION['clvGrp']);
unset($_SESSION["clvAlm"]);
unset($_SESSION["id_carrera"]);
session_destroy();
header("Location:".SERVERURL);