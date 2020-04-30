<?php 
class imagenservicio {

    private $id;
    private $servicioid;
    private $serviciovalor;
    private $ruta;
    
	function imagenservicio($id, $servicioid, $serviciovalor, $ruta) {

        $this->id = $id;
        $this->servicioid = $servicioid;
        $this->ruta = $ruta;
		$this->serviciovalor = $serviciovalor;
    }

	function getid() { 
		return $this->id; 
	}
	function setid($id) { 
		$this->id = $id; 
	}
	
	function getservicioid() { 
		return $this->servicioid; 
	}
	function setservicioid($servicioid) { 
		$this->servicioid = $servicioid; 
	}
	
	function getruta() { 
		return $this->ruta; 
	}
	function setruta($ruta) { 
		$this->ruta = $ruta; 
	}
	
	function getserviciovalor() { 
		return $this->serviciovalor; 
	}
	function setserviciovalor($serviciovalor) { 
		$this->serviciovalor = $serviciovalor; 
	}
}
?>


