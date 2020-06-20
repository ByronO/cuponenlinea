<?php 
class cuponVisitas {

    private $cupontipo;
    private $cuponcantidadclicks;
	

	function cuponVisitas($cupontipo,$cuponcantidadclicks) {

        $this->cupontipo = $cupontipo;
        $this->cuponcantidadclicks = $cuponcantidadclicks;
		
    }

	function getcupontipo() { 
		return $this->cupontipo; 
	}
	function setcupontipo($cupontipo) { 
		$this->cupontipo = $cupontipo; 
	}
    function getcuponcantidadclicks() { 
		return $this->cuponcantidadclicks; 
	}
	function setcuponcantidadclicks($cuponcantidadclicks) { 
		$this->cuponcantidadclicks = $cuponcantidadclicks; 
    }
}
?>