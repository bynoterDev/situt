<?php 
session_start();
unset($_SESSION['keyDir']);
header("Location:../../../Index.php");