<?php 
session_start();
unset($_SESSION['keyAdm']);
session_destroy();
header("Location:../../");
