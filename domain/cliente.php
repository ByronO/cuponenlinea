<?php 
class cliente {

    private $clienteid;
    private $clientecorreo;
	private $clientecontrasenna;
	private $clienteestado;
    private $clientefechainscripcion;
    private $clientefechadedesafiliacion;
	

	function cliente($clienteid,$clientecorreo, $clientecontrasenna,$clienteestado,$clientefechainscripcion,$clientefechadedesafiliacion) {

        $this->clienteid = $clienteid;
        $this->clientecorreo = $clientecorreo;
        $this->clientecontrasenna = $clientecontrasenna;
        $this->clienteestado = $clienteestado;
        $this->clientefechainscripcion = $clientefechainscripcion;
        $this->clientefechadedesafiliacion = $clientefechadedesafiliacion;

    }

	function getclienteid() { 
		return $this->clienteid; 
	}
	function setclienteid($clienteid) { 
		$this->clienteid = $clienteid; 
	}
    
    function getclientecorreo() { 
		return $this->clientecorreo; 
	}
	function setclientecorreo($clientecorreo) { 
		$this->clientecorreo = $clientecorreo; 
	}
    
    function getclientecontrasenna() { 
		return $this->clientecontrasenna; 
	}
	function setclientecontrasenna($clientecontrasenna) { 
		$this->clientecontrasenna = $clientecontrasenna; 
	}
    
    function getclienteestado() { 
		return $this->clienteestado; 
	}
	function setclienteestado($clienteestado) { 
		$this->clienteestado = $clienteestado; 
	}

    function getclientefechainscripcion() { 
		return $this->clientefechainscripcion; 
	}
	function setclientefechainscripcion($clientefechainscripcion) { 
		$this->clientefechainscripcion = $clientefechainscripcion; 
	}
    function getclientefechadedesafiliacion() { 
		return $this->clientefechadedesafiliacion; 
	}
	function setclientefechadedesafiliacion($clientefechadedesafiliacion) { 
		$this->clientefechadedesafiliacion = $clientefechadedesafiliacion; 
	}

}
?>