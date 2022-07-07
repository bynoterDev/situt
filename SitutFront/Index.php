<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset=utf-8>
    <meta name=description content="">
    <meta name=viewport content="width=device-width, initial-scale=1">
    <!-- Icono -->
    <link rel="shortcut icon" href="vistas/img/SITUT (1).jpg">
    <!-- Estilos Bootstrap -->
    <link rel="stylesheet" type="text/css" href="vistas/css/bootstrap.min.css">
    <!-- Estilos Animate -->
    <link rel="stylesheet" type="text/css" href="vistas/css/animate.css">
    <!-- Estilos Personalizados -->
    <link rel="stylesheet" type="text/css" href="vistas/css/estilos.css">
    <!-- Fuente de letra Google -->
    <link href="https://fonts.googleapis.com/css?family=Arimo" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:700" rel="stylesheet">
    <!-- Iconos FontAwesome -->
    <link rel="stylesheet" type="text/css" href="vistas/css/fontawesome-all.css">

    <title>S I T U T</title>
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

    <!-- Optional JavaScript -->
    <!-- jQuery -->
    <script src="vistas/js/jquery-3.1.1.min.js"></script>
    <!-- SweetAlert -->
    <script src="vistas/node_modules/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Bootstrap -->
    <script src="vistas/Assets/js/vendor/popper.min.js"></script>
    <script src="vistas/Js/bootstrap.min.js"></script>
    <script src="vistas/assets/js/vendor/holder.min.js"></script>
    <script src="vistas/js/mainlog.js"></script>
  </body>
</html>