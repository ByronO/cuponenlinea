<?php 
class contacto{

    private $empresaid;
    private $empresacontactoid;
    private $empresacontactocriterio;
	private $empresacontactovalor;
	private $empresafechainscripcion;
	private $empresafechadesafiliacion;
    
	function contacto($empresacontactoid, $empresacontactocriterio, $empresacontactovalor,$empresafechainscripcion,$empresafechadesafiliacion,$empresaid) {

        $this->empresaid = $empresaid;
        $this->empresacontactoid = $empresacontactoid;
        $this->empresacontactocriterio = $empresacontactocriterio;
		$this->empresacontactovalor = $empresacontactovalor;
		$this->empresafechainscripcion = $empresafechainscripcion;
		$this->empresafechadesafiliacion = $empresafechadesafiliacion;
    }

	function getempresaid() { 
		return $this->empresaid; 
	}
	function setempresaid($empresaid) { 
		$this->empresaid = $empresaid; 
	}
	
	function getempresacontactoid() { 
		return $this->empresacontactoid; 
	}
	function setempresacontactoid($empresacontactoid) { 
		$this->empresacontactoid = $empresacontactoid; 
	}
	
	function getempresacontactocriterio() { 
		return $this->empresacontactocriterio; 
	}
	function setempresacontactocriterio($empresacontactocriterio) { 
		$this->empresacontactocriterio = $empresacontactocriterio; 
	}
	
	function getempresacontactovalor() { 
		return $this->empresacontactovalor; 
	}
	function setempresacontactovalor($empresacontactovalor) { 
		$this->empresacontactovalor = $empresacontactovalor; 
	}
	function getempresafechainscripcion(){
		return $this->empresafechainscripcion;
	}
	function setempresafechainscripcion($empresafechainscripcion){
		$this->empresafechainscripcion = $empresafechainscripcion;
	}
	function getempresafechadesafiliacion(){
		return $this->empresafechadesafiliacion;
	}
	function setempresafechadesafiliacion($empresafechadesafiliacion){
		$this->empresafechadesafiliacion=$empresafechadesafiliacion;
	}
}
?>