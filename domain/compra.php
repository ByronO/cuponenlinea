<?php 
class compra {

    private $clientecompracuponid;
    private $clienteid;
	private $cuponid;
	private $fechaclientecompracupon;
	

	function compra($clientecompracuponid,$clienteid,$cuponid,$fechaclientecompracupon) {

        $this->clientecompracuponid = $clientecompracuponid;
        $this->clienteid = $clienteid;
        $this->cuponid = $cuponid;
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
    function getfechaclientecompracupon() { 
		return $this->fechaclientecompracupon; 
	}
	function setfechaclientecompracupon($fechaclientecompracupon) { 
		$this->fechaclientecompracupon = $fechaclientecompracupon; 
    }
}
?>