<?php 
class cupon {


  private $cuponid;
  private $cuponnombre;
  private $empresaid;
  private $serviciovalor;
  private $cuponrutaimagen;
  private $cupondescripcion;
  private $cupondetallesadicionales;
  private $cuponfechainicio;
  private $cuponfechafin;
  private $cuponrestricciones;
  private $cuponprecio;
  private $cuponestado;
    
	function cupon($cuponid, $cuponnombre, $empresaid, $serviciovalor,$cuponrutaimagen, $cupondescripcion, $cupondetallesadicionales, $cuponrestricciones,$cuponprecio, $cuponestado, $cuponfechainicio, $cuponfechafin) {


        $this->cuponid = $cuponid;
        $this->cuponnombre = $cuponnombre;
        $this->empresaid = $empresaid;
        $this->serviciovalor = $serviciovalor;
        $this->cuponrutaimagen = $cuponrutaimagen;
        $this->cupondescripcion = $cupondescripcion;
        $this->cupondetallesadicionales = $cupondetallesadicionales;
        $this->cuponrestricciones = $cuponrestricciones;
        $this->cuponprecio = $cuponprecio;
		$this->cuponestado = $cuponestado;
		$this->cuponfechainicio = $cuponfechainicio;
        $this->cuponfechafin = $cuponfechafin;

    }

	function getcuponrestricciones() { 
		return $this->cuponrestricciones; 
	}
	function setcuponrestricciones($cuponrestricciones) { 
		$this->cuponrestricciones = $cuponrestricciones; 
	}

	function getcuponprecio() { 
		return $this->cuponprecio; 
	}
	function setcuponprecio($cuponprecio) { 
		$this->cuponprecio = $cuponprecio; 
    }
    
    function getcuponestado() { 
		return $this->cuponestado; 
	}
	function setcuponestado($cuponestado) { 
		$this->cuponestado = $cuponestado; 
	}

	function getcuponid() { 
		return $this->cuponid; 
	}
	function setcuponid($cuponid) { 
		$this->cuponid = $cuponid; 
	}
	
	function getcuponnombre() { 
		return $this->cuponnombre; 
	}
	function setcuponnombre($cuponnombre) { 
		$this->cuponnombre = $cuponnombre; 
	}
	
	function getempresaid() { 
		return $this->empresaid; 
	}
	function setempresaid($empresaid) { 
		$this->empresaid = $empresaid; 
	}
	
	function getserviciovalor() { 
		return $this->serviciovalor; 
	}
	function setserviciovalor($serviciovalor) { 
		$this->serviciovalor = $serviciovalor; 
	}

	function getcuponrutaimagen() { 
		return $this->cuponrutaimagen; 
	}
	function setcuponrutaimagen($cuponrutaimagen) { 
		$this->cuponrutaimagen = $cuponrutaimagen; 
    }
    
    function getcupondescripcion() { 
		return $this->cupondescripcion; 
	}
	function setcupondescripcion($cupondescripcion) { 
		$this->cupondescripcion = $cupondescripcion; 
	}

	function getcupondetallesadicionales() { 
		return $this->cupondetallesadicionales; 
	}
	function setcupondetallesadicionales($cupondetallesadicionales) { 
		$this->cupondetallesadicionales = $cupondetallesadicionales; 
	}

	function getcuponfechainicio() { 
		return $this->cuponfechainicio; 
	}
	function setcuponfechainicio($cuponfechainicio) { 
		$this->cuponfechainicio = $cuponfechainicio; 
	}

	function getcuponfechafin() { 
		return $this->cuponfechafin; 
	}
	function setcuponfechafin($cuponfechafin) { 
		$this->cuponfechafin = $cuponfechafin; 
	}
}
?>