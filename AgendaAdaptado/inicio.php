<?php
/*************************************************************/
/* Archivo:  inicio.php
 * Objetivo: p�gina de sesi�n iniciada
 * Autor:  
 *************************************************************/
include_once("modelo\Usuario.php");
session_start();
$sErr = "";
$sNom = "";
$sRol = "";

if (isset($_SESSION["usuario"])) {
	$sNom = $_SESSION["usuario"];
	$sRol = $_SESSION["rol"];
} else {
	$sErr = "Debe iniciar sesión primero";
}

if ($sErr == "") {
	include_once("cabecera.html");
	include_once("menu.php");
	include_once("aside.html");
} else {
	header("Location: error.php?sError=" . urlencode($sErr));
	exit();
}
?>
<section>
	<h1>Bienvenido, <?php echo htmlspecialchars($sNom); ?></h1>
	<h3>Tu rol es: 
		<?php 
			echo ($sRol == "1") ? "Administrador" : 
			     (($sRol == "2") ? "Visualizador" : "Desconocido");
		?>
	</h3>
</section>
<?php
include_once("pie.html");
?>