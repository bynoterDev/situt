<?php 
session_start();
unset($_SESSION['keyDoc']);
unset($_SESSION['clvGrp']);
unset($_SESSION["clvAlm"]);
header("Location:../../../Index.php");