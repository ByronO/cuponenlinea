<?php 
class usuario {

    private $usuarioid;
    private $usuarionombre;
	private $usuariocontrasenna;

    private $empresadescripcion;
	private $empresaubicacion;
	private $empresaestado;
    private $empresatipo;
    private $empresaemail;
    private $empresatelefono;
    
	function usuario($usuarionombre, $usuariocontrasenna) {

        $this->usuarionombre = $usuarionombre;
        $this->usuariocontrasenna = $usuariocontrasenna;
    }

	
	function getusuarioid() { 
		return $this->usuarioid; 
	}
	function setusuarioid($usuarioid) { 
		$this->usuarioid = $usuarioid; 
	}
	
	function getusuarionombre() { 
		return $this->usuarionombre; 
	}
	function setusuarionombre($usuarionombre) { 
		$this->usuarionombre = $usuarionombre; 
	}
	
	function getusuariocontrasenna() { 
		return $this->usuariocontrasenna; 
	}
	function setusuariocontrasenna($usuariocontrasenna) { 
		$this->usuariocontrasenna = $usuariocontrasenna; 
	}
	




	function getempresadescripcion() { 
		return $this->empresadescripcion; 
	}
	function setempresadescripcion($empresadescripcion) { 
		$this->empresadescripcion = $empresadescripcion; 
	}
	
	function getempresaubicacion() { 
		return $this->empresaubicacion; 
	}
	function setempresaubicacion($empresaubicacion) { 
		$this->empresaubicacion = $empresaubicacion; 
	}

	function getempresaestado() { 
		return $this->empresaestado; 
	}
	function setempresaestado($empresaestado) { 
		$this->empresaestado = $empresaestado; 
	}

	function getempresatipo() { 
		return $this->empresatipo; 
	}
	function setempresatipo($empresatipo) { 
		$this->empresatipo = $empresatipo; 
	}

	function getempresaemail() { 
		return $this->empresaemail; 
	}
	function setempresaemail($empresaemail) { 
		$this->empresaemail = $empresaemail; 
	}
	function getempresatelefono() { 
		return $this->empresatelefono; 
	}
	function setempresatelefono($empresatelefono) { 
		$this->empresatelefono = $empresatelefono; 
	}
}
?>