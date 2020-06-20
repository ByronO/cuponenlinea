<?php

class ReportesControlador{
    
    private $vista;
    
    public function __construct() {
        $this->vista=new View();
    } // constructor
    
    public function vistaprincipalRankeo(){
        require rutaData.'reportesData.php';
        $reportesData = new reportesData();

        $data['rankeoporCostoDesc'] = $reportesData->RankeoporCostoDesc();
       
        
       $this->vista->mostrar("vistaprincipalranking.php", $data);
    }

    public function RankeoporCostoDescVista(){
        require rutaData.'reportesData.php';
        $reportesData = new reportesData();

        $data['rankeoporCostoDesc'] = $reportesData->RankeoporCostoDesc();
        
       $this->vista->mostrar("mostrarRankeoporCostoDescVista.php", $data);

    }//

    public function Rankeomasvendidosseguncosto(){
        require rutaData.'reportesData.php';
        $reportesData = new reportesData();

        $data['rankeomasvendidosseguncosto'] = $reportesData->Rankeomasvendidosseguncosto();
        
       $this->vista->mostrar("mostrarRankeomasvendidosseguncosto.php", $data);

    }//

    public function Rankeomasvendidoshoy(){
        require rutaData.'reportesData.php';
        $reportesData = new reportesData();

        $data['rankeomasvendidoshoy'] = $reportesData->Rankeomasvendidoshoy();
        
       $this->vista->mostrar("mostrarRankeomasvendidoshoy.php", $data);

    }//

    public function Rankeomasvendidossemana(){
        require rutaData.'reportesData.php';
        $reportesData = new reportesData();

        $data['rankeomasvendidossemana'] = $reportesData->Rankeomasvendidossemana();
        
       $this->vista->mostrar("mostrarRankeomasvendidossemana.php", $data);

    }//
    
} // OrderController

?>