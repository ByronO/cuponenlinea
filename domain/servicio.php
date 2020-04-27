<?php 
class servicio {

    private $empresaid;
    private $servicioid;
    private $serviciocriterio;
	private $serviciovalor;
    
	function servicio($servicioid, $serviciocriterio, $serviciovalor, $empresaid) {

        $this->empresaid = $empresaid;
        $this->servicioid = $servicioid;
        $this->serviciocriterio = $serviciocriterio;
		$this->serviciovalor = $serviciovalor;
    }

	function getempresaid() { 
		return $this->empresaid; 
	}
	function setempresaid($empresaid) { 
		$this->empresaid = $empresaid; 
	}
	
	function getservicioid() { 
		return $this->servicioid; 
	}
	function setservicioid($servicioid) { 
		$this->servicioid = $servicioid; 
	}
	
	function getserviciocriterio() { 
		return $this->serviciocriterio; 
	}
	function setserviciocriterio($serviciocriterio) { 
		$this->serviciocriterio = $serviciocriterio; 
	}
	
	function getserviciovalor() { 
		return $this->serviciovalor; 
	}
	function setserviciovalor($serviciovalor) { 
		$this->serviciovalor = $serviciovalor; 
	}
}
?>


