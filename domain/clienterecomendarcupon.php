<?php 
class clienterecomendarcupon {

    private $clienterecomendarcuponid;
    private $cuponrecomendadoid;
	private $clienteemisorid;
	private $clientereceptorid;
    private $cuponrecomendadoestado;
    private $cupondescuento;

	function clienterecomendarcupon($clienterecomendarcuponid,$cuponrecomendadoid, $clienteemisorid,$clientereceptorid,$cuponrecomendadoestado,$cupondescuento) {

        $this->clienterecomendarcuponid = $clienterecomendarcuponid;
        $this->cuponrecomendadoid = $cuponrecomendadoid;
        $this->clienteemisorid = $clienteemisorid;
        $this->clientereceptorid = $clientereceptorid;
        $this->cuponrecomendadoestado = $cuponrecomendadoestado;
        $this->cupondescuento = $cupondescuento;

    }

	function getclienterecomendarcuponid() { 
		return $this->clienterecomendarcuponid; 
	}
	function setclienterecomendarcuponid($clienterecomendarcuponid) { 
		$this->clienterecomendarcuponid = $clienterecomendarcuponid; 
	}
    
    function getcuponrecomendadoid() { 
		return $this->cuponrecomendadoid; 
	}
	function setcuponrecomendadoid($cuponrecomendadoid) { 
		$this->cuponrecomendadoid = $cuponrecomendadoid; 
	}
    
    function getclienteemisorid() { 
		return $this->clienteemisorid; 
	}
	function setclienteemisorid($clienteemisorid) { 
		$this->clienteemisorid = $clienteemisorid; 
	}
    
    function getclientereceptorid() { 
		return $this->clientereceptorid; 
	}
	function setclientereceptorid($clientereceptorid) { 
		$this->clientereceptorid = $clientereceptorid; 
	}

    function getcuponrecomendadoestado() { 
		return $this->cuponrecomendadoestado; 
	}
	function setcuponrecomendadoestado($cuponrecomendadoestado) { 
		$this->cuponrecomendadoestado = $cuponrecomendadoestado; 
	}
    function getcupondescuento() { 
		return $this->cupondescuento; 
	}
	function setcupondescuento($cupondescuento) { 
		$this->cupondescuento = $cupondescuento; 
	}

}
?>