<?php 
class compra {

    private $clientecompracuponid;
    private $clienteid;
	private $cuponid;
	private $cantidadcupones;
	private $fechaclientecompracupon;
	

	function compra($clientecompracuponid,$clienteid,$cuponid,$cantidadcupones,$fechaclientecompracupon) {

        $this->clientecompracuponid = $clientecompracuponid;
        $this->clienteid = $clienteid;
		$this->cuponid = $cuponid;
		$this->cantidadcupones = $cantidadcupones;
        $this->fechaclientecompracupon = $fechaclientecompracupon;
		
    }

	function getclientecompracuponid() { 
		return $this->clientecompracuponid; 
	}
	function setclientecompracuponid($clientecompracuponid) { 
		$this->clientecompracuponid = $clientecompracuponid; 
	}
    function getclienteid() { 
		return $this->clienteid; 
	}
	function setclienteid($clienteid) { 
		$this->clienteid = $clienteid; 
    }
    function getcuponid() { 
		return $this->cuponid; 
	}
	function setcuponid($cuponid) { 
		$this->cuponid = $cuponid; 
	}
	
	function getcantidadcupones() { 
		return $this->cantidadcupones; 
	}
	function setcantidadcupones($cantidadcupones) { 
		$this->cantidadcupones = $cantidadcupones; 
    }
    function getfechaclientecompracupon() { 
		return $this->fechaclientecompracupon; 
	}
	function setfechaclientecompracupon($fechaclientecompracupon) { 
		$this->fechaclientecompracupon = $fechaclientecompracupon; 
    }
}
?>