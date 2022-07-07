<?php 
session_start();
unset($_SESSION['keyAlm']);
unset($_SESSION['nombre_car']);
session_destroy();
header("Location:../../");
