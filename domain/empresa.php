<?php 
class empresa {


  private $empresaid;
  private $empresacodigo;
  private $empresanombre;
  private $empresaubicacion;
  private $empresaestado;
  private $empresacategoria;
  private $empresacedula;
  private $empresasitioweb;
    
	function empresa($empresaid, $empresacodigo, $empresanombre, $empresaubicacion,$empresaestado,$empresacategoria,$empresacedula,$empresasitioweb) {


        $this->empresaid = $empresaid;
        $this->empresacodigo = $empresacodigo;
        $this->empresanombre = $empresanombre;
        $this->empresaubicacion = $empresaubicacion;
        $this->empresaestado = $empresaestado;
        $this->empresacategoria = $empresacategoria;
        $this->empresacedula = $empresacedula;
        $this->empresasitioweb = $empresasitioweb;

    }

	function getempresacedula() { 
		return $this->empresacedula; 
	}
	function setempresacedula($empresacedula) { 
		$this->empresacedula = $empresacedula; 
	}

	function getempresasitioweb() { 
		return $this->empresasitioweb; 
	}
	function setempresasitioweb($empresasitioweb) { 
		$this->empresasitioweb = $empresasitioweb; 
	}

	function getempresaid() { 
		return $this->empresaid; 
	}
	function setempresaid($empresaid) { 
		$this->empresaid = $empresaid; 
	}
	
	function getempresacodigo() { 
		return $this->empresacodigo; 
	}
	function setempresacodigo($empresacodigo) { 
		$this->empresacodigo = $empresacodigo; 
	}
	
	function getempresanombre() { 
		return $this->empresanombre; 
	}
	function setempresanombre($empresanombre) { 
		$this->empresanombre = $empresanombre; 
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

	function getempresacategoria() { 
		return $this->empresacategoria; 
	}
	function setempresacategoria($empresacategoria) { 
		$this->empresacategoria = $empresacategoria; 
	}
}
?>