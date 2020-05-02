<?php 
class clientedatobancario {

    private $clientedatobancarioid;
    private $clientedatobancariobanco;
	private $clientedatobancarionumerotarjeta;
	private $clientedatobancarioestado;
    private $clientedatobancarioclienteid;
    private $clientedatobancariofechainscripcion;
	

	function clientedatobancario($clientedatobancarioid,$clientedatobancariobanco, $clientedatobancarionumerotarjeta,$clientedatobancarioestado,$clientedatobancarioclienteid,$clientedatobancariofechainscripcion) {

        $this->clientedatobancarioid = $clientedatobancarioid;
        $this->clientedatobancariobanco = $clientedatobancariobanco;
        $this->clientedatobancarionumerotarjeta = $clientedatobancarionumerotarjeta;
        $this->clientedatobancarioestado = $clientedatobancarioestado;
        $this->clientedatobancarioclienteid = $clientedatobancarioclienteid;
        $this->clientedatobancariofechainscripcion = $clientedatobancariofechainscripcion;

    }

	function getclientedatobancarioid() { 
		return $this->clientedatobancarioid; 
	}
	function setclientedatobancarioid($clientedatobancarioid) { 
		$this->clientedatobancarioid = $clientedatobancarioid; 
	}
    
    function getclientedatobancariobanco() { 
		return $this->clientedatobancariobanco; 
	}
	function setclientedatobancariobanco($clientedatobancariobanco) { 
		$this->clientedatobancariobanco = $clientedatobancariobanco; 
	}
    
    function getclientedatobancarionumerotarjeta() { 
		return $this->clientedatobancarionumerotarjeta; 
	}
	function setclientedatobancarionumerotarjeta($clientedatobancarionumerotarjeta) { 
		$this->clientedatobancarionumerotarjeta = $clientedatobancarionumerotarjeta; 
	}
    
    function getclientedatobancarioestado() { 
		return $this->clientedatobancarioestado; 
	}
	function setclientedatobancarioestado($clientedatobancarioestado) { 
		$this->clientedatobancarioestado = $clientedatobancarioestado; 
	}

    function getclientedatobancarioclienteid() { 
		return $this->clientedatobancarioclienteid; 
	}
	function setclientedatobancarioclienteid($clientedatobancarioclienteid) { 
		$this->clientedatobancarioclienteid = $clientedatobancarioclienteid; 
	}
    function getclientedatobancariofechainscripcion() { 
		return $this->clientedatobancariofechainscripcion; 
	}
	function setclientedatobancariofechainscripcion($clientedatobancariofechainscripcion) { 
		$this->clientedatobancariofechainscripcion = $clientedatobancariofechainscripcion; 
	}

}
?>