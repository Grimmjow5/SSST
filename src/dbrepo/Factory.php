<?php

namespace Almacen\Ssst\dbrepo;
use Almacen\Ssst\dbrepo\IReports;


class Factory{

    public ICat_Consultas $getCat;
    public IReports $reportes;

    public function getCatalogos(ICat_Consultas $ob){
        $this->getCat = $ob;
    
    }
    public function getReportes(IReports $report){
        $this->reportes = $report;
    }
    
}