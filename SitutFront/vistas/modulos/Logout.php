<?php 
session_start();
unset($_SESSION['keyAlm']);
header("Location:../../Index.php");
