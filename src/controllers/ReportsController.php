<?php

namespace Almacen\Ssst\controllers;
use Almacen\Ssst\dbrepo\Factory;
use Almacen\Ssst\dbrepo\GetReports;
use Almacen\Ssst\dbrepo\models\MReportRiesgo;
use Almacen\Ssst\dbrepo\RepoMain;
use Exception;
use Flight;

class ReportsController extends Flight {

    private Factory $factory;
    private MReportRiesgo $modelRiesgo;
    public function __construct()
    {
        $this->modelRiesgo = new MReportRiesgo();
        $this->factory = new Factory();
       $this->factory->getCatalogos(new RepoMain());
       $this->factory->getReportes(new GetReports());
    }
    public function index (){
        $this->factory->getCat->rowVal  = ["estatus"=>array(1)];
        $this->factory->getCat->table = 'cat_areas';
        $this->factory->getCat->logic = "and";
        $areas = $this->factory->getCat->getAll();

        parent::render('Reports/index',['areas'=>$areas]);
    }
    public function GetReports() {
      
         try{
            $this->modelRiesgo->fechaMin = trim($_REQUEST['fechaReport']);
            $this->modelRiesgo->fechaMax = trim($_REQUEST['fechaMaxReport']);
            $this->modelRiesgo->area = trim($_REQUEST['area']);
            $this->modelRiesgo->estatus = trim($_REQUEST['estatus']);
            $this->modelRiesgo->fechaMinSolucion =trim($_REQUEST['fechaMinSolucion']);
            $this->modelRiesgo->fechaMaxSolucion = trim($_REQUEST['fechaMaxSolucion']);
           $report = $this->factory->reportes->GetReports($this->modelRiesgo);
            parent::json(['data'=>$report]);
        

        }catch(Exception $ex){
            parent::json(['msg'=>$ex->getMessage()],400);
        } 
    }
}