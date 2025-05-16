<?php
/*
Archivo:  Usuario.php
Objetivo: clase que encapsula la información de un usuario
*/

include_once("AccesoDatos.php");

class Usuario {
	private $usuario = "";
	private $contrasena = "";
	private $rol = "";
	private $oAD = null;

	public function setUsuario($valor) {
		$this->usuario = $valor;
	}

	public function getUsuario() {
		return $this->usuario;
	}

	public function setContrasena($valor) {
		$this->contrasena = $valor;
	}
  
	public function getContrasena() {
		return $this->contrasena;
	}

	public function getRol() {
		return $this->rol;
	}

	/* Verifica si existe el usuario con la contraseña */
	public function validarLogin() {
		$bRet = false;
		$sQuery = "";
		$arrRS = null;

		if ($this->usuario == "" || $this->contrasena == "") {
			throw new Exception("Usuario->validarLogin: faltan datos");
		} else {
			$sQuery = "SELECT rol FROM usuarios 
					   WHERE usuario = '" . $this->usuario . "' 
					   AND contrasena = '" . $this->contrasena . "'";
			
			$oAD = new AccesoDatos();
			if ($oAD->conectar()) {
				$arrRS = $oAD->ejecutarConsulta($sQuery);
				$oAD->desconectar();
				
				if ($arrRS != null) {
					$this->rol = $arrRS[0][0];
					$bRet = true;
				}
			}
		}
		return $bRet;
	}
}
?>
