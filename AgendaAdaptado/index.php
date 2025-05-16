<?php
/*************************************************************/
/* Archivo:  index.php
 * Objetivo: página inicial de manejo de catálogo,
 *           incluye manejo de sesiones y plantillas
 * Autor:
 *************************************************************/
include_once("cabecera.html");
include_once("menu.php");
include_once("aside.html");
?>
      <section class="acceso">
      <h2>Acceso al sistema</h2>
      
			<form id="frm" method="post" action="login.php">
        <div class="tabla-responsiva">
        <table border="1">
            <tr>
                <th>Usuario</th>
                <td><input type="text" name="txtUsuario" required /></td>
            </tr>
            <tr>
                <th>Contraseña</th>
                <td><input type="password" name="txtContrasena" required /></td>
            </tr>
        </table>
				<input type="submit" value="Enviar"/>
        </div>
			</form>
		</section>

<?php
include_once("pie.html");
?>