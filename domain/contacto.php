<?php 
class contacto{

    private $empresaid;
    private $empesacontactoid;
    private $empresacontactocriterio;
	private $empesacontactovalor;
    
	function contacto($empesacontactoid, $empresacontactocriterio, $empesacontactovalor, $empresaid) {

        $this->empresaid = $empresaid;
        $this->empesacontactoid = $empesacontactoid;
        $this->empresacontactocriterio = $empresacontactocriterio;
		$this->empesacontactovalor = $empesacontactovalor;
    }

	function getempresaid() { 
		return $this->empresaid; 
	}
	function setempresaid($empresaid) { 
		$this->empresaid = $empresaid; 
	}
	
	function getempesacontactoid() { 
		return $this->empesacontactoid; 
	}
	function setempesacontactoid($empesacontactoid) { 
		$this->empesacontactoid = $empesacontactoid; 
	}
	
	function getempresacontactocriterio() { 
		return $this->empresacontactocriterio; 
	}
	function setempresacontactocriterio($empresacontactocriterio) { 
		$this->empresacontactocriterio = $empresacontactocriterio; 
	}
	
	function getempesacontactovalor() { 
		return $this->empesacontactovalor; 
	}
	function setempesacontactovalor($empesacontactovalor) { 
		$this->empesacontactovalor = $empesacontactovalor; 
	}
}
?>