<?php
/****************************************************************
Archivo: abcContacto.php
Objetivo: Alta, Baja y Cambio de contactos 
*****************************************************************/

include_once("modelo/Contacto.php");
session_start();

$sErr = "";
$sOpe = "";
$sCve = "";
$sNomBoton = "Borrar";
$bCampoEditable = false;
$bLlaveEditable = false;
$oContacto = new Contacto();

// Verificar sesión
if (isset($_SESSION["usuario"])) {
	// Verificar datos de entrada
	if (isset($_POST["txtClave"]) && isset($_POST["txtOpe"])) {
		$sOpe = $_POST["txtOpe"];
		$sCve = $_POST["txtClave"];

		// Operación de alta, no hay nada que buscar
		if ($sOpe == "a") {
			$bCampoEditable = true;
			$bLlaveEditable = true;
			$sNomBoton = "Agregar";
		}
		// Modificación o eliminación
		else {
			if ($oContacto->buscarPorId($sCve)) {
				if ($sOpe == "m") {
					$bCampoEditable = true; 
					$sNomBoton = "Modificar";
				}
				// Si es borrar, no se edita nada
			} else {
				$sErr = "Contacto no encontrado";
			}
		}

		// EJECUCIÓN de la acción si se envió formulario
		$bExito = false;

	if ($sOpe == "a") {
	
		if (isset($_POST["txtNombre"])) {
			$oContacto->setId($_POST["txtClave"]);
			$oContacto->setNombre($_POST["txtNombre"]);
			$oContacto->setDireccion($_POST["txtDireccion"]);
			$oContacto->setTelefono($_POST["txtTelefono"]);
			$oContacto->setEmail($_POST["txtEmail"]);
			$bExito = $oContacto->guardar();
			
		}
} elseif ($sOpe == "b") {
	$bExito = $oContacto->eliminar($sCve);

}elseif ($sOpe == "m") {
	 if (isset($_POST["txtNombre"])) {
			$oContacto->setId($_POST["txtClave"]);
			$oContacto->setNombre($_POST["txtNombre"]);
			$oContacto->setDireccion($_POST["txtDireccion"]);
			$oContacto->setTelefono($_POST["txtTelefono"]);
			$oContacto->setEmail($_POST["txtEmail"]);
			$bExito = $oContacto->guardar();
			
		}
}

if ($bExito) {
	header("Location: tabcontactos.php");
	exit();
} else {

}

} else {
		$sErr = "Faltan datos para la operación";
	}
} else {
	$sErr = "Debe iniciar sesión";
}

// Mostrar encabezado o redirigir a error
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
	<h3>
		<?php
		echo $sOpe == 'a' ? "Agregar nuevo contacto" :
		     ($sOpe == 'm' ? "Modificar contacto" : "Eliminar contacto");
		?>
	</h3>
  
	<form name="abcContacto" action="abcContacto.php" method="post">
		<input type="hidden" name="txtOpe" value="<?php echo $sOpe; ?>">
		<input type="hidden" name="txtClave" value="<?php echo $sCve; ?>">
    
		Nombre:
    <br>
		<input type="text" name="txtNombre"
			<?php echo ($bCampoEditable ? "" : "disabled"); ?>
			value="<?php echo $oContacto->getNombre(); ?>" required>
		

		Dirección:<br>
		<input type="text" name="txtDireccion"
			<?php echo ($bCampoEditable ? "" : "disabled"); ?>
			value="<?php echo $oContacto->getDireccion(); ?>" required>
		<br>

		Teléfono:<br>
		<input type="text" name="txtTelefono"
			<?php echo ($bCampoEditable ? "" : "disabled"); ?>
			value="<?php echo $oContacto->getTelefono(); ?>" required>
		<br>

		Email:<br>
		<input type="email" name="txtEmail"
			<?php echo ($bCampoEditable ? "" : "disabled"); ?>
			value="<?php echo $oContacto->getEmail(); ?>" required>
		<br><br>

		<input type="submit" value="<?php echo $sNomBoton; ?>">
		<button type="button" onclick="location.href='tabcontactos.php';">Cancelar</button>


	</form>
</section>

<?php include_once("pie.html"); ?>