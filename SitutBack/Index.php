<?php include 'modelos/rutasAmig.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Tutorías</title>
    <meta charset=utf-8>
    <meta name=description content="">
    <meta name=viewport content="width=device-width, initial-scale=1">
    <!-- Estilos Bootstrap -->
    <link rel="stylesheet" type="text/css" href="<?php echo SERVERURL; ?>vistas/css/bootstrap.min.css">
    <!-- Estilos Animate -->
    <link rel="stylesheet" type="text/css" href="<?php echo SERVERURL; ?>vistas/css/animate.css">
    <!-- Estilos Personalizados -->
    <link rel="stylesheet" type="text/css" href="<?php echo SERVERURL; ?>vistas/css/estilos.css">
    <!-- Fuente de letra Google -->
    <link href="https://fonts.googleapis.com/css?family=Bitter|PT+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:700" rel="stylesheet">
    <!-- Iconos FontAwesome -->
    <link rel="stylesheet" type="text/css" href="<?php echo SERVERURL; ?>vistas/css/fontawesome-all.css">
</head>
<body data-spy="scroll" data-target="#sidebar" data-offset="80">

    <?php 
      if (isset($_GET['view'])) {
        $views = explode("/", $_GET['view']);
        if (is_file('vistas/'.$views[0].'.php')) {
          include 'vistas/'.$views[0].'.php';
        } else {
          include 'vistas/Index.php';
        }
      } else {
        include 'vistas/Index.php';
      }
    ?>
    
    <!-- jQuery -->
    <script src="<?php echo SERVERURL; ?>vistas/js/jquery-3.1.1.min.js"></script>
    <!-- SweetAlert -->
    <script src="<?php echo SERVERURL; ?>vistas/node_modules/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo SERVERURL; ?>vistas/Assets/js/vendor/popper.min.js"></script>
    <script src="<?php echo SERVERURL; ?>vistas/Js/bootstrap.min.js"></script>
    <script src="<?php echo SERVERURL; ?>vistas/assets/js/vendor/holder.min.js"></script>
    <!--- Personalizados -->
    <script src="<?php echo SERVERURL; ?>vistas/js/mainlog.js"></script>
    <script src="<?php echo SERVERURL; ?>vistas/js/limCamp.js"></script>
    <script src="<?php echo SERVERURL; ?>vistas/js/devop.js"></script>
</body>
</html>