<?php
namespace Almacen\Ssst\controllers;

use Almacen\Ssst\dbrepo\Factory;
use Almacen\Ssst\dbrepo\GetReports;
use Almacen\Ssst\dbrepo\RepoMain;
use Flight;

class ReportsControllers extends Flight{ 
    private Factory $repoRiesgos;
    function __construct()
    {
     $this->repoRiesgos->getReportes(new GetReports() ) ;
     $this->repoRiesgos->getCatalogos(new RepoMain());
    }
    public function reports(){
        
       $this->repoRiesgos->getCat->rowVal = ["estatus"=>array(1)];
       $this->repoRiesgos->getCat->table = 'cat_areas';
       $this->repoRiesgos->getCat->logic = "and";
       $areas = $this->repoRiesgos->getCat->getAll();

    parent::render('Reports/index',['areas'=>$areas]);
  }  
}