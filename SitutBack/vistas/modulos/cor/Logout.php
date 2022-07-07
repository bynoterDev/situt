<?php 
session_start();
unset($_SESSION['keyCor']);
header("Location:../../../Index.php");