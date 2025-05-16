<?php
/* * Contacto.php
 * Clase Contacto para manejar la información de contactos.
 * 
 * Esta clase permite realizar operaciones CRUD (Crear, Leer, Actualizar, Eliminar)
 * sobre la tabla "contactos" en la base de datos.
 */
include_once("AccesoDatos.php");

class Contacto {
	private $id = 0;
	private $nombre = "";
	private $direccion = "";
	private $telefono = "";
	private $email = "";

	public function getId() {
		return $this->id;
	}
	public function getNombre() {
		return $this->nombre;
	}
	public function getDireccion() {
		return $this->direccion;
	}
	public function getTelefono() {
		return $this->telefono;
	}
	public function getEmail() {
		return $this->email;
	}

	// Método para obtener todos los contactos
	public function buscarTodos() {
        $arrRS = null;
        $arrContactos = [];
    
        $oAD = new AccesoDatos();
        
        if ($oAD->conectar()) {
            try {
                $sql = "SELECT id, nombre, direccion, telefono, email FROM contactos";
                $arrRS = $oAD->ejecutarConsulta($sql);
                $oAD->desconectar();
    
                if ($arrRS != null) {
                    foreach ($arrRS as $fila) {
                        $contacto = new Contacto();
                        $contacto->id = $fila[0];
                        $contacto->nombre = $fila[1];
                        $contacto->direccion = $fila[2];
                        $contacto->telefono = $fila[3];
                        $contacto->email = $fila[4];
                        $arrContactos[] = $contacto;
                    }
                }
            } catch (Exception $e) {
                throw $e;
            }
        }
    
        return $arrContactos;
	}
	// Buscar contacto por ID
	public function buscarPorId($id) {
		$oAD = new AccesoDatos();
		$contacto = null;

		if ($oAD->conectar()) {
			$sql = "SELECT id, nombre, direccion, telefono, email FROM contactos WHERE id = " . intval($id);
			$arrRS = $oAD->ejecutarConsulta($sql);
			$oAD->desconectar();

			if ($arrRS != null && count($arrRS) > 0) {
				$fila = $arrRS[0];
				$this->id = $fila[0];
				$this->nombre = $fila[1];
				$this->direccion = $fila[2];
				$this->telefono = $fila[3];
				$this->email = $fila[4];
				$contacto = $this;
			}
		}

		return $contacto;
	}

// Eliminar contacto por ID
public function eliminar($id) {
	$oAD = new AccesoDatos();
	if ($oAD->conectar()) {
		$sql = "DELETE FROM contactos WHERE id = " . intval($id);
		$n = $oAD->ejecutarComando($sql);
		$oAD->desconectar();
		return $n > 0;
	}
	return false;
}

// Guardar (insertar o actualizar)
public function guardar() {
	$oAD = new AccesoDatos();
	if ($oAD->conectar()) {
		if ($this->id > 0) // Si ya existe el ID, se actualiza
		{
			// Modificar
			$sql = "UPDATE contactos SET 
						nombre = '$this->nombre',
						direccion = '$this->direccion',
						telefono = '$this->telefono',
						email = '$this->email'
					WHERE id = $this->id";
		} else {
			// Crear nuevo
			$sql = "INSERT INTO contactos (nombre, direccion, telefono, email)
					VALUES ('$this->nombre', '$this->direccion', '$this->telefono', '$this->email')";
		}
		$n = $oAD->ejecutarComando($sql);
		$oAD->desconectar();

		return $n > 0;
	}
	return false;
}

  public function setId($v) { $this->id = intval($v); }
  public function setNombre($v) { $this->nombre = trim($v); }
  public function setDireccion($v) { $this->direccion = trim($v); }
  public function setTelefono($v) { $this->telefono = trim($v); }
  public function setEmail($v) { $this->email = trim($v); }
}
?>
