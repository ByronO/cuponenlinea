<?php 
class clientecontacto {

    private $clientecontactoid;
    private $clientecontactotelefono1;
	private $clientecontactotelefono2;
	private $clientecontactocorreo;
    private $clientecontactofax;
    private $clientecontactoclienteid;
    private $clientecontactoestado;

	function clientecontacto($clientecontactoid,$clientecontactotelefono1, $clientecontactotelefono2,$clientecontactocorreo,$clientecontactofax,$clientecontactoclienteid,$clientecontactoestado) {

        $this->clientecontactoid = $clientecontactoid;
        $this->clientecontactotelefono1 = $clientecontactotelefono1;
        $this->clientecontactotelefono2 = $clientecontactotelefono2;
        $this->clientecontactocorreo = $clientecontactocorreo;
        $this->clientecontactofax = $clientecontactofax;
        $this->clientecontactoclienteid = $clientecontactoclienteid;
        $this->clientecontactoestado = $clientecontactoestado;
    }

	function getclientecontactoid() { 
		return $this->clientecontactoid; 
	}
	function setclientecontactoid($clientecontactoid) { 
		$this->clientecontactoid = $clientecontactoid; 
	}
    
    function getclientecontactotelefono1() { 
		return $this->clientecontactotelefono1; 
	}
	function setclientecontactotelefono1($clientecontactotelefono1) { 
		$this->clientecontactotelefono1 = $clientecontactotelefono1; 
	}
    
    function getclientecontactotelefono2() { 
		return $this->clientecontactotelefono2; 
	}
	function setclientecontactotelefono2($clientecontactotelefono2) { 
		$this->clientecontactotelefono2 = $clientecontactotelefono2; 
	}
    
    function getclientecontactocorreo() { 
		return $this->clientecontactocorreo; 
	}
	function setclientecontactocorreo($clientecontactocorreo) { 
		$this->clientecontactocorreo = $clientecontactocorreo; 
	}

    function getclientecontactofax() { 
		return $this->clientecontactofax; 
	}
	function setclientecontactofax($clientecontactofax) { 
		$this->clientecontactofax = $clientecontactofax; 
	}
    function getclientecontactoclienteid() { 
		return $this->clientecontactoclienteid; 
	}
	function setclientecontactoclienteid($clientecontactoclienteid) { 
		$this->clientecontactoclienteid = $clientecontactoclienteid; 
    }
    
    function getclientecontactoestado() { 
		return $this->clientecontactoestado; 
	}
	function setclientecontactoestado($clientecontactoestado) { 
		$this->clientecontactoestado = $clientecontactoestado; 
	}

}
?>