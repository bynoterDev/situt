<?php 
session_start();
unset($_SESSION['keyCor']);
session_destroy();
header("Location:../../");