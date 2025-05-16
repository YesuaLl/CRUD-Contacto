<?php
/*************************************************************/
/* AccesoDatos.php
 * Objetivo: clase que encapsula el acceso a la base de datos (caso PDO)
 * Autor: yesua
 *************************************************************/
error_reporting(E_ALL); // Establece cuáles errores de PHP son notificados

class AccesoDatos {
	private $oConexion = null;

	/* Realiza la conexión a la base de datos */
	function conectar() {
		$bRet = false;
		try {
			$this->oConexion = new PDO(
				"mysql:host=localhost;dbname=agenda_usuarios", "root", "", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'")
			);
			$bRet = true;
		} catch (Exception $e) {
			die("Error de conexión: " . $e->getMessage());
			throw $e;
		}
		return $bRet;
	}

	/* Realiza la desconexión de la base de datos */
	function desconectar() {
		$bRet = true;
		if ($this->oConexion != null) {
			$this->oConexion = null;
		}
		return $bRet;
	}

	/* Ejecuta consultas SELECT */
	function ejecutarConsulta($psConsulta) {
		$arrRS = null;
		$rst = null;
		$oLinea = null;
		$sValCol = "";
		$i = 0;
		$j = 0;

		if ($psConsulta == "") {
			throw new Exception("AccesoDatos->ejecutarConsulta: falta indicar la consulta");
		}
		if ($this->oConexion == null) {
			throw new Exception("AccesoDatos->ejecutarConsulta: falta conectar la base");
		}
		try {
			$rst = $this->oConexion->query($psConsulta);
		} catch (Exception $e) {
			throw $e;
		}
		if ($rst) {
			foreach ($rst as $oLinea) {
				foreach ($oLinea as $llave => $sValCol) {
					if (is_string($llave)) {
						$arrRS[$i][$j] = $sValCol;
						$j++;
					}
				}
				$j = 0;
				$i++;
			}
		}
		return $arrRS;
	}

	/* Ejecuta comandos como INSERT, UPDATE o DELETE */
	function ejecutarComando($psComando) {
		$nAfectados = -1;
		if ($psComando == "") {
			throw new Exception("AccesoDatos->ejecutarComando: falta indicar el comando");
		}
		if ($this->oConexion == null) {
			throw new Exception("AccesoDatos->ejecutarComando: falta conectar la base");
		}
		try {
			$nAfectados = $this->oConexion->exec($psComando);
		} catch (Exception $e) {
			throw $e;
		}
		return $nAfectados;
	}
}
?>
