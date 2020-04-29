<?php 
class empresacategoria {


    private $empresacategoriaid;
    private $empresacategoriacodigo;
    private $empresacategoriaestado;
    private $empresacategorianombre;
	private $empresacategoriaacronimo;

	function empresacategoria($empresacategoriaid, $empresacategoriacodigo,$empresacategoriaestado, $empresacategorianombre,$empresacategoriaacronimo) {

        $this->empresacategoriaid = $empresacategoriaid;
        $this->empresacategoriacodigo = $empresacategoriacodigo;
        $this->empresacategoriaestado = $empresacategoriaestado;
		$this->empresacategorianombre = $empresacategorianombre;
		$this->empresacategoriaacronimo=$empresacategoriaacronimo;
    }

	function getempresacategoriaid() { 
		return $this->empresacategoriaid; 
	}
	
	function setempresacategoriaid($empresacategoriaid) { 
		$this->empresacategoriaid = $empresacategoriaid; 
	}
	
	function getempresacategoriacodigo() { 
		return $this->empresacategoriacodigo; 
	}
	function setempresacategoriacodigo($empresacategoriacodigo) { 
		$this->empresacategoriacodigo = $empresacategoriacodigo; 
	}


	function getempresacategoriaestado() { 
		return $this->empresacategoriaestado; 
	}
	function setempresaempresacategoriaestado($empresacategoriaestado) { 
		$this->empresacategoriaestado = $empresacategoriaestado; 
	}
	
	function getempresacategorianombre() { 
		return $this->empresacategorianombre; 
	}
	function setempresacategorianombre($empresacategorianombre) { 
		$this->empresacategorianombre = $empresacategorianombre; 
	}
	
	function getempresacategoriaacronimo() { 
		return $this->empresacategoriaacronimo; 
	}
	function setempresacategoriaacronimo($empresacategoriaacronimo) { 
		$this->empresacategoriaacronimo = $empresacategoriaacronimo; 
	}
	
	
}
?>