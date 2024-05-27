<?php

namespace Almacen\Ssst\dbrepo;
use Almacen\Ssst\dbrepo\interfaces\ICat_Consultas;
use Almacen\Ssst\dbrepo\interfaces\ICat_ConsultaEx;
use Almacen\Ssst\dbrepo\interfaces\ICat_Cat;
use Almacen\Ssst\dbrepo\interfaces\ICat_Roles;
use Almacen\Ssst\dbrepo\interfaces\IReports;


class Factory{
    public ICat_ConsultaEx $getCatEx;
    public ICat_Consultas $getCat;
    public ICat_Cat $getCatCat;
    public ICat_Roles $getCatRol;
    public IReports $reportes;

    public function getCatalogosEx(ICat_ConsultaEx $ob){
        $this->getCatEx=$ob;
    }
    public function getCatalogosCat(ICat_Cat $ob){
        $this->getCatCat=$ob;
    }
    public function getCatalogosRol(ICat_Roles $ob){
        $this->getCatRol=$ob;
    }
    public function getCatalogos(ICat_Consultas $ob){
        $this->getCat = $ob;
    
    }
    public function getReportes(IReports $report){
        $this->reportes = $report;
    }
    
}