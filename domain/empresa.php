<?php 
class empresa {


  private $empresaid;
  private $empresacodigo;
  private $empresanombre;
  private $empresaubicacion;
  private $empresaubicacionprovincia; 
  private $empresaubicacioncanton;
  private $empresaubicaciondistrito;
  private $empresaubicacionotrassenas;
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

	function getempresaubicacionprovincia(){
		return $this->empresaubicacionprovincia;
	}

	function setempresaubicacionprovincia($empresaubicacionprovincia){
		$this->empresaubicacionprovincia = $empresaubicacionprovincia;
	}

	function getempresaubicacioncanton(){
		return $this->empresaubicacioncanton;
	}

	function setempresaubicacioncanton($empresaubicacioncanton){
		$this->empresaubicacioncanton = $empresaubicacioncanton;
	}

	function getempresaubicaciondistrito(){
		return $this->empresaubicaciondistrito;
	}

	function setempresaubicaciondistrito($empresaubicaciondistrito){
		$this->empresaubicaciondistrito= $empresaubicaciondistrito;
	}

	function getempresaubicacionotrassenas(){
		return $this->empresaubicacionotrassenas;
	}

	function setempresaubicacionotrassenas($empresaubicacionotrassenas){
		$this->empresaubicacionotrassenas = $empresaubicacionotrassenas;
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