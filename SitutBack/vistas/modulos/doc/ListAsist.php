<?php 

ob_start();
session_start();

if ($_SESSION['keyDoc'] == "" || $_SESSION['keyDoc'] == null) {
	header("Location:../Index.php");
} else {
	include '../modelos/docente.modelo.php';
	$docente = new Docentes();
	$keyDoc = $_SESSION['keyDoc'];
	$valObt = $_GET['v'];
	$datDoce = $docente->userDocDet($keyDoc);
	if ($datDoce) {
		$valObtDec = base64_decode($valObt);
		$_SESSION["clvGrp"] = $valObtDec;
		$datGrup = $docente -> datGrpSel($keyDoc, $valObtDec);
?>
	
	<?php include 'header.php'; ?>
	<style type="text/css">
		.ocult { display: none; }
	</style>
	<br><br>
	<h1 class="text-center">Lista de Asistencia</h1>

	<br><br><br>
	<?php include 'modalsconf.php'; ?>

	<script src="../vistas/js/jquery-3.1.1.min.js"></script>
	<!-- SweetAlert -->
    <script src="../vistas/node_modules/sweetalert/dist/sweetalert.min.js"></script>
    <script src="../vistas/datatables/jquery.dataTables.min.js"></script>    
    <script src="../vistas/datatables/dataTables.buttons.min.js"></script>
    <script src="../vistas/datatables/buttons.html5.min.js"></script>
    <script src="../vistas/datatables/buttons.colVis.min.js"></script>
    <script src="../vistas/datatables/jszip.min.js"></script>
    <script src="../vistas/datatables/pdfmake.min.js"></script>
    <script src="../vistas/datatables/vfs_fonts.js"></script> 
    <!-- Bootstrap -->
    <script src="../vistas/Assets/js/vendor/popper.min.js"></script>
    <script src="../vistas/Js/bootstrap.min.js"></script>
    <script src="../vistas/assets/js/vendor/holder.min.js"></script>
    <!--- Personalizados -->
    <script src="../vistas/modulos/doc/js/confDatDoc.js"></script>
	<?php include 'footer.php'; ?>

<?php		
	} else {
		header("Location:Logout.php");
	}
}

ob_end_flush();
?>