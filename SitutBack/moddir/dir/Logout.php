<?php 
session_start();
unset($_SESSION['keyDir']);
unset($_SESSION["id_carrera"]);
session_destroy();
header("Location:../../");