<?php 
session_start();
unset($_SESSION['keyDevop']);
unset($_SESSION['tokSeg']);
session_destroy();
header("Location:../../");